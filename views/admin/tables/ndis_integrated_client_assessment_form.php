<?php
defined('BASEPATH') or exit('No direct script access allowed');
use \Firebase\JWT\JWT;

$client_id =  $_GET['client_id'];
$clo_id =  $_GET['clo_id'];
$CI          = & get_instance();   

$aColumns = [
        db_prefix().'form_allot.id as id',
        'client_id',
        'name',
        'form_process',
        'created_date',
        'updated_date',
        'cc.id as cc_id',
        'cc.userid as cc_userid',
        'cc.firstname',
        'cc.email',
        'cc.phonenumber',
        'cc.dob',
        'cc.gender',
        'cc.registration_no',
        'cc.role', 
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'form_allot';

$join = [];
$join = [
	'LEFT JOIN '.db_prefix().'service_form ON '.db_prefix().'form_allot.form_id='.db_prefix().'service_form.id INNER JOIN '.db_prefix().'contacts as cc ON '.db_prefix().'form_allot.client_id=cc.userid'
];

$where        = ['AND tblservice_form.id=1'];
$sql = array();
$f_sql = '';
$order_by1 = 'id DESC';   

$order_by = 'id DESC';  
$sql[] = "role = 2";

if(isset($_GET['clo_id']) && !empty($_GET['clo_id']))
{
    $sql[] = "added_by = ".$_GET['clo_id'];

} 
if(isset($_GET['client_id']) && !empty($_GET['client_id'])){
    $sql[] = "client_id =".$_GET['client_id'];
    array_push($where, 'AND client_id='.$client_id);
}

if(sizeof($sql) > 0)
$f_sql = implode(' AND ', $sql);


//array_push($where, 'AND client_id IN ( SELECT userid FROM `tblcontacts` WHERE '.$f_sql.' ORDER BY '.$order_by.')');	


	
$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where,[]);
 
$output  = $result['output'];
$rResult = $result['rResult']; 

if(count($rResult)>0)
{
    $i=0;

    foreach ($rResult as $e_res) 
    {
        $useridfileter = $e_res['client_id'];
        $client_id_encrypt_alt = base64_encode($useridfileter);
        $client_id_encrypt = "'".$client_id_encrypt_alt."'";

        $user_Arr = array(); 

        $user_Arr['id'] = $e_res['cc_id'];
        $user_Arr['userid'] = $e_res['cc_userid'];
        $user_Arr['name'] = $e_res['firstname'];
        $user_Arr['email'] = $e_res['email'];
        $user_Arr['phone'] = $e_res['phonenumber'];
        $user_Arr['dob'] = $e_res['dob'];
        $user_Arr['gender'] = $e_res['gender'];
        $user_Arr['role'] = $e_res['role'];
        $user_Arr['address'] = 'test';
        $user_Arr['registration_no'] = $e_res['registration_no'];  
        $user_Arr['token'] = getclientjwttoken($user_Arr);
        $user_token = json_encode($user_Arr);

        $i++;
        $row   = array();
        $row[] = '<span class="nowrap">'.$i.'</span>';
        $row[] = '<span class="nowrap">'.clientname($e_res['client_id']).'</span>';
    
        //$row[] = '<td class="care-plan"><img  width="46" src="'.base_url("assets/images/pdf.svg").'" alt="Avatar" class="rounded mr-1"><a href="javascript:void(0)" onClick='loginClientForReport(".$user_token.")' onclick="form_open_as('.$client_id_encrypt.','.$e_res['form_id'].')" target="_blank">'.formname($e_res['form_id']).'</td>';
        $row[] = "<td class='care-plan'><img  width='46' src='".base_url('assets/images/pdf.svg')."' alt='Avatar' class='rounded mr-1'><a href='javascript:void(0);' onClick='loginClientForReport(".$user_token.")'>".$e_res['name']."</td>";
        $row[] = getDateDMYOnly($e_res['created_date']);
        $row[] = getDateDMYOnly($e_res['updated_date']);
        
        $row[] = '<div class="progress mb-0">
                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="'.$e_res['form_process'].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$e_res['form_process'].'%">
                        <span class="sr-only">'.$e_res['form_process'].'%</span>
                    </div>
                </div>';   

        if($e_res['lock_status']==1)
        {
            $options = icon_btn('report/add/' . $aRow['userid'], 'pencil-square-o');
            $row[] = "<button type='button' class='btn btn-sm btn-danger cursor-pointer' onClick='loginClientForReport(".$user_token.")' title='View' ><label class='mb-0 cursor-pointer'>View Profile </label></button>";
        }
        else
        {
            $row[] = "<button type='button' class='btn btn-sm btn-success cursor-pointer' onClick='loginClientForReport(".$user_token.")' title='View' ><label class='mb-0 cursor-pointer'>View Profile</label></button>";

        } 

        $output['aaData'][] = $row;
    }
} 
//echo "<pre>";print_r($output);die; 