<?php
defined('BASEPATH') or exit('No direct script access allowed');

$CI          = & get_instance();
$aColumns = [
        'id',
        'userid',
        'plan_id',
        'plan_title',
        'plan_officer',
        'created_date',
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'my_care_plan';
$where        = [];

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, [], $where, ['id','created_date'], 'GROUP BY userid');
$output  = $result['output'];
$rResult = $result['rResult'];
$sn = 1;
foreach ($rResult as $aRow) {
    $row = [];
    $staffArr = $CI->db->select('id,userid,plan_id,plan_title,plan_officer,created_date')->get_where(db_prefix().'my_care_plan', array('userid' => $aRow['userid']))->result();
    $row[] = $aRow['id'];
    $row[] = clientname($aRow['userid']);
    $staffStr = '';
    $staffStr .= '<ul>';
    foreach($staffArr as $rr)
    {
        $staffStr .= '<li>';
        $staffStr .= substr($rr->plan_title,20).'<p></p>';
        $staffStr .= '</li>';
    }
        
    $staffStr .= '</ul>';
    $row[] = $staffStr;
    
    $sDateStr = '';
    $sDateStr .= '<ul>';
    foreach($staffArr as $rr)
    {
        $sDateStr .= '<li>';
        $sDateStr .= $rr->plan_officer.'<p></p>';
        $sDateStr .= '</li>';
    }
        
    $sDateStr .= '</ul>';
    $row[] = $sDateStr;
    
    $eDateStr = '';
    $eDateStr .= '<ul>';
    foreach($staffArr as $rr)
    {

        $filename = $CI->db->get_where(db_prefix().'files', array('rel_id' => $rr->id, 'rel_type' => 'care_plan'))->row('file_name');
        
        $eDateStr .= '<li>';
        $eDateStr .= '<a  href="'.base_url().'uploads/care_plan/'.$rr->id.'/'.$filename.'" target="_blank">'.$filename.'</a><p></p>';
        $eDateStr .= '</li>';
    }
        
    $eDateStr .= '</ul>';
    $row[] = $eDateStr;
    
    $slotStr = '';
    $slotStr .= '<ul>';
    foreach($staffArr as $rr)
    {
        $slotStr .= '<li>';
        $slotStr .= $rr->created_date.'<p></p>';
        $slotStr .= '</li>';
    }
        
    $slotStr .= '</ul>';
    $row[] = $slotStr;

    
    $optionStr = '';
    $optionStr .= '<ul>';
    foreach($staffArr as $rr)
    {
        $optionStr .= '<li>';
        $options = icon_btn('careplan_assign/add/' . $rr->id, 'pencil-square-o');
        $options .= icon_btn('careplan_assign/delete_careplan_assign/' . $rr->id, 'remove', 'btn-danger _delete');
        
        $optionStr .= $options;
        $optionStr .= '</li>';
    }
        
    $optionStr .= '</ul>';
    $row[] = $optionStr;
    
    $output['aaData'][] = $row;
}
