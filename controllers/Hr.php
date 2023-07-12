<?php

defined('BASEPATH') or exit('No direct script access allowed');

use app\services\ValidatesContact;

class Hr extends ClientsController
{
    /**
     * @since  2.3.3
     */
    use ValidatesContact;

    public function __construct()
    {
        parent::__construct();
        hooks()->do_action('after_clients_area_init', $this);
        $this->load->model('properties_model');
        $this->load->model('careplan_model');
        $this->load->model('invoice_model');
        $this->load->model('roster_model');
        $this->load->model('appointment_model');
        $this->load->model('requestamendment_model');
        $this->load->model('document_model');
        $this->load->model('staffs_model');
        $this->load->model('news_model');
        $this->load->model('knowledge_base_model');
        $this->load->model('serviceagreements_model');
        $this->load->model('tips_model');
        $this->load->model('clientstaff_model');
        $this->load->model('clientreview_model');
        $this->load->model('tickets_clo_model');
        $this->load->library('pagination');
    }

    public function index()
    {
        $data['is_home'] = true;
        $this->load->model('reports_model');
        $data['payments_years'] = $this->reports_model->get_distinct_customer_invoices_years();

        $data['project_statuses'] = $this->projects_model->get_project_statuses();
        $data['title']            = get_company_name(get_client_user_id());
      
       
        $this->data($data);
        $this->view('home');
        $this->layout();
        
    }

      public function tinymce_file_browser()

    {

        $data['connector']   = site_url() . '/utilities/media_connector';

        $data['mediaLocale'] = get_media_locale();

        $this->app_css->add('app-css', base_url($this->app_css->core_file('assets/css', 'style.css')) . '?v=' . $this->app_css->core_version(), 'editor-media');
 
        $this->load->view('admin/includes/elfinder_tinymce', $data);

    }

    /** -------------------------------------------
    * @Load careplan recored
    -----------------------------------------------*/
    public function loadCarePlanData()
    {
        $result = $this->careplan_model->loadCarePlanData();
        $data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
        {
            $no++;
            $row   = array();
            // $row[] = $no;
             $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $e_res->id, 'rel_type' => 'care_plan'))->row('file_name');
             
            if(strlen($e_res->title)>100)
            {
                $outstr  = mb_substr($e_res->title,0,100).'...';

            }else
            {
                $outstr  = $e_res->title;
            }

            $row[] = "<div class='d-flex align-items-center'><img width='50px' src='".base_url()."/assets/images/pdf.svg' alt='Avatar' class='rounded mr-1' /><a href=".base_url()."uploads/care_plan/".$e_res->id."/".$filename." target='_blank' >".$outstr."</a></div>";

            // $row[] = date('dS \o\f F Y h:i:s A', strtotime($e_res->created_date));

            
            //$row[] = getDateDMYOnly($e_res->created_date);

            $ndate = getDateDMYOnly($e_res->created_date); 
            $row[] = '<span class="nowrap">'.$ndate.'</span>';



            //$row[] = getDateDMYOnly($e_res->created_date);
            // $row[] = $e_res->created_date;
            $btn = '';

            $btn .= "<div class='d-flex'><button type='button' class='btn btn-sm btn-success' data-toggle='modal' data-target='#editcateplanModal' onClick='editShowCarePlan(".$e_res->id.")' title='Edit' ><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp;";

            $btn .= "<button type='button' class='btn btn-sm btn-danger' onClick='removeCareplan(".$e_res->id.")' title='Remove' ><i class='fa fa-trash'></i></button></div>";
            $row[] = $btn;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($result),
            "recordsFiltered" => $this->careplan_model->count_carePlanFiltered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    /** -------------------------------------------
    * @Load careplan recored
    -----------------------------------------------*/
    public function loadDocumentData()
    {
        $result = $this->document_model->loadDocumentData();
        $data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
        {
            $no++;
            $row   = array();
            // $row[] = $no;
            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $e_res->id, 'rel_type' => 'document'))->row('file_name');

            $row[] = "<div class='d-flex align-items-center'><img width='50px' src='".base_url()."/assets/images/pdf.svg' alt='Avatar' class='rounded mr-1' /><a href=".base_url()."uploads/document/".$e_res->id."/".$filename." target='_blank' >".$e_res->title."</a></div>";

            // $row[] = $e_res->created_date;
            $row[] =  getDateDMYOnly($e_res->created_date);
            $row[] = bytesToSize('uploads/document/'.$e_res->id."/".$filename);
            $btn = '';

            $btn .= "<div class='d-flex'><button type='button' class='btn btn-sm btn-success' data-toggle='modal' data-target='#editdocumentModal' onClick='editShowDocument(".$e_res->id.")' title='Edit' ><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp;";

            $btn .= "<button type='button' class='btn btn-sm btn-danger' onClick='removeDocument(".$e_res->id.")' title='Remove' ><i class='fa fa-trash'></i></button></div>";
            $row[] = $btn;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($result),
            "recordsFiltered" => $this->document_model->count_DocumentFiltered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    /** -------------------------------------------
    * @Load Roster recored
    -----------------------------------------------*/
    public function loadRosterData()
    {
        $result = $this->roster_model->loadRosterData();
        $data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
        {
            $no++;
            $row   = array();
            // $row[] = $no;
            $staff_res = $this->common_model->getData('tblcontacts', array('userid'=>$e_res->staff_id), 'single');
            $row[] = '<span class="nowrap">'.(!empty($staff_res)) ? $staff_res->firstname.' '.$staff_res->lastname : ''.'</span>';
            $row[] = servicename($e_res->service_id);
            $row[] = '<span class="nowrap">'.getDateDMYOnly($e_res->start_date).'</span>';
            $row[] = '<span class="nowrap">'.getDateDMYOnly($e_res->end_date).'</span>';
            // $row[] = $e_res->start_date;
            // $row[] = $e_res->end_date;
            $row[] = '<span class="nowrap">'.$e_res->time_from.' - '.$e_res->time_to.'</span>';
            $row[] = $e_res->description;
            $btn = '';
            $btn .= "<span class='nowrap'><button type='button' data-toggle='modal' class='btn btn-sm btn-success' data-target='#editrosterModal' onClick='editRoster(".$e_res->id.")' title='Edit' ><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp;";
            $btn .= "<button type='button' class='btn btn-sm btn-danger' onClick='removeRoster(".$e_res->id.")' title='Remove' ><i class='fa fa-trash'></i></button></span>";
            $row[] = $btn;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($result),
            "recordsFiltered" => $this->roster_model->count_RosterFiltered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    /** -------------------------------------------
    * @Load Roster recored
    -----------------------------------------------*/
    public function loadAppointmentData()
    {
        $result = $this->appointment_model->loadAppointmentData();
        $data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
        {
            $no++;
            $row   = array();
            // $row[] = $no;
            
            $row[] = $e_res->title;
            // $row[] = servicename($e_res->service_id);
            $row[] = getDateDMYOnly($e_res->start_date);
            $row[] = getDateDMYOnly($e_res->end_date);
            // $row[] = $e_res->start_date;
            // $row[] = $e_res->end_date;
            $row[] = $e_res->start_time;
            $row[] = $e_res->end_time;
            $row[] = $e_res->frequency;
            $row[] = $e_res->description;
            $btn = '';
            $btn .= "<button type='button' data-toggle='modal' class='btn btn-sm btn-success' data-target='#editappointmentModal' onClick='editAppointment(".$e_res->id.")' title='Edit' ><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp;";
            $btn .= "<button type='button' class='btn btn-sm btn-danger' onClick='removeAppointment(".$e_res->id.")' title='Remove' ><i class='fa fa-trash'></i></button>";
            $row[] = $btn;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($result),
            "recordsFiltered" => $this->appointment_model->count_AppointmentFiltered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    /** -------------------------------------------
    * @Load Roster recored
    -----------------------------------------------*/
    public function loadServiceAgreementsData()
    {
        $result = $this->serviceagreements_model->loadServiceAgreementsData();
        $data = array();
        $no = $_POST['start'];

        $useridfileter = $_POST['filter_by']['client_id'];
        $client_id_encrypt_alt = base64_encode($useridfileter);
        $client_id_encrypt = "'".$client_id_encrypt_alt."'";
       
        foreach ($result as $e_res) 
        {
            $no++;
            $row   = array();
            // $row[] = $no;
            
          
            $row[] = '<td class="care-plan"><img  width="46" src="'.base_url("assets/images/pdf.svg").'" alt="Avatar" class="rounded mr-1"><a href="#" target="_blank">'.formname($e_res->form_id).'</td>';
            $row[] = getDateDMYOnly($e_res->created_date);
            $row[] = getDateDMYOnly($e_res->updated_date);
            
            $row[] = '<div class="progress mb-0">
                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="'.$e_res->form_process.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$e_res->form_process.'%">
                            <span class="sr-only">'.$e_res->form_process.'%</span>
                        </div>
                     </div>';     
            $btn = '';
            
            $btn .= '<button type="button" class="btn btn-sm btn-warning"  onclick="form_open_as('.$client_id_encrypt.','.$e_res->form_id.')" ><i class="fa fa-eye"></i></button>&nbsp;&nbsp;&nbsp;';
           $btn .= "<button type='button' class='btn btn-sm btn-danger' onClick='removeServiceAgreementsSection(".$e_res->id.")' title='Remove' ><i class='fa fa-trash '></i></button>";

            $row[] = $btn;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($result),
            "recordsFiltered" => $this->serviceagreements_model->count_ServiceAgreementsFiltered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    /** -------------------------------------------
    * @Load Roster recored
    -----------------------------------------------*/
    public function loadRequestAmendmentData()
    {
        $result = $this->requestamendment_model->loadRequestAmendmentData();
        $data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
        {
            $no++;
            $row   = array();
            // $row[] = $no;
            
            $row[] = ucfirst(clientname($e_res->client_id));
            if($e_res->request_type=='Roster')
            {
                $row[] = "<button type='button' data-toggle='modal' class='btn btn-sm btn-success' data-target='#editrosterModal' onClick='editRoster(".$e_res->request_id.")' title='Edit' >".$e_res->request_type."</button>";
            }
            else
            {
                $row[] = "<button type='button' class='btn btn-sm btn-primary'>".$e_res->request_type."</button>";
            }
            if(strlen($e_res->title)>10)
            {
                $row[]  = '<div class="profile-box-text"><a href="#" data-toggle="tooltip" data-placement="top" title="'.$e_res->title.'">'.mb_substr($e_res->title,0,10).' </a></div>';
            }
            else
            {
                $row[] = $e_res->title;
            }

            
            if($e_res->request_type=='Roster')
            $row[] = getDateDMYOnly($e_res->start_date).' - '.getDateDMYOnly($e_res->end_date);
            else
            $row[] = getDateDMYOnly($e_res->start_date);

            if(strlen($e_res->description)>10)
            {
                $row[]  = '<div class="profile-box-text"><a href="#" data-toggle="tooltip" data-placement="top" title="'.$e_res->description.'">'.mb_substr($e_res->title,0,10).' </a></div>';
            }
            else
            {
                $row[] = $e_res->description;
            }

            $row[] = ($e_res->status==0)?'Pending':'Done';
            $status = ($e_res->status==0)?'1':'0';
            $statuschecked = ($e_res->status==0)?'':'checked';
            $btn = '';
            $btn .= '<label class="switch"><input type="checkbox" name="status" title="Change Status" id="status_'.$e_res->id.'" onclick="changeStatusRequestAmendment('.$e_res->id.','.$status.')" '.$statuschecked.'><span class="slider"></span></label>';
           
            $row[] = $btn;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($result),
            "recordsFiltered" => $this->requestamendment_model->count_RequestAmendmentFiltered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    /** -------------------------------------------
    * @Load loadClientsData
    -----------------------------------------------*/
    public function loadStaffData()
    {
        $result = $this->staffs_model->loadStaffsData();
        $data = array();
        $no = $_POST['start'];
        // print_r($result); 
        // die;
        foreach ($result as $e_res) 
        {
            $no++;
            $row   = array();
            // $userinfo = $this->db->get_where(db_prefix().'contacts',array('userid' =>$e_res->staff_id))->row();
           
            $row[] = $no;
            $row[] = ucfirst($e_res->firstname);
            $row[] = ucfirst($e_res->lastname);
            $row[] = $e_res->email;
            $row[] = $e_res->phonenumber;
            $row[] = $e_res->address;
            $row[] = departementname($e_res->department_id);
            $row[] = designationname($e_res->designation_id);
            // $row[] = servicename($e_res->service_type);
            
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($result),
            "recordsFiltered" => $this->staffs_model->count_staffsFiltered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function checkImg($path){
        if (file_exists($path)) {
            return base_url().$path;
        }else{
            return  base_url("assets/images/user.png");
        }

    }
    /** -------------------------------------------
    * @Load loadClientsData
    -----------------------------------------------*/
    public function loadClientSupportStaffData()
    {
        $client_id = $_POST['client_id'];
        $result = $this->clientstaff_model->loadClientStaffsData($client_id);
        $data = array();
        $no = $_POST['start'];
        // print_r($result); 
        // die;
        if(count($result)>0)
        {
            foreach ($result as $e_res) 
            {
                $no++;
                $row   = array();
                $stff_info = $this->db->get_where(db_prefix().'contacts',array('userid' =>$e_res->staff_id))->row();
                $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $stff_info->userid, 'rel_type' => 'profile_image'))->row('file_name');

               
               
                if($filename!='')
                {
                                            
                $row['imgexist']= '1';
                 

                $row['img']= '<img src='.$this->checkImg("uploads/profile_image/".$stff_info->userid."/".$filename).' class="client-profile-image-small mright5 media-object"   >';
                }
                else
                {
                $row['imgexist']= '0';
                $row['fn']= ucfirst(substr($stff_info->firstname, 0, 1));
                $row['ln']= ucfirst(substr($stff_info->lastname, 0, 1));
                }
                
                $row['name']  = ucfirst(clientname($stff_info->userid));
                $row['favorite_food']  = ($stff_info->favorite_food!='')? $stff_info->favorite_food :'';
                if(strlen($stff_info->favorite_food)>30)
                {
                    $row['favorite_food_short']  = mb_substr($stff_info->favorite_food,0,30).'...';

                }
                $row['favorite_sport']  = ($stff_info->favorite_sport!='')? $stff_info->favorite_sport :'';
                 if(strlen($stff_info->favorite_sport)>30)
                {
                    $row['favorite_sport_short']  = mb_substr($stff_info->favorite_sport,0,30).'...';

                }
                $row['favorite_destination']  = ($stff_info->favorite_destination!='')? $stff_info->favorite_destination :'';
                 if(strlen($stff_info->favorite_destination)>30)
                {
                    $row['favorite_destination_short']  = mb_substr($stff_info->favorite_destination,0,30).'...';

                }
                $row['phonenumber']  = $stff_info->phonenumber;
                $row['email']  =$stff_info->email;
                
                
                
                $data[] = $row;
            }
        }
        else
        {
            $data=false;
        }
        echo json_encode($data);
    }
    /** -------------------------------------------
    * @Load loadClientsData
    -----------------------------------------------*/
    public function loadClientReviewData()
    {
        $client_id = $_POST['client_id'];
        $result = $this->clientreview_model->loadClientReviewData($client_id);
        $data = array();
        $no = $_POST['start'];
        // print_r($result); 
        // die;
        if(count($result)>0)
        {
            foreach ($result as $e_res) 
            {
                $no++;
                $row   = array();
                $contact_info = $this->db->get_where(db_prefix().'contacts',array('userid' =>$e_res->client_id))->row();
                $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $contact_info->userid, 'rel_type' => 'profile_image'))->row('file_name');

               
               
                if($filename!='')
                {
                                            
                $row['imgexist']= '1';

                $row['img']= '<img src='.$this->checkImg("uploads/profile_image/".$contact_info->userid."/".$filename).' class="client-profile-image-small mright5 media-object"   >';

                // $row['img']= '<img src='.base_url("uploads/profile_image/".$contact_info->userid."/".$filename).' class="client-profile-image-small mright5 media-object" onerror="this.onerror=null;this.src='.base_url('assets/images/user.png').'">';
                }
                else
                {
                $row['imgexist']= '0';
                $row['fn']= ucfirst(substr($contact_info->firstname, 0, 1));
                $row['ln']= ucfirst(substr($contact_info->lastname, 0, 1));
                }
                
                $row['name']  = ucfirst(clientname($contact_info->userid));
                $row['title']  = $e_res->title;
                $row['review']  =$e_res->review;
                $row['star']  =$e_res->star;
                $row['created_date']  =getDateDMYOnly($e_res->created_date);
                
                
                
                $data[] = $row;
            }
        }
        else
        {
            $data=false;
        }
        echo json_encode($data);
    }
    /** -------------------------------------------
    * @Load loadClientsData
    -----------------------------------------------*/
    public function loadClientsData()
    {
        $result = $this->clients_model->loadClientsData();
        $data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
        {
            $no++;
            $row   = array();
           
            //$row[] = $e_res->userid;
            $row[] = '<span class="nowrap">'.$e_res->userid.'</span>';

            $row[] = '<span class="nowrap">' .$e_res->firstname.'</span>';
            $row[] = '<span class="nowrap">' .$e_res->lastname.'</span>';
            $row[] = '<span class="nowrap">' .$e_res->email.'</span>';
            $row[] = '<span class="nowrap">' .$e_res->phonenumber.'</span>';
            $row[] =  mb_substr($e_res->address,0,70).'...';
            $row[] = $e_res->office_location;
            // $active= ($e_res->active==1)?'Active':'Inactive';
            if($e_res->active==1)
            {
                $row[] = "<button type='button' class='btn btn-sm btn-success cursor-pointer' onClick='changeClientStatus(".$e_res->userid.",".$e_res->active.")' title='Change Status' ><label class='mb-0 cursor-pointer'>Active</label></button>";
            }
            else
            {
                $row[] = "<button type='button' class='btn btn-sm btn-danger cursor-pointer' onClick='changeClientStatus(".$e_res->userid.",".$e_res->active.")' title='Change Status' ><label class='mb-0 cursor-pointer'>Inactive</label></button>";

            }

            $btn = '';
            $btn .= '<a href="'.site_url().'clients/profile/'.$e_res->userid.'" class="btn btn-sm btn-success">View Profile</a>';
            $row[] = $btn;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($result),
            "recordsFiltered" => $this->clients_model->count_clientsFiltered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    /** -------------------------------------------
    * @Load loadClientsData
    -----------------------------------------------*/
    public function loadNewsData()
    {
        $result = $this->news_model->loadNewsData();
        $data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
        {
            $no++;
            $row   = array();
            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $e_res->articleid, 'rel_type' => 'knowledge_base'))->row('file_name');
            $row[] = '<img src='.base_url("uploads/knowledge_base/".$e_res->articleid."/".$filename).' class="client-profile-image-small mright5 media-object">';
           
            $row[] = $e_res->subject;
            // $row[] = $e_res->slug;
            $row[] = mb_substr(strip_tags($e_res->description),0,150).'...';
            $row[] = '<div class="nowrap">'.getDateDMYOnly($e_res->datecreated).'</div>';
            // $btn .= '<a href="'.site_url().'knowledge-base/article/'.$e_res->slug.'" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>&nbsp;';
            $btn = '<div class="nowrap">';
            $btn .= "<button type='button' class='btn btn-sm btn-success' data-toggle='modal' data-target='#editNewsModal' onClick='editnewsSection(".$e_res->articleid.")' title='Edit' ><i class='fa fa-edit'></i></button>&nbsp;";
            $btn .= "<button type='button' class='btn btn-sm btn-danger' onClick='removenewsSection(".$e_res->articleid.")' title='Remove' ><i class='fa fa-trash '></i></button></div>";
            $row[] = $btn;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($result),
            "recordsFiltered" => $this->news_model->count_newsFiltered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    /** -------------------------------------------
    * @Load loadClientsData
    -----------------------------------------------*/
    public function loadTipsData()
    {
        $result = $this->tips_model->loadTipsData();
        $data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
        {
            $no++;
            $row   = array();
            $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $e_res->articleid, 'rel_type' => 'knowledge_base'))->row('file_name');
            $row[] = '<img src='.base_url("uploads/knowledge_base/".$e_res->articleid."/".$filename).' class="client-profile-image-small mright5 media-object">';
           
            $row[] = $e_res->subject;
            // $row[] = $e_res->slug;
            $row[] = mb_substr(strip_tags($e_res->description),0,150).'...';

            $row[] = '<div class="nowrap">'.getDateDMYOnly($e_res->datecreated).'</div>';

            // $btn .= '<a href="'.site_url().'knowledge-base/article/'.$e_res->slug.'" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>&nbsp;';
            $btn = '<div class="nowrap">';
            $btn .= "<button type='button' class='btn btn-sm btn-success' data-toggle='modal' data-target='#editTipsModal' onClick='edittipsSection(".$e_res->articleid.")' title='Edit' ><i class='fa fa-edit'></i></button>&nbsp;";
            $btn .= "<button type='button' class='btn btn-sm btn-danger' onClick='removetipsSection(".$e_res->articleid.")' title='Remove' ><i class='fa fa-trash '></i></button></div>";
            $row[] = $btn;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($result),
            "recordsFiltered" => $this->tips_model->count_tipsFiltered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    /** -------------------------------------------
    * @Load Roster recored
    -----------------------------------------------*/
    public function loadInvoiceData()
    {
        $result = $this->invoice_model->loadInvoiceData();
        $data = array();
        $no = $_POST['start'];
        foreach ($result as $e_res) 
        {
            $no++;
            $row   = array();
            $row[] = $e_res->title;
            $row[] = $e_res->invoice_no;
            $row[] = getDateDMYOnly($e_res->invoice_date);
            // $row[] = $e_res->invoice_date;
            $row[] = $e_res->total_amount;
            $filename = $this->db->get_where('tblfiles', array('rel_id' => $e_res->id, 'rel_type' => 'invoice'))->row('file_name');
            $link = base_url().'uploads/invoice/'.$e_res->id.'/'.$filename;
            $row[] = "<div class='care-plan'><a href='".$link."' target='_blank' ><img src='".base_url()."/assets/images/pdf.svg' alt='Avatar' class='rounded mr-1' /></a></div>";
            if($e_res->status == 'UNPAID')
                $row[] = '<span onclick="changeInvoiceStatus('.$e_res->id.',1)" class="label inline-block text-danger" style="border:1px solid #03a9f4; cursor:pointer">'.$e_res->status.'</span>';
            else                
                $row[] = '<span onclick="changeInvoiceStatus('.$e_res->id.',0)" class="label inline-block text-info" style="border:1px solid #03a9f4; cursor:pointer">'.$e_res->status.'</span>';
            $btn = '';
            $btn .= "<button type='button' class='btn btn-sm btn-success' data-toggle='modal' data-target='#editinvoiceModal' onClick='editinvoicesSection(".$e_res->id.")' title='Edit' ><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp;";
            $btn .= "<button type='button' class='btn btn-sm btn-danger' onClick='removeinvoicesSection(".$e_res->id.")' title='Remove' ><i class='fa fa-trash '></i></button>";
            $row[] = $btn;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($result),
            "recordsFiltered" => $this->invoice_model->count_invoiceFiltered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    /** -------------------------------------------
    * @Load recored
    -----------------------------------------------*/
    public function loadRecord($rowno=0){

        // Row per page
        $rowperpage = 5;

        // Row position
        if($rowno != 0){
          $rowno = ($rowno-1) * $rowperpage;
        }
     
        // All records count
        $allcount = $this->clients_model->getrecordCount();

        // Get records
        $users_record = $this->clients_model->getData($rowno,$rowperpage);
     
        // Pagination Configuration
        $config['base_url'] = base_url().'clients/loadRecord';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowperpage;

        // Initialize
        $this->pagination->initialize($config);

        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $users_record;
        $data['row'] = $rowno;

        echo json_encode($data);
     
    }
    /** -------------------------------------------
    * @Load recored
    -----------------------------------------------*/
    public function loadRecordRoster($rowno=0){

        // Row per page
        $rowperpage = 5;

        // Row position
        if($rowno != 0){
          $rowno = ($rowno-1) * $rowperpage;
        }
     
        // All records count
        $allcount = $this->clients_model->getrecordCountRoster();

        // Get records
        $users_record = $this->clients_model->getDataRoster($rowno,$rowperpage);
     
        // Pagination Configuration
        $config['base_url'] = base_url().'clients/loadRecordRoster';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowperpage;

        // Initialize
        $this->pagination->initialize($config);

        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $users_record;
        $data['row'] = $rowno;

        echo json_encode($data);
     
    }

    /** -------------------------------------------
    * @Load recored
    -----------------------------------------------*/
    public function removeCareplan($careid)
    {
        if($careid)
        {
            $this->db->delete(db_prefix().'care_plan', array('id' => $careid));
            $this->careplan_model->delete_image($careid);
        }
        echo 1;
    }
    /** -------------------------------------------
    * @Load recored
    -----------------------------------------------*/
    public function removeDocument($careid)
    {
        if($careid)
        {
            $this->db->delete(db_prefix().'document', array('id' => $careid));
            $this->document_model->delete_image($careid);
        }
        echo 1;
    }

    /** -------------------------------------------
    * @Load recored
    -----------------------------------------------*/
    public function removeinvoicesSection($careid)
    {
        if($careid)
        {
            $this->db->delete(db_prefix().'roster_invoice', array('id' => $careid));
            $this->invoice_model->delete_image($careid);
        }
        echo 1;
    } 
    /** -------------------------------------------
    * @Load recored
    -----------------------------------------------*/
    public function removeServiceAgreementsSection($careid)
    {
        if($careid)
        {
            $this->db->delete(db_prefix().'form_allot', array('id' => $careid));
            
        }
        echo 1;
    } 
    /** -------------------------------------------
    * @Load recored
    -----------------------------------------------*/
    public function removenewsSection($careid)
    {
        if($careid)
        {
            $this->db->delete(db_prefix().'knowledge_base', array('articleid' => $careid));
             $this->knowledge_base_model->delete_image($careid);
        }
        echo 1;
    } /** -------------------------------------------
    * @Load recored
    -----------------------------------------------*/
    public function removetipsSection($careid)
    {
        if($careid)
        {
            $this->db->delete(db_prefix().'knowledge_base', array('articleid' => $careid));
             $this->knowledge_base_model->delete_image($careid);
        }
        echo 1;
    }

    /** -------------------------------------------
    * @Load recored
    -----------------------------------------------*/
    public function removeRoster($careid)
    {
        if($careid)
        {
            $this->db->delete(db_prefix().'roster', array('id' => $careid));
        }
        echo 1;
    }

    /** -------------------------------------------
    * @Load recored
    -----------------------------------------------*/
    public function removeAppointment($careid)
    {
        if($careid)
        {
            $this->db->delete(db_prefix().'appointment', array('id' => $careid));
        }
        echo 1;
    }
  /** -------------------------------------------
    * @Load recored
    -----------------------------------------------*/
    public function changeStatusRequestAmendment($id,$status)
    {
        if($id)
        {
            $data['status'] = $status;
            $this->db->where('id', $id);
            $this->db->update(db_prefix() . 'requestamendment', $data);
        }
        echo 1;
    }
  /** -------------------------------------------
    * @Load recored
    -----------------------------------------------*/
    public function changeClientStatus($userid,$active)
    {
        if($userid)
        {
            $status = ($active==1) ? 0 : 1;
            $data['active'] = $status;
            $this->db->where('id', $userid);
            $this->db->update(db_prefix() . 'clients', $data);

            
            $data1['active'] = $status;
            $this->db->where('userid', $userid);
            $this->db->update(db_prefix() . 'contacts', $data1);
        }
        echo 1;
    }

    /** -------------------------------------------
    * @Load recored
    -----------------------------------------------*/
    public function createinvoicesSection($id = '')
    {
        $status = '';
        $msg = '';
        if ($this->input->post()) {
            $data                = $this->input->post();

            if ($id == '') 
            {
                $invo = $this->db->get_where('tblroster_invoice', array('invoice_no' => $data['invoice_no'],'added_by' => 1,'added_by_id'=>get_client_user_id(),'client_id'=>$this->input->post('client_id')))->row();
                if(count($invo)==1)
                {
                     $msg = _l('Invoice No is already exist');
                    $status = false;

                }
                else
                {

                    $data['created_date'] = date('Y-m-d H:i:s');
                    $data['added_by'] = 1;
                    $data['added_by_id'] = get_client_user_id();
                    $id = $this->invoice_model->add_article($data);
                    if ($id) {
                        $uploadedFiles = handle_file_upload($id,'invoice', 'invoice');
                        if ($uploadedFiles && is_array($uploadedFiles)) {
                            foreach ($uploadedFiles as $file) {
                                $this->misc_model->add_attachment_to_database($id, 'invoice', [$file]);
                            }
                        }
                        $msg = _l('added_successfully', _l('Invoice'));
                        $status = true;
                    }

                }
            } else {

                $invo = $this->db->get_where('tblroster_invoice', array('invoice_no' => $data['invoice_no'],'added_by' => 1,'added_by_id'=>get_client_user_id()))->row();
                if(count($invo)==1)
                {
                    $msg = _l('Invoice No is already exist');
                    $status = false;

                }
                else
                {

                    $success = $this->invoice_model->update_article($data, $id);
                    if($_FILES['invoice']['name'] != '')
                    {
                        $this->invoice_model->delete_image($id);
                        $uploadedFiles = handle_file_upload($id,'invoice', 'invoice');
                        if ($uploadedFiles && is_array($uploadedFiles)) {
                            foreach ($uploadedFiles as $file) {
                                $this->misc_model->add_attachment_to_database($id, 'invoice', [$file]);
                            }
                        }
                    }
                    
                    if ($success) {
                        set_alert('success', _l('updated_successfully', _l('Invoice')));
                    }
                    $msg = _l('updated_successfully', _l('Invoice'));
                    $status = true;
                }
            }

            $responce = array(
                    'success' => $status,
                    'message'=> $msg
                );
            echo json_encode($responce);
        } 
    }

    /** -------------------------------------------
    * @Load recored
    -----------------------------------------------*/
    public function loadRecordInvoice($rowno=0){

        // Row per page
        $rowperpage = 5;

        // Row position
        if($rowno != 0){
          $rowno = ($rowno-1) * $rowperpage;
        }
     
        // All records count
        $allcount = $this->clients_model->getrecordCountInvoice();

        // Get records
        $users_record = $this->clients_model->getDataInvoice($rowno,$rowperpage);
     
        // Pagination Configuration
        $config['base_url'] = base_url().'clients/loadRecordInvoice';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowperpage;

        // Initialize
        $this->pagination->initialize($config);

        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $users_record;
        $data['row'] = $rowno;

        echo json_encode($data);
    }

    /** -------------------------------------------
    * @Load recored
    -----------------------------------------------*/
    public function createCarePlan($id = '')
    {
        $status = '';
        $msg = '';
        if ($this->input->post()) {
            $data                = $this->input->post();
            
            if ($id == '')
            {
                $data['created_date'] = date('Y-m-d H:i:s');
                $data['added_by']     = 1;
                $data['added_by_id']     = get_client_user_id();
                 
                $id = $this->careplan_model->add_article($data);

                if ($id) {
                    $uploadedFiles = handle_file_upload($id,'care_plan', 'care_plan');
                   
                    if ($uploadedFiles && is_array($uploadedFiles)) {               
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'care_plan', [$file]);
                        }
                    }
                    $msg = _l('added_successfully', _l('Care Plan'));
                    $status = true;
                }
            }
            else {
                $success = $this->careplan_model->update_article($data, $id);
                if($_FILES['care_plan']['name'] != '')
                {
                    $this->careplan_model->delete_image($id);
                    $uploadedFiles = handle_file_upload($id,'care_plan', 'care_plan');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'care_plan', [$file]);
                        }
                    }
                }                
                // set_alert('success', _l('updated_successfully', _l('Care Plan')));
                // redirect(base_url('clients/profile/'.$id));
                $msg = _l('updated_successfully', _l('Care Plan'));
                $status = true;
            }

            $responce = array(
                    'success' => $status,
                    'message'=> $msg
                );
            echo json_encode($responce);
        }   
    }

    public function editShowCarePlan($id = ''){  
        $data['id'] = $id;
        $data['careplan'] = $this->db->get_where('tblcare_plan', array('id' => $id))->row();
        $data['filename'] = $this->db->get_where('tblfiles', array('rel_id' => $id, 'rel_type' => 'care_plan'))->row('file_name');
        echo $this->load->view('themes/perfex/views/modal/careplanModal',$data,true);
    }

    /** -------------------------------------------
    * @Load recored
    -----------------------------------------------*/
    public function createDocument($id = '')
    {
        $status = '';
        $msg = '';
        if ($this->input->post()) {
            $data                = $this->input->post();
            
            if ($id == '')
            {
                $data['created_date'] = date('Y-m-d H:i:s');
                $data['added_by']     = 1;
                $data['added_by_id']     = get_client_user_id();
                 
                $id = $this->document_model->add_article($data);

                if ($id) {
                    $uploadedFiles = handle_file_upload($id,'document', 'document');
                    // print_r($uploadedFiles); die;
                    if ($uploadedFiles && is_array($uploadedFiles)) {               
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'document', [$file]);
                        }
                    }
                    $msg = _l('added_successfully', _l('Document'));
                    $status = true;
                }
            }
            else {
                $success = $this->document_model->update_article($data, $id);
                if($_FILES['document']['name'] != '')
                {
                    $this->careplan_model->delete_image($id);
                    $uploadedFiles = handle_file_upload($id,'document', 'document');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'document', [$file]);
                        }
                    }
                }                
                // set_alert('success', _l('updated_successfully', _l('Care Plan')));
                // redirect(base_url('clients/profile/'.$id));
                $msg = _l('updated_successfully', _l('Document'));
                $status = true;
            }

            $responce = array(
                    'success' => $status,
                    'message'=> $msg
                );
            echo json_encode($responce);
        }   
    }

    public function editShowDocument($id = ''){  
        $data['id'] = $id;
        $data['document'] = $this->db->get_where('tbldocument', array('id' => $id))->row();
        $data['filename'] = $this->db->get_where('tblfiles', array('rel_id' => $id, 'rel_type' => 'document'))->row('file_name');
        echo $this->load->view('themes/perfex/views/modal/documentModal',$data,true);
    }

    public function editinvoicesSection($id = ''){  
        $data['id'] = $id;
        $data['invoice_res'] = $this->db->get_where('tblroster_invoice', array('id' => $id))->row();
        $data['filename'] = $this->db->get_where('tblfiles', array('rel_id' => $id, 'rel_type' => 'invoice'))->row('file_name');
        echo $this->load->view('themes/perfex/views/modal/invoicesModal',$data,true);
    }

    public function editnewsSection($articleid = ''){  
        $data['articleid'] = $articleid;
        $data['article'] = $this->db->get_where('tblknowledge_base', array('articleid' => $articleid))->row();
        $data['filename'] = $this->db->get_where('tblfiles', array('rel_id' => $articleid, 'rel_type' => 'knowledge_base'))->row('file_name');
        $data['filenamelink'] = base_url().'uploads/knowledge_base/'.$articleid.'/'.$data['filename'];
        echo $this->load->view('themes/perfex/views/modal/new_newsModel',$data,true);
    }

    public function edittipsSection($articleid = ''){  
        $data['articleid'] = $articleid;
        $data['article'] = $this->db->get_where('tblknowledge_base', array('articleid' => $articleid))->row();
        $data['filename'] = $this->db->get_where('tblfiles', array('rel_id' => $articleid, 'rel_type' => 'knowledge_base'))->row('file_name');
        $data['filenamelink'] = base_url().'uploads/knowledge_base/'.$articleid.'/'.$data['filename'];
        echo $this->load->view('themes/perfex/views/modal/new_tipsModel',$data,true);
    }
    
    public function editRoster($id = ''){  
        $data['id'] = $id;
        $data['careplan'] = $this->db->get_where('tblroster', array('id' => $id))->row();       
        echo $this->load->view('themes/perfex/views/modal/rosterModal',$data,true);
    }
    
    public function editAppointment($id = ''){  
        $data['id'] = $id;
        $data['careplan'] = $this->db->get_where('tblappointment', array('id' => $id))->row();       
        echo $this->load->view('themes/perfex/views/modal/appointmentModal',$data,true);
    }
    
    /* Edit client or add new client*/
    public function addClient($id = '')
    {       
        $status = '';
        $msg = '';
        if ($this->input->post()) {
            if ($id == '') {

                $data = $this->input->post();
                $existuser = $this->db->get_where(db_prefix() . 'contacts', array('email' => $data['email'],'role'=>2))->row('email');
                if($existuser != '')
                {
                    $msg = _l('Email is already exist');
                    $status = false;
                }
                else
                {
                    $data['clo_id'] = get_client_user_id();
                    $id = $this->clients_model->add($data);
                    if($id!='')
                    {
                        $message   = 'Caring Approach : Your Email Address is register as a client. Your Email Address is '.$data['email'].' And Password is '.$data['password'];
                        $sub = 'Client Registration';
                        $data['msg'] = $message;
                        $tempmsg = $this->load->view('emailtemp', $data, true);
                        send_mail($data['email'], $sub, $tempmsg);
                    }

                    if($_FILES['profile_image']['name'] != '')
                    {
                        $uploadedFiles = handle_file_upload($id,'profile_image', 'profile_image');
                        if ($uploadedFiles && is_array($uploadedFiles)) {
                            foreach ($uploadedFiles as $file) {
                                $this->misc_model->add_attachment_to_database($id, 'profile_image', [$file]);
                            }
                        }
                    }

                    $this->db->insert(db_prefix() . 'form_allot', [
                        'client_id'    => $id,
                        'form_id' => 1,
                        'created_date' => YMD_date(),
                    ]);

                    $msg = _l('added_successfully', _l('client'));
                    $status = true;
                }                    
            } 
            $responce = array(
                    'success' => $status,
                    'message'=> $msg
                );
            echo json_encode($responce);
        }
    }

    /* Function: State List */
    public function getEndTime()
    {
        $profileResult = [];
        $time_from = $_POST['time_from'];
        $profileResult = $this->db->get_where(db_prefix().'timeslot', array('time_from >' => $time_from))->result();
        echo json_encode($profileResult);
    }

    /* Function: State List */
    public function getEndTimeRoaster()
    {
        $profileResult = [];
        $time_from = $_POST['time_from'];
        $profileResult = $this->db->get_where(db_prefix().'timeslot', array('time_from >' => $time_from))->result();
        echo json_encode($profileResult);
    }
    
    /* Function: State List */
    public function getStatelist()
    {
        $profileResult = [];
        $country = $_POST['country'];
        $profileResult = $this->db->get_where(db_prefix().'state', array('country_id' => $country,'is_active' => 1))->result();
        echo json_encode($profileResult);
    }
    
    /* Function: City List */
    public function getCitylist()
    {
        $profileResult = [];
        $state = $_POST['state'];
        $profileResult = $this->db->get_where(db_prefix().'city', array('state_id' => $state))->result();
        echo json_encode($profileResult);
    }
    
    /* Function: City List */
    public function getFormType()
    {
        $profileResult = [];
        $client_id = $_POST['client_id'];

        $allform = $this->db->select('*')->get_where('tblservice_form')->result_array();
        $alloted_res = $this->db->select('form_id')->get_where('tblform_allot', array('client_id' => $client_id))->result_array();
        foreach ($alloted_res as $value) {
            $alloted_result[] = $value['form_id'];  
        }
        if($allform)
        {
            foreach($allform as $rrr)
            {
                if(!in_array($rrr['id'],$alloted_result))
                {
                    $datasend['id'] = $rrr['id'];
                    $datasend['name'] = $rrr['name'];
                    $final[] = $datasend;
                }
            }
        }


        
        echo json_encode($final);
    }

    /** --------------------------------
    *   @ Function: Invoice change status
    -----------------------------------*/
    public function changeInvoiceStatus($id, $status)
    {
        if($status == 1)
            $data['status'] = 'PAID';
        else
            $data['status'] = 'UNPAID';
        $this->db->where('id', $id);
        $this->db->update(db_prefix().'roster_invoice', $data);
        echo 1;
    }

    /* Add new article or edit existing*/
    public function createRoster($id = '')
    {
        $status = '';
        $msg = '';
        if ($this->input->post()) {
            $data                = $this->input->post();
            if ($id == '') {
                if(count($data['staff_id'] > 0))
                {
                    for($m = 0; $m <= count($data['staff_id']); $m++)
                    {
                        $adddata['created_date'] = date('Y-m-d H:i:s');
                        $adddata['added_by'] = 1;
                        $adddata['added_by_id'] =get_client_user_id();
                        $adddata['client_id'] = $data['clientid'];
                        $adddata['staff_id'] = $data['staff_id'][$m];
                        $adddata['start_date'] = date('Y-m-d', strtotime($data['start_date']));
                        $adddata['end_date'] = date('Y-m-d', strtotime($data['end_date']));
                        $adddata['time_from'] = $data['start_time'];
                        $adddata['time_to'] = $data['end_time'];
                        $adddata['service_id'] = $data['service_id'];
                        $adddata['description'] = $data['description'];                        
                        $id = $this->roster_model->add_article($adddata);
                    }
                    if ($id) {
                        $msg = _l('added_successfully', _l('Roster'));
                        $status = true;
                    }
                }
                else
                {
                    $data['added_by'] = 1;
                    
                    $data['start_date'] = date('Y-m-d', strtotime($data['start_date']));
                    $data['end_date'] = date('Y-m-d', strtotime($data['end_date']));
                    $data['added_by_id'] =get_client_user_id();
                    $data['created_date'] = date('Y-m-d H:i:s');
                    $data['client_id'] = $data['clientid'];
                    $data['service_id'] = $data['service_id'];
                    $data['staff_id'] = get_client_user_id();
                    $id = $this->roster_model->add_article($data);
                    if ($id) {
                        $msg = _l('added_successfully', _l('Roster'));
                        $status = true;
                    }
                }
                    
            } else {

                
                $adddata['start_date'] = date('Y-m-d', strtotime($data['start_date']));
                $adddata['end_date'] = date('Y-m-d', strtotime($data['end_date']));
                $adddata['time_from'] = $data['start_time'];
                $adddata['time_to'] = $data['end_time'];
                $adddata['service_id'] = $data['service_id'];
                $adddata['description'] = $data['description'];      
                $success = $this->roster_model->update_article($adddata, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('Roster')));
                }
                //redirect(base_url('clients/profile/'.$id));
                $msg = _l('updated_successfully', _l('Roster'));
                $status = true;
            }

            $responce = array(
                    'success' => $status,
                    'message'=> $msg
                );
            echo json_encode($responce);
        }            
    }

    /* Add new article or edit existing*/
    public function createAppointment($id = '')
    {
        $status = '';
        $msg = '';
        if ($this->input->post()) {
            $data                = $this->input->post();
            if ($id == '') {
                    $data['start_date'] = date('Y-m-d', strtotime($data['start_date']));
                    $data['end_date'] = date('Y-m-d', strtotime($data['end_date']));
                    $data['created_date'] = date('Y-m-d H:i:s');
                    $data['client_id'] = $data['client_id'];
                    $data['added_by_id'] = get_client_user_id();
                    $data['added_by'] = 1;
                    $id = $this->appointment_model->add_article($data);
                    if ($id) {
                        $msg = _l('added_successfully', _l('Appointment'));
                        $status = true;
                    }
                
                    
            } else {

                $adddata['start_date'] = date('Y-m-d', strtotime($data['start_date']));
                $adddata['end_date'] = date('Y-m-d', strtotime($data['end_date']));
                $adddata['start_time'] = $data['start_time'];
                $adddata['end_time'] = $data['end_time'];
                $adddata['title'] = $data['title'];      
                $adddata['frequency'] = $data['frequency'];      
                $adddata['description'] = $data['description'];      
                $success = $this->appointment_model->update_article($adddata, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('Appointment')));
                }
                //redirect(base_url('clients/profile/'.$id));
                $msg = _l('updated_successfully', _l('Appointment'));
                $status = true;
            }

            $responce = array(
                    'success' => $status,
                    'message'=> $msg
                );
            echo json_encode($responce);
        }            
    }
 /* Add new article or edit existing*/
    public function createServiceAgreements($id = '')
    {
        $status = '';
        $msg = '';
        if ($this->input->post()) {
            $data                = $this->input->post();
            
            if ($id == '') 
            {
                  $rowResult = $this->db->get_where(db_prefix().'form_allot', array('client_id' => $data['client_id'],'form_id' => $data['form_id']))->row();
                  
                  if(count($rowResult)==0)
                  {
                    $dataForm['created_date'] = date('Y-m-d H:i:s');
                    $dataForm['client_id'] = $data['client_id'];
                    $dataForm['form_id'] = $data['form_id'];
                    $this->db->insert(db_prefix().'form_allot', $dataForm);
                    $id = $this->db->insert_id();
                    if ($id) 
                    {
                        $msg = _l('added_successfully', _l('Service Agreements'));
                        $status = true;
                    }

                  }
                  else
                  {
                    $msg = _l('This Form Already Alloted');
                    $status = false;

                  }
                
                   
                    
            } 
            $responce = array(
                    'success' => $status,
                    'message'=> $msg
                );
            echo json_encode($responce);
        }            
    }

    /**
    *   @function: setTime
    */
    public function setTime()
    {
        $calstatus = $this->db->get_where(db_prefix().'user_calendar', array('userid' => get_client_user_id()))->num_rows();
        if($calstatus == 0)
        {
            $data['userid'] = get_client_user_id();
            $data['setTime'] = implode(',',$_POST['setTime']);
            $this->db->insert(db_prefix().'user_calendar', $data);
            set_alert('success', _l('Availability time add successful'));
            redirect(site_url('clients/profile'));
        }
        else
        {
            $data['setTime'] = implode(',',$_POST['setTime']);
            $this->db->where('userid', get_client_user_id());
            $this->db->update(db_prefix().'user_calendar', $data);
            set_alert('success', _l('Availability time update successful'));
            redirect(site_url('clients/profile'));
        }
    }
    
    public function client()
    {
        $data['title']         = _l('Clients');
        //$data['announcements'] = $this->announcements_model->get();
        $this->data($data);
        $this->view('client');
        $this->layout();
    }
    
    public function appointmens()
    {
        $data['title']         = _l('Appointmens');
        //$data['announcements'] = $this->announcements_model->get();
        $this->data($data);
        $this->view('appointmens');
        $this->layout();
    }   
    
    /* updateDoc */
    public function updateDoc($id)
    {
        if($id)
        {
            if($this->input->post())
            {
                $postdata = $this->input->post();
                $this->db->insert(db_prefix().'property_doc', $postdata);
                $did = $this->db->insert_id();
                if($did)
                {
                    /*
                    $uploadedFiles = handle_task_attachments_array($did,'propertydoc');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($did, 'propertydoc', [$file]);
                        }
                    }
                    */
                    set_alert('success', _l('added_successfully', _l('Documents')));
                    redirect(site_url('clients/addListing/'.$id.'/1'));
                }
                else
                {
                    set_alert('warning', _l('Some error occurred'));
                    redirect(site_url('clients/addListing/'.$id));
                }
            }
            else
            {
                set_alert('warning', _l('Some error occurred'));
                redirect(site_url('clients/addListing/'.$id));
            }
        }
        else
        {
            set_alert('warning', _l('Some error occurred'));
            redirect(site_url('clients/addListing/'.$id));
        }
    }
    
    public function addListing($id = '')
    {
        /*
        $userlisting = $this->db->get_where(db_prefix().'contacts', array('userid' => get_client_user_id()))->row('property_limit');
        if($userlisting == '' || $userlisting == 0)
        {
            $this->session->set_flashdata('success', 'Select Any Subscription.');
            redirect('/payment', 'refresh');
        }
        */
        if($this->input->post())
        {
            $data              = $this->input->post();
            $data['amenities'] = implode(',',$data['amenities']);
            $data['agent_id']  = get_client_user_id();
            $data['active_date'] = getDateDMYOnly($data['active_date']);
            if($id == '')
            {
                if (isset($data['timeSlot'])) {
                    $pdata['timeSlot'] = $data['timeSlot'];
                    unset($data['timeSlot']);
                }
                if (isset($data['setDay'])) {
                    $pdata['setDay'] = $data['setDay'];
                    unset($data['setDay']);
                }
                if (isset($data['setTime'])) {
                    $pdata['setTime'] = $data['setTime'];
                    unset($data['setTime']);
                }
                
                $id = $this->properties_model->add_article($data);
                if ($id) {
                    
                    if($userlisting != 'unlimit')
                    {
                        $newlimit = $userlisting - 1;
                        $userdata[''] = $newlimit;
                        $userdata['property_limit'] = $newlimit;
                        $this->db->where('userid', get_client_user_id());
                        $this->db->update(db_prefix().'contacts', $userdata);
                        unset($data['timeSlot']);
                        unset($data['setDay']);
                        unset($data['setTime']);
                        $calstatus = $this->db->get_where(db_prefix().'property_calender', array('property_id' => $id))->num_rows();
                        if($calstatus == 0)
                        {
                            $data_['property_id'] = $id;
                            $data_['timeSlot'] = $_POST['timeSlot'];
                            $data_['setDay'] = implode(',',$_POST['setDay']);
                            $data_['setTime'] = implode(',',$_POST['setTime']);
                            $this->db->insert(db_prefix().'property_calender', $data_);
                        }
                        else
                        {
                            $data_['timeSlot'] = $_POST['timeSlot'];
                            $data_['setDay'] = implode(',',$_POST['setDay']);
                            $data_['setTime'] = implode(',',$_POST['setTime']);
                            $this->db->where('property_id', $id);
                            $this->db->update(db_prefix().'property_calender', $data_);
                        }
                    }
                    set_alert('success', _l('added_successfully', _l('Property')));
                    redirect(site_url('clients/addListing/'.$id.'/2'));
                }
                else
                {
                    set_alert('warning', _l('Some error occurred'));
                    redirect(site_url('clients/addListing'));
                }
            }
            else
            {
                $calstatus = $this->db->get_where(db_prefix().'property_calender', array('property_id' => $id))->num_rows();
                if($calstatus == 0)
                {
                    $data_['property_id'] = $id;
                    $data_['timeSlot'] = $_POST['timeSlot'];
                    $data_['setDay'] = implode(',',$_POST['setDay']);
                    $data_['setTime'] = implode(',',$_POST['setTime']);
                    $this->db->insert(db_prefix().'property_calender', $data_);
                }
                else
                {
                    $data_['timeSlot'] = $_POST['timeSlot'];
                    $data_['setDay'] = implode(',',$_POST['setDay']);
                    $data_['setTime'] = implode(',',$_POST['setTime']);
                    $this->db->where('property_id', $id);
                    $this->db->update(db_prefix().'property_calender', $data_);
                }
                
                unset($data['timeSlot']);
                unset($data['setDay']);
                unset($data['setTime']);
                
                $success = $this->properties_model->update_article($data, $id);
                
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('Property')));
                    redirect(site_url('clients/addListing/'.$id.'/2'));
                }
                else
                {
                    set_alert('success', _l('updated_successfully', _l('Property')));
                    //set_alert('warning', _l('Some error occurred'));
                    redirect(site_url('clients/addListing/'.$id));
                }
            }
        }
        else
        {
            if($id)
            {
                $article         = $this->properties_model->get($id);
                $data['article'] = $article;
                $data['document_result'] = $this->db->order_by('id', 'desc')->get_where(db_prefix().'property_doc', array('property_id' => $id))->result(); 
                $data['title']         = _l('Edit Listing');
            }
            else
            {
                $data['title']         = _l('Add Listing');
            }
            $this->data($data);
            $this->view('add-listing');
            $this->layout();
        }
    }
    
    /* Update image */
    public function updateImg($id)
    {
        $id = $this->input->post('id');
        if($id)
        {
            $postdata['defaultimage'] = $this->input->post('defaultimg');
            $this->db->where('id', $id);
            $this->db->update(db_prefix().'property', $postdata);
            if($_FILES['propertyimg']['name'])
            {
                $this->db->where('rel_id', $id);
                $this->db->where('rel_type', 'propertyimg');
                $attachment = $this->db->get(db_prefix() . 'files')->row();
        
                if ($attachment) {
                    if (empty($attachment->external)) {
                        $relPath  = get_upload_path_by_type('propertyimg') . $attachment->rel_id . '/';
                        $fullPath = $relPath . $attachment->file_name;
                        unlink($fullPath);
                    }
        
                    $this->db->where('id', $attachment->id);
                    $this->db->delete(db_prefix() . 'files');
                    if ($this->db->affected_rows() > 0) {
                        $deleted = true;
                    }
        
                }
                
                $uploadedFiles = handle_task_attachments_array($id,'propertyimg');
                if ($uploadedFiles && is_array($uploadedFiles)) {
                    foreach ($uploadedFiles as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'propertyimg', [$file]);
                    }
                }    
            }
            if($_FILES['property1']['name'])
            {
                $attachment = '';
                $this->db->where('rel_id', $id);
                $this->db->where('rel_type', 'property1');
                $attachment = $this->db->get(db_prefix() . 'files')->row();
        
                if ($attachment) {
                    if (empty($attachment->external)) {
                        $relPath  = get_upload_path_by_type('property1') . $attachment->rel_id . '/';
                        $fullPath = $relPath . $attachment->file_name;
                        unlink($fullPath);
                    }
        
                    $this->db->where('id', $attachment->id);
                    $this->db->delete(db_prefix() . 'files');
                    if ($this->db->affected_rows() > 0) {
                        $deleted = true;
                    }
        
                }
                
                $property1 = handle_task_attachments_array($id,'property1');
                if ($property1 && is_array($property1)) {
                    foreach ($property1 as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'property1', [$file]);
                    }
                }   
            }
            if($_FILES['property2']['name'])
            {
                $attachment = '';
                $this->db->where('rel_id', $id);
                $this->db->where('rel_type', 'property2');
                $attachment = $this->db->get(db_prefix() . 'files')->row();
        
                if ($attachment) {
                    if (empty($attachment->external)) {
                        $relPath  = get_upload_path_by_type('property2') . $attachment->rel_id . '/';
                        $fullPath = $relPath . $attachment->file_name;
                        unlink($fullPath);
                    }
        
                    $this->db->where('id', $attachment->id);
                    $this->db->delete(db_prefix() . 'files');
                    if ($this->db->affected_rows() > 0) {
                        $deleted = true;
                    }
        
                }
                
                $property2 = handle_task_attachments_array($id,'property2');
                if ($property2 && is_array($property2)) {
                    foreach ($property2 as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'property2', [$file]);
                    }
                }  
            }
            if($_FILES['property3']['name'])
            {
                $attachment = '';
                $this->db->where('rel_id', $id);
                $this->db->where('rel_type', 'property3');
                $attachment = $this->db->get(db_prefix() . 'files')->row();
        
                if ($attachment) {
                    if (empty($attachment->external)) {
                        $relPath  = get_upload_path_by_type('property3') . $attachment->rel_id . '/';
                        $fullPath = $relPath . $attachment->file_name;
                        unlink($fullPath);
                    }
        
                    $this->db->where('id', $attachment->id);
                    $this->db->delete(db_prefix() . 'files');
                    if ($this->db->affected_rows() > 0) {
                        $deleted = true;
                    }
        
                }
                
                $property3 = handle_task_attachments_array($id,'property3');
                if ($property3 && is_array($property3)) {
                    foreach ($property3 as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'property3', [$file]);
                    }
                }  
            }
            if($_FILES['property4']['name'])
            {
                $attachment = '';
                $this->db->where('rel_id', $id);
                $this->db->where('rel_type', 'property4');
                $attachment = $this->db->get(db_prefix() . 'files')->row();
        
                if ($attachment) {
                    if (empty($attachment->external)) {
                        $relPath  = get_upload_path_by_type('property4') . $attachment->rel_id . '/';
                        $fullPath = $relPath . $attachment->file_name;
                        unlink($fullPath);
                    }
        
                    $this->db->where('id', $attachment->id);
                    $this->db->delete(db_prefix() . 'files');
                    if ($this->db->affected_rows() > 0) {
                        $deleted = true;
                    }
        
                }
                
                $property4 = handle_task_attachments_array($id,'property4');
                if ($property4 && is_array($property4)) {
                    foreach ($property4 as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'property4', [$file]);
                    }
                } 
            }
            if($_FILES['property5']['name'])
            {
                $attachment = '';
                $this->db->where('rel_id', $id);
                $this->db->where('rel_type', 'property5');
                $attachment = $this->db->get(db_prefix() . 'files')->row();
        
                if ($attachment) {
                    if (empty($attachment->external)) {
                        $relPath  = get_upload_path_by_type('property5') . $attachment->rel_id . '/';
                        $fullPath = $relPath . $attachment->file_name;
                        unlink($fullPath);
                    }
        
                    $this->db->where('id', $attachment->id);
                    $this->db->delete(db_prefix() . 'files');
                    if ($this->db->affected_rows() > 0) {
                        $deleted = true;
                    }
                }
                
                $property5 = handle_task_attachments_array($id,'property5');
                if ($property5 && is_array($property5)) {
                    foreach ($property5 as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'property5', [$file]);
                    }
                }
            }
            set_alert('success', _l('updated_successfully', _l('Property images')));
            redirect(site_url('clients/addListing/'.$id.'/3'));
        }
        else
        {
            set_alert('warning', _l('Some error occurred'));
            redirect(site_url('clients/addListing'));
        }
    }
    
    /**
    *   @removeDoc
    */
    public function removeDoc()
    {
        $id = $_POST['id'];
        if($id)
        {
            $this->db->delete(db_prefix().'property_doc', array('id' => $id));
        }
        echo 1;
    }
    
    /**
    *   @Function: distances
    */
    public function distances($id)
    {
        if($this->input->post())
        {
            $postdata = $this->input->post();
            $this->db->where('id', $id);
            $this->db->update(db_prefix().'property', $postdata);
            set_alert('success', _l('updated_successfully', _l('Distances')));
            redirect(site_url('clients/addListing/'.$id));
        }
        else
        {
            set_alert('warning', _l('Some error occurred'));
            redirect(site_url('clients/addListing/'.$id));
        }
    }
    
 
    
    /**
    *   @Function: Filter All Appointments
    **/
    
   
    public function calendar()
    {
        $data['title'] = _l('calendar');
        $this->view('calendar');
        $this->data($data);
        $this->layout();
    }

    public function get_calendar_data()
    {
        $this->load->model('utilities_model');
        $data = $this->utilities_model->get_calendar_data(
            $this->input->get('start'),
            $this->input->get('end'),
            get_user_id_by_contact_id(get_contact_user_id()),
            get_contact_user_id()
        );

        echo json_encode($data);
    }

    public function projects($status = '')
    {
        if (!has_contact_permission('projects')) {
            set_alert('warning', _l('access_denied'));
            redirect(site_url());
        }
        $data['project_statuses'] = $this->projects_model->get_project_statuses();

        $where = 'clientid=' . get_client_user_id();

        if (is_numeric($status)) {
            $where .= ' AND status=' . $this->db->escape_str($status);
        } else {
            $listStatusesIds = [];
            $where .= ' AND status IN (';
            foreach ($data['project_statuses'] as $projectStatus) {
                if (isset($projectStatus['filter_default']) && $projectStatus['filter_default'] == true) {
                    $listStatusesIds[] = $projectStatus['id'];
                    $where .= $this->db->escape_str($projectStatus['id']) . ',';
                }
            }
            $where = rtrim($where, ',');
            $where .= ')';
        }

        $data['list_statuses'] = is_numeric($status) ? [$status] : $listStatusesIds;
        $data['projects']      = $this->projects_model->get('', $where);
        $data['title']         = _l('clients_my_projects');
        $this->data($data);
        $this->view('projects');
        $this->layout();
    }

    public function property($status = '')
    {
        $data['project_statuses'] = $this->projects_model->get_project_statuses();

        $where = 'clientid=' . get_client_user_id();

        if (is_numeric($status)) {
            $where .= ' AND status=' . $this->db->escape_str($status);
        } else {
            $listStatusesIds = [];
            $where .= ' AND status IN (';
            foreach ($data['project_statuses'] as $projectStatus) {
                if (isset($projectStatus['filter_default']) && $projectStatus['filter_default'] == true) {
                    $listStatusesIds[] = $projectStatus['id'];
                    $where .= $this->db->escape_str($projectStatus['id']) . ',';
                }
            }
            $where = rtrim($where, ',');
            $where .= ')';
        }
        $data['agent_property'] = $this->db->order_by('id', 'desc')->get_where(db_prefix().'property', array('agent_id' => get_client_user_id()))->result();
        $data['planlimit'] = $this->db->select('plan_expired,property_limit')->get_where(db_prefix().'contacts', array('userid' => get_client_user_id()))->row();

        $data['list_statuses'] = is_numeric($status) ? [$status] : $listStatusesIds;
        $data['projects']      = $this->projects_model->get('', $where);
        $data['title']         = _l('clients_my_projects');
        $this->data($data);
        $this->view('projects');
        $this->layout();
    }
    
    /**
    *   @Function: active Listing
    **/
    public function activeListing()
    {
        $data['agent_property'] = $this->db->order_by('id', 'desc')->get_where(db_prefix().'property', array('agent_id' => get_client_user_id(), 'status' => 1))->result();
        $data['planlimit'] = $this->db->select('plan_expired,property_limit')->get_where(db_prefix().'contacts', array('userid' => get_client_user_id()))->row();

        $data['title']         = _l('Active Listing');
        $this->data($data);
        $this->view('activeListing');
        $this->layout();
    }

    /**
    *   @Function: Property Active Inactive
    **/
    public function propertyActiveInactive()
    {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $type = '';
        $msg  = '';
        if($status == 1)
        {
            $planlimit = $this->db->select('plan_expired,property_limit')->get_where(db_prefix().'contacts', array('userid' => get_client_user_id()))->row();
            if($planlimit)
            {
                if($planlimit->plan_expired > time())
                {
                    $activeproperty = $this->db->get_where(db_prefix().'property', array('agent_id' => get_client_user_id(), 'status' => 1))->num_rows();
                    if($planlimit->property_limit > $activeproperty)
                    {
                        $postdata['status'] = 1;
                        $this->db->where('id', $id);
                        $this->db->where('agent_id', get_client_user_id());
                        $this->db->update(db_prefix().'property', $postdata);
                        $type = 'success';
                        $msg  = 'Property active successfully!';
                    }
                    else
                    {
                        $type = 'error';
                        $msg  = 'You have reached the maximum active listings for your subscription. Please deactivate one of your listings, or upgrade your account by clicking on Subscription';
                    }
                }
                else
                {
                    $type = 'error';
                    $msg  = 'Your subscription is expired';
                }
            }
        }
        else
        {
            $postdata['status'] = 0;
            $this->db->where('id', $id);
            $this->db->where('agent_id', get_client_user_id());
            $this->db->update(db_prefix().'property', $postdata);
            $type = 'success';
            $msg  = 'Property inactive successfully!';
        }
            
        $responce = array(
                'status' => $type,
                'msg'    => $msg
            );
        echo json_encode($responce);
    }

    /**
    *   Function@: filterProperty
    */
    public function filterProperty()
    {
        $type = $_POST['val'];
        $result = [];
        if($type == '')
        {
            $data['agent_property'] = $this->db->order_by('id', 'desc')->get_where(db_prefix().'property', array('agent_id' => get_client_user_id()))->result();
            $result = $this->load->view('themes/perfex/views/filterProperty', $data, true);
        }
        else{
            if($type == 2)
            {
                $type = 0;
            }
            $data['agent_property'] = $this->db->order_by('id', 'desc')->get_where(db_prefix().'property', array('agent_id' => get_client_user_id(), 'status' => $type))->result();
            $result = $this->load->view('themes/perfex/views/filterProperty', $data, true);
        }
        $status = 'success';
        $msg  = '';
        
        $responce = array(
                'status' => $status,
                'msg'    => $msg,
                'result' => $result
            );
        echo json_encode($responce);
    }

    public function project($id)
    {
        if (!has_contact_permission('projects')) {
            set_alert('warning', _l('access_denied'));
            redirect(site_url());
        }

        $project = $this->projects_model->get($id, [
            'clientid' => get_client_user_id(),
        ]);

        if (!$project) {
            show_404();
        }

        $data['project']                               = $project;
        $data['project']->settings->available_features = unserialize($data['project']->settings->available_features);

        $data['title'] = $data['project']->name;
        if ($this->input->post('action')) {
            $action = $this->input->post('action');

            switch ($action) {
                  case 'new_task':
                  case 'edit_task':

                    $data    = $this->input->post();
                    $task_id = false;
                    if (isset($data['task_id'])) {
                        $task_id = $data['task_id'];
                        unset($data['task_id']);
                    }

                    $data['rel_type']    = 'project';
                    $data['rel_id']      = $project->id;
                    $data['description'] = nl2br($data['description']);

                    $assignees = isset($data['assignees']) ? $data['assignees'] : [];
                    if (isset($data['assignees'])) {
                        unset($data['assignees']);
                    }
                    unset($data['action']);

                    if (!$task_id) {
                        $task_id = $this->tasks_model->add($data, true);
                        if ($task_id) {
                            foreach ($assignees as $assignee) {
                                $this->tasks_model->add_task_assignees(['taskid' => $task_id, 'assignee' => $assignee], false, true);
                            }
                            $uploadedFiles = handle_task_attachments_array($task_id);
                            if ($uploadedFiles && is_array($uploadedFiles)) {
                                foreach ($uploadedFiles as $file) {
                                    $file['contact_id'] = get_contact_user_id();
                                    $this->misc_model->add_attachment_to_database($task_id, 'task', [$file]);
                                }
                            }
                            set_alert('success', _l('added_successfully', _l('task')));
                            redirect(site_url('clients/project/' . $project->id . '?group=project_tasks&taskid=' . $task_id));
                        }
                    } else {
                        if ($project->settings->edit_tasks == 1
                            && total_rows(db_prefix() . 'tasks', ['is_added_from_contact' => 1, 'addedfrom' => get_contact_user_id()]) > 0) {
                            $affectedRows = 0;
                            $updated      = $this->tasks_model->update($data, $task_id, true);
                            if ($updated) {
                                $affectedRows++;
                            }

                            $currentAssignees    = $this->tasks_model->get_task_assignees($task_id);
                            $currentAssigneesIds = [];
                            foreach ($currentAssignees as $assigned) {
                                array_push($currentAssigneesIds, $assigned['assigneeid']);
                            }

                            $totalAssignees = count($assignees);

                            /**
                             * In case when contact created the task and then was able to view team members
                             * Now in this case he still can view team members and can edit them
                             */
                            if ($totalAssignees == 0 && $project->settings->view_team_members == 1) {
                                $this->db->where('taskid', $task_id);
                                $this->db->delete(db_prefix() . 'task_assigned');
                            } elseif ($totalAssignees > 0 && $project->settings->view_team_members == 1) {
                                foreach ($currentAssignees as $assigned) {
                                    if (!in_array($assigned['assigneeid'], $assignees)) {
                                        if ($this->tasks_model->remove_assignee($assigned['id'], $task_id)) {
                                            $affectedRows++;
                                        }
                                    }
                                }
                                foreach ($assignees as $assignee) {
                                    if (!$this->tasks_model->is_task_assignee($assignee, $task_id)) {
                                        if ($this->tasks_model->add_task_assignees(['taskid' => $task_id, 'assignee' => $assignee], false, true)) {
                                            $affectedRows++;
                                        }
                                    }
                                }
                            }
                            if ($affectedRows > 0) {
                                set_alert('success', _l('updated_successfully', _l('task')));
                            }
                            redirect(site_url('clients/project/' . $project->id . '?group=project_tasks&taskid=' . $task_id));
                        }
                    }

                    redirect(site_url('clients/project/' . $project->id . '?group=project_tasks'));

                    break;
                case 'discussion_comments':
                    echo json_encode($this->projects_model->get_discussion_comments($this->input->post('discussion_id'), $this->input->post('discussion_type')));
                    die;
                case 'new_discussion_comment':
                    echo json_encode($this->projects_model->add_discussion_comment($this->input->post(), $this->input->post('discussion_id'), $this->input->post('discussion_type')));
                    die;

                    break;
                case 'update_discussion_comment':
                    echo json_encode($this->projects_model->update_discussion_comment($this->input->post(), $this->input->post('discussion_id')));
                    die;

                    break;
                case 'delete_discussion_comment':
                    echo json_encode($this->projects_model->delete_discussion_comment($this->input->post('id')));
                    die;

                    break;
                case 'new_discussion':
                    $discussion_data = $this->input->post();
                    unset($discussion_data['action']);
                    $success = $this->projects_model->add_discussion($discussion_data);
                    if ($success) {
                        set_alert('success', _l('added_successfully', _l('project_discussion')));
                    }
                    redirect(site_url('clients/project/' . $id . '?group=project_discussions'));

                    break;
                case 'upload_file':
                    handle_project_file_uploads($id);
                    die;

                    break;
                case 'project_file_dropbox': // deprecated
                case 'project_external_file':
                        $data                        = [];
                        $data['project_id']          = $id;
                        $data['files']               = $this->input->post('files');
                        $data['external']            = $this->input->post('external');
                        $data['visible_to_customer'] = 1;
                        $data['contact_id']          = get_contact_user_id();
                        $this->projects_model->add_external_file($data);
                die;

                break;
                case 'get_file':
                    $file_data['discussion_user_profile_image_url'] = contact_profile_image_url(get_contact_user_id());
                    $file_data['current_user_is_admin']             = false;
                    $file_data['file']                              = $this->projects_model->get_file($this->input->post('id'), $this->input->post('project_id'));

                    if (!$file_data['file']) {
                        header('HTTP/1.0 404 Not Found');
                        die;
                    }
                    echo get_template_part('projects/file', $file_data, true);
                    die;

                    break;
                case 'update_file_data':
                    $file_data = $this->input->post();
                    unset($file_data['action']);
                    $this->projects_model->update_file_data($file_data);

                    break;
                case 'upload_task_file':
                    $taskid = $this->input->post('task_id');
                    $files  = handle_task_attachments_array($taskid, 'file');
                    if ($files) {
                        $i   = 0;
                        $len = count($files);
                        foreach ($files as $file) {
                            $file['contact_id'] = get_contact_user_id();
                            $file['staffid']    = 0;
                            $this->tasks_model->add_attachment_to_database($taskid, [$file], false, ($i == $len - 1 ? true : false));
                            $i++;
                        }
                    }
                    die;

                    break;
                case 'add_task_external_file':
                    $taskid                = $this->input->post('task_id');
                    $file                  = $this->input->post('files');
                    $file[0]['contact_id'] = get_contact_user_id();
                    $file[0]['staffid']    = 0;
                    $this->tasks_model->add_attachment_to_database($this->input->post('task_id'), $file, $this->input->post('external'));
                    die;

                    break;
                case 'new_task_comment':
                    $comment_data            = $this->input->post();
                    $comment_data['content'] = nl2br($comment_data['content']);
                    $comment_id              = $this->tasks_model->add_task_comment($comment_data);
                    $url                     = site_url('clients/project/' . $id . '?group=project_tasks&taskid=' . $comment_data['taskid']);

                    if ($comment_id) {
                        set_alert('success', _l('task_comment_added'));
                        $url .= '#comment_' . $comment_id;
                    }

                    redirect($url);

                    break;
                default:
                    redirect(site_url('clients/project/' . $id));

                    break;
            }
        }
        if (!$this->input->get('group')) {
            $group = 'project_overview';
        } else {
            $group = $this->input->get('group');
        }
        $data['project_status'] = get_project_status_by_id($data['project']->status);
        if ($group != 'edit_task') {
            if ($group == 'project_overview') {
                $percent          = $this->projects_model->calc_progress($id);
                @$data['percent'] = $percent / 100;
                $this->load->helper('date');
                $data['project_total_days']        = round((human_to_unix($data['project']->deadline . ' 00:00') - human_to_unix($data['project']->start_date . ' 00:00')) / 3600 / 24);
                $data['project_days_left']         = $data['project_total_days'];
                $data['project_time_left_percent'] = 100;
                if ($data['project']->deadline) {
                    if (human_to_unix($data['project']->start_date . ' 00:00') < time() && human_to_unix($data['project']->deadline . ' 00:00') > time()) {
                        $data['project_days_left'] = round((human_to_unix($data['project']->deadline . ' 00:00') - time()) / 3600 / 24);

                        $data['project_time_left_percent'] = $data['project_days_left'] / $data['project_total_days'] * 100;
                        $data['project_time_left_percent'] = round($data['project_time_left_percent'], 2);
                    }
                    if (human_to_unix($data['project']->deadline . ' 00:00') < time()) {
                        $data['project_days_left']         = 0;
                        $data['project_time_left_percent'] = 0;
                    }
                }
                $total_tasks = total_rows(db_prefix() . 'tasks', [
                    'rel_id'            => $id,
                    'rel_type'          => 'project',
                    'visible_to_client' => 1,
                ]);
                $total_tasks = hooks()->apply_filters('client_project_total_tasks', $total_tasks, $id);

                $data['tasks_not_completed'] = total_rows(db_prefix() . 'tasks', [
                'status !='         => 5,
                'rel_id'            => $id,
                'rel_type'          => 'project',
                'visible_to_client' => 1,
            ]);

                $data['tasks_not_completed'] = hooks()->apply_filters('client_project_tasks_not_completed', $data['tasks_not_completed'], $id);

                $data['tasks_completed'] = total_rows(db_prefix() . 'tasks', [
                'status'            => 5,
                'rel_id'            => $id,
                'rel_type'          => 'project',
                'visible_to_client' => 1,
            ]);
                $data['tasks_completed'] = hooks()->apply_filters('client_project_tasks_completed', $data['tasks_completed'], $id);

                $data['total_tasks']                  = $total_tasks;
                $data['tasks_not_completed_progress'] = ($total_tasks > 0 ? number_format(($data['tasks_completed'] * 100) / $total_tasks, 2) : 0);
                $data['tasks_not_completed_progress'] = round($data['tasks_not_completed_progress'], 2);
            } elseif ($group == 'new_task') {
                if ($project->settings->create_tasks == 0) {
                    redirect(site_url('clients/project/' . $project->id));
                }
                $data['milestones'] = $this->projects_model->get_milestones($id);
            } elseif ($group == 'project_gantt') {
                $data['gantt_data'] = $this->projects_model->get_gantt_data($id);
            } elseif ($group == 'project_discussions') {
                if ($this->input->get('discussion_id')) {
                    $data['discussion_user_profile_image_url'] = contact_profile_image_url(get_contact_user_id());
                    $data['discussion']                        = $this->projects_model->get_discussion($this->input->get('discussion_id'), $id);
                    $data['current_user_is_admin']             = false;
                }
                $data['discussions'] = $this->projects_model->get_discussions($id);
            } elseif ($group == 'project_files') {
                $data['files'] = $this->projects_model->get_files($id);
            } elseif ($group == 'project_tasks') {
                $data['tasks_statuses'] = $this->tasks_model->get_statuses();
                $data['project_tasks']  = $this->projects_model->get_tasks($id);
            } elseif ($group == 'project_activity') {
                $data['activity'] = $this->projects_model->get_activity($id);
            } elseif ($group == 'project_milestones') {
                $data['milestones'] = $this->projects_model->get_milestones($id);
            } elseif ($group == 'project_invoices') {
                $data['invoices'] = [];
                if (has_contact_permission('invoices')) {
                    $whereInvoices = [
                            'clientid'   => get_client_user_id(),
                            'project_id' => $id,
                        ];
                    if (get_option('exclude_invoice_from_client_area_with_draft_status') == 1) {
                        $whereInvoices['status !='] = 6;
                    }
                    $data['invoices'] = $this->invoices_model->get('', $whereInvoices);
                }
            } elseif ($group == 'project_tickets') {
                $data['tickets'] = [];
                if (has_contact_permission('support')) {
                    $where_tickets = [
                        db_prefix() . 'tickets.userid' => get_client_user_id(),
                        'project_id'                   => $id,
                    ];

                    if (!!can_logged_in_contact_view_all_tickets()) {
                        $where_tickets[db_prefix() . 'tickets.contactid'] = get_contact_user_id();
                    }

                    $data['tickets']                 = $this->tickets_clo_model->get('', $where_tickets);
                    $data['show_submitter_on_table'] = show_ticket_submitter_on_clients_area_table();
                }
            } elseif ($group == 'project_estimates') {
                $data['estimates'] = [];
                if (has_contact_permission('estimates')) {
                    $data['estimates'] = $this->estimates_model->get('', [
                            'clientid'   => get_client_user_id(),
                            'project_id' => $id,
                        ]);
                }
            } elseif ($group == 'project_timesheets') {
                $data['timesheets'] = $this->projects_model->get_timesheets($id);
            }

            if ($this->input->get('taskid')) {
                $data['view_task'] = $this->tasks_model->get($this->input->get('taskid'), [
                    'rel_id'   => $project->id,
                    'rel_type' => 'project',
                ]);

                $data['title'] = $data['view_task']->name;
            }
        } elseif ($group == 'edit_task') {
            $data['milestones'] = $this->projects_model->get_milestones($id);
            $data['task']       = $this->tasks_model->get($this->input->get('taskid'), [
                    'rel_id'                => $project->id,
                    'rel_type'              => 'project',
                    'addedfrom'             => get_contact_user_id(),
                    'is_added_from_contact' => 1,
                ]);
        }

        $data['group']    = $group;
        $data['currency'] = $this->projects_model->get_currency($id);
        $data['members']  = $this->projects_model->get_project_members($id);

        $this->data($data);
        $this->view('project');
        $this->layout();
    }

    public function download_all_project_files($id)
    {
        if (!has_contact_permission('projects')) {
            set_alert('warning', _l('access_denied'));
            redirect(site_url());
        }

        $files = $this->projects_model->get_files($id);

        if (count($files) == 0) {
            set_alert('warning', _l('no_files_found'));
            redirect(site_url('clients/project/' . $id . '?group=project_files'));
        }

        $path = get_upload_path_by_type('project') . $id;
        $this->load->library('zip');

        foreach ($files as $file) {
            $this->zip->read_file($path . '/' . $file['file_name']);
        }

        $this->zip->download(slug_it(get_project_name_by_id($id)) . '-files.zip');
        $this->zip->clear_data();
    }

    public function files()
    {
        $files_where = 'visible_to_customer = 1 AND id IN (SELECT file_id FROM ' . db_prefix() . 'shared_customer_files WHERE contact_id =' . get_contact_user_id() . ')';

        $files_where = hooks()->apply_filters('customers_area_files_where', $files_where);

        $files = $this->clients_model->get_customer_files(get_client_user_id(), $files_where);

        $data['files'] = $files;
        $data['title'] = _l('customer_attachments');
        $this->data($data);
        $this->view('files');
        $this->layout();
    }

    public function upload_files()
    {
        $success = false;
        if ($this->input->post('external')) {
            $file                        = $this->input->post('files');
            $file[0]['staffid']          = 0;
            $file[0]['contact_id']       = get_contact_user_id();
            $file['visible_to_customer'] = 1;
            $success                     = $this->misc_model->add_attachment_to_database(
                get_client_user_id(),
                'customer',
                $file,
                $this->input->post('external')
            );
        } else {
            $success = handle_client_attachments_upload(get_client_user_id(), true);
        }

        if ($success) {
            $this->clients_model->send_notification_customer_profile_file_uploaded_to_responsible_staff(
                get_contact_user_id(),
                get_client_user_id()
            );
        }
    }

    public function delete_file($id, $type = '')
    {
        if (get_option('allow_contact_to_delete_files') == 1) {
            if ($type == 'general') {
                $file = $this->misc_model->get_file($id);
                if ($file->contact_id == get_contact_user_id()) {
                    $this->clients_model->delete_attachment($id);
                    set_alert('success', _l('deleted', _l('file')));
                }
                redirect(site_url('clients/files'));
            } elseif ($type == 'project') {
                $this->load->model('projects_model');
                $file = $this->projects_model->get_file($id);
                if ($file->contact_id == get_contact_user_id()) {
                    $this->projects_model->remove_file($id);
                    set_alert('success', _l('deleted', _l('file')));
                }
                redirect(site_url('clients/project/' . $file->project_id . '?group=project_files'));
            } elseif ($type == 'task') {
                $file = $this->misc_model->get_file($id);
                if ($file->contact_id == get_contact_user_id()) {
                    $this->tasks_model->remove_task_attachment($id);
                    set_alert('success', _l('deleted', _l('file')));
                }
                redirect(site_url('clients/project/' . $this->input->get('project_id') . '?group=project_tasks&taskid=' . $file->rel_id));
            }
        }
        redirect(site_url());
    }

    public function remove_task_comment($id)
    {
        echo json_encode([
            'success' => $this->tasks_model->remove_comment($id),
        ]);
    }

    public function edit_comment()
    {
        if ($this->input->post()) {
            $data            = $this->input->post();
            $data['content'] = nl2br($data['content']);
            $success         = $this->tasks_model->edit_comment($data);
            if ($success) {
                set_alert('success', _l('task_comment_updated'));
            }
            echo json_encode([
                'success' => $success,
            ]);
        }
    }

    public function tickets($status = '')
    {
        /*
        if (!has_contact_permission('support')) {
            set_alert('warning', _l('access_denied'));
            redirect(site_url());
        }
        */

        // $where = db_prefix() . 'tickets.userid=' . get_client_user_id();
        $where = db_prefix() . 'tickets.contactid=' . get_client_user_id();
        if (!can_logged_in_contact_view_all_tickets()) {
            $where;
        }

        $data['show_submitter_on_table'] = show_ticket_submitter_on_clients_area_table();

        $defaultStatuses = hooks()->apply_filters('customers_area_list_default_ticket_statuses', [1, 2, 3, 4]);
        // By default only open tickets
        if (!is_numeric($status)) {
            $where .= ' AND status IN (' . implode(', ', $defaultStatuses) . ')';
        } else {
            $where .= ' AND status=' . $this->db->escape_str($status);
        }


        $data['list_statuses'] = is_numeric($status) ? [$status] : $defaultStatuses;
        $data['bodyclass']     = 'tickets';
        $data['tickets']       = $this->tickets_clo_model->get('', $where);
        $data['title']         = _l('clients_tickets_heading');
        $this->data($data);
        $this->view('tickets');
        $this->layout();
    }

    public function change_ticket_status()
    {
        if (has_contact_permission('support')) {
            $post_data = $this->input->post();
            if (can_change_ticket_status_in_clients_area($post_data['status_id'])) {
                $response = $this->tickets_clo_model->change_ticket_status($post_data['ticket_id'], $post_data['status_id']);
                set_alert($response['alert'], $response['message']);
            }
        }
    }

    public function proposals()
    {
        if (!has_contact_permission('proposals')) {
            set_alert('warning', _l('access_denied'));
            redirect(site_url());
        }

        $where = 'rel_id =' . get_client_user_id() . ' AND rel_type ="customer"';

        if (get_option('exclude_proposal_from_client_area_with_draft_status') == 1) {
            $where .= ' AND status != 6';
        }

        $client = $this->clients_model->get(get_client_user_id());

        if (!is_null($client->leadid)) {
            $where .= ' OR rel_type="lead" AND rel_id=' . $client->leadid;
        }

        $data['proposals'] = $this->proposals_model->get('', $where);
        $data['title']     = _l('proposals');
        $this->data($data);
        $this->view('proposals');
        $this->layout();
    }

    public function open_ticket()
    {
        /*
        if (!has_contact_permission('support')) {
            set_alert('warning', _l('access_denied'));
            redirect(site_url());
        }
        */
        if ($this->input->post()) {
            $this->form_validation->set_rules('subject', _l('customer_ticket_subject'), 'required');
            $this->form_validation->set_rules('department', _l('clients_ticket_open_departments'), 'required');
            $this->form_validation->set_rules('priority', _l('priority'), 'required');
            $custom_fields = get_custom_fields('tickets', [
                'show_on_client_portal' => 1,
                'required'              => 1,
            ]);
            foreach ($custom_fields as $field) {
                $field_name = 'custom_fields[' . $field['fieldto'] . '][' . $field['id'] . ']';
                if ($field['type'] == 'checkbox' || $field['type'] == 'multiselect') {
                    $field_name .= '[]';
                }
                $this->form_validation->set_rules($field_name, $field['name'], 'required');
            }
            if ($this->form_validation->run() !== false) {
                $data = $this->input->post();

                $id = $this->tickets_clo_model->add([
                    'subject'    => $data['subject'],
                    'department' => $data['department'],
                    'priority'   => $data['priority'],
                    'service'    => isset($data['service']) && is_numeric($data['service'])
                    ? $data['service']
                    : null,
                    'project_id' => isset($data['project_id']) && is_numeric($data['project_id'])
                    ? $data['project_id']
                    : 0,
                    'custom_fields' => isset($data['custom_fields']) && is_array($data['custom_fields'])
                    ? $data['custom_fields']
                    : [],
                    'message'   => $data['message'],
                    'contactid' => get_contact_user_id(),
                    'userid'    => get_client_user_id(),
                ]);

                if ($id) {
                    set_alert('success', _l('new_ticket_added_successfully', $id));
                    redirect(site_url('clients/ticket/' . $id));
                }
            }
        }
        $data             = [];
        $data['projects'] = $this->projects_model->get_projects_for_ticket(get_client_user_id());
        $data['title']    = _l('new_ticket');
        $this->data($data);
        $this->view('open_ticket');
        $this->layout();
    }

    public function ticket($id)
    {
        // if (!has_contact_permission('support')) {
        //     set_alert('warning', _l('access_denied'));
        //     redirect(site_url());
        // }

        if (!$id) {
            redirect(site_url());
        }

        $data['ticket'] = $this->tickets_clo_model->get_ticket_by_id($id, get_client_user_id());
        if (!$data['ticket'] || $data['ticket']->contactid != get_client_user_id()) {
            show_404();
        }
        $data['statuses'] = $this->tickets_model->get_ticket_status();

        if ($this->input->post()) {
            $this->form_validation->set_rules('message', _l('ticket_reply'), 'required');

            if ($this->form_validation->run() !== false) {
                $data = $this->input->post();

                $replyid = $this->tickets_clo_model->add_reply([
                    'message'   => $data['message'],
                    'contactid' => get_client_user_id(),
                    'userid'    =>0,
                ], $id);
                if ($replyid) {

                    $contactdata = $this->db->get_where(db_prefix().'tickets', array('ticketid'=>$id))->row();

                    $useremail = $this->db->get_where(db_prefix().'contacts', array('userid'=>$contactdata->userid))->row('email');

                    $conatctemail = $this->db->get_where(db_prefix().'contacts', array('userid'=>$contactdata->contactid))->row('email');

                       

                    $message1   = 'Caring Approach : Support Ticket';
                    $message1   .= '<br>Subject : '.$contactdata->subject;
                    $message1   .= '<br>Message : '.$data['message'];
                    $message1   .= '<br>Contact Name : '.clientname($contactdata->contactid);
                    $message1   .= '<br>Department : '.supportDepartment($contactdata->department);
                    $message1   .= '<br>Priority : '.supportPriorities($contactdata->priority);
                    $message1   .= '<br>Status : '.supportStatus($contactdata->status);
                    $message1   .= '<br>Date : '.getDateTimeDMYOnly(date('Y-m-d H:i:s'));

                    
                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'ticket_attachments', array('replyid'=>$replyid))->row('file_name');
                    $filepathh = base_url().'uploads/ticket_attachments/'.$id.'/'.$filename;
                        
                  

                    if($filename!='')
                    {
                        
                            
                        $message1   .= "<br>Document: <br> <div class='d-flex align-items-center'><a href=".$filepathh." target='_blank' ><img width='50px' src='".base_url()."/assets/images/pdf.png' alt='Avatar' class='rounded mr-1' />".$filename."</a></div>";
                        
                    }
                    
                    $sub1 = 'Request From Client Liaison Office -Support Ticket';
                    $data['msg'] = $message1;
                    $tempmsg = $this->load->view('emailtemp', $data, true);

                    send_mail($useremail, $sub1, $tempmsg);
                // send_mail('pooja@immersiveinfotech.com', $sub1, $tempmsg);
                    send_mail($conatctemail, $sub1, $tempmsg);


                    set_alert('success', _l('replied_to_ticket_successfully', $id));
                }
                redirect(site_url('clients/ticket/' . $id));
            }
        }

        $data['ticket_replies'] = $this->tickets_clo_model->get_ticket_replies($id);
        $data['title']          = $data['ticket']->subject;
        $this->data($data);
        $this->view('single_ticket');
        $this->layout();
    }

     public function change_status_ajax($id, $status)
    {
        $this->db->where('ticketid', $id);
        $this->db->update(db_prefix() . 'tickets', [
            'status' => $status,
        ]);
        if ($this->db->affected_rows() > 0) {
            echo 1;
            
        }
        else
        {
           echo 0;
        }

    }

    public function contracts()
    {
        if (!has_contact_permission('contracts')) {
            set_alert('warning', _l('access_denied'));
            redirect(site_url());
        }
        $data['contracts'] = $this->contracts_model->get('', [
            'client'                => get_client_user_id(),
            'not_visible_to_client' => 0,
            'trash'                 => 0,
        ]);

        $data['contracts_by_type_chart'] = json_encode($this->contracts_model->get_contracts_types_chart_data());
        $data['title']                   = _l('clients_contracts');
        $this->data($data);
        $this->view('contracts');
        $this->layout();
    }

    /**
    *   @Function: transaction
    */
    public function transaction()
    {
        $transactionList = $this->db->get_where(db_prefix().'transaction', array('userid' => get_client_user_id()))->result();
        $data['transactionList'] = $transactionList;
        $data['title']                   = _l('Transaction');
        $this->data($data);
        $this->view('transaction');
        $this->layout();
    }
    
    /**
    *   @Function: subscription
    */
    public function subscription()
    {
        $planid = $this->db->select('plan_id,property_limit,plan_expired')->get_where(db_prefix().'contacts', array('userid' => get_client_user_id()))->row();
        $subscription = $this->db->get_where(db_prefix().'subscription', array('id' => $planid->plan_id))->row();
        $data['subscription'] = $subscription;
        $data['property_limit'] = ($planid->property_limit != '')?$planid->property_limit:0;
        $data['expired_date'] = $planid->plan_expired; 
        $data['title']                   = _l('Subscription');
        $this->data($data);
        $this->view('subscription');
        $this->layout();
    }

    public function invoices($status = false)
    {
        if (!has_contact_permission('invoices')) {
            set_alert('warning', _l('access_denied'));
            redirect(site_url());
        }

        $where = [
            'clientid' => get_client_user_id(),
        ];

        if (is_numeric($status)) {
            $where['status'] = $status;
        }

        if (isset($where['status'])) {
            if ($where['status'] == Invoices_model::STATUS_DRAFT
                && get_option('exclude_invoice_from_client_area_with_draft_status') == 1) {
                unset($where['status']);
                $where['status !='] = Invoices_model::STATUS_DRAFT;
            }
        } else {
            if (get_option('exclude_invoice_from_client_area_with_draft_status') == 1) {
                $where['status !='] = Invoices_model::STATUS_DRAFT;
            }
        }

        $data['invoices'] = $this->invoices_model->get('', $where);
        $data['title']    = _l('clients_my_invoices');
        $this->data($data);
        $this->view('invoices');
        $this->layout();
    }

    public function statement()
    {
        if (!has_contact_permission('invoices')) {
            set_alert('warning', _l('access_denied'));
            redirect(site_url());
        }

        $data = [];
        // Default to this month
        $from = _d(date('Y-m-01'));
        $to   = _d(date('Y-m-t'));

        if ($this->input->get('from') && $this->input->get('to')) {
            $from = $this->input->get('from');
            $to   = $this->input->get('to');
        }

        $data['statement'] = $this->clients_model->get_statement(get_client_user_id(), to_sql_date($from), to_sql_date($to));

        $data['from'] = $from;
        $data['to']   = $to;

        $data['period_today'] = json_encode(
                     [
                     _d(date('Y-m-d')),
                     _d(date('Y-m-d')),
                     ]
        );
        $data['period_this_week'] = json_encode(
                     [
                     _d(date('Y-m-d', strtotime('monday this week'))),
                     _d(date('Y-m-d', strtotime('sunday this week'))),
                     ]
        );
        $data['period_this_month'] = json_encode(
                     [
                     _d(date('Y-m-01')),
                     _d(date('Y-m-t')),
                     ]
        );

        $data['period_last_month'] = json_encode(
                     [
                     _d(date('Y-m-01', strtotime('-1 MONTH'))),
                     _d(date('Y-m-t', strtotime('-1 MONTH'))),
                     ]
        );

        $data['period_this_year'] = json_encode(
                     [
                     _d(date('Y-m-d', strtotime(date('Y-01-01')))),
                     _d(date('Y-m-d', strtotime(date('Y-12-31')))),
                     ]
        );
        $data['period_last_year'] = json_encode(
                     [
                     _d(date('Y-m-d', strtotime(date(date('Y', strtotime('last year')) . '-01-01')))),
                     _d(date('Y-m-d', strtotime(date(date('Y', strtotime('last year')) . '-12-31')))),
                     ]
        );

        $data['period_selected'] = json_encode([$from, $to]);

        $data['custom_period'] = ($this->input->get('custom_period') ? true : false);

        $data['title'] = _l('customer_statement');
        $this->data($data);
        $this->view('statement');
        $this->layout();
    }

    public function statement_pdf()
    {
        if (!has_contact_permission('invoices')) {
            set_alert('warning', _l('access_denied'));
            redirect(site_url());
        }

        $from = $this->input->get('from');
        $to   = $this->input->get('to');

        $data['statement'] = $this->clients_model->get_statement(
            get_client_user_id(),
            to_sql_date($from),
            to_sql_date($to)
        );

        try {
            $pdf = statement_pdf($data['statement']);
        } catch (Exception $e) {
            echo $e->getMessage();
            die;
        }

        $type = 'D';
        if ($this->input->get('print')) {
            $type = 'I';
        }

        $pdf_name = slug_it(_l('customer_statement') . '_' . get_option('companyname'));
        $pdf->Output($pdf_name . '.pdf', $type);
    }

    public function estimates($status = '')
    {
        if (!has_contact_permission('estimates')) {
            set_alert('warning', _l('access_denied'));
            redirect(site_url());
        }
        $where = [
            'clientid' => get_client_user_id(),
        ];
        if (is_numeric($status)) {
            $where['status'] = $status;
        }
        if (isset($where['status'])) {
            if ($where['status'] == 1 && get_option('exclude_estimate_from_client_area_with_draft_status') == 1) {
                unset($where['status']);
                $where['status !='] = 1;
            }
        } else {
            if (get_option('exclude_estimate_from_client_area_with_draft_status') == 1) {
                $where['status !='] = 1;
            }
        }
        $data['estimates'] = $this->estimates_model->get('', $where);
        $data['title']     = _l('clients_my_estimates');
        $this->data($data);
        $this->view('estimates');
        $this->layout();
    }

    public function company()
    {
        if ($this->input->post() && is_primary_contact()) {
            if (get_option('company_is_required') == 1) {
                $this->form_validation->set_rules('company', _l('clients_company'), 'required');
            }

            if (active_clients_theme() == 'perfex') {
                // Fix for custom fields checkboxes validation
                $this->form_validation->set_rules('company_form', '', 'required');
            }

            $custom_fields = get_custom_fields('customers', [
                'show_on_client_portal'  => 1,
                'required'               => 1,
                'disalow_client_to_edit' => 0,
            ]);

            foreach ($custom_fields as $field) {
                $field_name = 'custom_fields[' . $field['fieldto'] . '][' . $field['id'] . ']';
                if ($field['type'] == 'checkbox' || $field['type'] == 'multiselect') {
                    $field_name .= '[]';
                }
                $this->form_validation->set_rules($field_name, $field['name'], 'required');
            }

            if ($this->form_validation->run() !== false) {
                $data['company'] = $this->input->post('company');

                if (!is_null($this->input->post('vat'))) {
                    $data['vat'] = $this->input->post('vat');
                }

                if (!is_null($this->input->post('default_language'))) {
                    $data['default_language'] = $this->input->post('default_language');
                }

                if (!is_null($this->input->post('custom_fields'))) {
                    $data['custom_fields'] = $this->input->post('custom_fields');
                }

                $data['phonenumber'] = $this->input->post('phonenumber');
                $data['website']     = $this->input->post('website');
                $data['country']     = $this->input->post('country');
                $data['city']        = $this->input->post('city');
                $data['address']     = $this->input->post('address');
                $data['zip']         = $this->input->post('zip');
                $data['state']       = $this->input->post('state');

                if (get_option('allow_primary_contact_to_view_edit_billing_and_shipping') == 1
                    && is_primary_contact()) {

                    // Dynamically get the billing and shipping values from $_POST
                    for ($i = 0; $i < 2; $i++) {
                        $prefix = ($i == 0 ? 'billing_' : 'shipping_');
                        foreach (['street', 'city', 'state', 'zip', 'country'] as $field) {
                            $data[$prefix . $field] = $this->input->post($prefix . $field);
                        }
                    }
                }

                $success = $this->clients_model->update_company_details($data, get_client_user_id());
                if ($success == true) {
                    set_alert('success', _l('clients_profile_updated'));
                }

                redirect(site_url('clients/company'));
            }
        }
        $data['title'] = _l('client_company_info');
        $this->data($data);
        $this->view('company_profile');
        $this->layout();
    }

    public function profile($uid = '')
    {
        if ($this->input->post('profile')) {
            $this->form_validation->set_rules('firstname', _l('client_firstname'), 'required');
            $this->form_validation->set_rules('lastname', _l('client_lastname'), 'required');
            $this->form_validation->set_rules('brokerage', _l('Brokerage'), 'required');
            $this->form_validation->set_rules('agent_city', _l('City'), 'required');
            $this->form_validation->set_rules('agent_state', _l('State'), 'required');
            $this->form_validation->set_rules('license', _l('License'), 'required');

            $this->form_validation->set_message('contact_email_profile_unique', _l('form_validation_is_unique'));
            $this->form_validation->set_rules('email', _l('clients_email'), 'required|valid_email|callback_contact_email_profile_unique');

            $custom_fields = get_custom_fields('contacts', [
                'show_on_client_portal'  => 1,
                'required'               => 1,
                'disalow_client_to_edit' => 0,
            ]);
            foreach ($custom_fields as $field) {
                $field_name = 'custom_fields[' . $field['fieldto'] . '][' . $field['id'] . ']';
                if ($field['type'] == 'checkbox' || $field['type'] == 'multiselect') {
                    $field_name .= '[]';
                }
                $this->form_validation->set_rules($field_name, $field['name'], 'required');
            }
            if ($this->form_validation->run() !== false) {
                handle_contact_profile_image_upload();

                $data = $this->input->post();

                $contact = $this->clients_model->get_contact(get_contact_user_id());

                if (has_contact_permission('invoices')) {
                    $data['invoice_emails']     = isset($data['invoice_emails']) ? 1 : 0;
                    $data['credit_note_emails'] = isset($data['credit_note_emails']) ? 1 : 0;
                } else {
                    $data['invoice_emails']     = $contact->invoice_emails;
                    $data['credit_note_emails'] = $contact->credit_note_emails;
                }

                if (has_contact_permission('estimates')) {
                    $data['estimate_emails'] = isset($data['estimate_emails']) ? 1 : 0;
                } else {
                    $data['estimate_emails'] = $contact->estimate_emails;
                }

                if (has_contact_permission('support')) {
                    $data['ticket_emails'] = isset($data['ticket_emails']) ? 1 : 0;
                } else {
                    $data['ticket_emails'] = $contact->ticket_emails;
                }

                if (has_contact_permission('contracts')) {
                    $data['contract_emails'] = isset($data['contract_emails']) ? 1 : 0;
                } else {
                    $data['contract_emails'] = $contact->contract_emails;
                }

                if (has_contact_permission('projects')) {
                    $data['project_emails'] = isset($data['project_emails']) ? 1 : 0;
                    $data['task_emails']    = isset($data['task_emails']) ? 1 : 0;
                } else {
                    $data['project_emails'] = $contact->project_emails;
                    $data['task_emails']    = $contact->task_emails;
                }

                $success = $this->clients_model->update_contact([
                    'firstname'          => $this->input->post('firstname'),
                    'lastname'           => $this->input->post('lastname'),
                    'title'              => $this->input->post('title'),
                    'email'              => $this->input->post('email'),
                    'phonenumber'        => $this->input->post('phonenumber'),
                    'direction'          => $this->input->post('direction'),
                    'license'            => $this->input->post('license'),
                    'agent_state'        => $this->input->post('agent_state'),
                    'agent_city'         => $this->input->post('agent_city'),
                    'brokerage'          => $this->input->post('brokerage'),
                    'brokerage'          => $this->input->post('brokerage'),
                    'user_timezone'      => $this->input->post('user_timezone'),
                    'invoice_emails'     => $data['invoice_emails'],
                    'credit_note_emails' => $data['credit_note_emails'],
                    'estimate_emails'    => $data['estimate_emails'],
                    'ticket_emails'      => $data['ticket_emails'],
                    'contract_emails'    => $data['contract_emails'],
                    'project_emails'     => $data['project_emails'],
                    'task_emails'        => $data['task_emails'],
                    'custom_fields'      => isset($data['custom_fields']) && is_array($data['custom_fields']) ? $data['custom_fields'] : [],
                ], get_contact_user_id(), true);

                if ($success == true) {
                    set_alert('success', _l('clients_profile_updated'));
                }

                redirect(site_url('clients/profile'));
            }
        } elseif ($this->input->post('change_password')) {
            $this->form_validation->set_rules('oldpassword', _l('clients_edit_profile_old_password'), 'required');
            $this->form_validation->set_rules('newpassword', _l('clients_edit_profile_new_password'), 'required');
            $this->form_validation->set_rules('newpasswordr', _l('clients_edit_profile_new_password_repeat'), 'required|matches[newpassword]');
            if ($this->form_validation->run() !== false) {
                $success = $this->clients_model->change_contact_password(
                    get_contact_user_id(),
                    $this->input->post('oldpassword', false),
                    $this->input->post('newpasswordr', false)
                );

                if (is_array($success) && isset($success['old_password_not_match'])) {
                    set_alert('danger', _l('client_old_password_incorrect'));
                } elseif ($success == true) {
                    set_alert('success', _l('client_password_changed'));
                }

                redirect(site_url('clients/profile'));
            }
        }
        $data['client_data'] = $this->db->get_where(db_prefix().'contacts', array('userid' => $uid))->row();
        $data['client_id_encrypt'] = base64_encode($uid);
        $setTime = $this->db->get_where(db_prefix().'user_calendar', array('userid' => get_client_user_id()))->row('setTime');
        $data['setTime'] = $setTime;
        $data['title'] = _l('clients_profile_heading');
        $this->data($data);
        $this->view('profile');
        $this->layout();
    }


    public function profiles()
    {
        if ($this->input->post('profile')) {
            $this->form_validation->set_rules('firstname', _l('client_firstname'), 'required');
            $this->form_validation->set_rules('lastname', _l('client_lastname'), 'required');
            $this->form_validation->set_rules('phonenumber', _l('Phonenumber'), 'required');
            $this->form_validation->set_rules('dob', _l('Date Of Birth'), 'required');
            // $this->form_validation->set_rules('department_id', _l('Department'), 'required');
            $this->form_validation->set_rules('address', _l('Address'), 'required');
            $this->form_validation->set_rules('country', _l('Country'), 'required');
            $this->form_validation->set_rules('state', _l('State'), 'required');
            $this->form_validation->set_rules('city', _l('City'), 'required');
            $this->form_validation->set_rules('postal_code', _l('Postal Code'), 'required');

            // $this->form_validation->set_message('contact_email_profile_unique', _l('form_validation_is_unique'));
            // $this->form_validation->set_rules('email', _l('clients_email'), 'required|valid_email|callback_contact_email_profile_unique');

            $custom_fields = get_custom_fields('contacts', [
                'show_on_client_portal'  => 1,
                'required'               => 1,
                'disalow_client_to_edit' => 0,
            ]);
            foreach ($custom_fields as $field) {
                $field_name = 'custom_fields[' . $field['fieldto'] . '][' . $field['id'] . ']';
                if ($field['type'] == 'checkbox' || $field['type'] == 'multiselect') {
                    $field_name .= '[]';
                }
                $this->form_validation->set_rules($field_name, $field['name'], 'required');
            }
            if ($this->form_validation->run() !== false) {
                

                $data = $this->input->post();

                $contact = $this->clients_model->get_contact(get_contact_user_id());

                if (has_contact_permission('invoices')) {
                    $data['invoice_emails']     = isset($data['invoice_emails']) ? 1 : 0;
                    $data['credit_note_emails'] = isset($data['credit_note_emails']) ? 1 : 0;
                } else {
                    $data['invoice_emails']     = $contact->invoice_emails;
                    $data['credit_note_emails'] = $contact->credit_note_emails;
                }

                if (has_contact_permission('estimates')) {
                    $data['estimate_emails'] = isset($data['estimate_emails']) ? 1 : 0;
                } else {
                    $data['estimate_emails'] = $contact->estimate_emails;
                }

                if (has_contact_permission('support')) {
                    $data['ticket_emails'] = isset($data['ticket_emails']) ? 1 : 0;
                } else {
                    $data['ticket_emails'] = $contact->ticket_emails;
                }

                if (has_contact_permission('contracts')) {
                    $data['contract_emails'] = isset($data['contract_emails']) ? 1 : 0;
                } else {
                    $data['contract_emails'] = $contact->contract_emails;
                }

                if (has_contact_permission('projects')) {
                    $data['project_emails'] = isset($data['project_emails']) ? 1 : 0;
                    $data['task_emails']    = isset($data['task_emails']) ? 1 : 0;
                } else {
                    $data['project_emails'] = $contact->project_emails;
                    $data['task_emails']    = $contact->task_emails;
                }

                $success = $this->clients_model->update_contact([
                    'firstname'             => $this->input->post('firstname'),
                    'lastname'              => $this->input->post('lastname'),
                    'phonenumber'           => $this->input->post('phonenumber'),
                    'dob'                   => date('Y-m-d', strtotime($this->input->post('dob'))),
                    'department_id'         => implode(',', $this->input->post('department_id')),
                    'address'               => $this->input->post('address'),
                    'country'               => $this->input->post('country'),
                    'state'                 => $this->input->post('state'),
                    'city'                  => $this->input->post('city'),
                    'postal_code'           => $this->input->post('postal_code'),
                    'invoice_emails'     => $data['invoice_emails'],
                    'credit_note_emails' => $data['credit_note_emails'],
                    'estimate_emails'    => $data['estimate_emails'],
                    'ticket_emails'      => $data['ticket_emails'],
                    'contract_emails'    => $data['contract_emails'],
                    'project_emails'     => $data['project_emails'],
                    'task_emails'        => $data['task_emails'],
                    'custom_fields'      => isset($data['custom_fields']) && is_array($data['custom_fields']) ? $data['custom_fields'] : [],
                ], get_contact_user_id(), true);

                    $clientdata['company'] = $this->input->post('firstname').' '.$this->input->post('lastname');
                    $clientdata['phonenumber'] = $this->input->post('phonenumber');
                    $clientdata['address'] = $this->input->post('address');
                    $clientdata['country'] = $this->input->post('country');
                    $clientdata['city'] = $this->input->post('city');
                    $clientdata['zip'] = $this->input->post('postal_code');
                    $clientdata['state'] = $this->input->post('state');

                    $this->db->where('userid', get_client_user_id());
                    $this->db->update(db_prefix() . 'clients', $clientdata);


                    if($_FILES['profile_image']['name'] != '')
                    {
                        $uploadedFiles = handle_file_upload(get_client_user_id(),'profile_image', 'profile_image');
                        if ($uploadedFiles && is_array($uploadedFiles)) {
                            foreach ($uploadedFiles as $file) {
                                $this->misc_model->add_attachment_to_database(get_client_user_id(), 'profile_image', [$file]);
                            }
                        }
                        $success= true;
                    }

                if ($success == true) 
                {

                    //set_alert('success', _l('clients_profile_updated'));
                    $this->session->set_flashdata('success',_l('clients_profile_updated'));

                }

                redirect(site_url('clients/profiles'));
            }
            
        } 
        elseif ($this->input->post('change_password')) {
            $this->form_validation->set_rules('oldpassword', _l('clients_edit_profile_old_password'), 'required');
            $this->form_validation->set_rules('newpassword', _l('clients_edit_profile_new_password'), 'required');
            $this->form_validation->set_rules('newpasswordr', _l('clients_edit_profile_new_password_repeat'), 'required|matches[newpassword]');
            if ($this->form_validation->run() !== false) {
                $success = $this->clients_model->change_contact_password(
                    get_contact_user_id(),
                    $this->input->post('oldpassword', false),
                    $this->input->post('newpasswordr', false)
                );
                 

                if (is_array($success) && isset($success['old_password_not_match'])) {
                   
                    $this->session->set_flashdata('error',_l('client_old_password_incorrect'));
                    // set_alert('danger', _l('client_old_password_incorrect'));
                } elseif ($success == true) {
                    $this->session->set_flashdata('success',_l('client_password_changed'));
                    // set_alert('success', _l('client_password_changed'));
                }

                redirect(site_url('clients/profiles'));
            }
        }

        $data['client_data'] = $this->db->get_where(db_prefix().'contacts', array('userid' => get_client_user_id()))->row();
        $data['title'] = _l('clients_profile_heading');
        $this->data($data);
        $this->view('profiles');
        $this->layout();
    }

    public function remove_profile_image()
    {
        $id = get_contact_user_id();

        hooks()->do_action('before_remove_contact_profile_image', $id);

        if (file_exists(get_upload_path_by_type('contact_profile_images') . $id)) {
            delete_dir(get_upload_path_by_type('contact_profile_images') . $id);
        }

        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'contacts', [
            'profile_image' => null,
        ]);

        if ($this->db->affected_rows() > 0) {
            redirect(site_url('clients/profile'));
        }
    }

    public function dismiss_announcement($id)
    {
        $this->misc_model->dismiss_announcement($id, false);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_credit_card()
    {
        if (!can_logged_in_contact_update_credit_card()) {
            redirect(site_url());
        }

        $this->load->library('stripe_subscriptions');
        $this->load->library('stripe_core');
        $this->load->model('subscriptions_model');

        $sessionData = [
              'payment_method_types' => ['card'],
              'mode'                 => 'setup',
              'setup_intent_data'    => [
                'metadata' => [
                  'customer_id' => $this->clients_model->get(get_client_user_id())->stripe_id,
                ],
              ],
              'success_url' => site_url('clients/success_update_card?session_id={CHECKOUT_SESSION_ID}'),
              'cancel_url'  => $cancelUrl = site_url('clients/credit_card'),
            ];

        $contact = $this->clients_model->get_contact(get_contact_user_id());

        if ($contact->email) {
            $sessionData['customer_email'] = $contact->email;
        }

        try {
            $session = $this->stripe_core->create_session($sessionData);
            redirect_to_stripe_checkout($session->id);
        } catch (Exception $e) {
            set_alert('warning', $e->getMessage());
            redirect($cancelUrl);
        }
    }

    public function success_update_card()
    {
        if (!can_logged_in_contact_update_credit_card()) {
            redirect(site_url());
        }

        $this->load->library('stripe_core');

        try {
            $session = $this->stripe_core->retrieve_session([
                'id'     => $this->input->get('session_id'),
                'expand' => ['setup_intent.payment_method'],
            ]);

            $session->setup_intent->payment_method->attach(['customer' => $session->setup_intent->metadata->customer_id]);

            $this->stripe_core->update_customer($session->setup_intent->metadata->customer_id, [
                'invoice_settings' => [
                    'default_payment_method' => $session->setup_intent->payment_method->id,
                  ],
              ]);

            set_alert('success', _l('updated_successfully', _l('credit_card')));
        } catch (Exception $e) {
            set_alert('warning', $e->getMessage());
        }

        redirect(site_url('clients/credit_card'));
    }

    public function credit_card()
    {
        if (!can_logged_in_contact_update_credit_card()) {
            redirect(site_url());
        }

        $this->load->library('stripe_core');
        $client = $this->clients_model->get(get_client_user_id());

        $data['stripe_customer'] = $this->stripe_core->get_customer($client->stripe_id);
        $data['payment_method']  = null;

        if (!empty($data['stripe_customer']->invoice_settings->default_payment_method)) {
            $data['payment_method'] = $this->stripe_core->retrieve_payment_method($data['stripe_customer']->invoice_settings->default_payment_method);
        }

        $data['bodyclass'] = 'customer-credit-card';
        $data['title']     = _l('credit_card');

        $this->data($data);
        $this->view('credit_card');
        $this->layout();
    }

    public function delete_credit_card()
    {
        if (customer_can_delete_credit_card()) {
            $client = $this->clients_model->get(get_client_user_id());

            $this->load->library('stripe_core');

            $stripeCustomer = $this->stripe_core->get_customer($client->stripe_id);

            try {
                $payment_method = $this->stripe_core->retrieve_payment_method($stripeCustomer->invoice_settings->default_payment_method);
                $payment_method->detach();

                set_alert('success', _l('credit_card_successfully_deleted'));
            } catch (Exception $e) {
                set_alert('warning', $e->getMessage());
            }
        }

        redirect(site_url('clients/credit_card'));
    }

    public function subscriptions()
    {
        if (!can_logged_in_contact_view_subscriptions()) {
            redirect(site_url());
        }

        $this->load->model('subscriptions_model');
        $data['subscriptions'] = $this->subscriptions_model->get(['clientid' => get_client_user_id()]);

        $data['show_projects'] = total_rows(db_prefix() . 'subscriptions', 'project_id != 0 AND clientid=' . get_client_user_id()) > 0 && has_contact_permission('projects');

        $data['title']     = _l('subscriptions');
        $data['bodyclass'] = 'subscriptions';
        $this->data($data);
        $this->view('subscriptions');
        $this->layout();
    }

    public function cancel_subscription($id)
    {
        if (!is_primary_contact(get_contact_user_id())
            || get_option('show_subscriptions_in_customers_area') != '1') {
            redirect(site_url());
        }

        $this->load->model('subscriptions_model');
        $this->load->library('stripe_subscriptions');
        $subscription = $this->subscriptions_model->get_by_id($id, ['clientid' => get_client_user_id()]);

        if (!$subscription) {
            show_404();
        }

        try {
            $type    = $this->input->get('type');
            $ends_at = time();
            if ($type == 'immediately') {
                $this->stripe_subscriptions->cancel($subscription->stripe_subscription_id);
            } elseif ($type == 'at_period_end') {
                $ends_at = $this->stripe_subscriptions->cancel_at_end_of_billing_period($subscription->stripe_subscription_id);
            } else {
                throw new Exception('Invalid Cancelation Type', 1);
            }

            $update = ['ends_at' => $ends_at];
            if ($type == 'immediately') {
                $update['status'] = 'canceled';
            }
            $this->subscriptions_model->update($id, $update);

            set_alert('success', _l('subscription_canceled'));
        } catch (Exception $e) {
            set_alert('danger', $e->getMessage());
        }

        redirect(site_url('clients/subscriptions'));
    }

    public function resume_subscription($id)
    {
        if (!is_primary_contact(get_contact_user_id())
            || get_option('show_subscriptions_in_customers_area') != '1') {
            redirect(site_url());
        }

        $this->load->model('subscriptions_model');
        $this->load->library('stripe_subscriptions');
        $subscription = $this->subscriptions_model->get_by_id($id, ['clientid' => get_client_user_id()]);

        if (!$subscription) {
            show_404();
        }

        try {
            $this->stripe_subscriptions->resume($subscription->stripe_subscription_id, $subscription->stripe_plan_id);
            $this->subscriptions_model->update($id, ['ends_at' => null]);
            set_alert('success', _l('subscription_resumed'));
        } catch (Exception $e) {
            set_alert('danger', $e->getMessage());
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function gdpr()
    {
        $this->load->model('gdpr_model');

        if (is_gdpr()
            && $this->input->post('removal_request')
            && get_option('gdpr_contact_enable_right_to_be_forgotten') == '1') {
            $success = $this->gdpr_model->add_removal_request([
                'description'  => nl2br($this->input->post('removal_description')),
                'request_from' => get_contact_full_name(get_contact_user_id()),
                'contact_id'   => get_contact_user_id(),
                'clientid'     => get_client_user_id(),
            ]);
            if ($success) {
                send_gdpr_email_template('gdpr_removal_request_by_customer', get_contact_user_id());
                set_alert('success', _l('data_removal_request_sent'));
            }
            redirect(site_url('clients/gdpr'));
        }

        $data['title'] = _l('gdpr');
        $this->data($data);
        $this->view('gdpr');
        $this->layout();
    }

    public function change_language($lang = '')
    {
        if (!can_logged_in_contact_change_language()) {
            redirect(site_url());
        }

        hooks()->do_action('before_customer_change_language', $lang);

        $this->db->where('userid', get_client_user_id());
        $this->db->update(db_prefix() . 'clients', ['default_language' => $lang]);

        if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(site_url());
        }
    }

    public function export()
    {
        if (is_gdpr()
            && get_option('gdpr_data_portability_contacts') == '0'
            || !is_gdpr()) {
            show_error('This page is currently disabled, check back later.');
        }

        $this->load->library('gdpr/gdpr_contact');
        $this->gdpr_contact->export(get_contact_user_id());
    }

    /**
     * Client home chart
     * @return mixed
     */
    public function client_home_chart()
    {
        $statuses = [
                1,
                2,
                4,
                3,
            ];
        $months          = [];
        $months_original = [];
        for ($m = 1; $m <= 12; $m++) {
            array_push($months, _l(date('F', mktime(0, 0, 0, $m, 1))));
            array_push($months_original, date('F', mktime(0, 0, 0, $m, 1)));
        }
        $chart = [
                'labels'   => $months,
                'datasets' => [],
            ];
        foreach ($statuses as $status) {
            $this->db->select('total as amount, date');
            $this->db->from(db_prefix() . 'invoices');
            $this->db->where('clientid', get_client_user_id());
            $this->db->where('status', $status);
            $by_currency = $this->input->post('report_currency');
            if ($by_currency) {
                $this->db->where('currency', $by_currency);
            }
            if ($this->input->post('year')) {
                $this->db->where('YEAR(' . db_prefix() . 'invoices.date)', $this->input->post('year'));
            }
            $payments      = $this->db->get()->result_array();
            $data          = [];
            $data['temp']  = $months_original;
            $data['total'] = [];
            $i             = 0;
            foreach ($months_original as $month) {
                $data['temp'][$i] = [];
                foreach ($payments as $payment) {
                    $_month = date('F', strtotime($payment['date']));
                    if ($_month == $month) {
                        $data['temp'][$i][] = $payment['amount'];
                    }
                }
                $data['total'][] = array_sum($data['temp'][$i]);
                $i++;
            }

            if ($status == 1) {
                $borderColor = '#fc142b';
            } elseif ($status == 2) {
                $borderColor = '#84c529';
            } elseif ($status == 4 || $status == 3) {
                $borderColor = '#ff6f00';
            }

            $backgroundColor = 'rgba(' . implode(',', hex2rgb($borderColor)) . ',0.3)';

            array_push($chart['datasets'], [
                    'label'           => format_invoice_status($status, '', false, true),
                    'backgroundColor' => $backgroundColor,
                    'borderColor'     => $borderColor,
                    'borderWidth'     => 1,
                    'tension'         => false,
                    'data'            => $data['total'],
                ]);
        }
        echo json_encode($chart);
    }

    public function contact_email_profile_unique($email)
    {
        return total_rows(db_prefix() . 'contacts', 'id !=' . get_contact_user_id() . ' AND email="' . get_instance()->db->escape_str($email) . '"') > 0 ? false : true;
    }


     public function addarticle($id = '')

    {
       
        $status = '';
        $msg = '';

        $data = $this->input->post(); 

        if($data['articleid']!='')
        {
            if($this->input->post('description_edit_tips')!='')
            {
                $data['description']   =   $this->input->post('description_edit_tips');
                unset($data['description_edit_tips']);
            }
            else
            {
                $data['description']   =   $this->input->post('description_edit');
                unset($data['description_edit']);
            }
            $data['article'] = $this->knowledge_base_model->update_article($data, $data['articleid']);

            if($_FILES['knowledge_base']['name'] != '')
            {
                $this->knowledge_base_model->delete_image($data['articleid']);
                $uploadedFiles = handle_file_upload($data['articleid'],'knowledge_base', 'knowledge_base');
                if ($uploadedFiles && is_array($uploadedFiles)) {
                    foreach ($uploadedFiles as $file) {
                        $this->misc_model->add_attachment_to_database($data['articleid'], 'knowledge_base', [$file]);
                    }
                }
            } 
            $msg = _l('updated_successfully', _l('Article'));
        }
        else
        {
            if($this->input->post('description_new')!='')
            {
                $data['description']   =   $this->input->post('description_new');
                unset($data['description_new']);
            }
            else
            {
                $data['description']   =   $this->input->post('description_tips');
                unset($data['description_tips']);
            }
            $articleid = $this->knowledge_base_model->add_article($data);
            if ($articleid) {
                    $uploadedFiles = handle_file_upload($articleid,'knowledge_base', 'knowledge_base');
                    // print_r($uploadedFiles); die;
                    if ($uploadedFiles && is_array($uploadedFiles)) {               
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($articleid, 'knowledge_base', [$file]);
                        }
                    }
                    $msg = _l('added_successfully', _l('Article'));
                }
            
        }

        
        $status = true;

        $responce = array(
                    'success' => $status,
                    'message'=> $msg
                );


        echo json_encode($responce);

    }


}
