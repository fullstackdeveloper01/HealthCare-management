<?php
defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
    'id',
    'name',
    'created_date',
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'policy';

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, [], [], ['id']);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    $row[] = '<a href="' . admin_url('policy/add/' . $aRow['id']) . '" class="mbot10 display-block">' . $aRow['name'] . '</a>';
    $row[] = _d($aRow['created_date']);
    $options = icon_btn('policy/add/' . $aRow['id'], 'pencil-square-o');
    $row[]   = $options .= icon_btn('policy/delete_policy/' . $aRow['id'], 'remove', 'btn-danger _delete');

    $output['aaData'][] = $row;
}
