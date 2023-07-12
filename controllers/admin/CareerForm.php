<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CareerForm extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('gallery_model');
    }

    /* List all knowledgebase articles */
    public function index()
    {
        if (!has_permission('careerForm', '', 'view')) {
            access_denied('careerForm');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('careerForm');
        }
       
        $sheader_text = title_text('aside_menu_active', 'careerForm');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        
        $data['title']     = _l($sheader_text);
        $this->load->view('admin/careerForm/careerForm', $data);
    }

    /* Add new article or edit existing*/
    // public function add($id = '')
    // {
    //     if (!has_permission('gallery', '', 'view')) {
    //         access_denied('gallery');
    //     }
    //     if ($this->input->post()) {
    //         $data                = $this->input->post();
            
    //         if ($id == '') {
    //             if (!has_permission('gallery', '', 'create')) {
    //                 access_denied('gallery');
    //             }
    //             $data['createddate'] = date('Y-m-d H:i:s');
    //             $id = $this->gallery_model->add_article($data);
    //             $folderid = $data['folderid'];
    //             $eventid = $data['eventid'];
    //             $foldername = $this->db->get_where(db_prefix().'folder_year', array('id' => $data['folderid']))->row('name');
    //             if ($id) {
                    
    //                 $uploadedFiles = handle_file_array($id, $foldername,$eventid, 'gallery');
    //                 if ($uploadedFiles && is_array($uploadedFiles)) {
    //                     foreach ($uploadedFiles as $file) {
    //                         $this->misc_model->add_attachment_to_database($id, 'gallery', [$file]);
    //                     }
    //                 }
    //                 set_alert('success', _l('added_successfully', _l('Gallery')));
    //                 redirect(admin_url('gallery'));
    //             }
    //         } else {
    //             if (!has_permission('gallery', '', 'edit')) {
    //                 access_denied('gallery');
    //             }
    //             $success = $this->gallery_model->update_article($data, $id);
    //             $uploadedFiles = handle_task_attachments_array_gallery($id);
    //             if ($uploadedFiles && is_array($uploadedFiles)) {
    //                 foreach ($uploadedFiles as $file) {
    //                     $this->misc_model->add_attachment_to_database($id, 'gallery', [$file]);
    //                 }
    //             }
                
    //             if ($success) {
    //                 set_alert('success', _l('updated_successfully', _l('Gallery')));
    //             }
    //             redirect(admin_url('gallery'));
    //         }
    //     }
    //     if ($id == '') {
    //         $title = _l('add_new', _l('Gallery'));
    //     } else {
    //         $article         = $this->gallery_model->get($id);
    //        // echo '<pre>'; print_r($article); die;
    //         $data['article'] = $article;
    //     }
    //     $sheader_text = title_text('aside_menu_active', 'Gallery');
    //     $data['sheading_text'] = $sheader_text;
    //     $data['sh_text'] = $sheader_text;

    //     $data['title']     = _l($subheader_text);
    //     $this->load->view('admin/gallery/gallerys', $data);
    // }

    // /* getFolderList */
    // public function getFolderList()
    // {
    //     $profileResult = [];
    //     $profileResult = $this->db->get_where(db_prefix().'folder_year', array('status' => 1))->result();
    //     echo json_encode($profileResult);
    // }
    
    // /* createNewFolder */
    // public function createNewFolder()
    // {
    //     $name = $_POST['name'];
    //     if($name)
    //     {
    //         $exitrecord = $this->db->get_where(db_prefix().'folder_year', array('name' => $name))->row('name');
    //         if($exitrecord)
    //         {
    //             echo 2; exit();
    //         }
    //         else
    //         {
    //             $data['name'] = ucwords($name);
    //             $data['createddate'] = date('Y-m-d H:i:s');
    //             $this->db->insert(db_prefix().'folder_year', $data);
    //             $foldername = $this->db->insert_id();
    //             if (!is_dir('uploads/gallery/'.$data['name'])) {
    //                 mkdir('./uploads/gallery/' . $data['name'], 0777, TRUE);
    //             }
    //             echo 1; exit();
    //         }
    //     }
    //     else
    //     {
    //         echo ''; exit();
    //     }
    // }

    // /* getFolderList */
    // public function getEventList()
    // {
    //     $profileResult = [];
    //     $profileResult = $this->db->get_where(db_prefix().'folder_event', array('status' => 1))->result();
    //     echo json_encode($profileResult);
    // }
    
    // /* createNewFolder */
    // public function createNewEvent()
    // {
    //     $name = $_POST['name'];
    //     if($name)
    //     {
    //         $exitrecord = $this->db->get_where(db_prefix().'folder_event', array('name' => $name))->row('name');
    //         if($exitrecord)
    //         {
    //             echo 2; exit();
    //         }
    //         else
    //         {
    //             $data['name'] = ucwords($name);
    //             $data['createddate'] = date('Y-m-d H:i:s');
    //             $this->db->insert(db_prefix().'folder_event', $data);
    //             $foldername = $this->db->insert_id();
    //             // if (!is_dir('uploads/gallery/'.$foldername)) {
    //             //     mkdir('./uploads/gallery/' . $foldername, 0777, TRUE);
    //             // }
    //             echo 1; exit();
    //         }
    //     }
    //     else
    //     {
    //         echo ''; exit();
    //     }
    // }

    // /* Delete article from database */
    // public function delete_gallery($id)
    // {
    //     if (!has_permission('gallery', '', 'delete')) {
    //         access_denied('gallery');
    //     }
    //     if (!$id) {
    //         redirect(admin_url('gallery'));
    //     }
    //     $response = $this->gallery_model->delete_article($id);
    //     if ($response == true) {
    //         set_alert('success', _l('deleted', _l('Gallery')));
    //     } else {
    //         set_alert('warning', _l('problem_deleting', _l('Gallery')));
    //     }
    //     redirect(admin_url('gallery'));
    // }
}
