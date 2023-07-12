<?php
 
defined('BASEPATH') or exit('No direct script access allowed');
$client_id =  $_GET['client_id'];
$clo_id =  $_GET['clo_id'];
$CI          = & get_instance();
$aColumns = [
        db_prefix().'form_allot.id as id',
        'client_id',
        'name',
        'form_process',
        'created_date',
        'updated_date',
               
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'form_allot';

$join = [];
$join = [
	'LEFT JOIN '.db_prefix().'service_form ON '.db_prefix().'form_allot.form_id='.db_prefix().'service_form.id'
];

$where        = [];
$sql = array();
$f_sql = '';
$order_by1 = 'id DESC';   

$order_by = 'id DESC';  
$sql[] = "role = 2";

if(isset($_GET['clo_id']) && !empty($_GET['clo_id']))
{
    $sql[] = "added_by = ".$_GET['clo_id'];

} 
if(isset($_GET['client_id']) && !empty($_GET['client_id']))
{
    $sql[] = "client_id =".$_GET['client_id'];
    array_push($where, 'AND client_id='.$client_id);
}

if(sizeof($sql) > 0)
$f_sql = implode(' AND ', $sql);


//array_push($where, 'AND client_id IN ( SELECT userid FROM `tblcontacts` WHERE '.$f_sql.' ORDER BY '.$order_by.')');	
	
$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where,[]);

$output  = $result['output'];
$rResult = $result['rResult'];

if(count($rResult)>0)
{
    $i=0;

    foreach ($rResult as $e_res) 
    {
        $useridfileter = $e_res['client_id'];
        $client_id_encrypt_alt = base64_encode($useridfileter);
        $client_id_encrypt = "'".$client_id_encrypt_alt."'";

        $i++;
        $row   = array();
        $row[] = '<span class="nowrap">'.$i.'</span>';
      //  $row[] = '<span class="nowrap">'.clientname($e_res['client_id']).'</span>';
    
        //$row[] = '<td class="care-plan"><img  width="46" src="'.base_url("assets/images/pdf.svg").'" alt="Avatar" class="rounded mr-1"><a href="javascript:void(0)" onclick="form_open_as('.$client_id_encrypt.','.$e_res['form_id'].')" target="_blank">'.formname($e_res['form_id']).'</td>';
        $row[] = '<td class="care-plan"><img  width="46" src="'.base_url("assets/images/pdf.svg").'" alt="Avatar" class="rounded mr-1"><a href="javascript:void(0)" onclick="form_open_as('.$client_id_encrypt.','.$e_res['form_id'].')" target="_blank">'.$e_res['name'].'</td>';
        $row[] = getDateDMYOnly($e_res['created_date']);
        $row[] = getDateDMYOnly($e_res['updated_date']);
        
        $row[] = '<div class="progress mb-0">
                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="'.$e_res['form_process'].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$e_res->form_process.'%">
                        <span class="sr-only">'.$e_res['form_process'].'%</span>
                    </div>
                </div>';  

        if($e_res['lock_status']==1)
        {
            $row[] = "<button type='button' class='btn btn-sm btn-danger cursor-pointer' onClick='changeLockStatus(".$e_res['id'].",".$e_res['lock_status'].")' title='Change Status' ><label class='mb-0 cursor-pointer'>Lock</label></button>";
        }
        else
        {
            $row[] = "<button type='button' class='btn btn-sm btn-success cursor-pointer' onClick='changeLockStatus(".$e_res['id'].",".$e_res['lock_status'].")' title='Change Status' ><label class='mb-0 cursor-pointer'>Unlock</label></button>";

        }

        $output['aaData'][] = $row;
    }
}

//echo "<pre>";print_r($output);die;

