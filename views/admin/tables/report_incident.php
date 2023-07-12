<?php
 
defined('BASEPATH') or exit('No direct script access allowed');

$client_id =  $_GET['client_id'];
$clo_id =  $_GET['clo_id'];
$CI          = & get_instance();
$aColumns = [
            'id',
        'report_for',
        'client_id',
        'userid',
        'pc_name',
        'pc_email',
        'ccd_name',
        'ccd_address',
        'accident_date',
        'accident_time',
        'created_date',
               
    ];
    
$sIndexColumn = 'id';
$sTable       = db_prefix().'report_incident';

$join = [];
// $join = [
// 	'LEFT JOIN '.db_prefix().'clients ON '.db_prefix().'report_incident.client_id='.db_prefix().'clients.userid'
// ];

$where        = [];
$sql = array();
$f_sql = '';
$order_by1 = 'id DESC';   

$order_by = 'id DESC';  
$sql[] = "role = 2";

 
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

        $i++;
        $row   = array();
        $row[] = '<td><span class="nowrap">'.$i.'</span></td>';
        $row[] = '<td><span class="nowrap">'.clientname($e_res['userid']).'</span></td>'; 
        $row[] = '<td><span class="nowrap">'.clientname($e_res['client_id']).'</span></td>'; 
        $row[] = '<td>'.$e_res['accident_date'].'/'.$e_res['accident_time'].'</td>';
        $row[] = '<td>'.date('d-m-Y h:i:s A', strtotime($e_res['created_date'])).'</td>';
        $row[] = "<a target='_blank' href='".admin_url('/reports/editShowReportincident')."/".$e_res['id']."/".$e_res['userid']."' class='btn btn-sm btn-info cursor-pointer' title='View' ><label class='mb-0 cursor-pointer'>View</label></a>";
        
    

        // if($e_res['lock_status']==1)
        // {
        //     $row[] = "<button type='button' class='btn btn-sm btn-danger cursor-pointer' onClick='changeLockStatus(".$e_res['id'].",".$e_res['lock_status'].")' title='Change Status' ><label class='mb-0 cursor-pointer'>Lock</label></button>";
        // }
        // else
        // {
        //     $row[] = "<button type='button' class='btn btn-sm btn-success cursor-pointer' onClick='changeLockStatus(".$e_res['id'].",".$e_res['lock_status'].")' title='Change Status' ><label class='mb-0 cursor-pointer'>Unlock</label></button>";

        // }

        $output['aaData'][] = $row;
    }
}

//echo "<pre>";print_r($output);die; 