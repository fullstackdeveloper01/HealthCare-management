<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI          = & get_instance();
$aColumns = [
    db_prefix().'files.id',
    ];

$sIndexColumn = 'id';
$sTable       = db_prefix().'files';

$where        = [];

array_push($where, 'AND rel_type="gallery"');
$join = [
    'LEFT JOIN '.db_prefix().'gallery ON '.db_prefix().'gallery.id='.db_prefix().'files.rel_id',
    'LEFT JOIN '.db_prefix().'folder_year ON '.db_prefix().'folder_year.id='.db_prefix().'gallery.folderid',
    'LEFT JOIN '.db_prefix().'folder_event ON '.db_prefix().'folder_event.id='.db_prefix().'gallery.eventid',
];
$result  = data_tables_init($aColumns, $sIndexColumn, $sTable,$join,  $where,[
    db_prefix() . 'files.id as idd',
    db_prefix() . 'files.file_name',
    db_prefix() . 'gallery.id',
    db_prefix() . 'gallery.createddate',
    db_prefix() . 'gallery.folderid',
    db_prefix() . 'gallery.eventid',
    db_prefix(). 'folder_year.name as foldername',
    db_prefix(). 'folder_event.name as eventname',
]);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];  
    
    $row[] = '<img src="'.site_url('uploads/gallery/'.$aRow['foldername'].'/'.$aRow['eventid'].'/'. $aRow['file_name']).'" width="50" height="50" alt="">';
    $row[] = $aRow['foldername'];
    $row[] = $aRow['eventname'];
    $row[] = $aRow['createddate'];
    /*$options = icon_btn('gallery/add/' . $aRow['id'], 'pencil-square-o');*/
    $options = '';
    $row[]   = $options .= icon_btn('gallery/delete_gallery/' . $aRow['idd'], 'remove', 'btn-danger _delete');

    $output['aaData'][] = $row;
}
