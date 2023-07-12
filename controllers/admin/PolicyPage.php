<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PolicyPage extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PolicyPage_model');
    }

    /* List all knowledgebase articles */
    public function index()
    {  
        // if (!has_permission('policyPage', '', 'view')) {
        //     access_denied('policyPage');
        // }

        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('policyPage');
        }       
        $sheader_text = setupTitle_text('aside_menu_active', 'master_front', 'policyPage');	

        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        
        $data['title']     = _l($sheader_text);
        $this->load->view('admin/policy_page/index', $data);
    }

    /* List all knowledgebase articles */
    public function create()
    { 
        // if (!has_permission('policyPage', '', 'view')) {
        //     access_denied('policyPage');
        // }

        $sheader_text = setupTitle_text('aside_menu_active', 'master_front', 'policyPage');
         
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        
        $data['title']     = _l($sheader_text);
        $this->load->view('admin/policy_page/add', $data);
    }


    /* Add new article or edit existing*/
    public function add($id = '')
    {
        // if (!has_permission('policyPage', '', 'view')) {
        //     access_denied('policyPage');
        // }
		if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('policyPage');
        }
        if ($this->input->post()) {

            $data  = $this->input->post();			
             
            // if (!has_permission('policyPage', '', 'create')) {
            //     access_denied('policyPage');
            // }
            $data['created_date'] = date('Y-m-d h:i:s');
            //$data['page_type'] = 'home'; 
            $id = $this->PolicyPage_model->add_article($data);
           
            if ($id) { 
                set_alert('success', _l('added_successfully', _l('policy page')));
                redirect(admin_url('policyPage'));
            }else{
                set_alert('error', _l('Something went wrong, Please try again', _l('policy page')));
                redirect(admin_url('policyPage/create'));
            }   
        }
    }

    /* Add new article or edit existing*/
    public function edit($id = '')
    {
        if (!has_permission('policyPage', '', 'view')) {
            access_denied('policyPage');
        }
		if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('home_about');
        }
        if ($this->input->post()) {
            $data  = $this->input->post();	 
            if (!has_permission('policyPage', '', 'edit')) {
                access_denied('policyPage');
            }

            $success = $this->PolicyPage_model->update_article($data, $id);  
            
            if ($success) {
                set_alert('success', _l('updated_successfully', _l('Policy page')));
            }
            redirect(admin_url('policyPage'));
            
        }
        
        if ($id == '') {
        } else {
            $article         = $this->PolicyPage_model->get($id);
            $data['article'] = $article;
        }
        
        $sheader_text = setupTitle_text('aside_menu_active', 'master_front', 'slider');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;

        $data['title']     = _l($sheader_text);
        $this->load->view('admin/policy_page/edit', $data);
    }

    /**
    * @funciton: Status change
    */
    public function change_status($id, $status)
    {
        if ($this->input->is_ajax_request()) {
        
            $postdata['status'] = $status;
            $this->db->where('id', $id);
            $this->db->update(db_prefix().'policy_page', $postdata);
        }
    }

    /* Delete article from database */
    public function delete($id)
    {
        if (!has_permission('policyPage', '', 'delete')) {
            access_denied('policyPage');
        }
        if (!$id) {
            redirect(admin_url('policyPage'));
        }
        $this->PolicyPage_model->delete_article($id);        
        set_alert('success', _l('deleted', _l('policyPage')));
        redirect(admin_url('policyPage'));
    }
}
