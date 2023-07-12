<?php
defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
    'name',
    'id',
   
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'office_location';

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, [], [], ['id']);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    $row[] = '<a href="' . admin_url('officeLocation/a/add/' . $aRow['id']) . '" class="mbot10 display-block">' . $aRow['name'] . '</a>';
    $options = icon_btn('officeLocation/add/' . $aRow['id'], 'pencil-square-o');
    $row[]   = $options .= icon_btn('officeLocation/delete_officeLocation/' . $aRow['id'], 'remove', 'btn-danger _delete');

    $output['aaData'][] = $row;
}
