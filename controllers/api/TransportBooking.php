<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/REST_Controller.php'); 

class TransportBooking extends REST_Controller {

    /**
     * Construct : A method to load all the helper, language and model files
     * validation_helper
     */
    public function __construct() {
        parent::__construct();
		$this->load->model('api/users_model','api_model',true);
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	 	date_default_timezone_set('Asia/Kolkata'); 
        
       
        Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
        Header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE, HEAD'); //method allowed
    }
    

    /*-------------------------------------------------------------------
    *@function Transport booking
    *-------------------------------------------------------------------*/
    public function addTransportBooking()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        if($postData['name'] != '' &&   $postData['email'] != '' &&  $postData['phonenumber'] != '' )
        {
           
            $contactData['name'] = $postData['name'];
            $contactData['email'] = $postData['email'];
            $contactData['phonenumber'] = $postData['phonenumber'];
            $contactData['date_of_transport'] = $postData['date_of_transport'];
            $contactData['booking_pickup_time'] = $postData['booking_pickup_time'];
            $contactData['no_of_passengers'] = $postData['no_of_passengers'];
            $contactData['pickup_location'] = $postData['pickup_location'];
            $contactData['destination'] = $postData['destination'];
            $contactData['return_trip'] = $postData['return_trip'];
            $contactData['is_driver_required_to_wait'] = $postData['is_driver_required_to_wait'];
            $contactData['wheelchair_accesible_transport'] = $postData['wheelchair_accesible_transport'];
            $contactData['note'] = $postData['note'];
            $contactData['ndis_number'] = $postData['ndis_number'];
            $contactData['partcipant_dob'] = $postData['partcipant_dob'];
            $contactData['coordinator'] = $postData['coordinator'];
            $contactData['plan_manager'] = $postData['plan_manager'];
            $contactData['claim_ndis'] = $postData['claim_ndis'];
            $contactData['invoices_to'] = $postData['invoices_to'];
            $contactData['location'] = $postData['location'];
            $contactData['office_date'] = $postData['office_date'];
            $contactData['booking_completed_by'] = $postData['booking_completed_by'];
            $contactData['signature'] = $postData['signature'];
            $contactData['created_date'] = YMD_date();
            $this->db->insert(db_prefix().'transport_booking', $contactData);

            $lid = $this->db->insert_id();
            if($lid)
            {

                // if($contactData['signature']!='')
                // {   
                    
                //     $path = base_url().'uploads/transport_booking/'.$lid.'/';
                //     $filess = handle_file_upload_base($postData['signature'],$path);
                   
                //     $uploadedFiles = handle_file_upload_base($lid,'transport_booking',$filess);
                //     if ($uploadedFiles && is_array($uploadedFiles)) {
                //         foreach ($uploadedFiles as $file) {
                //             $this->misc_model->add_attachment_to_database($lid, 'transport_booking', [$file]);
                //         }
                //     }

                // }




                $message1   = 'Caring Approach : Transport Booking Request';
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
                if($contactData['date_of_transport']!='')
                {
                    $message1   .= '<br>Date Of Transport : '.$contactData['date_of_transport'];
                }
                if($contactData['booking_pickup_time']!='')
                {
                    $message1   .= '<br>Booking Pickup Time : '.$contactData['booking_pickup_time'];
                }
                if($contactData['no_of_passengers']!='')
                {
                    $message1   .= '<br>No Of Passengers : '.$contactData['no_of_passengers'];
                }
                if($contactData['pickup_location']!='')
                {
                    $message1   .= '<br>Pickup Location : '.$contactData['pickup_location'];
                }
                if($contactData['destination']!='')
                {
                    $message1   .= '<br>Destination : '.$contactData['destination'];
                }
                if($contactData['return_trip']!='')
                {
                    $message1   .= '<br>Return Trip : '.$contactData['return_trip'];
                }
                if($contactData['is_driver_required_to_wait']!='')
                {
                    $message1   .= '<br>Is Driver Required To Wait : '.$contactData['is_driver_required_to_wait'];
                }
                if($contactData['wheelchair_accesible_transport']!='')
                {
                    $message1   .= '<br>Wheelchair Accesible Transport : '.$contactData['wheelchair_accesible_transport'];
                }
                if($contactData['note']!='')
                {
                    $message1   .= '<br>Note : '.$contactData['note'];
                }
                if($contactData['ndis_number']!='')
                {
                    $message1   .= '<br>NDIS Number : '.$contactData['ndis_number'];
                }
                if($contactData['partcipant_dob']!='')
                {
                    $message1   .= '<br>Partcipant Dob : '.$contactData['partcipant_dob'];
                }
                if($contactData['coordinator']!='')
                {
                    $message1   .= '<br>Coordinator : '.$contactData['coordinator'];
                }
                if($contactData['plan_manager']!='')
                {
                    $message1   .= '<br>Plan Manager : '.$contactData['plan_manager'];
                }
                if($contactData['claim_ndis']!='')
                {
                    $message1   .= '<br>Claim NDIS : '.$contactData['claim_ndis'];
                }
                if($contactData['invoices_to']!='')
                {
                    $message1   .= '<br>Invoices To : '.$contactData['invoices_to'];
                }
                if($contactData['location']!='')
                {
                    $message1   .= '<br>Location : '.$contactData['location'];
                }
                if($contactData['office_date']!='')
                {
                    $message1   .= '<br>Office Date : '.$contactData['office_date'];
                }
                if($contactData['booking_completed_by']!='')
                {
                    $message1   .= '<br>Booking Completed By : '.$contactData['booking_completed_by'];
                }
                $message1   .= '<br>Date : '.getDateTimeDMYOnly($contactData['created_date']);

                if($contactData['signature']!='')
                {
                    $message1   .= '<br>Signature : <br> <img src="'.$postData['signature'].'"  height="50px" width="200px">';

                }

                // $transport_bookingfilename = $this->db->order_by('id','DESC')->select('rel_id,file_name')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'transport_booking'))->result();

                // if(count($transport_bookingfilename)>0)
                // {
                //     foreach ($transport_bookingfilename as $value) 
                //     {
                //         $filepath = base_url().'uploads/transport_booking/'.$lid.'/'.$value->file_name;
                //         $message1   .= '<br>Signature : <br> <img src="'.$filepath.'"  height="50px">';
                       

                //     }

                // }


                // $message1   .= '<br>signature : '.$contactData['signature'];
                $sub1 = 'Request For Transport Booking';
                $data['msg'] = $message1;
                $tempmsg = $this->load->view('emailtemp', $data, true);
                send_mail('admin@caringapproach.com.au', $sub1, $tempmsg);
                send_mail('intakeact@caringapproach.com.au', $sub1, $tempmsg);
                send_mail('intakensw@caringapproach.com.au', $sub1, $tempmsg);
                // send_mail('aliakbar@immersiveinfotech.com', $sub1, $tempmsg);
                // send_mail('varun@immersiveinfotech.com', $sub1, $tempmsg);
                // send_mail('salman@immersiveinfotech.com', $sub1, $tempmsg);


                $msg = array('status' => true, 'message' =>'Booking Successfully Done!', 'result' =>array());
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
