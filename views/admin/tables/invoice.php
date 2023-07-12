<?php
defined('BASEPATH') or exit('No direct script access allowed');
//$client_id =  $this->ci->db->escape_str($client_id);

$client_id =  $_GET['client_id'];
$filter =  $_GET['filter'];
$CI          = & get_instance();
$aColumns = [
        'id',
        'client_id',
        'title',
        'invoice_no',
        'invoice_date',
        'total_amount',
        'created_date',
        'added_by',
        'added_by_id',
        'status',
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'roster_invoice';
$where        = [];



if($client_id != '')
{
	array_push($where, 'AND '.db_prefix().'roster_invoice.client_id="'.$client_id.'"');	
}


if($filter == 'day'){
    array_push($where, 'AND '.db_prefix().'roster_invoice.invoice_date="'.date('Y-m-d').'"');	
   
}

if($filter == 'week'){

    $date = strtotime("+7 day");
    array_push($where, 'AND '.db_prefix().'roster_invoice.invoice_date>="'.date('Y-m-d').'"');
    array_push($where, 'AND '.db_prefix().'roster_invoice.invoice_date<="'.date('Y-m-d',$date).'"');

}

if($filter == 'month'){
      $date = date("Y-m-d", strtotime("+1 month",strtotime(date('Y-m-d'))));
    array_push($where, 'AND '.db_prefix().'roster_invoice.invoice_date>="'.date('Y-m-d').'"');
    array_push($where, 'AND '.db_prefix().'roster_invoice.invoice_date<="'.$date.'"');

}

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, [], $where, ['id']);
$output  = $result['output'];
$rResult = ($result['rResult']);
foreach ($rResult as $aRow) {
    $row = [];
    $filename = $CI->db->get_where(db_prefix().'files', array('rel_id' => $aRow['id'], 'rel_type' => 'invoice'))->row('file_name');
    $row[] = ($aRow['added_by']==0)? 'Admin':'CLO : '.clientname($aRow['added_by_id']);
    $row[] = clientname($aRow['client_id']);
    $row[] = $aRow['title'];
    $row[] = $aRow['invoice_no'];
    $row[] = _d($aRow['invoice_date']);
    $row[] = $aRow['total_amount'];
    $row[] = '<a href="'.base_url().'uploads/invoice/'.$aRow['id'].'/'.$filename.'">'.$filename.'</a>';
    $row[] = $aRow['status'];
    
    /*
    $toggleActive = '<div class="onoffswitch" data-toggle="tooltip" data-title="' . _l('customer_active_inactive_help') . '">
    <input type="checkbox" data-switch-url="' . admin_url() . 'invoice/change_emp_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['userid'] . '" data-id="' . $aRow['userid'] . '" ' . ($aRow['active'] == 1 ? 'checked' : '') . '>
    <label class="onoffswitch-label" for="' . $aRow['userid'] . '"></label>
    </div>';

    $toggleActive .= '<span class="hide">' . ($aRow['active'] == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';

    $row[] = $toggleActive;
    */
    $options = icon_btn('invoice/add/' . $aRow['id'], 'pencil-square-o');
    $row[]   = $options .= icon_btn('invoice/delete_invoice/' . $aRow['id'], 'remove', 'btn-danger _delete');
    
    $output['aaData'][] = $row;
}
