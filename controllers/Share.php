<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Share extends ClientsController
{
    public function index()
    {
        $todaytime = time();
        if($todaytime)
        {
            $useridarr = [];
            $userdata = $this->db->select('userid')->get_where(db_prefix().'contacts', array('plan_expired < ' => $todaytime))->result();
            if($userdata)
            {
                foreach($userdata as $rr)
                {
                    array_push($useridarr, $rr->userid);
                }
                
                if($useridarr)
                {
                    $propertydata['status'] = 0;
                    $this->db->where_in('agent_id', $useridarr);
                    $this->db->update(db_prefix().'property', $propertydata);
                    
                    $userupdate['property_limit'] = 0;
                    $this->db->where_in('agent_id', $useridarr);
                    $this->db->update(db_prefix().'property', $propertydata);
                }
            }
        }
        
        $id = $_GET['e'];
        $propertyRes = $this->db->get_where(db_prefix().'property', array('id' => $id, 'status' => 1))->row();
        
        $expirydate = $this->db->get_where(db_prefix().'contacts', array('userid' => $propertyRes->agent_id))->row('plan_expired');
        if($expirydate > time())
        {
            $data['propertyRes'] = $propertyRes;
        }
        else
        {
            $data['propertyRes'] = '';
        }
        //$setTime = $this->db->get_where(db_prefix().'user_calendar', array('userid' => $propertyRes->agent_id))->row('setTime');
        $setTime = $this->db->get_where(db_prefix().'property_calender', array('property_id' => $id))->row('setTime');
        $data['setTime'] = $setTime;
        $propertyDocRes = $this->db->get_where(db_prefix().'property_doc', array('property_id' => $id))->result();
        $data['propertyDocRes'] = $propertyDocRes;
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Name', 'required|strip_tags');
            $this->form_validation->set_rules('brokerage', 'brokerage', 'required|strip_tags');
            $this->form_validation->set_rules('license', 'license', 'required|strip_tags');
            $this->form_validation->set_rules('phone', 'phone', 'required|strip_tags');
            $this->form_validation->set_rules('email', 'Email', 'required|strip_tags');
            $this->form_validation->set_rules('available_time', 'Time', 'required|strip_tags');
            $this->form_validation->set_rules('appointment_date', 'Appointment date', 'required|strip_tags');
            if ($this->form_validation->run() == FALSE)
            {
                set_alert('warning', _l('All fields are required!'));
                redirect($_SERVER['HTTP_REFERER']);
            }
            else
            {
                $postdata = $this->input->post();
                
                $postdata['appointment_date'] = date('Y-m-d', strtotime($postdata['appointment_date']));
                $this->db->insert(db_prefix().'appointment_booking',$postdata);
                $lastID = $this->db->insert_id();
                
                if($lastID)
                {
                    $propertyDocRes = $this->db->get_where(db_prefix().'property_doc', array('property_id' => $postdata['property_id']))->result();
                    if($propertyDocRes)
                    {
                        foreach($propertyDocRes as $c)
                        {
                            if($_FILES['doc'.$c->id]['name'] != '')
                            {
                                $allowed = array('pdf', 'png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'zip', 'rar', 'txt');
                                $filename = $_FILES['doc'.$c->id]['name'];
                                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                                if (!in_array($ext, $allowed)) {
                                   
                                }
                                else
                                {
                                    $logoname = 'doc_'.$c->id.'.'.$ext;
                                    move_uploaded_file($_FILES['doc'.$c->id]['tmp_name'], 'uploads/appointmentDoc/'.$logoname);
                                    $postdoc['appointment_booking_id'] = $lastID;
                                    $postdoc['doc_id'] = $c->id;
                                    $postdoc['doc'] = $logoname;
                                    
                                    $this->db->insert(db_prefix().'client_appointmentDoc',  $postdoc);
                                   // echo $this->db->last_query(); 
                                }
                            }
                        }
                    }      
                    
                    $property = $this->db->select('name, agent_id, address')->get_where(db_prefix().'property', array('id' => $postdata['property_id']))->row();
                    $agentRes = $this->db->select('email,firstname,lastname')->get_where(db_prefix().'contacts', array('userid' => $property->agent_id))->row();
                    $subject = 'Appointment Confirmed - '.$property->address.' - '.date('m-d-Y', strtotime($postdata['appointment_date'])).' '.$postdata['available_time'];
                    $agentmsg = '<p>Property title: '.$property->name;
                    $agentmsg .= '<br>Client Name: '.$postdata['name'];
                    $agentmsg .= '<br>Client Email: '.$postdata['email'];
                    $agentmsg .= '<br>Address: '.$property->address;
                    $agentmsg .= '<br>Date: '.date('m-d-Y', strtotime($postdata['appointment_date']));
                    $agentmsg .= '<br>Time: '.$postdata['available_time'];
                    $agentmsg .= '<br>Details link: <a href="'.base_url().'clients/appointmentDetails/'.$lastID.'">Click here...</a>';
                    $agentmsg .= '<p>';
                    $data['msg'] = $agentmsg;
                    $tempmsg = $this->load->view('emailtemp', $data, true);
                    send_mail_SMT($agentRes->email, $subject, $tempmsg);
                    
                    /** Email to client **/
                    $_agentmsg = '<p>Property title: '.$property->name;
                    $_agentmsg .= '<br>Agent Name: '.$agentRes->firstname.' '.$agentRes->lastname;
                    $_agentmsg .= '<br>Email: '.$agentRes->email;
                    $_agentmsg .= '<br>Property Address: '.$property->address;
                    $_agentmsg .= '<br>Date: '.date('m-d-Y', strtotime($postdata['appointment_date']));
                    $_agentmsg .= '<br>Time: '.$postdata['available_time'];
                    $_agentmsg .= '<br>Details link: <a href="'.base_url().'share/appointmentDetails/'.$lastID.'">Click here...</a>';
                    $_agentmsg .= '<p>';
                    $data_['msg'] = $_agentmsg;
                    $tempmsg_ = $this->load->view('emailtemp', $data_, true);
                    send_mail_SMT($postdata['email'], $subject, $tempmsg_);
                    
                    /*
                    $adminmsg = '<p><b>Agent name </b> '.get_company_name($property->agent_id);
                    $adminmsg .= '<p><b>Property title:</b> '.$property->name;
                    $adminmsg .= '<br><b>Client Name:</b> '.$postdata['name'];
                    $adminmsg .= '<br><b>Client Email:</b> '.$postdata['email'];
                    $adminmsg .= '<br><b>Date:</b> '.date('d-m-Y', strtotime($postdata['appointment_date']));
                    $adminmsg .= '<br><b>Time:</b> '.$postdata['available_time'];
                    $adminmsg .= '<p>';
                    send_mail_SMT(ADMIN_EMAIL, $subject, $adminmsg);
                    */
                }
                
                set_alert('success', _l('Book An Appointment Successfully'));
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        
        $data['title'] = _l('Share');
        $this->data($data);
        $this->view('share');
        $this->layout();
    }
    
    /**
    *   @appointmentDetails
    */
    public function appointmentDetails($id)
    {
        if($id)
        {
            $data['title'] = 'Appointment Details';
            $appointmentdetail = $this->db->get_where(db_prefix().'appointment_booking', array('id' => $id))->row();
            $data['appointmentDetail'] = $appointmentdetail;
            $data['propertyDetails'] = $this->db->select('name,address,status,id,agent_id')->get_where(db_prefix().'property', array('id' => $appointmentdetail->property_id))->row();
            $data['appointmentDoc'] = $this->db->get_where(db_prefix().'client_appointmentDoc', array('appointment_booking_id' => $appointmentdetail->id))->result();
            $this->data($data);
            $this->view('appointmentLinkDetails');
            $this->layout();
        }
        else
        {
            set_alert('warning', _l('Some error occurred'));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
     /**
    *   @changeStatus
    */
    public function changeStatus()
    {
        $id = $_POST['id'];
        $data['status'] = 2;
        $appointment = $this->db->get_where(db_prefix().'appointment_booking', array('id' => $id))->row();
        $agentID = $this->db->get_where(db_prefix().'property', array('id' => $appointment->property_id))->row('agent_id');
        $this->db->where('id', $id);
        $this->db->update(db_prefix().'appointment_booking', $data);
        $agentRes = $this->db->select('email,firstname,lastname')->get_where(db_prefix().'contacts', array('userid' => $agentID))->row();
        
        $propertyname = $this->db->select('name,address')->get_where(db_prefix().'property', array('id' => $appointment->property_id))->row();
        $subject = 'Appointment cancel by client';
        $subject_ = 'Appointment cancel by you';
        $agentmsg = '<p>Property Title: '.$propertyname->name;
        $agentmsg .= '<p>Property Address: '.$propertyname->address;
        $agentmsg .= '<br>Agent Name: '.$agentRes->firstname.' '.$agentRes->lastname;
        $agentmsg .= '<br>Agent Email: '.$agentRes->email;
        $agentmsg .= '<br>Date: '.date('d-m-Y', $appointment->appointment_date);
        $agentmsg .= '<br>Time: '.$appointment->available_time;
        $agentmsg .= '<p>';
        
        $data['msg'] = $agentmsg;
        $tempmsg = $this->load->view('emailtemp', $data, true);
        
        send_mail_SMT($appointment->email, $subject_, $tempmsg);
        
        $_agentmsg = '<p>Property Title: '.$propertyname->name;
        $_agentmsg .= '<p>Property Address: '.$propertyname->address;
        $_agentmsg .= '<br>Client Name: '.$appointment->name;
        $_agentmsg .= '<br>Client Email: '.$appointment->email;
        $_agentmsg .= '<br>Date: '.date('d-m-Y', $appointment->appointment_date);
        $_agentmsg .= '<br>Time: '.$appointment->available_time;
        $_agentmsg .= '<p>';
        
        $data_['msg'] = $_agentmsg;
        $tempmsg_ = $this->load->view('emailtemp', $data_, true);
        
        send_mail_SMT($agentRes->email, $subject, $tempmsg_);
        
        echo 1;
    }
    
    /* searchDate */
    public function searchDate()
    {
        $ID = $_POST['ID'];
        $date = $_POST['appointment_date'];
        $date_ = date('Y-m-d', strtotime($date));
        $datetime = $this->db->get_where(db_prefix().'appointment_booking', array('appointment_date' => $date_, 'property_id' => $ID))->result();
        $html = '';
        $arr = [];
        if($datetime)
        {
            foreach($datetime as $rrr)
            {
                array_push($arr, $rrr->available_time);
            }
        }
        $data['arr'] = $arr;
        $agentid = $this->db->get_where(db_prefix().'property', array('id' => $ID))->row('agent_id');
        //$setTime = $this->db->get_where(db_prefix().'user_calendar', array('userid' => $agentid))->row('setTime');
        $calstatus = $this->db->get_where(db_prefix().'property_calender', array('property_id' => $ID))->row();
        $data['setTime'] = $calstatus->setTime;
        $html = $this->load->view('themes/perfex/views/bookdatetime', $data);
    }
}
