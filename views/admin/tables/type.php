<?php
defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
    'id',
    'name',
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'_type';

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, [], [], ['id']);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    $row[] = '<a href="' . admin_url('type/add/' . $aRow['id']) . '" class="mbot10 display-block">' . $aRow['name'] . '</a>';
    $options = icon_btn('type/add/' . $aRow['id'], 'pencil-square-o');
    $row[]   = $options .= icon_btn('type/delete_type/' . $aRow['id'], 'remove', 'btn-danger _delete');

    $output['aaData'][] = $row;
}
