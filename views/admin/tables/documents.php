<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI = & get_instance();
$aColumns = [
    'id',
    'title',
    'type_id',
    'created_date',
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'_documents';

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, [], [], ['id']);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    $attachment_audio = $CI->db->get_where(db_prefix().'files', array("rel_type" => "documents", "rel_id" => $aRow['id']))->row('file_name');
    $row[] = $aRow['title'];
    $row[] = $attachment_audio;
    $row[] = _d($aRow['created_date']);
    $row[] = typename($aRow['type_id']);
    $options = icon_btn('documents/add/' . $aRow['id'], 'pencil-square-o');
    $row[]   = $options .= icon_btn('documents/delete_documents/' . $aRow['id'], 'remove', 'btn-danger _delete');

    $output['aaData'][] = $row;
}
