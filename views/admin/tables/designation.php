<?php
defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
    
    'name',

    'id',
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'designation';

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    $row[] = '<a href="' . admin_url('designation/add/' . $aRow['id']) . '" class="mbot10 display-block">' . $aRow['name'] . '</a>';
    // $options = icon_btn('designation/add/' . $aRow['id'], 'pencil-square-o');
    // $row[]   = $options .= icon_btn('designation/delete_designation/' . $aRow['id'], 'remove', 'btn-danger _delete');
    $row[]   =  icon_btn('designation/add/' . $aRow['id'], 'pencil-square-o');

    $output['aaData'][] = $row;
}
