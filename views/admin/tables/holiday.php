<?php
defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
    'id',
    'title',
    'from_date',
    'to_date',
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'holiday';

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, [], [], ['id']);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    $row[] = '<a href="' . admin_url('holiday/add/' . $aRow['id']) . '" class="mbot10 display-block">' . $aRow['title'] . '</a>';
    $row[] = _d($aRow['from_date']);
    $row[] = _d($aRow['to_date']);
    $options = icon_btn('holiday/add/' . $aRow['id'], 'pencil-square-o');
    $row[]   = $options .= icon_btn('holiday/delete_holiday/' . $aRow['id'], 'remove', 'btn-danger _delete');

    $output['aaData'][] = $row;
}
