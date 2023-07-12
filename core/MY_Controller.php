<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/JWT.php';
require_once APPPATH . '/libraries/BeforeValidException.php';
require_once APPPATH . '/libraries/ExpiredException.php';
require_once APPPATH . '/libraries/SignatureInvalidException.php';
use \Firebase\JWT\JWT;

class MY_Controller extends REST_Controller
{
	
	private $user_credential;
	
	function __construct()
    {
		// Construct the parent class
        parent::__construct(); 
        $this->load->library('user_agent');
		 
		date_default_timezone_set('Asia/Kolkata');
		 $this->headers = $this->input->get_request_header('Authorization');
		 $this->system_name = SYSTEM_NAME;
		 $this->commission  = 10;
		 Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
         Header("Access-Control-Allow-Headers: *");
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE, HEAD'); //method allowed
	}	
    public function auth()
    {
         //JWT Auth middleware
        $headers = $this->input->get_request_header('Authorization');
        $kunci = $this->config->item('thekey'); //secret key for encode and decode
	 
        $token= $this->input->get('token');//"token";
       	if (!empty($headers)) {
        	if (preg_match('/Bearer\s(\S+)/', $headers , $matches)) {
            $token = $matches[1];
        	}
    	}
        try {
	        $decoded = JWT::decode($token, $kunci, array('HS256'));
		    $this->user_data = $decoded;
			$this->session->set_userdata('id', $this->user_data->id);
	    } catch (Exception $e) {
	 //   	var_dump($e);
            $invalid = ['status' => $e->getMessage()]; //Respon if credential invalid
//            $this->response($invalid, 401);//401
//            $this->output->set_header('WWW-Authenticate: Negotiate');
            // header('WWW-Authenticate: Negotiate');
            $this->response($invalid, 401);//401
        }
    }
	
	public function parantAuthToken($token)
    {
		$kunci = $this->config->item('thekey');
		if (!empty($token)) {
			if (preg_match('/Bearer\s(\S+)/', $token , $matches)) {
				$token = $matches[1];
        	}
    	}
        try {
	        $decoded = JWT::decode($token, $kunci, array('HS256'));
		    $this->parant_user_data = $decoded;
	    } catch (Exception $e) {
            $invalid = ['status' => $e->getMessage()]; //Respon if credential invalid
            $this->response($invalid, 401);//401
        }
    }
	
	public function index()
	{
		$this->render();
	}


	public function render($view = '')
	{
	  	$this->load->view('user/'.$view, $this->data);
 	}
	 
	
}