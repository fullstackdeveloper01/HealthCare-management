<?php

defined('BASEPATH') or exit('No direct script access allowed');
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class Policy extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('policy_model');
    }

    /* List all knowledgebase articles */
    public function index()
    {
        if (!has_permission('policy', '', 'view')) {
            access_denied('policy');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('policy');
        }
       
        $subheader_text = setupTitle_text('aside_menu_active', 'reports', 'policy');
        $data['sheading_text'] = $subheader_text;
        $data['sh_text'] = $subheader_text;
        
        $data['title']     = _l($subheader_text);
        $this->load->view('admin/policy/policys', $data);
    }

    /* Add new article or edit existing*/
    public function add($id = '')
    {
        if ($this->input->post()) {
            $data                = $this->input->post();
            //echo '<pre>'; print_r($data); die;
            if ($id == '') {
                if (!has_permission('policy', '', 'create')) {
                    access_denied('policy');
                }
                
                $existname = $this->db->get_where(db_prefix().'policy', array('name' => $data['name']))->row('name');
                if($existname)
                {
                    set_alert('warning', _l($data['name'].' name is existing'));
                    redirect(admin_url('policy'));
                }
                else
                {
                    $data['created_date'] = date('Y-m-d H:i:s');
                    $id = $this->policy_model->add_article($data);
                    if ($id) {
                        
                        $uploadedFiles = handle_file_upload($id, 'policy', 'policy');
                        if ($uploadedFiles && is_array($uploadedFiles)) {
                            foreach ($uploadedFiles as $file) {
                                $this->misc_model->add_attachment_to_database($id, 'policy', [$file]);
                            }
                        }
                        
                        set_alert('success', _l('added_successfully', _l('Policy')));
                        redirect(admin_url('policy'));
                    }
                }
            } else {
                if (!has_permission('policy', '', 'edit')) {
                    access_denied('policy');
                }
                $success = $this->policy_model->update_article($data, $id);
                
                $uploadedFiles = handle_file_upload($id, 'policy', 'policy');
                if ($uploadedFiles && is_array($uploadedFiles)) {
                    foreach ($uploadedFiles as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'policy', [$file]);
                    }
                }
                
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('Policy')));
                }
                redirect(admin_url('policy'));
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('Policy'));
        } else {
            $article         = $this->policy_model->get($id);
           // echo '<pre>'; print_r($article); die;
            $data['article'] = $article;
            $title           = _l('edit', _l('Policy')) . ' ' . $article->name;
        }
        $subheader_text = setupTitle_text('aside_menu_active', 'reports', 'policy');
        $data['sheading_text'] = $subheader_text;
        $data['sh_text'] = $subheader_text;

        $data['title']     = _l($subheader_text);
        $this->load->view('admin/policy/policy', $data);
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
                    $this->db->insert(db_prefix() . 'masterpolicy_reminder', $data);
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
        redirect(admin_url('policy'));
    }
    
    // export Data
    public function sampledata() {
        $storData = array();
        $data[] = array('name' => 'Name', 'mobile_one' => 'Mobile First', 'mobile_second' => 'Mobile Second', 'address' => 'Address', 'from_company' => 'From Company', 'from_vendore' => 'From Vendor');       
        
        header("Content-policy: application/csv");
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
    public function delete_policy($id)
    {
        if (!has_permission('policy', '', 'delete')) {
            access_denied('policy');
        }
        if (!$id) {
            redirect(admin_url('policy'));
        }
        $response = $this->policy_model->delete_article($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('Policy Successfully')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('Policy')));
        }
        redirect(admin_url('policy'));
    }
}
