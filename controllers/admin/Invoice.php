<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('invoice_model');
    }

    /* List all knowledgebase articles */
    public function index()
    {
        if (!has_permission('invoice', '', 'view')) {
            access_denied('invoice');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('invoice');
        }
       
        $sheader_text = title_text('aside_menu_active', 'invoice');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        $data['client_list']=$this->invoice_model->getClientList();
        $data['title']     = _l($sheader_text);
        $this->load->view('admin/invoice/invoices', $data);
    }

    /* Add new article or edit existing*/
    public function add($id = '')
    {
        if (!has_permission('invoice', '', 'view')) {
            access_denied('invoice');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('invoice');
        }
        if ($this->input->post()) {
            $data                = $this->input->post();
            
            if ($id == '') {
                if (!has_permission('invoice', '', 'create')) {
                    access_denied('invoice');
                }
                $data['created_date'] = date('Y-m-d H:i:s');
                $data['added_by'] = 0;
                $id = $this->invoice_model->add_article($data);
                if ($id) {
                    $uploadedFiles = handle_file_upload($id,'invoice', 'invoice');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'invoice', [$file]);
                        }
                    }
                    set_alert('success', _l('added_successfully', _l('Invoice')));
                    redirect(admin_url('invoice'));
                }
            } else {
                if (!has_permission('invoice', '', 'edit')) {
                    access_denied('invoice');
                }
                $success = $this->invoice_model->update_article($data, $id);
                if($_FILES['invoice']['name'] != '')
                {
                    $this->invoice_model->delete_image($id);
                    $uploadedFiles = handle_file_upload($id,'invoice', 'invoice');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'invoice', [$file]);
                        }
                    }
                }
                
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('Invoice')));
                }
                redirect(admin_url('invoice'));
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('Invoice'));
        } else {
            $article         = $this->invoice_model->get($id);
           // echo '<pre>'; print_r($article); die;
            $data['article'] = $article;
        }
        $sheader_text = title_text('aside_menu_active', 'invoice');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        $data['clients_list'] = $this->db->select('userid,firstname,lastname')->get_where(db_prefix().'contacts', array('role' => 2))->result();
        $data['title']     = _l($sheader_text);
        $this->load->view('admin/invoice/invoice', $data);
    }

    public function change_emp_status($id, $status)
    {
        $data['status'] = $status;
        $this->db->where('id', $id);
        $this->db->update(db_prefix().'roster_invoice', $data);
        echo 1;
    }

    /* Delete article from database */
    public function delete_invoice($id)
    {
        if (!has_permission('invoice', '', 'delete')) {
            access_denied('invoice');
        }
        if (!$id) {
            redirect(admin_url('invoice'));
        }
        $response = $this->invoice_model->delete_article($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('Invoice')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('Invoice')));
        }
        redirect(admin_url('invoice'));
    }
    
    /* check Invoice number from database */
    public function checkInvoice()
    {
        if ($this->input->is_ajax_request()) {
            $res = $this->db->get_where(db_prefix().'roster_invoice',$this->input->post())->result_array();
            echo count($res);
        }
    }

    public function filterByClient(){
        $this->app->get_table_data('invoice');
    }
}
