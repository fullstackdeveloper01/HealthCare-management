<?php

defined('BASEPATH') or exit('No direct script access allowed');

class HomeAbout extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('homeAbout_model');
    }

    /* List all knowledgebase articles */
    public function index()
    { 
        if (!has_permission('homeAbout', '', 'view')) {
            access_denied('homeAbout');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('homeAbout');
        }       
        $sheader_text = setupTitle_text('aside_menu_active', 'master_front', 'homeAbout');	

        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        
        $data['title']     = _l($sheader_text);
        $this->load->view('admin/home_about/about', $data);
    }

    /* List all knowledgebase articles */
    public function create()
    { 
        if (!has_permission('homeAbout', '', 'view')) {
            access_denied('homeAbout');
        }

        $sheader_text = setupTitle_text('aside_menu_active', 'master_front', 'homeAbout');
         
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        
        $data['title']     = _l($sheader_text);
        $this->load->view('admin/home_about/add', $data);
    }


    /* Add new article or edit existing*/
    public function add($id = '')
    {
        if (!has_permission('homeAbout', '', 'view')) {
            access_denied('homeAbout');
        }
		if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('home_about');
        }
        if ($this->input->post()) {

            $data  = $this->input->post();			
             
            if (!has_permission('homeAbout', '', 'create')) {
                access_denied('homeAbout');
            }
            $data['created_date'] = date('Y-m-d h:i:s');
            //$data['page_type'] = 'home'; 
            $id = $this->homeAbout_model->add_article($data);
           
            if ($id) {
                
                $uploadedFiles = handle_file_upload($id,'home_about', 'home_about');
                if ($uploadedFiles && is_array($uploadedFiles)) {
                    foreach ($uploadedFiles as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'home_about', [$file]);
                    }
                }                    
                set_alert('success', _l('added_successfully', _l('Home about')));
                redirect(admin_url('homeAbout'));
            }else{
                set_alert('error', _l('Something went wrong, Please try again', _l('Home about')));
                redirect(admin_url('homeAbout/create'));
            }   
        }
    }

    /* Add new article or edit existing*/
    public function edit($id = '')
    {
        if (!has_permission('homeAbout', '', 'view')) {
            access_denied('homeAbout');
        }
		if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('home_about');
        }
        if ($this->input->post()) {
            $data  = $this->input->post();	 
            if (!has_permission('homeAbout', '', 'edit')) {
                access_denied('homeAbout');
            }
            $success = $this->homeAbout_model->update_article($data, $id);
            
            if($_FILES['home_about']['name'] != '')
            {
                $this->homeAbout_model->delete_image($id);
                $uploadedFiles = handle_file_upload($id,'home_about', 'home_about');
                if ($uploadedFiles && is_array($uploadedFiles)) {
                    foreach ($uploadedFiles as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'home_about', [$file]);
                    }
                }
            }
            
            if ($success) {
                set_alert('success', _l('updated_successfully', _l('homeAbout')));
            }
            redirect(admin_url('homeAbout'));
            
        }
        
        if ($id == '') {
        } else {
            $article         = $this->homeAbout_model->get($id);
            $data['article'] = $article;
        }
        
        $sheader_text = setupTitle_text('aside_menu_active', 'master_front', 'slider');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;

        $data['title']     = _l($sheader_text);
        $this->load->view('admin/home_about/edit', $data);
    }

    /**
    * @funciton: Status change
    */
    public function change_status($id, $status)
    {
        if ($this->input->is_ajax_request()) {
        
            $postdata['status'] = $status;
            $this->db->where('id', $id);
            $this->db->update(db_prefix().'home_about', $postdata);
        }
    }

    /* Delete article from database */
    public function delete($id)
    {
        if (!has_permission('homeAbout', '', 'delete')) {
            access_denied('homeAbout');
        }
        if (!$id) {
            redirect(admin_url('homeAbout'));
        }
        $this->homeAbout_model->delete_article($id);        
        set_alert('success', _l('deleted', _l('Home About')));
        redirect(admin_url('homeAbout'));
    }
}
