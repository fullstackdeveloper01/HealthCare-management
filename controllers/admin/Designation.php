<?php

defined('BASEPATH') or exit('No direct script access allowed');
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class Designation extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('designation_model');
    }

    /* List all knowledgebase articles */
    public function index()
    {
        if (!has_permission('designation', '', 'view')) {
            access_denied('designation');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('designation');
        }
       
        $subheader_text = setupTitle_text('aside_menu_active', 'master', 'designation');
        $data['sheading_text'] = $subheader_text;
        $data['sh_text'] = $subheader_text;
        
        $data['title']     = _l($subheader_text);
        $this->load->view('admin/designation/designations', $data);
    }

    /* Add new article or edit existing*/
    public function add($id = '')
    {
        if (!has_permission('designation', '', 'view')) {
            access_denied('designation');
        }
        if ($this->input->post()) {
            $data                = $this->input->post();
            
            if ($id == '') {
                if (!has_permission('designation', '', 'create')) {
                    access_denied('designation');
                }
                
                $existname = $this->db->get_where(db_prefix().'designation', array('name' => $data['name']))->row('name');
                if($existname)
                {
                    set_alert('warning', _l($data['name'].' name is existing'));
                    redirect(admin_url('designation'));
                }
                else
                {
                    $data['created_date'] = date('Y-m-d H:i:s');
                    $id = $this->designation_model->add_article($data);
                    if ($id) {
                        set_alert('success', _l('added_successfully', _l('Designation')));
                        redirect(admin_url('designation'));
                    }
                }
            } else {
                if (!has_permission('designation', '', 'edit')) {
                    access_denied('designation');
                }
                $success = $this->designation_model->update_article($data, $id);
                
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('Designation')));
                }
                redirect(admin_url('designation'));
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('Designation'));
        } else {
            $article         = $this->designation_model->get($id);
           // echo '<pre>'; print_r($article); die;
            $data['article'] = $article;
            $title           = _l('edit', _l('Designation')) . ' ' . $article->name;
        }
        $subheader_text = setupTitle_text('aside_menu_active', 'master', 'designation');
        $data['sheading_text'] = $subheader_text;
        $data['sh_text'] = $subheader_text;

        $data['title']     = _l($subheader_text);
        $this->load->view('admin/designation/designation', $data);
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
                    $this->db->insert(db_prefix() . 'masterdesignation_reminder', $data);
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
        redirect(admin_url('designation'));
    }
    
    // export Data
    public function sampledata() {
        $storData = array();
        $data[] = array('name' => 'Name', 'mobile_one' => 'Mobile First', 'mobile_second' => 'Mobile Second', 'address' => 'Address', 'from_company' => 'From Company', 'from_vendore' => 'From Vendor');       
        
        header("Content-designation: application/csv");
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
    public function delete_designation($id)
    {
        if (!has_permission('designation', '', 'delete')) {
            access_denied('designation');
        }
        if (!$id) {
            redirect(admin_url('designation'));
        }
        $response = $this->designation_model->delete_article($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('Designation')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('Designation')));
        }
        redirect(admin_url('designation'));
    }
}
