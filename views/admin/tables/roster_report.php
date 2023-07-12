<?php
 
defined('BASEPATH') or exit('No direct script access allowed');
$client_id =  $_GET['client_id'];
$clo_id =  $_GET['clo_id'];
$CI          = & get_instance();
$aColumns = [
    //'tblroster.id',
    'CONCAT(tblcontacts.firstname, \' \', tblcontacts.lastname) as contact_full_name',
    //'client_id',
    'staff_id',
    'start_date',
    'end_date',
    'time_from',
    'time_to',
    //'tblroster.description',
    'status',      
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'roster';

$join = [];
$join = [
	'LEFT JOIN '.db_prefix().'contacts ON '.db_prefix().'roster.staff_id='.db_prefix().'contacts.userid'
];
$where        = [];

 array_push($where, 'AND tblroster.added_by='.'1');

if(isset($_GET['clo_id']) && $_GET['clo_id']!='')
{
    array_push($where, ' AND tblroster.added_by_id='.$clo_id);

} 
if(isset($_GET['client_id']) && $_GET['client_id']!=''){
   
    array_push($where, ' AND tblroster.client_id='.$client_id);
}
	
$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where,[
   ]);

$output  = $result['output'];
$rResult = $result['rResult'];
//echo "<pre>";print_r($result);die;
if(count($rResult)>0){
    $i=0;
    foreach ($rResult as $e_res) 
    {
        $i++;
        $row   = array();
        $row[] = '<span class="nowrap">'.$i.'</span>';
       // $row[] = '<span class="nowrap">'.clientname($e_res['client_id']).'</span>';
       // $row[] = '<span class="nowrap">'.clientname($e_res['staff_id']).'</span>';
       $row[] = '<span class="nowrap">'.$e_res['contact_full_name'].'</span>';
        $row[] = '<span class="nowrap">' .$e_res['start_date'].'</span>';
        $row[] = '<span class="nowrap">' .$e_res['end_date'].'</span>';
        $row[] = '<span class="nowrap">' .$e_res['time_from'].'</span>';
        $row[] = '<span class="nowrap">' .$e_res['time_to'].'</span>';

        if($e_res['status']==1)
        {
            $row[] = "<label class='mb-0 cursor-pointer' style='color: #11a200 !important;'>Active</label>";
        }
        else
        {
            $row[] = "<label class='mb-0 cursor-pointer' style='color: #ce0015 !important;'>Inactive</label>";

        }


        $output['aaData'][] = $row;
    }
}




