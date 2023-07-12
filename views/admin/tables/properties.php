<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI          = & get_instance();
$aColumns = [
        'id',
        'agent_id',
        'name',
        'price',
        'description',
        'sqfit',
        'active_date',
        'address',
        'type',
        'posted_date',
        'status',
        'created_date',
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'property';
$where        = [];

//array_push($where, 'AND ('.db_prefix().'properties.parent_id = 0)');

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, [], $where, ['id']);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    
    $attachment_key = $CI->db->get_where(db_prefix().'files', array('rel_id' => $aRow['id'], 'rel_type' => "propertyimg"))->row();
    $row[] = '<img src="'.site_url('download/file/taskattachment/'. $attachment_key->attachment_key).'" width="50" height="50" alt="">';
    $row[] = $aRow['name'];
    $row[] = get_company_name($aRow['agent_id']);
    $row[] = $aRow['price'];
    $row[] = _d($aRow['created_date']);
    $row[] = _d($aRow['active_date']);
    $options = icon_btn('properties/editInfo/' . $aRow['id'], 'pencil-square-o');
    $row[]   = $options .= icon_btn('properties/delete_properties/' . $aRow['id'], 'remove', 'btn-danger _delete');

    $output['aaData'][] = $row;
}
