<?php
 
defined('BASEPATH') or exit('No direct script access allowed');
$client_id =  $_GET['client_id'];
$clo_id =  $_GET['clo_id'];
$CI          = & get_instance();
$aColumns = [
        //'id',
        //'added_by',
        //'added_by_id',
        'client_id',
        'name',
        'title',
        'CONCAT(start_date, \' \',start_time) as start_datetime',
       // 'start_date',
        //'start_time',
        'CONCAT(end_date, \' \',end_time) as end_datetime',
       // 'end_date',
        //'end_time',
        'frequency',
        'description'       
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'appointment';

$join = [];
$join = [
	'LEFT JOIN '.db_prefix().'service_type ON '.db_prefix().'appointment.service_id='.db_prefix().'service_type.id'
];
$where        = [];

 array_push($where, ' AND added_by=1');

if(isset($_GET['clo_id']) && $_GET['clo_id']!='')
{
    array_push($where, ' AND added_by_id='.$clo_id);

} 
if(isset($_GET['client_id']) && $_GET['client_id']!=''){
   
    array_push($where, ' AND client_id='.$client_id);
}
	
$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where,[
   ]);
//echo "<pre>";print_r($result);die;
$output  = $result['output'];
$rResult = $result['rResult'];

if(count($rResult)>0){
    $i=0;
    foreach ($rResult as $e_res) 
    {   
        //$service_name = $CI->db->get_where('tblservice_type', array('id' =>1 ))->row();
        
        $i++;
        $row   = array();
        $row[] = '<span class="nowrap">'.$i.'</span>';
        //$row[] = '<span class="nowrap">'.clientname($e_res['client_id']).'</span>';
        $row[] = '<span class="nowrap">' .$e_res['title'].'</span>';
        $row[] = '<span class="nowrap">'.$e_res['name'].'</span>';
        $row[] = '<span class="nowrap">' .$e_res['start_datetime'].'</span>';
        $row[] = '<span class="nowrap">' .$e_res['end_datetime'].'</span>';
        $row[] = '<span class="nowrap">' .$e_res['frequency'].'</span>';
        $row[] = '<span class="nowrap">' .$e_res['description'].'</span>';


        $output['aaData'][] = $row;
    }
}
//echo "<pre>";print_r($output);die;


