<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BookAppointment extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('appointment_model');
        //$this->load->library('CSVReader');
    }

    /* List all articles */
    public function index()
    {
        if (!has_permission('bookAppointment', '', 'view')) {
            access_denied('bookAppointment');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('bookAppointment');
        }
       
        $sheader_text = title_text('aside_menu_active', 'bookAppointment');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        
        $data['title']     = _l($sheader_text);
        $this->load->view('admin/appointment/appointment', $data);
    }
    
    /* Add new article or edit existing*/
    public function add($id = '')
    {
        if (!has_permission('bookAppointment', '', 'view')) {
            access_denied('bookAppointment');
        }
        if ($this->input->post()) {
            $data                = $this->input->post();
            //echo '<pre>'; print_r($data); die;
            if ($id == '') {
                if (!has_permission('appointment', '', 'create')) {
                    access_denied('appointment');
                }
                $id = $this->appointment_model->add_article($data);
                if ($id) {
                    
                    set_alert('success', _l('added_successfully', _l('appointment')));
                    redirect(admin_url('appointment'));
                }
            } else {
                if (!has_permission('appointment', '', 'edit')) {
                    access_denied('appointment');
                }
                $success = $this->appointment_model->update_article($data, $id);
                
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('appointment')));
                }
                redirect(admin_url('appointment'));
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('appointment'));
        } else {
            $article         = $this->appointment_model->get($id);
            //echo '<pre>'; print_r($article); die;
            $data['article'] = $article;
        }
        $sheader_text = title_text('aside_menu_active', 'appointment');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        $data['title']     = _l($sheader_text);
        $this->load->view('admin/appointment/appointment', $data);
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
                        'name' => $element['appointment']
                    );
                    $exitappointment = $this->db->get_where(db_prefix().'appointment', array('name' => $data['name']))->row('name');
                    if($exitappointment != '')
                    {
                        
                    }
                    else
                    {
                        $this->db->insert(db_prefix() . 'appointment', $data);
                        $data[] = '';
                    }
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
        redirect(admin_url('appointment'));
    }
    
    // export Data
    public function sampledata() {
        $storData = array();
        $data[] = array('name' => 'appointment');       
        
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"csv-sample-appointment".".csv\"");
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
    public function delete_appointment($id)
    {
        if (!has_permission('appointment', '', 'delete')) {
            access_denied('appointment');
        }
        if (!$id) {
            redirect(admin_url('appointment'));
        }
        $response = $this->appointment_model->delete_article($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('appointment')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('appointment')));
        }
        redirect(admin_url('appointment'));
    }
}
