<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI =& get_instance();
$aColumns = [
    'id',
    'property_id',
    'name',
    'email',
    'appointment_date',
    'available_time',
    'createddate',
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'appointment_booking';
$where        = [];

//$_classname = $_SESSION['propertyID'];
//array_push($where, 'WHERE property_id="'.$_classname.'"');


$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, [], $where, ['id']);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    $property = $CI->db->select('agent_id, name')->get_where(db_prefix().'property', array('id' => $aRow['property_id']))->row();
    $username = $CI->db->select('firstname, lastname')->get_where(db_prefix().'contacts', array('userid' => $property->agent_id))->row();
    $row[] = $username->firstname.' '.$username->lastname;
    $row[] = $property->name;
    $row[] = $aRow['name'];
    $row[] = $aRow['email'];
    $row[] = date('d M Y', strtotime($aRow['appointment_date']));
    $row[] = $aRow['available_time'];
    $row[] = $aRow['createddate'];
    //$options = icon_btn('properties/documentsEdit/'.$_classname.'/'.$aRow['id'], 'pencil-square-o');
   // $row[]   = $options .= icon_btn('properties/delete_doc/'.$_classname.'/'.$aRow['id'], 'remove', 'btn-danger _delete');

    $output['aaData'][] = $row;
}
