<?php

defined('BASEPATH') or exit('No direct script access allowed');
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class CarePlan extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('careplan_model');
    }

    /* List all knowledgebase articles */
    public function index()
    {
        if (!has_permission('carePlan', '', 'view')) {
            access_denied('carePlan');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('carePlan');
        }
       
        $subheader_text = setupTitle_text('aside_menu_active', 'master', 'carePlan');
        $data['sheading_text'] = $subheader_text;
        $data['sh_text'] = $subheader_text;
        $data['title']     = _l($subheader_text);
        $this->load->view('admin/carePlan/carePlans', $data);
    }

    /* Add new article or edit existing*/
    public function add($id = '')
    {
        if (!has_permission('carePlan', '', 'view')) {
            access_denied('carePlan');
        }
        if ($this->input->post()) {
            $data                = $this->input->post();
            
            if ($id == '') {
                if (!has_permission('carePlan', '', 'create')) {
                    access_denied('carePlan');
                }
                
                $existname = $this->db->get_where(db_prefix().'care_plan', array('title' => $data['title']))->row('title');
                if($existname)
                {
                    set_alert('warning', _l($data['title'].' title is existing'));
                    redirect(admin_url('carePlan'));
                }
                else
                {
                    $data['created_date'] = date('Y-m-d H:i:s');
                 
                    $id = $this->careplan_model->add_article($data);
                   
                    if ($id) {
                        $uploadedFiles = handle_file_upload($id,'care_plan', 'care_plan');
                        // print_r($uploadedFiles); die;
                        if ($uploadedFiles && is_array($uploadedFiles)) {
                       
                            foreach ($uploadedFiles as $file) {
                                $this->misc_model->add_attachment_to_database($id, 'care_plan', [$file]);
                            }
                        }


                        set_alert('success', _l('added_successfully', _l('Care Plan')));
                        redirect(admin_url('carePlan'));
                    }
                }
            } else {
                if (!has_permission('carePlan', '', 'edit')) {
                    access_denied('carePlan');
                }
                $success = $this->careplan_model->update_article($data, $id);
                if($_FILES['care_plan']['name'] != '')
                {
                    $this->careplan_model->delete_image($id);
                    $uploadedFiles = handle_file_upload($id,'care_plan', 'care_plan');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'care_plan', [$file]);
                        }
                    }
                }
                
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('Care Plan')));
                }
                redirect(admin_url('carePlan'));
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('carePlan'));
        } else {
            $article         = $this->careplan_model->get($id);
           // echo '<pre>'; print_r($article); die;
            $data['article'] = $article;
            $title           = _l('edit', _l('carePlan')) . ' ' . $article->name;
        }
        $subheader_text = setupTitle_text('aside_menu_active', 'master', 'carePlan');
        $data['sheading_text'] = $subheader_text;
        $data['sh_text'] = $subheader_text;
        $data['title']     = _l($subheader_text);
        $this->load->view('admin/carePlan/carePlan', $data);
    }

    public function save() {
        // If file uploaded
        if(is_uploaded_file($_FILES['fileURL']['tmp_name'])) {                            
            // Parse data from CSV file
            $csvData = $this->csvreader->parse_csv($_FILES['fileURL']['tmp_name']);       
            //echo '<pre>'; print_r($csvData); die;
            // create array from CSV file
           if(!empty($csvData)){
                foreach($csvData as $element){                    
                    // Prepare data for Database insertion
                    $data = array(
                        'name' => $element['Name'],
                        'mobile_one' => $element['Mobile First'],
                        'mobile_second' => $element['Mobile Second'],
                        'address' => $element['Address'],
                        'from_company' => $element['From Company'],
                        'from_vendore' => $element['From Vendor'],
                    );
                    //echo '<pre>'; print_r($data); die;
                    $this->db->insert(db_prefix() . 'mastercarePlan_reminder', $data);
                    $data[] = '';
                }
                set_alert('success', _l('Data are stored successful!'));
            }
            else
            {
                set_alert('warning', _l('File is required'));
            }
        }
        else
        {
            set_alert('warning', _l('File is required'));
        } 
        redirect(admin_url('carePlan'));
    }
    
    // export Data
    public function sampledata() {
        $storData = array();
        $data[] = array('name' => 'Name', 'mobile_one' => 'Mobile First', 'mobile_second' => 'Mobile Second', 'address' => 'Address', 'from_company' => 'From Company', 'from_vendore' => 'From Vendor');       
        
        header("Content-department: application/csv");
        header("Content-Disposition: attachment; filename=\"csv-sample-customer".".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");
        $handle = fopen('php://output', 'w');
        foreach ($data as $data) {
            fputcsv($handle, $data);
        }
            fclose($handle);
        exit;
    }

    /* Delete article from database */
    public function delete_carePlan($id)
    {
        if (!has_permission('carePlan', '', 'delete')) {
            access_denied('carePlan');
        }
        if (!$id) {
            redirect(admin_url('carePlan'));
        }
        $response = $this->careplan_model->delete_article($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('carePlan')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('carePlan')));
        }
        redirect(admin_url('carePlan'));
    }
}
