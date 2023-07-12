<?php
defined('BASEPATH') or exit('No direct script access allowed');
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$aColumns = [
    'id',
    'employee_id',
    'leave_type_id',
    'from_date',
    'to_date',
    'half_day',
    'description',
    'status',
    'created_date',
    /*
    db_prefix().'contacts.firstname as fname',
    db_prefix().'contacts.lastname as lname',
    db_prefix().'leave_type.name as tname',
    */
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'leave_request';
$join = [];
/*
$join = [
    'LEFT JOIN '.db_prefix().'contacts ON '.db_prefix().'contacts.userid='.db_prefix().'leave_request.employee_id',
    'LEFT JOIN '.db_prefix().'leave_type ON '.db_prefix().'leave_type.id='.db_prefix().'leave_request.leave_type_id',
];
*/
$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, [], ['id']);
$output  = $result['output'];
$rResult = $result['rResult'];
$sn = 1;
foreach ($rResult as $aRow) {
    $row = [];
    $row[] = $sn++;
    $empres = $this->ci->db->select('firstname,lastname')->get_where(db_prefix().'contacts', array('userid' => $aRow['employee_id']))->row();
    $row[] = $empres->firstname.' '.$empres->lastname;
    $row[] = $this->ci->db->get_where(db_prefix().'leave_type', array('id' => $aRow['leave_type_id']))->row('name');
    $row[] = _d($aRow['from_date']);
    $row[] = _d($aRow['to_date']);
    $row[] = _d($aRow['created_date']);
    
    $status = '';
    if($aRow['status'] == 1)
        $status = 'Accept';
    if($aRow['status'] == 2)
        $status = 'Pending';
    if($aRow['status'] == 3)
        $status = 'On Hold';
    if($aRow['status'] == 4)
        $status = 'Rejected';
    
    $row[] = $status;
    /*
    $options = icon_btn('quoteOfDay/add/' . $aRow['id'], 'pencil-square-o');
    $row[]   = $options .= icon_btn('quoteOfDay/delete_quoteOfDay/' . $aRow['id'], 'remove', 'btn-danger _delete');
    */
    $output['aaData'][] = $row;
}
