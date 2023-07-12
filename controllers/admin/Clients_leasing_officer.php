<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Clients_leasing_officer extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('clients_leasing_officer_model');
    }

    /* List all knowledgebase articles */
    public function index()
    {
        if (!has_permission('clients_leasing_officer', '', 'view')) {
            access_denied('clients_leasing_officer');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('clients_leasing_officer');
        }
       
        $sheader_text = title_text('aside_menu_active', 'clients_leasing_officer');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        
        $data['title']     = _l($sheader_text);
        $this->load->view('admin/clients_leasing_officer/clients_leasing_officers', $data);
    }

    public function filterCLORecord($para1 = '', $para2 = '')
    {
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('clients_leasing_officer_filter', [
                'report_type' => $para1, 'clo_status' => $para2
            ]);
        }
    }

    public function change_client_status($id, $status)
    {
        if ($this->input->is_ajax_request()) {
            $this->clients_model->change_client_status($id, $status);
        }
    }

    /* Add new article or edit existing*/
    public function add($id = '')
    {
        // print_r($id); 
        if (!has_permission('clients_leasing_officer', '', 'view')) {
            access_denied('clients_leasing_officer');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('clients_leasing_officer');
        }
        if ($this->input->post()) 
        {
            $data                = $this->input->post();
            
            if ($id == '') {
                if (!has_permission('clients_leasing_officer', '', 'create')) {
                    access_denied('clients_leasing_officer');
                }
                $recorddadta = $this->db->get_where(db_prefix().'contacts', array('email' => $data['email'],'role'=>3))->row('email');
                $phonenumberdadta = $this->db->get_where(db_prefix().'contacts', array('phonenumber' => $data['phonenumber'],'role'=>3))->row('phonenumber');
                if($recorddadta)
                {
                    set_alert('warning', _l($data['email'].' email is already registered'));
                    redirect(admin_url('clients_leasing_officer/add'));
                }
                if($phonenumberdadta)
                {
                    set_alert('warning', _l($phonenumberdadta.' mobile is already registered'));
                    redirect(admin_url('clients_leasing_officer/add'));
                }
                else
                {
                    $data['created_date'] = date('Y-m-d H:i:s');
                    $data['role'] = 3;
                    $id = $this->clients_leasing_officer_model->add_article($data);
                    
                    $folderid = $data['folderid'];
                    if ($id) {
                        if($id!='')
                        {
                             $designationdata = $this->db->get_where(db_prefix().'designation', array('id' => $data['designation_id']))->row('name');

                            $message   = 'Caring Approach : Your Email Address is register as a Client Liaison Office. Your Email Address is '.$data['email'].' And Password is '.$data['password'];
                            $sub = $designationdata->name.' Registration';
                            $data['msg'] = $message;
                            $tempmsg = $this->load->view('emailtemp', $data, true);
                            send_mail($data['email'], $sub, $tempmsg);
                        }

                        $useridimg = $this->db->get_where(db_prefix().'contacts', array('email' => $data['email'],'role'=>3))->row('userid');

                        $uploadedFiles = handle_file_upload($useridimg,'profile_image', 'profile_image');
                        if ($uploadedFiles && is_array($uploadedFiles)) {
                            foreach ($uploadedFiles as $file) {
                                $this->misc_model->add_attachment_to_database($useridimg, 'profile_image', [$file]);
                            }
                        }


                        set_alert('success', _l('added_successfully', _l('Client Liaison Office')));
                        redirect(admin_url('clients_leasing_officer'));
                    }
                }
            } else {
                if (!has_permission('clients_leasing_officer', '', 'edit')) {
                    access_denied('clients_leasing_officer');
                }
                $success = $this->clients_leasing_officer_model->update_article($data, $data['userid']);
               
                if($_FILES['profile_image']['name'] != '')
                {
                    $uploadedFiles = handle_file_upload($data['userid'],'profile_image', 'profile_image');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($data['userid'], 'profile_image', [$file]);
                        }
                    }
                }
                set_alert('success', _l('updated_successfully', _l('Client Liaison Office')));
                redirect(admin_url('clients_leasing_officer'));
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('clients_leasing_officer'));
        } else {
            $article         = $this->clients_leasing_officer_model->get($id);
           // echo '<pre>'; print_r($article); die;
            $data['article'] = $article;
        }
        $sheader_text = title_text('aside_menu_active', 'clients_leasing_officer');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;

        $data['department_res'] = $this->db->get_where(db_prefix().'department')->result();
        $data['title']     = _l($sheader_text);
        $this->load->view('admin/clients_leasing_officer/clients_leasing_officer', $data);
    }

    public function checkEmail($id=""){
        if ($this->input->is_ajax_request()) {
            $recorddadta = $this->db->get_where(db_prefix().'contacts', array('email' => $this->input->post('email'),'role'=>3))->row();
            if($recorddadta)
            {
                if($id=""){
                    echo'0';
                }elseif($recorddadta->userid!=$id){
                    echo '0';
                }else{
                    echo '1';
                }
            }else{
                echo '1';
            }
        }
    }

    public function checkPhone($id=""){
        if ($this->input->is_ajax_request()) {
            $recorddadta = $this->db->get_where(db_prefix().'contacts', array('phonenumber' => $this->input->post('phone'),'role'=>3))->row();
            if($recorddadta)
            {
                    echo '1';
              
            }else{
                echo '0';
            }
        }
    }

    public function change_emp_status($id, $status)
    {
        $data['active'] = $status;
        $this->db->where('userid', $id);
        $this->db->update(db_prefix().'contacts', $data);
        set_alert('success', _l('Updated', _l('Client Liaison Office')));
        echo 1;
    }

    /* Delete article from database */
    public function delete_clients_leasing_officer($id)
    {
        if (!has_permission('clients_leasing_officer', '', 'delete')) {
            access_denied('clients_leasing_officer');
        }
        if (!$id) {
            redirect(admin_url('clients_leasing_officer'));
        }
        $response = $this->clients_leasing_officer_model->delete_article($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('Client Liaison Office')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('Client Liaison Office')));
        }
        redirect(admin_url('clients_leasing_officer'));
    }
}
