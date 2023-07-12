<?php

defined('BASEPATH') or exit('No direct script access allowed');
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class Department extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('department_model');
    }

    /* List all knowledgebase articles */
    public function index()
    {
        if (!has_permission('department', '', 'view')) {
            access_denied('department');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('department');
        }
       
        $subheader_text = setupTitle_text('aside_menu_active', 'master', 'department');
        $data['sheading_text'] = $subheader_text;
        $data['sh_text'] = $subheader_text;
        $data['parentDepartment'] = $this->db->get_where(db_prefix().'department', array('parent_id' => 0))->result();
        $data['title']     = _l($subheader_text);
        $this->load->view('admin/department/departments', $data);
    }

    /* Add new article or edit existing*/
    public function add($id = '')
    {
        if (!has_permission('department', '', 'view')) {
            access_denied('department');
        }
        if ($this->input->post()) {
            $data                = $this->input->post();
            
            if ($id == '') {
                if (!has_permission('department', '', 'create')) {
                    access_denied('department');
                }
                
                $existname = $this->db->get_where(db_prefix().'department', array('name' => $data['name']))->row('name');
                if($existname)
                {
                    set_alert('warning', _l($data['name'].' name is existing'));
                    redirect(admin_url('department'));
                }
                else
                {
                    $data['created_date'] = date('Y-m-d H:i:s');
                    if($data['parent_id'] == '')
                    {
                        $data['parent_id'] = 0;
                    }
                    $id = $this->department_model->add_article($data);
                    if ($id) {
                        set_alert('success', _l('added_successfully', _l('Department')));
                        redirect(admin_url('department'));
                    }
                }
            } else {
                if (!has_permission('department', '', 'edit')) {
                    access_denied('department');
                }
                $success = $this->department_model->update_article($data, $id);
                
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('Department')));
                }
                redirect(admin_url('department'));
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('Department'));
        } else {
            $article         = $this->department_model->get($id);
           // echo '<pre>'; print_r($article); die;
            $data['article'] = $article;
            $title           = _l('edit', _l('Department')) . ' ' . $article->name;
        }
        $subheader_text = setupTitle_text('aside_menu_active', 'master', 'department');
        $data['sheading_text'] = $subheader_text;
        $data['sh_text'] = $subheader_text;
        $data['parentDepartment'] = $this->db->get_where(db_prefix().'department', array('parent_id' => 0))->result();
        $data['title']     = _l($subheader_text);
        $this->load->view('admin/department/department', $data);
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
                    $this->db->insert(db_prefix() . 'masterdepartment_reminder', $data);
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
        redirect(admin_url('department'));
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
    public function delete_department($id)
    {
        if (!has_permission('department', '', 'delete')) {
            access_denied('department');
        }
        if (!$id) {
            redirect(admin_url('department'));
        }
        $response = $this->department_model->delete_article($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('Department')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('Department')));
        }
        redirect(admin_url('department'));
    }
}
