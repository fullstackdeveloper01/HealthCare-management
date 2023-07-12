<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI          = & get_instance();
$aColumns = [
    'id',
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'policy_page';
$where        = [];
$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, [], $where, ['id', 'title', 'content', 'is_main', 'position','status']);
$output  = $result['output'];
$rResult = $result['rResult'];
$sn = 1;

foreach ($rResult as $aRow) {
    $row = [];  
    $row[] = $sn++;
     $row[] = $aRow['title']; 
    // $row[] = $aRow['content'];

    if( $aRow['is_main']== 1)
    {
        $row[] = 'Yes';
    }else{
        $row[] =  'No';
    }

    if( $aRow['position']== 1)
    {
        $row[] = 'Our Information Handling Practices';
    }else if( $aRow['position']== 2)
    {
        $row[] = 'Quality and Security of Personal Information';
    }else if( $aRow['position']== 3)
    {
        $row[] = 'Our Files and You';
    }else if( $aRow['position']== 4)
    {
        $row[] = 'Access and Correction';
    }else if( $aRow['position']== 5)
    {
        $row[] = 'Complaints';
    }else if( $aRow['position']== 6)
    {
        $row[] = 'Direct Marketing';
    }else if( $aRow['position']== 7)
    {
        $row[] = 'Online/Electronic Communications';
    }else if( $aRow['position']== 8)
    {
        $row[] = 'Amendments to Policy';
    }else if( $aRow['position']== 9)
    {
        $row[] = 'Contact Us';
    }else{
        $row[] =  '----';
    }
     
    
    $toggleActive = '<div class="onoffswitch" data-toggle="tooltip" data-title="' . _l('customer_active_inactive_help') . '">
    <input type="checkbox" data-switch-url="' . admin_url() . 'policyPage/change_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . ($aRow['status'] == 1 ? 'checked' : '') . '>
    <label class="onoffswitch-label" for="' . $aRow['id'] . '"></label>
    </div>';

    $toggleActive .= '<span class="hide">' . ($aRow['status'] == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';

    $row[] = $toggleActive;

    $options = icon_btn('policyPage/edit/' . $aRow['id'], 'pencil-square-o');

    if( $aRow['position'] > 0 && $aRow['position'] != 9)
    {
        $row[]   = $options .= icon_btn('policyPage/delete/' . $aRow['id'], 'remove', 'btn-danger _delete');
    }else{
        $row[]   = $options;
    }

    $output['aaData'][] = $row;
}
