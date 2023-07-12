<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/REST_Controller.php'); 

class Users extends REST_Controller {

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
	*@function User Login
	*-------------------------------------------------------------------*/
	public function signin()
	{
	    $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $phone = $postData['phone'];
        if($phone != '')
        {
            $otp   = mt_rand(1000, 9999);
    	    $exuser = $this->db->get_where(db_prefix().'mobile_user', array('phone' => $phone))->row('id');
    	    if($exuser)
    	    {
    	        $postdata['otp'] = $otp;
    	        $this->db->where('id', $exuser);
    	        $this->db->update(db_prefix().'mobile_user', $postdata);
    	    }
    	    else
    	    {
    	        $postdata['phone'] = $phone;
    	        $postdata['otp'] = $otp;
    	        $this->db->insert(db_prefix().'mobile_user', $postdata);
    	    }
    	    $data['moblie_no'] = $phone;
            $data['message']   = 'Immuni fit : Your verification code is '.$otp;
            send_sms($data, false);
            
            $msg = array('status' => true, 'message' =>'Otp Send Successfully!', 'result' => strval($otp));
        }
    	else
        {
            //$msg = array('status' => false, 'message' => strip_tags(validation_errors()), 'result' =>array());
            $msg = array('status' => false, 'message' => 'Mobile number required', 'result' =>array());
        } 
	    /*
	    $this->form_validation->set_rules('phone', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');
	    if ($this->form_validation->run() !== false) {
            
            
        }
        else
        {
            //$msg = array('status' => false, 'message' => strip_tags(validation_errors()), 'result' =>array());
            $msg = array('status' => false, 'message' => 'Invalid mobile number', 'result' =>array());
        }
        */
        $this->response($msg, REST_Controller::HTTP_OK);
	}
    
    /*-------------------------------------------------------------------
	*@function User Login
	*-------------------------------------------------------------------*/
	public function matchOTP()
	{
	    $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $phone = $postData['phone'];
        $otp = $postData['otp'];
        
	    $exuser = $this->db->get_where(db_prefix().'mobile_user', array('phone' => $phone, 'otp' => $otp))->row('id');
	    if($exuser)
	    {
	        $msg = array('status' => true, 'message' =>'Otp Match Successfully!', 'result' => array());   
	    }
	    else
	    {
	        $msg = array('status' => false, 'message' => 'Record Not Match', 'result' =>array());
	    }
        
	    /*
	    $this->form_validation->set_rules('phone', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');
	    if ($this->form_validation->run() !== false) {
            
            
        }
        else
        {
            //$msg = array('status' => false, 'message' => strip_tags(validation_errors()), 'result' =>array());
            $msg = array('status' => false, 'message' => 'Invalid mobile number', 'result' =>array());
        }
        */
        $this->response($msg, REST_Controller::HTTP_OK);
	}
    
	/*-------------------------------------------------------------------
	*@function User Login
	*-------------------------------------------------------------------*/
	public function login(){
		$postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
		
		//$this->form_validation->set_rules('password', 'password', 'required');
        //$this->form_validation->set_rules('mobile', _l('Mobile Number'), 'trim|required');
        $email = $postData['email'];
        $password = $postData['password'];
        if($email != '' && $password != '')
        {
            $success = $this->api_model->login($email,$password,false,false);
                
            if (is_array($success) && isset($success['memberinactive'])) {
                $msg = array('status' => false, 'message' => 'Inactive account', 'result' =>array());
            } elseif ($success == false) {
                $msg = array('status' => false, 'message' => 'Invalid email or password', 'result' =>array());
            }
            else
            {
                if($success)
                {
                    $data['id'] = $success->userid;
                    $data['name'] = $success->firstname;
                    $data['email'] = $success->email;
                    $data['phone'] = $success->phonenumber;
                    $data['alternative_mobile'] = $success->alternative_mobile;
                    $data['address'] = $this->db->get_where(db_prefix().'clients', array('userid' => $success->userid))->row('address');
                    $msg = array('status' => true, 'message' =>'Login successful!', 'result' => $data);   
                }
                else
                {
                    $msg = array('status' => false, 'message' =>'Record not found', 'result' => array());   
                }
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Email and password fields are required', 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function User register
	*-------------------------------------------------------------------*/
	public function signUp(){
		$postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
		
        if($postData['firstname'] != '' &&  $postData['email'] != '' &&  $postData['mobile'] != '' &&  $postData['address'] != '')
        {
            $error = 1;
            $firstname = $this->db->get_where(db_prefix().'contacts', array('email' => $postData['email']))->row('email');
            $phonenumber = $this->db->get_where(db_prefix().'contacts', array('phonenumber' => $postData['mobile']))->row('phonenumber');
            if($firstname)
            {
                $msg = array('status' => false, 'message' => $postData['email'].' is already exists', 'result' =>array());
                $error++;
            }
            if($phonenumber)
            {
                $msg = array('status' => false, 'message' => $postData['mobile'].' mobile number is already exists', 'result' =>array());
                $error++;
            }
            if($error == 1)
            {
                $success = $this->api_model->signUp($postData);
                if($success)
                {
                    $msg = array('status' => true, 'message' =>'SignUp successful!', 'result' => $success);
                }
                else
                {
                    //$msg = array('status' => false, 'message' => 'Inactive account', 'result' =>array());
                }
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'All fields are required', 'result' =>array());
        }
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function: Service List
	*-------------------------------------------------------------------*/
	public function forgotPassword()
	{
	    $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
	    if($postData['value'] != '' )
	    {
	        $email = $postData['value'];
	        $type = $postData['type'];
	        $otp = rand(1000,9999);
	        if($type == 'mobile')
	        {
	            $usermobile = $this->db->get_where(db_prefix().'contacts', array('phonenumber' => $email))->row('userid');
	            if($usermobile){
	                $this->db->where('userid', $usermobile);
                    $this->db->update(db_prefix() . 'contacts', [
                        'otp' => $otp,
                    ]);
                    
                    $data['moblie_no'] = $email;
                    $data['message']   = 'Caring Approach : Your verification code is '.$otp;
                    send_sms($data, false);
                    
                    $msg = array('status' => true, 'message' =>'Otp sent on your registered mobile number', 'result' => array());
	            }
	            else
	            {
	                $msg = array('status' => true, 'message' =>'Records are not matching', 'result' => array());
	            }
	        }
	        elseif($type == 'email')
	        {
	            $usermobile = $this->db->get_where(db_prefix().'contacts', array('email' => $email))->row('userid');
	            if($usermobile){
	                $this->db->where('userid', $usermobile);
                    $this->db->update(db_prefix() . 'contacts', [
                        'otp' => $otp,
                    ]);
                    
                    $message   = 'Caring Approach : Your verification code is '.$otp;
                    $sub = 'Request submitted for change password';
                    send_mail($email, $sub, $message);
                    $msg = array('status' => true, 'message' =>'Otp sent on your registered email Id', 'result' => array()); 
	            }
	            else
	            {
	                $msg = array('status' => true, 'message' =>'Records are not matching', 'result' => array());
	            }
	        }
	    }
	    else
        {
            $msg = array('status' => false, 'message' => 'All fields are required', 'result' =>array());
        }
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function: Verify OTP
	*-------------------------------------------------------------------*/
	public function verifyOTP()
	{
	    $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $phone = $postData['type'];
        $phone = $postData['value'];
        $otp = $postData['otp'];
        
	    $email = $postData['value'];
        $type = $postData['type'];
        $newPassword = rand(100000, 999999);
        if($type == 'mobile')
        {
            $usermobile = $this->db->get_where(db_prefix().'contacts', array('phonenumber' => $email, 'otp' => $otp))->row('userid');
            if($usermobile){
                $this->db->where('userid', $usermobile);
                $this->db->update(db_prefix() . 'contacts', [
                    'otp' => '',
                    'last_password_change' => date('Y-m-d H:i:s'),
                    'password'             => app_hash_password($newPassword),
                ]);
                
                $data['moblie_no'] = $email;
                $data['message']   = 'Caring Approach : Your password has been updated successfully! New password is '.$newPassword;
                send_sms($data, false);
                
                $msg = array('status' => true, 'message' =>'New password has been sent to your registered mobile number', 'result' => array());
            }
            else
            {
                $msg = array('status' => true, 'message' =>'Records are not matching', 'result' => array());
            }
        }
        elseif($type == 'email')
        {
            $usermobile = $this->db->get_where(db_prefix().'contacts', array('email' => $email, 'otp' => $otp))->row('userid');
            if($usermobile){
                $this->db->where('userid', $usermobile);
                $this->db->update(db_prefix() . 'contacts', [
                    'otp' => '',
                    'last_password_change' => date('Y-m-d H:i:s'),
                    'password'             => app_hash_password($newPassword),
                ]);
                
                $message   = 'Caring Approach : Your password has been updated successfully! New password is '.$newPassword;
                $sub = 'Your password has been changed successfully! ';
                send_mail($email, $sub, $message);
                
                $msg = array('status' => true, 'message' =>'New password has been sent to your registered email Id', 'result' => array()); 
            }
            else
            {
                $msg = array('status' => true, 'message' =>'Records are not matching', 'result' => array());
            }
        }
        $this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function User Profile update
	*-------------------------------------------------------------------*/
    public function profileUpdate(){
		$postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
		
        $userid = $postData['userid'];
        $name = $postData['name'];
        $mobile = $postData['mobile'];
        $alternative_mobile = $postData['alt_mobile'];
        if($userid != '' && $name != '' && $mobile != '')
        {
            $userData = $this->db->get_where(db_prefix().'contacts', array('userid' => $userid ))->num_rows();
            if($userData > 0)
            {
                $mobileunique = $this->db->get_where(db_prefix().'contacts', array('userid !=' => $userid, 'phonenumber' => $mobile))->num_rows();
                if($mobileunique)
                {
                    $msg = array('status' => true, 'message' =>'Mobile number already exists!', 'result' => array());
                }
                else
                {
                    if(preg_match('/^[0-9]{10}+$/', $mobile))
                    {
                        $status = '';
                        $message = '';
                        //$response = array();
                        if($alternative_mobile != '')
                        {
                            if(preg_match('/^[0-9]{10}+$/', $alternative_mobile))
                            {
                                $clientpost['company'] = $name;
                                $clientpost['phonenumber'] = $mobile;
                                $this->db->where('userid', $userid);
                                $this->db->update(db_prefix() . 'clients', $clientpost);
                                
                                $customerpost['firstname'] = $name;
                                $customerpost['phonenumber'] = $mobile;
                                $customerpost['alternative_mobile'] = $alternative_mobile;
                                $this->db->where('userid', $userid);
                                $this->db->update(db_prefix() . 'contacts', $customerpost);
                                
                                $status= true;
                                $message = 'Profile update successfully!';
                                //$msg = array('status' => true, 'message' =>'Profile update successfully!', 'result' => array());
                            }
                            else
                            {
                                $status= false;
                                $message = 'Enter valid alternative mobile number';
                                //$msg = array('status' => false, 'message' =>'Enter valid alternative mobile number', 'result' => array());
                            }
                        }
                        else
                        {
                            $clientpost['company'] = $name;
                            $clientpost['phonenumber'] = $mobile;
                            $this->db->where('userid', $userid);
                            $this->db->update(db_prefix() . 'clients', $clientpost);
                            
                            $customerpost['firstname'] = $name;
                            $customerpost['phonenumber'] = $mobile;
                            $this->db->where('userid', $userid);
                            $this->db->update(db_prefix() . 'contacts', $customerpost);
                            
                            $status= true;
                            $message = 'Profile update successfully!';
                            //$msg = array('status' => true, 'message' =>'Profile update successfully!', 'result' => array());
                        }
                        $success = $this->db->select('userid,firstname,email,phonenumber,alternative_mobile')->get_where(db_prefix().'contacts', array('userid' => $userid))->row();
                        $data['id'] = $success->userid;
                        $data['name'] = $success->firstname;
                        $data['email'] = $success->email;
                        $data['phone'] = $success->phonenumber;
                        $data['alternative_mobile'] = $success->alternative_mobile;
                        $data['address'] = $this->db->get_where(db_prefix().'clients', array('userid' => $success->userid))->row('address');
                        $msg = array('status' => $status, 'message' => $message, 'result' => $data);
                    }
                    else
                    {
                        $msg = array('status' => false, 'message' =>'Enter valid mobile number', 'result' => array());
                    }
                }
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Records are not matching', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records are not matching', 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function User multiple address add
	*-------------------------------------------------------------------*/
	public function addAddress(){
		$postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
		
        if($postData['userid'] != '' &&  $postData['address'] != '' &&  $postData['pincode'] != '' &&  $postData['address_type'] != '')
        {
            $extData = $this->db->get_where(db_prefix().'contacts', array('userid' => $postData['userid']))->num_rows();
            if($extData > 0)
            {
                $existingAdd = $this->db->get_where(db_prefix().'user_address', array('userid' => $postData['userid'], 'address' => $postData['address']))->num_rows();
                if($existingAdd)
                {
                    $msg = array('status' => false, 'message' => $postData['address'].' is already exists', 'result' =>array());
                }
                else
                {
                    $addressData['userid'] = $postData['userid'];
                    $addressData['address'] = $postData['address'];
                    $addressData['address_type'] = $postData['address_type'];
                    $addressData['pincode'] = $postData['pincode'];
                    $addressData['building_name'] = $postData['building_name'];
                    $addressData['floor_number'] = $postData['floor_number'];
                    $addressData['flat_number'] = $postData['flat_number'];
                    $addressData['additional_note'] = $postData['additional_note'];
                    $addressData['created_date'] = date('Y-m-d H:i:s');
                    $this->db->insert(db_prefix().'user_address', $addressData);
                    $lid = $this->db->insert_id();
                    if($lid)
                    {
                        $msg = array('status' => true, 'message' =>'Address added successfully!', 'result' => $postData['address']);
                    }
                    else
                    {
                        $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
                    }
                }
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Invalid account', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Address field is required', 'result' =>array());
        }
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function: Edit user address
	*-------------------------------------------------------------------*/
	public function editAddress(){
	    $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
	    $userid = $postData['userid'];
	    $addressId = $postData['addressId'];
	    if($userid != '' && $addressId != '')
	    {
	        $userdata = $this->db->get_where(db_prefix().'user_address', array('userid' => $userid, 'id' => $addressId))->result();
	        if(count($userdata) > 0)
	        {
	            $response = [];
	            foreach($userdata as $rrr)
                {
                    $data['id'] = $rrr->id;
                    $data['pincode'] = $rrr->pincode;
                    $data['building_name'] = $rrr->building_name;
                    $data['floor_number'] = $rrr->floor_number;
                    $data['flat_number'] = $rrr->flat_number;
                    $data['address'] = $rrr->address;
                    $data['address_type'] = $rrr->address_type;
                    $data['additional_note'] = $rrr->additional_note;
                    $response[] = $data;
                }
                if($response)
                {
                    $msg = array('status' => true, 'message' =>'Address list', 'result' => $response);
                }
                else
                {
                    $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
                }
	        }
	        else
	        {
	            $msg = array('status' => false, 'message' => 'Record not match', 'result' =>array());
	        }
	    }
        else
        {
            $msg = array('status' => false, 'message' => 'Invalid account', 'result' =>array());
        }	    	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function: Delete user address
	*-------------------------------------------------------------------*/
	public function deleteAddress(){
	    $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
	    $userid = $postData['userid'];
	    $addressId = $postData['addressId'];
	    if($userid != '' && $addressId != '')
	    {
	        $this->db->delete(db_prefix().'user_address', array('userid' => $userid, 'id' => $addressId));
	        $msg = array('status' => true, 'message' =>'Address remove successfully', 'result' => array());
	    }
        else
        {
            $msg = array('status' => false, 'message' => 'Invalid account', 'result' =>array());
        }	    	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function User address update
	*-------------------------------------------------------------------*/
	public function addressUpdate(){
		$postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
		$addressId = $postData['addressId'];
        if($postData['userid'] != '' &&  $postData['address'] != '' &&  $postData['pincode'] != '' &&  $postData['address_type'] != '' &&  $postData['addressId'] != '')
        {
            $extData = $this->db->get_where(db_prefix().'contacts', array('userid' => $postData['userid']))->num_rows();
            if($extData > 0)
            {
                $addressData['address'] = $postData['address'];
                $addressData['address_type'] = $postData['address_type'];
                $addressData['pincode'] = $postData['pincode'];
                $addressData['building_name'] = $postData['building_name'];
                $addressData['floor_number'] = $postData['floor_number'];
                $addressData['flat_number'] = $postData['flat_number'];
                $addressData['additional_note'] = $postData['additional_note'];
                
                $this->db->where('id', $addressId);   
                $this->db->where('userid', $userid);   
                $this->db->update(db_prefix().'user_address', $addressData);
                if($addressId)
                {
                    $msg = array('status' => true, 'message' =>'Address update successfully!', 'result' => $postData['address']);
                }
                else
                {
                    $msg = array('status' => false, 'message' => 'Record not match', 'result' =>array());
                }
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Invalid account', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Address field is required', 'result' =>array());
        }
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function: Service List
	*-------------------------------------------------------------------*/
	public function addressList(){
	    $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
	    $userid = $postData['userid'];
	    if($userid != '')
	    {
	        $userdata = $this->db->get_where(db_prefix().'user_address', array('userid' => $userid))->result();
	        if(count($userdata) > 0)
	        {
	            $response = [];
	            foreach($userdata as $rrr)
                {
                    $data['id'] = $rrr->id;
                    $data['pincode'] = $rrr->pincode;
                    $data['building_name'] = $rrr->building_name;
                    $data['floor_number'] = $rrr->floor_number;
                    $data['flat_number'] = $rrr->flat_number;
                    $data['address'] = $rrr->address;
                    $data['address_type'] = $rrr->address_type;
                    $data['additional_note'] = $rrr->additional_note;
                    $response[] = $data;
                }
                if($response)
                {
                    $msg = array('status' => true, 'message' =>'Address list', 'result' => $response);
                }
                else
                {
                    $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
                }
	        }
	        else
	        {
	            $msg = array('status' => false, 'message' => 'Record not match', 'result' =>array());
	        }
	    }
        else
        {
            $msg = array('status' => false, 'message' => 'Invalid account', 'result' =>array());
        }	    	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function User changePassword
	*-------------------------------------------------------------------*/
    public function changePassword(){
		$postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
		
        $userid = $postData['userid'];
        $oldpassword = $postData['oldpassword'];
        $newpasswordr = $postData['newpassword'];
        if($userid != '' && $oldpassword != '' && $newpasswordr != '')
        {
            $success = $this->clients_model->change_contact_password(
                $userid,
                $oldpassword,
                $newpasswordr
            );

            if (is_array($success) && isset($success['old_password_not_match'])) {
                //set_alert('danger', _l('client_old_password_incorrect'));
                $msg = array('status' => false, 'message' => _l('client_old_password_incorrect'), 'result' =>array());
            } elseif ($success == true) {
                //set_alert('success', _l('client_password_changed'));
                $msg = array('status' => true, 'message' =>_l('client_password_changed'), 'result' => array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records are not matching', 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function: Service List
	*-------------------------------------------------------------------*/
	public function servicesList(){
	    $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
	    $userid = $postData['userid'];
	    $email = $postData['email'];
	    if($userid != '' && $email != '')
	    {
	        $userdata = $this->db->get_where(db_prefix().'contacts', array('email' => $email, 'userid' => $userid))->num_rows();
	        if($userdata > 0)
	        {
	            $response = [];
	            $sliderArr = [];
	            $result = $this->db->get_where(db_prefix().'category', array('status' => 1, 'parent_id' => 0))->result();
	            
                if($result)
                {
                    foreach($result as $rrr)
                    {
                        if($rrr->name != '')
                        {
                            $url = '';
                            $filename = $this->db->get_where(db_prefix().'files', array('rel_type' => "category", "rel_id" => $rrr->id))->row('file_name');
                            if($filename)
                                $url = site_url('uploads/category/'. $rrr->id.'/'.$filename);
                            else
                                $url = site_url('uploads/No-image.jpeg');
                                
                            $data['id'] = $rrr->id;
                            $data['img'] = $url;
                            $data['title'] = $rrr->name;
                            $response[] = $data;
                        }
                    }
                    
                    $sliderRes = $this->db->get_where(db_prefix().'slider', array('status' => 1))->result();
                    if($sliderRes)
                    {
                        foreach($sliderRes as $s)
                        {
                            $filename = $this->db->get_where(db_prefix().'files', array('rel_id' => $s->id, 'rel_type' => 'slider'))->row('file_name');
                            if($filename != '')
                            {
                                $sliderArr[] = base_url('uploads/slider/'.$s->id.'/'.$filename);
                            }
                        }
                    }
                    if($response)
                    {
                        $msg = array('status' => true, 'message' =>'Services list', 'result' => $response, 'sliderResult' => $sliderArr);
                    }
                    else
                    {
                        $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
                    }
                }
                else
                {
                    $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
                }
	        }
	        else
	        {
	            $msg = array('status' => false, 'message' => 'Record not match', 'result' =>array());
	        }
	    }
        	    	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function: Product List
	*-------------------------------------------------------------------*/
	public function productList($sid = '', $userid = ''){
	    $result = $this->db->get_where(db_prefix().'product', array('status' => 1, 'category_id' => $sid))->result();
	    $totalQty = 0;
        $totalPrice = 0;
        if($result)
        {
            $response = [];
            foreach($result as $rrr)
            {
                if($rrr->title != '')
                {
                    $url = '';
                    $filename = $this->db->get_where(db_prefix().'files', array('rel_type' => "product", "rel_id" => $rrr->id))->row('file_name');
                    if($filename)
                        $url = site_url('uploads/product/'. $rrr->id.'/'.$filename);
                    else
                        $url = site_url('uploads/No-image.jpeg');
                    
                    $data['id'] = $rrr->id;
                    $data['img'] = $url;
                    $data['title'] = $rrr->title;
                    $data['service'] = categoryname($rrr->category_id);
                    $data['price'] = $rrr->price;
                    if($userid != '')
                    {
                        $tqty = $this->db->get_where(db_prefix().'_addtocart', array('userid' => $userid, 'product_id' => $rrr->id))->row('product_qtys');
                        $data['qty'] = ($tqty != '')?$tqty:0;
                        $totalQty = $tqty + $totalQty;
                        
                        $price_ = $tqty * $rrr->price;
    	                $totalPrice = $totalPrice + $price_;
                    }
                    else
                    {
                        $data['qty'] = 0;
                        $totalQty = 0;
                        $totalPrice = 0;
                    }
                        
                    $response[] = $data;
                }
            }
            if($response)
            {
                $msg = array('status' => true, 'message' =>'Product list', 'result' => $response, 'totalQty' => $totalQty, 'totalPrice' => $totalPrice);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array(), 'totalQty' => $totalQty, 'totalPrice' => $totalPrice);
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array(), 'totalQty' => $totalQty, 'totalPrice' => $totalPrice);
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function: Add on services List
	*-------------------------------------------------------------------*/
	public function addOnServicesList(){
	    $result = $this->db->get_where(db_prefix().'add_on_services', array('status' => 1))->result();
        if($result)
        {
            $response = [];
            foreach($result as $rrr)
            {
                if($rrr->title != '')
                {
                    $url = '';
                    $filename = $this->db->get_where(db_prefix().'files', array('rel_type' => "addOnServices", "rel_id" => $rrr->id))->row('file_name');
                    if($filename)
                        $url = site_url('uploads/addOnServices/'. $rrr->id.'/'.$filename);
                    else
                        $url = site_url('uploads/No-image.jpeg');
                    
                    $data['id'] = $rrr->id;
                    $data['img'] = $url;
                    $data['title'] = $rrr->title;
                    $data['price'] = $rrr->price;
                    $response[] = $data;
                }
            }
            if($response)
            {
                $msg = array('status' => true, 'message' =>'Add on services list', 'result' => $response);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	
	/*-------------------------------------------------------------------
	*@function: Add on services List
	*-------------------------------------------------------------------*/
	public function FAQs(){
	    $result = $this->db->get_where(db_prefix().'content', array('id' => 5))->row();
        if($result)
        {
            $response = [];
            $data['id'] = $result->id;
            $data['title'] = 'FAQs';
            $data['content'] = $result->description;
            $response[] = $data;
            if($response)
            {
                $msg = array('status' => true, 'message' =>'FAQs list', 'result' => $response);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function: All Product List
	*-------------------------------------------------------------------*/
	public function allProducts(){
	    $result = $this->db->select('id,title,price')->get_where(db_prefix().'product', array('status' => 1))->result();
        if($result)
        {
            $response = [];
            foreach($result as $rrr)
            {
                if($rrr->title != '')
                {
                    
                    $data['id'] = $rrr->id;
                    $data['title'] = $rrr->title;
                    $data['price'] = $rrr->price;
                    $response[] = $data;
                }
            }
            if($response)
            {
                $msg = array('status' => true, 'message' =>'Product list', 'result' => $response);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function: Pincode List
	*-------------------------------------------------------------------*/
	public function pincodeList(){
	    $result = $this->db->select('id,pincode')->get_where(db_prefix().'area_pincode', array('status' => 1))->result();
        if($result)
        {
            $response = [];
            foreach($result as $rrr)
            {
                if($rrr->pincode != '')
                {
                    
                    $data['id'] = $rrr->id;
                    $data['pincode'] = $rrr->pincode;
                    $response[] = $data;
                }
            }
            if($response)
            {
                $msg = array('status' => true, 'message' =>'Pincode list', 'result' => $response);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function: Area List
	*-------------------------------------------------------------------*/
	public function areaList(){
	    $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
	    $pincode = $postData['pincode'];
	    if($pincode)
	    {
	        $response = [];
	        $pincodeRes = $this->db->select('b.areaname,b.time_slot')->from(db_prefix().'area_pincode as a')->join(db_prefix().'area_new b','a.area_id = b.id','left')->where('a.pincode', $pincode)->get()->result();
	        if(count($pincodeRes) > 0)
	        {
	            foreach($pincodeRes as $r)
	            {
	                $data['areaname'] = $r->areaname;
	                $data['time_slot'] = explode(',',$r->time_slot);
                    $response[] = $data;
	            }
	            if($response)
                {
                    $msg = array('status' => true, 'message' =>'Area list', 'result' => $response);
                }
                else
                {
                    $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
                }
	        }
	        else
	        {
	            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
	        }
	    }
	    else
	    {
	        $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
	    }
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*
	public function signUp(){
		$postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
		
        if($postData['firstname'] != '' &&  $postData['dob'] != '' &&  $postData['mobile'] != '' &&  $postData['state'] != ''&&  $postData['city'] != '')
        {
            $error = 1;
            /*
            $firstname = $this->db->get_where(db_prefix().'_patient', array('name' => $postData['firstname']))->row('name');
            if($firstname)
            {
                $msg = array('status' => false, 'message' => $postData['firstname'].' name is already exists', 'result' =>array());
                $error++;
            }
            *//*
            $phonenumber = $this->db->get_where(db_prefix().'_patient', array('mobile' => $postData['mobile']))->num_rows();
            if($phonenumber > 0)
            {
                $msg = array('status' => false, 'message' => $postData['mobile'].' mobile number is already exists', 'result' =>array());
                $error++;
            }
            if($error == 1)
            {
                //$success = $this->api_model->signUp($postData);
                $postres['name'] = ucfirst($postData['firstname']);
                $postres['dob'] = date('Y-m-d', strtotime($postData['dob']));
                $postres['mobile'] = $postData['mobile'];
                $postres['state'] = $postData['state'];
                $postres['city'] = $postData['city'];
                $postres['role'] = 'Mobile';
                $postres['created_date'] = date('Y-m-d H:i:s');
                $this->db->insert(db_prefix().'_patient',$postres);
                $success = $this->db->insert_id();
                if($success)
                {
                    $msg = array('status' => true, 'message' =>'SignUp successful!', 'result' => $success);
                }
                else
                {
                    //$msg = array('status' => false, 'message' => 'Inactive account', 'result' =>array());
                }
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'All fields are required', 'result' =>array());
        }
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	*/
	/*-------------------------------------------------------------------
	*@function User register
	*-------------------------------------------------------------------*/
	public function register(){
	//	$postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
		
		$this->form_validation->set_rules('firstname', 'Firstname', 'required');
		$this->form_validation->set_rules('lastname', 'Lastname', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('dob', 'Date of Birth', 'required');
		$this->form_validation->set_rules('birth_time', 'Birth Time', 'required');
		$this->form_validation->set_rules('birth_place', 'Birth Place', 'required');
        $this->form_validation->set_rules('mobile', _l('Mobile number'), 'trim|required|is_unique[' . db_prefix() . 'contacts.email]|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules('password', _l('clients_register_password'), 'required');
        
        if ($this->form_validation->run() !== false) {
            
            $success = $this->api_model->register($_POST);
            if($success)
            {
                $msg = array('status' => true, 'message' =>'SignUp successful!', 'result' => $success);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Inactive account', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => strip_tags(validation_errors()), 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
		
	/*-------------------------------------------------------------------
	*@function Wallpaper
	*-------------------------------------------------------------------*/
	public function wallpaper(){
	    $result = $this->db->get_where(db_prefix().'wallpaper', array('status' => 1))->result();
        if($result)
        {
            $response = [];
            foreach($result as $rrr)
            {
                $attachment_array = $this->db->order_by('rel_id', 'desc')->get_where(db_prefix().'files', array('rel_type' => "wallpaper", "rel_id" => $rrr->id))->row('file_name');
                if($attachment_array)
                {
                    //$url = site_url('download/file/taskattachment/'. $rrr->attachment_key.'/'.$rrr->file_name);
                    $url = site_url('uploads/tasks/'. $rrr->id.'/'.$attachment_array);
                    if($attachment_array != '')
                    {
                        //$response['imgurl'] = $rrr->attachment_key;
                        //array_push($response, $url);
                        $data['id'] = $rrr->id;
                        $data['img'] = $url;
                        $response[] = $data;
                    }
                }
            }
            if($response)
            {
                $msg = array('status' => true, 'message' =>'Wallpaper list', 'result' => $response);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function User stateList
	*-------------------------------------------------------------------*/
	public function stateList(){
		
		$stateList = $this->db->get_where(db_prefix().'city')->result();
        if($stateList)
        {
            $msg = array('status' => true, 'message' =>'State list', 'result' => $stateList);
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function User cityList
	*-------------------------------------------------------------------*/
	public function cityList(){
		
		$postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
		if($postData['state_id'] != '')
		{
		    $cityList = $this->db->get_where(db_prefix().'area', array('city_id' => $postData['state_id']))->result();
            if($cityList)
            {
                $msg = array('status' => true, 'message' =>'City list', 'result' => $cityList);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }	
		}
    	else
        {
            $msg = array('status' => false, 'message' => 'Select state first', 'result' =>array());
        }
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function audioBook
	*-------------------------------------------------------------------*/
	public function audioBook(){
	    $result = $this->db->get_where(db_prefix().'audio_book', array('status' => 1))->result();
        if($result)
        {
            $response = [];
            //$attachment_array = $this->db->order_by('rel_id', 'desc')->get_where(db_prefix().'files', array('rel_type' => "wallpaper"))->result();
            if($result)
            {
                foreach($result as $rrr)
                {
                    $attachment_image = $this->db->get_where(db_prefix().'files', array("rel_type" => "audiobookimg", "rel_id" => $rrr->id))->row('file_name');
                    $attachment_audio = $this->db->get_where(db_prefix().'files', array("rel_type" => "audiobookfile", "rel_id" => $rrr->id))->row('file_name');
                    $attachment_imagepath = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_image);
                    $attachment_audiopath = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_audio);
                    
                    $data['id'] = $rrr->id;
                    $data['img'] = $attachment_imagepath;
                    $data['audio'] = $attachment_audiopath;
                    $data['title'] = $rrr->title;
                    $data['description'] = $rrr->description;
                    
                    $response[] = $data;
                }
            }
            if($response)
            {
                $msg = array('status' => true, 'message' =>'Audio books list', 'result' => $response);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function Instructionvideo
	*-------------------------------------------------------------------*/
	public function instractionVideo(){
	    $result = $this->db->get_where(db_prefix().'instraction_video', array('status' => 1))->result();
        if($result)
        {
            $response = [];
            if($result)
            {
                foreach($result as $rrr)
                {
                    $attachment_audio = $this->db->get_where(db_prefix().'files', array("rel_type" => "instractionVideofile", "rel_id" => $rrr->id))->row('file_name');
                    $attachment_audiopath = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_audio);
                    
                    $data['id'] = $rrr->id;
                    //$data['type'] = $this->db->get_where(db_prefix().'customers_groups', array('id' => $rrr->group_id))->row('name');
                    $data['title'] = $rrr->name;
                    $data['video'] = $attachment_audiopath;
                    
                    $response[] = $data;
                }
            }
            if($response)
            {
                $msg = array('status' => true, 'message' =>'Instruction video list', 'result' => $response);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function recommandedApps
	*-------------------------------------------------------------------*/
	public function recommandedApps(){
	    $result = $this->db->get_where(db_prefix().'recommended_apps', array('status' => 1))->result();
        if($result)
        {
            $response = [];
            if($result)
            {
                foreach($result as $rrr)
                {
                    $attachment_audio = $this->db->get_where(db_prefix().'files', array("rel_type" => "recommendedimg", "rel_id" => $rrr->id))->row('file_name');
                    $attachment_audiopath = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_audio);
                    $data['id'] = $rrr->id;
                    $data['img']= $attachment_audiopath;
                    $data['type'] = $this->db->get_where(db_prefix().'customers_groups', array('id' => $rrr->group_id))->row('name');
                    $data['title'] = $rrr->name;
                    $data['url'] = $rrr->url;
                    
                    $response[] = $data;
                }
            }
            if($response)
            {
                $msg = array('status' => true, 'message' =>'Recommended apps list', 'result' => $response);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function Assgnment
	*-------------------------------------------------------------------*/
	public function assignment(){
	    $uid = $_POST['userID'];
	    //$uid = 'Ng==';
	    if($uid)
	    {
	        $ID = base64_decode($uid);
	        $userData = $this->db->get_where(db_prefix().'contacts', array('userid' => $ID))->row();
	        //echo '<pre>'; print_r($userData);die;
	        $userage = todayAGE($userData->dob);
	        $result = '';
	        $categorywhere = '';
	        $cat = '';
	        if($userage < 3)
	        {
	            $cat = 'Infant';
	        }
	        elseif(2 < $userage && $userage < 15)
	        {
	            $cat = 'Child';
	        }    
	        elseif(14 < $userage && $userage < 61)
	        {
	            $cat = 'Adult';
	        }    
	        elseif(59 < $userage)
	        {
	            $cat = 'Old';
	        }   
	        
	        $result = $this->db->get_where(db_prefix().'quiz', array('status' => 1))->result();
            if($result)
            {
                $response = [];
                if($result)
                {
                    foreach($result as $rrr)
                    {
                        $categoryArr = explode(',',$rrr->category);
                        if($rrr->gender == $userData->gender || $rrr->gender == 'Both')
                        {
                            if(in_array($cat, $categoryArr))
                            {
                                $data['question'] = $rrr->question;
                                $data['options'] = json_decode($rrr->options);
                                $data['dosha'] = json_decode($rrr->dosha);
                                $data['weightage'] = json_decode($rrr->weightage);
                                $data['answer'] = $rrr->answer;
                                $data['category'] = $rrr->category;
                                $data['weightage'] = $rrr->weightage;
                                //$data['required'] = $rrr->required;
                                
                                $response[] = $data;
                            }
                        }
                    }
                }
                if($response)
                {
                    $msg = array('status' => true, 'message' =>'Assignment list', 'result' => $response);
                }
                else
                {
                    $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
                }
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
	    }
	    else
	    {
	        $msg = array('status' => false, 'message' => 'Invalid login', 'result' =>array());
	    }
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function mobileApp
	*-------------------------------------------------------------------*/
	public function mobileApp(){
	    $response = $this->db->get_where(db_prefix().'mobile_app')->row();
        if($response)
        {
            $result = [];
            $textarr = explode(',',$response->intro_text);
            $imgarr = explode(',',$response->intro_img);
            $data['splashScreen'] = site_url('uploads/mobileApp/'.$response->splash_screen);
            if($imgarr)
            {
                $data_ = [];
                $post_ = [];
                foreach($imgarr as $rr)
                {
                    if($rr != '')
                    {
                        //$data_[] = $
                        //array_push($data_, site_url('uploads/mobileApp/'.$rr));
                        $data_[] = site_url('uploads/mobileApp/'.$rr);
                    }
                    //$data_[] = $post;
                }
                foreach($textarr as $rr)
                {
                    if($rr != '')
                    {
                        $post_[] = str_replace('_',' ',$rr);
                    }
                }
                $data['title']= $post_;
                $data['img']= $data_;
                $result[] = $data;
            }
            $msg = array('status' => true, 'message' =>'Mobile App', 'result' => $result);
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
        }
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function Immunity
	*-------------------------------------------------------------------*/
	public function immunity(){
	    $response = $this->db->select('id,question_hindi,question_english,always,sometimes,never,updateddate')->get_where(db_prefix().'_immunity')->result();
        if($response)
        {
            $result = [];
            foreach($response as $res)
            {
                $data['question_en'] = $res->question_english;
                $data['question_hi'] = str_replace('&nbsp;',' ',$res->question_hindi);
                $data['always'] = $res->always;
                $data['sometimes'] = $res->sometimes;
                $data['never'] = $res->never;
                
                $result[] = $data;
            }
            $msg = array('status' => true, 'message' =>'Immunity List', 'result' => $result);
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
        }
	    
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function Happinesh
	*-------------------------------------------------------------------*/
	public function happinesh(){
	    $uid = $_POST['userID'];
	    $typeid = $_POST['type'];
	    //$uid = 'Ng==';
	    if($uid)
	    {
	        $response = $this->db->select('id,question_hindi,question_english,always,sometimes,never,updateddate')->get_where(db_prefix().'happinesh')->result();
            if($response)
            {
                $result = [];
                foreach($response as $res)
                {
                    if($typeid == 2)
                    {
                        $data['question'] = $res->question_english;
                    }
                    else
                    {
                        $data['question'] = $res->question_hindi;
                    }
                    $data['always'] = $res->always;
                    $data['sometimes'] = $res->sometimes;
                    $data['never'] = $res->never;
                    
                    $result[] = $data;
                }
                $msg = array('status' => true, 'message' =>'Happinesh List', 'result' => $result);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
	    }
	    else
	    {
	        $msg = array('status' => false, 'message' => 'Invalid login', 'result' =>array());
	    }
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function categoryList
	*-------------------------------------------------------------------*/
	public function categoryList(){
	    $result = $this->db->get_where(db_prefix().'category', array('status' => 1, 'parent_id' => 0))->result();
        if($result)
        {
            $response = [];
            if($result)
            {
                $countCategory = 0;
                $countSubCategory = 0;
                foreach($result as $rrr)
                {
                    $attachment_audio = $this->db->get_where(db_prefix().'files', array("rel_type" => "category", "rel_id" => $rrr->id))->row('file_name');
                    $attachment_audiopath = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_audio);
                    $data['id'] = $rrr->id;
                    $data['img']= $attachment_audiopath;
                    $data['title'] = $rrr->name;
                    $tsub = $this->db->get_where(db_prefix().'category', array('status' => 1, 'parent_id' => $rrr->id))->result();
                    $countSubCategory = $countSubCategory + count($tsub);
                    $data['countCategory'] = count($result);
                    $data['countSubCategory'] = count($countSubCategory);
                    $response[] = $data;
                }
            }
            if($response)
            {
                $msg = array('status' => true, 'message' =>'Category list', 'result' => $response);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function subCategoryList
	*-------------------------------------------------------------------*/
	public function subCategoryList($id, $deviceID){
	    if($id)
	    {
	        $result = $this->db->get_where(db_prefix().'category', array('status' => 1, 'parent_id' => $id))->result();
            if($result)
            {
                $response = [];
                if($result)
                {
                    foreach($result as $rrr)
                    {
                        $attachment_audio = $this->db->get_where(db_prefix().'files', array("rel_type" => "category", "rel_id" => $rrr->id))->row('file_name');
                        $attachment_audiopath = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_audio);
                        $data['categoryID'] = $rrr->parent_id;
                        $data['subCategoryID'] = $rrr->id;
                        $data['img']= $attachment_audiopath;
                        $data['title'] = $rrr->name;
                        $data['description'] = $rrr->description;
                        $bookmark = $this->db->get_where(db_prefix().'user_bookmark', array('deviceID' => $deviceID, 'subCategoryID' => $rrr->id))->num_rows();
                        if($bookmark > 0)
                        {
                            $data['bookmark'] = 1;
                        }
                        else
                        {
                            $data['bookmark'] = 0;
                        }
                        
                        $response[] = $data;
                    }
                }
                if($response)
                {
                    $msg = array('status' => true, 'message' =>'Sub category list', 'result' => $response);
                }
                else
                {
                    $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
                }
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
	    }
	    else
	    {
	        $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());   
	    }
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	
	
	/*-------------------------------------------------------------------
	*@function phrases list
	*-------------------------------------------------------------------*/
	public function phrases(){
	    $result = $this->db->get_where(db_prefix().'essential_phrases', array('status' => 1, 'parent_id' => 0))->result();
        if($result)
        {
            $response = [];
            if($result)
            {
                $countCategory = 0;
                $countSubCategory = 0;
                foreach($result as $rrr)
                {
                    $attachment_audio = $this->db->get_where(db_prefix().'files', array("rel_type" => "essential", "rel_id" => $rrr->id))->row('file_name');
                    $attachment_audiopath = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_audio);
                    $data['id'] = $rrr->id;
                    $data['img']= $attachment_audiopath;
                    $data['title'] = $rrr->name;
                    //$tsub = $this->db->get_where(db_prefix().'essential_phrases', array('status' => 1, 'parent_id' => $rrr->id))->result();
                    //$countSubCategory = $countSubCategory + count($tsub);
                    //$data['countCategory'] = count($result);
                    //$data['countSubCategory'] = count($countSubCategory);
                    $response[] = $data;
                }
            }
            if($response)
            {
                $msg = array('status' => true, 'message' =>'Phrases list', 'result' => $response);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	
	/*-------------------------------------------------------------------
	*@function subPhrases list
	*-------------------------------------------------------------------*/
		/*public function subPhrases($id){
	    if($id)
	    {
	        $result = $this->db->get_where(db_prefix().'essential_phrases', array('status' => 1, 'parent_id' => $id))->result();
            if($result)
            {
                $response = [];
                if($result)
                {
                    foreach($result as $rrr)
                    {
                        //$attachment_audio = $this->db->get_where(db_prefix().'files', array("rel_type" => "category", "rel_id" => $rrr->id))->row('file_name');
                        //$attachment_audiopath = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_audio);
                        $data['id'] = $rrr->id;
                        $data['img']= $attachment_audiopath;
                        //$data['parent_id'] = $rrr->parent_id;
                        $data['title'] = $rrr->name;
                        //$data['description'] = $rrr->description;
                        
                        $response[] = $data;
                    }
                }
                if($response)
                {
                    $msg = array('status' => true, 'message' =>'Sub phrases list', 'result' => $response);
                }
                else
                {
                    $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
                }
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
	    }
	    else
	    {
	        $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());   
	    }
 		$this->response($msg, REST_Controller::HTTP_OK);
	} */
	
	public function subPhrases($scat){
	    $result = $this->db->get_where(db_prefix().'listen', array('status' => 1, 'subPhrasesID' => $scat, 'user_id <' => 1))->result();
        if($result)
        {
            $response = [];
            if($result)
            {
                foreach($result as $rrr)
                {
                    $attachment_audio = $this->db->get_where(db_prefix().'files', array("rel_type" => "listenfile", "rel_id" => $rrr->id))->row('file_name');
                    $attachment_audiopath = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_audio);
                    $attachment_audio1 = $this->db->get_where(db_prefix().'files', array("rel_type" => "listenuser1", "rel_id" => $rrr->id))->row('file_name');
                    $attachment_audiopath1 = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_audio1);
                    $attachment_audio2 = $this->db->get_where(db_prefix().'files', array("rel_type" => "listenuser2", "rel_id" => $rrr->id))->row('file_name');
                    $attachment_audiopath2 = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_audio2);
                    $data['id'] = $rrr->id;
                    $data['category'] = $rrr->category_id;
                    $data['sub_category'] = $rrr->sub_category_id;
                    $data['audio']= $attachment_audiopath;
                    $data['user1']= $attachment_audiopath1;
                    $data['user2']= $attachment_audiopath2;
                    //$data['title'] = $this->db->get_where(db_prefix().'listen_name', array('id' => $rrr->user_id))->row('name');
                    $data['message'] = $rrr->message;
                    $response[] = $data;
                }
            }
            if($response)
            {
                $silence_audio = site_url('uploads/audio/2-seconds-and-500-milliseconds-of-silence.mp3');
                $msg = array('status' => true, 'message' =>'Sub Phrases list', 'result' => $response, 'silent_audio' => $silence_audio);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array(), 'silent_audio' => '');
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	
	/*-------------------------------------------------------------------
	*@function Listen 
	*-------------------------------------------------------------------*/
	public function listen($id, $scat){
	    $result = $this->db->get_where(db_prefix().'listen', array('status' => 1, 'category_id' => $id, 'sub_category_id' => $scat, 'user_id <' => 1))->result();
        if($result)
        {
            $response = [];
            if($result)
            {
                foreach($result as $rrr)
                {
                    $attachment_audio = $this->db->get_where(db_prefix().'files', array("rel_type" => "listenfile", "rel_id" => $rrr->id))->row('file_name');
                    $attachment_audiopath = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_audio);
                    $attachment_audio1 = $this->db->get_where(db_prefix().'files', array("rel_type" => "listenuser1", "rel_id" => $rrr->id))->row('file_name');
                    $attachment_audiopath1 = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_audio1);
                    $attachment_audio2 = $this->db->get_where(db_prefix().'files', array("rel_type" => "listenuser2", "rel_id" => $rrr->id))->row('file_name');
                    $attachment_audiopath2 = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_audio2);
                    $data['id'] = $rrr->id;
                    $data['category'] = $rrr->category_id;
                    $data['sub_category'] = $rrr->sub_category_id;
                    $data['audio']= $attachment_audiopath;
                    $data['user1']= $attachment_audiopath1;
                    $data['user2']= $attachment_audiopath2;
                    //$data['title'] = $this->db->get_where(db_prefix().'listen_name', array('id' => $rrr->user_id))->row('name');
                    $data['message'] = $rrr->message;
                    $response[] = $data;
                }
            }
            if($response)
            {
                $silence_audio = site_url('uploads/audio/2-seconds-and-500-milliseconds-of-silence.mp3');
                $msg = array('status' => true, 'message' =>'Listen list', 'result' => $response, 'silent_audio' => $silence_audio);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array(), 'silent_audio' => '');
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function Listen 
	*-------------------------------------------------------------------*/
	public function practice($id, $scat){
	    $result = $this->db->get_where(db_prefix().'listen', array('status' => 1, 'category_id' => $id, 'sub_category_id' => $scat, 'user_id >' => 0))->result();
        if($result)
        {
            $response = [];
            if($result)
            {
                foreach($result as $rrr)
                {
                    if($rrr->user_id != '')
                    {
                        $attachment_audio = $this->db->get_where(db_prefix().'files', array("rel_type" => "listenfile", "rel_id" => $rrr->id))->row('file_name');
                        $attachment_audiopath = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_audio);
                        /*
                        $attachment_audio1 = $this->db->get_where(db_prefix().'files', array("rel_type" => "listenuser1", "rel_id" => $rrr->id))->row('file_name');
                        $attachment_audiopath1 = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_audio1);
                        $attachment_audio2 = $this->db->get_where(db_prefix().'files', array("rel_type" => "listenuser2", "rel_id" => $rrr->id))->row('file_name');
                        $attachment_audiopath2 = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_audio2);
                        */
                        $data['id'] = $rrr->id;
                        $data['category'] = $rrr->category_id;
                        $data['sub_category'] = $rrr->sub_category_id;
                        $data['audio']= $attachment_audiopath;
                        //$data['silence-audio']= site_url('uploads/audio/5-seconds-of-silence.mp3');
                        
                        $data['userID']= $rrr->user_id;
                        $data['userName']= $this->db->get_where(db_prefix().'listen_name', array('id' => $rrr->user_id))->row('name');
                        $data['img']= site_url('assets/images/user-placeholder.jpg');
                        
                       // $data['user2']= $attachment_audiopath2;
                        //$data['title'] = $this->db->get_where(db_prefix().'listen_name', array('id' => $rrr->user_id))->row('name');
                        $data['message'] = $rrr->message;
                        $response[] = $data;
                    }
                }
            }
            if($response)
            {
                $silence_audio = site_url('uploads/audio/2-seconds-and-500-milliseconds-of-silence.mp3');
                $msg = array('status' => true, 'message' =>'Practice data', 'result' => $response, 'silent_audio' => $silence_audio);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array(), 'silent_audio' => '');
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function save record
	*-------------------------------------------------------------------*/
	public function saveRecord()
	{
	    //$postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
	    
	    $postData = $_POST;
	    
	    //print_r($_FILES);
	   // die();
	    $data['device_id'] = $postData['device_id'];
	    $data['categoryID'] = $postData['categoryID'];
	    $data['subCategoryID'] = $postData['subCategoryID'];
	    $data['userID'] = $postData['userID'];
	    $data['title'] = 'Record';
	    if($data['device_id'] != '' && $data['title'] != '')
	    {
	        if($_FILES['recording']['name'])
	        {
	            $this->db->insert(db_prefix().'user_record', $data);
    	        $id = $this->db->insert_id();
    	        if($id)
    	        {
    	            $uploadedFiles = handle_recording_array($id,'recording');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'recording', [$file]);
                        }
                        $attachment_audio = $this->db->get_where(db_prefix().'files', array("rel_type" => "recording", "rel_id" => $id))->row('file_name');
                        
                        $path2 =	'uploads/recording/'. $id.'/'. $attachment_audio;
    					//$sucess2 =  $this->fileUpload($postData['recording'], $path2);
    					$msg = array('status' => true, 'message' =>'Your file added successfully', 'result' => array());
                    }
    	        }
    	        else
    	        {
    	            $msg = array('status' => false, 'message' => 'Device id not found', 'result' =>array());
    	        }
	        }
    	    else
	        {
	            $msg = array('status' => false, 'message' => 'File are required', 'result' =>array());
	        }     
	    }
	    else
	    {
	        $msg = array('status' => false, 'message' => 'Device id is required', 'result' =>array());
	    }
	    $this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function list record
	*-------------------------------------------------------------------*/
	public function recordList()
	{
	    //$postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
	    $postData = $_POST;
	    $data['device_id'] = $postData['device_id'];
	    if($data['device_id'] != '')
	    {
	        $result = $this->db->order_by('id', 'desc')->get_where(db_prefix().'user_record', array('device_id' => $data['device_id']))->result();
            $response = [];
            if($result)
            {
                foreach($result as $rrr)
                {
                    $attachment_audio = $this->db->get_where(db_prefix().'files', array("rel_type" => "recording", "rel_id" => $rrr->id))->row('file_name');
                    if($attachment_audio != '')
                    {
                        $attachment_audiopath = site_url('uploads/recording/'. $rrr->id.'/'. $attachment_audio);
                        $data['category'] = categoryname($rrr->categoryID);
                        $data['subCategory'] = categoryname($rrr->subCategoryID);
                        $data['userName']= $this->db->get_where(db_prefix().'listen_name', array('id' => $rrr->userID))->row('name');
                        $data['audio']= $attachment_audiopath;
                        $data['timestamp']= strval(strtotime($rrr->createddate));
                        
                        $response[] = $data;
                    }
                }
            }
            if($response)
            {
                $msg = array('status' => true, 'message' =>'Record list data', 'result' => $response);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
	    }
	    else
	    {
	        $msg = array('status' => false, 'message' => 'Device id is required', 'result' =>array());
	    }
	    $this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function Language
	*-------------------------------------------------------------------*/
	public function languageList(){
	    $result = $this->db->get_where(db_prefix().'language', array('status' => 1))->result();
        if($result)
        {
            $response = [];
            if($result)
            {
                foreach($result as $rrr)
                {
                    $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $rrr->id, 'rel_type' => "languageflag"))->row('file_name');
                    $attachment = site_url('uploads/tasks/'. $rrr->id.'/'. $imageArray);
                    
                    $data['id'] = $rrr->id;
                    $data['img']= $attachment;
                    $data['title'] = $rrr->name;
                    $response[] = $data;
                }
            }
            if($response)
            {
                $msg = array('status' => true, 'message' =>'Language list', 'result' => $response);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
        }
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function setLanguage
	*-------------------------------------------------------------------*/
	public function setLanguage($id){
	    if($id)
	    {
	        $result = $this->db->get_where(db_prefix().'language', array('status' => 1, 'id'=> $id))->result();
            if($result)
            {
                $response = [];
                if($result)
                {
                    foreach($result as $rrr)
                    {
                        $data['id'] = $rrr->id;
                        $data['title'] = $rrr->name;
                        $response[] = $data;
                    }
                }
                if($response)
                {
                    $msg = array('status' => true, 'message' =>'Language list', 'result' => $response);
                }
                else
                {
                    $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
                }
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
	    }
	    else
	    {
	        $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());   
	    }
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	
	
	/*-------------------------------------------------------------------
	*@function Translation 
	*-------------------------------------------------------------------*/
	public function translation($id, $scat, $lang){
	    $result = $this->db->get_where(db_prefix().'listen', array('status' => 1, 'category_id' => $id, 'sub_category_id' => $scat, 'user_id <' => 1))->result();
        if($result)
        {
            $response = [];
            if($result)
            {
                foreach($result as $rrr)
                {
                    /*
                    $attachment_audio = $this->db->get_where(db_prefix().'files', array("rel_type" => "listenfile", "rel_id" => $rrr->id))->row('file_name');
                    $attachment_audiopath = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_audio);
                    $attachment_audio1 = $this->db->get_where(db_prefix().'files', array("rel_type" => "listenuser1", "rel_id" => $rrr->id))->row('file_name');
                    $attachment_audiopath1 = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_audio1);
                    $attachment_audio2 = $this->db->get_where(db_prefix().'files', array("rel_type" => "listenuser2", "rel_id" => $rrr->id))->row('file_name');
                    $attachment_audiopath2 = site_url('uploads/tasks/'. $rrr->id.'/'. $attachment_audio2);
                    */
                    $traResult = $this->db->get_where(db_prefix().'listen_translate', array('listen_id' => $rrr->id, 'language_id' => $lang))->row('message');
                    $data['id'] = $rrr->id;
                    $data['category'] = $rrr->category_id;
                    $data['sub_category'] = $rrr->sub_category_id;
                    /*
                    $data['audio']= $attachment_audiopath;
                    $data['user1']= $attachment_audiopath1;
                    $data['user2']= $attachment_audiopath2;
                    */
                    $data['message'] = $traResult;
                    $response[] = $data;
                }
            }
            if($response)
            {
                //$silence_audio = site_url('uploads/audio/2-seconds-and-500-milliseconds-of-silence.mp3');
                $msg = array('status' => true, 'message' =>'Translation list', 'result' => $response);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	
	/*-------------------------------------------------------------------
	*@function save record
	*-------------------------------------------------------------------*/
	public function addBookmark()
	{
	    //$postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
	    
	    $postData = $_POST;
	    
	    $data['deviceID'] = $postData['deviceID'];
	    $data['categoryID'] = $postData['categoryID'];
	    $data['subCategoryID'] = $postData['subCategoryID'];
	    if($data['deviceID'] != '' && $data['categoryID'] != '')
	    {
	        $bookRes = $this->db->get_where(db_prefix().'user_bookmark', array('deviceID' => $data['deviceID'], 'categoryID' => $data['categoryID'], 'subCategoryID' => $postData['subCategoryID']))->num_rows();
	        if($bookRes > 0)
	        {
	            
	        }
	        else
	        {
	            $this->db->insert(db_prefix().'user_bookmark', $data);
    	        $id = $this->db->insert_id();
    	        if($id)
    	        {
    	            $msg = array('status' => true, 'message' =>'Bookmark added successfully', 'result' => array());
    	        }
    	        else
    	        {
    	            $msg = array('status' => false, 'message' => 'Found some error', 'result' =>array());
    	        }
	        }
	    }
	    else
	    {
	        $msg = array('status' => false, 'message' => 'Device and category is required', 'result' =>array());
	    }
	    $this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function remove bookmard
	*-------------------------------------------------------------------*/
	public function removeBookmark($device_id, $subCategoryID)
	{
	    //$postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
	    
	    $postData = $_POST;
	    
	    if($device_id)
	    {
	        $this->db->where('deviceID', $device_id);
	        $this->db->where('subCategoryID', $subCategoryID);
            $this->db->delete(db_prefix() . 'user_bookmark');
            if ($this->db->affected_rows() > 0) {
                $msg = array('status' => true, 'message' =>'Bookmark remove successfully', 'result' => array());
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Record not found', 'result' =>array());
            }
	    }
	    else
	    {
	        $msg = array('status' => false, 'message' => 'Record not found', 'result' =>array());
	    }
	    $this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function: 
	*-------------------------------------------------------------------*/
	public function bookmarkList($device_id)
	{
	    //$postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
	    if($device_id != '')
	    {
	        $result = $this->db->order_by('id', 'desc')->get_where(db_prefix().'user_bookmark', array('deviceID' => $device_id))->result();
            $response = [];
            if($result)
            {
                foreach($result as $rrr)
                {
                    $data['bookmarkID'] = $rrr->id;
                    $data['categoryID'] = $rrr->categoryID;
                    $data['subCategoryID'] = $rrr->subCategoryID;
                    
                    $attachment_audio = $this->db->get_where(db_prefix().'files', array("rel_type" => "category", "rel_id" => $rrr->subCategoryID))->row('file_name');
                    $attachment_audiopath = site_url('uploads/tasks/'. $rrr->subCategoryID.'/'. $attachment_audio);
                    $data['img']= $attachment_audiopath;
                    $data['title'] = categoryname($rrr->subCategoryID);
                    $data['description'] = $this->db->get_where(db_prefix().'category', array('id' => $rrr->subCategoryID))->row('description');
                    
                    $response[] = $data;
                }
            }
            if($response)
            {
                $msg = array('status' => true, 'message' =>'Bookmark list data', 'result' => $response);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
	    }
	    else
	    {
	        $msg = array('status' => false, 'message' => 'Device id is required', 'result' =>array());
	    }
	    $this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function Subscription
	*-------------------------------------------------------------------*/
	public function subscriptions(){
	    $result = $this->db->get_where(db_prefix().'subscription', array('status' => 1))->result();
        if($result)
        {
            $response = [];
            if($result)
            {
                foreach($result as $rrr)
                {
                    $data['subscriptionID'] = $rrr->id;
                    $data['title'] = $rrr->title;
                    $data['price'] = $rrr->price;
                    
                    $response[] = $data;
                }
            }
            if($response)
            {
                $msg = array('status' => true, 'message' =>'Subscription list', 'result' => $response);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Data not found', 'result' =>array());
        }	
 		$this->response($msg, REST_Controller::HTTP_OK);
	}
	
	/*-------------------------------------------------------------------
	*@function File upload
	*-------------------------------------------------------------------*/
	private function fileUpload($img,$path){
		$img = str_replace('data:image/jpg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);

		$data = base64_decode($img);
 		return $success = file_put_contents($path, $data);
	}
	
	/*-------------------------------------------------------------------
	*@function Listen 
	*-------------------------------------------------------------------*/
	public function test(){
	    
	    /*
	    $text = "Hello this is a test for voice api of google";
        $text = urlencode($text);
        $lang = urldecode("en");
        $file  = "audio/" . md5($text) .".mp3";
       if (!file_exists($file) || filesize($file) == 0) {
         $mp3 = file_get_contents('http://translate.google.com/translate_tts?ie=UTF-8&q='.$text.'&tl='.$lang.'&total=2&idx=0&textlen='.strlen($text).'&prev=input');
         if(file_put_contents($file, $mp3)){
            echo "Saved<br>";
         }else{
            echo "Wasn't able to save it !<br>";
         }
       } else {
         echo "Already exist<br>";
       }
       
       */
       $this->load->view('textspeech');
	}
}
