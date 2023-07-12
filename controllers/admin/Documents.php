<?php

defined('BASEPATH') or exit('No direct script access allowed');
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class Documents extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('documents_model');
    }

    /* List all knowledgebase articles */
    public function index()
    {
        if (!has_permission('documents', '', 'view')) {
            access_denied('documents');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('documents');
        }
       
        $subheader_text = setupTitle_text('aside_menu_active', 'documents', 'view');
        $data['sheading_text'] = $subheader_text;
        $data['sh_text'] = $subheader_text;
        
        $data['title']     = _l($subheader_text);
        $data['type_result'] = $this->db->get_where(db_prefix().'_type', array('status' => 1))->result();
        $this->load->view('admin/documents/documentss', $data);
    }

    /* Add new article or edit existing*/
    public function addDocument($id = '')
    {
        $data                = $this->input->post();
            
            if ($id == '') {
                if (!has_permission('documents', '', 'create')) {
                    access_denied('documents');
                }
                
                $existtype = $this->db->get_where(db_prefix().'_documents', array('title' => $data['title']))->row('title');
                if($existtype)
                {
                    set_alert('warning', _l($data['title'].' title is existing'));
                    redirect(admin_url('documents'));
                }
                else
                {
                    $data['created_date'] = date('Y-m-d H:i:s');
                    $id = $this->documents_model->add_article($data);
                    if ($id) {
                        
                        $uploadedFiles = handle_file_upload($id, 'documents', 'document');
                        if ($uploadedFiles && is_array($uploadedFiles)) {
                            foreach ($uploadedFiles as $file) {
                                $this->misc_model->add_attachment_to_database($id, 'documents', [$file]);
                            }
                        }
                        
                        set_alert('success', _l('added_successfully',_l('Document')));
                        redirect(admin_url('documents'));
                    }
                }
            } else {
                if (!has_permission('documents', '', 'edit')) {
                    access_denied('documents');
                }
                $success = $this->documents_model->update_article($data, $id);
                
                if ($success) {
                    set_alert('success', _l('updated_successfully',_l('Document')));
                }
                redirect(admin_url('documents'));
            }
    }
    public function add($id = '')
    {
        if (!has_permission('documents', '', 'view')) {
            access_denied('documents');
        }
        if ($this->input->post()) {
            $data                = $this->input->post();
            if ($id == '') {
                if (!has_permission('documents', '', 'create')) {
                    access_denied('documents');
                }
                
                $existtype = $this->db->get_where(db_prefix().'_documents', array('title' => $data['title']))->row('title');
                if($existtype)
                {
                    set_alert('warning', _l($data['title'].' title is existing'));
                    redirect(admin_url('documents'));
                }
                else
                {
                    $data['created_date'] = date('Y-m-d H:i:s');
                    $id = $this->documents_model->add_article($data);
                    if ($id) {
                        
                        $uploadedFiles = handle_file_upload($id, 'documents', 'document');
                        if ($uploadedFiles && is_array($uploadedFiles)) {
                            foreach ($uploadedFiles as $file) {
                                $this->misc_model->add_attachment_to_database($id, 'documents', [$file]);
                            }
                        }
                        
                        set_alert('success', _l('added_successfully',_l('Document')));
                        redirect(admin_url('documents'));
                    }
                }
            } else {
                if (!has_permission('documents', '', 'edit')) {
                    access_denied('documents');
                }
                $success = $this->documents_model->update_article($data, $id);
                
                if ($success) {
                    set_alert('success', _l('updated_successfully',_l('Document')));
                }
                redirect(admin_url('documents'));
            }
        }
        if ($id == '') {
            $title = _l('add_new',_l('Document'));
            $data['article'] = '';
        } else {
            $article         = $this->documents_model->get($id);
           // echo '<pre>'; print_r($article); die;
            $data['article'] = $article;
            $title           = _l('edit',_l('Document')) . ' ' . $article->title;
        }
        
        $subheader_text = setupTitle_text('aside_menu_active', 'documents', 'addDocument');
        $data['sheading_text'] = $subheader_text;
        $data['sh_text'] = $subheader_text;

        $data['title']     = _l($subheader_text);
        $data['type_result'] = $this->db->get_where(db_prefix().'_type', array('status' => 1))->result();
        $this->load->view('admin/documents/documents', $data);
    }

    public function save() {
        // If file uploaded
        if(is_uploaded_file($_FILES['fileURL']['tmp_type'])) {                            
            // Parse data from CSV file
            $csvData = $this->csvreader->parse_csv($_FILES['fileURL']['tmp_type']);       
            //echo '<pre>'; print_r($csvData); die;
            // create array from CSV file
           if(!empty($csvData)){
                foreach($csvData as $element){                    
                    // Prepare data for Database insertion
                    $data = array(
                        'type' => $element['type'],
                        'mobile_one' => $element['Mobile First'],
                        'mobile_second' => $element['Mobile Second'],
                        'address' => $element['Address'],
                        'from_company' => $element['From Company'],
                        'from_vendore' => $element['From Vendor'],
                    );
                    //echo '<pre>'; print_r($data); die;
                    $this->db->insert(db_prefix() . 'master_documents_reminder', $data);
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
        redirect(admin_url('documents'));
    }
    
    // export Data
    public function sampledata() {
        $storData = array();
        $data[] = array('type' => 'type', 'mobile_one' => 'Mobile First', 'mobile_second' => 'Mobile Second', 'address' => 'Address', 'from_company' => 'From Company', 'from_vendore' => 'From Vendor');       
        
        header("Content-documents: application/csv");
        header("Content-Disposition: attachment; filetype=\"csv-sample-customer".".csv\"");
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
    public function delete_documents($id)
    {
        if (!has_permission('documents', '', 'delete')) {
            access_denied('documents');
        }
        if (!$id) {
            redirect(admin_url('documents'));
        }
        $response = $this->documents_model->delete_article($id);
        if ($response == true) {
            set_alert('success', _l('deleted',_l('Document')));
        } else {
            set_alert('warning', _l('problem_deleting',_l('Document')));
        }
        redirect(admin_url('documents'));
    }
}
