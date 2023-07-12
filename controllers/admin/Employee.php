<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('employee_model');
    }

    /* List all knowledgebase articles */
    public function index()
    {
        if (!has_permission('employee', '', 'view')) {
            access_denied('employee');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('employee');
        }
       
        $sheader_text = title_text('aside_menu_active', 'employee');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        
        $data['title']     = _l($sheader_text);
        $this->load->view('admin/employee/employees', $data);
    }

    /* Add new article or edit existing*/
    public function add($id = '')
    {
        if (!has_permission('employee', '', 'view')) {
            access_denied('employee');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('employee');
        }
        if ($this->input->post()) {
            $data                = $this->input->post();
        //    print_r($data);die;
            if ($id == '') {
                // echo'if';die;
                if (!has_permission('employee', '', 'create')) {
                    access_denied('employee');
                }
                $recorddadta = $this->db->get_where(db_prefix().'contacts', array('email' => $data['email'],'role'=>1))->row('email');
                $phonenumberdadta = $this->db->get_where(db_prefix().'contacts', array('phonenumber' => $data['phonenumber'],'role'=>1))->row('phonenumber');
               
                if($recorddadta)
                {
                    // echo 'if';
                    // die;
                    set_alert('warning', _l($data['email'].' email is already registered'));
                    redirect(admin_url('employee/add'));
                }
                if($phonenumberdadta)
                {
                    // echo'else';
                    // die;
                    set_alert('warning', _l($phonenumberdadta.' mobile is already registered'));
                    redirect(admin_url('employee/add'));
                }
                else
                {
                    // echo'else-else';die;
                    $data['created_date'] = date('Y-m-d H:i:s');
                    $data['role'] = 1;
                    $id = $this->employee_model->add_article($data);

                    if ($id) {

                        if($id!='')
                        {
                             $designationdata = $this->db->get_where(db_prefix().'designation', array('id' => $data['designation_id']))->row('name');

                            $message   = 'Caring Approach : Your Email Address is register as a '.$designationdata->name.'. Your Email Address is '.$data['email'].' And Password is '.$data['password'];
                            $sub = $designationdata->name.' Registration';
                            $data['msg'] = $message;
                            $tempmsg = $this->load->view('emailtemp', $data, true);
                            
                            send_mail($data['email'], $sub, $tempmsg);
                        }

                        $useridimg = $this->db->get_where(db_prefix().'contacts', array('email' => $data['email'],'role'=>1))->row('userid');
                        $uploadedFiles = handle_file_upload($useridimg,'profile_image', 'profile_image');
                        if ($uploadedFiles && is_array($uploadedFiles)) {
                            foreach ($uploadedFiles as $file) {
                                $this->misc_model->add_attachment_to_database($useridimg, 'profile_image', [$file]);
                            }
                        }
                        set_alert('success', _l('added_successfully', _l('Employee')));
                        redirect(admin_url('employee'));
                    }
                }
            } else {
                if (!has_permission('employee', '', 'edit')) {
                    access_denied('employee');
                }
                $success = $this->employee_model->update_article($data, $id);
                
                if($_FILES['profile_image']['name'] != '')
                {

                    $uploadedFiles = handle_file_upload($id,'profile_image', 'profile_image');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'profile_image', [$file]);
                        }
                    }

                }
                    set_alert('success', _l('updated_successfully', _l('Employee')));
                redirect(admin_url('employee'));
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('Employee'));
        } else {
            $article         = $this->employee_model->get($id);
           // echo '<pre>'; print_r($article); die;
            $data['article'] = $article;
        }
        $sheader_text = title_text('aside_menu_active', 'employee');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        $data['designation_res'] = $this->db->get_where(db_prefix().'designation')->result();
        $data['department_res'] = $this->db->get_where(db_prefix().'department')->result();
        $data['title']     = _l($sheader_text);
        $this->load->view('admin/employee/employee', $data);
    }

    public function change_emp_status($id, $status)
    {
        $data['active'] = $status;
        $this->db->where('userid', $id);
        $this->db->update(db_prefix().'contacts', $data);
        echo 1;
    }

    /* Delete article from database */
    public function delete_employee($id)
    {
        if (!has_permission('employee', '', 'delete')) {
            access_denied('employee');
        }
        if (!$id) {
            redirect(admin_url('employee'));
        }
        $response = $this->employee_model->delete_article($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('Employee')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('Employee')));
        }
        redirect(admin_url('employee'));
    }

    public function table()
    {
        if (!has_permission('employee', '', 'view')) {
            access_denied('employee');
        }
        
            $this->app->get_table_data('employee');
       
    }

    public function showEmployeeForm($id = '',$userid='')
      { 
            $checkid        =       $id;
            $checkuserid        =       $userid;
            $data['employee_data'] = $this->db->get_where(db_prefix().'employee', array('id' => $checkid,'userid' => $userid))->row();
            $data['contact_data'] = $this->db->get_where(db_prefix().'contacts', array('userid' => $userid))->row();
            // echo $this->db->last_query(); die;
            $data['title'] = _l('Employee Form');
            //echo"<pre>";print_r($data);die;

            $this->load->view('admin/reports/showEmployeeForm', $data);
      }
}