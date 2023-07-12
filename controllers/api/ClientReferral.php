<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/REST_Controller.php'); 

class ClientReferral extends REST_Controller {

    /**
     * Construct : A method to load all the helper, language and model files
     * validation_helper
     */
    public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	 	date_default_timezone_set('Asia/Kolkata'); 
        
        
       
        Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        Header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE, HEAD'); //method allowed
    }
    

    /*-------------------------------------------------------------------
    *@function Transport booking
    *-------------------------------------------------------------------*/
    public function addClientReferral()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        if($postData['name'] != '' &&   $postData['email'] != '' &&  $postData['phonenumber'] != '' )
        {
           
            $contactData['name'] = $postData['name'];
            $contactData['gender'] = $postData['gender'];
            $contactData['dob'] = $postData['dob'];
            $contactData['email'] = $postData['email'];
            $contactData['phonenumber'] = $postData['phonenumber'];
            $contactData['mobile'] = $postData['mobile'];
            $contactData['start_date'] = $postData['start_date'];
            $contactData['end_date'] = $postData['end_date'];
            $contactData['address'] = $postData['address'];
            $contactData['self_managed'] = $postData['self_managed'];
            $contactData['funding_type'] = $postData['funding_type'];
            $contactData['reference_number'] = $postData['reference_number'];
            $contactData['coordinator'] = $postData['coordinator'];
            $contactData['plan_manager'] = $postData['plan_manager'];
            $contactData['invoice_email'] = $postData['invoice_email'];
            $contactData['referring_organization'] = $postData['referring_organization'];
            $contactData['primary_diagnosis'] = $postData['primary_diagnosis'];
            $contactData['specific_requirements'] = implode(",",$postData['specific_requirements']);
            $contactData['guardian_name'] = $postData['guardian_name'];
            $contactData['guardian_phonenumber'] = $postData['guardian_phonenumber'];
            $contactData['guardian_email'] = $postData['guardian_email'];
            $contactData['guardian_relationship'] = $postData['guardian_relationship'];
            $contactData['monday_morning'] = $postData['monday_morning'];
            $contactData['tuesday_morning'] = $postData['tuesday_morning'];
            $contactData['wednesday_morning'] = $postData['wednesday_morning'];
            $contactData['thursday_morning'] = $postData['thursday_morning'];
            $contactData['friday_morning'] = $postData['friday_morning'];
            $contactData['saturday_morning'] = $postData['saturday_morning'];
            $contactData['sunday_morning'] = $postData['sunday_morning'];

            $contactData['monday_midday'] = $postData['monday_midday'];
            $contactData['tuesday_midday'] = $postData['tuesday_midday'];
            $contactData['wednesday_midday'] = $postData['wednesday_midday'];
            $contactData['thursday_midday'] = $postData['thursday_midday'];
            $contactData['friday_midday'] = $postData['friday_midday'];
            $contactData['saturday_midday'] = $postData['saturday_midday'];
            $contactData['sunday_midday'] = $postData['sunday_midday'];

            $contactData['monday_afternoon'] = $postData['monday_afternoon'];
            $contactData['tuesday_afternoon'] = $postData['tuesday_afternoon'];
            $contactData['wednesday_afternoon'] = $postData['wednesday_afternoon'];
            $contactData['thursday_afternoon'] = $postData['thursday_afternoon'];
            $contactData['friday_afternoon'] = $postData['friday_afternoon'];
            $contactData['saturday_afternoon'] = $postData['saturday_afternoon'];
            $contactData['sunday_afternoon'] = $postData['sunday_afternoon'];

            $contactData['monday_evening'] = $postData['monday_evening'];
            $contactData['tuesday_evening'] = $postData['tuesday_evening'];
            $contactData['wednesday_evening'] = $postData['wednesday_evening'];
            $contactData['thursday_evening'] = $postData['thursday_evening'];
            $contactData['friday_evening'] = $postData['friday_evening'];
            $contactData['saturday_evening'] = $postData['saturday_evening'];
            $contactData['sunday_evening'] = $postData['sunday_evening'];

            $contactData['care_247_morning'] = $postData['care_247_morning'];
            $contactData['care_247_midday'] = $postData['care_247_midday'];
            $contactData['care_247_afternoon'] = $postData['care_247_afternoon'];
            $contactData['care_247_evening'] = $postData['care_247_evening'];
            $contactData['created_date'] = date('Y-m-d H:i:s');
            $this->db->insert(db_prefix().'client_referral', $contactData);
            // echo $this->db->last_query(); die;
            $lid = $this->db->insert_id();
            if($lid)
            {
                $message1   = 'Caring Approach : Client Referral Request';
                if($contactData['name']!='')
                {
                    $message1   .= '<br>Name : '.$contactData['name'];

                }
                if($contactData['email']!='')
                {
                    $message1   .= '<br>Email : '.$contactData['email'];
                }
                if($contactData['phonenumber']!='')
                {
                    $message1   .= '<br>Phone No : '.$contactData['phonenumber'];
                }
                if($contactData['mobile']!='')
                {
                    $message1   .= '<br>Mobile : '.$contactData['mobile'];
                }
                if($contactData['gender']!='')
                {
                    $message1   .= '<br>Gender : '.$contactData['gender'];
                }
                if($contactData['dob']!='')
                {
                    $message1   .= '<br>Date Of Birth : '.$contactData['dob'];
                }
                if($contactData['start_date']!='')
                {
                    $message1   .= '<br>Start Date : '.$contactData['start_date'];
                }
                if($contactData['end_date']!='')
                {
                    $message1   .= '<br>End Date : '.$contactData['end_date'];
                }
                if($contactData['address']!='')
                {
                    $message1   .= '<br>Address : '.$contactData['address'];
                }
                if($contactData['self_managed']!='')
                {
                    $message1   .= '<br>Self Managed : '.$contactData['self_managed'];
                }
                if($contactData['funding_type']!='')
                {
                    $message1   .= '<br>Funding Type : '.$contactData['funding_type'];
                }
                if($contactData['reference_number']!='')
                {
                    $message1   .= '<br>NDIS/My Aged Care Number : '.$contactData['reference_number'];
                }
                if($contactData['coordinator']!='')
                {
                    $message1   .= '<br>Coordinator : '.$contactData['coordinator'];
                }
                if($contactData['plan_manager']!='')
                {
                    $message1   .= '<br>Plan Manager : '.$contactData['plan_manager'];
                }
                if($contactData['invoice_email']!='')
                {
                    $message1   .= '<br>Invoice Email : '.$contactData['invoice_email'];
                }
                if($contactData['referring_organization']!='')
                {
                    $message1   .= '<br>Referring Organization : '.$contactData['referring_organization'];
                }
                if($contactData['primary_diagnosis']!='')
                {
                    $message1   .= '<br>Primary Diagnosis : '.$contactData['primary_diagnosis'];
                }
                if($contactData['specific_requirements']!='')
                {
                    $message1   .= '<br>Specific Requirements : '.implode(" , ",$postData['specific_requirements']);
                }
                if($contactData['guardian_name']!='')
                {
                    $message1   .= '<br>Guardian Name : '.$contactData['guardian_name'];
                }
                if($contactData['guardian_phonenumber']!='')
                {
                    $message1   .= '<br>Guardian Phone Number : '.$contactData['guardian_phonenumber'];
                }
                if($contactData['guardian_email']!='')
                {
                    $message1   .= '<br>Guardian Email : '.$contactData['guardian_email'];
                }
                if($contactData['guardian_relationship']!='')
                {
                    $message1   .= '<br>Guardian Relationship : '.$contactData['guardian_relationship'];
                }
                $message1   .= '<br>Date : '.getDateTimeDMYOnly($contactData['created_date']);
                $message1   .= '<br>';

                $message1   .= '<table style="border: 1px solid black;padding: 4px;">';
                $message1   .= '<tr>';
                $message1   .= '<th style="border: 1px solid black;padding: 4px;"> </th>';
                $message1   .= '<th style="border: 1px solid black;padding: 4px;"> Morning </th>';
                $message1   .= '<th style="border: 1px solid black;padding: 4px;"> Midday </th>';
                $message1   .= '<th style="border: 1px solid black;padding: 4px;"> Afternoon </th>';
                $message1   .= '<th style="border: 1px solid black;padding: 4px;"> Evening </th>';
                $message1   .= '</tr>';

                $message1   .= '<tr>';
                $message1   .= '<th style="border: 1px solid black;padding: 4px;"> Monday </th>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['monday_morning'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['monday_midday'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['monday_afternoon'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['monday_evening'].' </td>';
                $message1   .= '</tr>';

                $message1   .= '<tr>';
                $message1   .= '<th style="border: 1px solid black;padding: 4px;"> Tuesday </th>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['tuesday_morning'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['tuesday_midday'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['tuesday_afternoon'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['tuesday_evening'].' </td>';
                $message1   .= '</tr>';


                $message1   .= '<tr>';
                $message1   .= '<th  style="border: 1px solid black;padding: 4px;"> Wednesday </th>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['wednesday_morning'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['wednesday_midday'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['wednesday_afternoon'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['wednesday_evening'].' </td>';
                $message1   .= '</tr>';

                $message1   .= '<tr>';
                $message1   .= '<th  style="border: 1px solid black;padding: 4px;"> Thursday </th>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['thursday_morning'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['thursday_midday'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['thursday_afternoon'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['thursday_evening'].' </td>';
                $message1   .= '</tr>';

                $message1   .= '<tr>';
                $message1   .= '<th  style="border: 1px solid black;padding: 4px;"> Friday </th>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['friday_morning'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['friday_midday'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['friday_afternoon'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['friday_evening'].' </td>';
                $message1   .= '</tr>';

                $message1   .= '<tr>';
                $message1   .= '<th  style="border: 1px solid black;padding: 4px;"> Saturday </th>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['saturday_morning'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['saturday_midday'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['saturday_afternoon'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['saturday_evening'].' </td>';
                $message1   .= '</tr>';



                $message1   .= '<tr>';
                $message1   .= '<th  style="border: 1px solid black;padding: 4px;"> Sunday </th>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['sunday_morning'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['sunday_midday'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['sunday_afternoon'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['sunday_evening'].' </td>';
                $message1   .= '</tr>';



                $message1   .= '<tr>';
                $message1   .= '<th  style="border: 1px solid black;padding: 4px;"> 24/7 Care </th>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['care_247_morning'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['care_247_midday'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['care_247_afternoon'].' </td>';
                $message1   .= '<td style="border: 1px solid black;padding: 4px;"> '.$contactData['care_247_evening'].' </td>';
                $message1   .= '</tr>';
                $message1   .= '</table>';



                
                // $message1   .= '<br>signature : '.$contactData['signature'];
                $sub1 = 'Request For Client Referral';
                $data['msg'] = $message1;
                $tempmsg = $this->load->view('emailtemp', $data, true);
                send_mail('admin@caringapproach.com.au', $sub1, $tempmsg);
                send_mail('adminact@caringapproach.com.au', $sub1, $tempmsg);
                send_mail('intakeact@caringapproach.com.au', $sub1, $tempmsg);
                send_mail('intakensw@caringapproach.com.au', $sub1, $tempmsg);
                // send_mail('aliakbar@immersiveinfotech.com', $sub1, $tempmsg);
                // send_mail('varun@immersiveinfotech.com', $sub1, $tempmsg);
                //     send_mail('salman@immersiveinfotech.com', $sub1, $tempmsg);

                $msg = array('status' => true, 'message' =>'Send Successfully!', 'result' =>array());
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
            }
        }         
        else
        {
            $msg = array('status' => false, 'message' => 'Please Send All The Parameters ', 'result' =>array());
        }
        $this->response($msg, REST_Controller::HTTP_OK);
    }
	
	

	
}
