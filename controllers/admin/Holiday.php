<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Holiday extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('holiday_model');
    }

    /* List all knowledgebase articles */
    public function index()
    {
        if (!has_permission('holiday', '', 'view')) {
            access_denied('holiday');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('holiday');
        }
       
        $sheader_text = setupTitle_text('aside_menu_active', 'reports', 'holiday');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        
        $data['title']     = _l($sheader_text);
        $this->load->view('admin/holiday/holidays', $data);
    }

    /* Add new article or edit existing*/
    public function add($id = '')
    {
        if (!has_permission('holiday', '', 'view')) {
            access_denied('holiday');
        }
        if ($this->input->post()) {
            $data                = $this->input->post();
            
            if ($id == '') {
                if (!has_permission('holiday', '', 'create')) {
                    access_denied('holiday');
                }
                $data['from_date'] = date('Y-m-d', strtotime($data['from_date']));
                $data['to_date'] = date('Y-m-d', strtotime($data['to_date']));
                $data['created_date'] = date('Y-m-d H:i:s');
                $id = $this->holiday_model->add_article($data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('Holiday')));
                    redirect(admin_url('holiday'));
                }
            } else {
                if (!has_permission('holiday', '', 'edit')) {
                    access_denied('holiday');
                }
                $data['from_date'] = date('Y-m-d', strtotime($data['from_date']));
                $data['to_date'] = date('Y-m-d', strtotime($data['to_date']));
                
                $success = $this->holiday_model->update_article($data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('Holiday')));
                }
                redirect(admin_url('holiday'));
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('Holiday'));
        } else {
            $article         = $this->holiday_model->get($id);
            $data['article'] = $article;
        }
        $sheader_text = setupTitle_text('aside_menu_active', 'reports', 'holiday');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;

        $data['title']     = _l($sheader_text);
        $this->load->view('admin/holiday/holiday', $data);
    }

    /* Delete article from database */
    public function delete_holiday($id)
    {
        if (!has_permission('holiday', '', 'delete')) {
            access_denied('holiday');
        }
        if (!$id) {
            redirect(admin_url('holiday'));
        }
        $response = $this->holiday_model->delete_article($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('Holiday')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('Holiday')));
        }
        redirect(admin_url('holiday'));
    }
}
