<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Authentication extends MY_Controller {

    /**
     * Construct : A method to load all the helper, language and model files
     * validation_helper
     */
    public function __construct() {
        parent::__construct();
        // $this->load->model('api/authentication_model','api_model',true);
        $this->load->model('api/users_model','api_model',true);
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Kolkata'); 
        
        $method = $this->router->fetch_method(); 
       if($method !='login' && $method!='signin' && $method != 'matchOTP' && $method !="resetPassword" && $method !="signUp" && $method !="forgotPassword" && $method !="verifyOTP"  && $method !="getState" ){
             $this->auth();
         }
    }



    private function generateToken($data,$type=''){
    
        $kunci = $this->config->item('thekey');
        $date = new DateTime();
        $token['id'] =  $data['id'];
        $token['userid'] =  $data['userid'];
        $token['email'] =  $data['email'];
        $token['role'] =  $data['role'];
        $token['login_user'] = $data['userid'];
 
        //$token['user_type'] =  $data->user_type;
        $token['iat'] = $date->getTimestamp();
        $token['exp'] = $date->getTimestamp() + 60*60*5; //To here is to generate token
        return JWT::encode($token,$kunci);
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
        $type = $postData['type'];
        $value = $postData['value'];
        $otp = $postData['otp'];
        $role = $postData['role'];
        if($type == 'email')
        {
            $exuser = $this->db->get_where(db_prefix().'contacts', array('email' => $value, 'otp' => $otp,'role'=>$role))->row('id');
            if($exuser)
            {
                $msg = array('status' => true, 'message' =>'Otp Match Successfully!', 'result' => array());   
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Record Not Match', 'result' =>array());
            }
        }
        if($type == 'mobile')
        {
            $exuser = $this->db->get_where(db_prefix().'contacts', array('phonenumber' => $value, 'otp' => $otp,'role'=>$role))->row('id');
            if($exuser)
            {
                $msg = array('status' => true, 'message' =>'Otp Match Successfully!', 'result' => array());   
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Record Not Match', 'result' =>array());
            }
        }
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    /*-------------------------------------------------------------------
    *@function User resetPassword
    *-------------------------------------------------------------------*/
    public function resetPassword()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $type = $postData['type'];
        $value = $postData['value'];
        $password = $postData['password'];
        $role = $postData['role'];
        if($type == 'email')
        {
            $exuser = $this->db->get_where(db_prefix().'contacts', array('email' => $value,'role'=>$role))->row('userid');
            if($exuser)
            {
                $this->db->where('userid', $exuser);
                $this->db->update(db_prefix() . 'contacts', [
                    'otp' => '',
                    'last_password_change' => date('Y-m-d H:i:s'),
                    'whp_password'             => $password,
                    'password'             => app_hash_password($password),
                ]);


                $msg = array('status' => true, 'message' =>'Your Password has been changed Successfully!', 'result' => array());   
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Record Not Match', 'result' =>array());
            }
        }
        if($type == 'mobile')
        {
            $exuser = $this->db->get_where(db_prefix().'contacts', array('phonenumber' => $value,'role'=>$role))->row('userid');
            if($exuser)
            {
                $this->db->where('userid', $exuser);
                $this->db->update(db_prefix() . 'contacts', [
                    'otp' => '',
                    'last_password_change' => date('Y-m-d H:i:s'),
                    'whp_password'             => $password,
                    'password'             => app_hash_password($password),
                ]);
                $msg = array('status' => true, 'message' =>'Your Password has been changed Successfully!', 'result' => array());   
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Record Not Match', 'result' =>array());
            }
        }
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    
    /*-------------------------------------------------------------------
    *@function User Login
    *-------------------------------------------------------------------*/
    public function login(){
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $email = $postData['email'];
        $password = $postData['password'];
        $role = $postData['role'];
        if($email != '' && $password != '')
        {
            $success = $this->api_model->login($email,$password,false,false,$role);

            if (is_array($success) && isset($success['memberinactive'])) {
                $msg = array('status' => false, 'message' => 'Inactive account', 'result' =>array());
            } elseif ($success == false) {
                $msg = array('status' => false, 'message' => 'Invalid email or password', 'result' =>array());
            }
            else
            {
                if($success)
                { 
                    $data['id'] = $success->id;
                    $data['userid'] = $success->userid;
                    $data['name'] = $success->firstname;
                    $data['email'] = $success->email;
                    $data['phone'] = $success->phonenumber;
                    $data['dob'] = $success->dob;
                    $data['gender'] = $success->gender;
                    $data['role'] = $success->role;
                    $data['registration_no'] = $success->registration_no;
                    $data['address'] = $this->db->get_where(db_prefix().'clients', array('userid' => $success->userid))->row('address');
                    $data['token'] = $this->generateToken($data);
                    $attachment_image = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array("rel_type" => "profile_image", "rel_id" => $success->userid))->row('file_name');
                    $attachment_imagepath = site_url('uploads/profile_image/'. $success->userid.'/'. $attachment_image);

                    if($attachment_image!='')
                    {
                        $data['profile_image'] = $attachment_imagepath;

                    }else{
                        $data['profile_image'] ='';
                    }
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
            $role = $postData['role'];
            $otp = rand(1000,9999);
            if($type == 'mobile')
            {
                $usermobile = $this->db->get_where(db_prefix().'contacts', array('phonenumber' => $email,'role'=>$role,'active'=>'1'))->row('userid');
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
                    $msg = array('status' => false, 'message' =>'Records are not matching', 'result' => array());
                }
            }
            elseif($type == 'email')
            {
                $usermobile = $this->db->get_where(db_prefix().'contacts', array('email' => $email,'role'=>$role,'active'=>'1'))->row('userid');
                if($usermobile){
                    $this->db->where('userid', $usermobile);
                    $this->db->update(db_prefix() . 'contacts', [
                        'otp' => $otp,
                    ]);
                    
                    $message   = 'Caring Approach : Your verification code is '.$otp;
                    $sub = 'Request submitted for forget password';
                    send_mail($email, $sub, $message);
                    $msg = array('status' => true, 'message' =>'Otp sent on your registered email Id', 'result' => array()); 
                }
                else
                {
                    $msg = array('status' => false, 'message' =>'Records are not matching', 'result' => array());
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
                    'last_password_change'      => date('Y-m-d H:i:s'),
                    'whp_password'              => $newPassword,
                    'password'                  => app_hash_password($newPassword),
                ]);
                
                $data['moblie_no'] = $email;
                $data['message']   = 'Caring Approach : Your password has been updated successfully! New password is '.$newPassword;
                send_sms($data, false);
                
                $msg = array('status' => true, 'message' =>'New password has been sent to your registered mobile number', 'result' => array());
            }
            else
            {
                $msg = array('status' => false, 'message' =>'Records are not matching', 'result' => array());
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
                    'whp_password'             => $newPassword,
                    'password'             => app_hash_password($newPassword),
                ]);
                
                $message   = 'Caring Approach : Your password has been updated successfully! New password is '.$newPassword;
                $sub = 'Your password has been changed successfully! ';
                send_mail($email, $sub, $message);
                
                $msg = array('status' => true, 'message' =>'New password has been sent to your registered email Id', 'result' => array()); 
            }
            else
            {
                $msg = array('status' => false, 'message' =>'Records are not matching', 'result' => array());
            }
        }
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    
    /*-------------------------------------------------------------------
    *@function User Profile update
    *-------------------------------------------------------------------*/
    public function profileUpdate(){
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
       
        $userid = $this->user_data->userid;
        $firstname = $postData['firstname'];
        $lastname = $postData['lastname'];
      
        $phonenumber = $postData['phonenumber'];
        $alternative_mobile = $postData['alternative_mobile'];
        $dob = date('Y-m-d',strtotime($postData['dob']));
        $address = $postData['address'];
        $state = $postData['state'];
        $city = $postData['city'];
        $country = $postData['country'];
        $postal_code = $postData['postal_code'];
        $address2 = $postData['address2'];
        $state2 = $postData['state2'];
        $city2 = $postData['city2'];
        $gender = $postData['gender'];
        $country2 = $postData['country2'];
        $postal_code2 = $postData['postal_code2'];
        $budget_amount = $postData['budget_amount'];
        // $service_type = $postData['service_type'];
        // $caring_plan = $postData['caring_plan'];
        $office_location = $postData['office_location'];
   
        if($userid != '' && $firstname != '' && $phonenumber != '')
        {
            $userData = $this->db->get_where(db_prefix().'contacts', array('userid' => $userid))->num_rows();
            if($userData > 0)
            {
                
                if(preg_match('/^[0-9]{10}+$/', $phonenumber))
                {
                    $status = '';
                    $message = '';
                    //$response = array();
                    if($alternative_mobile != '')
                    {
                        if(preg_match('/^[0-9]{10}+$/', $alternative_mobile))
                        {
                            $clientpost['company'] = $firstname.' '.$lastname;
                            $clientpost['phonenumber'] = $phonenumber;
                            $clientpost['country'] = $country;
                            $clientpost['city'] = $city;
                            $clientpost['zip'] = $postal_code;
                            $clientpost['state'] = $state;
                            $clientpost['address'] = $address;
                            $this->db->where('userid', $userid);
                            $this->db->update(db_prefix() . 'clients', $clientpost);

                            $customerpost['firstname'] = $firstname;
                            $customerpost['lastname'] = $lastname;
                            $customerpost['phonenumber'] = $phonenumber;
                            $customerpost['alternative_mobile'] = $alternative_mobile;
                            // $customerpost['email'] = $email;
                            $customerpost['dob'] = $dob;
                            $customerpost['address'] = $address;
                            $customerpost['state'] = $state;
                            $customerpost['city'] = $city;
                            $customerpost['country'] = $country;
                            $customerpost['postal_code'] = $postal_code;
                            $customerpost['gender'] = $gender;
                            $customerpost['address2'] = $address2;
                            $customerpost['state2'] = $state2;
                            $customerpost['city2'] = $city2;
                            $customerpost['country2'] = $country2;
                            $customerpost['postal_code2'] = $postal_code2;
                            $customerpost['gender'] = $gender;
                            $customerpost['office_location'] = $office_location;
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
                        $clientpost['company'] =  $firstname.' '.$lastname;
                        $clientpost['phonenumber'] = $phonenumber;
                        $clientpost['country'] = $country;
                        $clientpost['city'] = $city;
                        $clientpost['zip'] = $postal_code;
                        $clientpost['state'] = $state;
                        $clientpost['address'] = $address;
                        $this->db->where('userid', $userid);
                        $this->db->update(db_prefix() . 'clients', $clientpost);
                        
                        $customerpost['firstname'] = $firstname;
                        $customerpost['lastname'] = $lastname;
                        $customerpost['phonenumber'] = $phonenumber;
                        $customerpost['alternative_mobile'] = $alternative_mobile;
                        // $customerpost['email'] = $email;
                        $customerpost['dob'] = $dob;
                        $customerpost['address'] = $address;
                        $customerpost['state'] = $state;
                        $customerpost['city'] = $city;
                        $customerpost['country'] = $country;
                        $customerpost['postal_code'] = $postal_code;
                        $customerpost['gender'] = $gender;
                        $customerpost['address2'] = $address2;
                        $customerpost['state2'] = $state2;
                        $customerpost['city2'] = $city2;
                        $customerpost['country2'] = $country2;
                        $customerpost['postal_code2'] = $postal_code2;
                        $customerpost['office_location'] = $office_location;
                        $this->db->where('userid', $userid);
                        $this->db->update(db_prefix() . 'contacts', $customerpost);
                        
                        $status= true;
                        $message = 'Profile update successfully!';
                        //$msg = array('status' => true, 'message' =>'Profile update successfully!', 'result' => array());
                    }
                    

                    $success = $this->db->select('userid,firstname,lastname,email,phonenumber,alternative_mobile,email,dob,address,state,city,country,postal_code,address2,state2,city2,country2,postal_code2,service_type,department_id,gender,office_location')->get_where(db_prefix().'contacts', array('userid' => $userid))->row();


                    $success->servicename  =    servicename($success->service_type);
                    $success->departmentname  =    departementname($success->department_id);

                    $attachment_image = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array("rel_type" => "profile_image", "rel_id" => $userid))->row('file_name');
                    $attachment_imagepath = site_url('uploads/profile_image/'. $userid.'/'. $attachment_image);

                    if($attachment_image!='')
                    {
                        $success->profile_image = $attachment_imagepath;

                    }else{
                        $success->profile_image ='';
                    }
                    
                    $msg = array('status' => $status, 'message' => $message, 'result' => $success);
                }
                else
                {
                    $msg = array('status' => false, 'message' =>'Enter valid mobile number', 'result' => array());
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
    *@function User Profile Image update
    *-------------------------------------------------------------------*/
    public function profileImageUpdate()
    {
        $userid = $this->user_data->userid;
        if($userid!='' && $_FILES['profile_image']['name']!='')
        {
            $uploadedFiles = handle_file_upload($userid,'profile_image', 'profile_image');
             // print_r($uploadedFiles); die;
            if ($uploadedFiles && is_array($uploadedFiles)) {
                foreach ($uploadedFiles as $file) {
                    $this->misc_model->add_attachment_to_database($userid, 'profile_image', [$file]);
                }
            }

            // print_r($uploadedFiles);
            
            $status= true;
            $message = 'Profile Image Updated Successfully!';
            //$msg = array('status' => true, 'message' =>'Profile update successfully!', 'result' => array());
                       

            $attachment_image = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array("rel_type" => "profile_image", "rel_id" => $userid))->row('file_name');
            $attachment_imagepath = site_url('uploads/profile_image/'. $userid.'/'. $attachment_image);

            if($attachment_image!='')
            {
                $profile_image = $attachment_imagepath;

            }else{
                $profile_image ='';
            }
                    
            $msg = array('status' => $status, 'message' => $message, 'profile_image' => $profile_image);
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Record Not Match', 'result' =>array());
        }   
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    
    /*-------------------------------------------------------------------
    *@function get User Profile update
    *-------------------------------------------------------------------*/
   public function getProfileUpdate()
   {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $userid = $this->user_data->userid;
       
        
        if($userid != '')
        {
            $userData = $this->db->get_where(db_prefix().'contacts', array('userid' => $userid ))->num_rows();
            if($userData > 0)
            {
                  

               
                $success = $this->db->select('id,role,userid,firstname as name ,firstname,lastname,email,phonenumber as phone,phonenumber,alternative_mobile,email,dob,address,state,city,country,postal_code,address2,state2,city2,country2,postal_code2,service_type,gender,office_location,department_id,budget_amount,doj')->get_where(db_prefix().'contacts', array('userid' => $userid))->row();

                $success->servicename  =    servicename($success->service_type);
                $success->departmentname  =    departementname($success->department_id);


                $attachment_image = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array("rel_type" => "profile_image", "rel_id" => $userid))->row('file_name');
                    $attachment_imagepath = site_url('uploads/profile_image/'. $userid.'/'. $attachment_image);

                    if($attachment_image!='')
                    {
                         $success->profile_image = $attachment_imagepath;

                    }else{
                         $success->profile_image ='';
                    }

                        
                $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $success);
                
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Records are not matching', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records are not matching');
        }   
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    
    /*-------------------------------------------------------------------
    *@function User changePassword
    *-------------------------------------------------------------------*/
    public function changePassword(){
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $userid = $this->user_data->userid;
        $oldpassword = $postData['oldpassword'];
        $newpasswordr = $postData['newpassword'];
        if($userid != '' && $oldpassword != '' && $newpasswordr != '')
        {
            $success = $this->api_model->change_contact_password(
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
    *@function Contact US
    *-------------------------------------------------------------------*/
 
    public function getCountry()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
       
        $data = $this->db->get_where(db_prefix().'country', array('is_active' => 1))->result();
            
            
        $msg = array('status' => true, 'message' =>'Result Found!', 'result' => $data);
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function getState()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));

        $country_id = $postData['country_id'];

        $success = $this->db->get_where(db_prefix().'state', array('country_id' => $country_id,'is_active' => 1))->result();
        if($success > 0)
        {    
            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $success);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
        }
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function getCity()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $state_id = $postData['state_id'];

        $success = $this->db->get_where(db_prefix().'city', array('state_id' => $state_id,'is_active' => 1))->result();
        
        if($success > 0)
        {    
            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $success);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
        }
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    
    

    
}
