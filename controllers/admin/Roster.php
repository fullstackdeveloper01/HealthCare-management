<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Roster extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('roster_model');
    }

    /* List all knowledgebase articles */
    public function index()
    {
        
        if (!has_permission('roster', '', 'view')) {
            access_denied('roster');
        }
        if ($this->input->is_ajax_request()) {
            // echo 'if';die;
            // print_r($this->input->post());die;
            $this->app->get_table_data('roster');
        }
       
        $sheader_text = title_text('aside_menu_active', 'roster');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        $data['client_list']=$this->roster_model->getClientList();
        $data['title']     = _l($sheader_text);
        $this->load->view('admin/roster/rosters', $data);
    }

    /* Add new article or edit existing*/
    public function add($id = '')
    {
        // echo 'if';die;
        if (!has_permission('roster', '', 'view')) {
            access_denied('roster');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('roster');
        }
        if ($this->input->post()) {
            $data                = $this->input->post();
            
            if ($id == '') {
                // print_r($data);die;
                if (!has_permission('roster', '', 'create')) {
                    access_denied('roster');
                }
                // echo '<pre>'; print_r($data); die;
                if(isset($data['staff_idArr']) && count($data['staff_idArr']) > 0)
                {
                    // echo'if';die;
                    $addroster['created_date'] = date('Y-m-d H:i:s');
                    $addroster['client_id'] = $data['client_id'];
                    $addroster['staff_id'] = $data['staff_id'];
                    $addroster['service_id'] = $data['service_id'];
                    $addroster['start_date'] = $data['start_date'];
                    $addroster['end_date'] = $data['end_date'];
                    $addroster['time_from'] = $data['time_from'];
                    $addroster['time_to'] = $data['time_to'];
                    $addroster['description'] = $data['description'];
                    $addroster['added_by'] = 0;
                    
                    $id = $this->roster_model->add_article($addroster);
                    
                    for($m = 0; $m <= count($data['staff_idArr']); $m++)
                    {
                        if($data['staff_idArr'][$m] != '' && $data['start_dateArr'][$m] != '' && $data['end_dateArr'][$m] != '' && $data['time_fromArr'][$m] != '' && $data['time_toArr'][$m] != '' && $data['descriptionArr'][$m] != '')
                        {
                            $adddata['created_date'] = date('Y-m-d H:i:s');
                            $adddata['client_id'] = $data['client_id'];
                            $adddata['staff_id'] = $data['staff_idArr'][$m];
                            $adddata['service_id'] = $data['service_idArr'][$m];
                            $adddata['start_date'] = $data['start_dateArr'][$m];
                            $adddata['end_date'] = $data['end_dateArr'][$m];
                            $adddata['time_from'] = $data['time_fromArr'][$m];
                            $adddata['time_to'] = $data['time_toArr'][$m];
                            $adddata['description'] = $data['descriptionArr'][$m];
                            $adddata['added_by'] = 0;
                            
                            $id = $this->roster_model->add_article($adddata);
                        }
                    }
                    if ($id) {
                        set_alert('success', _l('added_successfully', _l('Roster')));
                        redirect(admin_url('roster'));
                    }
                }
                else
                {
                    // echo'else';
                    // print_r($data);die;
                    $data['created_date'] = date('Y-m-d H:i:s');
                    
                    $id = $this->roster_model->add_article($data);
                    // echo $id ;die;
                    if ($id) {
                        set_alert('success', _l('added_successfully', _l('Roster')));
                        redirect(admin_url('roster'));
                    }
                }
                    
            } else {
                if (!has_permission('roster', '', 'edit')) {
                    access_denied('roster');
                }
                $success = $this->roster_model->update_article($data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('Roster')));
                }
                redirect(admin_url('roster'));
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('Roster'));
            $data['article'] = '';
        } else {
            $article         = $this->roster_model->get($id);
            $data['article'] = $article;
        }
        $sheader_text = title_text('aside_menu_active', 'roster');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        $data['title']     = _l($sheader_text);
        $data['clients_list'] = $this->db->select('userid,firstname,lastname')->get_where(db_prefix().'contacts', array('role' => 2))->result();
        $data['employee_list'] = $this->db->select('userid,firstname,lastname')->get_where(db_prefix().'contacts', array('role' => 1))->result();
        $data['timeslot_list'] = $this->db->get_where(db_prefix().'timeslot')->result();
        $this->load->view('admin/roster/roster', $data);
    }

    public function change_emp_status($id, $status)
    {
        $data['status'] = $status;
        $this->db->where('id', $id);
        $this->db->update(db_prefix().'roster', $data);
        echo 1;
    }

    /* Delete article from database */
    public function delete_roster($id)
    {
        if (!has_permission('roster', '', 'delete')) {
            access_denied('roster');
        }
        if (!$id) {
            redirect(admin_url('roster'));
        }
        $response = $this->roster_model->delete_article($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('Roster')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('Roster')));
        }
        redirect(admin_url('roster'));
    }

    public function filterByClient(){
        $this->app->get_table_data('roster');
    }
}
