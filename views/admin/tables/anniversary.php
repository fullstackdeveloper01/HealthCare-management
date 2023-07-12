<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI = & get_instance();
$aColumns = [
        'id',
        'userid',
        'phonenumber',
        'firstname',
        'lastname',
        'email',
        'dob',
        'doj',
        'address',
        'role',
        'active',
        'department_id',
        'designation_id',
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'contacts';
$where        = [];

// array_push($where, 'WHERE role=1');
array_push($where, 'AND role=1');

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, [], $where, ['id','email','firstname','phonenumber','lastname','doj']);
$output  = $result['output'];
$rResult = $result['rResult'];
$sn = 1;
foreach ($rResult as $aRow) {
    $row = [];
    
    $row[] = $sn++;
    $row[] = $aRow['firstname'].' '.$aRow['lastname'];
    $row[] = $aRow['email'];
    $row[] = $aRow['phonenumber'];
    
    $row[] = $this->ci->db->get_where(db_prefix().'department', array('id' => $aRow['department_id']))->row('name');
    $row[] = $this->ci->db->get_where(db_prefix().'designation', array('id' => $aRow['designation_id']))->row('name');
    $row[] = _d($aRow['doj']);
    /*
    $options = icon_btn('employee/add/' . $aRow['id'], 'pencil-square-o');
    $row[]   = $options .= icon_btn('employee/delete_employee/' . $aRow['userid'], 'remove', 'btn-danger _delete');
    */
    $output['aaData'][] = $row;
}
