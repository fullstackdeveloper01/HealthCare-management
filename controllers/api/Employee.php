<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


use \Firebase\JWT\JWT;

class Employee extends MY_Controller {

    /**
     * Construct : A method to load all the helper, language and model files
     * validation_helper
     */
    public function __construct() {
        parent::__construct();
        // $this->load->model('api/authentication_model','api_model',true);
        $this->load->model('api/employee_model','api_model',true);
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Kolkata'); 
        
        $method = $this->router->fetch_method();
        // echo$method;die;
        if($method !='login' && $method !='login_as_employee' && $method!='signin' && $method != 'matchOTP' && $method !="resetPassword" && $method !="signUp" && $method !="forgotPassword" && $method !="verifyOTP"){
             $this->auth();
        }
        Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
   
        Header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE, HEAD'); //method allowed
    }
/*
    *   @function: Generate Token
    */ 
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
    public function login_as_employee()
    {
        
        $userid = base64_decode($_GET['key']);
       
        $success =   $this->db->get_where(db_prefix().'contacts', array('userid' => $userid,'role'=>'1'))->row();
        if(count($success)>0)
        { 
            $data['id'] = $success->id;
            $data['userid'] = $success->userid;
            $data['name'] = $success->firstname;
            $data['email'] = $success->email;
            $data['phone'] = $success->phonenumber;
            $data['role'] = $success->role;
            $data['dob'] = $success->dob;
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
                    'last_password_change' => YMD_date(),
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
                    'last_password_change' => YMD_date(),
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
    *@function User Login --checked
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
                    $data['firstname'] = $success->firstname;
                    $data['lastname'] = $success->lastname;
                    $data['email'] = $success->email;
                    $data['phone'] = $success->phonenumber;
                    $data['dob'] = $success->dob;
                    $data['role'] = $success->role;
                    $data['registration_no'] = $success->registration_no;
                    $data['address'] = $success->address;
                    $data['police_start_date'] = $success->police_start_date;
                    $data['police_end_date'] = $success->police_end_date;

                    if($success->police_start_date!='' && $success->police_end_date!='' )
                    {
                        if(strtotime($success->police_end_date)>time())
                        {
                            $data['police_left_time'] =  time_calculate($success->police_start_date,$success->police_end_date);

                        }
                        else
                        {
                             $data['police_left_time'] =  'Expired';

                        }

                    }
                    else
                    {
                        $data['police_left_time'] ='';
                    }
                    
                    

                    $data['wwcc_start_date'] = $success->wwcc_start_date;
                    $data['wwcc_end_date'] = $success->wwcc_end_date;


                    if($success->wwcc_start_date!='' && $success->wwcc_end_date!='' )
                    {
                        if(strtotime($success->wwcc_end_date)>time())
                        {
                            $data['wwcc_left_time'] =  time_calculate($success->wwcc_start_date,$success->wwcc_end_date);

                        }
                        else
                        {
                             $data['wwcc_left_time'] =  'Expired';

                        }

                    }
                    else
                    {
                        $data['wwcc_left_time'] ='';
                    }
                    
                    

                    $data['firstaid_start_date'] = $success->firstaid_start_date;
                    $data['firstaid_end_date'] = $success->firstaid_end_date;

                    if($success->firstaid_start_date!='' && $success->firstaid_end_date!='' )
                    {
                        if(strtotime($success->firstaid_end_date)>time())
                        {
                            $data['firstaid_left_time'] =  time_calculate($success->firstaid_start_date,$success->firstaid_end_date);

                        }
                        else
                        {
                             $data['firstaid_left_time'] =  'Expired';

                        }

                    }
                    else
                    {
                        $data['firstaid_left_time'] ='';
                    }
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
                    'last_password_change'      => YMD_date(),
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
                    'last_password_change' => YMD_date(),
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
    *@function User Profile update-checked
    *-------------------------------------------------------------------*/
    public function profileUpdate()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $userid = $this->user_data->userid;
        // print_r($postData);die;
        $firstname = $postData['firstname'];
        $lastname = $postData['lastname'];
      
        $phonenumber = $postData['phonenumber'];
        $alternative_mobile = $postData['alternative_mobile'];
        $dob = $postData['dob'];
        $doj = $postData['doj'];
        $address = $postData['address'];
        $state = $postData['state'];
        $city = $postData['city'];
        $country = $postData['country'];
        $postal_code = $postData['postal_code'];
        $address2 = $postData['address2'];
        $state2 = $postData['state2'];
        $city2 = $postData['city2'];
        $country2 = $postData['country2'];
        $postal_code2 = $postData['postal_code2'];
        // $service_type = implode(",",$postData['service_type']);
        $gender = $postData['gender'];
        $emg_name = $postData['emg_name'];
        $emg_relatiopnship = $postData['emg_relatiopnship'];
        $emg_phone = $postData['emg_phone'];
        $emg_mobile = $postData['emg_mobile'];
        $emg_address = $postData['emg_address'];
        $emg_country = $postData['emg_country'];
        $emg_state = $postData['emg_state'];
        $emg_city = $postData['emg_city'];
        $emg_postalcode = $postData['emg_postalcode'];
        $favorite_food =  $postData['favorite_food'];
        $favorite_sport =  $postData['favorite_sport'];
        $favorite_destination =  $postData['favorite_destination'];
        $total_working_hours =  $postData['total_working_hours'];
         $department_id = $postData['department_id'];
         $designation_id = $postData['designation_id'];
   
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
                            $customerpost['gender'] = $gender;
                            $customerpost['doj'] = $doj;
                            $customerpost['dob'] = $dob;
                            $customerpost['address'] = $address;
                            $customerpost['state'] = $state;
                            $customerpost['city'] = $city;
                            $customerpost['country'] = $country;
                            $customerpost['postal_code'] = $postal_code;
                            $customerpost['address2'] = $address2;
                            $customerpost['state2'] = $state2;
                            $customerpost['city2'] = $city2;
                            $customerpost['country2'] = $country2;
                            $customerpost['postal_code2'] = $postal_code2;
                            // $customerpost['service_type'] = $service_type;
                            $customerpost['department_id'] = $department_id;
                            $customerpost['designation_id'] = $designation_id;
                            $customerpost['emg_name'] = $emg_name;
                            $customerpost['emg_relatiopnship'] = $emg_relatiopnship;
                            $customerpost['emg_phone'] = $emg_phone;
                            $customerpost['emg_mobile'] = $emg_mobile;
                            $customerpost['emg_address'] = $emg_address;
                            $customerpost['emg_country'] = $emg_country;
                            $customerpost['emg_state'] = $emg_state;
                            $customerpost['emg_city'] = $emg_city;
                            $customerpost['emg_postalcode'] = $emg_postalcode;
                            $customerpost['favorite_food'] = $favorite_food;
                            $customerpost['favorite_sport'] = $favorite_sport;
                            $customerpost['favorite_destination'] = $favorite_destination;
                            $customerpost['total_working_hours'] = $total_working_hours;
                            //print_r($customerpost);die;
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
                        $customerpost['gender'] = $gender;
                        $customerpost['dob'] = $dob;
                        $customerpost['doj'] = $doj;
                        $customerpost['address'] = $address;
                        $customerpost['state'] = $state;
                        $customerpost['city'] = $city;
                        $customerpost['country'] = $country;
                        $customerpost['postal_code'] = $postal_code;
                        $customerpost['address2'] = $address2;
                        $customerpost['state2'] = $state2;
                        $customerpost['city2'] = $city2;
                        $customerpost['country2'] = $country2;
                        $customerpost['postal_code2'] = $postal_code2;
                        // $customerpost['service_type'] = $service_type;
                        $customerpost['designation_id'] = $designation_id;
                        $customerpost['department_id'] = $department_id;
                        $customerpost['emg_name'] = $emg_name;
                        $customerpost['emg_relatiopnship'] = $emg_relatiopnship;
                        $customerpost['emg_phone'] = $emg_phone;
                        $customerpost['emg_mobile'] = $emg_mobile;
                        $customerpost['emg_address'] = $emg_address;
                        $customerpost['emg_country'] = $emg_country;
                        $customerpost['emg_state'] = $emg_state;
                        $customerpost['emg_city'] = $emg_city;
                        $customerpost['emg_postalcode'] = $emg_postalcode;
                        $customerpost['favorite_food'] = $favorite_food;
                        $customerpost['favorite_sport'] = $favorite_sport;
                        $customerpost['favorite_destination'] = $favorite_destination;
                        $this->db->where('userid', $userid);
                        $this->db->update(db_prefix() . 'contacts', $customerpost);
                        
                        $status= true;
                        $message = 'Profile update successfully!';
                        //$msg = array('status' => true, 'message' =>'Profile update successfully!', 'result' => array());
                    }

                    $success = $this->db->select('id,userid,firstname,lastname,email,role,phonenumber,alternative_mobile,dob,doj,address,state,city,country,postal_code,address2,state2,city2,country2,postal_code2,designation_id,department_id,emg_name,emg_relatiopnship,emg_phone,emg_mobile,emg_address,emg_country,emg_state,emg_city,emg_postalcode,favorite_food,favorite_sport,favorite_destination,total_working_hours,police_start_date,police_end_date,wwcc_start_date,wwcc_end_date,firstaid_start_date,firstaid_end_date,gender')->get_where(db_prefix().'contacts', array('userid' => $userid))->row();
                    if($success->police_start_date!='' && $success->police_end_date!='' )
                    {
                        if(strtotime($success->police_end_date)>time())
                        {
                            $success->police_left_time =  time_calculate($success->police_start_date,$success->police_end_date);

                        }
                        else
                        {
                             $success->police_left_time =  'Expired';

                        }

                    }
                    else
                    {
                        $success->police_left_time ='';
                    }
                     if($success->wwcc_start_date!='' && $success->wwcc_end_date!='' )
                    {
                        if(strtotime($success->wwcc_end_date)>time())
                        {
                            $success->wwcc_left_time =  time_calculate($success->wwcc_start_date,$success->wwcc_end_date);

                        }
                        else
                        {
                            $success->wwcc_left_time =  'Expired';

                        }

                    }
                    else
                    {
                        $success->wwcc_left_time ='';
                    }
                    if($success->firstaid_start_date!='' && $success->firstaid_end_date!='' )
                    {
                        if(strtotime($success->firstaid_end_date)>time())
                        {
                            $success->firstaid_left_time =  time_calculate($success->firstaid_start_date,$success->firstaid_end_date);

                        }
                        else
                        {
                            $success->firstaid_left_time =  'Expired';

                        }

                    }
                    else
                    {
                        $success->firstaid_left_time ='';
                    }



                    // $success->servicename  =    servicename($success->service_type);
                    $success->departmentname  =    departementname($success->department_id);
                    $success->designationname  =    designationname($success->designation_id);

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
                $msg = array('status' => false, 'message' => 'Records are not matching1', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records are not matching', 'result' =>array());
        }   
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    /*-------------------------------------------------------------------
    *@function User Profile Image update-checked
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
    *@function get User Profile update-checked
    *-------------------------------------------------------------------*/
    public function getProfileData(){

        // print_r($this->user_data);
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $userid =  $this->user_data->userid;
       
        
        if($userid != '')
        {
            $userData = $this->db->get_where(db_prefix().'contacts', array('userid' => $userid ))->num_rows();
            if($userData > 0)
            {
                $success = $this->db->select('id,userid,firstname,lastname,email,role,phonenumber,alternative_mobile,dob,doj,address,state,city,country,postal_code,address2,state2,city2,country2,postal_code2,designation_id,department_id,emg_name,emg_relatiopnship,emg_phone,emg_mobile,emg_address,emg_country,emg_state,emg_city,emg_postalcode,favorite_food,favorite_sport,favorite_destination,total_working_hours,police_start_date,police_end_date,wwcc_start_date,wwcc_end_date,firstaid_start_date,firstaid_end_date,gender')->get_where(db_prefix().'contacts', array('userid' => $userid))->row();

                if($success->police_start_date!='' && $success->police_end_date!='' )
                    {
                        if(strtotime($success->police_end_date)>time())
                        {
                            $success->police_left_time =  time_calculate($success->police_start_date,$success->police_end_date);

                        }
                        else
                        {
                             $success->police_left_time =  'Expired';

                        }

                    }
                    else
                    {
                        $success->police_left_time ='';
                    }
                     if($success->wwcc_start_date!='' && $success->wwcc_end_date!='' )
                    {
                        if(strtotime($success->wwcc_end_date)>time())
                        {
                            $success->wwcc_left_time =  time_calculate($success->wwcc_start_date,$success->wwcc_end_date);

                        }
                        else
                        {
                            $success->wwcc_left_time =  'Expired';

                        }

                    }
                    else
                    {
                        $success->wwcc_left_time ='';
                    }
                    if($success->firstaid_start_date!='' && $success->firstaid_end_date!='' )
                    {
                        if(strtotime($success->firstaid_end_date)>time())
                        {
                            $success->firstaid_left_time =  time_calculate($success->firstaid_start_date,$success->firstaid_end_date);

                        }
                        else
                        {
                            $success->firstaid_left_time =  'Expired';

                        }

                    }
                    else
                    {
                        $success->firstaid_left_time ='';
                    }



                    // $success->servicename  =    servicename($success->service_type);
                    $success->departmentname  =    departementname($success->department_id);
                    $success->designationname  =    designationname($success->designation_id);
                    $designation_list = $this->db->get_where(db_prefix().'designation')->result();
                    $department_list = $this->db->get_where(db_prefix().'department')->result();

                $attachment_image = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array("rel_type" => "profile_image", "rel_id" => $userid))->row('file_name');
                    $attachment_imagepath = site_url('uploads/profile_image/'. $userid.'/'. $attachment_image);

                    if($attachment_image!='')
                    {
                         $success->profile_image = $attachment_imagepath;

                    }else{
                         $success->profile_image ='';
                    }

                        
                $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $success,'department_list'=>$department_list,'designation_list'=>$designation_list);
                
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
    *@function User changePassword-checked
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
                    $data['client_id'] = $value->client_id;
                    $data['service_id'] = servicename($value->service_id);
                    $data['client_name'] = ucfirst(clientname($value->client_id));                    
                    $data['start_date'] = $value->start_date;
                    $data['end_date'] = $value->end_date;
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
    *@function get getMyStressProfile
    *-------------------------------------------------------------------*/

    public function getMyStressProfile()
    {
        // $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $client_id = $this->user_data->userid;
        $allData =   0;
        if($client_id != '')
        {
            $userData = $this->api_model->getMyStressProfile($client_id);
               foreach ($userData as $value) 
                {
                    $firstdate = date('Y-m-d', strtotime("this week"));
                    // $enddate=date('Y-m-d', strtotime('+5 days'));
                    $enddate=date('Y-m-d', strtotime('+6 days', strtotime($firstdate)));
                    
                    $start_time =new DateTime($value->time_from);
                    $end_time = new DateTime($value->time_to);
                    $diff_time = $start_time->diff($end_time);
                    $data['diff_time'] = $diff_time->h;
                    // #-----------by ali old-code---------------------
                    // $start_day =new DateTime($value->start_date);
                    // $end_day = new DateTime($value->end_date);
                    // $diff_day = $start_day->diff($end_day);
                    // $data['diff_day'] = $diff_day->d;
                    // $final_hours = ($data['diff_day']+1)*$data['diff_time'];
                    // $allData = $allData + $final_hours;
                    // #-----------by ali old-code---------------------
                    if($value->start_date >= $firstdate && $value->end_date >=$enddate){
                        if($value->start_date == $firstdate){
                            $diffrence = 7;
                        }else{
                            $start_day1 =new DateTime($value->start_date);
                            $end_day1 = new DateTime($enddate);
                            $diff_day1 = $start_day1->diff($end_day1);
                            $diffrence = $diff_day1->d;
                        }
                    }elseif($value->start_date >= $firstdate && $value->end_date < $enddate){
                        if($value->start_date == $firstdate){
                            $start_day =new DateTime($firstdate);
                            $end_day = new DateTime($value->end_date);
                            $diff_day = $start_day->diff($end_day);
                            $diffrence = $diff_day->d;
                        }else{
                            $start_day =new DateTime($value->start_date);
                            $end_day = new DateTime($value->end_date);
                            $diff_day = $start_day->diff($end_day);
                            $diffrence = $diff_day->d;
                        }
                    }elseif($value->start_date < $firstdate && $value->end_date <= $enddate){
                        // echo'elseif';
                            $start_day =new DateTime($firstdate);
                            $end_day = new DateTime($value->end_date);
                            $diff_day = $start_day->diff($end_day);
                            $diffrence = $diff_day->d;

                    }elseif($value->start_date < $firstdate && $value->end_date > $enddate){
                            $start_day =new DateTime($firstdate);
                            $end_day = new DateTime($enddate);
                            $diff_day = $start_day->diff($end_day);
                            $diffrence = $diff_day->d;
                    }
                    $final_hours = ($diffrence+1)*$data['diff_time'];
                    $allData = $allData + $final_hours;
                }
                $success = $this->db->select('total_working_hours')->get_where(db_prefix().'contacts', array('userid' => $client_id))->row();
                // $select='saf_w1_saturday,saf_w1_sunday,saf_w1_monday,saf_w1_tuesday,saf_w1_wendesday,saf_w1_thursday,saf_w1_friday';
                // $totalHours = $this->db->select($select)->get_where(db_prefix().'employee', array('userid' => $client_id))->row();
                // $workinghours = 0;
                // foreach($totalHours as $key =>$value){
                //     $value =json_decode($value,true);
                //     foreach($value as $k =>$v){
                //         $workinghours=$workinghours+ $v;
                //     }
                // }
                $datafinal['hours_alloted']   =  $success->total_working_hours; 
                // $datafinal['hours_alloted']   =  $workinghours; 
                $datafinal['worked_hours']   =  (string)$allData; 
            if(count($datafinal)>0)
            {           
                $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $datafinal);
                
            }
            else
            {
                $datafinal['hours_alloted']   =  $success->total_working_hours; 
                $datafinal['worked_hours']   =  (string)$allData;
                $msg = array('status' => true, 'message' => 'Data Found', 'result' =>$datafinal);
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records are not matching' , 'result' =>array());
        }   
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    /*-------------------------------------------------------------------
    *@function get getMyStressProfile
    *-------------------------------------------------------------------*/

    public function getReportIncidentDetails()
    {
        
        $client_id = $this->user_data->userid;
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        if($client_id != '')
        {
            // echo $postdata;
            $postdata['userid']=$client_id;
            // print_r($postData);//die;

            $res = $this->db->get_where(db_prefix().'report_incident',$postdata)->row_array();
            // echo $this->db->last_query();
            // print_r($res);die;
            if(count($res)>0)
            {           
                $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $res);
            }
            else
            {
                $msg = array('status' => true, 'message' => 'Data Not Found', 'result' =>$res);
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records are not matching' , 'result' =>array());
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
            $addressData['created_date'] = YMD_date();
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
            $docData['added_by']  = 3;
            $docData['added_by_id']  = $userid;
            $docData['created_date']    = YMD_date();
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
            $docData['updated_date'] = YMD_date();
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
    *@function User Profile update-checked
    *-------------------------------------------------------------------*/
    public function addPoliceCheck()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true)); 
        $userid = $this->user_data->userid;    
        if($userid != '' )
        {
            $userData = $this->db->get_where(db_prefix().'contacts', array('userid' => $userid))->num_rows();
            if($userData > 0)
            { 
                $customerpost['police_start_date']      = $postData['police_start_date'];
                $customerpost['police_end_date']        = $postData['police_end_date'];
                $customerpost['police_change_by']       = 'Employee';
                $customerpost['police_change_date']     = YMD_date();
                $this->db->where('userid', $userid);
                $this->db->update(db_prefix() . 'contacts', $customerpost);
                
                $status= true;
                $message = 'Successfully Updated!';

                $newresult['police_start_date']    =   $postData['police_start_date'];
                $newresult['police_end_date']    =   $postData['police_end_date'];
                if($customerpost['police_start_date']!='' && $customerpost['police_end_date']!='' )
                {
                    if(strtotime($customerpost['police_end_date'])>time())
                    {
                        $newresult['police_left_time'] =  time_calculate($customerpost['police_start_date'],$customerpost['police_end_date']);

                    }
                    else
                    {
                         $newresult['police_left_time'] =  'Expired';

                    }

                }
                else
                {
                    $newresult['police_left_time'] ='';
                }

               
                $msg = array('status' => $status, 'message' => $message, 'result' => $newresult);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Send All Parameter', 'result' =>array());
        }   
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    /*-------------------------------------------------------------------
    *@function User Profile update-checked
    *-------------------------------------------------------------------*/
    public function addwwcc()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true)); 
        $userid = $this->user_data->userid;    
        if($userid != '' )
        {
            $userData = $this->db->get_where(db_prefix().'contacts', array('userid' => $userid))->num_rows();
            if($userData > 0)
            { 
                $customerpost['wwcc_start_date']        = $postData['wwcc_start_date'];
                $customerpost['wwcc_end_date']          = $postData['wwcc_end_date'];
                $customerpost['wwcc_change_by']         = 'Employee';
                $customerpost['wwcc_change_date']       = YMD_date();
                $this->db->where('userid', $userid);
                $this->db->update(db_prefix() . 'contacts', $customerpost);
                
                $status= true;
                $message = 'Successfully Updated!';

                $newresult['wwcc_start_date']    =   $postData['wwcc_start_date'];
                $newresult['wwcc_end_date']    =   $postData['wwcc_end_date'];
                if($customerpost['wwcc_start_date']!='' && $customerpost['wwcc_end_date']!='' )
                {
                    if(strtotime($customerpost['wwcc_end_date'])>time())
                    {
                        $newresult['wwcc_left_time'] =  time_calculate($customerpost['wwcc_start_date'],$customerpost['wwcc_end_date']);

                    }
                    else
                    {
                         $newresult['wwcc_left_time'] =  'Expired';

                    }

                }
                else
                {
                    $newresult['wwcc_left_time'] ='';
                }

                

                $msg = array('status' => $status, 'message' => $message, 'result' => $newresult);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Send All Parameter', 'result' =>array());
        }   
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    /*-------------------------------------------------------------------
    *@function User Profile update-checked
    *-------------------------------------------------------------------*/
    public function addFirstaid()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true)); 
        $userid = $this->user_data->userid;    
        if($userid != '' )
        {
            $userData = $this->db->get_where(db_prefix().'contacts', array('userid' => $userid))->num_rows();
            if($userData > 0)
            { 
                $customerpost['firstaid_start_date']        = $postData['firstaid_start_date'];
                $customerpost['firstaid_end_date']          = $postData['firstaid_end_date'];
                $customerpost['firstaid_change_by']         = 'Employee';
                $customerpost['firstaid_change_date']       = YMD_date();
                $this->db->where('userid', $userid);
                $this->db->update(db_prefix() . 'contacts', $customerpost);
                
                $status= true;
                $message = 'Successfully Updated!';

                $newresult['firstaid_start_date']    =   $postData['firstaid_start_date'];
                $newresult['firstaid_end_date']    =   $postData['firstaid_end_date'];
                
                if($customerpost['firstaid_start_date']!='' && $customerpost['firstaid_end_date']!='' )
                {
                    if(strtotime($customerpost['firstaid_end_date'])>time())
                    {
                        $newresult['firstaid_left_time'] =  time_calculate($customerpost['firstaid_start_date'],$customerpost['firstaid_end_date']);

                    }
                    else
                    {
                         $newresult['firstaid_left_time'] =  'Expired';

                    }

                }
                else
                {
                    $newresult['firstaid_left_time'] ='';
                }
                $msg = array('status' => $status, 'message' => $message, 'result' => $newresult);
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Send All Parameter', 'result' =>array());
        }   
        $this->response($msg, REST_Controller::HTTP_OK);
    }



    /*-------------------------------------------------------------------
    *@function User Profile Image update
    *-------------------------------------------------------------------*/
    public function addLeave()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $userid  = $this->user_data->userid;
        
        if($userid!='' )
        {
            $docData['employee_id']         = $userid;
            $docData['leave_type_id']       = $postData['leave_type_id'];
            $docData['leave_type_name']     = leavetype($postData['leave_type_id']);
            $docData['from_date_time']      = date('Y-m-d H:i:s', strtotime($postData['from_date']));
            $docData['from_date']           = $postData['from_date'];
            $docData['to_date']             = $postData['to_date'];
            $docData['half_day']            = $postData['half_day'];
            $docData['description']         = $postData['description'];
            $docData['created_date']        = YMD_date();
            $this->db->insert(db_prefix().'leave_request', $docData);
            // echo $this->db->last_query();
            $lid = $this->db->insert_id();
            if($lid)
            {
                $status= true;
                $message = 'Leave Added Successfully!';
            }
            else
            {
                $status= false;
                $message = 'Something Went Wrong!';

            }
              
            $msg = array('status' => $status, 'message' => $message, 'result' => $lid); 
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Record Not Match', 'result' =>array());
        }   
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    /*-------------------------------------------------------------------
    *@function User Profile Image update
    *-------------------------------------------------------------------*/
    public function updateLeave()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $userid  = $this->user_data->userid;
        $id       = $postData['id'];
        if($userid!='' && $id!='')
        {
            
            $docData['leave_type_id']       = $postData['leave_type_id'];
            $docData['leave_type_name']     = leavetype($postData['leave_type_id']);
            $docData['from_date_time']      = date('Y-m-d H:i:s', strtotime($postData['from_date']));
            $docData['from_date']           = $postData['from_date'];
            $docData['to_date']             = $postData['to_date'];
            $docData['half_day']            = $postData['half_day'];
            $docData['description']         = $postData['description'];
            $docData['updated_date']        = YMD_date();
            $this->db->where('id', $id);
            $this->db->where('employee_id', $userid);
            $this->db->update(db_prefix().'leave_request', $docData);
            if($this->db->affected_rows()>0)
            {
                $status= true;
                $message = 'Leave Updated Successfully!';
            }
            else
            {
                $status= false;
                $message = 'Something Went Wrong!';

            }
              
            $msg = array('status' => $status, 'message' => $message, 'result' => $id); 
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

    public function deleteLeave()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $userid = $this->user_data->userid;
        $id = $postData['id'];
        
        if($id != '' && $userid!='')
        {
            $this->db->delete(db_prefix().'leave_request', array('id' => $id,'employee_id' => $userid));
            $msg = array('status' => true, 'message' =>'Deleted Successfully', 'result' => array());
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

    public function getLeaveDetail()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $userid = $this->user_data->userid;
        $id = $postData['id'];
        
        if($id != '' && $userid!='')
        {
            $userData = $this->db->get_where(db_prefix().'leave_request', array('id' => $id,'employee_id' => $userid))->result();

            if(count($userData) > 0)
            {
                foreach ($userData as $value) 
                {
                    $data['id']                     = $value->id;
                    $data['leave_type_id']          = $value->leave_type_id;
                    $data['leave_type']             = leavetype($value->leave_type_id);
                    $data['description']            = $value->description;
                    $data['from_date']              = $value->from_date;
                    $data['to_date']                = $value->to_date;
                    $data['half_day']               = ($value->half_day==1)?'Yes':'No';
                    $data['status']                 = leavestatus($value->status);
                    $allData[] = $data;
                }
                   
                $msg = array('status' =>true, 'message' => 'Data Found' , 'result' => $allData);
                
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Records are not matching', 'result' =>array());
            } 
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

    public function getMyLeave()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $userid = $this->user_data->userid;   
        $postData['page'] = $_GET['page'];
        $postData['limit'] = $_GET['limit'];
   
        if($userid != '' )
        {
            $userData = $this->api_model->getMyLeave($postData,$userid);
            $userDataCount = $this->api_model->getMyLeaveCount($postData,$userid);
            // $userData = $this->db->order_by('id','DESC')->get_where(db_prefix().'document', array('client_id' => $userid))->result();
            if(count($userData) > 0)
            {
                foreach ($userData as $value) 
                {
                    $data['id']                     = $value->id;
                    $data['leave_type']             = leavetype($value->leave_type_id);
                    $data['description']            = $value->description;
                    $data['from_date']              = $value->from_date;
                    $data['to_date']                = $value->to_date;
                    $data['half_day']               = ($value->half_day==1)?'Yes':'No';
                    $data['status']                 = leavestatus($value->status);
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
            $msg = array('status' => false, 'message' => 'Send All Parameter', 'result' =>array());
        }  
        
        $this->response($msg, REST_Controller::HTTP_OK);
    } 

    /*-------------------------------------------------------------------
    *@function get Invoice
    *-------------------------------------------------------------------*/

    public function getUpcomingTraning()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
       
        $postData['page'] = $_GET['page'];
        $postData['limit'] = $_GET['limit'];
              
        
        $userData = $this->api_model->getUpcomingTraning($postData);
        $userDataCount = $this->api_model->getUpcomingTraningCount();
        // $userData = $this->db->order_by('id','DESC')->get_where(db_prefix().'document', array('client_id' => $userid))->result();
        if(count($userData) > 0)
        {
            foreach ($userData as $value) 
            {
                $data['title']          = $value->title;
                $data['description']    = $value->description;
                $data['created_date'] = $value->created_date;
                $allData[] = $data;
            }
           
           
                    
            $msg = array('status' =>true, 'message' => 'Data Found', 'count' =>$userDataCount , 'result' => $allData);
            
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

    public function getNotice()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
       
        $postData['page'] = $_GET['page'];
        $postData['limit'] = $_GET['limit'];
              
        
        $userData = $this->api_model->getNotice($postData);
        $userDataCount = $this->api_model->getNoticeCount();
        // $userData = $this->db->order_by('id','DESC')->get_where(db_prefix().'document', array('client_id' => $userid))->result();
        if(count($userData) > 0)
        {
            foreach ($userData as $value) 
            {
                $data['id']             = $value->id;
                $data['title']          = $value->title;
                $data['description']    = $value->description;
                $data['created_date'] = $value->created_date;
                $allData[] = $data;
            }
           
           
                    
            $msg = array('status' =>true, 'message' => 'Data Found', 'count' =>$userDataCount , 'result' => $allData);
            
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

    public function getNoticeDetail()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $id = $postData['id'];
       
              
        $userData = $this->db->get_where(db_prefix().'notice', array('id' => $id))->row();
        if(count($userData) > 0)
        {
            
            $data['id']             = $userData->id;
            $data['title']          = $userData->title;
            $data['description']    = $userData->description;
            $data['created_date']   = $userData->created_date;
            $data['added_by']       = ($userData->added_by==0) ? 'Admin': 'HR';
            $data['added_by_name']  =  ($userData->added_by==0) ? 'Admin': ucfirst(clientname($userData->added_by_id));
           
           $attachment_image = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array("rel_type" => "profile_image", "rel_id" => $userData->added_by_id))->row('file_name');
            $attachment_imagepath = site_url('uploads/profile_image/'. $userData->added_by_id.'/'. $attachment_image);

            if($attachment_image!='')
            {
                $data['profile_image'] = $attachment_imagepath;

            }else{
                $data['profile_image'] ='';
            }


            $allData[] = $data;
                 
            $msg = array('status' =>true, 'message' => 'Data Found' , 'result' => $allData);
            
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records are not matching' , 'result' =>array());
        }
        
        $this->response($msg, REST_Controller::HTTP_OK);
    } 

    /*-------------------------------------------------------------------
    *@function get Invoice
    *-------------------------------------------------------------------*/

    public function getPolicy()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
       
        $postData['page'] = $_GET['page'];
        $postData['limit'] = $_GET['limit'];
              
        
        $userData = $this->api_model->getPolicy($postData);
        $userDataCount = $this->api_model->getPolicyCount($postData);
        // $userData = $this->db->order_by('id','DESC')->get_where(db_prefix().'document', array('client_id' => $userid))->result();
        // print_r($userData);
        // die;
        if(count($userData) > 0)
        {
            foreach ($userData as $value) 
            {
                $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $value->id, 'rel_type' => 'policy'))->row('file_name');
                $data['id'] = $value->id;
                $data['name'] = $value->name;
                $data['created_date'] = $value->created_date;
                $data['file_size'] = bytesToSize('uploads/policy/'.$value->id.'/'.$filename);
                $data['file'] = base_url().'uploads/policy/'.$value->id.'/'.$filename;

                $allData[] = $data;
            }
           
           
                    
            $msg = array('status' =>true, 'message' => 'Data Found', 'count' =>$userDataCount , 'result' => $allData);
            
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
    public function getMyClients()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $userid = $this->user_data->userid;   
        $postData['page'] = $_GET['page'];
        $postData['limit'] = $_GET['limit'];
        $careplan=array();
        if($userid != '' )
        {
            $userData = $this->api_model->getMyClients($postData,$userid);
            $userDataCount = $this->api_model->getMyClientsCount($postData,$userid);
            // $userData = $this->db->order_by('id','DESC')->get_where(db_prefix().'document', array('client_id' => $userid))->result();
            if(count($userData) > 0)
            {
                foreach ($userData as $value) 
                {
                    

                    $data['client_id']              = $value->userid;
                    $data['registration_no']              = $value->registration_no;
                    $data['client_name']            = $value->firstname.' '.$value->lastname;
                    $data['phoneno']                = $value->phonenumber;
                    
                    $cityname       = (cityname($value->city)!='-')?cityname($value->city).' ':'';
                    $statename      = (statename($value->state)!='-')?statename($value->state).' ':'';
                    $countryname    = (countryname($value->country)!='-')?countryname($value->country).' ':'';

                    $data['address']                = $value->address.' '.$cityname.''.$statename.''.$countryname.' '.$value->postal_code;
                    $data['servicename']            = servicename($value->service_type);
                    $data['added_by']               = clientname($value->added_by);
                    $myCarePlan                     = $this->api_model->getMyCarePlan($value->client_id);
                    foreach ($myCarePlan as $valueCar) 
                    {
                        $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $valueCar->id, 'rel_type' => 'care_plan'))->row('file_name');
                        $file = base_url().'uploads/care_plan/'.$valueCar->id.'/'.$filename;
                        $careplan[]  = $file;
                    }
                    $data['careplan']          =    $careplan;

                    $assigned_date  =    $this->db->order_by('id','ASC')->limit(1)->get_where(db_prefix().'care_plan', array('client_id' => $value->client_id))->row('created_date');
                    $data['assigned_date']          =($assigned_date!='')?$assigned_date:'';
                    $allData[] = $data;
                    
                }
                   
                $msg = array('status' =>true, 'message' => 'Data Found' , 'result' => $allData);
                
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Records are not matching', 'result' =>array());
            } 
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Send All Parameter', 'result' =>array());
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
            $ReqData['contactid'] = 0;
            $ReqData['subject'] = $_POST['subject'];
            $ReqData['message'] = $_POST['message'];
            $ReqData['department'] = $_POST['department'];
            $ReqData['priority']    = $_POST['priority'];
            $ReqData['status'] = 1;
            $ReqData['added_by'] = 3;
            $ReqData['date'] = YMD_date();
            $this->db->insert(db_prefix().'tickets', $ReqData);
            $ticketid = $this->db->insert_id();
            // attachments
            if($ticketid)
            {
                $attachments = handle_file_upload($ticketid,'ticket_attachments', 'attachments');
                if ($attachments && is_array($attachments)) {
                    foreach ($attachments as $file) 
                    {
                      $this->insert_ticket_attachments_to_database_employee([$file], $ticketid); 
                    }
                }

                $useremail = $this->db->get_where(db_prefix().'contacts', array('userid'=>$this->user_data->userid))->row('email');
                $conatctemail = $this->db->get_where(db_prefix().'contacts', array('userid'=>$ReqData['contactid']))->row('email');

                $message1   = 'Caring Approach : Support Ticket';
                $message1   .= '<br>Subject : '.$_POST['subject'];
                $message1   .= '<br>Message : '.$_POST['message'];
                // $message1   .= '<br>Contact Name : '.clientname($ReqData['contactid']);
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
                // send_mail($conatctemail, $sub1, $tempmsg);


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
            $ReqData['added_by'] = 3;
            $ReqData['message'] = $_POST['message'];
            $ReqData['date'] = YMD_date();
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
                      $this->insert_ticket_attachments_to_database_employee([$file], $ticketid,$ticketreplyid); 
                    }
                }

                $status = 1;
                $this->db->select('status');
                $this->db->where('ticketid', $id);
                $old_ticket_status = $this->db->get(db_prefix() . 'tickets')->row()->status;
                $this->db->where('ticketid', $ticketid);
                $this->db->update(db_prefix() . 'tickets', [
                    'lastreply' => YMD_date(),
                    // 'status'     => ($old_ticket_status == 2 && $clo == 0 ? $old_ticket_status : $status),
                    'adminread'             => 0,
                    'clientread'             => 0
                ]);

                $useremail = $this->db->get_where(db_prefix().'contacts', array('userid'=>$this->user_data->userid))->row('email');

                $contactdata = $this->db->get_where(db_prefix().'tickets', array('ticketid'=>$ticketid))->row();
                // $conatctemail = $this->db->get_where(db_prefix().'contacts', array('userid'=>$contactdata->contactid))->row('email');

                $message1   = 'Caring Approach : Support Ticket';
                $message1   .= '<br>Subject : '.$contactdata->subject;
                $message1   .= '<br>Message : '.$_POST['message'];
                // $message1   .= '<br>Contact Name : '.clientname($contactdata->contactid);
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
                // send_mail($conatctemail, $sub1, $tempmsg);

                // $where['userid']= $userid;
                // $notificationdata['notify_type']='Ticket';
                // $notificationdata['notify_name']='Ticket Reply';
                // $notificationdata['sender']=$this->db->get_where('tblcontacts',$where)->row('firstname');
                // $message='New Ticket <a href="javascript:void(0)">'.$sub1.'</a>';
                // $notificationdata['sender_id']=$userid;
                // $notificationdata['title']=$sub1;
                // $notificationdata['message']=$message;
                // print_r($notificationdata);die;
                // $this->db->insert('tblnotification',$notificationdata);
                // notification($notificationdata);

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
    //    print_r($postData);die;
        $postData['page'] = $postData['page'];
        $postData['limit'] = $postData['limit'];
        $postData['status'] = $postData['status'];
       
        
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
                    // $data['contactid'] = clientname($value->contactid);
                    $data['department'] = supportDepartment($value->department);
                    $data['priority'] = supportPriorities($value->priority);
                    $data['status'] = supportStatus($value->status);
                    $data['date'] = $value->date;
                    $data['lastreply'] = ($value->lastreply!=null)?$value->lastreply:'';
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
                    // $data['contactid'] = clientname($value->contactid);
                    $data['department'] = supportDepartment($value->department);
                    $data['priority'] = supportPriorities($value->priority);
                    $data['status'] = supportStatus($value->status);
                    $data['date'] = $value->date;
                    $data['lastreply'] = ($value->lastreply!=null)?$value->lastreply:'';
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
                            $repData['type'] = 'Human resources';
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
                    $data['reply'] = (count($dataReplyAB)>0)?$dataReplyAB:array();
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


    public function insert_ticket_attachments_to_database_employee($attachments, $ticketid, $replyid = false)
    {
        foreach ($attachments as $attachment) 
        {
            $attachmentADD['file_name'] = $attachment['file_name'];
            $attachmentADD['filetype'] = $attachment['filetype'];
            $attachmentADD['ticketid']  = $ticketid;
            $attachmentADD['dateadded'] = YMD_date();
            if ($replyid !== false && is_int($replyid)) {
                $attachmentADD['replyid'] = $replyid;
            }
            $this->db->insert(db_prefix() . 'ticket_attachments', $attachmentADD);  
        }
    
    }


    /*-------------------------------------------------------------------
    *@function Transport booking
    *-------------------------------------------------------------------*/
    public function addNewEmployeeForm()
    {
 
        $userid = $this->user_data->userid;
        // echo $userid;die;
        if($userid!='' && $_POST['referred_by'] != '' )
        {
             $count=0;
            if($userid!='')
            {
                $count++;
                $contactData['userid'] = $userid;
            }
            if($_POST['referred_by']!='')
            {
                $count++;
                $contactData['referred_by'] = $_POST['referred_by'];
            }
            if($_POST['referred_name']!='')
            {
                $count++;
                $contactData['referred_name'] = $_POST['referred_name'];
            }else{
                $contactData['referred_name'] = '';
            }
            if($_POST['existing_employment']!='')
            {
                $count++;
                $contactData['existing_employment'] = $_POST['existing_employment'];
            }
            if($_POST['existing_company_name']!='')
            {
                $count++;
                $contactData['existing_company_name'] = $_POST['existing_company_name'];
            }
            if($_POST['pd_gender']!='')
            {
                $count++;
                $contactData['pd_gender'] = $_POST['pd_gender'];
            }
            if($_POST['pd_dob']!='')
            {
                $count++;
                $contactData['pd_dob'] = $_POST['pd_dob'];
            }
            if($_POST['pd_surname']!='')
            {
                $count++;
                $contactData['pd_surname'] = $_POST['pd_surname'];
            }
            if($_POST['pd_name']!='')
            {
                $count++;
                $contactData['pd_name'] = $_POST['pd_name'];
            }
            if($_POST['pd_mobile']!='')
            {
                $count++;
                $contactData['pd_mobile'] = $_POST['pd_mobile'];
            }
            if($_POST['pd_phone']!='')
            {
                $count++;
                $contactData['pd_phone'] = $_POST['pd_phone'];
            }
            if($_POST['pd_address']!='')
            {
                $count++;
                $contactData['pd_address'] = $_POST['pd_address'];
            }
            if($_POST['pd_suburb']!='')
            {
                $count++;
                $contactData['pd_suburb'] = $_POST['pd_suburb'];
            }
            if($_POST['pd_postcode']!='')
            {
                $count++;
                $contactData['pd_postcode'] = $_POST['pd_postcode'];
            }
            if($_POST['pd_email']!='')
            {
                $count++;
                $contactData['pd_email'] = $_POST['pd_email'];
            }
            if($_POST['ecd_name']!='')
            {
                $count++;
                $contactData['ecd_name'] = $_POST['ecd_name'];
            }
            if($_POST['ecd_address']!='')
            {
                $count++;
                $contactData['ecd_address'] = $_POST['ecd_address'];
            }
            if($_POST['ecd_phone']!='')
            {
                $count++;
                $contactData['ecd_phone'] = $_POST['ecd_phone'];
            }
            if($_POST['ecd_mobile']!='')
            {
                $count++;
                $contactData['ecd_mobile'] = $_POST['ecd_mobile'];
            }
            if($_POST['ecd_suburb']!='')
            {
                $count++;
                $contactData['ecd_suburb'] = $_POST['ecd_suburb'];
            }
            if($_POST['ecd_postcode']!='')
            {
                $count++;
                $contactData['ecd_postcode'] = $_POST['ecd_postcode'];
            }
            if($_POST['ecd_relationship']!='')
            {
                $count++;
                $contactData['ecd_relationship'] = $_POST['ecd_relationship'];
            }
            if($_POST['ebd_bank']!='')
            {
                $count++;
                $contactData['ebd_bank'] = $_POST['ebd_bank'];
            }
            if($_POST['ebd_branch']!='')
            {
                $count++;
                $contactData['ebd_branch'] = $_POST['ebd_branch'];
            }
            if($_POST['ebd_account_name']!='')
            {
                $count++;
                $contactData['ebd_account_name'] = $_POST['ebd_account_name'];
            }
            if($_POST['ebd_bsb']!='')
            {
                $count++;
                $contactData['ebd_bsb'] = $_POST['ebd_bsb'];
            }
            if($_POST['ebd_account_no']!='')
            {
                $count++;
                $contactData['ebd_account_no'] = $_POST['ebd_account_no'];
            }
            if($_POST['efw_injury']!='')
            {
                $count++;
                $contactData['efw_injury'] = $_POST['efw_injury'];
            }
            if($_POST['efw_detail']!='')
            {
                $count++;
                $contactData['efw_detail'] = $_POST['efw_detail'];
            }
            if($_POST['efw_date']!='')
            {
                $count++;
                $contactData['efw_date'] = $_POST['efw_date'];
            }
            if($_POST['cb_name']!='')
            {
                $count++;
                $contactData['cb_name'] = $_POST['cb_name'];
            }
            if($_POST['cb_date']!='')
            {
                $count++;
                $contactData['cb_date'] = $_POST['cb_date'];
            }
            if($_POST['cb_position']!='')
            {
                $count++;
                $contactData['cb_position'] = $_POST['cb_position'];
            }
            if($_POST['cb_qualifications']!='')
            {
                $count++;
                $contactData['cb_qualifications'] = $_POST['cb_qualifications'];
            }
            if($_POST['cb_pay_point']!='')
            {
                $count++;
                $contactData['cb_pay_point'] = $_POST['cb_pay_point'];
            }
            if($_POST['cb_start_date']!='')
            {
                $count++;
                $contactData['cb_start_date'] = $_POST['cb_start_date'];
            }
            if($_POST['cur_women']!='')
            {
                $count++;
                $contactData['cur_women'] = $_POST['cur_women'];
            }
            if($_POST['cur_wquantity']!='')
            {
                $count++;
                $contactData['cur_wquantity'] = $_POST['cur_wquantity'];
            }
            if($_POST['cur_men']!='')
            {
                $count++;
                $contactData['cur_men'] = $_POST['cur_men'];
            }
            if($_POST['cur_mquantity']!='')
            {
                $count++;
                $contactData['cur_mquantity'] = $_POST['cur_mquantity'];
            }
            if($_POST['c_emp_name']!='')
            {
                $count++;
                $contactData['c_emp_name'] = $_POST['c_emp_name'];
            }
            if($_POST['c_wit_name']!='')
            {
                $count++;
                $contactData['c_wit_name'] = $_POST['c_wit_name'];
            }
            if($_POST['c_date']!='')
            {
                $count++;
                $contactData['c_date'] = $_POST['c_date'];
            }
            if($_POST['processed_line_date']!='')
            {
                $count++;
                $contactData['processed_line_date'] = $_POST['processed_line_date'];
            }
            if($_POST['processed_line_initial']!='')
            {
                $count++;
                $contactData['processed_line_initial'] = $_POST['processed_line_initial'];
            }
            if($_POST['police_check_received_date']!='')
            {
                $count++;
                $contactData['police_check_received_date'] = $_POST['police_check_received_date'];
            }
            if($_POST['police_check_received_initial']!='')
            {
                $count++;
                $contactData['police_check_received_initial'] = $_POST['police_check_received_initial'];
            }
            if($_POST['discloseable_outcomes_date']!='')
            {
                $count++;
                $contactData['discloseable_outcomes_date'] = $_POST['discloseable_outcomes_date'];
            }
            if($_POST['discloseable_outcomes_initial']!='')
            {
                $count++;
                $contactData['discloseable_outcomes_initial'] = $_POST['discloseable_outcomes_initial'];
                }
            if($_POST['fully_deducted_date']!='')
            {
                $count++;
                $contactData['fully_deducted_date'] = $_POST['fully_deducted_date'];
                }
            if($_POST['fully_deducted_initial']!='')
            {
                $count++;
                $contactData['fully_deducted_initial'] = $_POST['fully_deducted_initial'];
                }
            if($_POST['uniform_ordered_date']!='')
            {
                $count++;
                $contactData['uniform_ordered_date'] = $_POST['uniform_ordered_date'];
                }
            if($_POST['uniform_ordered_initial']!='')
            {
                $count++;
                $contactData['uniform_ordered_initial'] = $_POST['uniform_ordered_initial'];
                }
            if($_POST['cost_uniform_date']!='')
            {
                $count++;
                $contactData['cost_uniform_date'] = $_POST['cost_uniform_date'];
                }
            if($_POST['cost_uniform_initial']!='')
            {
                $count++;
                $contactData['cost_uniform_initial'] = $_POST['cost_uniform_initial'];
                }
            if($_POST['total_cost_uniform']!='')
            {
                $count++;
                $contactData['total_cost_uniform'] = $_POST['total_cost_uniform'];
              }
            if($_POST['total_cost_uniform_initial']!='')
            {
                $count++;
                $contactData['total_cost_uniform_initial'] = $_POST['total_cost_uniform_initial'];
              }
            if($_POST['fully_deducted_pay_date']!='')
            {
                $count++;
                $contactData['fully_deducted_pay_date'] = $_POST['fully_deducted_pay_date'];
                }
            if($_POST['fully_deducted_pay_initial']!='')
            {
                $count++;
                $contactData['fully_deducted_pay_initial'] = $_POST['fully_deducted_pay_initial'];
                }
            if($_POST['eic_name']!='')
            {
                $count++;
                $contactData['eic_name'] = $_POST['eic_name'];
                }
            if($_POST['eic_date']!='')
            {
                $count++;
                $contactData['eic_date'] = $_POST['eic_date'];
                }
            if($_POST['mppc_document']!='')
            {
                $count++;
                $contactData['mppc_document'] = $_POST['mppc_document'];
                }
            if($_POST['mppc_document2']!='')
            {
                $count++;
                $contactData['mppc_document2'] = $_POST['mppc_document2'];
                }
            if($_POST['mppc_document_multi']!='')
            {
                $count++;
                $contactData['mppc_document_multi'] = $_POST['mppc_document_multi'];
                }
            if($_POST['mppc_picture_hold']!='')
            {
                $count++;
                $contactData['mppc_picture_hold'] = $_POST['mppc_picture_hold'];
                }
            if($_POST['mppc_name']!='')
            {
                $count++;
                $contactData['mppc_name'] = $_POST['mppc_name'];
                }
            if($_POST['mppc_date']!='')
            {
                $count++;
                $contactData['mppc_date'] = $_POST['mppc_date'];
                }
            if($_POST['superannuation_fund']!='')
            {
                $count++;
                $contactData['superannuation_fund'] = $_POST['superannuation_fund'];
                }
            if($_POST['hesta_member_no']!='')
            {
                $count++;
                $contactData['hesta_member_no'] = $_POST['hesta_member_no'];
                }
            if($_POST['hesta_dob']!='')
            {
                $count++;
                $contactData['hesta_dob'] = $_POST['hesta_dob'];
                }
            if($_POST['hesta_ac_no']!='')
            {
                $count++;
                $contactData['hesta_ac_no'] = $_POST['hesta_ac_no'];
                }
            if($_POST['hesta_bsb']!='')
            {
                $count++;
                $contactData['hesta_bsb'] = $_POST['hesta_bsb'];
                }
            if($_POST['ecf_name']!='')
            {
                $count++;
                $contactData['ecf_name'] = $_POST['ecf_name'];
                }
            if($_POST['ecf_pro_no']!='')
            {
                $count++;
                $contactData['ecf_pro_no'] = $_POST['ecf_pro_no'];
                }
            if($_POST['ecf_telephone']!='')
            {
                $count++;
                $contactData['ecf_telephone'] = $_POST['ecf_telephone'];
                }
            if($_POST['ecf_website']!='')
            {
                $count++;
                $contactData['ecf_website'] = $_POST['ecf_website'];
                }
            if($_POST['csf_name']!='')
            {
                $count++;
                $contactData['csf_name'] = $_POST['csf_name'];
                }
            if($_POST['csf_abn']!='')
            {
                $count++;
                $contactData['csf_abn'] = $_POST['csf_abn'];
                }
            if($_POST['csf_address']!='')
            {
                $count++;
                $contactData['csf_address'] = $_POST['csf_address'];
                }
            if($_POST['csf_phone']!='')
            {
                $count++;
                $contactData['csf_phone'] = $_POST['csf_phone'];
                }
            if($_POST['csf_mem_no']!='')
            {
                $count++;
                $contactData['csf_mem_no'] = $_POST['csf_mem_no'];
                }
            if($_POST['csf_ac_no']!='')
            {
                $count++;
                $contactData['csf_ac_no'] = $_POST['csf_ac_no'];
                }
            if($_POST['csf_ac_name']!='')
            {
                $count++;
                $contactData['csf_ac_name'] = $_POST['csf_ac_name'];
                }
            if($_POST['csf_pro_no']!='')
            {
                $count++;
                $contactData['csf_pro_no'] = $_POST['csf_pro_no'];
                }
            if($_POST['csf_bsb']!='')
            {
                $count++;
                $contactData['csf_bsb'] = $_POST['csf_bsb'];
                }
            if($_POST['ed_name']!='')
            {
                $count++;
                $contactData['ed_name'] = $_POST['ed_name'];
                }
            if($_POST['ed_date']!='')
            {
                $count++;
                $contactData['ed_date'] = $_POST['ed_date'];
                }
            if($_POST['sd_name']!='')
            {
                $count++;
                $contactData['sd_name'] = $_POST['sd_name'];
                }
            if($_POST['sd_address']!='')
            {
                $count++;
                $contactData['sd_address'] = $_POST['sd_address'];
                }
            if($_POST['sd_occupation']!='')
            {
                $count++;
                $contactData['sd_occupation'] = $_POST['sd_occupation'];
                }
            if($_POST['i_declare1']!='')
            {
                $count++;
                $contactData['i_declare1'] = $_POST['i_declare1'];
                }
            if($_POST['i_declare2']!='')
            {
                $count++;
                $contactData['i_declare2'] = $_POST['i_declare2'];
                }
            if($_POST['id_date']!='')
            {
                $count++;
                $contactData['id_date'] = $_POST['id_date'];
                }
            if($_POST['id_wb_name']!='')
            {
                $count++;
                $contactData['id_wb_name'] = $_POST['id_wb_name'];
                }
            if($_POST['id_wb_qualification']!='')
            {
                $count++;
                $contactData['id_wb_qualification'] = $_POST['id_wb_qualification'];
                }
            if($_POST['id_wb_address']!='')
            {
                $count++;
                $contactData['id_wb_address'] = $_POST['id_wb_address'];
                }
            if($_POST['dic_fname']!='')
            {
                $count++;
                $contactData['dic_fname'] = $_POST['dic_fname'];
                }
            if($_POST['dic_gname']!='')
            {
                $count++;
                $contactData['dic_gname'] = $_POST['dic_gname'];
                }
            if($_POST['dic_oname']!='')
            {
                $count++;
                $contactData['dic_oname'] = $_POST['dic_oname'];
                }
            if($_POST['dic_dob']!='')
            {
                $count++;
                $contactData['dic_dob'] = $_POST['dic_dob'];
                }
            if($_POST['dic_nationality']!='')
            {
                $count++;
                $contactData['dic_nationality'] = $_POST['dic_nationality'];
                }
            if($_POST['dic_passport_no']!='')
            {
                $count++;
                $contactData['dic_passport_no'] = $_POST['dic_passport_no'];
                }
            if($_POST['dic_visa']!='')
            {
                $count++;
                $contactData['dic_visa'] = $_POST['dic_visa'];
                }
            if($_POST['dic_visa_exp_date']!='')
            {
                $count++;
                $contactData['dic_visa_exp_date'] = $_POST['dic_visa_exp_date'];
                }
            if($_POST['dic_date']!='')
            {
                $count++;
                $contactData['dic_date'] = $_POST['dic_date'];
                }
            if($_POST['saf_name']!='')
            {
                $count++;
                $contactData['saf_name'] = $_POST['saf_name'];
                }
            if($_POST['saf_commitment']!='')
            {
                $count++;
                $contactData['saf_commitment'] = $_POST['saf_commitment'];
                }
            if($_POST['saf_w1_saturday']!='')
            {
                $count++;
                $contactData['saf_w1_saturday'] = $_POST['saf_w1_saturday'];
                }
            if($_POST['saf_w1_sunday']!='')
            {
                $count++;
                $contactData['saf_w1_sunday'] = $_POST['saf_w1_sunday'];
                }
            if($_POST['saf_w1_monday']!='')
            {
                $count++;
                $contactData['saf_w1_monday'] = $_POST['saf_w1_monday'];
                }
            if($_POST['saf_w1_tuesday']!='')
            {
                $count++;
                $contactData['saf_w1_tuesday'] = $_POST['saf_w1_tuesday'];
                }
            if($_POST['saf_w1_wendesday']!='')
            {
                $count++;
                $contactData['saf_w1_wendesday'] = $_POST['saf_w1_wendesday'];
                }
            if($_POST['saf_w1_thursday']!='')
            {
                $count++;
                $contactData['saf_w1_thursday'] = $_POST['saf_w1_thursday'];
                }
            if($_POST['saf_w1_friday']!='')
            {
                $count++;
                $contactData['saf_w1_friday'] = $_POST['saf_w1_friday'];
                }
            if($_POST['saf_w2_saturday']!='')
            {
                $count++;
                $contactData['saf_w2_saturday'] = $_POST['saf_w2_saturday'];
                }
            if($_POST['saf_w2_sunday']!='')
            {
                $count++;
                $contactData['saf_w2_sunday'] = $_POST['saf_w2_sunday'];
                }
            if($_POST['saf_w2_monday']!='')
            {
                $count++;
                $contactData['saf_w2_monday'] = $_POST['saf_w2_monday'];
                }
            if($_POST['saf_w2_tuesday']!='')
            {
                $count++;
                $contactData['saf_w2_tuesday'] = $_POST['saf_w2_tuesday'];
                }
            if($_POST['saf_w2_wendesday']!='')
            {
                $count++;
                $contactData['saf_w2_wendesday'] = $_POST['saf_w2_wendesday'];
                }
            if($_POST['saf_w2_thursday']!='')
            {
                $count++;
                $contactData['saf_w2_thursday'] = $_POST['saf_w2_thursday'];
                }
            if($_POST['saf_w2_friday']!='')
            {
                $count++;
                $contactData['saf_w2_friday'] = $_POST['saf_w2_friday'];
                }
            if($_POST['saf_date']!='')
            {
                $count++;
                $contactData['saf_date'] = $_POST['saf_date'];
                }
            if($_POST['tfdn_no']!='')
            {
                $count++;
                $contactData['tfdn_no'] = $_POST['tfdn_no'];
                }
            if($_POST['tfdn_value']!='')
            {
                $count++;
                $contactData['tfdn_value'] = $_POST['tfdn_value'];
                }
            if($_POST['tfdn_title']!='')
            {
                $count++;
                $contactData['tfdn_title'] = $_POST['tfdn_title'];
                }
            if($_POST['tfdn_fname']!='')
            {
                $count++;
                $contactData['tfdn_fname'] = $_POST['tfdn_fname'];
                }
            if($_POST['tfdn_oname']!='')
            {
                $count++;
                $contactData['tfdn_oname'] = $_POST['tfdn_oname'];
                }
            if($_POST['tfdn_cname']!='')
            {
                $count++;
                $contactData['tfdn_cname'] = $_POST['tfdn_cname'];
                }
            if($_POST['tfdn_dob']!='')
            {
                $count++;
                $contactData['tfdn_dob'] = $_POST['tfdn_dob'];
                }
            if($_POST['tfdn_address']!='')
            {
                $count++;
                $contactData['tfdn_address'] = $_POST['tfdn_address'];
                }
            if($_POST['tfdn_suburb']!='')
            {
                $count++;
                $contactData['tfdn_suburb'] = $_POST['tfdn_suburb'];
                }
            if($_POST['tfdn_state']!='')
            {
                $count++;
                $contactData['tfdn_state'] = $_POST['tfdn_state'];
                }
            if($_POST['tfdn_postcode']!='')
            {
                $count++;
                $contactData['tfdn_postcode'] = $_POST['tfdn_postcode'];
                }
            if($_POST['tfdn_paid']!='')
            {
                $count++;
                $contactData['tfdn_paid'] = $_POST['tfdn_paid'];
                }
            if($_POST['tfdn_australian_resident']!='')
            {
                $count++;
                $contactData['tfdn_australian_resident'] = $_POST['tfdn_australian_resident'];
                }
            if($_POST['tfdn_claim_tax']!='')
            {
                $count++;
                $contactData['tfdn_claim_tax'] = $_POST['tfdn_claim_tax'];
                }
            if($_POST['tfdn_pensioners_tax']!='')
            {
                $count++;
                $contactData['tfdn_pensioners_tax'] = $_POST['tfdn_pensioners_tax'];
                }
            if($_POST['tfdn_claim_zone']!='')
            {
                $count++;
                $contactData['tfdn_claim_zone'] = $_POST['tfdn_claim_zone'];
                }
            if($_POST['tfdn_he_loan']!='')
            {
                $count++;
                $contactData['tfdn_he_loan'] = $_POST['tfdn_he_loan'];
                }
            if($_POST['tfdn_fnancial_supplement_debt']!='')
            {
                $count++;
                $contactData['tfdn_fnancial_supplement_debt'] = $_POST['tfdn_fnancial_supplement_debt'];
                }
            if($_POST['tfdn_date']!='')
            {
                $count++;
                $contactData['tfdn_date'] = $_POST['tfdn_date'];
                }
            if($_POST['p_abn']!='')
            {
                $count++;
                $contactData['p_abn'] = $_POST['p_abn'];
                }
            if($_POST['p_branchno']!='')
            {
                $count++;
                $contactData['p_branchno'] = $_POST['p_branchno'];
                }
            if($_POST['p_lname']!='')
            {
                $count++;
                $contactData['p_lname'] = $_POST['p_lname'];
                }
            if($_POST['p_address']!='')
            {
                $count++;
                $contactData['p_address'] = $_POST['p_address'];
                }
            if($_POST['p_suburb']!='')
            {
                $count++;
                $contactData['p_suburb'] = $_POST['p_suburb'];
                }
            if($_POST['p_state']!='')
            {
                $count++;
                $contactData['p_state'] = $_POST['p_state'];
                }
            if($_POST['p_postcode']!='')
            {
                $count++;
                $contactData['p_postcode'] = $_POST['p_postcode'];
                }
            if($_POST['p_contact_person']!='')
            {
                $count++;
                $contactData['p_contact_person'] = $_POST['p_contact_person'];
                }
            if($_POST['p_nolonger_payee']!='')
            {
                $count++;
                $contactData['p_nolonger_payee'] = $_POST['p_nolonger_payee'];
                }
            if($_POST['amr_sname']!='')
            {
                $count++;
                $contactData['amr_sname'] = $_POST['amr_sname'];
                }
            if($_POST['amr_fname']!='')
            {
                $count++;
                $contactData['amr_fname'] = $_POST['amr_fname'];
                }
            if($_POST['amr_dob']!='')
            {
                $count++;
                $contactData['amr_dob'] = $_POST['amr_dob'];
                }
            if($_POST['amr_telephone']!='')
            {
                $count++;
                $contactData['amr_telephone'] = $_POST['amr_telephone'];
                }
            if($_POST['amr_address']!='')
            {
                $count++;
                $contactData['amr_address'] = $_POST['amr_address'];
            }
            if($_POST['amr_subrub']!='')
            {
                $count++;
                $contactData['amr_subrub'] = $_POST['amr_subrub'];
                }
            if($_POST['amr_position']!='')
            {
                $count++;
                $contactData['amr_position'] = $_POST['amr_position'];
              }
            if($_POST['amr_employer']!='')
            {
                $count++;
                $contactData['amr_employer'] = $_POST['amr_employer'];
              }
            if($_POST['amr_illness']!='')
            {
                $count++;
                $contactData['amr_illness'] = $_POST['amr_illness'];
              }
            if($_POST['amr_illness_detail']!='')
            {
                $count++;
                $contactData['amr_illness_detail'] = $_POST['amr_illness_detail'];
              }
            if($_POST['amr_medications']!='')
            {
                $count++;
                $contactData['amr_medications'] = $_POST['amr_medications'];
              }
            if($_POST['amr_medications_detail']!='')
            {
                $count++;
                $contactData['amr_medications_detail'] = $_POST['amr_medications_detail'];
              }
            if($_POST['amr_allergic']!='')
            {
                $count++;
                $contactData['amr_allergic'] = $_POST['amr_allergic'];
              }
            if($_POST['amr_allergic_detail']!='')
            {
                $count++;
                $contactData['amr_allergic_detail'] = $_POST['amr_allergic_detail'];
              }
            if($_POST['amr_child_birth']!='')
            {
                $count++;
                $contactData['amr_child_birth'] = $_POST['amr_child_birth'];
              }
            if($_POST['amr_child_birth_detail']!='')
            {
                $count++;
                $contactData['amr_child_birth_detail'] = $_POST['amr_child_birth_detail'];
              }
            if($_POST['amr_fractured']!='')
            {
                $count++;
                $contactData['amr_fractured'] = $_POST['amr_fractured'];
              }
            if($_POST['amr_fractured_detail']!='')
            {
                $count++;
                $contactData['amr_fractured_detail'] = $_POST['amr_fractured_detail'];
            }
            if($_POST['amr_spinal']!='')
            {
                $count++;
                $contactData['amr_spinal'] = $_POST['amr_spinal'];
              }
            if($_POST['amr_spinal_detail']!='')
            {
                $count++;
                $contactData['amr_spinal_detail'] = $_POST['amr_spinal_detail'];
              }
            if($_POST['amr_hearing']!='')
            {
                $count++;
                $contactData['amr_hearing'] = $_POST['amr_hearing'];
              }
            if($_POST['amr_hearing_detail']!='')
            {
                $count++;
                $contactData['amr_hearing_detail'] = $_POST['amr_hearing_detail'];
              }
            if($_POST['amr_sunglasses']!='')
            {
                $count++;
                $contactData['amr_sunglasses'] = $_POST['amr_sunglasses'];
              }
            if($_POST['amr_sunglasses_detail']!='')
            {
                $count++;
                $contactData['amr_sunglasses_detail'] = $_POST['amr_sunglasses_detail'];
              }
            if($_POST['amr_diabetes']!='')
            {
                $count++;
                $contactData['amr_diabetes'] = $_POST['amr_diabetes'];
              }
            if($_POST['amr_diabetes_detail']!='')
            {
                $count++;
                $contactData['amr_diabetes_detail'] = $_POST['amr_diabetes_detail'];
              }
            if($_POST['amr_blood_pressure']!='')
            {
                $count++;
                $contactData['amr_blood_pressure'] = $_POST['amr_blood_pressure'];
              }
            if($_POST['amr_blood_pressure_detail']!='')
            {
                $count++;
                $contactData['amr_blood_pressure_detail'] = $_POST['amr_blood_pressure_detail'];
              }
            if($_POST['amr_blackouts']!='')
            {
                $count++;
                $contactData['amr_blackouts'] = $_POST['amr_blackouts'];
              }
            if($_POST['amr_blackouts_detail']!='')
            {
                $count++;
                $contactData['amr_blackouts_detail'] = $_POST['amr_blackouts_detail'];
              }
            if($_POST['amr_off_work']!='')
            {
                $count++;
                $contactData['amr_off_work'] = $_POST['amr_off_work'];
              }
            if($_POST['amr_off_work_detail']!='')
            {
                $count++;
                $contactData['amr_off_work_detail'] = $_POST['amr_off_work_detail'];
              }
            if($_POST['amr_hernia']!='')
            {
                $count++;
                $contactData['amr_hernia'] = $_POST['amr_hernia'];
              }
            if($_POST['amr_hernia_detail']!='')
            {
                $count++;
                $contactData['amr_hernia_detail'] = $_POST['amr_hernia_detail'];
              }
            if($_POST['amr_toxic']!='')
            {
                $count++;
                $contactData['amr_toxic'] = $_POST['amr_toxic'];
              }
            if($_POST['amr_toxic_detail']!='')
            {
                $count++;
                $contactData['amr_toxic_detail'] = $_POST['amr_toxic_detail'];
              }
            if($_POST['amr_overuse_syndrome']!='')
            {
                $count++;
                $contactData['amr_overuse_syndrome'] = $_POST['amr_overuse_syndrome'];
              }
            if($_POST['amr_overuse_syndrome_detail']!='')
            {
                $count++;
                $contactData['amr_overuse_syndrome_detail'] = $_POST['amr_overuse_syndrome_detail'];
              }
            if($_POST['amr_ability_to_perform']!='')
            {
                $count++;
                $contactData['amr_ability_to_perform'] = $_POST['amr_ability_to_perform'];
              }
            if($_POST['amr_ability_to_perform_detail']!='')
            {
                $count++;
                $contactData['amr_ability_to_perform_detail'] = $_POST['amr_ability_to_perform_detail'];
              }
            if($_POST['amr_name']!='')
            {
                $count++;
                $contactData['amr_name'] = $_POST['amr_name'];
              }
            if($_POST['amr_date']!='')
            {
                $count++;
                $contactData['amr_date'] = $_POST['amr_date'];
              }
            if($_POST['cacc_name']!='')
            {
                $count++;
                $contactData['cacc_name'] = $_POST['cacc_name'];
              }
            if($_POST['cacc_edate']!='')
            {
                $count++;
                $contactData['cacc_edate'] = $_POST['cacc_edate'];
             }
            if($_POST['cacc_mdate']!='')
            {
                $count++;
                $contactData['cacc_mdate'] = $_POST['cacc_mdate'];
              }
            if($_POST['icec_name']!='')
            {
                $count++;
                $contactData['icec_name'] = $_POST['icec_name'];
              }
            if($_POST['icec_caribg']!='')
            {
                $count++;
                $contactData['icec_caribg'] = $_POST['icec_caribg'];
              }
            if($_POST['casca_name']!='')
            {
                $count++;
                $contactData['casca_name'] = $_POST['casca_name'];
              }
            if($_POST['casca_name2']!='')
            {
                $count++;
                $contactData['casca_name2'] = $_POST['casca_name2'];
              }
            if($_POST['casca_date']!='')
            {
                $count++;
                $contactData['casca_date'] = $_POST['casca_date'];
              }
            if($_POST['tfdn_sname']!='')
            {
                $count++;
                $contactData['tfdn_sname'] = $_POST['tfdn_sname'];
              }
            if($_POST['p_isabn']!='')
            {
                $count++;
                $contactData['p_isabn'] = $_POST['p_isabn'];
              }
            if($_POST['p_bphone_number']!='')
            {
                $count++;
                $contactData['p_bphone_number'] = $_POST['p_bphone_number'];
              }
            if($_POST['p_date']!='')
            {
                $count++;
                $contactData['p_date'] = $_POST['p_date'];
              }
            if($_POST['amr_requirement']!='')
            {
                $count++;
                $contactData['amr_requirement'] = $_POST['amr_requirement'];
              }
            if($_POST['amr_requirement_value']!='')
            {
                $count++;
                $contactData['amr_requirement_value'] = $_POST['amr_requirement_value'];
            }
            if($_POST['icec_date']!='')
            {
                $count++;
                $contactData['icec_date'] = $_POST['icec_date'];
            }
            if($_POST['employee_id']!='')
            {
                $count++;
                $contactData['employee_id'] = $_POST['employee_id'];
            }

            if($_POST['id']!='')
            {
                

                if($_POST['amr_sign_base']!='' && $_FILES['amr_sign']['name']=='')
                {
                    $count++;
                    $contactData['amr_sign_base'] = $_POST['amr_sign_base'];
                    $contactData['amr_sign'] = '';
                }
                if($_POST['amr_sign_base']=='' && $_FILES['amr_sign']['name']!='')
                {
                    $count++;
                    $contactData['amr_sign_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'employee_form', 'amr_sign');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'amr_sign', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'amr_sign'))->row('file_name');

                    $contactData['amr_sign'] = base_url().'uploads/employee_form/'.$_POST['id'].'/'.$filename;

                }
                // 
                
                if($_POST['icec_sign_base']!='' && $_FILES['icec_sign']['name']=='')
                {
                    $count++;
                    $contactData['icec_sign_base'] = $_POST['icec_sign_base'];
                    $contactData['icec_sign'] = '';
                }
                if($_POST['icec_sign_base']=='' && $_FILES['icec_sign']['name']!='')
                {
                    $count++;
                    $contactData['icec_sign_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'employee_form', 'icec_sign');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'icec_sign', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'icec_sign'))->row('file_name');

                    $contactData['icec_sign'] = base_url().'uploads/employee_form/'.$_POST['id'].'/'.$filename;

                }
                // 
                if($_POST['efw_signature_base']!='' && $_FILES['efw_signature']['name']=='')
                {
                    $count++;
                    $contactData['efw_signature_base'] = $_POST['efw_signature_base'];
                    $contactData['efw_signature'] = '';
                }
                if($_POST['efw_signature_base']=='' && $_FILES['efw_signature']['name']!='')
                {
                    $count++;
                    $contactData['efw_signature_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'employee_form', 'efw_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'efw_signature', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'efw_signature'))->row('file_name');

                    $contactData['efw_signature'] = base_url().'uploads/employee_form/'.$_POST['id'].'/'.$filename;

                }
                // 
                if($_POST['mppc_signature_base']!='' && $_FILES['mppc_signature']['name']=='')
                {
                    $count++;
                    $contactData['mppc_signature_base'] = $_POST['mppc_signature_base'];
                    $contactData['mppc_signature'] = '';
                }
                if($_POST['mppc_signature_base']=='' && $_FILES['mppc_signature']['name']!='')
                {
                    $count++;
                    $contactData['mppc_signature_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'employee_form', 'mppc_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'mppc_signature', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'mppc_signature'))->row('file_name');

                    $contactData['mppc_signature'] = base_url().'uploads/employee_form/'.$_POST['id'].'/'.$filename;

                }
                if($_POST['ed_signature_base']!='' && $_FILES['ed_signature']['name']=='')
                {
                    $count++;
                    $contactData['ed_signature_base'] = $_POST['ed_signature_base'];
                    $contactData['ed_signature'] = '';
                }
                if($_POST['ed_signature_base']=='' && $_FILES['ed_signature']['name']!='')
                {
                    $count++;
                    $contactData['ed_signature_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'employee_form', 'ed_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'ed_signature', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'ed_signature'))->row('file_name');

                    $contactData['ed_signature'] = base_url().'uploads/employee_form/'.$_POST['id'].'/'.$filename;

                }
                if($_POST['id_signature_base']!='' && $_FILES['id_signature']['name']=='')
                {
                    $count++;
                    $contactData['id_signature_base'] = $_POST['id_signature_base'];
                    $contactData['id_signature'] = '';
                }
                if($_POST['id_signature_base']=='' && $_FILES['id_signature']['name']!='')
                {
                    $count++;
                    $contactData['id_signature_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'employee_form', 'id_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'id_signature', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'id_signature'))->row('file_name');

                    $contactData['id_signature'] = base_url().'uploads/employee_form/'.$_POST['id'].'/'.$filename;

                }
                if($_POST['id_wb_signature_base']!='' && $_FILES['id_wb_signature']['name']=='')
                {
                    $count++;
                    $contactData['id_wb_signature_base'] = $_POST['id_wb_signature_base'];
                    $contactData['id_wb_signature'] = '';
                }
                if($_POST['id_wb_signature_base']=='' && $_FILES['id_wb_signature']['name']!='')
                {
                    $count++;
                    $contactData['id_wb_signature_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'employee_form', 'id_wb_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'id_wb_signature', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'id_wb_signature'))->row('file_name');

                    $contactData['id_wb_signature'] = base_url().'uploads/employee_form/'.$_POST['id'].'/'.$filename;

                }
                if($_POST['dic_signature_base']!='' && $_FILES['dic_signature']['name']=='')
                {
                    $count++;
                    $contactData['dic_signature_base'] = $_POST['dic_signature_base'];
                    $contactData['dic_signature'] = '';
                }
                if($_POST['dic_signature_base']=='' && $_FILES['dic_signature']['name']!='')
                {
                    $count++;
                    $contactData['dic_signature_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'employee_form', 'dic_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'dic_signature', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'dic_signature'))->row('file_name');

                    $contactData['dic_signature'] = base_url().'uploads/employee_form/'.$_POST['id'].'/'.$filename;

                }

                if($_POST['saf_signature_base']!='' && $_FILES['saf_signature']['name']=='')
                {
                    $count++;
                    $contactData['saf_signature_base'] = $_POST['saf_signature_base'];
                    $contactData['saf_signature'] = '';
                }
                if($_POST['saf_signature_base']=='' && $_FILES['saf_signature']['name']!='')
                {
                    $count++;
                    $contactData['saf_signature_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'employee_form', 'saf_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'saf_signature', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'saf_signature'))->row('file_name');

                    $contactData['saf_signature'] = base_url().'uploads/employee_form/'.$_POST['id'].'/'.$filename;

                }

                if($_POST['tfdn_signature_base']!='' && $_FILES['tfdn_signature']['name']=='')
                {
                    $count++;
                    $contactData['tfdn_signature_base'] = $_POST['tfdn_signature_base'];
                    $contactData['tfdn_signature'] = '';
                }
                if($_POST['tfdn_signature_base']=='' && $_FILES['tfdn_signature']['name']!='')
                {
                    $count++;
                    $contactData['tfdn_signature_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'employee_form', 'tfdn_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'tfdn_signature', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'tfdn_signature'))->row('file_name');

                    $contactData['tfdn_signature'] = base_url().'uploads/employee_form/'.$_POST['id'].'/'.$filename;

                }

                if($_POST['casca_signature_base']!='' && $_FILES['casca_signature']['name']=='')
                {
                    $count++;
                    $contactData['casca_signature_base'] = $_POST['casca_signature_base'];
                    $contactData['casca_signature'] = '';
                }
                if($_POST['casca_signature_base']=='' && $_FILES['casca_signature']['name']!='')
                {
                    $count++;
                    $contactData['casca_signature_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'employee_form', 'casca_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'casca_signature', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'casca_signature'))->row('file_name');

                    $contactData['casca_signature'] = base_url().'uploads/employee_form/'.$_POST['id'].'/'.$filename;

                }

                if($_POST['c_wit_signature_base']!='' && $_FILES['c_wit_signature']['name']=='')
                {
                    $count++;
                    $contactData['c_wit_signature_base'] = $_POST['c_wit_signature_base'];
                    $contactData['c_wit_signature'] = '';
                }
                if($_POST['c_wit_signature_base']=='' && $_FILES['c_wit_signature']['name']!='')
                {
                    $count++;
                    $contactData['c_wit_signature_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'employee_form', 'c_wit_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'c_wit_signature', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'c_wit_signature'))->row('file_name');

                    $contactData['c_wit_signature'] = base_url().'uploads/employee_form/'.$_POST['id'].'/'.$filename;

                }
                if($_POST['c_emp_signature_base']!='' && $_FILES['c_emp_signature']['name']=='')
                {
                    $count++;
                    $contactData['c_emp_signature_base'] = $_POST['c_emp_signature_base'];
                    $contactData['c_emp_signature'] = '';
                }
                if($_POST['c_emp_signature_base']=='' && $_FILES['c_emp_signature']['name']!='')
                {
                    $count++;
                    $contactData['c_emp_signature_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'employee_form', 'c_emp_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'c_emp_signature', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'c_emp_signature'))->row('file_name');

                    $contactData['c_emp_signature'] = base_url().'uploads/employee_form/'.$_POST['id'].'/'.$filename;

                }
                if($_POST['eic_signature_base']!='' && $_FILES['eic_signature']['name']=='')
                {
                    $count++;
                    $contactData['eic_signature_base'] = $_POST['eic_signature_base'];
                    $contactData['eic_signature'] = '';
                }
                if($_POST['eic_signature_base']=='' && $_FILES['eic_signature']['name']!='')
                {
                    $count++;
                    $contactData['eic_signature_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'employee_form', 'eic_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'eic_signature', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'eic_signature'))->row('file_name');

                    $contactData['eic_signature'] = base_url().'uploads/employee_form/'.$_POST['id'].'/'.$filename;

                }
                if($_POST['cacc_esignature_base']!='' && $_FILES['cacc_esignature']['name']=='')
                {
                    $count++;
                    $contactData['cacc_esignature_base'] = $_POST['cacc_esignature_base'];
                    $contactData['cacc_esignature'] = '';
                }
                if($_POST['cacc_esignature_base']=='' && $_FILES['cacc_esignature']['name']!='')
                {
                    $count++;
                    $contactData['cacc_esignature_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'employee_form', 'cacc_esignature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'cacc_esignature', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'cacc_esignature'))->row('file_name');

                    $contactData['cacc_esignature'] = base_url().'uploads/employee_form/'.$_POST['id'].'/'.$filename;

                }
                if($_POST['cacc_msignature_base']!='' && $_FILES['cacc_msignature']['name']=='')
                {
                    $count++;
                    $contactData['cacc_msignature_base'] = $_POST['cacc_msignature_base'];
                    $contactData['cacc_msignature'] = '';
                }
                if($_POST['cacc_msignature_base']=='' && $_FILES['cacc_msignature']['name']!='')
                {
                    $count++;
                    $contactData['cacc_msignature_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'employee_form', 'cacc_msignature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'cacc_msignature', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'cacc_msignature'))->row('file_name');

                    $contactData['cacc_msignature'] = base_url().'uploads/employee_form/'.$_POST['id'].'/'.$filename;

                }
                if($_POST['p_signature_base']!='' && $_FILES['p_signature']['name']=='')
                {
                    $count++;
                    $contactData['p_signature_base'] = $_POST['p_signature_base'];
                    $contactData['p_signature'] = '';
                }
                if($_POST['p_signature_base']=='' && $_FILES['p_signature']['name']!='')
                {
                    $count++;
                    $contactData['p_signature_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'employee_form', 'p_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'p_signature', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'p_signature'))->row('file_name');

                    $contactData['p_signature'] = base_url().'uploads/employee_form/'.$_POST['id'].'/'.$filename;

                }

                $count++;
                $count++;
                $contactData['updated_date'] = date('Y-m-d H:i:s');
                $contactData['added_by'] = 'Employee';
                // echo $_POST['id'];
                // print_r($contactData);die;
                $this->db->where('userid', $userid);
                $this->db->where('id', $_POST['id']);
                $this->db->update(db_prefix().'employee', $contactData);
                if($_POST['id'])
                {
                    $totalCol = $this->db->get_where(db_prefix().'employee')->num_fields();
                    $counttot = $count/$totalCol;
                    $mulcol = $counttot * 100;
                    $finalmulcol = round($mulcol,2);

                    $this->db->where('userid', $userid);
                    $this->db->update(db_prefix() . 'contacts', [
                        'employee_date' => date('Y-m-d H:i:s'),
                        'employee_form' => $finalmulcol,
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
                $count++;
                $count++;
                $contactData['created_date'] = date('Y-m-d H:i:s');
                $contactData['updated_date'] = date('Y-m-d H:i:s');
                $contactData['added_by'] = 'Employee';
                $check = $this->db->get_where(db_prefix().'employee',array('userid' => $userid))->row();
                if(count($check)==0)
                {
                    $this->db->insert(db_prefix().'employee', $contactData);
                    $lid = $this->db->insert_id();
                    if($lid)
                    {
                        if($_POST['amr_sign_base']!=''  && $_FILES['amr_sign']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['amr_sign_base'] = $_POST['amr_sign_base'];
                            $contactDataIMG['amr_sign'] = '';
                        }
                        if($_POST['amr_sign_base']==''  && $_FILES['amr_sign']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['amr_sign_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'employee_form', 'amr_sign');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'amr_sign', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'amr_sign'))->row('file_name');

                            $contactDataIMG['amr_sign'] = base_url().'uploads/employee_form/'.$lid.'/'.$filename;

                        }
                        if($_POST['icec_sign_base']!=''  && $_FILES['icec_sign']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['icec_sign_base'] = $_POST['icec_sign_base'];
                            $contactDataIMG['icec_sign'] = '';
                        }
                        if($_POST['icec_sign_base']==''  && $_FILES['icec_sign']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['icec_sign_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'employee_form', 'icec_sign');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'icec_sign', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'icec_sign'))->row('file_name');

                            $contactDataIMG['icec_sign'] = base_url().'uploads/employee_form/'.$lid.'/'.$filename;

                        }
                        if($_POST['efw_signature_base']!=''  && $_FILES['efw_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['efw_signature_base'] = $_POST['efw_signature_base'];
                            $contactDataIMG['efw_signature'] = '';
                        }
                        if($_POST['efw_signature_base']==''  && $_FILES['efw_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['efw_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'employee_form', 'efw_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'efw_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'efw_signature'))->row('file_name');

                            $contactDataIMG['efw_signature'] = base_url().'uploads/employee_form/'.$lid.'/'.$filename;

                        }
                        if($_POST['mppc_signature_base']!=''  && $_FILES['mppc_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['mppc_signature_base'] = $_POST['mppc_signature_base'];
                            $contactDataIMG['mppc_signature'] = '';
                        }
                        if($_POST['mppc_signature_base']==''  && $_FILES['mppc_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['mppc_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'employee_form', 'mppc_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'mppc_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'mppc_signature'))->row('file_name');

                            $contactDataIMG['mppc_signature'] = base_url().'uploads/employee_form/'.$lid.'/'.$filename;

                        }
                        if($_POST['ed_signature_base']!=''  && $_FILES['ed_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['ed_signature_base'] = $_POST['ed_signature_base'];
                            $contactDataIMG['ed_signature'] = '';
                        }
                        if($_POST['ed_signature_base']==''  && $_FILES['ed_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['ed_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'employee_form', 'ed_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'ed_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'ed_signature'))->row('file_name');

                            $contactDataIMG['ed_signature'] = base_url().'uploads/employee_form/'.$lid.'/'.$filename;

                        }
                        if($_POST['id_signature_base']!=''  && $_FILES['id_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['id_signature_base'] = $_POST['id_signature_base'];
                            $contactDataIMG['id_signature'] = '';
                        }
                        if($_POST['id_signature_base']==''  && $_FILES['id_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['id_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'employee_form', 'id_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'id_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'id_signature'))->row('file_name');

                            $contactDataIMG['id_signature'] = base_url().'uploads/employee_form/'.$lid.'/'.$filename;

                        }
                        if($_POST['id_wb_signature_base']!=''  && $_FILES['id_wb_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['id_wb_signature_base'] = $_POST['id_wb_signature_base'];
                            $contactDataIMG['id_wb_signature'] = '';
                        }
                        if($_POST['id_wb_signature_base']==''  && $_FILES['id_wb_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['id_wb_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'employee_form', 'id_wb_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'id_wb_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'id_wb_signature'))->row('file_name');

                            $contactDataIMG['id_wb_signature'] = base_url().'uploads/employee_form/'.$lid.'/'.$filename;

                        }

                        if($_POST['dic_signature_base']!=''  && $_FILES['dic_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['dic_signature_base'] = $_POST['dic_signature_base'];
                            $contactDataIMG['dic_signature'] = '';
                        }
                        if($_POST['dic_signature_base']==''  && $_FILES['dic_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['dic_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'employee_form', 'dic_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'dic_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'dic_signature'))->row('file_name');

                            $contactDataIMG['dic_signature'] = base_url().'uploads/employee_form/'.$lid.'/'.$filename;

                        }

                        if($_POST['saf_signature_base']!=''  && $_FILES['saf_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['saf_signature_base'] = $_POST['saf_signature_base'];
                            $contactDataIMG['saf_signature'] = '';
                        }
                        if($_POST['saf_signature_base']==''  && $_FILES['saf_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['saf_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'employee_form', 'saf_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'saf_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'saf_signature'))->row('file_name');

                            $contactDataIMG['saf_signature'] = base_url().'uploads/employee_form/'.$lid.'/'.$filename;

                        }

                        if($_POST['tfdn_signature_base']!=''  && $_FILES['tfdn_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['tfdn_signature_base'] = $_POST['tfdn_signature_base'];
                            $contactDataIMG['tfdn_signature'] = '';
                        }
                        if($_POST['tfdn_signature_base']==''  && $_FILES['tfdn_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['tfdn_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'employee_form', 'tfdn_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'tfdn_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'tfdn_signature'))->row('file_name');

                            $contactDataIMG['tfdn_signature'] = base_url().'uploads/employee_form/'.$lid.'/'.$filename;

                        }

                        if($_POST['casca_signature_base']!=''  && $_FILES['casca_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['casca_signature_base'] = $_POST['casca_signature_base'];
                            $contactDataIMG['casca_signature'] = '';
                        }
                        if($_POST['casca_signature_base']==''  && $_FILES['casca_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['casca_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'employee_form', 'casca_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'casca_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'casca_signature'))->row('file_name');

                            $contactDataIMG['casca_signature'] = base_url().'uploads/employee_form/'.$lid.'/'.$filename;

                        }

                        if($_POST['c_wit_signature_base']!=''  && $_FILES['c_wit_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['c_wit_signature_base'] = $_POST['c_wit_signature_base'];
                            $contactDataIMG['c_wit_signature'] = '';
                        }
                        if($_POST['c_wit_signature_base']==''  && $_FILES['c_wit_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['c_wit_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'employee_form', 'c_wit_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'c_wit_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'c_wit_signature'))->row('file_name');

                            $contactDataIMG['c_wit_signature'] = base_url().'uploads/employee_form/'.$lid.'/'.$filename;

                        }

                        if($_POST['c_emp_signature_base']!=''  && $_FILES['c_emp_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['c_emp_signature_base'] = $_POST['c_emp_signature_base'];
                            $contactDataIMG['c_emp_signature'] = '';
                        }
                        if($_POST['c_emp_signature_base']==''  && $_FILES['c_emp_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['c_emp_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'employee_form', 'c_emp_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'c_emp_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'c_emp_signature'))->row('file_name');

                            $contactDataIMG['c_emp_signature'] = base_url().'uploads/employee_form/'.$lid.'/'.$filename;

                        }

                        if($_POST['eic_signature_base']!=''  && $_FILES['eic_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['eic_signature_base'] = $_POST['eic_signature_base'];
                            $contactDataIMG['eic_signature'] = '';
                        }
                        if($_POST['eic_signature_base']==''  && $_FILES['eic_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['eic_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'employee_form', 'eic_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'eic_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'eic_signature'))->row('file_name');

                            $contactDataIMG['eic_signature'] = base_url().'uploads/employee_form/'.$lid.'/'.$filename;

                        }

                        if($_POST['cacc_esignature_base']!=''  && $_FILES['cacc_esignature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['cacc_esignature_base'] = $_POST['cacc_esignature_base'];
                            $contactDataIMG['cacc_esignature'] = '';
                        }
                        if($_POST['cacc_esignature_base']==''  && $_FILES['cacc_esignature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['cacc_esignature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'employee_form', 'cacc_esignature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'cacc_esignature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'cacc_esignature'))->row('file_name');

                            $contactDataIMG['cacc_esignature'] = base_url().'uploads/employee_form/'.$lid.'/'.$filename;

                        }

                        if($_POST['cacc_msignature_base']!=''  && $_FILES['cacc_msignature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['cacc_msignature_base'] = $_POST['cacc_msignature_base'];
                            $contactDataIMG['cacc_msignature'] = '';
                        }
                        if($_POST['cacc_msignature_base']==''  && $_FILES['cacc_msignature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['cacc_msignature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'employee_form', 'cacc_msignature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'cacc_msignature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'cacc_msignature'))->row('file_name');

                            $contactDataIMG['cacc_msignature'] = base_url().'uploads/employee_form/'.$lid.'/'.$filename;

                        }

                        if($_POST['p_signature_base']!=''  && $_FILES['p_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['p_signature_base'] = $_POST['p_signature_base'];
                            $contactDataIMG['p_signature'] = '';
                        }
                        if($_POST['p_signature_base']==''  && $_FILES['p_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['p_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'employee_form', 'p_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'p_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'p_signature'))->row('file_name');

                            $contactDataIMG['p_signature'] = base_url().'uploads/employee_form/'.$lid.'/'.$filename;

                        }
                        if(count($_FILES['fileUpload']['name']) > 0){
                            $uploadedFiles = handle_file_upload($_POST['id'],'employee_form', 'emp_document');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                print_r($file);
                                    $this->misc_model->add_attachment_to_database($_POST['id'], 'emp_document', [$file]);
                                }
                            }
                        }    

                        $this->db->where('userid', $userid);
                        $this->db->where('id', $lid);
                        $this->db->update(db_prefix().'employee', $contactDataIMG);

                        $totalCol = $this->db->get_where(db_prefix().'employee')->num_fields();
                        $counttot = $count/$totalCol;
                        $mulcol = $counttot * 100;
                        $finalmulcol = round($mulcol,2);

                        $this->db->where('userid', $userid);
                        $this->db->update(db_prefix() . 'contacts', [
                            'employee_date' => date('Y-m-d H:i:s'),
                            'employee_form' => $finalmulcol,
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

    public function getEmployeeForm()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $userid = $this->user_data->userid;

        $success = $this->db->get_where(db_prefix().'employee',array('userid' =>$userid));
        
        if($success->num_rows() > 0)
        {   
            $success  = $success->result();
            foreach ($success as $value) 
            {
                $value->cur_women =json_decode($value->cur_women, true);                
                $value->cur_wquantity =json_decode($value->cur_wquantity, true);  
                $value->cur_men =json_decode($value->cur_men, true);  
                $value->cur_mquantity =json_decode($value->cur_mquantity, true);  
                $value->saf_w1_saturday =json_decode($value->saf_w1_saturday, true);  
                $value->saf_w1_sunday =json_decode($value->saf_w1_sunday, true);  
                $value->saf_w1_monday =json_decode($value->saf_w1_monday, true);  
                $value->saf_w1_tuesday =json_decode($value->saf_w1_tuesday, true);  
                $value->saf_w1_wendesday =json_decode($value->saf_w1_wendesday, true);  
                $value->saf_w1_thursday =json_decode($value->saf_w1_thursday, true);  
                $value->saf_w1_friday =json_decode($value->saf_w1_friday, true);  
                $value->saf_w2_saturday =json_decode($value->saf_w2_saturday, true);  
                $value->saf_w2_sunday =json_decode($value->saf_w2_sunday, true);  
                $value->saf_w2_monday =json_decode($value->saf_w2_monday, true);  
                $value->saf_w2_tuesday =json_decode($value->saf_w2_tuesday, true);  
                $value->saf_w2_wendesday =json_decode($value->saf_w2_wendesday, true);  
                $value->saf_w2_thursday =json_decode($value->saf_w2_thursday, true);  
                $value->saf_w2_friday =json_decode($value->saf_w2_friday, true);  
                $value->employee_id =json_decode($value->employee_id, true); 
                $value->superannuation_fund =json_decode($value->superannuation_fund, true); 

                $employee_date = $this->db->select('police_start_date,police_end_date,wwcc_start_date,wwcc_end_date,firstaid_start_date,firstaid_end_date')->get_where(db_prefix().'contacts',array('userid' =>$userid))->row();
                
                $value->police_start_date =   $employee_date->police_start_date;  
                $value->police_end_date =   $employee_date->police_end_date;  
                $value->wwcc_start_date =   $employee_date->wwcc_start_date;  
                $value->wwcc_end_date =   $employee_date->wwcc_end_date;  
                $value->firstaid_start_date =   $employee_date->firstaid_start_date;  
                $value->firstaid_end_date =   $employee_date->police_sfirstaid_end_datetart_date;  

                    unset($value->userid);
                    unset($value->updated_date);
                    unset($value->created_date);                           
              
            }

            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $success);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
        }
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    /*-------------------------------------------------------------------
    *@function Transport booking
    *-------------------------------------------------------------------*/
    public function addReportIncident()
    {
        // echo'if';die;
        $userid = $this->user_data->userid;
        
        if($userid!='' )
        {
            $count=0;
            if($userid!='')
            {
                $count++;
                $contactData['userid'] = $userid;
            }
            if($_POST['client_id']!='' && $_POST['client_id']!=null)
            {
                $count++;
                $contactData['client_id'] = $_POST['client_id'];
            }
            if($_POST['report_for']!='' && $_POST['report_for']!=null)
            {
                $count++;
                $contactData['report_for'] = $_POST['report_for'];
            }
            if($_POST['pc_name']!='' && $_POST['pc_name']!=null)
            {
              $count++;
              $contactData['pc_name'] = $_POST['pc_name'];
            }
            if($_POST['pc_phone']!='' && $_POST['pc_phone']!=null)
            {
              $count++;
              $contactData['pc_phone'] = $_POST['pc_phone'];
            }
            if($_POST['pc_mobile']!='' && $_POST['pc_mobile']!=null)
            {
              $count++;
              $contactData['pc_mobile'] = $_POST['pc_mobile'];
            }
            if($_POST['pc_email']!='' && $_POST['pc_email']!=null)
            {
              $count++;
              $contactData['pc_email'] = $_POST['pc_email'];
            }
            if($_POST['ca_worker']!='' && $_POST['ca_worker']!=null)
            {
              $count++;
              $contactData['ca_worker'] = $_POST['ca_worker'];
            }
            if($_POST['ca_worker_title']!='' && $_POST['ca_worker_title']!=null)
            {
              $count++;
              $contactData['ca_worker_title'] = $_POST['ca_worker_title'];
            }
            if($_POST['ccd_name']!='' && $_POST['ccd_name']!=null)
            {
              $count++;
              $contactData['ccd_name'] = $_POST['ccd_name'];
            }
            if($_POST['ccd_phone']!='' && $_POST['ccd_phone']!=null)
            {
              $count++;
              $contactData['ccd_phone'] = $_POST['ccd_phone'];
            }
            if($_POST['ccd_mobile']!='' && $_POST['ccd_mobile']!=null)
            {
              $count++;
              $contactData['ccd_mobile'] = $_POST['ccd_mobile'];
            }
            if($_POST['ccd_address']!='' && $_POST['ccd_address']!=null)
            {
              $count++;
              $contactData['ccd_address'] = $_POST['ccd_address'];
            }
            if($_POST['date_report_submitted']!='' && $_POST['date_report_submitted']!=null)
            {
              $count++;
              $contactData['date_report_submitted'] = $_POST['date_report_submitted'];
            }
            if($_POST['report_submitted_to']!='' && $_POST['report_submitted_to']!=null)
            {
              $count++;
              $contactData['report_submitted_to'] = $_POST['report_submitted_to'];
            }
            if($_POST['accident_location']!='' && $_POST['accident_location']!=null)
            {
              $count++;
              $contactData['accident_location'] = $_POST['accident_location'];
            }
            if($_POST['accident_date']!='' && $_POST['accident_date']!=null)
            {
              $count++;
              $contactData['accident_date'] = $_POST['accident_date'];
            }
            if($_POST['accident_time']!='' && $_POST['accident_time']!=null)
            {
              $count++;
              $contactData['accident_time'] = $_POST['accident_time'];
            }
            if($_POST['accident_address']!='' && $_POST['accident_address']!=null)
            {
              $count++;
              $contactData['accident_address'] = $_POST['accident_address'];
            }
            if($_POST['pic']!='' && $_POST['pic']!=null)
            {
              $count++;
              $contactData['pic'] = $_POST['pic'];
            }
            if($_POST['pic_name']!='' && $_POST['pic_name']!=null)
            {
              $count++;
              $contactData['pic_name'] = $_POST['pic_name'];
            }
            if($_POST['pic_contact']!='' && $_POST['pic_contact']!=null)
            {
              $count++;
              $contactData['pic_contact'] = $_POST['pic_contact'];
            }
            if($_POST['pic_address']!='' && $_POST['pic_address']!=null)
            {
              $count++;
              $contactData['pic_address'] = $_POST['pic_address'];
            }
            if($_POST['piw']!='' && $_POST['piw']!=null)
            {
              $count++;
              $contactData['piw'] = $_POST['piw'];
            }
            if($_POST['piw_name']!='' && $_POST['piw_name']!=null)
            {
              $count++;
              $contactData['piw_name'] = $_POST['piw_name'];
            }
            if($_POST['piw_contact']!='' && $_POST['piw_contact']!=null)
            {
              $count++;
              $contactData['piw_contact'] = $_POST['piw_contact'];
            }
            if($_POST['piw_address']!='' && $_POST['piw_address']!=null)
            {
              $count++;
              $contactData['piw_address'] = $_POST['piw_address'];
            }
            if($_POST['pio']!='' && $_POST['pio']!=null)
            {
              $count++;
              $contactData['pio'] = $_POST['pio'];
            }
            if($_POST['pio_name']!='' && $_POST['pio_name']!=null)
            {
              $count++;
              $contactData['pio_name'] = $_POST['pio_name'];
            }
            if($_POST['pio_contact']!='' && $_POST['pio_contact']!=null)
            {
              $count++;
              $contactData['pio_contact'] = $_POST['pio_contact'];
            }
            if($_POST['pio_address']!='' && $_POST['pio_address']!=null)
            {
              $count++;
              $contactData['pio_address'] = $_POST['pio_address'];
            }
            if($_POST['piwi']!='' && $_POST['piwi']!=null)
            {
              $count++;
              $contactData['piwi'] = $_POST['piwi'];
            }
            if($_POST['piwi_name']!='' && $_POST['piwi_name']!=null)
            {
              $count++;
              $contactData['piwi_name'] = $_POST['piwi_name'];
            }
            if($_POST['piwi_contact']!='' && $_POST['piwi_contact']!=null)
            {
              $count++;
              $contactData['piwi_contact'] = $_POST['piwi_contact'];
            }
            if($_POST['piwi_address']!='' && $_POST['piwi_address']!=null)
            {
              $count++;
              $contactData['piwi_address'] = $_POST['piwi_address'];
            }
            if($_POST['incident_details']!='' && $_POST['incident_details']!=null)
            {
              $count++;
              $contactData['incident_details'] = $_POST['incident_details'];
            }
            if($_POST['hazard_category']!='' && $_POST['hazard_category']!=null)
            {
              $count++;
              $contactData['hazard_category'] = $_POST['hazard_category'];
            }
            if($_POST['injury_occurred']!='' && $_POST['injury_occurred']!=null)
            {
              $count++;
              $contactData['injury_occurred'] = $_POST['injury_occurred'];
            }
            if($_POST['who_is_injured']!='' && $_POST['who_is_injured']!=null)
            {
              $count++;
              $contactData['who_is_injured'] = $_POST['who_is_injured'];
            }
            if($_POST['injured_body']!='' && $_POST['injured_body']!=null)
            {
              $count++;
              $contactData['injured_body'] = $_POST['injured_body'];
            }
            if($_POST['fag']!='' && $_POST['fag']!=null)
            {
              $count++;
              $contactData['fag'] = $_POST['fag'];
            }
            if($_POST['fag_time']!='' && $_POST['fag_time']!=null)
            {
              $count++;
              $contactData['fag_time'] = $_POST['fag_time'];
            }
            if($_POST['fag_description']!='' && $_POST['fag_description']!=null)
            {
              $count++;
              $contactData['fag_description'] = $_POST['fag_description'];
            }
            if($_POST['fag_by_whom']!='' && $_POST['fag_by_whom']!=null)
            {
              $count++;
              $contactData['fag_by_whom'] = $_POST['fag_by_whom'];
            }
            if($_POST['fag_referral']!='' && $_POST['fag_referral']!=null)
            {
              $count++;
              $contactData['fag_referral'] = $_POST['fag_referral'];
            }
            if($_POST['fag_specify']!='' && $_POST['fag_specify']!=null)
            {
              $count++;
              $contactData['fag_specify'] = $_POST['fag_specify'];
            }
            if($_POST['possible_solution']!='' && $_POST['possible_solution']!=null)
            {
              $count++;
              $contactData['possible_solution'] = $_POST['possible_solution'];
            }
            if($_POST['ap_action_needed']!='' && $_POST['ap_action_needed']!=null)
            {
              $count++;
              $contactData['ap_action_needed'] = $_POST['ap_action_needed'];
            }
            if($_POST['ap_by_when']!='' && $_POST['ap_by_when']!=null)
            {
              $count++;
              $contactData['ap_by_when'] = $_POST['ap_by_when'];
            }
            if($_POST['ap_by_whom']!='' && $_POST['ap_by_whom']!=null)
            {
              $count++;
              $contactData['ap_by_whom'] = $_POST['ap_by_whom'];
            }
            if($_POST['ap_review_date']!='' && $_POST['ap_review_date']!=null)
            {
              $count++;
              $contactData['ap_review_date'] = $_POST['ap_review_date'];
            }
            if($_POST['spcr_name']!='' && $_POST['spcr_name']!=null)
            {
              $count++;
              $contactData['spcr_name'] = $_POST['spcr_name'];
            }
            if($_POST['spcr_date']!='' && $_POST['spcr_date']!=null)
            {
              $count++;
              $contactData['spcr_date'] = $_POST['spcr_date'];
            }
            if($_POST['ou_date']!='' && $_POST['ou_date']!=null)
            {
              $count++;
              $contactData['ou_date'] = $_POST['ou_date'];
            }
            if($_POST['ou_by']!='' && $_POST['ou_by']!=null)
            {
              $count++;
              $contactData['ou_by'] = $_POST['ou_by'];
            }
            if($_POST['ou_job_title']!='' && $_POST['ou_job_title']!=null)
            {
              $count++;
              $contactData['ou_job_title'] = $_POST['ou_job_title'];
            }
            if($_POST['ic_action']!='' && $_POST['ic_action']!=null)
            {
              $count++;
              $contactData['ic_action'] = $_POST['ic_action'];
            }
            if($_POST['ic_date']!='' && $_POST['ic_date']!=null)
            {
              $count++;
              $contactData['ic_date'] = $_POST['ic_date'];
            }
            if($_POST['ic_report_no']!='' && $_POST['ic_report_no']!=null)
            {
              $count++;
              $contactData['ic_report_no'] = $_POST['ic_report_no'];
            }
            if($_POST['ic_comment']!='' && $_POST['ic_comment']!=null)
            {
              $count++;
              $contactData['ic_comment'] = $_POST['ic_comment'];
            }
            if($_POST['ci_action']!='' && $_POST['ci_action']!=null)
            {
              $count++;
              $contactData['ci_action'] = $_POST['ci_action'];
            }
            if($_POST['ci_date']!='' && $_POST['ci_date']!=null)
            {
              $count++;
              $contactData['ci_date'] = $_POST['ci_date'];
            }
            if($_POST['ci_report_no']!='' && $_POST['ci_report_no']!=null)
            {
              $count++;
              $contactData['ci_report_no'] = $_POST['ci_report_no'];
            }
            if($_POST['ci_comment']!='' && $_POST['ci_comment']!=null)
            {
              $count++;
              $contactData['ci_comment'] = $_POST['ci_comment'];
            }
            if($_POST['ir_action']!='' && $_POST['ir_action']!=null)
            {
              $count++;
              $contactData['ir_action'] = $_POST['ir_action'];
            }
            if($_POST['ir_date']!='' && $_POST['ir_date']!=null)
            {
              $count++;
              $contactData['ir_date'] = $_POST['ir_date'];
            }
            if($_POST['ir_report_no']!='' && $_POST['ir_report_no']!=null)
            {
              $count++;
              $contactData['ir_report_no'] = $_POST['ir_report_no'];
            }
            if($_POST['ir_comment']!='' && $_POST['ir_comment']!=null)
            {
              $count++;
              $contactData['ir_comment'] = $_POST['ir_comment'];
            }
            if($_POST['isi_action']!='' && $_POST['isi_action']!=null)
            {
              $count++;
              $contactData['isi_action'] = $_POST['isi_action'];
            }
            if($_POST['isi_date']!='' && $_POST['isi_date']!=null)
            {
              $count++;
              $contactData['isi_date'] = $_POST['isi_date'];
            }
            if($_POST['isi_report_no']!='' && $_POST['isi_report_no']!=null)
            {
              $count++;
              $contactData['isi_report_no'] = $_POST['isi_report_no'];
            }
            if($_POST['isi_comment']!='' && $_POST['isi_comment']!=null)
            {
              $count++;
              $contactData['isi_comment'] = $_POST['isi_comment'];
            }
            if($_POST['acq_action']!='' && $_POST['acq_action']!=null)
            {
              $count++;
              $contactData['acq_action'] = $_POST['acq_action'];
            }
            if($_POST['acq_date']!='' && $_POST['acq_date']!=null)
            {
              $count++;
              $contactData['acq_date'] = $_POST['acq_date'];
            }
            if($_POST['acq_report_no']!='' && $_POST['acq_report_no']!=null)
            {
              $count++;
              $contactData['acq_report_no'] = $_POST['acq_report_no'];
            }
            if($_POST['acq_comment']!='' && $_POST['acq_comment']!=null)
            {
              $count++;
              $contactData['acq_comment'] = $_POST['acq_comment'];
            }
            if($_POST['rtp_action']!='' && $_POST['rtp_action']!=null)
            {
              $count++;
              $contactData['rtp_action'] = $_POST['rtp_action'];
            }
            if($_POST['rtp_date']!='' && $_POST['rtp_date']!=null)
            {
              $count++;
              $contactData['rtp_date'] = $_POST['rtp_date'];
            }
            if($_POST['rtp_report_no']!='' && $_POST['rtp_report_no']!=null)
            {
              $count++;
              $contactData['rtp_report_no'] = $_POST['rtp_report_no'];
            }
            if($_POST['rtp_comment']!='' && $_POST['rtp_comment']!=null)
            {
              $count++;
              $contactData['rtp_comment'] = $_POST['rtp_comment'];
            }
            if($_POST['injury_claim_form']!='' && $_POST['injury_claim_form']!=null)
            {
              $count++;
              $contactData['injury_claim_form'] = $_POST['injury_claim_form'];
            }
            if($_POST['insurance_nsw_notified']!='' && $_POST['insurance_nsw_notified']!=null)
            {
              $count++;
              $contactData['insurance_nsw_notified'] = $_POST['insurance_nsw_notified'];
            }
            if($_POST['workcover_nsw_notified']!='' && $_POST['workcover_nsw_notified']!=null)
            {
              $count++;
              $contactData['workcover_nsw_notified'] = $_POST['workcover_nsw_notified'];
            }
            if($_POST['incident_comp_database']!='' && $_POST['incident_comp_database']!=null)
            {
              $count++;
              $contactData['incident_comp_database'] = $_POST['incident_comp_database'];
            }
            if($_POST['client_telephone_followup']!='' && $_POST['client_telephone_followup']!=null)
            {
              $count++;
              $contactData['client_telephone_followup'] = $_POST['client_telephone_followup'];
            }
            if($_POST['staff_telephone_followup']!='' && $_POST['staff_telephone_followup']!=null)
            {
              $count++;
              $contactData['staff_telephone_followup'] = $_POST['staff_telephone_followup'];
            }
            if($_POST['staff_investigation']!='' && $_POST['staff_investigation']!=null)
            {
              $count++;
              $contactData['staff_investigation'] = $_POST['staff_investigation'];
            }
            if($_POST['management_investigation']!='' && $_POST['management_investigation']!=null)
            {
              $count++;
              $contactData['management_investigation'] = $_POST['management_investigation'];
            }
            if($_POST['monitoring_note']!='' && $_POST['monitoring_note']!=null)
            {
              $count++;
              $contactData['monitoring_note'] = $_POST['monitoring_note'];
            }
            if($_POST['recommendations']!='' && $_POST['recommendations']!=null)
            {
              $count++;
              $contactData['recommendations'] = $_POST['recommendations'];
            }
            if($_POST['cb_name']!='' && $_POST['cb_name']!=null)
            {
              $count++;
              $contactData['cb_name'] = $_POST['cb_name'];
            }
            if($_POST['cb_position']!='' && $_POST['cb_position']!=null)
            {
              $count++;
              $contactData['cb_position'] = $_POST['cb_position'];
            }
            if($_POST['cb_date']!='' && $_POST['cb_date']!=null)
            {
              $count++;
              $contactData['cb_date'] = $_POST['cb_date'];
            }

            if($_POST['id']!='')
            {
                // echo"if";die;
                if($_POST['cb_signature_base']!='' && $_FILES['cb_signature']['name']=='')
                {
                    $count++;
                    $contactData['cb_signature_base'] = $_POST['cb_signature_base'];
                    $contactData['cb_signature'] = '';
                }
                if($_POST['cb_signature_base']=='' && $_FILES['cb_signature']['name']!='')
                {
                    $count++;
                    $contactData['cb_signature_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'report_incident', 'cb_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'cb_signature', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'cb_signature'))->row('file_name');

                    $contactData['cb_signature'] = base_url().'uploads/report_incident/'.$_POST['id'].'/'.$filename;

                }
                if($_POST['spcr_signature_base']!='' && $_FILES['spcr_signature']['name']=='')
                {
                    $count++;
                    $contactData['spcr_signature_base'] = $_POST['spcr_signature_base'];
                    $contactData['spcr_signature'] = '';
                }
                if($_POST['spcr_signature_base']=='' && $_FILES['spcr_signature']['name']!='')
                {
                    $count++;
                    $contactData['spcr_signature_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'report_incident', 'spcr_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'spcr_signature', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'spcr_signature'))->row('file_name');

                    $contactData['spcr_signature'] = base_url().'uploads/report_incident/'.$_POST['id'].'/'.$filename;

                }
                if($_POST['ap_signature_base']!='' && $_FILES['ap_signature']['name']=='')
                {
                    $count++;
                    $contactData['ap_signature_base'] = $_POST['ap_signature_base'];
                    $contactData['ap_signature'] = '';
                }
                if($_POST['ap_signature_base']=='' && $_FILES['ap_signature']['name']!='')
                {
                    $count++;
                    $contactData['ap_signature_base'] = '';

                    $uploadedFiles = handle_file_upload($_POST['id'],'report_incident', 'ap_signature');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($_POST['id'], 'ap_signature', [$file]);
                        }
                    }

                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $_POST['id'], 'rel_type' => 'ap_signature'))->row('file_name');

                    $contactData['ap_signature'] = base_url().'uploads/report_incident/'.$_POST['id'].'/'.$filename;

                }
                $count++;
                $contactData['updated_date'] = date('Y-m-d H:i:s');
                $this->db->where('userid', $userid);
                $this->db->where('id', $_POST['id']);
                $this->db->update(db_prefix().'report_incident', $contactData);
                if($_POST['id'])
                {
                    $reciver_id = $this->db->get_where(db_prefix().'report_incident',['id'=>$_POST['id']])->row('client_id');
                    $where['userid']= $userid;
                    $notificationdata['notify_type']='Incident';
                    $notificationdata['notify_name']='Update Incident';
                    $notificationdata['sender']=$this->db->get_where('tblcontacts',$where)->row('firstname');
                    $message='Update Incident  <a href="javascript:void(0)">'.$_POST['report_for'].'</a>';
                    $notificationdata['sender_id']=$userid;
                    $notificationdata['receiver_id']=$reciver_id;
                    $notificationdata['receiver']=$this->db->get_where('tblcontacts',['userid'=>$reciver_id])->row('firstname');
                    $notificationdata['title']=$_POST['report_for'];
                    $notificationdata['message']=$message;
                    // $this->db->insert('tblnotification',$notificationdata);
                    notification($notificationdata);
                    // $totalCol = $this->db->get_where(db_prefix().'employee')->num_fields();
                    // $counttot = $count/$totalCol;
                    // $mulcol = $counttot * 100;
                    // $finalmulcol = round($mulcol,2);

                    // $this->db->where('userid', $userid);
                    // $this->db->update(db_prefix() . 'contacts', [
                    //     'employee_date' => date('Y-m-d H:i:s'),
                    //     'employee_form' => $finalmulcol,
                    // ]);
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
                $contactData['updated_date'] = date('Y-m-d H:i:s');
                // $check = $this->db->get_where(db_prefix().'report_incident',array('userid' => $userid))->row();
                // if(count($check)==0)
                // {
                    $this->db->insert(db_prefix().'report_incident', $contactData);
                    $lid = $this->db->insert_id();
                    if($lid)
                    {
                        if($_POST['cb_signature_base']!=''  && $_FILES['cb_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['cb_signature_base'] = $_POST['cb_signature_base'];
                            $contactDataIMG['cb_signature'] = '';
                        }
                        if($_POST['cb_signature_base']==''  && $_FILES['cb_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['cb_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'report_incident', 'cb_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'cb_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'cb_signature'))->row('file_name');

                            $contactDataIMG['cb_signature'] = base_url().'uploads/report_incident/'.$lid.'/'.$filename;

                        }
                        if($_POST['spcr_signature_base']!=''  && $_FILES['spcr_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['spcr_signature_base'] = $_POST['spcr_signature_base'];
                            $contactDataIMG['spcr_signature'] = '';
                        }
                        if($_POST['spcr_signature_base']==''  && $_FILES['spcr_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['spcr_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'report_incident', 'spcr_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'spcr_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'spcr_signature'))->row('file_name');

                            $contactDataIMG['spcr_signature'] = base_url().'uploads/report_incident/'.$lid.'/'.$filename;

                        }
                        if($_POST['ap_signature_base']!=''  && $_FILES['ap_signature']['name']=='')
                        {
                            $count++;
                            $contactDataIMG['ap_signature_base'] = $_POST['ap_signature_base'];
                            $contactDataIMG['ap_signature'] = '';
                        }
                        if($_POST['ap_signature_base']==''  && $_FILES['ap_signature']['name']!='')
                        {
                            $count++;
                            $contactDataIMG['ap_signature_base'] = '';

                            $uploadedFiles = handle_file_upload($lid,'report_incident', 'ap_signature');
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $this->misc_model->add_attachment_to_database($lid, 'ap_signature', [$file]);
                                }
                            }

                            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'ap_signature'))->row('file_name');

                            $contactDataIMG['ap_signature'] = base_url().'uploads/report_incident/'.$lid.'/'.$filename;

                        }

                        $this->db->where('userid', $userid);
                        $this->db->where('id', $lid);
                        $this->db->update(db_prefix().'report_incident', $contactDataIMG);

                        // $where['userid']= $userid;
                        // $notificationdata['notify_type']='Incident';
                        // $notificationdata['notify_name']='New Incident';
                        // $notificationdata['sender']=$this->db->get_where('tblcontacts',$where)->row('firstname');
                        // $message='New Incident  <a href="javascript:void(0)">'.$_POST['report_for'].'</a>';
                        // $notificationdata['sender_id']=$userid;
                        // $notificationdata['title']=$_POST['report_for'];
                        // $notificationdata['message']=$message;
                        // // $this->db->insert('tblnotification',$notificationdata);
                        // notification($notificationdata);

                        // $totalCol = $this->db->get_where(db_prefix().'employee')->num_fields();
                        // $counttot = $count/$totalCol;
                        // $mulcol = $counttot * 100;
                        // $finalmulcol = round($mulcol,2);

                        // $this->db->where('userid', $userid);
                        // $this->db->update(db_prefix() . 'contacts', [
                        //     'employee_date' => date('Y-m-d H:i:s'),
                        //     'employee_form' => $finalmulcol,
                        // ]);
                        $msg = array('status' => true, 'message' =>'Successfully Added!', 'result' =>$lid);

                    }
                    else
                    {
                        $msg = array('status' => false, 'message' => 'Some error occurred', 'result' =>array());
                    }
                // }
                // else
                // {
                //     $msg = array('status' => false, 'message' => 'Already Have Entry', 'result' =>array());
                // }

            }
        }         
        else
        {
            $msg = array('status' => false, 'message' => 'Please Send All The Parameters ', 'result' =>array());
        }
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function getReportIncident()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $userid = $this->user_data->userid;
        $id     =   $postData['id'];
        $success = $this->db->get_where(db_prefix().'report_incident',array('userid' =>$userid,'id' =>$id))->result();
        
        if(count($success) > 0)
        {   foreach ($success as $value) 
            {
                unset($value->userid);
                unset($value->updated_date);
                unset($value->created_date);                           
            }
            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $success);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
        }
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function getReportIncidentList()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        $userid = $this->user_data->userid; 
        $postData['page'] = $_GET['page'];
        $postData['limit'] = $_GET['limit'];
        $careplan=array();
        if($userid != '' )
        {
            $userData = $this->api_model->getReportIncident($postData,$userid);
            $userDataCount = $this->api_model->getReportIncidentCount($postData,$userid);
            // $userData = $this->db->order_by('id','DESC')->get_where(db_prefix().'document', array('client_id' => $userid))->result();
            if(count($userData) > 0)
            {
                foreach ($userData as $value) 
                {
                    

                    $data['id']              = $value->id;
                    $data['date']              = getDateDMYOnly($value->updated_date);
                    $data['time']              = getTimeOnly($value->updated_date);
                    $data['client_name']               = clientname($value->client_id);
                    $clo    =    $this->db->get_where(db_prefix().'contacts', array('userid' => $value->client_id))->row('added_by');
                    $data['clo']            =  clientname($clo);
                    if(strlen($value->incident_details)>20)
                    {
                        $data['description']  = mb_substr($value->incident_details,0,20).'....';
                    }
                    else
                    {
                        $data['description'] = $value->incident_details;
                    }
                    $allData[] = $data;    
                } 
                $msg = array('status' =>true, 'message' => 'Data Found' , 'result' => $allData);
                
            }
            else
            {
                $msg = array('status' => false, 'message' => 'Records are not matching', 'result' =>array());
            } 
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Send All Parameter', 'result' =>array());
        }  
        
        $this->response($msg, REST_Controller::HTTP_OK);
    } 
    // *********************this is for get notification
    //**************************************//
    public function getNotification()
    {
        if($this->user_data->userid != '')
        {
            $select='id,notify_type,notify_name,sender,sender_id,receiver,receiver_id,title,message,created_date';
            $where['receiver_id']=$this->user_data->userid;
            $where['read_status']=0;
            $res =$this->db->select($select)->from(db_prefix().'notification')->where($where)->get()->result();
            rsort($res);
            if($res!=""){
                $msg = array('status' => true, 'message' => 'New Notification','Notification count'=>count($res), 'result' =>$res);
            }else{
                $msg = array('status' => false, 'message' => 'No Notification Found', 'result' =>array());
            }
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Send All Parameter', 'result' =>array());
        }  
        
        $this->response($msg, REST_Controller::HTTP_OK);
    } 
    // *********************this is for read notification
    //**************************************//
    public function notificationRead()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        if($postData['notification_id'] != '')
        // if($postData['userid'] != '' && $postData['notification_id'] != '')
        {
            // echo 'if';die;
            // $role =$this->db->get_where(db_prefix().'contacts',['userid'=>$postData['userid']])->row('role');
            // if($role!=""){
                // echo $role;die;
                // $response = $this->db->get_where(db_prefix().'notification',['id'=>$postData['notification_id']])->row();
                // print_r($response);die;
                // if($role==1){
                    
                //     if($response->reciver_id==""){
                //         $data['userid']=$postData['userid'];
                //         $data['notification_id']=$postData['notification_id'];
                //         $res= $this->db->insert(db_prefix().'employeenotification',$data);
                //         if($res){
                //             $msg = array('status' => true, 'message' => 'Notification Readed', 'result' =>[]);
                //         }else{
                //             $msg = array('status' => false, 'message' => 'Some error Found', 'result' =>[]);
                //         }
                //     }
                // }elseif($role==4){
                //     if($response->reciver_id==""){
                //         $data['userid']=$postData['userid'];
                //         $data['notification_id']=$postData['notification_id'];
                //         $res= $this->db->insert(db_prefix().'employeenotification',$data);
                //         if($res){
                //             $msg = array('status' => true, 'message' => 'Notification Readed', 'result' =>[]);
                //         }else{
                //             $msg = array('status' => false, 'message' => 'Some error Found', 'result' =>[]);
                //         }
                //     }
                // }
                $this->db->where(['id'=>$postData['notification_id']])->update(db_prefix().'notification',['read_status'=>1]);
                $msg = array('status' => true, 'message' => 'Notification Readed', 'result' =>[]);
                
            // }else{
            //     $msg = array('status' => false, 'message' => 'Invalid user', 'result' =>array());
            // }
        }else{
            $msg = array('status' => false, 'message' => 'Send All Parameter', 'result' =>array());
        }  
        
        $this->response($msg, REST_Controller::HTTP_OK);
    } 




    
    


}
