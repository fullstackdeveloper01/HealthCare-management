<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Incident extends ClientsController
{
  
    public function __construct()
    {
        parent::__construct();
        hooks()->do_action('after_clients_area_init', $this);

         $this->load->model('common_model');
         $this->load->library('pagination');

    }

    public function index()
    { 
  
        // By default only open tickets
        $data['bodyclass']     = 'incident';
        $data['incidents']       = $this->common_model->getData('tblreport_incident');

        $data['title']         = _l('clients_tickets_heading');
        $this->data($data);
        $this->view('incident');
        $this->layout();
    }

    public function edit($id)
    { 
         $where_array = array('id'=>$id);
         // By default only open tickets
        $data['bodyclass']     = 'incident';
        $incident = $this->common_model->getData('tblreport_incident', $where_array, 'single');
        if($incident)
        {
            foreach($incident as $key=>$val)
            {
                if(is_null($val) || empty($val) || $val == 'null')
                {
                    $incident->$key = '';
                }   
            }
        }
        $data['incident']       = $incident;
        $data['title']         = _l('clients_tickets_heading');
        //echo"<pre>";print_r($data);echo"</pre>";//die;
        $this->data($data);
        $this->view('incident_edit');
        $this->layout();
    }

    public function update()
    {
        //  echo "<pre>";
        $data   = $this->input->post(); 
        // print_r($data);die;
        // print_r($_FILES);
        $id = $data['id'];
        
        $where_array = array('id'=>$id);

        if( isset($data['signatureFile']) && !empty( $data['signatureFile']) )
        {
            $data_uri = $this->input->post('signatureFile'); 
            $data['cb_signature_base'] = $data_uri;

        }else if($_FILES['chooseFile']['name'] != '')
        {
            $uploadedFiles = handle_file_upload($data['id'],'incident', 'chooseFile');
            $file_url     = site_url().'uploads/incident/' . $id . '/'.$uploadedFiles[0]['file_name'];
            // $file_name = 'signature_'.$id.'_'.time();
            $data['cb_signature'] = $file_url;
        } 

         // print_r($data); 
         // die;
        unset($data['signatureFile']);
        unset($data['id']);
        $this->common_model->updateData('tblreport_incident', $where_array,  $data);
        // $where_array
        $incident = $this->db->get_where('tblreport_incident',$where_array)->row();
        // echo($incident->userid);die;
        $where['userid']= get_client_user_id();
        $notificationdata['notify_type']='Incident';
        $notificationdata['notify_name']='Updates On Incident';
        $notificationdata['sender']=$this->db->get_where('tblcontacts',$where)->row('firstname');
        $message='Update On Incident <a href="javascript:void(0)">'.$incident->report_for.'</a>';
        $notificationdata['sender_id']=get_client_user_id();
        $notificationdata['receiver_id']=$incident->userid;
        $notificationdata['receiver']=$this->db->get_where('tblcontacts',['userid'=>$incident->userid])->row('firstname');;
        $notificationdata['title']=$incident->report_for;
        $notificationdata['message']=$message;
        // print_r($notificationdata);die;
        // $this->db->insert('tblnotification',$notificationdata);
        notification($notificationdata);
        redirect('/incident', 'refresh');
    }

    public function loadincdentData()
    {
        $result = $this->common_model->loadIncidentData();
        $data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
        {
            $no++;
            $row   = array();
           
            $row[] = '<span class="nowrap"> #'.$e_res->id.'</span>';
            $row[] = '<span class="nowrap">'.clientname($e_res->userid).'</span>';
            $row[] = '<span class="nowrap">'.clientname($e_res->client_id).'</span>';
            $row[] = '<span class="nowrap">' .date('d-m-Y h:i:s A', strtotime($incident->created_date)).'</span>';
            $row[] = '<a href="'.base_url().'clients/open_ticket"><span class="nowrap">' .'<span class="btn btn-xs text-white" style="background:#ff2d42">

            Open</span>'.'</span></a>';
            $row[] = '<span class="nowrap">' .'No Reply'.'</span>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($result),
            "recordsFiltered" => $this->common_model->count_IncidentFiltered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}