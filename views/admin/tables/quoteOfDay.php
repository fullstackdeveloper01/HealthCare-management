<?php
defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
    'id',
    'title',
    'quote_by',
    'created_date',
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'quote_of_day';

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, [], [], ['id']);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    $row[] = '<a href="' . admin_url('quoteOfDay/add/' . $aRow['id']) . '" class="mbot10 display-block">' . $aRow['title'] . '</a>';
    $row[] = $aRow['quote_by'];
    $row[] = _d($aRow['created_date']);
    $options = icon_btn('quoteOfDay/add/' . $aRow['id'], 'pencil-square-o');
    $row[]   = $options .= icon_btn('quoteOfDay/delete_quoteOfDay/' . $aRow['id'], 'remove', 'btn-danger _delete');

    $output['aaData'][] = $row;
}
