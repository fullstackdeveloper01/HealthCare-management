<?php
 
defined('BASEPATH') or exit('No direct script access allowed');
$client_id =  $_GET['client_id'];
$clo_id =  $_GET['clo_id'];
$CI          = & get_instance();
$aColumns = [
    'id',
    'client_id',
    'title',
    'invoice_no',
    'invoice_date',
    'total_amount',
    'created_date',
    'status'  
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'roster_invoice';

$join = [];

$where        = [];

 array_push($where, 'AND added_by=1');

if(isset($_GET['clo_id']) && $_GET['clo_id']!='')
{
    array_push($where, 'AND added_by_id='.$clo_id);

} 
if(isset($_GET['client_id']) && $_GET['client_id']!=''){
   
    array_push($where, 'AND client_id='.$client_id);
}
	
$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where,[
   ]);

$output  = $result['output'];
$rResult = $result['rResult'];

if(count($rResult)>0){
    $i=0;
    foreach ($rResult as $e_res) 
    {
        $filename = $CI->db->get_where(db_prefix().'files', array('rel_id' => $e_res['id'], 'rel_type' => 'invoice'))->row('file_name');
        $i++;
        $row   = array();
        $row[] = '<span class="nowrap">'.$i.'</span>';
      //  $row[] = '<span class="nowrap">'.clientname($e_res['client_id']).'</span>';
        $row[] = '<span class="nowrap">'.$e_res['title'].'</span>';
        $row[] = '<span class="nowrap">' .$e_res['invoice_no'].'</span>';
        $row[] = '<span class="nowrap">' .$e_res['invoice_date'].'</span>';
        $row[] = '<span class="nowrap">' .$e_res['total_amount'].'</span>';
        //$row[] = '<span class="nowrap">' .$e_res->status.'</span>';
        $row[] = '<a href="'.base_url().'uploads/invoice/'.$e_res['id'].'/'.$filename.'">'.$filename.'</a>';
       

        if($e_res['status']=="PAID")
        {
            $row[] = "<label class='mb-0 cursor-pointer' style='color: #11a200 !important;'>PAID</label>";
        }
        else
        {
            $row[] = "<label class='mb-0 cursor-pointer' style='color: #ce0015 !important;'>UNPAID</label>";

        }


        $output['aaData'][] = $row;
    }
}


