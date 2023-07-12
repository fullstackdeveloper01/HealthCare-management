<?php
defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
    'parent_id',
    'id',
    'name',
   
    'created_date',
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'department';

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, [], [], ['id']);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    $row[] = '<a href="' . admin_url('department/add/' . $aRow['id']) . '" class="mbot10 display-block">' . $aRow['name'] . '</a>';
    $row[] = $this->ci->db->get_where(db_prefix().'department', array('id' => $aRow['parent_id']))->row('name');
    $row[] = getDateDMYOnly($aRow['created_date']);
    $options = icon_btn('department/add/' . $aRow['id'], 'pencil-square-o');
    $row[]   = $options .= icon_btn('department/delete_department/' . $aRow['id'], 'remove', 'btn-danger _delete');

    $output['aaData'][] = $row;
}
