<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI          = & get_instance();
$aColumns = [
    'id',
];

$sIndexColumn = 'id';
$sTable       = db_prefix().'contacts_us';

$where        = [];

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable,[],  $where,[
    'firstname',
    'lastname',
    'email',
    'phonenumber',
    'address',
    'message'
]);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];  
    
    $row[] = $aRow['firstname'];
    $row[] = $aRow['lastname'];
    $row[] = $aRow['email'];
    $row[] = $aRow['phonenumber'];
    $row[] = $aRow['address'];
    $row[] = $aRow['message'];
    $output['aaData'][] = $row;
}
