<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI             = & get_instance();
$aColumns = [
    'title',
    'id',
 
    'officer',
    'created_date',
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'care_plan';

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    $filename = $CI->db->get_where(db_prefix().'files', array('rel_id' => $aRow['id'], 'rel_type' => 'care_plan'))->row('file_name');
    $row[] = $aRow['title'];
    $row[] = $aRow['officer'];
    $row[] = getDateDMYOnly($aRow['created_date']);
    $row[] = '<a href="'.base_url().'uploads/care_plan/'.$aRow['id'].'/'.$filename.'">'.$filename.'</a>';
    $options = icon_btn('carePlan/add/' . $aRow['id'], 'pencil-square-o');
    $row[]   = $options .= icon_btn('carePlan/delete_carePlan/' . $aRow['id'], 'remove', 'btn-danger _delete');

    $output['aaData'][] = $row;
}
