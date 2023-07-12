<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Hr extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('human_resources_model');
    }

    /* List all knowledgebase articles */
    public function index()
    {
        if (!has_permission('hr', '', 'view')) {
            access_denied('hr');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('hr');
        }
       
        $sheader_text = title_text('aside_menu_active', 'hr');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        
        $data['title']     = _l($sheader_text);
        $this->load->view('admin/hr/hrs', $data);
    }

    /* Add new article or edit existing*/
    public function add($id = '')
    {
        if (!has_permission('hr', '', 'view')) {
            access_denied('hr');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('hr');
        }
        if ($this->input->post()) {
            
            $data                = $this->input->post();
            // echo 'post';print_r($data);die;
            if ($id == '') {
                if (!has_permission('hr', '', 'create')) {
                    access_denied('hr');
                }
                $recorddadta = $this->db->get_where(db_prefix().'contacts', array('email' => $data['email'],'role'=>4))->row('email');
                $phonenumberdadta = $this->db->get_where(db_prefix().'contacts', array('phonenumber' => $data['phonenumber'],'role'=>4))->row('phonenumber');
               
                if($recorddadta)
                {
                    set_alert('warning', _l($data['email'].' email is already registered'));
                    redirect(admin_url('hr/add'));
                }
                if($phonenumberdadta)
                {
                    set_alert('warning', _l($phonenumberdadta.' mobile is already registered'));
                    redirect(admin_url('hr/add'));
                }
                else
                {
                    $data['created_date'] = date('Y-m-d H:i:s');
                    $data['role'] = 4;
                    $id = $this->human_resources_model->add_article($data);

                    if ($id) {

                        if($id!='')
                        {
                             // $designationdata = $this->db->get_where(db_prefix().'designation', array('id' => $data['designation_id']))->row('name');

                            $message   = 'Caring Approach : Your Email Address is register as a HR . Your Email Address is '.$data['email'].' And Password is '.$data['password'];
                            $sub = 'HR Registration';
                            $data['msg'] = $message;
                            $tempmsg = $this->load->view('emailtemp', $data, true);
                            
                            send_mail($data['email'], $sub, $tempmsg);
                        }

                        $useridimg = $this->db->get_where(db_prefix().'contacts', array('email' => $data['email'],'role'=>4))->row('userid');
                        $uploadedFiles = handle_file_upload($useridimg,'profile_image', 'profile_image');
                        if ($uploadedFiles && is_array($uploadedFiles)) {
                            foreach ($uploadedFiles as $file) {
                                $this->misc_model->add_attachment_to_database($useridimg, 'profile_image', [$file]);
                            }
                        }
                        set_alert('success', _l('added_successfully', _l('HR')));
                        redirect(admin_url('hr'));
                    }
                }
            } else {
                if (!has_permission('hr', '', 'edit')) {
                    access_denied('hr');
                }
                $success = $this->human_resources_model->update_article($data, $id);
                
                if($_FILES['profile_image']['name'] != '')
                {

                    $uploadedFiles = handle_file_upload($id,'profile_image', 'profile_image');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'profile_image', [$file]);
                        }
                    }

                }
                    set_alert('success', _l('updated_successfully', _l('HR')));
                redirect(admin_url('hr'));
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('HR'));
        } else {
            $article         = $this->human_resources_model->get($id);
           // echo '<pre>'; print_r($article); die;
            $data['article'] = $article;
        }
        $sheader_text = title_text('aside_menu_active', 'hr');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        // $data['designation_res'] = $this->db->get_where(db_prefix().'designation')->result();
        $data['department_res'] = $this->db->get_where(db_prefix().'department')->result();
        $data['title']     = _l($sheader_text);
        $this->load->view('admin/hr/hr', $data);
    }

    public function checkEmail($id=''){
        if ($this->input->is_ajax_request()) {
            $recorddadta = $this->db->get_where(db_prefix().'contacts', array('email' => $this->input->post('email'),'role'=>4))->row();
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

    public function change_emp_status($id, $status)
    {
        $data['active'] = $status;
        $this->db->where('userid', $id);
        $this->db->update(db_prefix().'contacts', $data);
        echo 1;
    }

    /* Delete article from database */
    public function delete_hr($id)
    {
        if (!has_permission('hr', '', 'delete')) {
            access_denied('hr');
        }
        if (!$id) {
            redirect(admin_url('hr'));
        }
        $response = $this->human_resources_model->delete_article($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('HR')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('HR')));
        }
        redirect(admin_url('hr'));
    }

    public function filter(){
        $this->app->get_table_data('hr');
    }
}
