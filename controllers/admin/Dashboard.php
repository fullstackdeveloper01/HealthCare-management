<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model');
    }

    /* This is admin dashboard view */
    public function index()
    {
        close_setup_menu();
        $this->load->model('departments_model');
        $this->load->model('todo_model');
        $data['departments'] = $this->departments_model->get();

        $data['todos'] = $this->todo_model->get_todo_items(0);
        // Only show last 5 finished todo items
        $this->todo_model->setTodosLimit(5);
        $data['todos_finished']            = $this->todo_model->get_todo_items(1);
        $data['upcoming_events_next_week'] = $this->dashboard_model->get_upcoming_events_next_week();
        $data['upcoming_events']           = $this->dashboard_model->get_upcoming_events();
        $data['title']                     = _l('dashboard_string');
        $this->load->model('currencies_model');
        $data['currencies']    = $this->currencies_model->get();
        $data['base_currency'] = $this->currencies_model->get_base_currency();
        $data['activity_log']  = $this->misc_model->get_activity_log();
        // Tickets charts
        $tickets_awaiting_reply_by_status     = $this->dashboard_model->tickets_awaiting_reply_by_status();
        $tickets_awaiting_reply_by_department = $this->dashboard_model->tickets_awaiting_reply_by_department();

        $data['tickets_reply_by_status']              = json_encode($tickets_awaiting_reply_by_status);
        $data['tickets_awaiting_reply_by_department'] = json_encode($tickets_awaiting_reply_by_department);

        $data['tickets_reply_by_status_no_json']              = $tickets_awaiting_reply_by_status;
        $data['tickets_awaiting_reply_by_department_no_json'] = $tickets_awaiting_reply_by_department;

        $data['client_graph_by_status'] = json_encode($this->dashboard_model->client_graph_by_status());
        
        $data['projects_status_stats'] = json_encode($this->dashboard_model->projects_status_stats());
        
        //echo '<pre>'; print_r(json_decode($data['client_graph_by_status'])); die;
        
        $data['leads_status_stats']    = json_encode($this->dashboard_model->leads_status_stats());
        $data['google_ids_calendars']  = $this->misc_model->get_google_calendar_ids();
        $data['bodyclass']             = 'dashboard invoices-total-manual';
        $this->load->model('announcements_model');
        $data['staff_announcements']             = $this->announcements_model->get();
        $data['total_undismissed_announcements'] = $this->announcements_model->get_total_undismissed_announcements();

        $this->load->model('projects_model');
        $data['projects_activity'] = $this->projects_model->get_activity('', hooks()->apply_filters('projects_activity_dashboard_limit', 20));
        add_calendar_assets();
        $this->load->model('utilities_model');
        $this->load->model('estimates_model');
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();

        $this->load->model('proposals_model');
        $data['proposal_statuses'] = $this->proposals_model->get_statuses();

        $wps_currency = 'undefined';
        if (is_using_multiple_currencies()) {
            $wps_currency = $data['base_currency']->id;
        }
        $data['weekly_payment_stats'] = json_encode($this->dashboard_model->get_weekly_payments_statistics($wps_currency));

        $data['dashboard'] = true;

        $data['user_dashboard_visibility'] = get_staff_meta(get_staff_user_id(), 'dashboard_widgets_visibility');

        if (!$data['user_dashboard_visibility']) {
            $data['user_dashboard_visibility'] = [];
        } else {
            $data['user_dashboard_visibility'] = unserialize($data['user_dashboard_visibility']);
        }
        $data['user_dashboard_visibility'] = json_encode($data['user_dashboard_visibility']);
        
        //$data['box_result'] = $this->db->get_where('tbldashboard_boxsetting')->result();
        $box_result = $this->db->get_where('tbldashboard_boxsetting')->result();
        if($box_result)
        {
            $ik = 0;
            foreach($box_result as $rr)
            {
                if($ik > 3)
                {
                    if($rr->value == '')
                    {
                        if($rr->link == 'clients')
                        {
                            $totalclient = $this->db->get_where(db_prefix().'contacts', array('role' => 2))->num_rows();
                            $box_result[$ik]->value = $totalclient;
                        }
                        elseif($rr->link == 'employee')
                        {
                            $totalclient = $this->db->get_where(db_prefix().'contacts', array('role' => 1))->num_rows();
                            $box_result[$ik]->value = $totalclient;
                        }
                        elseif($rr->link == 'proposals')
                        {
                            $totalclient = $this->db->get_where(db_prefix().'proposals')->num_rows();
                            $box_result[$ik]->value = $totalclient;
                        }
                        elseif($rr->link == 'estimates')
                        {
                            $totalclient = $this->db->get_where(db_prefix().'estimates')->num_rows();
                            $box_result[$ik]->value = $totalclient;
                        }
                        elseif($rr->link == 'invoices')
                        {
                            $totalclient = $this->db->get_where(db_prefix().'invoices')->num_rows();
                            $box_result[$ik]->value = $totalclient;
                        }
                        elseif($rr->link == 'payments')
                        {
                            $totalclient = $this->db->get_where(db_prefix().'invoicepaymentrecords')->num_rows();
                            $box_result[$ik]->value = $totalclient;
                        }
                    }
                }
                $ik++;
            }
        }
        //$data['agent_property'] = $this->db->order_by('id', 'desc')->limit(5)->get_where(db_prefix().'property')->result();
        //echo '<pre>'; print_r($box_result); die;
        $data['box_result'] = $box_result;
        $data = hooks()->apply_filters('before_dashboard_render', $data);
        $this->load->view('admin/dashboard/dashboard', $data);
    }

    /* Chart weekly payments statistics on home page / ajax */
    public function weekly_payments_statistics($currency)
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->dashboard_model->get_weekly_payments_statistics($currency));
            die();
        }
    }
}
