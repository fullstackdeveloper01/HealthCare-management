<?php
defined('BASEPATH') or exit('No direct script access allowed');

$CI          = & get_instance();
$aColumns = [
        'id',
        'CONCAT(firstname, \' \',lastname) as contact_full_name',
        'userid',
        'phonenumber',
        
        //'firstname',
        //'lastname',
        'email',
        'dob',
        'doj',
        'address',
        //'role',
        'active',
        'department_id',
        'designation_id',
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'contacts';
$where        = [];

array_push($where, 'AND role=1');

if(isset($_GET['report_type']) && $_GET['report_type']!='')
{
    $filter= $_GET['report_type'];
    
    if($filter == 'day'){
        $from_date = date('Y-m-d')." 00:00:00";
        $to_date = date('Y-m-d')." 23:59:59";
        array_push($where, 'AND '.db_prefix().'contacts.datecreated>="'.$from_date.'"');
        array_push($where, 'AND '.db_prefix().'contacts.datecreated<="'.$to_date.'"');
    }

    if($filter == 'week'){

        $date = strtotime("-7 day");
        $to_date = date('Y-m-d')." 23:59:59";
        $from_date = date('Y-m-d',$date)." 23:59:59";
        array_push($where, 'AND '.db_prefix().'contacts.datecreated>="'.$from_date.'"');
        array_push($where, 'AND '.db_prefix().'contacts.datecreated<="'.$to_date.'"');

    }

    if($filter == 'month'){
        $date = date("Y-m-d", strtotime("-1 month",strtotime(date('Y-m-d'))));
        $to_date = date('Y-m-d')." 23:59:59";
        $from_date = $date." 23:59:59";
        array_push($where, 'AND '.db_prefix().'contacts.datecreated>="'.$from_date.'"');
        array_push($where, 'AND '.db_prefix().'contacts.datecreated<="'.$to_date.'"');

    }

    if($filter == 'year'){
        $date = date("Y-m-d", strtotime("-1 year",strtotime(date('Y-m-d'))));
        $to_date = date('Y-m-d')." 23:59:59";
        $from_date = $date." 23:59:59";
        array_push($where, 'AND '.db_prefix().'contacts.datecreated>="'.$from_date.'"');
        array_push($where, 'AND '.db_prefix().'contacts.datecreated<="'.$to_date.'"');

       
    }


} 
if(isset($_GET['employee_status']) && $_GET['employee_status']!=''){
   
    array_push($where, ' AND '.db_prefix().'contacts.active='.$_GET['employee_status']);
}
$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, [], $where, []);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    $row[] = $aRow['id'];
    $row[] = $aRow['contact_full_name'];//$aRow['firstname'].' '.$aRow['lastname'];
    $row[] = $aRow['email'];
    $row[] = $aRow['phonenumber'];
     $row[] = date('d-m-Y', strtotime($aRow['dob']));
    $row[] = date('d-m-Y', strtotime($aRow['doj']));
    $row[] = $aRow['address'];

    $eDateStr = '';
    $eDateStr .= '<ul>';
    $staffArr = explode(',', $aRow['department_id']);
    foreach($staffArr as $rr)
    {

        $filename = $this->ci->db->get_where(db_prefix().'department', array('id' => $rr))->row('name');
       
        
        $eDateStr .= '<li>';
        $eDateStr .= $filename.'</a><p></p>';
        $eDateStr .= '</li>';
    }
        
    $eDateStr .= '</ul>';
    $row[] = $eDateStr;


    
    // $row[] = $this->ci->db->get_where(db_prefix().'department', array('id' => $aRow['department_id']))->row('name');
    $row[] = $this->ci->db->get_where(db_prefix().'designation', array('id' => $aRow['designation_id']))->row('name');
    $status= $aRow['active'];
    $toggleActive = '<div class="onoffswitch" data-toggle="tooltip" data-title="' . _l('customer_active_inactive_help') . '">
    <input onclick="changeStatus(this.value,'.$aRow['userid'].')" type="checkbox" data-switch-url="' . admin_url() . 'employee/change_emp_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['userid'] . '" data-id="' . $aRow['userid'] . '" ' . ($aRow['active'] == 1 ? 'checked' : '') . ' value="'.$status.'">
    <label class="onoffswitch-label" for="' . $aRow['userid'] . '"></label>
    </div>';

    $toggleActive .= '<span class="hide">' . ($aRow['active'] == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';

    $row[] = $toggleActive;
    
    $options = icon_btn('employee/add/' . $aRow['userid'], 'pencil-square-o');
    $options .= icon_btn('employee/showEmployeeForm/' .$aRow['id']. '/' . $aRow['userid'], 'eye');
    $row[]   = $options .= icon_btn('employee/delete_employee/' . $aRow['userid'], 'remove', 'btn-danger _delete');

    $output['aaData'][] = $row;
}
