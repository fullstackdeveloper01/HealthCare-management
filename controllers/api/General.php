<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/REST_Controller.php'); 


class General extends MY_Controller {

    /**
     * Construct : A method to load all the helper, language and model files
     * validation_helper
     */
    public function __construct() {
        parent::__construct();
        // $this->load->model('api/authentication_model','api_model',true);
        $this->load->model('api/general_model','api_model',true);
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Kolkata'); 
        
       
   
    }
    
   
    public function addcareer()
    {
        // $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        if($_POST['name'] != '' && $_POST['phone_no'] != '' &&  $_POST['email'] != '')
        {
           // $_POST[
            $contactData['name']            = $_POST['name'];
            $contactData['street_address']  = $_POST['street_address'];
            $contactData['address']         = $_POST['address'];
            $contactData['city']            = $_POST['city'];
            $contactData['state']           = $_POST['state'];
            $contactData['phone_no']        = $_POST['phone_no'];
            $contactData['email']           = $_POST['email'];
            $contactData['comment']         = $_POST['comment'];
            $contactData['created_date']    = date('Y-m-d H:i:s');
            $this->db->insert(db_prefix().'career', $contactData);
            $lid                            = $this->db->insert_id();
            if($lid)
            {
                if($_POST['email']!='')
                {   
                    $message   = 'Caring Approach : Thank you for submitting your request we will get in touch with you shortly';
                    $sub = 'Request submitted for Career';
                    $data1['msg'] = $message;
                    $tempmsg1 = $this->load->view('emailtemp', $data1, true);
                    send_mail($_POST['email'], $sub, $tempmsg1);
                }



                $uploadedFiles = handle_file_upload($lid,'resume_image', 'resume_image');
                if ($uploadedFiles && is_array($uploadedFiles)) {
                    foreach ($uploadedFiles as $file) {
                        $this->misc_model->add_attachment_to_database($lid, 'resume_image', [$file]);
                    }
                }
                
                
                $uploadedFiles = handle_file_upload($lid,'other_document', 'other_document');
                if ($uploadedFiles && is_array($uploadedFiles)) {
                    foreach ($uploadedFiles as $file) {
                        $this->misc_model->add_attachment_to_database($lid, 'other_document', [$file]);
                    }
                }



                $message1   = 'Caring Approach : Career Request';
                if($contactData['name']!='')
                {
                    $message1   .= '<br>Name : '.$contactData['name'];
                }
                if($contactData['email']!='')
                {
                    $message1   .= '<br>Email : '.$contactData['email'];
                }
                if($contactData['phone_no']!='')
                {
                    $message1   .= '<br>Phone No : '.$contactData['phone_no'];
                }
                if($contactData['street_address']!='')
                {
                    $message1   .= '<br>Street Address : '.$contactData['street_address'];
                }
                if($contactData['address']!='')
                {
                    $message1   .= '<br>Address : '.$contactData['address'];
                }
                if($contactData['state']!='')
                {
                    $message1   .= '<br>State : '.$contactData['state'];
                }
                if($contactData['city']!='')
                {
                    $message1   .= '<br>City : '.$contactData['city'];
                }
                if($contactData['comment']!='')
                {
                    $message1   .= '<br>Comment : '.$contactData['comment'];
                }
                    $message1   .= '<br>Date : '.getDateTimeDMYOnly($contactData['created_date']);


                $resume_imagefilename = $this->db->order_by('id','DESC')->select('rel_id,file_name')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'resume_image'))->result();

                if(count($resume_imagefilename)>0)
                {
                    foreach ($resume_imagefilename as $value) 
                    {
                        $filepath = base_url().'uploads/resume_image/'.$lid.'/'.$value->file_name;
                        // $message1   .= '<br>Resume : <br> <img src="'.$filepath.'"  height="50px">';
                        $message1   .= "<br>Resume : <br> <div class='d-flex align-items-center'><a href=".$filepath." target='_blank' ><img width='50px' src='".base_url()."/assets/images/pdf.png' alt='Avatar' class='rounded mr-1' />".$value->file_name."</a></div>";

                    }

                }
                $other_documentfilename = $this->db->order_by('id','DESC')->select('rel_id,file_name')->get_where(db_prefix().'files', array('rel_id' => $lid, 'rel_type' => 'other_document'))->result();

                if(count($other_documentfilename)>0)
                {
                    foreach ($other_documentfilename as $valueo) 
                    {
                        $filepathh = base_url().'uploads/other_document/'.$lid.'/'.$valueo->file_name;
                        // $message1   .= '<br>Other Document : <br> <img src="'.$filepathh.'"  height="50px">';
                        $message1   .= "<br>Other Document : <br> <div class='d-flex align-items-center'><a href=".$filepathh." target='_blank' ><img width='50px' src='".base_url()."/assets/images/pdf.png' alt='Avatar' class='rounded mr-1' />".$valueo->file_name."</a></div>";
                    }

                }
                
                $sub1 = 'Request For Career';
                $data['msg'] = $message1;
                $tempmsg = $this->load->view('emailtemp', $data, true);
                // send_mail('pooja@immersiveinfotech.com', $sub1, $tempmsg);
                // send_mail('varun@immersiveinfotech.com', $sub1, $tempmsg);
                send_mail('admin@caringapproach.com.au', $sub1, $tempmsg);
                send_mail('hr2@caringapproach.com.au', $sub1, $tempmsg);
                send_mail('hr1s@caringapproach.com.au', $sub1, $tempmsg);
                // send_mail('salman@immersiveinfotech.com', $sub1, $tempmsg);




                $msg = array('status' => true, 'message' =>'Send successfully!', 'result' =>array());
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


    public function contact_us()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        
        if($postData['firstname'] != '' && $postData['lastname'] != '' &&  $postData['email'] != '' &&  $postData['phonenumber'] != '' )
        {
           
            $contactData['firstname'] = $postData['firstname'];
            $contactData['lastname'] = $postData['lastname'];
            $contactData['email'] = $postData['email'];
            $contactData['phonenumber'] = $postData['phonenumber'];
            $contactData['message'] = $postData['message'];
            $contactData['address'] = $postData['address'];
            $contactData['created_date'] = date('Y-m-d H:i:s');
            $this->db->insert(db_prefix().'contacts_us', $contactData);
            $lid = $this->db->insert_id();
            if($lid)
            {
                if($postData['email']!='')
                {   
                    $message   = 'Caring Approach : Thank you for submitting your request we will get in touch with you shortly';
                    $sub = 'Request Submitted For Contact Us';
                    $data1['msg'] = $message;
                    $tempmsg1 = $this->load->view('emailtemp', $data1, true);
                    send_mail($postData['email'], $sub, $tempmsg1);
                }
                    $message1   = 'Caring Approach : Contact Us Request';
                   
                if($contactData['firstname']!='')
                {
                    $message1   .= '<br>First Name : '.$contactData['firstname'];
                }
                if($contactData['lastname']!='')
                {
                    $message1   .= '<br>Last Name : '.$contactData['lastname'];
                }
                if($contactData['email']!='')
                {
                    $message1   .= '<br>Email : '.$contactData['email'];
                }
                if($contactData['phonenumber']!='')
                {
                    $message1   .= '<br>Phone No : '.$contactData['phonenumber'];
                }
                if($contactData['address']!='')
                {
                    $message1   .= '<br>Address : '.$contactData['address'];
                }
                if($contactData['message']!='')
                {
                    $message1   .= '<br>Message : '.$contactData['message'];
                }
                    $message1   .= '<br>Date : '.getDateTimeDMYOnly($contactData['created_date']);
                    $sub1 = 'Contact Us Request';
                    $data['msg'] = $message1;
                    $tempmsg = $this->load->view('emailtemp', $data, true);
                     send_mail('bhavna@immersiveinfotech.com', $sub1, $tempmsg);
                    send_mail('admin@caringapproach.com.au', $sub1, $tempmsg);
                    send_mail('intakeact@caringapproach.com.au', $sub1, $tempmsg);
                    send_mail('intakensw@caringapproach.com.au', $sub1, $tempmsg);
                    // send_mail('aliakbar@immersiveinfotech.com', $sub1, $tempmsg);
                    // send_mail('salman@immersiveinfotech.com', $sub1, $tempmsg);
                    // send_mail('varun@immersiveinfotech.com', $sub1, $tempmsg);



                $msg = array('status' => true, 'message' =>'Send successfully!', 'result' =>array());
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


    public function feedback()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        if($postData['firstname'] != '' && $postData['lastname'] != '' &&  $postData['email'] != '' &&  $postData['phonenumber'] != '' )
        {
           $contactData['firstname'] = $postData['firstname'];
            $contactData['lastname'] = $postData['lastname'];
            $contactData['email'] = $postData['email'];
            $contactData['phonenumber'] = $postData['phonenumber'];
            $contactData['message'] = $postData['message'];
            $contactData['created_date'] = date('Y-m-d H:i:s');
            $this->db->insert(db_prefix().'feedback', $contactData);
            $lid = $this->db->insert_id();
            if($lid)
            {
                if($postData['email']!='')
                {   
                    $message   = 'Caring Approach : Thank you for submitting your Feedback we will get in touch with you shortly';
                    $sub = 'Feedback Submitted For Contact Us';
                    $data1['msg'] = $message;
                    $tempmsg1 = $this->load->view('emailtemp', $data1, true);
                    send_mail($postData['email'], $sub, $tempmsg1);
                }
                    $message1   = 'Caring Approach : Contact Us Request';
                   
                if($contactData['firstname']!='')
                {
                    $message1   .= '<br>First Name : '.$contactData['firstname'];
                }
                if($contactData['lastname']!='')
                {
                    $message1   .= '<br>Last Name : '.$contactData['lastname'];
                }
                if($contactData['email']!='')
                {
                    $message1   .= '<br>Email : '.$contactData['email'];
                }
                if($contactData['phonenumber']!='')
                {
                    $message1   .= '<br>Phone No : '.$contactData['phonenumber'];
                }
                if($contactData['message']!='')
                {
                    $message1   .= '<br>Message : '.$contactData['message'];
                }
                    $message1   .= '<br>Date : '.getDateTimeDMYOnly($contactData['created_date']);
                    $sub1 = 'Contact Us Request';
                    $data['msg'] = $message1;
                    $tempmsg = $this->load->view('emailtemp', $data, true);
                    // send_mail('pooja@immersiveinfotech.com', $sub1, $tempmsg);
                    send_mail('admin@caringapproach.com.au', $sub1, $tempmsg);
                    // send_mail('varun@immersiveinfotech.com', $sub1, $tempmsg);
                    // send_mail('salman@immersiveinfotech.com', $sub1, $tempmsg);
                $msg = array('status' => true, 'message' =>'Send successfully!', 'result' =>array());
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


    public function getOfficeLocation()
    {
        $success = $this->db->get_where(db_prefix().'office_location')->result();
       
        if(count($success) > 0)
        {    
            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $success);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
        }
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function getServiceType()
    {
        $success = $this->db->get_where(db_prefix().'service_type')->result();
       
        if(count($success) > 0)
        {    
            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $success);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
        }
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function getDepartment()
    {
        $success = $this->db->get_where(db_prefix().'department')->result();
        
        if(count($success) > 0)
        {    
            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $success);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
        }
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function getDesignation()
    {
        $success = $this->db->get_where(db_prefix().'designation')->result();
        
        if(count($success) > 0)
        {    
            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $success);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
        }
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function getQuotesOfTheDay()
    {
        $success = $this->db->order_by('id','DESC')->limit(1)->get_where(db_prefix().'quote_of_day')->result();
        
        if(count($success) > 0)
        {    
            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $success);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
        }
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function getLeaveType()
    {
        $success = $this->db->order_by('id','DESC')->get_where(db_prefix().'leave_type')->result();
        
        if(count($success) > 0)
        {    
            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $success);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
        }
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function getLeaveStatus()
    {
        $success = $this->db->order_by('id','DESC')->get_where(db_prefix().'leave_status')->result();
        
        if(count($success) > 0)
        {    
            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $success);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
        }
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function getTicketPriorities()
    {
        $success = $this->db->get_where(db_prefix().'tickets_priorities')->result();
        
        if(count($success) > 0)
        {    
            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $success);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
        }
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function getSupportDepartments()
    {
        $success = $this->db->select('departmentid,name')->get_where(db_prefix().'departments')->result();
        
        if(count($success) > 0)
        {    
            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $success);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
        }
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function getHealthNews()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $postData['page'] = $_GET['page'];
        $postData['limit'] = $_GET['limit'];
        $success = $this->api_model->getHealthNews($postData);
        $successCount = $this->api_model->getHealthNewsCount();

        // $success = $this->db->order_by('articleid','DESC')->limit(10)->get_where(db_prefix().'knowledge_base',array('articlegroup' => 1))->result();
        
        if(count($success) > 0)
        {    
            foreach ($success as $value) 
            {
                $attachment_image = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array("rel_type" => "knowledge_base", "rel_id" => $value->articleid))->row('file_name');
                $attachment_imagepath = site_url('uploads/knowledge_base/'. $value->articleid.'/'. $attachment_image);

                if($attachment_image!='')
                {
                    $data['knowledge_base_image'] = $attachment_imagepath;

                }else{
                    $data['knowledge_base_image'] ='';
                }

                
                $data['subject'] = $value->subject;
                $data['articleid'] = $value->articleid;
                $data['description'] = html_entity_decode($value->description);
                $data['slug'] = $value->slug;
                $data['datecreated'] = $value->datecreated;
                $data['added_by'] = addedby($value->added_by);
                $data['added_by_id'] = clientname($value->added_by_id);

                $allData[] = $data;

            }
            $msg = array('status' =>true, 'message' => 'Data Found', 'count' =>$successCount , 'result' => $allData);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'count' =>0 , 'result' =>array());
        }
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function getHealthNewsDetail()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $value = $this->db->get_where(db_prefix().'knowledge_base',array('articleid' => $postData['articleid'],'articlegroup' => 1))->row();
        
          if(count($value) > 0)
        {    
                $attachment_image = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array("rel_type" => "knowledge_base", "rel_id" => $value->articleid))->row('file_name');
                $attachment_imagepath = site_url('uploads/knowledge_base/'. $value->articleid.'/'. $attachment_image);

                if($attachment_image!='')
                {
                    $data['knowledge_base_image'] = $attachment_imagepath;

                }else{
                    $data['knowledge_base_image'] ='';
                }
                
                $data['articleid'] = $value->articleid;
                $data['subject'] = $value->subject;
                $data['description'] = html_entity_decode($value->description);
                $data['slug'] = $value->slug;
                $data['datecreated'] = $value->datecreated;
                $data['added_by'] = addedby($value->added_by);
                $data['added_by_id'] = clientname($value->added_by_id);

                $allData[] = $data;

            
            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $allData);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
        }
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function getTips()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $postData['page'] = $_GET['page'];
        $postData['limit'] = $_GET['limit'];
         $success = $this->api_model->getTips($postData);
         $successCount = $this->api_model->getTipsCount();
        // $success = $this->db->order_by('articleid','DESC')->limit(10)->get_where(db_prefix().'knowledge_base',array('articlegroup' => 2))->result();
        
          if(count($success) > 0)
        {    
            foreach ($success as $value) 
            {
                $attachment_image = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array("rel_type" => "knowledge_base", "rel_id" => $value->articleid))->row('file_name');
                $attachment_imagepath = site_url('uploads/knowledge_base/'. $value->articleid.'/'. $attachment_image);

                if($attachment_image!='')
                {
                    $data['knowledge_base_image'] = $attachment_imagepath;

                }else{
                    $data['knowledge_base_image'] ='';
                }
                $data['articleid'] = $value->articleid;
                $data['subject'] = $value->subject;
                $data['description'] = html_entity_decode($value->description);
                $data['slug'] = $value->slug;
                $data['datecreated'] = $value->datecreated;
                $data['added_by'] = addedby($value->added_by);
                $data['added_by_id'] = clientname($value->added_by_id);

                $allData[] = $data;

            }
            $msg = array('status' =>true, 'message' => 'Data Found', 'count' =>$successCount , 'result' => $allData);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'count' =>0 , 'result' =>array());
        }
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function getTipsDetail()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        $value = $this->db->get_where(db_prefix().'knowledge_base',array('articleid' => $postData['articleid'],'articlegroup' => 2))->row();
        // echo $this->db->last_query();
        // print_r($sucess);
        //  die;
        if(count($value) > 0)
        {    
            
                $attachment_image = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array("rel_type" => "knowledge_base", "rel_id" => $value->articleid))->row('file_name');
                $attachment_imagepath = site_url('uploads/knowledge_base/'. $value->articleid.'/'. $attachment_image);

                if($attachment_image!='')
                {
                    $data['knowledge_base_image'] = $attachment_imagepath;

                }else{
                    $data['knowledge_base_image'] ='';
                }
                $data['articleid'] = $value->articleid;
                $data['subject'] = $value->subject;
                $data['description'] = html_entity_decode($value->description);
                $data['slug'] = $value->slug;
                $data['datecreated'] = $value->datecreated;
                $data['added_by'] = addedby($value->added_by);
                $data['added_by_id'] = clientname($value->added_by_id);

                $allData[] = $data;

            
            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $allData);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
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

    public function getGalleryYear()
    {
        $success = $this->db->order_by('id','ASC')->group_by('folderid')->select('folderid')->get_where(db_prefix().'gallery')->result();
        
        if(count($success) > 0)
        {    
            foreach ($success as $value) 
            {
                $value->name = $this->db->get_where(db_prefix().'folder_year', array('id' => $value->folderid))->row('name');
            }
            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $success);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
        }
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function getGalleryEvent()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));

        $success = $this->db->order_by('id','ASC')->group_by('eventid')->select('eventid')->get_where(db_prefix().'gallery',array('folderid' =>$postData['folderid']))->result();
        
        if(count($success) > 0)
        {    
            foreach ($success as $value) 
            {
                 $value->name = $this->db->get_where(db_prefix().'folder_event', array('id' => $value->eventid))->row('name');

                $foldername = $this->db->get_where(db_prefix().'folder_year', array('id' => $postData['folderid']))->row('name');

                $successdata = $this->db->order_by('id','ASC')->get_where(db_prefix().'gallery',array('folderid' =>$postData['folderid'],'eventid' =>$value->eventid))->row();

                 $attachment_image = $this->db->order_by('id','ASC')->select('file_name')->get_where(db_prefix().'files', array("rel_type" => "gallery", "rel_id" => $successdata->id))->row();
                if($attachment_image!='')
                {
                    $value->event_image =  site_url('uploads/gallery/'. $foldername.'/'. $successdata->eventid.'/'. $attachment_image->file_name);
                }
                else
                {
                        $value->event_image ='';
                }
            }
            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $success);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
        }
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function getGalleryImages()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));

        $success = $this->db->order_by('id','ASC')->get_where(db_prefix().'gallery',array('folderid' =>$postData['folderid'],'eventid' =>$postData['eventid']))->result();
        
        if(count($success) > 0)
        {    
            foreach ($success as $value) 
            {
                $foldername = $this->db->get_where(db_prefix().'folder_year', array('id' => $value->folderid))->row('name');
                $attachment_image = $this->db->order_by('id','DESC')->select('file_name')->get_where(db_prefix().'files', array("rel_type" => "gallery", "rel_id" => $value->id))->result();
                foreach ($attachment_image as $value1) 
                {
                    $attachment_imagepath = site_url('uploads/gallery/'. $foldername.'/'. $value->eventid.'/'. $value1->file_name);

                    if($value1->file_name!='')
                    {
                        $data[] = $attachment_imagepath;

                    }else{
                        $data[] ='';
                    }
                }
            }
            $msg = array('status' =>true, 'message' => 'Data Found', 'result' => $data);  
        }
        else
        {
            $msg = array('status' => false, 'message' => 'Records Not Found', 'result' =>array());
        }
       
        $this->response($msg, REST_Controller::HTTP_OK);
    }


    
    
}
