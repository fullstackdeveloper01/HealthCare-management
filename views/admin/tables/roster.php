<?php
defined('BASEPATH') or exit('No direct script access allowed');
$client_id =  $this->ci->db->escape_str($client_id);
$client_id =  $_GET['client_id'];
$filter =  $_GET['filter'];
$CI          = & get_instance();
$aColumns = [
        'tblroster.id',
        'CONCAT(tblcontacts.firstname, \' \', tblcontacts.lastname) as contact_full_name',
        'tblroster.client_id',
        'tblroster.staff_id',
        'tblroster.start_date',
        'tblroster.end_date',
        'tblroster.time_from',
        'tblroster.time_to',
        'tblroster.description',
        'tblroster.status',        
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'roster';

$join = [
	'LEFT JOIN '.db_prefix().'contacts ON '.db_prefix().'roster.client_id='.db_prefix().'contacts.userid'
];

$sql = array();
$f_sql = '';
$order_by = 'id DESC';  

$where        = [];
if($client_id != '')
{
	array_push($where, 'AND '.db_prefix().'roster.client_id="'.$client_id.'"');	
}

if($filter == 'day'){
    array_push($where, 'AND '.db_prefix().'roster.start_date="'.date('Y-m-d').'"');	
    array_push($sql, 'AND '.db_prefix().'roster.start_date="'.date('Y-m-d').'"');
}

if($filter == 'week'){

    $date = strtotime("+7 day");
    array_push($where, 'AND '.db_prefix().'roster.start_date>="'.date('Y-m-d').'"');
    array_push($where, 'AND '.db_prefix().'roster.start_date<="'.date('Y-m-d',$date).'"');

    array_push($sql, 'AND '.db_prefix().'roster.start_date>="'.date('Y-m-d').'"');
    array_push($sql, db_prefix().'roster.start_date<="'.date('Y-m-d',$date).'"');
}

if($filter == 'month'){
      $date = date("Y-m-d", strtotime("+1 month",strtotime(date('Y-m-d'))));
    array_push($where, 'AND '.db_prefix().'roster.start_date>="'.date('Y-m-d').'"');
    array_push($where, 'AND '.db_prefix().'roster.start_date<="'.$date.'"');

    array_push($sql,'AND '. db_prefix().'roster.start_date>="'.date('Y-m-d').'"');
    array_push($sql, db_prefix().'roster.start_date<="'.$date.'"');
}

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, ['tblroster.id','CONCAT(tblcontacts.firstname, \' \', tblcontacts.lastname) as contact_full_name','tblroster.client_id','tblroster.time_from','tblroster.time_to','tblroster.end_date','tblroster.start_date'], 'GROUP BY tblroster.client_id');
$output  = $result['output'];
$rResult = $result['rResult'];
$sn = 1;
foreach ($rResult as $aRow) {
    $row = [];
    
    //$sql[] = "client_id =".$aRow['client_id'];
    if(sizeof($sql) > 0){
         $f_sql = implode(' AND ', $sql);

        $f_sql= " client_id =".$aRow['client_id']." ". $f_sql;
    }else{
         $f_sql= " client_id =".$aRow['client_id'];
    }
    
    
     $query= "SELECT * FROM `tblroster` WHERE $f_sql ORDER BY $order_by";

    $staffArr = $CI->db->query($query)->result();
    //$staffArr = $CI->db->select('id,staff_id,start_date,end_date,time_from,time_to,status')->get_where(db_prefix().'roster', array('client_id' => $aRow['client_id']))->result();
    $row[] = $aRow['id'];
    $row[] = $aRow['contact_full_name'];
    $staffStr = '';
    $staffStr .= '<ul>';
    foreach($staffArr as $rr)
    {
        $staffStr .= '<li>';
        $staffStr .= clientname($rr->staff_id).'<p></p>';
        $staffStr .= '</li>';
    }
        
    $staffStr .= '</ul>';
    $row[] = $staffStr;
    
    $sDateStr = '';
    $sDateStr .= '<ul>';
    foreach($staffArr as $rr)
    {
        $sDateStr .= '<li>';
        $sDateStr .= $rr->start_date.'<p></p>';
        $sDateStr .= '</li>';
    }
        
    $sDateStr .= '</ul>';
    $row[] = $sDateStr;
    
    $eDateStr = '';
    $eDateStr .= '<ul>';
    foreach($staffArr as $rr)
    {
        $eDateStr .= '<li>';
        $eDateStr .= $rr->end_date.'<p></p>';
        $eDateStr .= '</li>';
    }
        
    $eDateStr .= '</ul>';
    $row[] = $eDateStr;
    
    $slotStrs = '';
    $slotStrs .= '<ul>';
    foreach($staffArr as $rr)
    {
        $slotStrs .= '<li>';
        $slotStrs .= $rr->time_from.'<p></p>';
        $slotStrs .= '</li>';
    }
        
    $slotStrs .= '</ul>';
    $row[] = $slotStrs;
    
    $slotStrd = '';
    $slotStrd .= '<ul>';
    foreach($staffArr as $rr)
    {
        $slotStrd .= '<li>';
        $slotStrd .= $rr->time_to.'<p></p>';
        $slotStrd .= '</li>';
    }
        
    $slotStrd .= '</ul>';
    $row[] = $slotStrd;
    
    $statusStr = '';
    $statusStr .= '<ul>';
    foreach($staffArr as $rr)
    {
        $statusStr .= '<li>';
        //$statusStr .= $rr->time_slot.'<hr>';
        $toggleActive = '<div class="onoffswitch" data-toggle="tooltip" data-title="' . _l('customer_active_inactive_help') . '">
            <input type="checkbox" data-switch-url="' . admin_url() . 'roster/change_emp_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $rr->id . '" data-id="' . $rr->id . '" ' . ($rr->status == 1 ? 'checked' : '') . '>
            <label class="onoffswitch-label" for="' . $rr->id . '"></label>
            </div>';
        
        $toggleActive .= '<span class="hide">' . ($rr->status == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';
        $statusStr .= $toggleActive.'<p></p>';
        $statusStr .= '</li>';
    }
        
    $statusStr .= '</ul>';
    $row[] = $statusStr;
    
    /*
    $toggleActive = '<div class="onoffswitch" data-toggle="tooltip" data-title="' . _l('customer_active_inactive_help') . '">
    <input type="checkbox" data-switch-url="' . admin_url() . 'roster/change_emp_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . ($aRow['status'] == 1 ? 'checked' : '') . '>
    <label class="onoffswitch-label" for="' . $aRow['id'] . '"></label>
    </div>';

    $toggleActive .= '<span class="hide">' . ($aRow['status'] == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';

    $row[] = $toggleActive;
    
    $options = icon_btn('roster/add/' . $aRow['id'], 'pencil-square-o');
    $row[]   = $options .= icon_btn('roster/delete_roster/' . $aRow['id'], 'remove', 'btn-danger _delete');
    */
    
    $optionStr = '';
    $optionStr .= '<ul>';
    foreach($staffArr as $rr)
    {
        $optionStr .= '<li>';
        $options = icon_btn('roster/add/' . $rr->id, 'pencil-square-o');
        $options .= icon_btn('roster/delete_roster/' . $rr->id, 'remove', 'btn-danger _delete');
        
        $optionStr .= $options;
        $optionStr .= '</li>';
    }
        
    $optionStr .= '</ul>';
    $row[] = $optionStr;
    
    $output['aaData'][] = $row;
}
