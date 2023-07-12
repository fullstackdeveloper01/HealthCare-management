<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class ServiceAgreements extends MY_Controller {

    /**
     * Construct : A method to load all the helper, language and model files
     * validation_helper
     */
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('api/client_model','api_model',true);
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Kolkata'); 
        $method = $this->router->fetch_method(); 
        $this->auth();
        
    }
    
    
    public function updateFeilds()
    {  
        // $client_id = 36;
        $client_id      =   $this->user_data->userid;
        $filed_name     =   $_POST['filed_name'];
        $filed_type     =   $_POST['filed_type'];  //image
        $field_value    =   $_POST['field_value'];
        $form_id        =   $_POST['form_id'];

        if($form_id==1)
        {
            $form_table =   db_prefix().'integrate_client_assessment';
        }
        else if($form_id==2)
        {
            $form_table =   db_prefix().'ndis_service_agreement';
        }
        else if($form_id==3)
        {
            $form_table =   db_prefix().'ndis_supplementary_service_agreement'; 
        }
        else if($form_id==4)
        {
            $form_table =   db_prefix().'private_clients_service_agreement';           
        }
        else
        {
            $form_table =   db_prefix().'add_aged_care_service_agreement';           
        }
        
        if($client_id!='')
        {

            if($_POST['id']!='')
            {
               
                $contactData['updated_date'] = date('Y-m-d H:i:s');
                $contactData[$filed_name] = $field_value;


                $this->db->where('client_id', $client_id);
                $this->db->where('id', $_POST['id']);
                $this->db->update($form_table, $contactData);
              
                if($this->db->affected_rows()==1)
                {
                    $this->db->where('client_id', $client_id);
                    $this->db->where('form_id', $form_id);
                    $this->db->update(db_prefix() . 'form_allot', [
                        'updated_date' => date('Y-m-d H:i:s'),
                    ]);
                    $msg = array('status' => true, 'message' =>'Successfully Updated!', 'result' =>$_POST['id']);

                }
                else
                {
                    $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
                }

            }
            else
            {
                
                $contactData['created_date'] = date('Y-m-d H:i:s');
                $contactData['client_id'] = $client_id;
                $contactData[$filed_name] = $field_value;

                
                $check = $this->db->get_where($form_table,array('client_id' => $client_id))->row();
                
                if(count($check)==0)
                {
                    $this->db->insert($form_table, $contactData);
                    $lid = $this->db->insert_id();
                    if($lid)
                    {

                        $this->db->where('client_id', $client_id);
                        $this->db->where('form_id', $form_id);
                        $this->db->update(db_prefix() . 'form_allot', [
                            'updated_date' => date('Y-m-d H:i:s'),
                        ]);
                        $msg = array('status' => true, 'message' =>'Successfully Added!', 'result' =>$lid);

                    }
                    else
                    {
                        $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
                    }
                }
                else
                {
                    $msg = array('status' => false, 'message' => 'Already Have Entry', 'result' =>array());
                }

            }
        }         
        else
        {
            $msg = array('status' => false, 'message' => 'Please Send All The Parameters ', 'result' =>array());
        }
        $this->response($msg, REST_Controller::HTTP_OK);
    }


    /*-------------------------------------------------------------------
    *@function Transport booking
    *-------------------------------------------------------------------*/
    public function addNdisServiceAgreement()
    {
        // $_POST = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        // $client_id = 36;
        $client_id = $this->user_data->userid;
        
        if($client_id!='' && $_POST['name'] != '' )
        {
            $count=0;
            if($client_id!='')
            {
                $count++;
                $contactData['client_id'] = $client_id;
            }
            if($_POST['name']!='')
            {
                $count++;
                $contactData['name'] = $_POST['name'];
            }
            if($_POST['dob']!='')
            {
                $count++;
                $contactData['dob'] = $_POST['dob'];
            }
            if($_POST['participant']!='')
            {
                $count++;
                $contactData['participant'] = $_POST['participant'];
            }
            if($_POST['ndis']!='')
            {
                $count++;
                $contactData['ndis'] = $_POST['ndis'];
            }
            if($_POST['transport_costs']!='')
            {
                $count++;
                $contactData['transport_costs'] = $_POST['transport_costs'];
            }
            if($_POST['schedule_of_supports']!='')
            {
                $count++;
                $contactData['schedule_of_supports'] = $_POST['schedule_of_supports'];
            }
            if($_POST['ndis_number']!='')
            {
                $count++;
                $contactData['ndis_number'] = $_POST['ndis_number'];
            }
            if($_POST['service_agreement_from']!='')
            {
                $count++;
                $contactData['service_agreement_from'] = $_POST['service_agreement_from'];
            }
            if($_POST['service_agreement_to']!='')
            {
                $count++;
                $contactData['service_agreement_to'] = $_POST['service_agreement_to'];
            }
            // 
            if($_POST['contact_name']!='')
            {
                $count++;
                $contactData['contact_name'] = $_POST['contact_name'];
            }
            if($_POST['contact_phone_bh']!='')
            {
                $count++;
                $contactData['contact_phone_bh'] = $_POST['contact_phone_bh'];
            }
            if($_POST['contact_phone_ah']!='')
            {
                $count++;
                $contactData['contact_phone_ah'] = $_POST['contact_phone_ah'];
            }
            if($_POST['contact_mobile']!='')
            {
                $count++;
                $contactData['contact_mobile'] = $_POST['contact_mobile'];
            }
            if($_POST['contact_email']!='')
            {
                $count++;
                $contactData['contact_email'] = $_POST['contact_email'];
            }
            if($_POST['contact_address']!='')
            {
                $count++;
                $contactData['contact_address'] = $_POST['contact_address'];
            }
            if($_POST['alternative_contact_person']!='')
            {
                $count++;
                $contactData['alternative_contact_person'] = $_POST['alternative_contact_person'];
            }
            // 
            if($_POST['provider_contact_name']!='')
            {
                $count++;
                $contactData['provider_contact_name'] = $_POST['provider_contact_name'];
            }
            if($_POST['provider_contact_phone_bh']!='')
            {
                $count++;
                $contactData['provider_contact_phone_bh'] = $_POST['provider_contact_phone_bh'];
            }
            if($_POST['provider_contact_phone_ah']!='')
            {
                $count++;
                $contactData['provider_contact_phone_ah'] = $_POST['provider_contact_phone_ah'];
            }
            if($_POST['provider_contact_mobile']!='')
            {
                $count++;
                $contactData['provider_contact_mobile'] = $_POST['provider_contact_mobile'];
            }
            if($_POST['provider_contact_email']!='')
            {
                $count++;
                $contactData['provider_contact_email'] = $_POST['provider_contact_email'];
            }
            if($_POST['provider_contact_address']!='')
            {
                $count++;
                $contactData['provider_contact_address'] = $_POST['provider_contact_address'];
            }

            // 
            if($_POST['participant_name']!='')
            {
                $count++;
                $contactData['participant_name'] = $_POST['participant_name'];
            }
            if($_POST['participant_date']!='')
            {
                $count++;
                $contactData['participant_date'] = $_POST['participant_date'];
            }
            // 
            if($_POST['participant_representative_name']!='')
            {
                $count++;
                $contactData['participant_representative_name'] = $_POST['participant_representative_name'];
            }
            if($_POST['participant_representative_date']!='')
            {
                $count++;
                $contactData['participant_representative_date'] = $_POST['participant_representative_date'];
            }
            // 
            if($_POST['ca_authorised_name']!='')
            {
                $count++;
                $contactData['ca_authorised_name'] = $_POST['ca_authorised_name'];
            }
            if($_POST['ca_authorised_date']!='')
            {
                $count++;
                $contactData['ca_authorised_date'] = $_POST['ca_authorised_date'];
            }
            // 


            if($_POST['consent']!='')
            {
                $count++;
                $contactData['consent'] = $_POST['consent'];
            }
            if($_POST['tick_applicable']!='')
            {
                $count++;
                $contactData['tick_applicable'] = $_POST['tick_applicable'];
            }

            // 
            if($_POST['participant2_name']!='')
            {
                $count++;
                $contactData['participant2_name'] = $_POST['participant2_name'];
            }
            if($_POST['participant2_date']!='')
            {
                $count++;
                $contactData['participant2_date'] = $_POST['participant2_date'];
            }
            if($_POST['participant2_representative_name']!='')
            {
                $count++;
                $contactData['participant2_representative_name'] = $_POST['participant2_representative_name'];
            }
            if($_POST['participant2_representative_date']!='')
            {
                $count++;
                $contactData['participant2_representative_date'] = $_POST['participant2_representative_date'];
            }
            if($_POST['agreement_checklist']!='')
            {
                $count++;
                $contactData['agreement_checklist'] = $_POST['agreement_checklist'];
            }

            if($_POST['id']!='')
            {
                        if($_POST['participant_signature_base']!='' && $_FILES['participant_signature']['name']=='')
                        {
                            $count++;
                            $contactData['participant_signature_base'] = $_POST['participant_signature_base'];
                            $contactData['participant_signature'] = '';
                        }
                        if($_POST['participant_signature_base']=='' && $_FILES['participant_signature']['name']!='')
                        {
                            $count++;
                            $contactData['participant_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($_POST['id'],'participant_signature', 'participant_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($_POST['id'], 'participant_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'participant_signature'))->row('file_name');

                            $contactData['participant_signature'] = base_url().'uploads/participant_signature/'.$_POST['id'].'/'.$filename;

                        }
                        if($_POST['participant_representative_signature_base']!='' && $_FILES['participant_representative_signature']['name']=='')
                        {
                            $count++;
                            $contactData['participant_representative_signature_base'] = $_POST['participant_representative_signature_base'];
                            $contactData['participant_representative_signature'] = '';
                        }
                        if($_POST['participant_representative_signature_base']=='' && $_FILES['participant_representative_signature']['name']!='')
                        {
                            $count++;
                            $contactData['participant_representative_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($_POST['id'],'participant_representative_signature', 'participant_representative_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($_POST['id'], 'participant_representative_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'participant_representative_signature'))->row('file_name');

                            $contactData['participant_representative_signature'] = base_url().'uploads/participant_representative_signature/'.$_POST['id'].'/'.$filename;

                        }
                        if($_POST['ca_authorised_signature_base']!='' && $_FILES['ca_authorised_signature']['name']=='')
                        {
                            $count++;
                            $contactData['ca_authorised_signature_base'] = $_POST['ca_authorised_signature_base'];
                            $contactData['ca_authorised_signature'] = '';
                        }
                        if($_POST['ca_authorised_signature_base']=='' && $_FILES['ca_authorised_signature']['name']!='')
                        {
                            $count++;
                            $contactData['ca_authorised_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($_POST['id'],'ca_authorised_signature', 'ca_authorised_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($_POST['id'], 'ca_authorised_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'ca_authorised_signature'))->row('file_name');

                            $contactData['ca_authorised_signature'] = base_url().'uploads/ca_authorised_signature/'.$_POST['id'].'/'.$filename;

                        }
                        if($_POST['participant2_signature_base']!='' && $_FILES['participant2_signature']['name']=='')
                        {
                            $count++;
                            $contactData['participant2_signature_base'] = $_POST['participant2_signature_base'];
                            $contactData['participant2_signature'] = '';
                        }
                        if($_POST['participant2_signature_base']=='' && $_FILES['participant2_signature']['name']!='')
                        {
                            $count++;
                            $contactData['participant2_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($_POST['id'],'participant2_signature', 'participant2_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($_POST['id'], 'participant2_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'participant2_signature'))->row('file_name');

                            $contactData['participant2_signature'] = base_url().'uploads/participant2_signature/'.$_POST['id'].'/'.$filename;

                        }
                        if($_POST['participant2_representative_signature_base']!='' && $_FILES['participant2_representative_signature']['name']=='')
                        {
                            $count++;
                            $contactData['participant2_representative_signature_base'] = $_POST['participant2_representative_signature_base'];
                            $contactData['participant2_representative_signature'] = '';
                        }
                        if($_POST['participant2_representative_signature_base']=='' && $_FILES['participant2_representative_signature']['name']!='')
                        {
                            $count++;
                            $contactData['participant2_representative_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($_POST['id'],'participant2_representative_signature', 'participant2_representative_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($_POST['id'], 'participant2_representative_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'participant2_representative_signature'))->row('file_name');

                            $contactData['participant2_representative_signature'] = base_url().'uploads/participant2_representative_signature/'.$_POST['id'].'/'.$filename;

                        }


            	$count++;
                $contactData['updated_date'] = date('Y-m-d H:i:s');
                $this->db->where('client_id', $client_id);
                $this->db->where('id', $_POST['id']);
                $this->db->update(db_prefix().'ndis_service_agreement', $contactData);
	            if($_POST['id'])
	            {
	                $totalCol = $this->db->get_where(db_prefix().'ndis_service_agreement')->num_fields();
	                $counttot = $count/$totalCol;
	                $mulcol = $counttot * 100;
	                $finalmulcol = round($mulcol,2);

	                $this->db->where('client_id', $client_id);
	                $this->db->where('form_id', 2);
	                $this->db->update(db_prefix() . 'form_allot', [
	                    'updated_date' => date('Y-m-d H:i:s'),
	                    'form_process' => $finalmulcol,
	                ]);
	                $msg = array('status' => true, 'message' =>'Successfully Updated!', 'result' =>$_POST['id']);

	            }
	            else
	            {
	                $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
	            }

            }
            else
            {
            	$count++;
                $contactData['created_date'] = date('Y-m-d H:i:s');
                $check = $this->db->get_where(db_prefix().'ndis_service_agreement',array('client_id' => $client_id))->row();
                if(count($check)==0)
                {
                	$this->db->insert(db_prefix().'ndis_service_agreement', $contactData);
    	            $lid = $this->db->insert_id();
    	            if($lid)
    	            {
                        if($_POST['participant_signature_base']!='' && $_FILES['participant_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['participant_signature_base'] = $_POST['participant_signature_base'];
                            $contactDataIMG['participant_signature'] = '';
                        }
                        if($_POST['participant_signature_base']=='' && $_FILES['participant_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['participant_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'participant_signature', 'participant_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'participant_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'participant_signature'))->row('file_name');

                            $contactDataIMG['participant_signature'] = base_url().'uploads/participant_signature/'.$lid.'/'.$filename;

                        }
                        if($_POST['participant_representative_signature_base']!='' && $_FILES['participant_representative_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['participant_representative_signature_base'] = $_POST['participant_representative_signature_base'];
                            $contactDataIMG['participant_representative_signature'] = '';
                        }
                        if($_POST['participant_representative_signature_base']=='' && $_FILES['participant_representative_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['participant_representative_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'participant_representative_signature', 'participant_representative_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'participant_representative_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'participant_representative_signature'))->row('file_name');

                            $contactDataIMG['participant_representative_signature'] = base_url().'uploads/participant_representative_signature/'.$lid.'/'.$filename;

                        }
                        if($_POST['ca_authorised_signature_base']!='' && $_FILES['ca_authorised_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['ca_authorised_signature_base'] = $_POST['ca_authorised_signature_base'];
                            $contactDataIMG['ca_authorised_signature'] = '';
                        }
                        if($_POST['ca_authorised_signature_base']=='' && $_FILES['ca_authorised_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['ca_authorised_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'ca_authorised_signature', 'ca_authorised_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'ca_authorised_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'ca_authorised_signature'))->row('file_name');

                            $contactDataIMG['ca_authorised_signature'] = base_url().'uploads/ca_authorised_signature/'.$lid.'/'.$filename;

                        }
                        if($_POST['participant2_signature_base']!='' && $_FILES['participant2_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['participant2_signature_base'] = $_POST['participant2_signature_base'];
                            $contactDataIMG['participant2_signature'] = '';
                        }
                        if($_POST['participant2_signature_base']=='' && $_FILES['participant2_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['participant2_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'participant2_signature', 'participant2_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'participant2_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'participant2_signature'))->row('file_name');

                            $contactDataIMG['participant2_signature'] = base_url().'uploads/participant2_signature/'.$lid.'/'.$filename;

                        }
                        if($_POST['participant2_representative_signature_base']!='' && $_FILES['participant2_representative_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['participant2_representative_signature_base'] = $_POST['participant2_representative_signature_base'];
                            $contactDataIMG['participant2_representative_signature'] = '';
                        }
                        if($_POST['participant2_representative_signature_base']=='' && $_FILES['participant2_representative_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['participant2_representative_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'participant2_representative_signature', 'participant2_representative_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'participant2_representative_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'participant2_representative_signature'))->row('file_name');

                            $contactDataIMG['participant2_representative_signature'] = base_url().'uploads/participant2_representative_signature/'.$lid.'/'.$filename;

                        }

                        $this->db->where('client_id', $client_id);
                        $this->db->where('id', $lid);
                        $this->db->update(db_prefix().'ndis_service_agreement', $contactDataIMG);

    	                $totalCol = $this->db->get_where(db_prefix().'ndis_service_agreement')->num_fields();
    	                $counttot = $count/$totalCol;
    	                $mulcol = $counttot * 100;
    	                $finalmulcol = round($mulcol,2);

    	                $this->db->where('client_id', $client_id);
    	                $this->db->where('form_id', 2);
    	                $this->db->update(db_prefix() . 'form_allot', [
    	                    'updated_date' => date('Y-m-d H:i:s'),
    	                    'form_process' => $finalmulcol,
    	                ]);
    	                $msg = array('status' => true, 'message' =>'Successfully Added!', 'result' =>$lid);

    	            }
    	            else
    	            {
    	                $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
    	            }
                }
                else
                {
                    $msg = array('status' => false, 'message' => 'Already Have Entry', 'result' =>array());
                }

        	}
        }         
        else
        {
            $msg = array('status' => false, 'message' => 'Please Send All The Parameters ', 'result' =>array());
        }
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    /*-------------------------------------------------------------------
    *@function Transport booking
    *-------------------------------------------------------------------*/
    public function addNdisSupplementaryServiceAgreement()
    {
        // $_POST = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $client_id = $this->user_data->userid;

        if($client_id!='' && $_POST['name'] != ''  )
        {
            $count=0;
            if($client_id!='')
            {
                $count++;
                $contactData['client_id'] = $client_id;
            }
            
            if($_POST['name']!='')
            {
                $count++;
                $contactData['name'] = $_POST['name'];
            }
            if($_POST['service_agreement_from']!='')
            {
                $count++;
                $contactData['service_agreement_from'] = $_POST['service_agreement_from'];
            }
            if($_POST['service_agreement_to']!='')
            {
                $count++;
                $contactData['service_agreement_to'] = $_POST['service_agreement_to'];
            // 
            }
            if($_POST['contact_name']!='')
            {
                $count++;
                $contactData['contact_name'] = $_POST['contact_name'];
            }
            if($_POST['contact_phone_bh']!='')
            {
                $count++;
                $contactData['contact_phone_bh'] = $_POST['contact_phone_bh'];
            }
            if($_POST['contact_phone_ah']!='')
            {
                $count++;
                $contactData['contact_phone_ah'] = $_POST['contact_phone_ah'];
            }
            if($_POST['contact_mobile']!='')
            {
                $count++;
                $contactData['contact_mobile'] = $_POST['contact_mobile'];
            }
            if($_POST['contact_email']!='')
            {
                $count++;
                $contactData['contact_email'] = $_POST['contact_email'];
            }
            if($_POST['contact_address']!='')
            {
                $count++;
                $contactData['contact_address'] = $_POST['contact_address'];
            }
            if($_POST['alternative_contact_person']!='')
            {
                $count++;
                $contactData['alternative_contact_person'] = $_POST['alternative_contact_person'];
            // 
            }
            if($_POST['provider_contact_name']!='')
            {
                $count++;
                $contactData['provider_contact_name'] = $_POST['provider_contact_name'];
            }
            if($_POST['provider_contact_phone_bh']!='')
            {
                $count++;
                $contactData['provider_contact_phone_bh'] = $_POST['provider_contact_phone_bh'];
            }
            if($_POST['provider_contact_phone_ah']!='')
            {
                $count++;
                $contactData['provider_contact_phone_ah'] = $_POST['provider_contact_phone_ah'];
            }
            if($_POST['provider_contact_mobile']!='')
            {
                $count++;
                $contactData['provider_contact_mobile'] = $_POST['provider_contact_mobile'];
            }
            if($_POST['provider_contact_email']!='')
            {
                $count++;
                $contactData['provider_contact_email'] = $_POST['provider_contact_email'];
            }
            if($_POST['provider_contact_address']!='')
            {
                $count++;
                $contactData['provider_contact_address'] = $_POST['provider_contact_address'];

            // 
            }
            if($_POST['participant_name']!='')
            {
                $count++;
                $contactData['participant_name'] = $_POST['participant_name'];
            }
            if($_POST['participant_date']!='')
            {
                $count++;
                $contactData['participant_date'] = $_POST['participant_date'];
            // 
            }
            if($_POST['participant_representative_name']!='')
            {
                $count++;
                $contactData['participant_representative_name'] = $_POST['participant_representative_name'];
            }
            if($_POST['participant_representative_date']!='')
            {
                $count++;
                $contactData['participant_representative_date'] = $_POST['participant_representative_date'];
            // 
            }
            if($_POST['authorised_name']!='')
            {
                $count++;
                $contactData['authorised_name'] = $_POST['authorised_name'];
            }
            if($_POST['authorised_date']!='')
            {
                $count++;
                $contactData['authorised_date'] = $_POST['authorised_date'];
            // 

            }
            if($_POST['schedule_of_supports']!='')
            {
                $count++;
                $contactData['schedule_of_supports'] = $_POST['schedule_of_supports'];
            // 

            }
            if($_POST['transport_costs']!='')
            {
                $count++;
                $contactData['transport_costs'] = $_POST['transport_costs'];
            // 

            }


            if($_POST['id']!='')
            {
            	$count++;
                $contactData['updated_date'] = date('Y-m-d H:i:s');
                if($_POST['nparticipant_signature_base']!='' && $_FILES['nparticipant_signature']['name']=='')
                {
                    $count++;
                    $contactData['nparticipant_signature_base'] = $_POST['nparticipant_signature_base'];
                    $contactData['nparticipant_signature'] = '';
                }
                if($_POST['nparticipant_signature_base']=='' && $_FILES['nparticipant_signature']['name']!='')
                {
                    $count++;
                    $contactData['nparticipant_signature_base'] = '';
                    
                    $uploadedFiles = handle_file_upload($_POST['id'],'nparticipant_signature', 'nparticipant_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'nparticipant_signature', [$file]);
                        }
                    }
                    $contactData['nparticipant_signature'] = '';

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'nparticipant_signature'))->row('file_name');
                    
                    $contactData['nparticipant_signature'] = base_url().'uploads/nparticipant_signature/'.$_POST['id'].'/'.$filename;

                }
                if($_POST['nparticipant_representative_signature_base']!='' && $_FILES['nparticipant_representative_signature']['name']=='')
                {
                    $count++;
                    $contactData['nparticipant_representative_signature_base'] = $_POST['nparticipant_representative_signature_base'];
                    $contactData['nparticipant_representative_signature'] = '';
                }
                if($_POST['nparticipant_representative_signature_base']=='' && $_FILES['nparticipant_representative_signature']['name']!='')
                {
                    $count++;
                    $contactData['nparticipant_representative_signature_base'] = '';
                    
                    $uploadedFiles = handle_file_upload($_POST['id'],'nparticipant_representative_signature', 'nparticipant_representative_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'nparticipant_representative_signature', [$file]);
                        }
                    }
                    $contactData['nparticipant_representative_signature'] = '';

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'nparticipant_representative_signature'))->row('file_name');
                    
                    $contactData['nparticipant_representative_signature'] = base_url().'uploads/nparticipant_representative_signature/'.$_POST['id'].'/'.$filename;

                }
                if($_POST['nca_authorised_signature_base']!='' && $_FILES['nca_authorised_signature']['name']=='')
                {
                    $count++;
                    $contactData['nca_authorised_signature_base'] = $_POST['nca_authorised_signature_base'];
                    $contactData['nca_authorised_signature'] = '';
                }
                if($_POST['nca_authorised_signature_base']=='' && $_FILES['nca_authorised_signature']['name']!='')
                {
                    $count++;
                    $contactData['nca_authorised_signature_base'] = '';
                    
                    $uploadedFiles = handle_file_upload($_POST['id'],'nca_authorised_signature', 'nca_authorised_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'nca_authorised_signature', [$file]);
                        }
                    }
                    $contactData['nca_authorised_signature'] = '';

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'nca_authorised_signature'))->row('file_name');
                    
                    $contactData['nca_authorised_signature'] = base_url().'uploads/nca_authorised_signature/'.$_POST['id'].'/'.$filename;

                }


                $this->db->where('client_id', $client_id);
                $this->db->where('id', $_POST['id']);
                $this->db->update(db_prefix().'ndis_supplementary_service_agreement', $contactData);
	            if($_POST['id'])
	            {
	                $totalCol = $this->db->get_where(db_prefix().'ndis_supplementary_service_agreement')->num_fields();
	                $counttot = $count/$totalCol;
	                $mulcol = $counttot * 100;
	                $finalmulcol = round($mulcol,2);

	                $this->db->where('client_id', $client_id);
	                $this->db->where('form_id', 3);
	                $this->db->update(db_prefix() . 'form_allot', [
	                    'updated_date' => date('Y-m-d H:i:s'),
	                    'form_process' => $finalmulcol,
	                ]);
	                $msg = array('status' => true, 'message' =>'Successfully Updated!', 'result' =>$_POST['id']);

	            }
	            else
	            {
	                $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
	            }

            }
            else
            {
            	$count++;
                $contactData['created_date'] = date('Y-m-d H:i:s');
                $check = $this->db->get_where(db_prefix().'ndis_supplementary_service_agreement',array('client_id' => $client_id))->row();
                if(count($check)==0)
                {

                    $this->db->insert(db_prefix().'ndis_supplementary_service_agreement', $contactData);
                    $lid = $this->db->insert_id();
                    if($lid)
                    {
                        if($_POST['nparticipant_signature_base']!='' && $_FILES['nparticipant_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['nparticipant_signature_base'] = $_POST['nparticipant_signature_base'];
                            $contactDataIMG['nparticipant_signature'] = '';
                        }
                        if($_POST['nparticipant_signature_base']=='' && $_FILES['nparticipant_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['nparticipant_signature_base'] = '';
                            
                            $uploadedFiles = handle_file_upload($lid,'nparticipant_signature', 'nparticipant_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'nparticipant_signature', [$file]);
                                }
                            }
                            

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'nparticipant_signature'))->row('file_name');

                            $contactDataIMG['nparticipant_signature'] = base_url().'uploads/nparticipant_signature/'.$lid.'/'.$filename;
                        }
                        if($_POST['nparticipant_representative_signature_base']!='' && $_FILES['nparticipant_representative_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['nparticipant_representative_signature_base'] = $_POST['nparticipant_representative_signature_base'];
                            $contactDataIMG['nparticipant_representative_signature'] = '';
                        }
                        if($_POST['nparticipant_representative_signature_base']=='' && $_FILES['nparticipant_representative_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['nparticipant_representative_signature_base'] = '';
                            
                            $uploadedFiles = handle_file_upload($lid,'nparticipant_representative_signature', 'nparticipant_representative_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'nparticipant_representative_signature', [$file]);
                                }
                            }
                            

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'nparticipant_representative_signature'))->row('file_name');

                            $contactDataIMG['nparticipant_representative_signature'] = base_url().'uploads/nparticipant_representative_signature/'.$lid.'/'.$filename;
                        }

                        if($_POST['nca_authorised_signature_base']!='' && $_FILES['nca_authorised_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['nca_authorised_signature_base'] = $_POST['nca_authorised_signature_base'];
                            $contactDataIMG['nca_authorised_signature'] = '';
                        }
                        if($_POST['nca_authorised_signature_base']=='' && $_FILES['nca_authorised_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['nca_authorised_signature_base'] = '';
                            
                            $uploadedFiles = handle_file_upload($lid,'nca_authorised_signature', 'nca_authorised_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'nca_authorised_signature', [$file]);
                                }
                            }
                            

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'nca_authorised_signature'))->row('file_name');

                            $contactDataIMG['nca_authorised_signature'] = base_url().'uploads/nca_authorised_signature/'.$lid.'/'.$filename;
                        }

                        $this->db->where('client_id', $client_id);
                        $this->db->where('id', $lid);
                        $this->db->update(db_prefix().'ndis_supplementary_service_agreement', $contactDataIMG);


                        $totalCol = $this->db->get_where(db_prefix().'ndis_supplementary_service_agreement')->num_fields();
                        $counttot = $count/$totalCol;
                        $mulcol = $counttot * 100;
                        $finalmulcol = round($mulcol,2);

                        $this->db->where('client_id', $client_id);
                        $this->db->where('form_id', 3);
                        $this->db->update(db_prefix() . 'form_allot', [
                            'updated_date' => date('Y-m-d H:i:s'),
                            'form_process' => $finalmulcol,
                        ]);
                        $msg = array('status' => true, 'message' =>'Successfully Added!', 'result' =>$lid);
                    }
                    else
                    {
                        $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
                    }

                }
                else
                {
                    $msg = array('status' => false, 'message' => 'Already Have Entry', 'result' =>array());
                }

        	}

            
        }         
        else
        {
            $msg = array('status' => false, 'message' => 'Please Send All The Parameters ', 'result' =>array());
        }
        $this->response($msg, REST_Controller::HTTP_OK);
    }   
     /*-------------------------------------------------------------------
    *@function Transport booking
    *-------------------------------------------------------------------*/
    public function addPrivateClientsServiceAgreement()
    {
        // $_POST = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $client_id = $this->user_data->userid;

        if($client_id!='' && $_POST['parties_name']!= '')
        {
           $count=0;
            if($client_id!='')
            {
                $count++;
                $contactData['client_id'] = $client_id;
            }
            
            if($_POST['parties_name']!='')
            {
                $count++;
                $contactData['parties_name'] = $_POST['parties_name'];
            }
            if($_POST['service_agreement_from']!='')
            {
                $count++;
                $contactData['service_agreement_from'] = $_POST['service_agreement_from'];
            }
            if($_POST['service_agreement_to']!='')
            {
                $count++;
                $contactData['service_agreement_to'] = $_POST['service_agreement_to'];
            // 
            }
            if($_POST['contact_name']!='')
            {
                $count++;
                $contactData['contact_name'] = $_POST['contact_name'];
            }
            if($_POST['contact_phone_bh']!='')
            {
                $count++;
                $contactData['contact_phone_bh'] = $_POST['contact_phone_bh'];
            }
            if($_POST['contact_phone_ah']!='')
            {
                $count++;
                $contactData['contact_phone_ah'] = $_POST['contact_phone_ah'];
            }
            if($_POST['contact_mobile']!='')
            {
                $count++;
                $contactData['contact_mobile'] = $_POST['contact_mobile'];
            }
            if($_POST['contact_email']!='')
            {
                $count++;
                $contactData['contact_email'] = $_POST['contact_email'];
            }
            if($_POST['contact_address']!='')
            {
                $count++;
                $contactData['contact_address'] = $_POST['contact_address'];
            }
            if($_POST['alternative_contact_person']!='')
            {
                $count++;
                $contactData['alternative_contact_person'] = $_POST['alternative_contact_person'];
            // 
            }
            if($_POST['provider_contact_name']!='')
            {
                $count++;
                $contactData['provider_contact_name'] = $_POST['provider_contact_name'];
            }
            if($_POST['provider_contact_phone_bh']!='')
            {
                $count++;
                $contactData['provider_contact_phone_bh'] = $_POST['provider_contact_phone_bh'];
            }
            if($_POST['provider_contact_phone_ah']!='')
            {
                $count++;
                $contactData['provider_contact_phone_ah'] = $_POST['provider_contact_phone_ah'];
            }
            if($_POST['provider_contact_mobile']!='')
            {
                $count++;
                $contactData['provider_contact_mobile'] = $_POST['provider_contact_mobile'];
            }
            if($_POST['provider_contact_email']!='')
            {
                $count++;
                $contactData['provider_contact_email'] = $_POST['provider_contact_email'];
            }
            if($_POST['provider_contact_address']!='')
            {
                $count++;
                $contactData['provider_contact_address'] = $_POST['provider_contact_address'];

            }
            if($_POST['participant_name']!='')
            {
                $count++;
                $contactData['participant_name'] = $_POST['participant_name'];
            }
            if($_POST['participant_date']!='')
            {
                $count++;
                $contactData['participant_date'] = $_POST['participant_date'];
            // 
            }
            if($_POST['authorised_name']!='')
            {
                $count++;
                $contactData['authorised_name'] = $_POST['authorised_name'];
            }
            if($_POST['authorised_date']!='')
            {
                $count++;
                $contactData['authorised_date'] = $_POST['authorised_date'];

            }
            if($_POST['schedule_of_supports']!='')
            {
                $count++;
                $contactData['schedule_of_supports'] = $_POST['schedule_of_supports'];
            // 

            }
            if($_POST['transport_costs']!='')
            {
                $count++;
                $contactData['transport_costs'] = $_POST['transport_costs'];
            // 

            }
            if($_POST['hours_per_week']!='')
            {
                $count++;
                $contactData['hours_per_week'] = $_POST['hours_per_week'];
            // 

            }
            if($_POST['including_gst']!='')
            {
                $count++;
                $contactData['including_gst'] = $_POST['including_gst'];
            // 

            }



            if($_POST['id']!='')
            {
            	$count++;
                $contactData['updated_date'] = date('Y-m-d H:i:s');
                if($_POST['pparticipant_signature_base']!='' && $_FILES['pparticipant_signature']['name']=='')
                {
                    $count++;
                    $contactData['pparticipant_signature_base'] = $_POST['pparticipant_signature_base'];
                    $contactData['pparticipant_signature'] = '';
                }
                if($_POST['pparticipant_signature_base']=='' && $_FILES['pparticipant_signature']['name']!='')
                {
                    $count++;
                    $contactData['pparticipant_signature_base'] = '';
                    
                    $uploadedFiles = handle_file_upload($_POST['id'],'pparticipant_signature', 'pparticipant_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'pparticipant_signature', [$file]);
                        }
                    }
                    $contactData['pparticipant_signature'] = '';

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'pparticipant_signature'))->row('file_name');
                    
                    $contactData['pparticipant_signature'] = base_url().'uploads/pparticipant_signature/'.$_POST['id'].'/'.$filename;

                }
                if($_POST['pauthorised_signature_base']!='' && $_FILES['pauthorised_signature']['name']=='')
                {
                    $count++;
                    $contactData['pauthorised_signature_base'] = $_POST['pauthorised_signature_base'];
                    $contactData['pauthorised_signature'] = '';
                }
                if($_POST['pauthorised_signature_base']=='' && $_FILES['pauthorised_signature']['name']!='')
                {
                    $count++;
                    $contactData['pauthorised_signature_base'] = '';
                    
                    $uploadedFiles = handle_file_upload($_POST['id'],'pauthorised_signature', 'pauthorised_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'pauthorised_signature', [$file]);
                        }
                    }
                    $contactData['pauthorised_signature'] = '';

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'pauthorised_signature'))->row('file_name');
                    
                    $contactData['pauthorised_signature'] = base_url().'uploads/pauthorised_signature/'.$_POST['id'].'/'.$filename;

                }


                $this->db->where('client_id', $client_id);
                $this->db->where('id', $_POST['id']);
                $this->db->update(db_prefix().'private_clients_service_agreement', $contactData);
	            if($_POST['id'])
	            {
	                $totalCol = $this->db->get_where(db_prefix().'private_clients_service_agreement')->num_fields();
	                $counttot = $count/$totalCol;
	                $mulcol = $counttot * 100;
	                $finalmulcol = round($mulcol,2);

	                $this->db->where('client_id', $client_id);
	                $this->db->where('form_id', 4);
	                $this->db->update(db_prefix() . 'form_allot', [
	                    'updated_date' => date('Y-m-d H:i:s'),
	                    'form_process' => $finalmulcol,
	                ]);
	                $msg = array('status' => true, 'message' =>'Successfully Updated!', 'result' =>$_POST['id']);
	            }
	            else
	            {
	                $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
	            }

            }
            else
            {
            	$count++;
                $contactData['created_date'] = date('Y-m-d H:i:s');
                $check = $this->db->get_where(db_prefix().'private_clients_service_agreement',array('client_id' => $client_id))->row();
                if(count($check)==0)
                {
                	$this->db->insert(db_prefix().'private_clients_service_agreement', $contactData);
                    // echo $this->db->last_query(); die;
    	            $lid = $this->db->insert_id();
    	            if($lid)
    	            {
                        if($_POST['pparticipant_signature_base']!='' && $_FILES['pparticipant_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['pparticipant_signature_base'] = $_POST['pparticipant_signature_base'];
                            $contactDataIMG['pparticipant_signature'] = '';
                        }
                        if($_POST['pparticipant_signature_base']=='' && $_FILES['pparticipant_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['pparticipant_signature_base'] = '';
                            
                            $uploadedFiles = handle_file_upload($lid,'pparticipant_signature', 'pparticipant_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'pparticipant_signature', [$file]);
                                }
                            }
                            

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'pparticipant_signature'))->row('file_name');

                            $contactDataIMG['pparticipant_signature'] = base_url().'uploads/pparticipant_signature/'.$lid.'/'.$filename;
                        }
                        if($_POST['pauthorised_signature_base']!='' && $_FILES['pauthorised_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['pauthorised_signature_base'] = $_POST['pauthorised_signature_base'];
                            $contactDataIMG['pauthorised_signature'] = '';
                        }
                        if($_POST['pauthorised_signature_base']=='' && $_FILES['pauthorised_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['pauthorised_signature_base'] = '';
                            
                            $uploadedFiles = handle_file_upload($lid,'pauthorised_signature', 'pauthorised_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'pauthorised_signature', [$file]);
                                }
                            }
                            

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'pauthorised_signature'))->row('file_name');

                            $contactDataIMG['pauthorised_signature'] = base_url().'uploads/pauthorised_signature/'.$lid.'/'.$filename;
                        }

                        $this->db->where('client_id', $client_id);
                        $this->db->where('id', $lid);
                        $this->db->update(db_prefix().'private_clients_service_agreement', $contactDataIMG);

    	                $totalCol = $this->db->get_where(db_prefix().'private_clients_service_agreement')->num_fields();
    	                $counttot = $count/$totalCol;
    	                $mulcol = $counttot * 100;
    	                $finalmulcol = round($mulcol,2);

    	                $this->db->where('client_id', $client_id);
    	                $this->db->where('form_id', 4);
    	                $this->db->update(db_prefix() . 'form_allot', [
    	                    'updated_date' => date('Y-m-d H:i:s'),
    	                    'form_process' => $finalmulcol,
    	                ]);
    	                $msg = array('status' => true, 'message' =>'Successfully Added!', 'result' =>$lid);
    	            }
    	            else
    	            {
    	                $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
    	            }
                }
                else
                {
                    $msg = array('status' => false, 'message' => 'Already Have Entry', 'result' =>array());
                }

        	}

            
        }         
        else
        {
            $msg = array('status' => false, 'message' => 'Please Send All The Parameters ', 'result' =>array());
        }
        $this->response($msg, REST_Controller::HTTP_OK);
    }

     /*-------------------------------------------------------------------
    *@function Transport booking
    *-------------------------------------------------------------------*/
    public function addAgedCareServiceAgreement()
    {
        // $_POST = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $client_id = $this->user_data->userid;
        if($client_id!='' && $_POST['name']!= '')
        {
           $count=0;
            if($client_id!='')
            {
                $count++;
                $contactData['client_id'] = $client_id;
            }
            
            if($_POST['name']!='')
            {
                $count++;
                $contactData['name'] = $_POST['name'];
            }
            if($_POST['service_agreement_from']!='')
            {
                $count++;
                $contactData['service_agreement_from'] = $_POST['service_agreement_from'];
            }
            if($_POST['schedule_of_supports']!='')
            {
                $count++;
                $contactData['schedule_of_supports'] = $_POST['schedule_of_supports'];
            }
            if($_POST['service_agreement_date']!='')
            {
                $count++;
                $contactData['service_agreement_date'] = $_POST['service_agreement_date'];
            }
            if($_POST['service_agreement_to']!='')
            {
                $count++;
                $contactData['service_agreement_to'] ='1 year';
            // 
            }
            if($_POST['date_of_this_agreement']!='')
            {
                $count++;
                $contactData['date_of_this_agreement'] = $_POST['date_of_this_agreement'];
            // 
            }
            if($_POST['ap_name']!='')
            {
                $count++;
                $contactData['ap_name']     = $_POST['ap_name'];
            }
            if($_POST['ap_abn']!='')
            {
                $count++;
                $contactData['ap_abn']      = $_POST['ap_abn'];
            }
            if($_POST['ap_address']!='')
            {
                $count++;
                $contactData['ap_address']  = $_POST['ap_address'];
            }
            if($_POST['ap_contact']!='')
            {
                $count++;
                $contactData['ap_contact']  = $_POST['ap_contact'];
            }
            if($_POST['ap_phone']!='')
            {
                $count++;
                $contactData['ap_phone']    = $_POST['ap_phone'];
            }
            if($_POST['ap_email']!='')
            {
                $count++;
                $contactData['ap_email']    = $_POST['ap_email'];
            // 

            }
            if($_POST['client_agreement_name']!='')
            {
                $count++;
                $contactData['client_agreement_name']     = $_POST['client_agreement_name'];
            }
            if($_POST['client_agreement_address']!='')
            {
                $count++;
                $contactData['client_agreement_address']  = $_POST['client_agreement_address'];
            }
            if($_POST['client_agreement_mobile']!='')
            {
                $count++;
                $contactData['client_agreement_mobile']  = $_POST['client_agreement_mobile'];
            }
            if($_POST['client_agreement_phone']!='')
            {
                $count++;
                $contactData['client_agreement_phone']    = $_POST['client_agreement_phone'];
            }
            if($_POST['client_agreement_email']!='')
            {
                $count++;
                $contactData['client_agreement_email']    = $_POST['client_agreement_email'];
            // 

            }
            if($_POST['client_representative_name']!='')
            {
                $count++;
                $contactData['client_representative_name']     = $_POST['client_representative_name'];
            }
            if($_POST['client_representative_address']!='')
            {
                $count++;
                $contactData['client_representative_address']  = $_POST['client_representative_address'];
            }
            if($_POST['client_representative_type']!='')
            {
                $count++;
                $contactData['client_representative_type']  = $_POST['client_representative_type'];
            }
            if($_POST['client_representative_phone']!='')
            {
                $count++;
                $contactData['client_representative_phone']    = $_POST['client_representative_phone'];
            }
            if($_POST['client_representative_kin']!='')
            {
                $count++;
                $contactData['client_representative_kin']    = $_POST['client_representative_kin'];
            }
            if($_POST['client_representative_other']!='')
            {
                $count++;
                $contactData['client_representative_other']    = $_POST['client_representative_other'];

            // 
            }
            if($_POST['commencement_date_for_care']!='')
            {
                $count++;
                $contactData['commencement_date_for_care'] = $_POST['commencement_date_for_care'];

            }
            if($_POST['home_care_package']!='')
            {
                $count++;
                $contactData['home_care_package'] = $_POST['home_care_package'];
            }
            if($_POST['care_plan']!='')
            {
                $count++;
                $contactData['care_plan'] = $_POST['care_plan'];
            }
            if($_POST['period_of_care']!='')
            {
                $count++;
                $contactData['period_of_care'] = $_POST['period_of_care'];
            }
            if($_POST['basic_care_fee']!='')
            {
                $count++;
                $contactData['basic_care_fee'] = $_POST['basic_care_fee'];
            }
            if($_POST['maximum_care_fee']!='')
            {
                $count++;
                $contactData['maximum_care_fee'] = $_POST['maximum_care_fee'];
            }
            if($_POST['income_test_care_fee_centrelink']!='')
            {
                $count++;
                $contactData['income_test_care_fee_centrelink'] = $_POST['income_test_care_fee_centrelink'];
            }
            if($_POST['developing_aged_care_package']!='')
            {
                $count++;
                $contactData['developing_aged_care_package'] = $_POST['developing_aged_care_package'];

            }
            if($_POST['consumer_name']!='')
            {
                $count++;
                $contactData['consumer_name'] = $_POST['consumer_name'];
            }
            if($_POST['consumer_date']!='')
            {
                $count++;
                $contactData['consumer_date'] = $_POST['consumer_date'];

            }
            if($_POST['authorised_name']!='')
            {
                $count++;
                $contactData['authorised_name'] = $_POST['authorised_name'];
            }
            if($_POST['authorised_date']!='')
            {
                $count++;
                $contactData['authorised_date'] = $_POST['authorised_date'];

            }
            if($_POST['organisation']!='')
            {
                $count++;
                $contactData['organisation'] = $_POST['organisation'];
            }
            if($_POST['client_name']!='')
            {
                $count++;
                $contactData['client_name'] = $_POST['client_name'];
            }
            if($_POST['client_address']!='')
            {
                $count++;
                $contactData['client_address'] = $_POST['client_address'];
            }
            if($_POST['client_phone_no1']!='')
            {
                $count++;
                $contactData['client_phone_no1'] = $_POST['client_phone_no1'];
            }
            if($_POST['client_phone_no2']!='')
            {
                $count++;
                $contactData['client_phone_no2'] = $_POST['client_phone_no2'];
            }
            if($_POST['client_email']!='')
            {
                $count++;
                $contactData['client_email'] = $_POST['client_email'];
            }
            if($_POST['client_address_of_service']!='')
            {
                $count++;
                $contactData['client_address_of_service'] = $_POST['client_address_of_service'];
            }
            if($_POST['client_emergency_contact']!='')
            {
                $count++;
                $contactData['client_emergency_contact'] = $_POST['client_emergency_contact'];
            }
            if($_POST['client_emergency_plan']!='')
            {
                $count++;
                $contactData['client_emergency_plan'] = $_POST['client_emergency_plan'];
            }
            if($_POST['support_worker_preferences']!='')
            {
                $count++;
                $contactData['support_worker_preferences'] = $_POST['support_worker_preferences'];
            }
            if($_POST['home_entry_instructions']!='')
            {
                $count++;
                $contactData['home_entry_instructions'] = $_POST['home_entry_instructions'];
            }
            if($_POST['client_profile']!='')
            {
                $count++;
                $contactData['client_profile'] = $_POST['client_profile'];
            }
            if($_POST['aged_care_reference_number']!='')
            {
                $count++;
                $contactData['aged_care_reference_number'] = $_POST['aged_care_reference_number'];
            }
            if($_POST['service_type']!='')
            {
                $count++;
                $contactData['service_type'] = $_POST['service_type'];
            }
            if($_POST['frequency']!='')
            {
                $count++;
                $contactData['frequency'] = $_POST['frequency'];
            }
            if($_POST['service_type2']!='')
            {
                $count++;
                $contactData['service_type2'] = $_POST['service_type2'];
            // 
            }
            if($_POST['start_date']!='')
            {
                $count++;
                $contactData['start_date'] = $_POST['start_date'];
            }
            if($_POST['end_date']!='')
            {
                $count++;
                $contactData['end_date'] = $_POST['end_date'];
            }
            if($_POST['start_time']!='')
            {
                $count++;
                $contactData['start_time'] = $_POST['start_time'];
            }
            if($_POST['end_time']!='')
            {
                $count++;
                $contactData['end_time'] = $_POST['end_time'];
            }
            if($_POST['duration']!='')
            {
                $count++;
                $contactData['duration'] = $_POST['duration'];
            }
            if($_POST['duties']!='')
            {
                $count++;
                $contactData['duties'] = $_POST['duties'];
            // 

            }

            if($_POST['id']!='')
            {

                        if($_POST['consumer_signature_base']!='' && $_FILES['consumer_signature']['name']=='')
                        {
                            $count++;
                            $contactData['consumer_signature_base'] = $_POST['consumer_signature_base'];
                            $contactData['consumer_signature'] = '';
                        }
                        if($_POST['consumer_signature_base']=='' && $_FILES['consumer_signature']['name']!='')
                        {
                            $count++;
                            $contactData['consumer_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($_POST['id'],'consumer_signature', 'consumer_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($_POST['id'], 'consumer_signature', [$file]);
                                }
                            }
                            
                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'consumer_signature'))->row('file_name');
                            
                            $contactData['consumer_signature'] = base_url().'uploads/consumer_signature/'.$_POST['id'].'/'.$filename;

                            

                        }
                        
                        if($_POST['authorised_signature_base']!='' && $_FILES['authorised_signature']['name']=='')
                        {
                            $count++;
                            $contactData['authorised_signature_base'] = $_POST['authorised_signature_base'];
                            $contactData['authorised_signature'] = '';
                        }
                        if($_POST['authorised_signature_base']=='' && $_FILES['authorised_signature']['name']!='')
                        {
                            $count++;
                            $contactData['authorised_signature_base'] = '';
                            
                            $uploadedFiles = handle_file_upload($_POST['id'],'authorised_signature', 'authorised_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($_POST['id'], 'authorised_signature', [$file]);
                                }
                            }
                            $contactData['authorised_signature'] = '';

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'authorised_signature'))->row('file_name');
                            
                            $contactData['authorised_signature'] = base_url().'uploads/authorised_signature/'.$_POST['id'].'/'.$filename;

                        }


            	$count++;
                $contactData['updated_date'] = date('Y-m-d H:i:s');
                $this->db->where('client_id', $client_id);
                $this->db->where('id', $_POST['id']);
                $this->db->update(db_prefix().'add_aged_care_service_agreement', $contactData);
	            if($_POST['id'])
	            {
                    
	                $totalCol = $this->db->get_where(db_prefix().'add_aged_care_service_agreement')->num_fields();
	                $counttot = $count/$totalCol;
	                $mulcol = $counttot * 100;
	                $finalmulcol = round($mulcol,2);

	                $this->db->where('client_id', $client_id);
	                $this->db->where('form_id', 5);
	                $this->db->update(db_prefix() . 'form_allot', [
	                    'updated_date' => date('Y-m-d H:i:s'),
	                    'form_process' => $finalmulcol,
	                ]);
	                $msg = array('status' => true, 'message' =>'Successfully Updated!', 'result' =>$_POST['id']);

	            }
	            else
	            {
	                $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
	            }

            }
            else
            {
            	$count++;
                $contactData['created_date'] = date('Y-m-d H:i:s');
                $check = $this->db->get_where(db_prefix().'add_aged_care_service_agreement',array('client_id' => $client_id))->row();
                if(count($check)==0)
                {
                	$this->db->insert(db_prefix().'add_aged_care_service_agreement', $contactData);
                    // echo $this->db->last_query();
    	            $lid = $this->db->insert_id();
                    
    	            if($lid)
    	            {
                        
                        if($_POST['consumer_signature_base']!='' && $_FILES['consumer_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['consumer_signature_base'] = $_POST['consumer_signature_base'];
                            $contactDataIMG['consumer_signature'] = '';
                        }
                        if($_POST['consumer_signature_base']=='' && $_FILES['consumer_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['consumer_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'consumer_signature', 'consumer_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'consumer_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'consumer_signature'))->row('file_name');

                            $contactDataIMG['consumer_signature'] = base_url().'uploads/consumer_signature/'.$lid.'/'.$filename;

                            

                        }
                        
                        if($_POST['authorised_signature_base']!='' && $_FILES['authorised_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['authorised_signature_base'] = $_POST['authorised_signature_base'];
                            $contactDataIMG['authorised_signature'] = '';
                        }
                        if($_POST['authorised_signature_base']=='' && $_FILES['authorised_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['authorised_signature_base'] = '';
                            
                            $uploadedFiles = handle_file_upload($lid,'authorised_signature', 'authorised_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'authorised_signature', [$file]);
                                }
                            }
                            

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'authorised_signature'))->row('file_name');

                            $contactDataIMG['authorised_signature'] = base_url().'uploads/authorised_signature/'.$lid.'/'.$filename;
                        }

                        $this->db->where('client_id', $client_id);
                        $this->db->where('id', $lid);
                        $this->db->update(db_prefix().'add_aged_care_service_agreement', $contactDataIMG);
                
    	                $totalCol = $this->db->get_where(db_prefix().'add_aged_care_service_agreement')->num_fields();
    	                $counttot = $count/$totalCol;
    	                $mulcol = $counttot * 100;
    	                $finalmulcol = round($mulcol,2);

    	                $this->db->where('client_id', $client_id);
    	                $this->db->where('form_id', 5);
    	                $this->db->update(db_prefix() . 'form_allot', [
    	                    'updated_date' => date('Y-m-d H:i:s'),
    	                    'form_process' => $finalmulcol,
    	                ]);
    	                $msg = array('status' => true, 'message' =>'Successfully Added!', 'result' =>$lid);
    	            }
    	            else
    	            {
    	                $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
    	            }
                }
                else
                {
                    $msg = array('status' => false, 'message' => 'Already Have Entry', 'result' =>array());
                }
        	}


            
        }         
        else
        {
            $msg = array('status' => false, 'message' => 'Please Send All The Parameters ', 'result' =>array());
        }
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    
    

   /*-------------------------------------------------------------------
    *@function Integrated Client Assessment
    *-------------------------------------------------------------------*/
    public function addIntegratedClientAssessment()
    {
        // $_POST = array_merge($_POST,json_decode(file_get_contents('php://input'),true));

        $client_id = $this->user_data->userid;


        if($client_id!='' && $_POST['p_name']!= '')
        {
           
           $count=0;
            if($client_id!='')
            {
                $count++;
                $contactData['client_id'] = $client_id;
            }
            
            if($_POST['p_name']!='' && $_POST['p_name']!=null)
            {
                $count++;
                $contactData['p_name'] = $_POST['p_name'];
            }
            if($_POST['p_title']!='' && $_POST['p_title']!=null)
            {
                $count++;
                $contactData['p_title'] = $_POST['p_title'];
            }
            if($_POST['p_address']!='' && $_POST['p_address']!=null)
            {
                $count++;
                $contactData['p_address'] = $_POST['p_address'];
            }
            if($_POST['p_phone_h']!='' && $_POST['p_phone_h']!=null)
            {
                $count++;
                $contactData['p_phone_h'] = $_POST['p_phone_h'];
            }
            if($_POST['p_phone_m']!='' && $_POST['p_phone_m']!=null)
            {
                $count++;
                $contactData['p_phone_m'] = $_POST['p_phone_m'];
            }
            if($_POST['p_phone_w']!='' && $_POST['p_phone_w']!=null)
            {
                $count++;
                $contactData['p_phone_w'] = $_POST['p_phone_w'];
            }
            if($_POST['p_age']!='' && $_POST['p_age']!=null)
            {
                $count++;
                $contactData['p_age'] = $_POST['p_age'];
            }
            if($_POST['p_dob']!='' && $_POST['p_dob']!=null)
            {
                $count++;
                $contactData['p_dob'] = $_POST['p_dob'];
            }
            if($_POST['p_nationality']!='' && $_POST['p_nationality']!=null)
            {
                $count++;
                $contactData['p_nationality'] = $_POST['p_nationality'];
            }
            if($_POST['p_australian']!='' && $_POST['p_australian']!=null)
            {
                $count++;
                $contactData['p_australian'] = $_POST['p_australian'];
            }
            if($_POST['p_email']!='' && $_POST['p_email']!=null)
            {
                $count++;
                $contactData['p_email'] = $_POST['p_email'];
            }
            if($_POST['p_language']!='' && $_POST['p_language']!=null)
            {
                $count++;
                $contactData['p_language'] = $_POST['p_language'];
            }
            if($_POST['p_interpreter']!='' && $_POST['p_interpreter']!=null)
            {
                $count++;
                $contactData['p_interpreter'] = $_POST['p_interpreter'];
            }
            if($_POST['p_next_of_kin']!='' && $_POST['p_next_of_kin']!=null)
            {
                $count++;
                $contactData['p_next_of_kin'] = $_POST['p_next_of_kin'];
            }
            if($_POST['p_relationship']!='' && $_POST['p_relationship']!=null)
            {
                $count++;
                $contactData['p_relationship'] = $_POST['p_relationship'];
            }
            if($_POST['p_address2']!='' && $_POST['p_address2']!=null)
            {
                $count++;
                $contactData['p_address2'] = $_POST['p_address2'];
            }
            if($_POST['p_phone2_h']!='' && $_POST['p_phone2_h']!=null)
            {
                $count++;
                $contactData['p_phone2_h'] = $_POST['p_phone2_h'];
            }
            if($_POST['p_phone2_m']!='' && $_POST['p_phone2_m']!=null)
            {
                $count++;
                $contactData['p_phone2_m'] = $_POST['p_phone2_m'];
            }
            if($_POST['p_phone2_w']!='' && $_POST['p_phone2_w']!=null)
            {
                $count++;
                $contactData['p_phone2_w'] = $_POST['p_phone2_w'];
            }
            if($_POST['p_email2']!='' && $_POST['p_email2']!=null)
            {
                $count++;
                $contactData['p_email2'] = $_POST['p_email2'];
            }
            if($_POST['p_emergency_contact']!='' && $_POST['p_emergency_contact']!=null)
            {
                $count++;
                $contactData['p_emergency_contact'] = $_POST['p_emergency_contact'];
            }
            if($_POST['p_emergency_relationship']!='' && $_POST['p_emergency_relationship']!=null)
            {
                $count++;
                $contactData['p_emergency_relationship'] = $_POST['p_emergency_relationship'];
            }
            if($_POST['p_emergency_address']!='' && $_POST['p_emergency_address']!=null)
            {
                $count++;
                $contactData['p_emergency_address'] = $_POST['p_emergency_address'];
            }
            if($_POST['p_emergency_phone_h']!='' && $_POST['p_emergency_phone_h']!=null)
            {
                $count++;
                $contactData['p_emergency_phone_h'] = $_POST['p_emergency_phone_h'];
            }
            if($_POST['p_emergency_phone_m']!='' && $_POST['p_emergency_phone_m']!=null)
            {
                $count++;
                $contactData['p_emergency_phone_m'] = $_POST['p_emergency_phone_m'];
            }
            if($_POST['p_emergency_phone_w']!='' && $_POST['p_emergency_phone_w']!=null)
            {
                $count++;
                $contactData['p_emergency_phone_w'] = $_POST['p_emergency_phone_w'];
            }
            if($_POST['vital_call_alarm']!='' && $_POST['vital_call_alarm']!=null)
            {
                $count++;
                $contactData['vital_call_alarm'] = $_POST['vital_call_alarm'];
            }
            if($_POST['name_of_service']!='' && $_POST['name_of_service']!=null)
            {
                $count++;
                $contactData['name_of_service'] = $_POST['name_of_service'];

            // 

            }
            if($_POST['f_source']!='' && $_POST['f_source']!=null)
            {
                $count++;
                $contactData['f_source'] = $_POST['f_source'];
            }
            if($_POST['f_source_no']!='' && $_POST['f_source_no']!=null)
            {
                $count++;
                $contactData['f_source_no'] = $_POST['f_source_no'];
            }
            if($_POST['f_start_date']!='' && $_POST['f_start_date']!=null)
            {
                $count++;
                $contactData['f_start_date'] = $_POST['f_start_date'];
            }
            if($_POST['f_end_date']!='' && $_POST['f_end_date']!=null)
            {
                $count++;
                $contactData['f_end_date'] = $_POST['f_end_date'];
            }
            if($_POST['f_ndis_onlyplan_managed_by']!='' && $_POST['f_ndis_onlyplan_managed_by']!=null)
            {
                $count++;
                $contactData['f_ndis_onlyplan_managed_by'] = $_POST['f_ndis_onlyplan_managed_by'];
            }
            if($_POST['f_ndis_onlyplan_managed_by_value']!='' && $_POST['f_ndis_onlyplan_managed_by_value']!=null)
            {
                $count++;
                $contactData['f_ndis_onlyplan_managed_by_value'] = $_POST['f_ndis_onlyplan_managed_by_value'];
            }
            if($_POST['f_ndis_onlyplan_managed_by_other_value']!='' && $_POST['f_ndis_onlyplan_managed_by_other_value']!=null)
            {
                $count++;
                $contactData['f_ndis_onlyplan_managed_by_other_value'] = $_POST['f_ndis_onlyplan_managed_by_other_value'];
            }
            if($_POST['f_ndis_onlyplan_managed_by_other_value2']!='' && $_POST['f_ndis_onlyplan_managed_by_other_value2']!=null)
            {
                $count++;
                $contactData['f_ndis_onlyplan_managed_by_other_value2'] = $_POST['f_ndis_onlyplan_managed_by_other_value2'];
            }
            if($_POST['f_allocated']!='' && $_POST['f_allocated']!=null)
            {
                $count++;
                $contactData['f_allocated'] = $_POST['f_allocated'];
            }
            if($_POST['f_total_hour_per_week']!='' && $_POST['f_total_hour_per_week']!=null)
            {
                $count++;
                $contactData['f_total_hour_per_week'] = $_POST['f_total_hour_per_week'];
            }
            if($_POST['f_shifts']!='' && $_POST['f_shifts']!=null)
            {
                $count++;
                $contactData['f_shifts'] = $_POST['f_shifts'];
            }
            if($_POST['f_shifts_value']!='' && $_POST['f_shifts_value']!=null)
            {
                $count++;
                $contactData['f_shifts_value'] = $_POST['f_shifts_value'];

            }
            if($_POST['f_new_application_shifts']!='' && $_POST['f_new_application_shifts']!=null)
            {
                $count++;
                $contactData['f_new_application_shifts'] = $_POST['f_new_application_shifts'];
            }
            if($_POST['f_comments']!='' && $_POST['f_comments']!=null)
            {
                $count++;
                $contactData['f_comments'] = $_POST['f_comments'];

            }
            if($_POST['f_hour_per_week']!='' && $_POST['f_hour_per_week']!=null)
            {
                $count++;
                $contactData['f_hour_per_week'] = $_POST['f_hour_per_week'];
            }
            if($_POST['f_hour_per_day']!='' && $_POST['f_hour_per_day']!=null)
            {
                $count++;
                $contactData['f_hour_per_day'] = $_POST['f_hour_per_day'];
            // 

            }
            if($_POST['f_breakdown_morning']!='' && $_POST['f_breakdown_morning']!=null)
            {
                $count++;
                $contactData['f_breakdown_morning'] = $_POST['f_breakdown_morning'];
            }
            if($_POST['f_breakdown_lunch']!='' && $_POST['f_breakdown_lunch']!=null)
            {
                $count++;
                $contactData['f_breakdown_lunch'] = $_POST['f_breakdown_lunch'];
            }
            if($_POST['f_breakdown_evening']!='' && $_POST['f_breakdown_evening']!=null)
            {
                $count++;
                $contactData['f_breakdown_evening'] = $_POST['f_breakdown_evening'];
            }
            if($_POST['f_breakdown_night']!='' && $_POST['f_breakdown_night']!=null)
            {
                $count++;
                $contactData['f_breakdown_night'] = $_POST['f_breakdown_night'];

            // 
            }
            if($_POST['b_monday']!='' && $_POST['b_monday']!=null)
            {
                $count++;
                $contactData['b_monday'] = $_POST['b_monday'];
            }
            if($_POST['b_tuesday']!='' && $_POST['b_tuesday']!=null)
            {
                $count++;
                $contactData['b_tuesday'] = $_POST['b_tuesday'];
            }
            if($_POST['b_wednesday']!='' && $_POST['b_wednesday']!=null)
            {
                $count++;
                $contactData['b_wednesday'] = $_POST['b_wednesday'];
            }
            if($_POST['b_thursday']!='' && $_POST['b_thursday']!=null)
            {
                $count++;
                $contactData['b_thursday'] = $_POST['b_thursday'];
            }
            if($_POST['b_friday']!='' && $_POST['b_friday']!=null)
            {
                $count++;
                $contactData['b_friday'] = $_POST['b_friday'];
            }
            if($_POST['b_saturday']!='' && $_POST['b_saturday']!=null)
            {
                $count++;
                $contactData['b_saturday'] = $_POST['b_saturday'];
            }
            if($_POST['b_sunday']!='' && $_POST['b_sunday']!=null)
            {
                $count++;
                $contactData['b_sunday'] = $_POST['b_sunday'];
            }
            if($_POST['b_total_hours_per_week']!='' && $_POST['b_total_hours_per_week']!=null)
            {
                $count++;
                $contactData['b_total_hours_per_week'] = $_POST['b_total_hours_per_week'];

            // 
            }
            if($_POST['l_alone']!='' && $_POST['l_alone']!=null)
            {
                $count++;
                $contactData['l_alone'] = $_POST['l_alone'];
            }
            if($_POST['l_with']!='' && $_POST['l_with']!=null)
            {
                $count++;
                $contactData['l_with'] = $_POST['l_with'];
            }
            if($_POST['l_dependent']!='' && $_POST['l_dependent']!=null)
            {
                $count++;
                $contactData['l_dependent'] = $_POST['l_dependent'];
            }
            if($_POST['l_dwelling']!='' && $_POST['l_dwelling']!=null)
            {
                $count++;
                $contactData['l_dwelling'] = $_POST['l_dwelling'];
            // 

            }
            if($_POST['gp_phone']!='' && $_POST['gp_phone']!=null)
            {
                $count++;
                $contactData['gp_phone'] = $_POST['gp_phone'];
            }
            if($_POST['gp_mobile']!='' && $_POST['gp_mobile']!=null)
            {
                $count++;
                $contactData['gp_mobile'] = $_POST['gp_mobile'];
            }
            if($_POST['gp_email']!='' && $_POST['gp_email']!=null)
            {
                $count++;
                $contactData['gp_email'] = $_POST['gp_email'];
            // 

            }
            if($_POST['sc_phone']!='' && $_POST['sc_phone']!=null)
            {
                $count++;
                $contactData['sc_phone'] = $_POST['sc_phone'];
            }
            if($_POST['sc_mobile']!='' && $_POST['sc_mobile']!=null)
            {
                $count++;
                $contactData['sc_mobile'] = $_POST['sc_mobile'];
            }
            if($_POST['sc_email']!='' && $_POST['sc_email']!=null)
            {
                $count++;
                $contactData['sc_email'] = $_POST['sc_email'];

            // 

            }
            if($_POST['cc_phone']!='' && $_POST['cc_phone']!=null)
            {
                $count++;
                $contactData['cc_phone'] = $_POST['cc_phone'];
            }
            if($_POST['cc_mobile']!='' && $_POST['cc_mobile']!=null)
            {
                $count++;
                $contactData['cc_mobile'] = $_POST['cc_mobile'];
            }
            if($_POST['cc_email']!='' && $_POST['cc_email']!=null)
            {
                $count++;
                $contactData['cc_email'] = $_POST['cc_email'];

            // 

            }
            if($_POST['ahs_phone']!='' && $_POST['ahs_phone']!=null)
            {
                $count++;
                $contactData['ahs_phone'] = $_POST['ahs_phone'];
            }
            if($_POST['ahs_mobile']!='' && $_POST['ahs_mobile']!=null)
            {
                $count++;
                $contactData['ahs_mobile'] = $_POST['ahs_mobile'];
            }
            if($_POST['ahs_email']!='' && $_POST['ahs_email']!=null)
            {
                $count++;
                $contactData['ahs_email'] = $_POST['ahs_email'];

            // 

            }
            if($_POST['pharmacy_phone']!='' && $_POST['pharmacy_phone']!=null)
            {
                $count++;
                $contactData['pharmacy_phone'] = $_POST['pharmacy_phone'];
            }
            if($_POST['pharmacy_mobile']!='' && $_POST['pharmacy_mobile']!=null)
            {
                $count++;
                $contactData['pharmacy_mobile'] = $_POST['pharmacy_mobile'];
            }
            if($_POST['pharmacy_email']!='' && $_POST['pharmacy_email']!=null)
            {
                $count++;
                $contactData['pharmacy_email'] = $_POST['pharmacy_email'];

            // 

            }
            if($_POST['p_outline']!='' && $_POST['p_outline']!=null)
            {
                $count++;
                $contactData['p_outline'] = $_POST['p_outline'];
            }
            if($_POST['p_health_info']!='' && $_POST['p_health_info']!=null)
            {
                $count++;
                $contactData['p_health_info'] = $_POST['p_health_info'];
            }
            if($_POST['p_health_reason']!='' && $_POST['p_health_reason']!=null)
            {
                $count++;
                $contactData['p_health_reason'] = $_POST['p_health_reason'];

            // 

            }
            if($_POST['p_allergies']!='' && $_POST['p_allergies']!=null)
            {
                $count++;
                $contactData['p_allergies'] = $_POST['p_allergies'];
            }
            if($_POST['p_allergies_comment']!='' && $_POST['p_allergies_comment']!=null)
            {
                $count++;
                $contactData['p_allergies_comment'] = $_POST['p_allergies_comment'];
            }
            if($_POST['p_allergies_management_plan']!='' && $_POST['p_allergies_management_plan']!=null)
            {
                $count++;
                $contactData['p_allergies_management_plan'] = $_POST['p_allergies_management_plan'];


            // 

            }
            if($_POST['p_speech']!='' && $_POST['p_speech']!=null)
            {
                $count++;
                $contactData['p_speech'] = $_POST['p_speech'];
            }
            if($_POST['p_speech_comment']!='' && $_POST['p_speech_comment']!=null)
            {
                $count++;
                $contactData['p_speech_comment'] = $_POST['p_speech_comment'];
            }
            if($_POST['p_speech_management_plan']!='' && $_POST['p_speech_management_plan']!=null)
            {
                $count++;
                $contactData['p_speech_management_plan'] = $_POST['p_speech_management_plan'];


            // 

            }
            if($_POST['p_swallowing']!='' && $_POST['p_swallowing']!=null)
            {
                $count++;
                $contactData['p_swallowing'] = $_POST['p_swallowing'];
            }
            if($_POST['p_swallowing_comment']!='' && $_POST['p_swallowing_comment']!=null)
            {
                $count++;
                $contactData['p_swallowing_comment'] = $_POST['p_swallowing_comment'];
            }
            if($_POST['p_swallowing_management_plan']!='' && $_POST['p_swallowing_management_plan']!=null)
            {
                $count++;
                $contactData['p_swallowing_management_plan'] = $_POST['p_swallowing_management_plan'];



            // 

            }
            if($_POST['p_pain']!='' && $_POST['p_pain']!=null)
            {
                $count++;
                $contactData['p_pain'] = $_POST['p_pain'];
            }
            if($_POST['p_pain_comment']!='' && $_POST['p_pain_comment']!=null)
            {
                $count++;
                $contactData['p_pain_comment'] = $_POST['p_pain_comment'];
            }
            if($_POST['p_pain_management_plan']!='' && $_POST['p_pain_management_plan']!=null)
            {
                $count++;
                $contactData['p_pain_management_plan'] = $_POST['p_pain_management_plan'];

            // 

            }
            if($_POST['p_diabetes']!='' && $_POST['p_diabetes']!=null)
            {
                $count++;
                $contactData['p_diabetes'] = $_POST['p_diabetes'];
            }
            if($_POST['p_diabetes_comment']!='' && $_POST['p_diabetes_comment']!=null)
            {
                $count++;
                $contactData['p_diabetes_comment'] = $_POST['p_diabetes_comment'];
            }
            if($_POST['p_diabetes_management_plan']!='' && $_POST['p_diabetes_management_plan']!=null)
            {
                $count++;
                $contactData['p_diabetes_management_plan'] = $_POST['p_diabetes_management_plan'];

            // 

            }
            if($_POST['p_epilepsy']!='' && $_POST['p_epilepsy']!=null)
            {
                $count++;
                $contactData['p_epilepsy'] = $_POST['p_epilepsy'];
            }
            if($_POST['p_epilepsy_comment']!='' && $_POST['p_epilepsy_comment']!=null)
            {
                $count++;
                $contactData['p_epilepsy_comment'] = $_POST['p_epilepsy_comment'];
            }
            if($_POST['p_epilepsy_management_plan']!='' && $_POST['p_epilepsy_management_plan']!=null)
            {
                $count++;
                $contactData['p_epilepsy_management_plan'] = $_POST['p_epilepsy_management_plan'];
            // 

            }
            if($_POST['p_dysreflexia']!='' && $_POST['p_dysreflexia']!=null)
            {
                $count++;
                $contactData['p_dysreflexia'] = $_POST['p_dysreflexia'];
            }
            if($_POST['p_dysreflexia_comment']!='' && $_POST['p_dysreflexia_comment']!=null)
            {
                $count++;
                $contactData['p_dysreflexia_comment'] = $_POST['p_dysreflexia_comment'];
            }
            if($_POST['p_dysreflexia_management_plan']!='' && $_POST['p_dysreflexia_management_plan']!=null)
            {
                $count++;
                $contactData['p_dysreflexia_management_plan'] = $_POST['p_dysreflexia_management_plan'];
            // 

            }
            if($_POST['p_asthma']!='' && $_POST['p_asthma']!=null)
            {
                $count++;
                $contactData['p_asthma'] = $_POST['p_asthma'];
            }
            if($_POST['p_asthma_comment']!='' && $_POST['p_asthma_comment']!=null)
            {
                $count++;
                $contactData['p_asthma_comment'] = $_POST['p_asthma_comment'];
            }
            if($_POST['p_asthma_management_plan']!='' && $_POST['p_asthma_management_plan']!=null)
            {
                $count++;
                $contactData['p_asthma_management_plan'] = $_POST['p_asthma_management_plan'];
            // 

            }
            if($_POST['p_behavior']!='' && $_POST['p_behavior']!=null)
            {
                $count++;
                $contactData['p_behavior'] = $_POST['p_behavior'];
            }
            if($_POST['p_behavior_comment']!='' && $_POST['p_behavior_comment']!=null)
            {
                $count++;
                $contactData['p_behavior_comment'] = $_POST['p_behavior_comment'];
            }
            if($_POST['p_behavior_management_plan']!='' && $_POST['p_behavior_management_plan']!=null)
            {
                $count++;
                $contactData['p_behavior_management_plan'] = $_POST['p_behavior_management_plan'];
            // 

            }
            if($_POST['p_other_medical']!='' && $_POST['p_other_medical']!=null)
            {
                $count++;
                $contactData['p_other_medical'] = $_POST['p_other_medical'];
            }
            if($_POST['p_other_medical_comment']!='' && $_POST['p_other_medical_comment']!=null)
            {
                $count++;
                $contactData['p_other_medical_comment'] = $_POST['p_other_medical_comment'];
            }
            if($_POST['p_other_medical_management_plan']!='' && $_POST['p_other_medical_management_plan']!=null)
            {
                $count++;
                $contactData['p_other_medical_management_plan'] = $_POST['p_other_medical_management_plan'];


            // 

            }
            if($_POST['p_smoker']!='' && $_POST['p_smoker']!=null)
            {
                $count++;
                $contactData['p_smoker'] = $_POST['p_smoker'];
            }
            if($_POST['p_smoker_comment']!='' && $_POST['p_smoker_comment']!=null)
            {
                $count++;
                $contactData['p_smoker_comment'] = $_POST['p_smoker_comment'];
            }
            if($_POST['p_smoker_management_plan']!='' && $_POST['p_smoker_management_plan']!=null)
            {
                $count++;
                $contactData['p_smoker_management_plan'] = $_POST['p_smoker_management_plan'];

            // 

            }
            if($_POST['p_alcohol']!='' && $_POST['p_alcohol']!=null)
            {
                $count++;
                $contactData['p_alcohol'] = $_POST['p_alcohol'];
            }
            if($_POST['p_alcohol_comment']!='' && $_POST['p_alcohol_comment']!=null)
            {
                $count++;
                $contactData['p_alcohol_comment'] = $_POST['p_alcohol_comment'];
            }
            if($_POST['p_alcohol_management_plan']!='' && $_POST['p_alcohol_management_plan']!=null)
            {
                $count++;
                $contactData['p_alcohol_management_plan'] = $_POST['p_alcohol_management_plan'];

            // 

            }
            if($_POST['p_illicit_drugs']!='' && $_POST['p_illicit_drugs']!=null)
            {
                $count++;
                $contactData['p_illicit_drugs'] = $_POST['p_illicit_drugs'];
            }
            if($_POST['p_illicit_drugs_comment']!='' && $_POST['p_illicit_drugs_comment']!=null)
            {
                $count++;
                $contactData['p_illicit_drugs_comment'] = $_POST['p_illicit_drugs_comment'];
            }
            if($_POST['p_illicit_drugs_management_plan']!='' && $_POST['p_illicit_drugs_management_plan']!=null)
            {
                $count++;
                $contactData['p_illicit_drugs_management_plan'] = $_POST['p_illicit_drugs_management_plan'];

            // 

            }
            if($_POST['p_hearing_good']!='' && $_POST['p_hearing_good']!=null)
            {
                $count++;
                $contactData['p_hearing_good'] = $_POST['p_hearing_good'];
            }
            if($_POST['p_hearing_aid']!='' && $_POST['p_hearing_aid']!=null)
            {
                $count++;
                $contactData['p_hearing_aid'] = $_POST['p_hearing_aid'];
            }
            if($_POST['p_hearing_comment']!='' && $_POST['p_hearing_comment']!=null)
            {
                $count++;
                $contactData['p_hearing_comment'] = $_POST['p_hearing_comment'];

            // 

            }
            if($_POST['p_eyesight_good']!='' && $_POST['p_eyesight_good']!=null)
            {
                $count++;
                $contactData['p_eyesight_good'] = $_POST['p_eyesight_good'];
            }
            if($_POST['p_eyesight_glasses']!='' && $_POST['p_eyesight_glasses']!=null)
            {
                $count++;
                $contactData['p_eyesight_glasses'] = $_POST['p_eyesight_glasses'];
            }
            if($_POST['p_eyesight_lens']!='' && $_POST['p_eyesight_lens']!=null)
            {
                $count++;
                $contactData['p_eyesight_lens'] = $_POST['p_eyesight_lens'];
            }
            if($_POST['p_eyesight_comment']!='' && $_POST['p_eyesight_comment']!=null)
            {
                $count++;
                $contactData['p_eyesight_comment'] = $_POST['p_eyesight_comment'];

            // 

            }
            if($_POST['p_speech_good']!='' && $_POST['p_speech_good']!=null)
            {
                $count++;
                $contactData['p_speech_good'] = $_POST['p_speech_good'];
            }
            if($_POST['p_speech_comments']!='' && $_POST['p_speech_comments']!=null)
            {
                $count++;
                $contactData['p_speech_comments'] = $_POST['p_speech_comments'];

            // 

            }
            if($_POST['p_cognition']!='' && $_POST['p_cognition']!=null)
            {
                $count++;
                $contactData['p_cognition'] = $_POST['p_cognition'];
            }
            if($_POST['p_cognition_comment']!='' && $_POST['p_cognition_comment']!=null)
            {
                $count++;
                $contactData['p_cognition_comment'] = $_POST['p_cognition_comment'];


            // 

            }
            if($_POST['p_hydration']!='' && $_POST['p_hydration']!=null)
            {
                $count++;
                $contactData['p_hydration'] = $_POST['p_hydration'];
            }
            if($_POST['p_hydration_comment']!='' && $_POST['p_hydration_comment']!=null)
            {
                $count++;
                $contactData['p_hydration_comment'] = $_POST['p_hydration_comment'];

            // 

            }
            if($_POST['p_nutrition']!='' && $_POST['p_nutrition']!=null)
            {
                $count++;
                $contactData['p_nutrition'] = $_POST['p_nutrition'];
            }
            if($_POST['p_nutrition_peg']!='' && $_POST['p_nutrition_peg']!=null)
            {
                $count++;
                $contactData['p_nutrition_peg'] = $_POST['p_nutrition_peg'];
            }
            if($_POST['p_nutrition_choking']!='' && $_POST['p_nutrition_choking']!=null)
            {
                $count++;
                $contactData['p_nutrition_choking'] = $_POST['p_nutrition_choking'];

            // 

            }
            if($_POST['p_appetite']!='' && $_POST['p_appetite']!=null)
            {
                $count++;
                $contactData['p_appetite'] = $_POST['p_appetite'];
            }
            if($_POST['p_appetite_comment']!='' && $_POST['p_appetite_comment']!=null)
            {
                $count++;
                $contactData['p_appetite_comment'] = $_POST['p_appetite_comment'];

            // 

            }
            if($_POST['p_drinking']!='' && $_POST['p_drinking']!=null)
            {
                $count++;
                $contactData['p_drinking'] = $_POST['p_drinking'];
            }
            if($_POST['p_drinking_comment']!='' && $_POST['p_drinking_comment']!=null)
            {
                $count++;
                $contactData['p_drinking_comment'] = $_POST['p_drinking_comment'];

            // 

            }
            if($_POST['p_medication']!='' && $_POST['p_medication']!=null)
            {
                $count++;
                $contactData['p_medication'] = $_POST['p_medication'];
            }
            if($_POST['p_medication_comment']!='' && $_POST['p_medication_comment']!=null)
            {
                $count++;
                $contactData['p_medication_comment'] = $_POST['p_medication_comment'];

            // 

            }
            if($_POST['p_self_managed']!='' && $_POST['p_self_managed']!=null)
            {
                $count++;
                $contactData['p_self_managed'] = $_POST['p_self_managed'];
            }
            if($_POST['p_self_managed_comment']!='' && $_POST['p_self_managed_comment']!=null)
            {
                $count++;
                $contactData['p_self_managed_comment'] = $_POST['p_self_managed_comment'];


            // 

            }
            if($_POST['p_webster_pack']!='' && $_POST['p_webster_pack']!=null)
            {
                $count++;
                $contactData['p_webster_pack'] = $_POST['p_webster_pack'];
            }
            if($_POST['p_webster_pack_comment']!='' && $_POST['p_webster_pack_comment']!=null)
            {
                $count++;
                $contactData['p_webster_pack_comment'] = $_POST['p_webster_pack_comment'];

            // 

            }
            if($_POST['p_original_pack']!='' && $_POST['p_original_pack']!=null)
            {
                $count++;
                $contactData['p_original_pack'] = $_POST['p_original_pack'];
            }
            if($_POST['p_original_pack_comment']!='' && $_POST['p_original_pack_comment']!=null)
            {
                $count++;
                $contactData['p_original_pack_comment'] = $_POST['p_original_pack_comment'];
            
            // 

            }
            if($_POST['p_dossett_box']!='' && $_POST['p_dossett_box']!=null)
            {
                $count++;
                $contactData['p_dossett_box'] = $_POST['p_dossett_box'];
            }
            if($_POST['p_dossett_box_comment']!='' && $_POST['p_dossett_box_comment']!=null)
            {
                $count++;
                $contactData['p_dossett_box_comment'] = $_POST['p_dossett_box_comment'];
            
            // 

            }
            if($_POST['m_bed_bound']!='' && $_POST['m_bed_bound']!=null)
            {
                $count++;
                $contactData['m_bed_bound'] = $_POST['m_bed_bound'];
            }
            if($_POST['m_bed_comment']!='' && $_POST['m_bed_comment']!=null)
            {
                $count++;
                $contactData['m_bed_comment'] = $_POST['m_bed_comment'];
            
            // 

            }
            if($_POST['m_bed_mobility']!='' && $_POST['m_bed_mobility']!=null)
            {
                $count++;
                $contactData['m_bed_mobility'] = $_POST['m_bed_mobility'];
            }
            if($_POST['location_pressure_care']!='' && $_POST['location_pressure_care']!=null)
            {
                $count++;
                $contactData['location_pressure_care'] = $_POST['location_pressure_care'];
            
            // 

            }
            if($_POST['m_status']!='' && $_POST['m_status']!=null)
            {
                $count++;
                $contactData['m_status'] = $_POST['m_status'];
            }
            if($_POST['m_status_comment']!='' && $_POST['m_status_comment']!=null)
            {
                $count++;
                $contactData['m_status_comment'] = $_POST['m_status_comment'];
            
            // 

            }
            if($_POST['m_transfer']!='' && $_POST['m_transfer']!=null)
            {
                $count++;
                $contactData['m_transfer'] = $_POST['m_transfer'];
            }
            if($_POST['m_transfer_comment']!='' && $_POST['m_transfer_comment']!=null)
            {
                $count++;
                $contactData['m_transfer_comment'] = $_POST['m_transfer_comment'];
            
            // 

            }
            if($_POST['mobility_falls_risk']!='' && $_POST['mobility_falls_risk']!=null)
            {
                $count++;
                $contactData['mobility_falls_risk'] = $_POST['mobility_falls_risk'];
            }
            if($_POST['mobility_falls_risk_comment']!='' && $_POST['mobility_falls_risk_comment']!=null)
            {
                $count++;
                $contactData['mobility_falls_risk_comment'] = $_POST['mobility_falls_risk_comment'];

            }
            if($_POST['bowel_care_management']!='' && $_POST['bowel_care_management']!=null)
            {
                $count++;
                $contactData['bowel_care_management'] = $_POST['bowel_care_management'];

            }
            if($_POST['bowel_care_movement']!='' && $_POST['bowel_care_movement']!=null)
            {
                $count++;
                $contactData['bowel_care_movement'] = $_POST['bowel_care_movement'];

            }
            if($_POST['bowel_care_continent']!='' && $_POST['bowel_care_continent']!=null)
            {
                $count++;
                $contactData['bowel_care_continent'] = $_POST['bowel_care_continent'];

            }
            if($_POST['bowel_care_incontinent']!='' && $_POST['bowel_care_incontinent']!=null)
            {
                $count++;
                $contactData['bowel_care_incontinent'] = $_POST['bowel_care_incontinent'];

            }
            if($_POST['bowel_care_time_req']!='' && $_POST['bowel_care_time_req']!=null)
            {
                $count++;
                $contactData['bowel_care_time_req'] = $_POST['bowel_care_time_req'];

            }
            if($_POST['mobility_skin_care']!='' && $_POST['mobility_skin_care']!=null)
            {
                $count++;
                $contactData['mobility_skin_care'] = $_POST['mobility_skin_care'];
            }
            if($_POST['mobility_skin_care_precautions']!='' && $_POST['mobility_skin_care_precautions']!=null)
            {
                $count++;
                $contactData['mobility_skin_care_precautions'] = $_POST['mobility_skin_care_precautions'];
            }
            if($_POST['mobility_skin_care_checks']!='' && $_POST['mobility_skin_care_checks']!=null)
            {
                $count++;
                $contactData['mobility_skin_care_checks'] = $_POST['mobility_skin_care_checks'];
            }
            if($_POST['mobility_skin_care_whom']!='' && $_POST['mobility_skin_care_whom']!=null)
            {
                $count++;
                $contactData['mobility_skin_care_whom'] = $_POST['mobility_skin_care_whom'];
            }
            if($_POST['mobility_skin_care_pressure']!='' && $_POST['mobility_skin_care_pressure']!=null)
            {
                $count++;
                $contactData['mobility_skin_care_pressure'] = $_POST['mobility_skin_care_pressure'];
            }
            if($_POST['mobility_skin_care_pressure_areas']!='' && $_POST['mobility_skin_care_pressure_areas']!=null)
            {
                $count++;
                $contactData['mobility_skin_care_pressure_areas'] = $_POST['mobility_skin_care_pressure_areas'];
            }
            if($_POST['mobility_skin_care_pressure_description']!='' && $_POST['mobility_skin_care_pressure_description']!=null)
            {
                $count++;
                $contactData['mobility_skin_care_pressure_description'] = $_POST['mobility_skin_care_pressure_description'];
            // 

            }
            if($_POST['mobility_wound_dressing']!='' && $_POST['mobility_wound_dressing']!=null)
            {
                $count++;
                $contactData['mobility_wound_dressing'] = $_POST['mobility_wound_dressing'];
            }
            if($_POST['mobility_wound_dressing_who']!='' && $_POST['mobility_wound_dressing_who']!=null)
            {
                $count++;
                $contactData['mobility_wound_dressing_who'] = $_POST['mobility_wound_dressing_who'];
            // 

            }
            if($_POST['p_full_dentures']!='' && $_POST['p_full_dentures']!=null)
            {
                $count++;
                $contactData['p_full_dentures'] = $_POST['p_full_dentures'];
            }
            if($_POST['p_full_dentures_comment']!='' && $_POST['p_full_dentures_comment']!=null)
            {
                $count++;
                $contactData['p_full_dentures_comment'] = $_POST['p_full_dentures_comment'];
            // 

            }
            if($_POST['p_mouth_care']!='' && $_POST['p_mouth_care']!=null)
            {
                $count++;
                $contactData['p_mouth_care'] = $_POST['p_mouth_care'];
            }
            if($_POST['p_mouth_care_comment']!='' && $_POST['p_mouth_care_comment']!=null)
            {
                $count++;
                $contactData['p_mouth_care_comment'] = $_POST['p_mouth_care_comment'];
            // 

            }
            if($_POST['p_urinary']!='' && $_POST['p_urinary']!=null)
            {
                $count++;
                $contactData['p_urinary'] = $_POST['p_urinary'];
            }
            if($_POST['p_urinary_other']!='' && $_POST['p_urinary_other']!=null)
            {
                $count++;
                $contactData['p_urinary_other'] = $_POST['p_urinary_other'];
            }
            if($_POST['p_urinary_movemont']!='' && $_POST['p_urinary_movemont']!=null)
            {
                $count++;
                $contactData['p_urinary_movemont'] = $_POST['p_urinary_movemont'];
            }
            if($_POST['p_urinary_continent']!='' && $_POST['p_urinary_continent']!=null)
            {
                $count++;
                $contactData['p_urinary_continent'] = $_POST['p_urinary_continent'];
            }
            if($_POST['p_urinary_incontinent']!='' && $_POST['p_urinary_incontinent']!=null)
            {
                $count++;
                $contactData['p_urinary_incontinent'] = $_POST['p_urinary_incontinent'];
            }
            if($_POST['p_urinary_frequency_toileting']!='' && $_POST['p_urinary_frequency_toileting']!=null)
            {
                $count++;
                $contactData['p_urinary_frequency_toileting'] = $_POST['p_urinary_frequency_toileting'];
            }
            if($_POST['p_urinary_idc']!='' && $_POST['p_urinary_idc']!=null)
            {
                $count++;
                $contactData['p_urinary_idc'] = $_POST['p_urinary_idc'];
            }
            if($_POST['p_urinary_frequency']!='' && $_POST['p_urinary_frequency']!=null)
            {
                $count++;
                $contactData['p_urinary_frequency'] = $_POST['p_urinary_frequency'];
            }
            if($_POST['p_urinary_frequency_pad']!='' && $_POST['p_urinary_frequency_pad']!=null)
            {
                $count++;
                $contactData['p_urinary_frequency_pad'] = $_POST['p_urinary_frequency_pad'];
            // 

            }
            if($_POST['p_shower']!='' && $_POST['p_shower']!=null)
            {
                $count++;
                $contactData['p_shower'] = $_POST['p_shower'];
            }
            if($_POST['p_shower_needs']!='' && $_POST['p_shower_needs']!=null)
            {
                $count++;
                $contactData['p_shower_needs'] = $_POST['p_shower_needs'];
            }
            if($_POST['p_shower_frequency']!='' && $_POST['p_shower_frequency']!=null)
            {
                $count++;
                $contactData['p_shower_frequency'] = $_POST['p_shower_frequency'];
            // 

            }
            if($_POST['p_dressing']!='' && $_POST['p_dressing']!=null)
            {
                $count++;
                $contactData['p_dressing'] = $_POST['p_dressing'];
            }
            if($_POST['p_dressing_needs']!='' && $_POST['p_dressing_needs']!=null)
            {
                $count++;
                $contactData['p_dressing_needs'] = $_POST['p_dressing_needs'];
            }
            if($_POST['p_dressing_comment']!='' && $_POST['p_dressing_comment']!=null)
            {
                $count++;
                $contactData['p_dressing_comment'] = $_POST['p_dressing_comment'];
            // 

            }
            if($_POST['p_house']!='' && $_POST['p_house']!=null)
            {
                $count++;
                $contactData['p_house'] = $_POST['p_house'];
            }
            if($_POST['p_meal_needs']!='' && $_POST['p_meal_needs']!=null)
            {
                $count++;
                $contactData['p_meal_needs'] = $_POST['p_meal_needs'];
            }
            if($_POST['p_house_comment']!='' && $_POST['p_house_comment']!=null)
            {
                $count++;
                $contactData['p_house_comment'] = $_POST['p_house_comment'];
            // 

            }
            if($_POST['p_shopping']!='' && $_POST['p_shopping']!=null)
            {
                $count++;
                $contactData['p_shopping'] = $_POST['p_shopping'];
            }
            if($_POST['p_shopping_comment']!='' && $_POST['p_shopping_comment']!=null)
            {
                $count++;
                $contactData['p_shopping_comment'] = $_POST['p_shopping_comment'];
            // 

            }
            if($_POST['p_laundry']!='' && $_POST['p_laundry']!=null)
            {
                $count++;
                $contactData['p_laundry'] = $_POST['p_laundry'];
            }
            if($_POST['p_laundry_comment']!='' && $_POST['p_laundry_comment']!=null)
            {
                $count++;
                $contactData['p_laundry_comment'] = $_POST['p_laundry_comment'];
            // 

            }
            if($_POST['p_ironing']!='' && $_POST['p_ironing']!=null)
            {
                $count++;
                $contactData['p_ironing'] = $_POST['p_ironing'];
            }
            if($_POST['p_ironing_comment']!='' && $_POST['p_ironing_comment']!=null)
            {
                $count++;
                $contactData['p_ironing_comment'] = $_POST['p_ironing_comment'];
            // 

            }
            if($_POST['p_cleaning']!='' && $_POST['p_cleaning']!=null)
            {
                $count++;
                $contactData['p_cleaning'] = $_POST['p_cleaning'];
            }
            if($_POST['p_cleaning_comment']!='' && $_POST['p_cleaning_comment']!=null)
            {
                $count++;
                $contactData['p_cleaning_comment'] = $_POST['p_cleaning_comment'];
            // 

            }
            if($_POST['p_vacuuming']!='' && $_POST['p_vacuuming']!=null)
            {
                $count++;
                $contactData['p_vacuuming'] = $_POST['p_vacuuming'];
            }
            if($_POST['p_vacuuming_comment']!='' && $_POST['p_vacuuming_comment']!=null)
            {
                $count++;
                $contactData['p_vacuuming_comment'] = $_POST['p_vacuuming_comment'];
            // 

            }
            if($_POST['p_moping']!='' && $_POST['p_moping']!=null)
            {
                $count++;
                $contactData['p_moping'] = $_POST['p_moping'];
            }
            if($_POST['p_moping_comment']!='' && $_POST['p_moping_comment']!=null)
            {
                $count++;
                $contactData['p_moping_comment'] = $_POST['p_moping_comment'];
            // 

            }
            if($_POST['p_gardening']!='' && $_POST['p_gardening']!=null)
            {
                $count++;
                $contactData['p_gardening'] = $_POST['p_gardening'];
            }
            if($_POST['p_gardening_comment']!='' && $_POST['p_gardening_comment']!=null)
            {
                $count++;
                $contactData['p_gardening_comment'] = $_POST['p_gardening_comment'];

            // 

            }
            if($_POST['p_mail']!='' && $_POST['p_mail']!=null)
            {
                $count++;
                $contactData['p_mail'] = $_POST['p_mail'];
            }
            if($_POST['p_mail_comment']!='' && $_POST['p_mail_comment']!=null)
            {
                $count++;
                $contactData['p_mail_comment'] = $_POST['p_mail_comment'];

            // 

            }
            if($_POST['p_pet_care']!='' && $_POST['p_pet_care']!=null)
            {
                $count++;
                $contactData['p_pet_care'] = $_POST['p_pet_care'];
            }
            if($_POST['p_pet_care_comment']!='' && $_POST['p_pet_care_comment']!=null)
            {
                $count++;
                $contactData['p_pet_care_comment'] = $_POST['p_pet_care_comment'];

            // 

            }
            if($_POST['p_other']!='' && $_POST['p_other']!=null)
            {
                $count++;
                $contactData['p_other'] = $_POST['p_other'];
            }
            if($_POST['p_other_comment']!='' && $_POST['p_other_comment']!=null)
            {
                $count++;
                $contactData['p_other_comment'] = $_POST['p_other_comment'];

            // 

            }
            if($_POST['p_travelling']!='' && $_POST['p_travelling']!=null)
            {
                $count++;
                $contactData['p_travelling'] = $_POST['p_travelling'];
            }
            if($_POST['p_travelling_comment']!='' && $_POST['p_travelling_comment']!=null)
            {
                $count++;
                $contactData['p_travelling_comment'] = $_POST['p_travelling_comment'];

            // 

            }
            if($_POST['p_community_access']!='' && $_POST['p_community_access']!=null)
            {
                $count++;
                $contactData['p_community_access'] = $_POST['p_community_access'];
            }
            if($_POST['p_community_access_comment']!='' && $_POST['p_community_access_comment']!=null)
            {
                $count++;
                $contactData['p_community_access_comment'] = $_POST['p_community_access_comment'];

            // 

            }
            if($_POST['p_assistance_with_therapies']!='' && $_POST['p_assistance_with_therapies']!=null)
            {
                $count++;
                $contactData['p_assistance_with_therapies'] = $_POST['p_assistance_with_therapies'];
            }
            if($_POST['p_assistance_with_therapies_comment']!='' && $_POST['p_assistance_with_therapies_comment']!=null)
            {
                $count++;
                $contactData['p_assistance_with_therapies_comment'] = $_POST['p_assistance_with_therapies_comment'];

            // 

            }
            if($_POST['equipment']!='' && $_POST['equipment']!=null)
            {
                $count++;
                $contactData['equipment'] = $_POST['equipment'];
            }
            if($_POST['equipment_value']!='' && $_POST['equipment_value']!=null)
            {
                $count++;
                $contactData['equipment_value'] = $_POST['equipment_value'];
            }
            if($_POST['equipment_provided_by']!='' && $_POST['equipment_provided_by']!=null)
            {
                $count++;
                $contactData['equipment_provided_by'] = $_POST['equipment_provided_by'];
            }
            if($_POST['equipment_care_program']!='' && $_POST['equipment_care_program']!=null)
            {
                $count++;
                $contactData['equipment_care_program'] = $_POST['equipment_care_program'];
            }
            if($_POST['equipment_details']!='' && $_POST['equipment_details']!=null)
            {
                $count++;
                $contactData['equipment_details'] = $_POST['equipment_details'];

            // 

            }
            if($_POST['whs_obvious_hazards']!='' && $_POST['whs_obvious_hazards']!=null)
            {
                $count++;
                $contactData['whs_obvious_hazards'] = $_POST['whs_obvious_hazards'];
            }
            if($_POST['whs_obvious_hazards_comment']!='' && $_POST['whs_obvious_hazards_comment']!=null)
            {
                $count++;
                $contactData['whs_obvious_hazards_comment'] = $_POST['whs_obvious_hazards_comment'];


            // 

            }
            if($_POST['whs_manual_handling']!='' && $_POST['whs_manual_handling']!=null)
            {
                $count++;
                $contactData['whs_manual_handling'] = $_POST['whs_manual_handling'];
            }
            if($_POST['whs_manual_handling_comment']!='' && $_POST['whs_manual_handling_comment']!=null)
            {
                $count++;
                $contactData['whs_manual_handling_comment'] = $_POST['whs_manual_handling_comment'];


            // 

            }
            if($_POST['whs_electric']!='' && $_POST['whs_electric']!=null)
            {
                $count++;
                $contactData['whs_electric'] = $_POST['whs_electric'];
            }
            if($_POST['whs_electric_comment']!='' && $_POST['whs_electric_comment']!=null)
            {
                $count++;
                $contactData['whs_electric_comment'] = $_POST['whs_electric_comment'];

            // 

            }
            if($_POST['whs_gas']!='' && $_POST['whs_gas']!=null)
            {
                $count++;
                $contactData['whs_gas'] = $_POST['whs_gas'];
            }
            if($_POST['whs_gas_comment']!='' && $_POST['whs_gas_comment']!=null)
            {
                $count++;
                $contactData['whs_gas_comment'] = $_POST['whs_gas_comment'];

            // 

            }
            if($_POST['whs_security']!='' && $_POST['whs_security']!=null)
            {
                $count++;
                $contactData['whs_security'] = $_POST['whs_security'];
            }
            if($_POST['whs_security_comment']!='' && $_POST['whs_security_comment']!=null)
            {
                $count++;
                $contactData['whs_security_comment'] = $_POST['whs_security_comment'];
            // 

            }
            if($_POST['whs_lighting']!='' && $_POST['whs_lighting']!=null)
            {
                $count++;
                $contactData['whs_lighting'] = $_POST['whs_lighting'];
            }
            if($_POST['whs_lighting_comment']!='' && $_POST['whs_lighting_comment']!=null)
            {
                $count++;
                $contactData['whs_lighting_comment'] = $_POST['whs_lighting_comment'];
            // 

            }
            if($_POST['whs_uneven_surfaces']!='' && $_POST['whs_uneven_surfaces']!=null)
            {
                $count++;
                $contactData['whs_uneven_surfaces'] = $_POST['whs_uneven_surfaces'];
            }
            if($_POST['whs_uneven_surfaces_comment']!='' && $_POST['whs_uneven_surfaces_comment']!=null)
            {
                $count++;
                $contactData['whs_uneven_surfaces_comment'] = $_POST['whs_uneven_surfaces_comment'];
            // 

            }
            if($_POST['whs_infection_control']!='' && $_POST['whs_infection_control']!=null)
            {
                $count++;
                $contactData['whs_infection_control'] = $_POST['whs_infection_control'];
            }
            if($_POST['whs_infection_control_comment']!='' && $_POST['whs_infection_control_comment']!=null)
            {
                $count++;
                $contactData['whs_infection_control_comment'] = $_POST['whs_infection_control_comment'];
            // 

            }
            if($_POST['whs_other']!='' && $_POST['whs_other']!=null)
            {
                $count++;
                $contactData['whs_other'] = $_POST['whs_other'];
            }
            if($_POST['whs_other_comment']!='' && $_POST['whs_other_comment']!=null)
            {
                $count++;
                $contactData['whs_other_comment'] = $_POST['whs_other_comment'];
           

             }
            // if($_POST['whs_other_requirement']!='' && $_POST['whs_other_requirement']!=null)
            // {
            //     $count++;
            //     $contactData['whs_other_requirement'] = $_POST['whs_other_requirement'];
            // }
            if($_POST['whs_other_requirement_comment']!='' && $_POST['whs_other_requirement_comment']!=null)
            {
                $count++;
                $contactData['whs_other_requirement_comment'] = $_POST['whs_other_requirement_comment'];

            // 
            }
            if($_POST['whs_home_modification']!='' && $_POST['whs_home_modification']!=null)
            {
                $count++;
                $contactData['whs_home_modification'] = $_POST['whs_home_modification'];
            }
            if($_POST['whs_assistive_technology']!='' && $_POST['whs_assistive_technology']!=null)
            {
                $count++;
                $contactData['whs_assistive_technology'] = $_POST['whs_assistive_technology'];

            // 
            }
            if($_POST['gspn_participants_funded']!='' && $_POST['gspn_participants_funded']!=null)
            {
                $count++;
                $contactData['gspn_participants_funded'] = $_POST['gspn_participants_funded'];
            }
            if($_POST['gspn_client_appear']!='' && $_POST['gspn_client_appear']!=null)
            {
                $count++;
                $contactData['gspn_client_appear'] = $_POST['gspn_client_appear'];
            }
            if($_POST['gspn_comment']!='' && $_POST['gspn_comment']!=null)
            {
                $count++;
                $contactData['gspn_comment'] = $_POST['gspn_comment'];
            }
            if($_POST['gspn_traning_needs']!='' && $_POST['gspn_traning_needs']!=null)
            {
                $count++;
                $contactData['gspn_traning_needs'] = $_POST['gspn_traning_needs'];
            }
            if($_POST['gspn_details']!='' && $_POST['gspn_details']!=null)
            {
                $count++;
                $contactData['gspn_details'] = $_POST['gspn_details'];
            }
            if($_POST['gspn_risk_identification']!='' && $_POST['gspn_risk_identification']!=null)
            {
                $count++;
                $contactData['gspn_risk_identification'] = $_POST['gspn_risk_identification'];
            }
            if($_POST['gspn_need_risk_identification']!='' && $_POST['gspn_need_risk_identification']!=null)
            {
                $count++;
                $contactData['gspn_need_risk_identification'] = $_POST['gspn_need_risk_identification'];
            }
            if($_POST['gspn_risk_identification_details']!='' && $_POST['gspn_risk_identification_details']!=null)
            {
                $count++;
                $contactData['gspn_risk_identification_details'] = $_POST['gspn_risk_identification_details'];
            }
            if($_POST['gspn_written_consent']!='' && $_POST['gspn_written_consent']!=null)
            {
                $count++;
                $contactData['gspn_written_consent'] = $_POST['gspn_written_consent'];
            }
            if($_POST['gspn_notes']!='' && $_POST['gspn_notes']!=null)
            {
                $count++;
                $contactData['gspn_notes'] = $_POST['gspn_notes'];

            // 
            }
            if($_POST['assessment_by']!='' && $_POST['assessment_by']!=null)
            {
                $count++;
                $contactData['assessment_by'] = $_POST['assessment_by'];
            }
            if($_POST['assessment_position']!='' && $_POST['assessment_position']!=null)
            {
                $count++;
                $contactData['assessment_position'] = $_POST['assessment_position'];
            }
            if($_POST['assessment_date']!='' && $_POST['assessment_date']!=null)
            {
                $count++;
                $contactData['assessment_date'] = $_POST['assessment_date'];
            }
            if($_POST['assessment_review_date']!='' && $_POST['assessment_review_date']!=null)
            {
                $count++;
                $contactData['assessment_review_date'] = $_POST['assessment_review_date'];
            }
            if($_POST['assessment_change_date']!='' && $_POST['assessment_change_date']!=null)
            {
                $count++;
                $contactData['assessment_change_date'] = $_POST['assessment_change_date'];
            }


            if($_POST['id']!='' && $_POST['id']!=null)
            {

                if($_POST['assessment_signature_base']!='' && $_FILES['assessment_signature']['name']=='')
                {
                    $count++;
                    $contactData['assessment_signature_base'] = $_POST['assessment_signature_base'];
                    $contactData['assessment_signature'] = '';
                }
                if($_POST['assessment_signature_base']=='' && $_FILES['assessment_signature']['name']!='')
                {
                    $count++;
                    $contactData['assessment_signature_base'] = '';
                    
                    $uploadedFiles = handle_file_upload($_POST['id'],'assessment_signature', 'assessment_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'assessment_signature', [$file]);
                        }
                    }
                    $contactData['assessment_signature'] = '';

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'assessment_signature'))->row('file_name');
                    
                    $contactData['assessment_signature'] = base_url().'uploads/assessment_signature/'.$_POST['id'].'/'.$filename;

                }


                $count++;
                $contactData['updated_date'] = date('Y-m-d H:i:s');
                $this->db->where('client_id', $client_id);
                $this->db->where('id', $_POST['id']);
                $this->db->update(db_prefix().'integrate_client_assessment', $contactData);
                if($_POST['id'])
                {
                    // $this->db->where('client_id', $client_id);
                    // $this->db->where('firstid', $_POST['id']);
                    // $this->db->update(db_prefix().'integrate_client_assessment2', $contactData);

                    $totalCol = $this->db->get_where(db_prefix().'integrate_client_assessment')->num_fields();
                    $counttot = $count/$totalCol;
                    $mulcol = $counttot * 100;
                    $finalmulcol = round($mulcol,2);

                    $this->db->where('client_id', $client_id);
                    $this->db->where('form_id', 1);
                    $this->db->update(db_prefix() . 'form_allot', [
                        'updated_date' => date('Y-m-d H:i:s'),
                        'form_process' => $finalmulcol,
                    ]);
                    $msg = array('status' => true, 'message' =>'Successfully Updated!', 'result' =>$_POST['id']);

                }
                else
                {
                    $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
                }

            }
            else
            {
                $count++;
                $contactData['created_date'] = date('Y-m-d H:i:s');
                $check = $this->db->get_where(db_prefix().'integrate_client_assessment',array('client_id' => $client_id))->row();
                if(count($check)==0)
                {
                    $this->db->insert(db_prefix().'integrate_client_assessment', $contactData);
                    // echo $this->db->last_query(); die;
                    $lid = $this->db->insert_id();
                    if($lid)
                    {
                        

                        if($_POST['assessment_signature_base']!='' && $_FILES['assessment_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['assessment_signature_base'] = $_POST['assessment_signature_base'];
                            $contactDataIMG['assessment_signature'] = '';
                        }
                        if($_POST['assessment_signature_base']=='' && $_FILES['assessment_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['assessment_signature_base'] = '';
                            
                            $uploadedFiles = handle_file_upload($lid,'assessment_signature', 'assessment_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'assessment_signature', [$file]);
                                }
                            }
                            

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'assessment_signature'))->row('file_name');

                            $contactDataIMG['assessment_signature'] = base_url().'uploads/assessment_signature/'.$lid.'/'.$filename;
                        }

                        $this->db->where('client_id', $client_id);
                        $this->db->where('id', $lid);
                        $this->db->update(db_prefix().'integrate_client_assessment', $contactDataIMG);


                        // $contactData['client_id'] = $client_id;
                        // $contactData['firstid'] = $lid;
                        // $this->db->insert(db_prefix().'integrate_client_assessment2', $contactData);

                        $totalCol = $this->db->get_where(db_prefix().'integrate_client_assessment')->num_fields();
                        $counttot = $count/$totalCol;
                        $mulcol = $counttot * 100;
                        $finalmulcol = round($mulcol,2);

                        $this->db->where('client_id', $client_id);
                        $this->db->where('form_id', 1);
                        $this->db->update(db_prefix() . 'form_allot', [
                            'updated_date' => date('Y-m-d H:i:s'),
                            'form_process' => $finalmulcol,
                        ]);
                        $msg = array('status' => true, 'message' =>'Successfully Added!', 'result' =>$lid);
                    }
                    else
                    {
                        $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
                    }
                }
                else
                {
                    $msg = array('status' => false, 'message' => 'Already Have Entry', 'result' =>array());
                }
            }

        }         
        else
        {
            $msg = array('status' => false, 'message' => 'Please Send All The Parameters ', 'result' =>array());
        }
        $this->response($msg, REST_Controller::HTTP_OK);
    }


    
   
    
    

    
}
