<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Careplan_assign_new extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('careplan_assign_model');
        $this->load->model('careplan_model');
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
        $data['response']=$this->db->select('tblcare_plan.*,tblcontacts.firstname')->from(db_prefix().'care_plan')->join(db_prefix() . 'contacts','tblcare_plan.client_id=tblcontacts.userid','right')->order_by('tblcare_plan.id','desc')->get()->result_array();
        // echo'<pre>';
        // print_r($data['response']);die;
        $this->load->view('admin/careplan_assigns_new/careplan_assigns', $data);
    }

    /* Add new article or edit existing*/
    public function add($id = '')
    {
        // echo'if';
        // die;
        if (!has_permission('careplan_assign', '', 'view')) {
            access_denied('careplan_assign');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('careplan_assign');
        }
        if ($this->input->post()) {
            $data                = $this->input->post();
            // print_r($data);die;
            if ($id == '') {
                if (!has_permission('careplan_assign', '', 'create')) {
                    access_denied('careplan_assign');
                }
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
                    redirect(admin_url('Careplan_assign_new'));
                }
                    
            } else {
                if (!has_permission('careplan_assign', '', 'edit')) {
                    access_denied('careplan_assign');
                }
                //print_r($_FILES['care_plan']);die;
                // if($_FILES['care_plan']['name'] != '')
                // {
                //     $this->careplan_model->delete_image($id);
                //     $uploadedFiles = handle_file_upload($id,'care_plan', 'care_plan');
                //     if ($uploadedFiles && is_array($uploadedFiles)) {
                //         foreach ($uploadedFiles as $file) {
                //             $this->misc_model->add_attachment_to_database($id, 'care_plan', [$file]);
                //         }
                //     }
                // } 

                if($_FILES['care_plan']['name'] != '')
                {
                    $uploadedFiles = handle_file_upload($id,'care_plan', 'care_plan');
                    $this->careplan_model->delete_image($id);
                    if ($uploadedFiles && is_array($uploadedFiles)) {//print_r($uploadedFiles);die;
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'care_plan', [$file]);
                        }
                    }
                }
                
                $success = $this->careplan_assign_model->update_article($data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('Care Plan Assign')));
                }
                redirect(admin_url('Careplan_assign_new'));
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
        $this->load->view('admin/careplan_assigns_new/careplan_assign', $data);
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
            redirect(admin_url('Careplan_assign_new'));
        }
        $response = $this->careplan_assign_model->delete_article($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('Care Plan Assign')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('Care Plan Assign')));
        }
        redirect(admin_url('Careplan_assign_new'));
    }
}
