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
    *@function User multiple address add
    *-------------------------------------------------------------------*/
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

    /*-------------------------------------------------------------------
    *@function User multiple address add
    *-------------------------------------------------------------------*/
    public function addReport()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        if($postData['report_for'] != '')
        {
           
            $contactData['report_for'] = $postData['report_for'];
            // Person Details
            $contactData['pc_name'] = $postData['pc_name'];
            $contactData['pc_phone'] = $postData['pc_phone'];
            $contactData['pc_mobile'] = $postData['pc_mobile'];
            $contactData['pc_email'] = $postData['pc_email'];
            $contactData['ca_worker'] = $postData['ca_worker'];
            $contactData['ca_worker_title'] = $postData['ca_worker_title'];

            // Client’s Contact Details 
            $contactData['ccd_name'] = $postData['ccd_name'];
            $contactData['ccd_phone'] = $postData['ccd_phone'];
            $contactData['ccd_mobile'] = $postData['ccd_mobile'];
            $contactData['ccd_address'] = $postData['ccd_address'];


            $contactData['date_report_submitted'] = $postData['date_report_submitted'];
            $contactData['report_submitted_to'] = $postData['report_submitted_to'];

            // Hazard/Accident/Incident Details
             $contactData['accident_location'] = $postData['accident_location'];
             $contactData['accident_date'] = $postData['accident_date'];
             $contactData['accident_time'] = $postData['accident_time'];
             $contactData['accident_address'] = $postData['accident_address'];

            // Details of people involved in the accident/incident (including witnesses present)

             $contactData['pic'] = $postData['pic'];
             $contactData['pic_name'] = $postData['pic_name'];
             $contactData['pic_conatct'] = $postData['pic_conatct'];
             $contactData['pic_address'] = $postData['pic_address'];


             $contactData['piw'] = $postData['piw'];
             $contactData['piw_name'] = $postData['piw_name'];
             $contactData['piw_conatct'] = $postData['piw_conatct'];
             $contactData['piw_address'] = $postData['piw_address'];


             $contactData['pio'] = $postData['pio'];
             $contactData['pio_name'] = $postData['pio_name'];
             $contactData['pio_conatct'] = $postData['pio_conatct'];
             $contactData['pio_address'] = $postData['pio_address'];


             $contactData['piwi'] = $postData['piwi'];
             $contactData['piwi_name'] = $postData['piwi_name'];
             $contactData['piwi_conatct'] = $postData['piwi_conatct'];
             $contactData['piwi_address'] = $postData['piwi_address'];


             $contactData['incident_details'] = $postData['incident_details'];
             $contactData['hazard_category'] = $postData['hazard_category'];
             $contactData['injury_occurred'] = $postData['injury_occurred'];

             // If YES , injury occurred provide details
             $contactData['who_is_injured'] = $postData['who_is_injured'];
             $contactData['injured_body'] = $postData['injured_body'];

             // first_aid
             $contactData['fag'] = $postData['fag'];
             $contactData['fag_time'] = $postData['fag_time'];
             $contactData['fag_description'] = $postData['fag_description'];
             $contactData['fag_by_whom'] = $postData['fag_by_whom'];
             $contactData['fag_referral'] = $postData['fag_referral'];
             $contactData['fag_specify'] = $postData['fag_specify'];
             $contactData['possible_solution'] = $postData['possible_solution'];

             //Action Plan (what needs to be done and who will fix the issue)
             $contactData['ap_action_needed'] = $postData['ap_action_needed'];
             $contactData['ap_by_when'] = $postData['ap_by_when'];
             $contactData['ap_by_whom'] = $postData['ap_by_whom'];
             $contactData['ap_review_date'] = $postData['ap_review_date'];
             $contactData['ap_signature'] = $postData['ap_signature'];

             // Signature of person completing this report  
             $contactData['spcr_signature'] = $postData['spcr_signature'];
             $contactData['spcr_name'] = $postData['spcr_name'];
             $contactData['spcr_date'] = $postData['spcr_date'];

             // Office use only
             $contactData['ou_date'] = $postData['ou_date'];
             $contactData['ou_by'] = $postData['ou_by'];
             $contactData['ou_job_title'] = $postData['ou_job_title'];


             // To be completed by: Manager Health, Safety & Risk for further investigation and recording

             // Investigation completed   
             $contactData['ic_action'] = $postData['ic_action'];
             $contactData['ic_date'] = $postData['ic_date'];
             $contactData['ic_report_no'] = $postData['ic_report_no'];
             $contactData['ic_comment'] = $postData['ic_comment'];

             // CEO informed  
             $contactData['ci_action'] = $postData['ci_action'];
             $contactData['ci_date'] = $postData['ci_date'];
             $contactData['ci_report_no'] = $postData['ci_report_no'];
             $contactData['ci_comment'] = $postData['ci_comment'];

             // Issues resolved  
             $contactData['ir_action'] = $postData['ir_action'];
             $contactData['ir_date'] = $postData['ir_date'];
             $contactData['ir_report_no'] = $postData['ir_report_no'];
             $contactData['ir_comment'] = $postData['ir_comment'];

             //  All internal stakeholders informed 
             $contactData['isi_action'] = $postData['isi_action'];
             $contactData['isi_date'] = $postData['isi_date'];
             $contactData['isi_report_no'] = $postData['isi_report_no'];
             $contactData['isi_comment'] = $postData['isi_comment'];

             //  Reported to NDIS /Aged Care Quality
             $contactData['acq_action'] = $postData['acq_action'];
             $contactData['acq_date'] = $postData['acq_date'];
             $contactData['acq_report_no'] = $postData['acq_report_no'];
             $contactData['acq_comment'] = $postData['acq_comment'];

             //  Reported to police
             $contactData['rtp_action'] = $postData['rtp_action'];
             $contactData['rtp_date'] = $postData['rtp_date'];
             $contactData['rtp_report_no'] = $postData['rtp_report_no'];
             $contactData['rtp_comment'] = $postData['rtp_comment'];


             // If Injury has occurred to the worker    
             $contactData['injury_claim_form'] = $postData['injury_claim_form'];
             $contactData['insurance_nsw_notified'] = $postData['insurance_nsw_notified'];
             $contactData['workcover_nsw_notified'] = $postData['workcover_nsw_notified'];
             $contactData['incident_comp_database'] = $postData['incident_comp_database'];
             $contactData['client_telephone_followup'] = $postData['client_telephone_followup'];
             $contactData['staff_telephone_followup'] = $postData['staff_telephone_followup'];
             $contactData['staff_investigation'] = $postData['staff_investigation'];
             $contactData['management_investigation'] = $postData['management_investigation'];



             //  Monitoring /Follow up Notes $ Comments/Recommendations
             $contactData['monitoring_note'] = $postData['monitoring_note'];
             $contactData['recommendations'] = $postData['recommendations'];

             // Completed By
             $contactData['cb_name'] = $postData['cb_name'];
             $contactData['cb_position'] = $postData['cb_position'];
             $contactData['cb_date'] = $postData['cb_date'];
             $contactData['cb_signature'] = $postData['cb_signature'];


            $contactData['created_date'] = date('Y-m-d H:i:s');
            $this->db->insert(db_prefix().'report', $contactData);
            $lid = $this->db->insert_id();
            if($lid)
            {
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
	

    /*-------------------------------------------------------------------
    *@function User multiple address add
    *-------------------------------------------------------------------*/
    public function addEmployee()
    {
        $postData = array_merge($_POST,json_decode(file_get_contents('php://input'),true));
        
        if($postData['referred_by'] != '')
        {

           // Employee Personal Details
            $contactData['referred_by'] = $postData['referred_by'];
            $contactData['referred_name'] = $postData['referred_name'];
            $contactData['existing_employment'] = $postData['existing_employment'];
            $contactData['existing_company_name'] = $postData['existing_company_name'];
            $contactData['pd_gender'] = $postData['pd_gender'];
            $contactData['pd_dob'] = $postData['pd_dob'];
            $contactData['pd_surname'] = $postData['pd_surname'];
            $contactData['pd_name'] = $postData['pd_name'];
            $contactData['pd_mobile'] = $postData['pd_mobile'];
            $contactData['pd_phone'] = $postData['pd_phone'];
            $contactData['pd_address'] = $postData['pd_address'];
            $contactData['pd_suburb'] = $postData['pd_suburb'];
            $contactData['pd_postcode'] = $postData['pd_postcode'];
            $contactData['pd_email'] = $postData['pd_email'];
           
           // Emergency Contact Details
            $contactData['ecd_name'] = $postData['ecd_name'];
            $contactData['ecd_phone'] = $postData['ecd_phone'];
            $contactData['ecd_address'] = $postData['ecd_address'];
            $contactData['ecd_mobile'] = $postData['ecd_mobile'];
            $contactData['ecd_suburb'] = $postData['ecd_suburb'];
            $contactData['ecd_postcode'] = $postData['ecd_postcode'];
            $contactData['ecd_relationship'] = $postData['ecd_relationship'];
           
           // Employee Banking Details
            $contactData['ebd_bank'] = $postData['ebd_bank'];
            $contactData['ebd_branch'] = $postData['ebd_branch'];
            $contactData['ebd_account_name'] = $postData['ebd_account_name'];
            $contactData['ebd_bsb'] = $postData['ebd_bsb'];
            $contactData['ebd_account_no'] = $postData['ebd_account_no'];     
           // Employee Fitness For Work
            $contactData['efw_injury'] = $postData['efw_injury'];
            $contactData['efw_detail'] = $postData['efw_detail'];
            $contactData['efw_signature'] = $postData['efw_signature'];
            $contactData['efw_date'] = $postData['efw_date'];
           
           // Completed By
            $contactData['cb_name'] = $postData['cb_name'];
            $contactData['cb_date'] = $postData['cb_date'];
            $contactData['cb_position'] = $postData['cb_position'];
            $contactData['cb_qualifications'] = $postData['cb_qualifications'];
            $contactData['cb_pay_point'] = $postData['cb_pay_point'];
            $contactData['cb_start_date'] = $postData['cb_start_date'];
           
           // Circle Uniform Required: Nursing Shift
            $contactData['cur_women'] = $postData['cur_women'];
            $contactData['cur_wquantity'] = $postData['cur_wquantity'];
            $contactData['cur_men'] = $postData['cur_men'];
            $contactData['cur_mquantity'] = $postData['cur_mquantity'];
           

           
           // Conditions
            $contactData['c_emp_name'] = $postData['c_emp_name'];
            $contactData['c_emp_signature'] = $postData['c_emp_signature'];
            $contactData['c_wit_name'] = $postData['c_wit_name'];
            $contactData['c_wit_signature'] = $postData['c_emp_signature'];
            $contactData['c_date'] = $postData['c_date'];
           
           // Office Use Only
            $contactData['processed_line_date'] = $postData['processed_line_date'];
            $contactData['processed_line_initial'] = $postData['processed_line_initial'];
            $contactData['police_check_received_date'] = $postData['police_check_received_date'];
            $contactData['police_check_received_initial'] = $postData['police_check_received_initial'];
            $contactData['discloseable_outcomes_date'] = $postData['discloseable_outcomes_date'];
            $contactData['discloseable_outcomes_initial'] = $postData['discloseable_outcomes_initial'];
            $contactData['fully_deducted_date'] = $postData['fully_deducted_date'];
            $contactData['fully_deducted_initial'] = $postData['fully_deducted_initial'];
            $contactData['uniform_ordered_date'] = $postData['uniform_ordered_date'];
            $contactData['uniform_ordered_initial'] = $postData['uniform_ordered_initial'];
            $contactData['uniform_received_date'] = $postData['uniform_received_date'];
            $contactData['uniform_received_initial'] = $postData['uniform_received_initial'];
            $contactData['cost_uniform_date'] = $postData['cost_uniform_date'];
            $contactData['cost_uniform_initial'] = $postData['cost_uniform_initial'];
            $contactData['fully_deducted_pay_date'] = $postData['fully_deducted_pay_date'];
            $contactData['fully_deducted_pay_initial'] = $postData['fully_deducted_pay_initial'];
           
           // Employee Id Check
            $contactData['eic_name'] = $postData['eic_name'];
            $contactData['eic_signature'] = $postData['eic_signature'];
            $contactData['eic_date'] = $postData['eic_date'];
           
           // Minimum Proof Of Identity Requirements For Police Check and WWCC I WWVP Apply I Renewal

            $contactData['mppc_document'] = $postData['mppc_document'];
            $contactData['mppc_document2'] = $postData['mppc_document'];
            $contactData['mppc_document_multi'] = $postData['mppc_document_multi'];
            $contactData['mppc_picture_hold'] = $postData['mppc_picture_hold'];
            $contactData['mppc_name'] = $postData['mppc_name'];
            $contactData['mppc_signature'] = $postData['mppc_signature'];
            $contactData['mppc_date'] = $postData['mppc_date'];
           
           // Choice Of Superannuation Fund - Standard Choice Form

            $contactData['superannuation_fund'] = $postData['superannuation_fund'];
           
           // M1. Existing HESTA Member

            $contactData['hesta_member_no'] = $postData['hesta_member_no'];
            $contactData['hesta_dob'] = $postData['hesta_dob'];
            $contactData['hesta_ac_no'] = $postData['hesta_ac_no'];
            $contactData['hesta_bsb'] = $postData['hesta_bsb'];
           
           // 2. Employer Choosen Fund

            $contactData['ecf_name'] = $postData['ecf_name'];
            $contactData['ecf_pro_no'] = $postData['ecf_pro_no'];
            $contactData['ecf_telephone'] = $postData['ecf_telephone'];
            $contactData['ecf_website'] = $postData['ecf_website'];
           
           // 3. My Chosen Superannuation Fund

            $contactData['csf_name'] = $postData['csf_name'];
            $contactData['csf_abn'] = $postData['csf_abn'];
            $contactData['csf_address'] = $postData['csf_address'];
            $contactData['csf_phone'] = $postData['csf_phone'];
            $contactData['csf_mem_no'] = $postData['csf_mem_no'];
            $contactData['csf_ac_no'] = $postData['csf_ac_no'];
            $contactData['csf_ac_name'] = $postData['csf_ac_name'];
            $contactData['csf_pro_no'] = $postData['csf_pro_no'];
            $contactData['csf_bsb'] = $postData['csf_bsb'];
           
           // Employee Details

            $contactData['ed_name'] = $postData['ed_name'];
            $contactData['ed_signature'] = $postData['ed_signature'];
            $contactData['ed_date'] = $postData['ed_date'];
           
           // Statutory Declaration

            $contactData['sd_name'] = $postData['sd_name'];
            $contactData['sd_address'] = $postData['sd_address'];
            $contactData['sd_occupation'] = $postData['sd_occupation'];
           
           // I declare

            $contactData['i_declare1'] = $postData['i_declare'];
            $contactData['i_declare2'] = $postData['i_declare2'];
            $contactData['id_signature'] = $postData['id_signature'];
            $contactData['id_date'] = $postData['id_date'];
            $contactData['id_wb_name'] = $postData['id_wb_name'];
            $contactData['id_wb_signature'] = $postData['id_wb_signature'];
            $contactData['id_wb_qualification'] = $postData['id_wb_qualification'];
            $contactData['id_wb_address'] = $postData['id_wb_address'];
           
           //Department of Immigration and Citizenship
            $contactData['dic_fname'] = $postData['dic_fname'];
            $contactData['dic_gname'] = $postData['dic_gname'];
            $contactData['dic_oname'] = $postData['dic_oname'];
            $contactData['dic_dob'] = $postData['dic_dob'];
            $contactData['dic_nationality'] = $postData['dic_nationality'];
            $contactData['dic_passport_no'] = $postData['dic_passport_no'];
            $contactData['dic_visa'] = $postData['dic_visa'];
            $contactData['dic_visa_exp_date'] = $postData['dic_visa_exp_date'];
            $contactData['dic_signature'] = $postData['dic_signature'];
            $contactData['dic_date'] = $postData['dic_date'];
           
           // Staff Availability Form

            $contactData['saf_name'] = $postData['saf_name'];
            $contactData['saf_commitment'] = $postData['saf_commitment'];
            $contactData['saf_w1_saturday'] = $postData['saf_w1_saturday'];
            $contactData['saf_w1_sunday'] = $postData['saf_w1_sunday'];
            $contactData['saf_w1_monday'] = $postData['saf_w1_monday'];
            $contactData['saf_w1_tuesday'] = $postData['saf_w1_tuesday'];
            $contactData['saf_w1_wendesday'] = $postData['saf_w1_wendesday'];
            $contactData['saf_w1_thursday'] = $postData['saf_w1_thursday'];
            $contactData['saf_w1_friday'] = $postData['saf_w1_friday'];

            $contactData['saf_w2_saturday'] = $postData['saf_w2_saturday'];
            $contactData['saf_w2_sunday'] = $postData['saf_w2_sunday'];
            $contactData['saf_w2_monday'] = $postData['saf_w2_monday'];
            $contactData['saf_w2_tuesday'] = $postData['saf_w2_tuesday'];
            $contactData['saf_w2_wendesday'] = $postData['saf_w2_wendesday'];
            $contactData['saf_w2_thursday'] = $postData['saf_w2_thursday'];
            $contactData['saf_w2_friday'] = $postData['saf_w2_friday'];
            $contactData['saf_signature'] = $postData['saf_signature'];
            $contactData['saf_date'] = $postData['saf_date'];
           
           // Tax File Declaration Number

            $contactData['tfdn_no'] = $postData['tfdn_no'];
            $contactData['tfdn_value'] = $postData['tfdn_value'];
            $contactData['tfdn_title'] = $postData['tfdn_title'];
            $contactData['tfdn_fname'] = $postData['tfdn_fname'];
            $contactData['tfdn_oname'] = $postData['tfdn_oname'];
            $contactData['tfdn_cname'] = $postData['tfdn_cname'];
            $contactData['tfdn_dob'] = $postData['tfdn_dob'];
            $contactData['tfdn_address'] = $postData['tfdn_address'];
            $contactData['tfdn_suburb'] = $postData['tfdn_suburb'];
            $contactData['tfdn_state'] = $postData['tfdn_state'];
            $contactData['tfdn_postcode'] = $postData['tfdn_postcode'];
            $contactData['tfdn_paid'] = $postData['tfdn_paid'];
            $contactData['tfdn_australian_resident'] = $postData['tfdn_australian_resident'];
            $contactData['tfdn_claim_tax'] = $postData['tfdn_claim_tax'];
            $contactData['tfdn_pensioners_tax'] = $postData['tfdn_pensioners_tax'];
            $contactData['tfdn_claim_zone'] = $postData['tfdn_claim_zone'];
            $contactData['tfdn_he_loan'] = $postData['tfdn_he_loan'];
            $contactData['tfdn_fnancial_supplement_debt'] = $postData['tfdn_fnancial_supplement_debt'];
            $contactData['tfdn_signature'] = $postData['tfdn_signature'];
            $contactData['tfdn_date'] = $postData['tfdn_date'];
           
           //Section B: To be completed by the PAYER (if you are not lodging online)

            $contactData['p_abn'] = $postData['p_abn'];
            $contactData['p_branchno'] = $postData['p_branchno'];
            $contactData['p_lname'] = $postData['p_lname'];
            $contactData['p_address'] = $postData['p_address'];
            $contactData['p_suburb'] = $postData['p_suburb'];
            $contactData['p_state'] = $postData['p_state'];
            $contactData['p_postcode'] = $postData['p_postcode'];
            $contactData['p_contact_person'] = $postData['p_contact_person'];
            $contactData['p_nolonger_payee'] = $postData['p_nolonger_payee'];
           
           //Applicant Medical Report

            $contactData['amr_sname'] = $postData['amr_sname'];
            $contactData['amr_fname'] = $postData['amr_fname'];
            $contactData['amr_dob'] = $postData['amr_dob'];
            $contactData['amr_telephone'] = $postData['amr_telephone'];
            $contactData['amr_address'] = $postData['amr_address'];
            $contactData['amr_subrub'] = $postData['amr_subrub'];
            $contactData['amr_position'] = $postData['amr_position'];
            $contactData['amr_employer'] = $postData['amr_employer'];
            $contactData['amr_illness'] = $postData['amr_illness'];
            $contactData['amr_illness_detail'] = $postData['amr_illness_detail'];
            $contactData['amr_medications'] = $postData['amr_medications'];
            $contactData['amr_medications_detail'] = $postData['amr_medications_detail'];
            $contactData['amr_allergic'] = $postData['amr_allergic'];
            $contactData['amr_allergic_detail'] = $postData['amr_allergic_detail'];
            $contactData['amr_child_birth'] = $postData['amr_child_birth'];
            $contactData['amr_child_birth_detail'] = $postData['amr_child_birth_detail'];
            $contactData['amr_fractured'] = $postData['amr_fractured'];
            $contactData['amr_fractured_detail'] = $postData['amr_fractured_detail'];
            $contactData['amr_spinal'] = $postData['amr_spinal'];
            $contactData['amr_spinal_detail'] = $postData['amr_spinal_detail'];
            $contactData['amr_hearing'] = $postData['amr_hearing'];
            $contactData['amr_hearing_detail'] = $postData['amr_hearing_detail'];
            $contactData['amr_sunglasses'] = $postData['amr_sunglasses'];
            $contactData['amr_sunglasses_detail'] = $postData['amr_sunglasses_detail'];
            $contactData['amr_diabetes'] = $postData['amr_diabetes'];
            $contactData['amr_diabetes_detail'] = $postData['amr_diabetes_detail'];
            $contactData['amr_blood_pressure'] = $postData['amr_blood_pressure'];
            $contactData['amr_blood_pressure_detail'] = $postData['amr_blood_pressure_detail'];
            $contactData['amr_blackouts'] = $postData['amr_blackouts'];
            $contactData['amr_blackouts_detail'] = $postData['amr_blackouts_detail'];
            $contactData['amr_off_work'] = $postData['amr_off_work'];
            $contactData['amr_off_work_detail'] = $postData['amr_off_work_detail'];
            $contactData['amr_hernia'] = $postData['amr_hernia'];
            $contactData['amr_hernia_detail'] = $postData['amr_hernia_detail'];
            $contactData['amr_toxic'] = $postData['amr_toxic'];
            $contactData['amr_toxic_detail'] = $postData['amr_toxic_detail'];
            $contactData['amr_overuse_syndrome'] = $postData['amr_overuse_syndrome'];
            $contactData['amr_overuse_syndrome_detail'] = $postData['amr_overuse_syndrome_detail'];
            $contactData['amr_ability_to_perform'] = $postData['amr_ability_to_perform'];
            $contactData['amr_ability_to_perform_detail'] = $postData['amr_ability_to_perform_detail'];
            $contactData['amr_name'] = $postData['amr_name'];
            $contactData['amr_sign'] = $postData['amr_sign'];
            $contactData['amr_date'] = $postData['amr_date'];
           
           // Caring Approach Pty Ltd Code of Conduct

            $contactData['cacc_name'] = $postData['cacc_name'];
            $contactData['cacc_esignature'] = $postData['cacc_esignature'];
            $contactData['cacc_edate'] = $postData['cacc_edate'];
            $contactData['cacc_msignature'] = $postData['cacc_msignature'];
            $contactData['cacc_mdate'] = $postData['cacc_mdate'];
           
           // Infection control and exposure to Covid-19 (Coronavirus) or other transmittable virus / Illness acknowledgement statement August 2020

            $contactData['icec_name'] = $postData['icec_name'];
            $contactData['icec_caribg'] = $postData['icec_caribg'];
            $contactData['icec_sign'] = $postData['icec_sign'];
           
           //Caring Approach salary confidentiality agreement

            $contactData['casca_name'] = $postData['casca_name'];
            $contactData['casca_name2'] = $postData['casca_name2'];
            $contactData['casca_signature'] = $postData['casca_signature'];
            $contactData['casca_date'] = $postData['casca_date'];
           
           

            $contactData['created_date'] = date('Y-m-d H:i:s');
            $this->db->insert(db_prefix().'employee', $contactData);
            $lid = $this->db->insert_id();
            if($lid)
            {
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
    
	
}
