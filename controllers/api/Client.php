<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Client extends MY_Controller {

    /**
     * Construct : A method to load all the helper, language and model files
     * validation_helper
     */
    public function __construct() {
        parent::__construct();
        // $this->load->model('api/authentication_model','api_model',true);
        $this->load->model('api/client_model','api_model',true);
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Kolkata'); 
        
         
        $method = $this->router->fetch_method(); 
        if($method !='login' && $method !='login_as' && $method!='signin' && $method != 'matchOTP' && $method !="resetPassword" && $method !="signUp" && $method !="forgotPassword" && $method !="verifyOTP" && $method !="getCountry" && $method !="getState" && $method !="getCity" && $method !="getTimeSlot" ){
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
    public function login()
    {
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
                    $data['role'] = $success->role;
                    $data['dob'] = $success->dob;
                    $data['gender'] = $success->gender;
                    $data['registration_no'] = $success->registration_no;
                    $data['address'] = $this->db->get_where(db_prefix().'clients', array('userid' => $success->userid))->row('address');
                    $data['token'] = $this->generateToken($data);
                    $attachment_image = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array("rel_type" => "profile_image", "rel_id" => $success->id))->row('file_name');
                    $attachment_imagepath = site_url('uploads/profile_image/'. $success->id.'/'. $attachment_image);

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
    *@function User Login
    *-------------------------------------------------------------------*/
    public function login_as()
    {
         
         $userid = base64_decode($_GET['key']);
           
        $success =   $this->db->get_where(db_prefix().'contacts', array('userid' => $userid,'role'=>'2'))->row();
        if(count($success)>0)
        { 
            $data['id'] = $success->id;
            $data['userid'] = $success->userid;
            $data['name'] = $success->firstname;
            $data['email'] = $success->email;
            $data['phone'] = $success->phonenumber;
            $data['role'] = $success->role;
            $data['dob'] = $success->dob;
            $data['gender'] = $success->gender;
            $data['registration_no'] = $success->registration_no;
            $data['address'] = $success->address;
            
            $token = $this->generateToken($data);

            $msg = array('status'=> true,'result'=>$token); 
        
        }
        else
        {
              $msg = array('status'=> true,'result'=>array());
        }
           
        $this->response($msg, REST_Controller::HTTP_OK);

        
    }
    
    /*-------------------------------------------------------------------
    *@function User register
    *-------------------------------------------------------------------*/
    public function signUp()
    {
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
                    'last_password_change' => date('Y-m-d H:i:s'),
                    'whp_password'             => $newPassword,
                    'password'             => app_hash_password($newPassword),
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
    public function profileUpdate()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $userid = $this->user_data->userid;
        $firstname = $postData['firstname'];
        $lastname = $postData['lastname'];
      
        $phonenumber = $postData['phonenumber'];
        $alternative_mobile = $postData['alternative_mobile'];
        $dob = $postData['dob'];
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
    *@function User Profile update
    *-------------------------------------------------------------------*/
    public function profileTokenUpdate()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $userid = $this->user_data->userid;
        $fcm_token = $postData['fcm_token'];
       
   
        if($userid != '' && $fcm_token != '')
        {
            $userData = $this->db->get_where(db_prefix().'contacts', array('userid' => $userid))->num_rows();
            if($userData > 0)
            {
                $customerpost['fcm_token'] = $fcm_token;
                $this->db->where('userid', $userid);
                $this->db->update(db_prefix() . 'contacts', $customerpost);                   
               
                $msg = array('status' => true, 'message' =>'Token update successfully!', 'result' => array());
    
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
        $userid =  $this->user_data->userid;
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
                  

               
                $success = $this->db->select('id,userid,firstname,lastname,email,phonenumber,alternative_mobile,email,dob,address,state,city,country,postal_code,address2,state2,city2,country2,postal_code2,service_type,gender,office_location,department_id,budget_amount')->get_where(db_prefix().'contacts', array('userid' => $userid))->row();

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
    *@function get User Profile update
    *-------------------------------------------------------------------*/
    public function getBudgetAmount()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $userid = $this->user_data->userid;
       
        
        if($userid != '')
        {
            $userData = $this->db->get_where(db_prefix().'contacts', array('userid' => $userid ))->row();
            if($userData > 0)
            {
                $success->budget_amount  =    $userData->budget_amount;
                 
                $used_amount = $this->db->select('SUM(total_amount) as used_amount')->get_where(db_prefix().'roster_invoice', array('client_id' => $userid,'YEAR(invoice_date)'=> date('Y')))->row('used_amount');
                $success->used_amount = ($used_amount!='')?$used_amount:'0';

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
    public function changePassword()
    {
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
       
        $data = $this->db->get_where(db_prefix().'country',array('is_active' => 1))->result();
            
            
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

    public function getTimeSlot()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));

        $success = $this->db->get_where(db_prefix().'timeslot')->result();
        
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

    /*-------------------------------------------------------------------
    *@function get Invoice
    *-------------------------------------------------------------------*/
    public function getMyInvoice()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $client_id = $this->user_data->userid;
        $postData['page'] = $_GET['page'];
        $postData['limit'] = $_GET['limit'];
       
        
        if($client_id != '')
        {
            // $userData = $this->db->get_where(db_prefix().'roster_invoice', array('client_id' => $client_id))->result();
            $userData = $this->api_model->getMyInvoice($postData,$client_id);
            $userDataCount = $this->api_model->getMyInvoiceCount($client_id);
            if(count($userData) > 0)
            {
                foreach ($userData as $value) 
                {
                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $value->id, 'rel_type' => 'invoice'))->row('file_name');
                    $data['file'] = base_url().'uploads/invoice/'.$value->id.'/'.$filename;
                    $data['title'] = $value->title;
                    $data['invoice_no'] = $value->invoice_no;
                    $data['invoice_date'] = $value->invoice_date;
                    $data['total_amount'] = $value->total_amount;
                    $data['status'] = $value->status;
                    $data['added_by'] = ($value->added_by==0) ? 'Admin':'Client Liaison Office';
                    $data['added_by_name'] = ($value->added_by==0) ? 'Admin': ucfirst(clientname($value->added_by_id));
                    $data['created_date'] = $value->created_date;

                    $allData[] = $data;
                }
               
               
                        
                $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $allData, 'count' => $userDataCount);
                
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Records are not matching', 'result' =>array(), 'count' =>0);
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records are not matching', 'result' =>array(), 'count' =>0);
        }   
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    /*-------------------------------------------------------------------
    *@function get Invoice
    *-------------------------------------------------------------------*/

    public function getMyCarePlan()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $client_id = $this->user_data->userid;
       
        $postData['page'] = $_GET['page'];
        $postData['limit'] = $_GET['limit'];
       
        
        if($client_id != '')
        {
            $userData = $this->api_model->getMyCarePlan($postData,$client_id);
            $userDataCount = $this->api_model->getMyCarePlanCount($client_id);

            // $userData = $this->db->get_where(db_prefix().'care_plan', array('client_id' => $client_id ))->result();
            if(count($userData) > 0)
            {
                foreach ($userData as $value) 
                {
                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $value->id, 'rel_type' => 'care_plan'))->row('file_name');
                    $data['id'] = $value->id;
                    $data['title'] = $value->title;
                    $data['officer'] = $value->officer;
                    $data['added_by'] = ($value->added_by==0) ? 'Admin':'Client Liaison Office';
                    $data['added_by_id'] = $value->added_by_id;
                    $data['added_by_name'] = ($value->added_by==0) ? 'Admin': ucfirst(clientname($value->added_by_id));
                    $data['created_date'] = $value->created_date;
                    $data['file'] = base_url().'uploads/care_plan/'.$value->id.'/'.$filename;

                    $allData[] = $data;
                }
               
               
                        
                $msg = array('status' =>true, 'message' => 'Data Found', 'count' =>$userDataCount , 'result' => $allData);
                
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Records are not matching', 'count' =>0 , 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records are not matching', 'count' =>0 , 'result' =>array());
        }   
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    
    /*-------------------------------------------------------------------
    *@function get Roaster
    *-------------------------------------------------------------------*/

    public function getMyRoster()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $client_id = $this->user_data->userid;
       
        $postData['page'] = $_GET['page'];
        $postData['limit'] = $_GET['limit'];
       
        
        if($client_id != '')
        {
            $userData = $this->api_model->getMyRoster($postData,$client_id);
            $userDataCount = $this->api_model->getMyRosterCount($client_id);
            // $userData = $this->db->order_by('id','DESC')->get_where(db_prefix().'roster', array('client_id' => $client_id))->result();
            if(count($userData) > 0)
            {
                foreach ($userData as $value) 
                {
                    $data['id'] = $value->id;
                    $data['staff_id'] = $value->staff_id;
                    $data['service_id'] = servicename($value->service_id);
                    $data['staff_name'] = ucfirst(clientname($value->staff_id));                    
                    $data['start_date'] = $value->start_date;
                    $data['end_date'] = $value->end_date;
                    $data['time_slot'] = $value->time_slot;
                    $data['time_from'] = $value->time_from;
                    $data['time_to'] = $value->time_to;
                    $data['description'] = $value->description;
                    $data['created_date'] = $value->created_date;
                
                    $allData[] = $data;
                }
                       
                $msg = array('status' =>true, 'message' => 'Data Found', 'count' =>$userDataCount , 'result' => $allData);
                
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Records are not matching', 'count' =>0 , 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records are not matching', 'count' =>0 , 'result' =>array());
        }   
        $this->response($msg, REST_Controller::HTTP_OK);
    }
  /*-------------------------------------------------------------------
    *@function User multiple address add
    *-------------------------------------------------------------------*/
    public function getReviewList()
    {
        $userid  = $this->user_data->userid;
        $rs = $this->db->get_where(db_prefix().'review',array('client_id'=>$userid))->result();
       // echo $this->db->a
        if($rs){
            $msg = array('status' => true, 'message' =>'Review List successfully!', 'result' => $rs);
        }else{
            $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
        }
         $this->response($msg, REST_Controller::HTTP_OK);
    }


    /*-------------------------------------------------------------------
    *@function User multiple address add
    *-------------------------------------------------------------------*/
    public function addReview()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $userid  = $this->user_data->userid;


        if($postData['star'] != '' &&  $postData['title'] != '' &&  $postData['review'] != '' &&  $userid != '')
        {
            
            // $existingAdd = $this->db->get_where(db_prefix().'review', array('client_id' => $userid))->num_rows();
            // if($existingAdd)
            // {
            //     $this->db->delete(db_prefix().'review', array('client_id' => $userid));
            // }
            $addressData['client_id'] = $this->user_data->userid;
            $addressData['star'] = $postData['star'];
            $addressData['title'] = $postData['title'];
            $addressData['review'] = $postData['review'];
            $addressData['created_date'] = date('Y-m-d H:i:s');
            $this->db->insert(db_prefix().'review', $addressData);
            $lid = $this->db->insert_id();
            if($lid)
            {
                $msg = array('status' => true, 'message' =>'Review added successfully!', 'result' => array());
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
            }

        }
        else
        {
            $msg = array('status' => false, 'message' => 'All field is required', 'result' =>array());
        }
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    /*-------------------------------------------------------------------
    *@function User Profile Image update
    *-------------------------------------------------------------------*/
    public function addDocument()
    {
        $userid  = $this->user_data->userid;
        $title = $_POST['title'];
        if($userid!='' && $_FILES['document']['name']!='')
        {
            $docData['title']   = $title;
            $docData['client_id']  = $userid;
            $docData['added_by']  = 2;
            $docData['added_by_id']  = $userid;
            $docData['created_date']    = date('Y-m-d H:i:s');
            $this->db->insert(db_prefix().'document', $docData);
            // echo $this->db->last_query();
            $lid = $this->db->insert_id();



             // print_r('hello');
             // print_r($uploadedFiles);
             //  die;
            $uploadedFiles = handle_file_upload($lid,'document', 'document');
            if ($uploadedFiles && is_array($uploadedFiles)) {
                foreach ($uploadedFiles as $file) {
                    $this->misc_model->add_attachment_to_database($lid, 'document', [$file]);
                }
            }

            // print_r($uploadedFiles);
            
            $status= true;
            $message = 'Document Added Successfully!';
                       

            $attachment_image = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array("rel_type" => "document", "rel_id" => $lid))->row('file_name');
            $attachment_imagepath = site_url('uploads/document/'. $lid.'/'. $attachment_image);

            if($attachment_image!='')
            {
                $document = $attachment_imagepath;

            }else{
                $document ='';
            }
                 
            $result = $this->db->get_where(db_prefix().'document', array('id' => $lid))->row();
            $result->file = $document;
            $result->file_size  = bytesToSize('uploads/document/'.$lid.'/'.$attachment_image);
                    
            $msg = array('status' => $status, 'message' => $message, 'result' => $result); 
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Record Not Match', 'result' =>array());
        }   
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    /*-------------------------------------------------------------------
    *@function get Invoice
    *-------------------------------------------------------------------*/

    public function getMyDocument()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $userid = $this->user_data->userid;
       
        $postData['page'] = $_GET['page'];
        $postData['limit'] = $_GET['limit'];
              
        if($userid != '')
        {
            $userData = $this->api_model->getMyDocument($postData,$userid);
            $userDataCount = $this->api_model->getMyDocumentCount($userid);
            // $userData = $this->db->order_by('id','DESC')->get_where(db_prefix().'document', array('client_id' => $userid))->result();
            if(count($userData) > 0)
            {
                foreach ($userData as $value) 
                {
                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $value->id, 'rel_type' => 'document'))->row('file_name');
                    $data['id'] = $value->id;
                    $data['title'] = $value->title;
                    $data['created_date'] = $value->created_date;
                    $data['file_size'] = bytesToSize('uploads/document/'.$value->id.'/'.$filename);
                    $data['file'] = base_url().'uploads/document/'.$value->id.'/'.$filename;

                    $allData[] = $data;
                }
               
               
                        
                $msg = array('status' =>true, 'message' => 'Data Found', 'count' =>$userDataCount , 'result' => $allData);
                
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Records are not matching', 'count' =>0 , 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records are not matching', 'count' =>0 , 'result' =>array());
        }   
        $this->response($msg, REST_Controller::HTTP_OK);
    } 
    /*-------------------------------------------------------------------
    *@function get Invoice
    *-------------------------------------------------------------------*/

    public function getMyDocumentDetail()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $userid = $this->user_data->userid;
        $id = $postData['id'];
       
        
        if($userid != '')
        {
            $value = $this->db->get_where(db_prefix().'document', array('client_id' => $userid,'id' => $id))->row();
            if(count($value) > 0)
            {
                
                $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $value->id, 'rel_type' => 'document'))->row('file_name');
                $data['id'] = $value->id;
                $data['title'] = $value->title;
                $data['created_date'] = $value->created_date;
                $data['file_size'] = bytesToSize('uploads/document/'.$value->id.'/'.$filename);
                $data['file'] = base_url().'uploads/document/'.$value->id.'/'.$filename;

                $allData[] = $data;
            
           
           
                    
            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $allData);
                
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
    *@function get my form
    *-------------------------------------------------------------------*/

    public function getMyForm()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $userid = $this->user_data->userid;
        $id = $postData['id'];
       
        
        if($userid != '')
        {
            $variable = $this->db->order_by('id','DESC')->get_where(db_prefix().'form_allot', array('client_id' => $userid))->result();
            if(count($variable) > 0)
            {
                foreach ($variable as $value) 
                {
                    $data['id'] = $value->id;
                    $data['form_id'] = $value->form_id;
                    $data['form_name'] = formname($value->form_id);
                    $data['form_process'] = $value->form_process;
                    $data['start_date'] = $value->created_date;
                    $data['end_date'] = $value->updated_date;
                    $data['lock_status'] = $value->lock_status;

                    $allData[] = $data;
                   
                    $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $allData);
                    
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

    public function getMyFormData()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $client_id = $this->user_data->userid;
        $form_id = $postData['form_id'];
       
        
        if($client_id != '' &&  $form_id!='')
        {
            $lock_status =$this->db->get_where(db_prefix().'form_allot', array('client_id' => $client_id,'form_id'=>$form_id))->row('lock_status'); 
            if($form_id==1)
            {
                $allData = $this->db->get_where(db_prefix().'integrate_client_assessment', array('client_id' => $client_id))->result();

                // $allData = $this->api_model->getIntegrate_client_assessment($client_id);
                 // print_r($allData); 
                   
                if(count($allData)==1)
                {
                    foreach ($allData as $value) 
                    {
                        $value->f_source_no = explode(",",$value->f_source_no);
                        $value->f_start_date = explode(",",$value->f_start_date);
                        $value->f_end_date = explode(",",$value->f_end_date);
                        $value->bowel_care_movement = explode(",",$value->bowel_care_movement);
                        $value->p_urinary_other = explode(",",$value->p_urinary_other);
                        $value->p_shower_needs = explode(",",$value->p_shower_needs);
                        $value->p_dressing_needs = explode(",",$value->p_dressing_needs);
                        $value->p_meal_needs = explode(",",$value->p_meal_needs);
                        $value->p_shopping = explode(",",$value->p_shopping);
                        $value->equipment = explode(",",$value->equipment);
                        $value->gspn_risk_identification = explode(",",$value->gspn_risk_identification);
                        $value->gspn_need_risk_identification = explode(",",$value->gspn_need_risk_identification);
                        $value->equipment_provided_by = explode(",",$value->equipment_provided_by);


                        $value->b_monday =json_decode($value->b_monday, true);
                        $value->b_tuesday =json_decode($value->b_tuesday, true);
                        $value->b_wednesday =json_decode($value->b_wednesday, true);
                        $value->b_thursday =json_decode($value->b_thursday, true);
                        $value->b_friday =json_decode($value->b_friday, true);
                        $value->b_saturday =json_decode($value->b_saturday, true);
                        $value->b_sunday =json_decode($value->b_sunday, true);   

                    unset($value->client_id);
                    unset($value->updated_date);
                    unset($value->created_date);             
                      
                    }
 
                    $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $allData, 'lock_status' =>$lock_status);
                }
                else
                {
                    $msg = array('status' => true, 'message' => 'Data Not Found', 'result' =>array(), 'lock_status' =>$lock_status);
                }
                
            }
            else if($form_id==2)
            {
                $allData = $this->db->get_where(db_prefix().'ndis_service_agreement', array('client_id' => $client_id))->result();
                if(count($allData)==1)
                {
                     foreach ($allData as $value) 
                    {
                        $value->transport_costs =json_decode($value->transport_costs, true);                
                        $value->schedule_of_supports =json_decode($value->schedule_of_supports, true);  

                    unset($value->client_id);
                    unset($value->updated_date);
                    unset($value->created_date);                           
                      
                    }

                    
                    $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $allData, 'lock_status' =>$lock_status);
                }
                else
                {
                    $msg = array('status' => true, 'message' => 'Data Not Found', 'result' =>array(), 'lock_status' =>$lock_status);
                }

            }
            else if($form_id==3)
            {
                $allData = $this->db->get_where(db_prefix().'ndis_supplementary_service_agreement', array('client_id' => $client_id))->result();
                if(count($allData)==1)
                {
                      foreach ($allData as $value) 
                    {
                        $value->transport_costs =json_decode($value->transport_costs, true);                
                        $value->schedule_of_supports =json_decode($value->schedule_of_supports, true);  

                    unset($value->client_id);
                    unset($value->updated_date);
                    unset($value->created_date);                           
                      
                    }

                   
                    $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $allData, 'lock_status' =>$lock_status);
                }
                else
                {
                    $msg = array('status' => true, 'message' => 'Data Not Found', 'result' =>array(), 'lock_status' =>$lock_status);
                }
                
            }
            else if($form_id==4)
            {
                $allData = $this->db->get_where(db_prefix().'private_clients_service_agreement', array('client_id' => $client_id))->result();
                if(count($allData)==1)
                {
                     foreach ($allData as $value) 
                    {
                        $value->transport_costs =json_decode($value->transport_costs, true);                
                        $value->schedule_of_supports =json_decode($value->schedule_of_supports, true);   

                    unset($value->client_id);
                    unset($value->updated_date);
                    unset($value->created_date);                          
                      
                    }

                   
                    $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $allData, 'lock_status' =>$lock_status);
                }
                else
                {
                    $msg = array('status' => true, 'message' => 'Data Not Found', 'result' =>array(), 'lock_status' =>$lock_status);
                }
                
            }
            else
            {
                $allData = $this->db->get_where(db_prefix().'add_aged_care_service_agreement', array('client_id' => $client_id))->result();
                if(count($allData)==1)
                {
                    foreach ($allData as $value) 
                    {
                        $value->schedule_of_supports =json_decode($value->schedule_of_supports, true); 

                    unset($value->client_id);
                    unset($value->updated_date);
                    unset($value->created_date);                            
                      
                    }

                    

                    $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $allData, 'lock_status' =>$lock_status);
                }
                else
                {
                    $msg = array('status' => true, 'message' => 'Data Not Found', 'result' =>array(), 'lock_status' =>$lock_status);
                }
                
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
    public function updateDocument()
    {
        $id = $_POST['id'];
        $lid = $_POST['id'];
        $title = $_POST['title'];
        $userid = $this->user_data->userid;
        if($id && $userid)
        {
            $docData['title']   = $title;
            $docData['updated_date'] = date('Y-m-d H:i:s');
            $this->db->where('id', $id);
            $this->db->where('client_id', $userid);
            $this->db->update(db_prefix().'document', $docData);

            $userid = $this->db->get_where(db_prefix().'document', array('id' => $id))->row('userid');

            
            $uploadedFiles = handle_file_upload($lid,'document', 'document');
            if ($uploadedFiles && is_array($uploadedFiles)) {
                foreach ($uploadedFiles as $file) {
                    $this->misc_model->add_attachment_to_database($lid, 'document', [$file]);
                }
            }

            
            $status= true;
            $message = 'Document Updated Successfully!';
                       

            $attachment_image = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array("rel_type" => "document", "rel_id" => $lid))->row('file_name');
            $attachment_imagepath = site_url('uploads/document/'. $lid.'/'. $attachment_image);

            if($attachment_image!='')
            {
                $document = $attachment_imagepath;

            }else{
                $document ='';
            }

            $result = $this->db->get_where(db_prefix().'document', array('id' => $id))->row();
            $result->file = $document;
            $result->file_size  = bytesToSize('uploads/document/'.$userid.'/'.$attachment_image);
                    
            $msg = array('status' => $status, 'message' => $message, 'result' => $result);
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Record Not Match', 'result' =>array());
        }   
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    /*-------------------------------------------------------------------

    *@function: Delete document
    *-------------------------------------------------------------------*/

    public function deleteDocument()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $userid = $this->user_data->userid;
        $id = $postData['id'];
        
        if($id != '' && $userid!='')
        {
            $this->db->delete(db_prefix().'document', array('id' => $id,'client_id' => $userid));
            $this->db->delete(db_prefix().'files', array('rel_id' => $id,'rel_type' => 'document'));
            $msg = array('status' => true, 'message' =>'Deleted Successfully', 'result' => array());
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Record Not Match', 'result' =>array());
        }           
        $this->response($msg, REST_Controller::HTTP_OK);
    }


    /*-------------------------------------------------------------------
    *@function User multiple address add
    *-------------------------------------------------------------------*/
    public function addAppointment()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $userid = $this->user_data->userid;
        if($userid != '' &&  $postData['title'] != '' &&   $postData['start_date'] != '' &&  $postData['end_date'] != '' &&  $postData['start_time'] != ''&&  $postData['end_time'] != '')
        {
            
            $addressData['added_by'] = 2;
            $addressData['added_by_id'] = $this->user_data->userid;
            $addressData['client_id'] = $this->user_data->userid;
            $addressData['title'] = $postData['title'];
            // $addressData['service_id'] = $postData['service_id'];
            $addressData['start_date'] = $postData['start_date'];
            $addressData['end_date'] = $postData['end_date'];
            $addressData['start_time']    = $postData['start_time'];
            $addressData['end_time']    = $postData['end_time'];
            $addressData['frequency'] = $postData['frequency'];
            $addressData['description'] = $postData['description'];
            $addressData['created_date'] = date('Y-m-d H:i:s');
            $this->db->insert(db_prefix().'appointment', $addressData);
            $lid = $this->db->insert_id();
            if($lid)
            {
                $msg = array('status' => true, 'message' =>'Appointment added successfully!', 'result' => array());
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
            }

        }
        else
        {
            $msg = array('status' => false, 'message' => 'All data required', 'result' =>array());
        }
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    /*-------------------------------------------------------------------
    *@function User multiple address add
    *-------------------------------------------------------------------*/
    public function updateAppointment()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
         $userid = $this->user_data->userid;

        if($userid != '' &&  $postData['id'] != '' &&  $postData['start_date'] != '' &&  $postData['end_date'] != '' &&  $postData['start_time'] != '' && $postData['end_time'] != '' &&  $postData['title'] != '')
        {
            
            $addressData['title'] = $postData['title'];
            // $addressData['service_id'] = $postData['service_id'];
            $addressData['start_date'] = $postData['start_date'];
            $addressData['end_date'] = $postData['end_date'];
            $addressData['start_time']    = $postData['start_time'];
            $addressData['end_time']    = $postData['end_time'];
            $addressData['frequency'] = $postData['frequency'];
            $addressData['description'] = $postData['description'];
            $addressData['updated_date'] = date('Y-m-d H:i:s');

            $this->db->where('id', $postData['id']);
            $this->db->where('client_id', $userid);
            $this->db->update(db_prefix().'appointment', $addressData);

            $result = $this->db->get_where(db_prefix().'appointment', array('id' => $postData['id']))->row();

            $msg = array('status' => true, 'message' =>'Appointment updated successfully!', 'result' => $result);
        }
        else
        {
            $msg = array('status' => false, 'message' => 'All data required', 'result' =>array());
        }
        $this->response($msg, REST_Controller::HTTP_OK);
    }


    /*-------------------------------------------------------------------
    *@function get Invoice
    *-------------------------------------------------------------------*/

    public function getMyAppointment()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $userid = $this->user_data->userid;
       
        $postData['page'] = $_GET['page'];
        $postData['limit'] = $_GET['limit'];
              
        if($userid != '')
        {
            $userData = $this->api_model->getMyAppointment($postData,$userid);
            $userDataCount = $this->api_model->getMyAppointmentCount($userid);
            // $userData = $this->db->order_by('id','DESC')->get_where(db_prefix().'appointment', array('client_id' => $userid))->result();
            if(count($userData) > 0)
            {
                foreach ($userData as $value) 
                {
                    
                    $data['id'] = $value->id;
                    $data['title'] = $value->title;
                    // $data['service_id'] = $value->service_id;
                    $data['service_name'] = servicename($value->service_id);
                    $data['start_date'] = $value->start_date;
                    $data['end_date'] = $value->end_date;
                    $data['start_time'] = $value->start_time;
                    $data['end_time'] = $value->end_time;
                    $data['frequency'] = $value->frequency;
                    $data['description'] = $value->description;
                    $data['created_date'] = $value->created_date;
                    $data['updated_date'] = $value->updated_date;

                    $allData[] = $data;
                }
                        
                $msg = array('status' =>true, 'message' => 'Data Found', 'count' =>$userDataCount , 'result' => $allData);
                
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Records are not matching', 'count' =>0 , 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records are not matching', 'result' =>array());
        }   
        $this->response($msg, REST_Controller::HTTP_OK);
    } 
    /*-------------------------------------------------------------------
    *@function get Invoice
    *-------------------------------------------------------------------*/

    public function getMyAppointmentDetail()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $userid = $this->user_data->userid;
        $id = $postData['id'];
       
        
        if($userid != '')
        {
            $value = $this->db->get_where(db_prefix().'appointment', array('client_id' => $userid,'id' => $id))->row();
            if(count($value) > 0)
            {
                
                $data['title'] = $value->title;
                $data['service_id'] = $value->service_id;
                // $data['service_name'] = servicename($value->service_id);
                $data['start_date'] = $value->start_date;
                $data['end_date'] = $value->end_date;
                $data['start_time'] = $value->start_time;
                $data['end_time'] = $value->end_time;
                $data['frequency'] = $value->frequency;
                $data['description'] = $value->description;
                $data['created_date'] = $value->created_date;
                $data['updated_date'] = $value->updated_date;

                $allData[] = $data;
            
           
           
                    
            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $allData);
                
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
    *@function get Invoice
    *-------------------------------------------------------------------*/

    public function getMySupportStaff()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $userid = $this->user_data->userid;
        $postData['page'] = $_GET['page'];
        $postData['limit'] = $_GET['limit'];
        if($userid != '')
        {
        	$staff_id_data = $this->api_model->getMySupportStaff($postData,$userid);
            $staff_id_dataCount = $this->api_model->getMySupportStaffCount($userid);
            // $staff_id_data = $this->db->group_by('staff_id')->get_where(db_prefix().'roster',array('client_id' =>$userid))->result();
            if(count($staff_id_data) > 0)
            {
                foreach ($staff_id_data as $valuestf) 
                {

                    $stff_info = $this->db->get_where(db_prefix().'contacts',array('userid' =>$valuestf->staff_id))->row();
                    if(count($stff_info) > 0)
                    {
                        $attachment_image = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array("rel_type" => "profile_image", "rel_id" => $stff_info->id))->row('file_name');
                        $attachment_imagepath = site_url('uploads/profile_image/'. $stff_info->id.'/'. $attachment_image);

                        if($attachment_image!='')
                        {
                            $document = $attachment_imagepath;

                        }else{
                            $document ='';
                        }

                        
                        $data['image'] = $document;
                        $data['name'] = ucfirst(clientname($stff_info->userid));
                        $data['phonenumber'] = $stff_info->phonenumber;
                        $data['email'] = $stff_info->email;
                        $data['department'] = departementname($stff_info->department_id);
                        $data['designation'] = designationname($stff_info->designation_id);
                        

                        $allData[] = $data;
                     
                        $msg = array('status' =>true, 'message' => 'Data Found', 'count' =>$staff_id_dataCount , 'result' => $allData);
                    }   
                }
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Records are not matching', 'count' =>0 , 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records are not matching', 'count' =>0 , 'result' =>array());
        }   
        $this->response($msg, REST_Controller::HTTP_OK);
    }


    /*-------------------------------------------------------------------
    *@function User multiple address add
    *-------------------------------------------------------------------*/
    public function addRequestAmendment()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $userid = $this->user_data->userid;
        if($this->user_data->userid != '' )
        { 
            
           
            $ReqData['client_id']       = $this->user_data->userid;
            $ReqData['request_id']      = $postData['request_id'];
            $ReqData['request_type']    = $postData['request_type'];
            $ReqData['title']           = $postData['title'];
            $ReqData['start_date']      = ($postData['start_date']!='')?$postData['start_date']:'';
            $ReqData['end_date']        = ($postData['end_date']!='')?$postData['end_date']:'';
            $ReqData['description']     = $postData['description'];
            $ReqData['created_date']    = date('Y-m-d H:i:s');
            $this->db->insert(db_prefix().'requestamendment', $ReqData);
            // echo $this->db->last_query(); die;
            $lid = $this->db->insert_id();
            if($lid)
            {
                $msg = array('status' => true, 'message' =>'Request Amendment added successfully!!', 'result' => array());
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
            }

        }
        else
        {
            $msg = array('status' => false, 'message' => 'All data required', 'result' =>array());
        }
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    
    
    
    
    
    /*-------------------------------------------------------------------
    *@function Useradd support ticket
    *-------------------------------------------------------------------*/
    public function addSupportTicket()
    {
        $userid = $this->user_data->userid;
        if($userid != '' &&  $_POST['subject'] != '' &&  $_POST['message'] != '' &&  $_POST['department'] != '' &&  $_POST['priority'] != '')
        {
            
           
            $ReqData['userid'] = $this->user_data->userid;
            $ReqData['contactid'] = $this->db->get_where(db_prefix().'contacts', array('userid'=>$this->user_data->userid))->row('added_by');
            $ReqData['subject'] = $_POST['subject'];
            $ReqData['message'] = $_POST['message'];
            $ReqData['department'] = $_POST['department'];
            $ReqData['priority']    = $_POST['priority'];
            $ReqData['status'] = 1;
            $ReqData['added_by'] = 2;
            $ReqData['date'] = date('Y-m-d H:i:s');
            $this->db->insert(db_prefix().'tickets', $ReqData);
            $ticketid = $this->db->insert_id();
            // attachments
            if($ticketid)
            {
                $attachments = handle_file_upload($ticketid,'ticket_attachments', 'attachments');
                if ($attachments && is_array($attachments)) {
                    foreach ($attachments as $file) 
                    {
                      $this->insert_ticket_attachments_to_database_client([$file], $ticketid); 
                    }
                }

                $useremail = $this->db->get_where(db_prefix().'contacts', array('userid'=>$this->user_data->userid))->row('email');
                $conatctemail = $this->db->get_where(db_prefix().'contacts', array('userid'=>$ReqData['contactid']))->row('email');

                   

                $message1   = 'Caring Approach : Support Ticket';
                $message1   .= '<br>Subject : '.$_POST['subject'];
                $message1   .= '<br>Message : '.$_POST['message'];
                $message1   .= '<br>Contact Name : '.clientname($ReqData['contactid']);
                $message1   .= '<br>Department : '.supportDepartment($_POST['department']);
                $message1   .= '<br>Priority : '.supportPriorities($_POST['priority']);
                $message1   .= '<br>Status : '.supportStatus($ReqData['status']);
                $message1   .= '<br>Date : '.getDateTimeDMYOnly($ReqData['date']);

                $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'ticket_attachments', array('ticketid' => $ticketid,'replyid'=>null))->row('file_name');
                    
                $filepathh = base_url().'uploads/ticket_attachments/'.$ticketid.'/'.$filename;

                if($filename!='')
                {
                    
                        
                    $message1   .= "<br>Document: <br> <div class='d-flex align-items-center'><a href=".$filepathh." target='_blank' ><img width='50px' src='".base_url()."/assets/images/pdf.png' alt='Avatar' class='rounded mr-1' />".$filename."</a></div>";
                    
                }
                
                $sub1 = 'Request For Support Ticket';
                $data['msg'] = $message1;
                $tempmsg = $this->load->view('emailtemp', $data, true);

                send_mail($useremail, $sub1, $tempmsg);
                // send_mail('pooja@immersiveinfotech.com', $sub1, $tempmsg);
                send_mail($conatctemail, $sub1, $tempmsg);

                // $where['userid']= $userid;
                // $notificationdata['notify_type']='Ticket';
                // $notificationdata['notify_name']='New Ticket';
                // $notificationdata['sender']=$this->db->get_where('tblcontacts',$where)->row('firstname');
                // $message='New Ticket <a href="javascript:void(0)">'.$sub1.'</a>';
                // $notificationdata['sender_id']=$userid;
                // $notificationdata['title']=$sub1;
                // $notificationdata['message']=$message;
                // // print_r($notificationdata);die;
                // // $this->db->insert('tblnotification',$notificationdata);
                // notification($notificationdata);


                $msg = array('status' => true, 'message' =>'Tickets added successfully!!', 'result' => array());
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
            }

        }
        else
        {
            $msg = array('status' => false, 'message' => 'All data required', 'result' =>array());
        }
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    
    
    /*-------------------------------------------------------------------
    *@function Useradd support ticket
    *-------------------------------------------------------------------*/
    public function addSupportTicketReply()
    {
        $userid = $this->user_data->userid;
        if($userid != '' &&  $_POST['ticketid'] != '' &&  $_POST['message'] != '')
        {
            
           
            $ticketid = $_POST['ticketid'];
            $ReqData['ticketid'] = $_POST['ticketid'];
            $ReqData['userid'] = $this->user_data->userid;
            $ReqData['contactid'] = 0;
            $ReqData['added_by'] = 2;
            $ReqData['message'] = $_POST['message'];
            $ReqData['date'] = date('Y-m-d H:i:s');
            $this->db->insert(db_prefix().'ticket_replies', $ReqData);
            // echo $this->db->last_query(); die;
            $ticketreplyid = $this->db->insert_id();
            // attachments
            if($ticketreplyid)
            {
                $attachments = handle_file_upload($ticketid,'ticket_attachments', 'attachments');
                if ($attachments && is_array($attachments)) {
                    foreach ($attachments as $file) 
                    {
                      $this->insert_ticket_attachments_to_database_client([$file], $ticketid,$ticketreplyid); 
                    }
                }

                $status = 1;
                


                $this->db->select('status');
                $this->db->where('ticketid', $id);
                $old_ticket_status = $this->db->get(db_prefix() . 'tickets')->row()->status;


                    $this->db->where('ticketid', $ticketid);
                    $this->db->update(db_prefix() . 'tickets', [
                        'lastreply' => date('Y-m-d H:i:s'),
                        // 'status'     => ($old_ticket_status == 2 && $clo == 0 ? $old_ticket_status : $status),
                        'adminread'             => 0,
                        'clientread'             => 0
                    ]);





                $useremail = $this->db->get_where(db_prefix().'contacts', array('userid'=>$this->user_data->userid))->row('email');

                $contactdata = $this->db->get_where(db_prefix().'tickets', array('ticketid'=>$ticketid))->row();
                $conatctemail = $this->db->get_where(db_prefix().'contacts', array('userid'=>$contactdata->contactid))->row('email');

                   

                $message1   = 'Caring Approach : Support Ticket';
                $message1   .= '<br>Subject : '.$contactdata->subject;
                $message1   .= '<br>Message : '.$_POST['message'];
                $message1   .= '<br>Contact Name : '.clientname($contactdata->contactid);
                $message1   .= '<br>Department : '.supportDepartment($contactdata->department);
                $message1   .= '<br>Priority : '.supportPriorities($contactdata->priority);
                $message1   .= '<br>Status : '.supportStatus($contactdata->status);
                $message1   .= '<br>Date : '.getDateTimeDMYOnly($ReqData['date']);

                
                $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'ticket_attachments', array('replyid'=>$ticketreplyid))->row('file_name');
                $filepathh = base_url().'uploads/ticket_attachments/'.$ticketid.'/'.$filename;
                    
              

                if($filename!='')
                {
                    
                        
                    $message1   .= "<br>Document: <br> <div class='d-flex align-items-center'><a href=".$filepathh." target='_blank' ><img width='50px' src='".base_url()."/assets/images/pdf.png' alt='Avatar' class='rounded mr-1' />".$filename."</a></div>";
                    
                }
                
                $sub1 = 'Reply From User -  Support Ticket';
                $data['msg'] = $message1;
                $tempmsg = $this->load->view('emailtemp', $data, true);

                send_mail($useremail, $sub1, $tempmsg);
                // send_mail('pooja@immersiveinfotech.com', $sub1, $tempmsg);
                send_mail($conatctemail, $sub1, $tempmsg);







                $msg = array('status' => true, 'message' =>'Tickets Reply added successfully!!', 'result' => array());
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
            }

        }
        else
        {
            $msg = array('status' => false, 'message' => 'All data required', 'result' =>array());
        }
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    /*-------------------------------------------------------------------
    *@function get Invoice
    *-------------------------------------------------------------------*/

    public function getMyTicket()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $userid = $this->user_data->userid;
       
        $postData['page'] = $_GET['page'];
        $postData['limit'] = $_GET['limit'];
        $postData['status'] = $_GET['status'];
       
        
        if($userid != '')
        {
            $userData = $this->api_model->getMyTicket($postData,$userid);
            $userDataCount = $this->api_model->getMyTicketCount($userid,$postData['status']);

            $statusCount['Open'] = $this->db->get_where(db_prefix().'tickets', array('status' =>1,'userid'=>$userid))->num_rows();
            $statusCount['In progress'] = $this->db->get_where(db_prefix().'tickets', array('status' =>2,'userid'=>$userid))->num_rows();
            $statusCount['Answered'] = $this->db->get_where(db_prefix().'tickets', array('status' =>3,'userid'=>$userid))->num_rows();
            $statusCount['On Hold'] = $this->db->get_where(db_prefix().'tickets', array('status' =>4,'userid'=>$userid))->num_rows();
            $statusCount['Closed'] = $this->db->get_where(db_prefix().'tickets', array('status' =>5,'userid'=>$userid))->num_rows();


            if(count($userData) > 0)
            {
                foreach ($userData as $value) 
                {
                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'ticket_attachments', array('ticketid' => $value->ticketid,'replyid'=>null))->row('file_name');
                    $data['ticketid'] = $value->ticketid;
                    $data['subject'] = $value->subject;
                    $data['message'] = $value->message;
                    $data['contactid'] = clientname($value->contactid);
                    $data['department'] = supportDepartment($value->department);
                    $data['priority'] = supportPriorities($value->priority);
                    $data['status'] = supportStatus($value->status);
                    $data['date'] = $value->date;
                    $data['lastreply'] = $value->lastreply;
                    $data['file'] = base_url().'uploads/ticket_attachments/'.$value->ticketid.'/'.$filename;

                    $allData[] = $data;
                }
               
               
                        
                $msg = array('status' =>true, 'message' => 'Data Found', 'count' =>$userDataCount , 'result' => $allData, 'statusCount' => $statusCount);
                
            }
            else
            {
                $msg = array('status' => true, 'message' => 'Records are not matching', 'count' =>0 , 'result' =>array(), 'statusCount' => $statusCount);
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records are not matching', 'count' =>0 , 'result' =>array());
        }   
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    /*-------------------------------------------------------------------
    *@function get Invoice
    *-------------------------------------------------------------------*/

    public function getMyTicketDetail()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $userid = $this->user_data->userid;
       
        $ticketid = $postData['ticketid'];
       
        
        if($userid != '')
        {
           
            $userData = $this->db->get_where(db_prefix().'tickets', array('ticketid' =>$ticketid,'userid'=>$userid))->result();
            


            if(count($userData) > 0)
            {
                foreach ($userData as $value) 
                {
                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'ticket_attachments', array('ticketid' => $value->ticketid,'replyid'=>null))->row('file_name');
                    $data['ticketid'] = $value->ticketid;
                    $data['subject'] = $value->subject;
                    $data['message'] = $value->message;
                    $data['contactid'] = clientname($value->contactid);
                    $data['department'] = supportDepartment($value->department);
                    $data['priority'] = supportPriorities($value->priority);
                    $data['status'] = supportStatus($value->status);
                    $data['date'] = $value->date;
                    $data['lastreply'] = $value->lastreply;
                    $data['file'] = base_url().'uploads/ticket_attachments/'.$value->ticketid.'/'.$filename;
                    $dataReply = $this->db->order_by('id','DESC')->get_where(db_prefix().'ticket_replies', array('ticketid' => $value->ticketid))->result();

                    foreach ($dataReply as $valueRe) 
                    {
                        $repData['file']='';
                        $filename = $this->db->order_by('id','ASC')->get_where(db_prefix().'ticket_attachments', array('replyid' => $valueRe->id))->row('file_name');


                        if($filename!='')
                        {
                            $repData['file'] = base_url().'uploads/ticket_attachments/'.$ticketid.'/'.$filename;
                        }

                        if($valueRe->contactid==0 && $valueRe->admin==null)
                        {
                            $repData['type'] = 'My message';
                            $repData['replies_name'] = clientname($valueRe->userid);
                        }
                        else if($valueRe->userid==0 && $valueRe->admin==null)
                        {
                            $repData['type'] = 'Client Liaison Office';
                            $repData['replies_name'] = clientname($valueRe->contactid);
                        }
                        else
                        {
                            $repData['type'] = 'Admin';
                            $repData['replies_name'] = staffname($valueRe->admin);  

                        }
                        $repData['message'] = $valueRe->message;
                        $repData['date'] = $valueRe->date;

                        $dataReplyAB[] = $repData;

                    }

                    // $data['reply'] = $this->db->order_by('id','DESC')->get_where(db_prefix().'ticket_replies', array('ticketid' => $value->ticketid))->result();
                    $data['reply'] = $dataReplyAB;
                    $allData[] = $data;
                }
               
               
                        
                $msg = array('status' =>true, 'message' => 'Data Found',  'result' => $allData);
                
            }
            else
            {
                $msg = array('status' => true, 'message' => 'Records are not matching', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records are not matching',  'result' =>array());
        }   
        $this->response($msg, REST_Controller::HTTP_OK);
    }


    public function insert_ticket_attachments_to_database_client($attachments, $ticketid, $replyid = false)
    {
        foreach ($attachments as $attachment) 
        {
            $attachmentADD['file_name'] = $attachment['file_name'];
            $attachmentADD['filetype'] = $attachment['filetype'];
            $attachmentADD['ticketid']  = $ticketid;
            $attachmentADD['dateadded'] = date('Y-m-d H:i:s');
            if ($replyid !== false && is_int($replyid)) {
                $attachmentADD['replyid'] = $replyid;
            }
            $this->db->insert(db_prefix() . 'ticket_attachments', $attachmentADD);  
        }
    
    }




    /*-------------------------------------------------------------------
    *@function: read notification
    *-------------------------------------------------------------------*/
    public function readNotification()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));

        $userid = $this->user_data->userid;

        $id = $postData['id'];

        if($userid != '' && $id != '')
        {
            $otpCheck = $this->db->get_where(db_prefix().'notification', array('receiver_id' => $userid,'id' => $id))->row();
             
            if(count($otpCheck)==0)
            {
                $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
            }
            else
            {
                $UpIUdata['read_status'] = 1;
                $UpIUdata['updated_date'] = YMD_date();
                $this->db->where('receiver_id', $userid);
                $this->db->where('id', $id);
                $this->db->update(db_prefix().'notification', $UpIUdata);
                $msg = array('status' => true, 'message' =>'Notification Read', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
        }
                        
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    /*-------------------------------------------------------------------
    *@function: read notification
    *-------------------------------------------------------------------*/
    public function getNotificationCount()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));

        $userid = $this->user_data->userid;

        if($userid!= '')
        {
            $otpCheck = $this->db->get_where(db_prefix().'notification', array('receiver_id' => $userid,'status'=>1,'read_status'=>0))->num_rows();  
            $msg = array('status' => true, 'message' =>'Data Found', 'result' =>$otpCheck);
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
        }
                        
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    /*-------------------------------------------------------------------
    *@function get notification
    *-------------------------------------------------------------------*/


    function getNotification()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $userid = $this->user_data->userid;
        if($userid!="")
        {
            $userData = $this->api_model->getNotification($postData,$userid);
            $userDataCount = $this->api_model->getNotificationCount($userid);

            if(count($userData) > 0)
            {
                foreach ($userData as $value) 
                {
                    $data['id']                 = $value->id;
                    $data['notify_type']        = $value->notify_type;
                    $data['notify_name']        = $value->notify_name;
                    $data['sender']             = $value->sender;
                    $data['sender_id']          = $value->sender_id;
                    $data['sender_name']        = $value->sender_id;
                    $data['receiver']           = $value->receiver;
                    $data['receiver_id']        = $value->receiver_id;
                    $data['receiver_name']      = $value->receiver_id;
                    $data['title']              = $value->title;
                    $data['message']            = $value->message;
                    $data['redirection_url']    = $value->redirection_url;
                    $data['read_status']        = $value->read_status;
                    $data['created_date']       = getDateTimeDMYOnly($value->created_date);
                    $data['updated_date']       = getDateTimeDMYOnly($value->updated_date);
                    $data['send_by']            = ($value->send_by==0)?'User':'Admin';
                    
                    $allData[] = $data;
                }
                     
                $msg = array('status' =>true, 'message' => 'Data Found', 'count' =>$userDataCount , 'result' => $allData);
                
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Records are not matching', 'count' =>0 , 'result' =>array());
            }
            
        }
        else{
                $msg = array('status' => false, 'message' => 'Please send all parameter', 'count' =>0, 'result' => array());
        }
        $this->response($msg, REST_Controller::HTTP_OK);
    }



    
    
    

    
}
