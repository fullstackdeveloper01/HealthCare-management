<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Properties extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('properties_model');
        //$this->load->library('CSVReader');
    }

    /* List all articles */
    public function index()
    {
        if (!has_permission('properties', '', 'view')) {
            access_denied('properties');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('properties');
        }
       
        $sheader_text = title_text('aside_menu_active', 'property');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        
        $data['title']     = _l($sheader_text);
        $data['agent_list'] = $this->db->get_where(db_prefix().'contacts', array('active' => 1))->result();
        $this->load->view('admin/properties/properties', $data);
    }
    
    /* property */
    public function property()
    {
        $sheader_text = title_text('aside_menu_active', 'property');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        $data['agent_list'] = $this->db->get_where(db_prefix().'contacts', array('active' => 1))->result();
        $data['title']     = _l($sheader_text);
        $this->load->view('admin/properties/propertyinfo', $data);   
    }

    /* Add information */
    public function addInfo($id = '')
    {
        if ($this->input->post()) {
            $data                = $this->input->post();
            $data['amenities'] = implode(',',$data['amenities']);
            if($id == '')
            {
                $data['active_date'] = date('y-m-d', strtotime($data['active_date']));
                $id = $this->properties_model->add_article($data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('Property')));
                    redirect(admin_url('properties/editInfo/'.$id));
                }
                else
                {
                    set_alert('warning', _l('Some error occurred'));
                    redirect(admin_url('properties/property'));
                }
            }
            else
            {
                $data['active_date'] = date('y-m-d', strtotime($data['active_date']));
                $success = $this->properties_model->update_article($data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('Property')));
                    redirect(admin_url('properties/editInfo/'.$id));
                }
                else
                {
                    set_alert('warning', _l('Some error occurred'));
                    redirect(admin_url('properties/editInfo/'.$id));
                }
            }
        }
    }
    
    /**
    *   @Function: distances
    */
    public function distances($id)
    {
        if($this->input->post())
        {
            $postdata = $this->input->post();
            $this->db->where('id', $id);
            $this->db->update(db_prefix().'property', $postdata);
            set_alert('success', _l('updated_successfully', _l('Distances')));
            redirect(admin_url('properties/distances/'.$id));
        }
        else
        {
            $sheader_text = title_text('aside_menu_active', 'property');
            $data['sheading_text'] = $sheader_text;
            $data['sh_text'] = $sheader_text;
            $data['article'] = $this->db->get_where(db_prefix().'property', array('id' => $id))->row();
            $data['title']   = _l($sheader_text);
            $data['page']    = 'dis';
            $this->load->view('admin/properties/distances', $data);   
        }
    }

    /* updateDoc */
    public function updateDoc($id)
    {
        if($id)
        {
            if($this->input->post())
            {
                $postdata = $this->input->post();
                $this->db->insert(db_prefix().'property_doc', $postdata);
                $did = $this->db->insert_id();
                if($did)
                {
                    /*
                    $uploadedFiles = handle_task_attachments_array($did,'propertydoc');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($did, 'propertydoc', [$file]);
                        }
                    }
                    */
                    set_alert('success', _l('added_successfully', _l('Documents')));
                    redirect(admin_url('properties/documents/'.$id));
                }
                else
                {
                   set_alert('warning', _l('Some error occurred'));
                    redirect(admin_url('properties/documents/'.$id)); 
                }
            }
            else
            {
                set_alert('warning', _l('Some error occurred'));
                redirect(admin_url('properties/documents/'.$id));
            }
        }
        else
        {
            set_alert('warning', _l('Some error occurred'));
            redirect(admin_url('properties/property'));
        }
    }

    /**
    *   @Function: updatePropertyDoc
    */
    public function updatePropertyDoc($id)
    {
        if($this->input->post('property_id'))
        {
            $postdata['title'] = $this->input->post('title');
            $postdata['description'] = $this->input->post('description');
            $req = $this->input->post('required');
            if($req == 1)
            {
                $postdata['required'] = 1;
            }
            else
            {
                $postdata['required'] = 0;
            }
            $pid = $this->input->post('property_id');
            $this->db->where('id', $id);
            $this->db->update(db_prefix().'property_doc', $postdata);
            if($id)
            {
                /*
                if($_FILES['propertydoc']['name'])
                {
                    $this->db->where('rel_id', $id);
                    $this->db->where('rel_type', 'propertydoc');
                    $attachment = $this->db->get(db_prefix() . 'files')->row();
            
                    if ($attachment) {
                        if (empty($attachment->external)) {
                            $relPath  = get_upload_path_by_type('propertydoc') . $attachment->rel_id . '/';
                            $fullPath = $relPath . $attachment->file_name;
                            unlink($fullPath);
                        }
            
                        $this->db->where('id', $attachment->id);
                        $this->db->delete(db_prefix() . 'files');
                        if ($this->db->affected_rows() > 0) {
                            $deleted = true;
                        }
                    }
                    
                    $uploadedFiles = handle_task_attachments_array($id,'propertydoc');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'propertydoc', [$file]);
                        }
                    }    
                }
                */
            }
            set_alert('success', _l('updated_successfully', _l('Property document')));
            redirect(admin_url('properties/documents/'.$pid));
        }
        else
        {
            set_alert('warning', _l('Some error occurred'));
            redirect(admin_url('properties/documentsEdit/'.$id));
        }
    }

    /* Update image */
    public function updateImg($id)
    {
        $id = $this->input->post('id');
        if($id)
        {
            $postdata['defaultimage'] = $this->input->post('defaultimg');
            $this->db->where('id', $id);
            $this->db->update(db_prefix().'property', $postdata);
            if($_FILES['propertyimg']['name'])
            {
                $this->db->where('rel_id', $id);
                $this->db->where('rel_type', 'propertyimg');
                $attachment = $this->db->get(db_prefix() . 'files')->row();
        
                if ($attachment) {
                    if (empty($attachment->external)) {
                        $relPath  = get_upload_path_by_type('propertyimg') . $attachment->rel_id . '/';
                        $fullPath = $relPath . $attachment->file_name;
                        unlink($fullPath);
                    }
        
                    $this->db->where('id', $attachment->id);
                    $this->db->delete(db_prefix() . 'files');
                    if ($this->db->affected_rows() > 0) {
                        $deleted = true;
                    }
        
                }
                
                $uploadedFiles = handle_task_attachments_array($id,'propertyimg');
                if ($uploadedFiles && is_array($uploadedFiles)) {
                    foreach ($uploadedFiles as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'propertyimg', [$file]);
                    }
                }    
            }
            if($_FILES['property1']['name'])
            {
                $attachment = '';
                $this->db->where('rel_id', $id);
                $this->db->where('rel_type', 'property1');
                $attachment = $this->db->get(db_prefix() . 'files')->row();
        
                if ($attachment) {
                    if (empty($attachment->external)) {
                        $relPath  = get_upload_path_by_type('property1') . $attachment->rel_id . '/';
                        $fullPath = $relPath . $attachment->file_name;
                        unlink($fullPath);
                    }
        
                    $this->db->where('id', $attachment->id);
                    $this->db->delete(db_prefix() . 'files');
                    if ($this->db->affected_rows() > 0) {
                        $deleted = true;
                    }
        
                }
                
                $property1 = handle_task_attachments_array($id,'property1');
                if ($property1 && is_array($property1)) {
                    foreach ($property1 as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'property1', [$file]);
                    }
                }   
            }
            if($_FILES['property2']['name'])
            {
                $attachment = '';
                $this->db->where('rel_id', $id);
                $this->db->where('rel_type', 'property2');
                $attachment = $this->db->get(db_prefix() . 'files')->row();
        
                if ($attachment) {
                    if (empty($attachment->external)) {
                        $relPath  = get_upload_path_by_type('property2') . $attachment->rel_id . '/';
                        $fullPath = $relPath . $attachment->file_name;
                        unlink($fullPath);
                    }
        
                    $this->db->where('id', $attachment->id);
                    $this->db->delete(db_prefix() . 'files');
                    if ($this->db->affected_rows() > 0) {
                        $deleted = true;
                    }
        
                }
                
                $property2 = handle_task_attachments_array($id,'property2');
                if ($property2 && is_array($property2)) {
                    foreach ($property2 as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'property2', [$file]);
                    }
                }  
            }
            if($_FILES['property3']['name'])
            {
                $attachment = '';
                $this->db->where('rel_id', $id);
                $this->db->where('rel_type', 'property3');
                $attachment = $this->db->get(db_prefix() . 'files')->row();
        
                if ($attachment) {
                    if (empty($attachment->external)) {
                        $relPath  = get_upload_path_by_type('property3') . $attachment->rel_id . '/';
                        $fullPath = $relPath . $attachment->file_name;
                        unlink($fullPath);
                    }
        
                    $this->db->where('id', $attachment->id);
                    $this->db->delete(db_prefix() . 'files');
                    if ($this->db->affected_rows() > 0) {
                        $deleted = true;
                    }
        
                }
                
                $property3 = handle_task_attachments_array($id,'property3');
                if ($property3 && is_array($property3)) {
                    foreach ($property3 as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'property3', [$file]);
                    }
                }  
            }
            if($_FILES['property4']['name'])
            {
                $attachment = '';
                $this->db->where('rel_id', $id);
                $this->db->where('rel_type', 'property4');
                $attachment = $this->db->get(db_prefix() . 'files')->row();
        
                if ($attachment) {
                    if (empty($attachment->external)) {
                        $relPath  = get_upload_path_by_type('property4') . $attachment->rel_id . '/';
                        $fullPath = $relPath . $attachment->file_name;
                        unlink($fullPath);
                    }
        
                    $this->db->where('id', $attachment->id);
                    $this->db->delete(db_prefix() . 'files');
                    if ($this->db->affected_rows() > 0) {
                        $deleted = true;
                    }
        
                }
                
                $property4 = handle_task_attachments_array($id,'property4');
                if ($property4 && is_array($property4)) {
                    foreach ($property4 as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'property4', [$file]);
                    }
                } 
            }
            if($_FILES['property5']['name'])
            {
                $attachment = '';
                $this->db->where('rel_id', $id);
                $this->db->where('rel_type', 'property5');
                $attachment = $this->db->get(db_prefix() . 'files')->row();
        
                if ($attachment) {
                    if (empty($attachment->external)) {
                        $relPath  = get_upload_path_by_type('property5') . $attachment->rel_id . '/';
                        $fullPath = $relPath . $attachment->file_name;
                        unlink($fullPath);
                    }
        
                    $this->db->where('id', $attachment->id);
                    $this->db->delete(db_prefix() . 'files');
                    if ($this->db->affected_rows() > 0) {
                        $deleted = true;
                    }
        
                }
                
                $property5 = handle_task_attachments_array($id,'property5');
                if ($property5 && is_array($property5)) {
                    foreach ($property5 as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'property5', [$file]);
                    }
                }
            }
            set_alert('success', _l('updated_successfully', _l('Property images')));
            redirect(admin_url('properties/images/'.$id));
        }
        else
        {
            set_alert('warning', _l('Some error occurred'));
            redirect(admin_url('properties/property'));
        }
    }

    /* images */
    public function images($id)
    {
        $sheader_text = title_text('aside_menu_active', 'property');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        $data['agent_list'] = $this->db->get_where(db_prefix().'contacts', array('active' => 1))->result();
        $data['title']     = _l($sheader_text);
        $article         = $this->properties_model->get($id);
        if($article)
        {
            $data['id'] = $id;
            $data['article'] = $article;
            $data['page'] = 'img';
            $this->load->view('admin/properties/propertyimages', $data);   
        }
        else
        {
            set_alert('warning', _l('Some error occurred'));
            redirect(admin_url('properties/property'));
        }
    }

    /* documents */
    public function documents($id)
    {
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('propertyDoc');
        }
        $_SESSION['propertyID'] = $id;
        $sheader_text = title_text('aside_menu_active', 'property');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        $data['agent_list'] = $this->db->get_where(db_prefix().'contacts', array('active' => 1))->result();
        $data['title']     = _l($sheader_text);
        $article         = $this->properties_model->get($id);
        if($article)
        {
            $data['id'] = $id;
            $data['article'] = $article;
            $data['page'] = 'doc';
            $this->load->view('admin/properties/propertydocuments', $data);   
        }
        else
        {
            set_alert('warning', _l('Some error occurred'));
            redirect(admin_url('properties/property'));
        }
    }

    /* documents */
    public function documentsEdit($id, $docid)
    {
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('propertyDoc');
        }
        $sheader_text = title_text('aside_menu_active', 'property');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        $data['agent_list'] = $this->db->get_where(db_prefix().'contacts', array('active' => 1))->result();
        $data['title']     = _l($sheader_text);
        $article         = $this->properties_model->get($id);
        if($article)
        {
            $data['id'] = $id;
            $data['article'] = $article;
            $data['page'] = 'doc';
            $data['doc_res'] = $this->db->get_where(db_prefix().'property_doc', array('id' => $docid))->row();
            $this->load->view('admin/properties/propertydocumentsEdit', $data);   
        }
        else
        {
            set_alert('warning', _l('Some error occurred'));
            redirect(admin_url('properties/property'));
        }
    }

    /* property */
    public function editInfo($id)
    {
        $sheader_text = title_text('aside_menu_active', 'property');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        $data['agent_list'] = $this->db->get_where(db_prefix().'contacts', array('active' => 1))->result();
        $data['title']     = _l($sheader_text);
        $article         = $this->properties_model->get($id);
        $data['article'] = $article;
        $data['page'] = 'info';
        $this->load->view('admin/properties/propertyinfo', $data);   
    }
    
    /**
    *   @ Function: appointment
    **/
    public function appointments($id)
    {
        if($id)
        {
            $_SESSION['propertyID'] = $id;
            if ($this->input->is_ajax_request()) {
                $this->app->get_table_data('appointment');
            }
            $sheader_text = title_text('aside_menu_active', 'property');
            $data['sheading_text'] = $sheader_text;
            $data['sh_text'] = $sheader_text;
            //$data['appointment_list'] = $this->db->get_where(db_prefix().'appointment_booking', array('property_id' => $id))->result();
            $data['title']     = _l($sheader_text);
            
            $article         = $this->properties_model->get($id);
            if($article)
            {
                $data['id'] = $id;
                $data['article'] = $article;
                $data['page'] = 'appointment';
                $this->load->view('admin/properties/appointment', $data);   
            }
            else
            {
                set_alert('warning', _l('Some error occurred'));
                redirect(admin_url('properties/property'));
            }
        }
        else
        {
            redirect(admin_url('properties'));
        }
    }

    /* Add new article or edit existing*/
    public function add($id = '')
    {
        if (!has_permission('properties', '', 'view')) {
            access_denied('properties');
        }
        if ($this->input->post()) {
            $data                = $this->input->post();
            //echo '<pre>'; print_r($data); die;
            if ($id == '') {
                if (!has_permission('properties', '', 'create')) {
                    access_denied('properties');
                }
                $id = $this->properties_model->add_article($data);
                if ($id) {
                    
                    $uploadedFiles = handle_task_attachments_array($id,'propertyimg');
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'propertyimg', [$file]);
                        }
                    }
                    $uploadedDoc = handle_task_attachments_array($id,'documents');
                    if ($uploadedDoc && is_array($uploadedDoc)) {
                        foreach ($uploadedDoc as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'documents', [$file]);
                        }
                    }
                    $property1 = handle_task_attachments_array($id,'property1');
                    if ($property1 && is_array($property1)) {
                        foreach ($property1 as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'property1', [$file]);
                        }
                    }
                    $property2 = handle_task_attachments_array($id,'property2');
                    if ($property2 && is_array($property2)) {
                        foreach ($property2 as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'property2', [$file]);
                        }
                    }
                    $property3 = handle_task_attachments_array($id,'property3');
                    if ($property3 && is_array($property3)) {
                        foreach ($property3 as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'property3', [$file]);
                        }
                    }
                    $property4 = handle_task_attachments_array($id,'property4');
                    if ($property4 && is_array($property4)) {
                        foreach ($property4 as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'property4', [$file]);
                        }
                    }
                    $property5 = handle_task_attachments_array($id,'property5');
                    if ($property5 && is_array($property5)) {
                        foreach ($property5 as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'property5', [$file]);
                        }
                    }
                    
                    set_alert('success', _l('added_successfully', _l('Property')));
                    redirect(admin_url('properties'));
                }
            } else {
                if (!has_permission('properties', '', 'edit')) {
                    access_denied('properties');
                }
                $success = $this->properties_model->update_article($data, $id);
                
                $uploadedFiles = handle_task_attachments_array($id,'propertyimg');
                if ($uploadedFiles && is_array($uploadedFiles)) {
                    foreach ($uploadedFiles as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'propertyimg', [$file]);
                    }
                }
                $uploadedDoc = handle_task_attachments_array($id,'documents');
                if ($uploadedDoc && is_array($uploadedDoc)) {
                    foreach ($uploadedDoc as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'documents', [$file]);
                    }
                }
                $property1 = handle_task_attachments_array($id,'property1');
                if ($property1 && is_array($property1)) {
                    foreach ($property1 as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'property1', [$file]);
                    }
                }
                $property2 = handle_task_attachments_array($id,'property2');
                if ($property2 && is_array($property2)) {
                    foreach ($property2 as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'property2', [$file]);
                    }
                }
                $property3 = handle_task_attachments_array($id,'property3');
                if ($property3 && is_array($property3)) {
                    foreach ($property3 as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'property3', [$file]);
                    }
                }
                $property4 = handle_task_attachments_array($id,'property4');
                if ($property4 && is_array($property4)) {
                    foreach ($property4 as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'property4', [$file]);
                    }
                }
                $property5 = handle_task_attachments_array($id,'property5');
                if ($property5 && is_array($property5)) {
                    foreach ($property5 as $file) {
                        $this->misc_model->add_attachment_to_database($id, 'property5', [$file]);
                    }
                }
                
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('Property')));
                }
                redirect(admin_url('properties'));
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('Property'));
        } else {
            $article         = $this->properties_model->get($id);
            //echo '<pre>'; print_r($article); die;
            $data['article'] = $article;
        }
        $sheader_text = title_text('aside_menu_active', 'property');
        $data['sheading_text'] = $sheader_text;
        $data['sh_text'] = $sheader_text;
        $data['agent_list'] = $this->db->get_where(db_prefix().'contacts', array('active' => 1))->result();
        $data['title']     = _l($sheader_text);
        $this->load->view('admin/properties/property', $data);
    }
   
    public function save() {
        // If file uploaded
        if(is_uploaded_file($_FILES['fileURL']['tmp_name'])) {                            
            // Parse data from CSV file
            $csvData = $this->csvreader->parse_csv($_FILES['fileURL']['tmp_name']);       
            //echo '<pre>'; print_r($csvData); die;
            // create array from CSV file
            if(!empty($csvData)){
                foreach($csvData as $element){                    
                    // Prepare data for Database insertion
                    $data = array(
                        'name' => $element['properties']
                    );
                    $exitproperties = $this->db->get_where(db_prefix().'property', array('name' => $data['name']))->row('name');
                    if($exitproperties != '')
                    {
                        
                    }
                    else
                    {
                        $this->db->insert(db_prefix() . 'properties', $data);
                        $data[] = '';
                    }
                }
                set_alert('success', _l('Data are stored successful!'));
            }
            else
            {
                set_alert('warning', _l('File is required'));
            }
        }
        else
        {
            set_alert('warning', _l('File is required'));
        } 
        redirect(admin_url('properties'));
    }
    
    // export Data
    public function sampledata() {
        $storData = array();
        $data[] = array('name' => 'properties');       
        
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"csv-sample-properties".".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");
        $handle = fopen('php://output', 'w');
        foreach ($data as $data) {
            fputcsv($handle, $data);
        }
            fclose($handle);
        exit;
    }

    /* Delete article from database */
    public function delete_properties($id)
    {
        if (!has_permission('properties', '', 'delete')) {
            access_denied('properties');
        }
        if (!$id) {
            redirect(admin_url('properties'));
        }
        $response = $this->properties_model->delete_article($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('Property')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('Property')));
        }
        redirect(admin_url('properties'));
    }
    
    /* delete_doc */
    public function delete_doc($id, $did)
    {
        if($did)
        {
            $this->db->where('id', $did);
            $this->db->delete(db_prefix() . 'property_doc');
            if ($this->db->affected_rows() > 0) {
                $this->db->where('rel_id', $did);
                $this->db->where('rel_type', 'propertydoc');
                $attachment = $this->db->get(db_prefix() . 'files')->row();
        
                if ($attachment) {
                    if (empty($attachment->external)) {
                        $relPath  = get_upload_path_by_type('propertydoc') . $attachment->rel_id . '/';
                        $fullPath = $relPath . $attachment->file_name;
                        unlink($fullPath);
                    }
        
                    $this->db->where('id', $attachment->id);
                    $this->db->delete(db_prefix() . 'files');
                    if ($this->db->affected_rows() > 0) {
                        $deleted = true;
                    }
                }
                set_alert('success', _l('deleted', _l('Documents')));
                redirect(admin_url('properties/documents/'.$id));
            }
        }
    }
}
