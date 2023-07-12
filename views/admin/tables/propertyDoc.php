<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI =& get_instance();
$aColumns = [
    'id',
    'title',
    'property_id',
    'description',
    'required',
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'property_doc';
$where        = [];

$_classname = $_SESSION['propertyID'];
array_push($where, 'WHERE property_id="'.$_classname.'"');

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, [], $where, ['id']);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    //$imageArray = $CI->db->get_where(db_prefix().'files', array('rel_id' => $aRow['id'], 'rel_type' => "propertydoc"))->row();
    //$fullPath = TASKS_ATTACHMENTS_FOLDER.$aRow['id'].'/'.$imageArray->file_name;
    $row[] = $aRow['title'];
    $row[] = ($aRow['required'] == 1)?"Yes":"No";
    $row[] = $aRow['description'];
    $options = icon_btn('properties/documentsEdit/'.$_classname.'/'.$aRow['id'], 'pencil-square-o');
    $row[]   = $options .= icon_btn('properties/delete_doc/'.$_classname.'/'.$aRow['id'], 'remove', 'btn-danger _delete');

    $output['aaData'][] = $row;
}
