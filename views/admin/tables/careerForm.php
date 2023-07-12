<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI          = & get_instance();
$aColumns = [
    'id',
];

$sIndexColumn = 'id';
$sTable       = db_prefix().'career';

$where        = [];

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable,[],  $where,[
    'name',
    'street_address',
    'address',
    'city',
    'state',
    'phone_no',
    'email',
    'comment'
    
]);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];  
    $filename = $CI->db->get_where(db_prefix().'files', array('rel_id' => $aRow['id'], 'rel_type' => 'resume_image'))->row('file_name');
    $row[] = $aRow['name'];
    $row[] = $aRow['street_address'];
    $row[] = $aRow['address'];
    $row[] = $aRow['city'];
    $row[] = $aRow['state'];
    $row[] = $aRow['phone_no'];
    $row[] = $aRow['email'];
    $row[] = '<a href="'.base_url().'uploads/resume_image/'.$aRow['id'].'/'.$filename.'" target="_blank">'.$filename.'</a>';
    $row[] = '<span class="cursor-pointer" data-toggle="tooltip" data-placement="left" title="'.$aRow['comment'].'">'.substr($aRow['comment'],0 ,35).'</span>';
    $output['aaData'][] = $row;
}
