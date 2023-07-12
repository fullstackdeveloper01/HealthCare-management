<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI          = & get_instance();
$aColumns = [
    'id',
];

$sIndexColumn = 'id';
$sTable       = db_prefix().'feedback';

$where        = [];

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable,[], $where,[
    'firstname as name',
    'lastname as email',
    'message as feedback',
    'phonenumber as phonenumber'
    
]);
$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $aRow) {
    $row = [];  
    
    $row[] = $aRow['name'];
    $row[] = $aRow['email'];
    $row[] = $aRow['phonenumber'];
    $row[] = $aRow['feedback'];
   
    $output['aaData'][] = $row;
}
