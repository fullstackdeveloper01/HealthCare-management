<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Careplan_assign extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('careplan_assign_model');
    }

    /* List all knowledgebase articles */
    public function index()
    {
        if (!has_permission('careplan_assign', '', 'view')) {
            access_denied('careplan_assign');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('careplan_assign');
        }
       
        $sheader_text = title_text('aside_menu_active', 'careplan_assign');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        
        $data['title']     = _l($sheader_text);
        
        $this->load->view('admin/careplan_assign/careplan_assigns', $data);
    }

    /* Add new article or edit existing*/
    public function add($id = '')
    {
        if (!has_permission('careplan_assign', '', 'view')) {
            access_denied('careplan_assign');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('careplan_assign');
        }
        if ($this->input->post()) {
            $data                = $this->input->post();
            //echo "<pre>";print_r($data);die;
            // print_r($_FILES);die;
            if ($id == '') {
                if (!has_permission('careplan_assign', '', 'create')) {
                    access_denied('careplan_assign');
                }
                //echo '<pre>'; print_r($data); die;
                // if(count($data['plan_idArr'] > 0))
                if(isset($_FILES['care_planArr'])&&count($_FILES['care_planArr'])> 0)
                {
                    $plan_info1 = $this->db->get_where(db_prefix() . 'care_plan',array('id' =>$data['plan_id']))->row();
                    $addcareplan_assign['created_date'] = date('Y-m-d H:i:s');
                    $addcareplan_assign['userid'] = $data['userid'];
                    $addcareplan_assign['plan_id'] = $data['plan_id'];
                    $addcareplan_assign['plan_title'] = $plan_info1->title;
                    $addcareplan_assign['plan_officer'] = $plan_info1->officer;
                    
                    $id = $this->careplan_assign_model->add_article($addcareplan_assign);
                    
                    for($m = 0; $m <= count($data['plan_idArr']); $m++)
                    {
                        if($data['plan_idArr'][$m] != '' )
                        {
                            $plan_info = $this->db->get_where(db_prefix() . 'care_plan',array('id' =>$data['plan_idArr'][$m]))->row();
                            $adddata['created_date'] = date('Y-m-d H:i:s');
                            $adddata['userid'] = $data['userid'];
                            $adddata['plan_id'] = $data['plan_idArr'][$m];
                            $adddata['plan_title'] = $plan_info->title;
                            $adddata['plan_officer'] = $plan_info->officer;
                            
                            $id = $this->careplan_assign_model->add_article($adddata);
                        }
                    }
                    if ($id) {
                        set_alert('success', _l('added_successfully', _l('Care Plan Assign')));
                        redirect(admin_url('careplan_assign'));
                    }
                }
                else
                {
                    // echo 'else';die;
                    $data['created_date'] = date('Y-m-d H:i:s');
                    $id = $this->careplan_assign_model->add_article($data);
                    // echo $id;die;
                    if ($id) {
                        $uploadedFiles = handle_file_upload($id,'care_plan', 'care_plan');
                   
                        if ($uploadedFiles && is_array($uploadedFiles)) {               
                            foreach ($uploadedFiles as $file) {
                                $this->misc_model->add_attachment_to_database($id, 'care_plan', [$file]);
                            }
                        }
                        set_alert('success', _l('added_successfully', _l('Care Plan Assign')));
                        redirect(admin_url('careplan_assign'));
                    }
                }
                    
            } else {
                if (!has_permission('careplan_assign', '', 'edit')) {
                    access_denied('careplan_assign');
                }
                $success = $this->careplan_assign_model->update_article($data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('Care Plan Assign')));
                }
                redirect(admin_url('careplan_assign'));
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('careplan_assign'));
            $data['article'] = '';
        } else {
            $article         = $this->careplan_assign_model->get($id);
            $data['article'] = $article;
        }
        $sheader_text = title_text('aside_menu_active', 'careplan_assign');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        $data['title']     = _l($sheader_text);
        $data['clients_list'] = $this->db->select('userid,firstname,lastname')->get_where(db_prefix().'contacts', array('role' => 2))->result();
        
        $data['care_plan_list'] = $this->db->get_where(db_prefix().'care_plan')->result();
        $this->load->view('admin/careplan_assign/careplan_assign', $data);
    }

    public function change_emp_status($id, $status)
    {
        $data['status'] = $status;
        $this->db->where('id', $id);
        $this->db->update(db_prefix().'careplan_assign', $data);
        echo 1;
    }

    /* Delete article from database */
    public function delete_careplan_assign($id)
    {
        if (!has_permission('careplan_assign', '', 'delete')) {
            access_denied('careplan_assign');
        }
        if (!$id) {
            redirect(admin_url('careplan_assign'));
        }
        $response = $this->careplan_assign_model->delete_article($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('Care Plan Assign')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('Care Plan Assign')));
        }
        redirect(admin_url('careplan_assign'));
    }
}
