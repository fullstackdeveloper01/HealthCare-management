<?php
 
defined('BASEPATH') or exit('No direct script access allowed');
$client_id =  $_GET['client_id'];
$clo_id =  $_GET['clo_id'];
$CI          = & get_instance();
$aColumns = [
        //'id',
       // 'client_id',
        'request_type',
        'title',
        'start_date',
        'end_date',
        'description',
        'status'       
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'requestamendment';

$join = [];

$where        = [];

 //array_push($where, ' AND role=1');

// if(isset($_GET['clo_id']) && $_GET['clo_id']!='')
// {
//     array_push($where, ' AND added_by_id='.$clo_id);

// } 
if(isset($_GET['client_id']) && $_GET['client_id']!=''){
   
    array_push($where, 'AND client_id='.$client_id);
}
	
$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where,[
   ]);

$output  = $result['output'];
$rResult = $result['rResult'];
//echo "<pre>";print_r($result);die;
if(count($rResult)>0){
    $i=0;
    foreach ($rResult as $e_res) 
    {
        
        $i++;
        $row   = array();
        $row[] = '<span class="nowrap">'.$i.'</span>';
        
       // $row[] = ucfirst(clientname($e_res['client_id']));
        // if($e_res->request_type=='Roster')
        // {
        //     $row[] = "<button type='button' data-toggle='modal' class='btn btn-sm btn-success' data-target='#editrosterModal' onClick='editRoster(".$e_res->request_id.")' title='Edit' >".$e_res->request_type."</button>";
        // }
        // else
        // {
            $row[] = "<button type='button' class='btn btn-sm btn-primary'>".$e_res['request_type']."</button>";
        //}
        if(strlen($e_res['title'])>10)
        {
            $row[]  = '<div class="profile-box-text"><a href="#" data-toggle="tooltip" data-placement="top" title="'.$e_res['title'].'">'.mb_substr($e_res['title'],0,10).' </a></div>';
        }
        else
        {
            $row[] = $e_res['title'];
        }

        
        if($e_res['request_type']=='Roster')
        $row[] = getDateDMYOnly($e_res['start_date']).' - '.getDateDMYOnly($e_res['end_date']);
        else
        $row[] = ($e_res['start_date']=='')?"-":getDateDMYOnly($e_res['start_date']);

        if(strlen($e_res['description'])>10)
        {
            $row[]  = '<div class="profile-box-text"><a href="#" data-toggle="tooltip" data-placement="top" title="'.$e_res['description'].'">'.mb_substr($e_res['title'],0,10).' </a></div>';
        }
        else
        {
            $row[] = $e_res['description'];
        }

        $row[] = ($e_res['status']==0)?'Pending':'Done';
        $status = ($e_res['status']==0)?'1':'0';
        $statuschecked = ($e_res['status']==0)?'':'checked';
       
        $output['aaData'][] = $row;
    }
}
//echo "<pre>";print_r($output);die;


