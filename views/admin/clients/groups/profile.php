<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h4 class="customer-profile-group-heading"><?php echo _l('client_add_edit_profile'); ?></h4>
<script>
    $(document).ready(function(){
        $('input[type="email"]').keyup(function(){
            let email =($(this).val());
            console.log(email);
            return false;
            if(isEmail(email)==true){
                $.ajax({
                    url: '<?= site_url('admin/hr/checkEmail/').$this->uri->segment(4);?>',
                    type: 'POST',
                    data: {'email':email},
                    datatype: 'json',
                    cache: false,
                    success: function(resp_response){
                        if(resp_response==0){
                            $('#email_error').text('Invalid email');
                            $('#email_error').css('color','red');
                            $('.btn-success').attr('type','button');
                        }else{
                            $('#email_error').text('Valid email');
                            $('#email_error').css('color','green');
                            $('.btn-success').attr('type','submit');
                        }
                    }
                });
            }else{
                $('#email_error').text('Invalid email');
                $('#email_error').css('color','red');
                $('.btn-success').attr('type','button');
            }
        })
        
    })
</script>
<div class="row">
   <?php echo form_open_multipart($this->uri->uri_string(),array('class'=>'client-form','autocomplete'=>'off')); ?>
   <div class="additional"></div>
   <div class="col-md-12">
      <div class="horizontal-scrollable-tabs">
         <div class="scroller arrow-left"><i class="fa fa-angle-left"></i></div>
         <div class="scroller arrow-right"><i class="fa fa-angle-right"></i></div>
         <div class="horizontal-tabs">
            <ul class="nav nav-tabs profile-tabs row customer-profile-tabs nav-tabs-horizontal" role="tablist">
               <li role="presentation" class="<?php if(!$this->input->get('tab')){echo 'active';}; ?>">
                  <a href="#contact_info" aria-controls="contact_info" role="tab" data-toggle="tab">
                  <?php echo _l( $heading_text.' details'); ?>
                  </a>
               </li>
               <?php
                  $customer_custom_fields = false;
                  if(total_rows(db_prefix().'customfields',array('fieldto'=>'customers','active'=>1)) > 0 ){
                       $customer_custom_fields = true;
                   ?>
               <li role="presentation" class="<?php if($this->input->get('tab') == 'custom_fields'){echo 'active';}; ?> hidden">
                  <a href="#custom_fields" aria-controls="custom_fields" role="tab" data-toggle="tab">
                  <?php echo hooks()->apply_filters('customer_profile_tab_custom_fields_text', _l( 'custom_fields')); ?>
                  </a>
               </li>
               <?php } ?>
               <li role="presentation" class="hidden">
                  <a href="#billing_and_shipping" aria-controls="billing_and_shipping" role="tab" data-toggle="tab">
                  <?php echo _l( 'billing_shipping'); ?>
                  </a>
               </li>
               <?php hooks()->do_action('after_customer_billing_and_shipping_tab', isset($client) ? $client : false); ?>
               <?php if(isset($client)){ ?>
               <li role="presentation">
                  <a href="#customer_admins" aria-controls="customer_admins" role="tab" data-toggle="tab" class="hidden">
                  <?php echo _l( 'customer_admins' ); ?>
                  </a>
               </li>
               <?php hooks()->do_action('after_customer_admins_tab',$client); ?>
               <?php } ?>
            </ul>
         </div>
      </div>
      <div class="tab-content mtop15">
         <?php hooks()->do_action('after_custom_profile_tab_content',isset($client) ? $client : false); ?>
         <?php if($customer_custom_fields) { ?>
         <div role="tabpanel" class="tab-pane <?php if($this->input->get('tab') == 'custom_fields'){echo ' active';}; ?>" id="custom_fields">
            <?php /* $rel_id=( isset($client) ? $client->userid : false); ?>
            <?php echo render_custom_fields( 'customers',$rel_id); */?>

           
         </div>
         <?php } ?>
         <div role="tabpanel" class="tab-pane<?php if(!$this->input->get('tab')){echo ' active';}; ?>" id="contact_info">

           <div class="row">
             <?php
                if(isset($client->userid))
                {
                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $client->userid, 'rel_type' => 'profile_image'))->row('file_name');
                    ?>
                       <div class="col-md-2 form-group">
                           <?= _l('Select Profile'); ?>
                           <a href="<?= base_url('uploads/profile_image/'.$client->userid.'/'.$filename); ?>" target="_blank">
                           <img onerror="this.style.display = 'none'" src="<?= base_url('uploads/profile_image/'.$client->userid.'/'.$filename); ?>" width="100" height="100">
                          
                        </a>
                       </div> 
                    <?php
                }
           ?>
           
            <div class="col-md-4 form-group">
               <?= _l('Profile Upload'); ?><sup></sup>
               <input type="file" class="form-control" name="profile_image" onchange="checkImage(this);" accept="image/*">
           </div>
                     
           </div>
            <!-- Custome field -->
            <div class="form-group">
                <?php
                 $ii = 1;
                 $customeFields_arr = $this->db->get_where('tblcustomer_selected_custom_field')->row();
                 $custome_field = explode(',',$customeFields_arr->custom_field_id);
                 $custome_required = explode(',',$customeFields_arr->custom_field_required);
                 //echo ''; print_r($custome_field); die;
                 $city_ = '';
                 $state_ = '';
                 $country_ = '';
                 $address_ = '';;
                 if($custome_field)
                 {
                    foreach ($custome_field as $value) {
                        if($value == 'city')
                        {
                            $city_ = 1;
                        }
                        elseif($value == 'city')
                        {
                            $city_ = 1;
                        }
                        elseif($value == 'company_name')
                        {
                            $company_name_ = 1;
                        }
                        elseif($value == 'state')
                        {
                            $state_ = 1;
                        }
                        elseif($value == 'country')
                        {
                            $country_ = 1;
                        }
                        elseif($value == 'address')
                        {
                            $address_ = 1;
                        }
                        elseif($value == 'phone')
                        {
                            $phone_ = 1;
                        }
                        elseif($value == 'zip')
                        {
                            $zip_ = 1;
                        }
                        elseif($value == 'website')
                        {
                            $website_ = 1;
                        }
                        elseif($value == 'currency')
                        {
                            $currency_ = 1;
                        }
                        elseif($value == 'vat_number')
                        {
                            $vat_number_ = 1;
                        }
                        else
                        {
                            $edit_company = $this->db->get_where(db_prefix() . 'contacts', array('userid' => $client->userid))->row();
                            if($value == 'email')
                            {
                                ?>
                                <div class="row form-group">
                                  <div class="col-md-6">
                                     <label><?= ucfirst(str_replace('_',' ',$value)); ?><?= (in_array($value, $custome_required))?"<span class='text-danger'>*</span>":"";?></label>
                                     <input type="email" id="<?= $value; ?>" value="<?= @$edit_company->email; ?>" name="<?= $value; ?>" class="form-control" <?= (in_array($value, $custome_required))?"required":"";?>/>
                                     <span id="email_error"></span>
                                  </div>
                               <?php
                            }
                            elseif($value == 'password')
                            {
                                if($client->userid)
                                {
                                    ?>
                                        </div>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                            <div class="col-md-6">
                                                 <label><?= ucfirst(str_replace('_',' ',$value)); ?><?= (in_array($value, $custome_required))?"<span class='text-danger'>*</span>":"";?></label>
                                                <input type="password" id="<?= $value; ?>" name="<?= $value; ?>" class="form-control" <?= (in_array($value, $custome_required))?"required":"";?>/>
                                            </div>
                                        </div>
                                    <?php
                                } 
                            }
                            elseif($value == 'zip_code')
                            {
                                ?>
                                  <div class="col-md-6">
                                     <label><?= ucfirst(str_replace('_',' ',$value)); ?><?= (in_array($value, $custome_required))?"<span class='text-danger'>*</span>":"";?></label>
                                     <input type="number" id="<?= $value; ?>" value="<?= $client->zip; ?>" name="<?= $value; ?>" class="form-control" <?= (in_array($value, $custome_required))?"required":"";?>/>
                                  </div>
                                  </div>
                               <?php
                            }
                            elseif($value == 'first_name')
                            {
                                ?>
                                <div class="row form-group">
                                  <div class="col-md-6">
                                     <label><?= ucfirst(str_replace('_',' ',$value)); ?><?= (in_array($value, $custome_required))?"<span class='text-danger'>*</span>":"";?></label>
                                     <input type="text"  maxlength="20" minlength="2"  id="<?= $value; ?>" value="<?= @$edit_company->firstname; ?>" name="<?= $value; ?>" class="form-control" <?= (in_array($value, $custome_required))?"required":"";?>/>
                                  </div>
                               <?php
                            }
                            elseif($value == 'last_name')
                            {
                                ?>
                                  <div class="col-md-6">
                                     <label><?= ucfirst(str_replace('_',' ',$value)); ?><?= (in_array($value, $custome_required))?"<span class='text-danger'>*</span>":"";?></label>
                                     <input type="text"  maxlength="20" minlength="2"  id="<?= $value; ?>" value="<?= @$edit_company->lastname; ?>" name="<?= $value; ?>" class="form-control" <?= (in_array($value, $custome_required))?"required":"";?>/>
                                  </div>
                                  </div>
                               <?php
                            }
                            else
                            {
                                ?>
                                  <div class="col-md-6">
                                     <label><?= ucfirst(str_replace('_',' ',$value)); ?><?= (in_array($value, $custome_required))?"<span class='text-danger'>*</span>":"";?></label>
                                     <input type="text" id="<?= $value; ?>" name="<?= $value; ?>" class="form-control" <?= (in_array($value, $custome_required))?"required":"";?>/><hr/>
                                  </div>
                               <?php
                            }
                           $ii++;
                        }
                    }
                 }
               ?> 
                <div class="row form-group">
                    <div class="col-md-6">
                        <?php 
                            if($phone_ = 1){
                                $value=( isset($client) ? $client->phonenumber : ''); 
                                ?>
                                <?php 
                                    if(in_array('phone', $custome_required))
                                    {
                                        $attrs = (isset($client) ? array() : array('autofocus'=>true, 'required'=>'required')); 
                                    }
                                    else
                                    {
                                        $attrs = (isset($client) ? array() : array('autofocus'=>true)); 
                                    }
                                ?>
                                <?php echo render_input( 'phonenumber', 'client_phonenumber',$value, 'text', $attrs); 
                            }
                        ?>
                    </div>
                    <div class="col-md-6">
                        <label><?= _l('Alternative Number'); ?><span class='text-danger'>*</span></label>
                        <input type="text" class="form-control" name="alternative_mobile" value="<?= @$edit_company->alternative_mobile; ?>" required>
                    </div>
                </div>
                <div class="row form-group">

                    <div class="col-md-3">
                        <label><?= _l('Gender'); ?><span class='text-danger'>*</span></label>
                        <select class="form-control" data-live-search="true" name="gender" required>
                              <option value="">Select Gender</option>
                              <option <?= ($edit_company->gender == 'Female')?"selected":""; ?> value="Female">Female</option>
                              <option <?= ($edit_company->gender == 'Male')?"selected":""; ?> value="Male">Male</option>
                              <option <?= ($edit_company->gender == 'Not defined')?"selected":""; ?> value="Not defined">Not defined</option>
                                         
                         </select>
                    </div>
                    <div class="col-md-3">
                        <label><?= _l('Budget Amount'); ?><span class='text-danger'>*</span></label>
                         <input type="number" class="form-control" name="budget_amount" value="<?= @$edit_company->budget_amount; ?>" required>
                    </div>
                    <div class="col-md-3">
                         <label><?= _l('Date of birth'); ?><span class='text-danger'>*</span></label>
                        <input type="text" class="form-control datepicker" name="dob" value="<?= getDateDMYOnly(@$edit_company->dob); ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label><?= _l('Date of Joining'); ?><span class='text-danger'>*</span></label>
                        <input type="text" class="form-control datepicker" name="doj" value="<?= getDateDMYOnly(@$edit_company->doj); ?>" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <label><?= _l('Address'); ?><span class='text-danger'>*</span></label>
                        <input type="text" class="form-control" name="address" value="<?= @$edit_company->address; ?>" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                      <?php 
                        $country_list = $this->db->get_where(db_prefix().'country')->result();

                      ?>
                        <label><?= _l('Country'); ?><span class='text-danger'>*</span></label>
                        <select class="form-control selectpicker" data-live-search="true" name="country" required  onchange="getStatelist(this.value);">
                              <option value=""></option>
                              <?php
                                  if($country_list)
                                  {
                                      foreach($country_list as $res)
                                      {
                                          ?>
                                              <option <?= ($edit_company->country == $res->id)?"selected":""; ?> value="<?= $res->id; ?>"><?= $res->name; ?></option>
                                          <?php
                                      }
                                  }
                              ?>
                         </select>
                    </div>
                    <div class="col-md-3">
                        <label><?= _l('State'); ?><span class='text-danger'>*</span></label>
                         <select class="form-control" name="state" required id="state" onchange="getCitylist(this.value);">
                          <?php if($edit_company->state!='')
                          {
                            $state_list = $this->db->get_where(db_prefix().'state',array('country_id'=>$edit_company->country))->result();
                            if($state_list)
                            {
                                foreach($state_list as $res)
                                {
                                    ?>
                                        <option <?= ($edit_company->state == $res->id)?"selected":""; ?> value="<?= $res->id; ?>"><?= $res->name; ?></option>
                                    <?php
                                }
                            }
                          
                        }
                        else
                        { 
                        ?>
                            <option value=""></option>
                        <?php } ?>
                         </select>
                    </div>
                    <div class="col-md-3">
                        <label><?= _l('City'); ?><span class='text-danger'>*</span></label>
                         <select class="form-control" name="city" required id="city">
                            <?php if($edit_company->city!='')
                            {
                                
                                $city_list = $this->db->get_where(db_prefix().'city',array('state_id'=>$edit_company->state))->result();    
                                if($city_list)
                                {
                                    foreach($city_list as $res)
                                    {
                                        ?>
                                            <option <?= ($edit_company->city == $res->id)?"selected":""; ?> value="<?= $res->id; ?>"><?= $res->name; ?></option>
                                        <?php
                                    }
                                }
                           
                            }
                            else
                            { 
                            ?>
                             <option value=""></option>
                          <?php } ?>
                         </select>
                    </div>
                    <div class="col-md-3">
                        <label><?= _l('Postal Code'); ?><span class='text-danger'>*</span></label>
                        <input type="text" class="form-control" name="postal_code" value="<?= @$edit_company->postal_code; ?>" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <label><?= _l('Address'); ?><span class='text-danger'></span></label>
                        <input type="text" class="form-control" name="address2" value="<?= @$edit_company->address2; ?>" >
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                      <?php 
                        $country_list = $this->db->get_where(db_prefix().'country')->result();

                      ?>
                        <label><?= _l('Country'); ?><span class='text-danger'></span></label>
                        <select class="form-control selectpicker" data-live-search="true" name="country2"   onchange="getStatelist2(this.value);">
                              <option value=""></option>
                              <?php
                                  if($country_list)
                                  {
                                      foreach($country_list as $res)
                                      {
                                          ?>
                                              <option <?= ($edit_company->country2 == $res->id)?"selected":""; ?> value="<?= $res->id; ?>"><?= $res->name; ?></option>
                                          <?php
                                      }
                                  }
                              ?>
                         </select>
                    </div>
                    <div class="col-md-3">
                        <label><?= _l('State'); ?><span class='text-danger'></span></label>
                         <select class="form-control" name="state2"  id="state2" onchange="getCitylist2(this.value);">
                          <?php if($edit_company->state2!='')
                          {
                            $state_list = $this->db->get_where(db_prefix().'state',array('country_id'=>$edit_company->country2))->result();
                            if($state_list)
                            {
                                foreach($state_list as $res)
                                {
                                    ?>
                                        <option <?= ($edit_company->state2 == $res->id)?"selected":""; ?> value="<?= $res->id; ?>"><?= $res->name; ?></option>
                                    <?php
                                }
                            }
                           
                        }
                        else
                        { 
                        ?>
                            <option value=""></option>
                        <?php } ?>
                         </select>
                    </div>
                    <div class="col-md-3">
                        <label><?= _l('City'); ?><span class='text-danger'></span></label>
                         <select class="form-control" name="city2"  id="city2">
                            <?php if($edit_company->city2!='')
                            {
                                $city_list = $this->db->get_where(db_prefix().'city',array('state_id'=>$edit_company->state2))->result();    
                                if($city_list)
                                {
                                    foreach($city_list as $res)
                                    {
                                        ?>
                                            <option <?= ($edit_company->city2 == $res->id)?"selected":""; ?> value="<?= $res->id; ?>"><?= $res->name; ?></option>
                                        <?php
                                    }
                                }
                            
                            }
                            else
                            { 
                            ?>
                             <option value=""></option>
                          <?php } ?>
                         </select>
                    </div>
                    <div class="col-md-3">
                        <label><?= _l('Postal Code'); ?><span class='text-danger'></span></label>
                        <input type="text" class="form-control" name="postal_code2" value="<?= @$edit_company->postal_code2; ?>" >
                    </div>
                </div>
                <div class="row form-group" id="servicetd">
                   
                    <div class="col-md-3">
                        <label><?= _l('Office Location'); ?><span class='text-danger'>*</span></label>
                        <select name="office_location" class="form-control" data-live-search="true" required>
                             <option value="">Select Office Location</option>
                             <?php
                              $officeLocation_list = $this->db->get_where(db_prefix().'office_location')->result();

                                  if($officeLocation_list)
                                  {
                                      foreach($officeLocation_list as $oorst)
                                      {
                                          ?>
                                              <option value="<?= $oorst->name; ?>" <?= ($edit_company->office_location == $oorst->name)?"selected":""; ?>><?= $oorst->name; ?></option>
                                          <?php
                                      }
                                  }
                             ?>
                        </select>

                       
                    </div>
              
                    <div class="col-md-3">
                        <label><?= _l('Service Type'); ?><span class='text-danger'>*</span></label>
                        <select name="service_type[]"  class="form-control selectpicker" placeholder="select Service type" id="service_type" data-live-search="true"  multiple="" onchange="getServiceType(this.value)">
                           
                          

                              <?php 
                                       if($edit_company->service_type!=''){
                                                $service_types = explode(",",$edit_company->service_type);
                                                
                                                $service_type_res = $this->db->get_where(db_prefix().'service_type')->result();

                                            foreach($service_type_res as $row_s)
                                            {
                                                if (in_array($row_s->id, $service_types))
                                                {
                                                    echo $selected = 'selected';
                                                }
                                                else
                                                {
                                                    echo    $selected = '';
                                                }   
                                              
                                                    echo "<option value='".$row_s->id."' ".$selected." >".$row_s->name."</option>";
                                                
                                            }
                                         }else{
                                          ?>
                                          <?php
                                           $service_type_rees = $this->db->get_where(db_prefix().'service_type')->result();

                                            if($service_type_rees)
                                            {
                                                foreach($service_type_rees as $rs)
                                                {
                                                    ?>
                                                        <option value="<?= $rs->id; ?>" <?= ($edit_company->service_type == $rs->id)?"selected":""; ?>><?= $rs->name; ?></option>
                                                    <?php
                                                }
                                            }
                                       ?> 

                                      <?php } ?>


                        </select>
                        <span id="service_type_error" class="text-danger" style="display:none;">This field is required.</span>
                    </div>
                    <div class="col-md-3">
                        <label><?= _l('Program/Department'); ?><span class='text-danger'>*</span></label>
                        <select name="department_id[]"  class="form-control selectpicker" placeholder="Select department" data-live-search="true" id="department_id" multiple="" onchange="getdepartment(this.value)">
                            

                              <?php 
                                       if($edit_company->department_id!=''){
                                                $department_ids = explode(",",$edit_company->department_id);
                                                
                                                $result_m = $this->db->get_where(db_prefix().'department')->result();

                                            foreach($result_m as $row_m)
                                            {
                                                if (in_array($row_m->id, $department_ids))
                                                {
                                                    echo $selected = 'selected';
                                                }
                                                else
                                                {
                                                    echo    $selected = '';
                                                }   
                                              
                                                    echo "<option value='".$row_m->id."' ".$selected." >".$row_m->name."</option>";
                                                
                                            }
                                         }else{
                                          ?>
                                          <?php
                                           $department_res = $this->db->get_where(db_prefix().'department')->result();

                                            if($department_res)
                                            {
                                                foreach($department_res as $r)
                                                {
                                                    ?>
                                                        <option value="<?= $r->id; ?>" <?= ($edit_company->department_id == $r->id)?"selected":""; ?>><?= $r->name; ?></option>
                                                    <?php
                                                }
                                            }
                                       ?> 

                                      <?php } ?>


                             
                        </select>
                        <span id="department_id_error" class="text-danger" style="display:none;">This field is required.</span>
                    </div>
                    <div class="col-md-3">
                      <?php 
                        $clo_list = $this->db->select('userid,firstname,lastname')->get_where(db_prefix().'contacts', array('role' => 3,'active'=>1))->result();

                      ?>
                        <label><?= _l('Client Liaison Office'); ?><span class='text-danger'>*</span></label>
                        <select class="form-control " data-live-search="true" name="clo_id" id="clo_id" required>
                              <option value=""></option>
                              <?php
                                  if($clo_list)
                                  {
                                      foreach($clo_list as $res)
                                      {
                                          ?>
                                              <option <?= ($edit_company->added_by == $res->userid)?"selected":""; ?> value="<?= $res->userid; ?>"><?= $res->firstname.' '.$res->lastname; ?></option>
                                          <?php
                                      }
                                  }
                              ?>
                         </select>
                    </div>
                </div>
            </div> 
             <!--// -->
             
            <!-- Custome field --> 
            <?php hooks()->do_action('after_custom_profile_tab_content',isset($client) ? $client : false); ?>
             <?php if($customer_custom_fields) { ?>
                <?php $rel_id=( isset($client) ? $client->userid : false); ?>
                <?php echo render_custom_fields( 'customers',$rel_id); ?>
             <?php } ?>
            <!--// -->
            <div class="row">
               <div class="hide col-md-12 mtop15 <?php if(isset($client) && (!is_empty_customer_company($client->userid) && total_rows(db_prefix().'contacts',array('userid'=>$client->userid,'is_primary'=>1)) > 0)) { echo ''; } else {echo ' hide';} ?>" id="client-show-primary-contact-wrapper">
                  <div class="checkbox checkbox-info mbot20 no-mtop">
                     <input type="checkbox" name="show_primary_contact"<?php if(isset($client) && $client->show_primary_contact == 1){echo ' checked';}?> checked value="1" id="show_primary_contact">
                     <label for="show_primary_contact"><?php echo _l('show_primary_contact',_l('invoices').', '._l('estimates').', '._l('payments').', '._l('credit_notes')); ?></label>
                  </div>
               </div>
               <div class="col-md-6">
                   <?php
                        if($company_name_ == 1)
                        {
                            ?>
                                <?php $value=( isset($client) ? $client->company : ''); ?>
                                <?php 
                                    if(in_array('company_name', $custome_required))
                                    {
                                        $attrs = (isset($client) ? array() : array('autofocus'=>true, 'required'=>'required')); 
                                    }
                                    else
                                    {
                                        $attrs = (isset($client) ? array() : array('autofocus'=>true)); 
                                    }
                                ?>
                                <?php echo render_input( 'company', 'client_company',$value,'text',$attrs); ?>
                                <div id="company_exists_info" class="hide"></div>
                            <?php
                        }
                   ?>
                  <?php 
                    if(in_array('vat_number', $custome_field)){
                        if(get_option('company_requires_vat_number_field') == 1){
                         $value=( isset($client) ? $client->vat : '');
                         if(in_array('vat_number', $custome_required))
                            {
                                $attrs = (isset($client) ? array() : array('autofocus'=>true, 'required'=>'required')); 
                            }
                            else
                            {
                                $attrs = (isset($client) ? array() : array('autofocus'=>true)); 
                            }
                         echo render_input( 'vat', 'client_vat_number',$value, 'text',$attrs);
                         } 
                     }
                     ?>
                     <!-- <div id="vat_number_exists_info" class="hide"></div> -->
                  
                  <?php 
                  if(in_array('website', $custome_field)){
                    if((isset($client) && empty($client->website)) || !isset($client)){
                        $value=( isset($client) ? $client->website : '');
                        if(in_array('website', $custome_required))
                        {
                            $attrs = (isset($client) ? array() : array('autofocus'=>true, 'required'=>'required')); 
                        }
                        else
                        {
                            $attrs = (isset($client) ? array() : array('autofocus'=>true)); 
                        }
                        echo render_input( 'website', 'client_website',$value,'url', $attrs);
                    } else { ?>
                  <div class="form-group">
                     <label for="website"><?php echo _l('client_website'); ?></label>
                     <div class="input-group">
                        <input type="url" name="website" id="website" value="<?php echo $client->website; ?>" <?= (in_array('website', $custome_required))?"required":"";?> class="form-control">
                        <div class="input-group-addon">
                           <span><a href="<?php echo maybe_add_http($client->website); ?>" target="_blank" tabindex="-1"><i class="fa fa-globe"></i></a></span>
                        </div>
                     </div>
                  </div>
                  <?php }
                  }
                     $selected = array();
                     // if(isset($customer_groups)){
                     //   foreach($customer_groups as $group){
                     //      array_push($selected,$group['groupid']);
                     //   }
                     // }
                     // if(is_admin() || get_option('staff_members_create_inline_customer_groups') == '1'){
                     //  echo render_select_with_input_group('groups_in[]',$groups,array('id','name'),'customer_groups',$selected,'<a href="#" data-toggle="modal" data-target="#customer_group_modal"><i class="fa fa-plus"></i></a>',array('multiple'=>true,'data-actions-box'=>true),array(),'','',false);
                     //  } else {
                     //    echo render_select('groups_in[]',$groups,array('id','name'),'customer_groups',$selected,array('multiple'=>true,'data-actions-box'=>true),array(),'','',false);
                     //  }
                     ?>
                  <?php if(!isset($client)){ ?>
                  <!--<i class="fa fa-question-circle pull-left" data-toggle="tooltip" data-title="<?php echo _l('customer_currency_change_notice'); ?>"></i>-->
                  <?php }
                     $s_attrs = array('data-none-selected-text'=>_l('system_default_string'));
                     $selected = '';
                     if(isset($client) && client_have_transactions($client->userid)){
                        $s_attrs['disabled'] = true;
                     }
                     foreach($currencies as $currency){
                        if(isset($client)){
                          if($currency['id'] == $client->default_currency){
                            $selected = $currency['id'];
                         }
                      }
                     }
                     if(in_array('currency', $custome_field))
                     {
                        // Do not remove the currency field from the customer profile!
                        echo render_select('default_currency',$currencies,array('id','name','symbol'),'invoice_add_edit_currency',$selected,$s_attrs); 
                     }
                     ?>
                  <?php if(get_option('disable_language') == 0){ ?>
                  <div class="form-group select-placeholder" style="display:none;">
                     <label for="default_language" class="control-label"><?php echo _l('localization_default_language'); ?>
                     </label>
                     <select name="default_language" id="default_language" class="form-control selectpicker" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                        <option value=""><?php echo _l('system_default_string'); ?></option>
                        <?php foreach($this->app->get_available_languages() as $availableLanguage){
                           $selected = '';
                           if(isset($client)){
                              if($client->default_language == $availableLanguage){
                                 $selected = 'selected';
                              }
                           }
                           ?>
                        <option value="<?php echo $availableLanguage; ?>" <?php echo $selected; ?>><?php echo ucfirst($availableLanguage); ?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <?php } ?>
               </div>
               <div class="col-md-6">
                  <?php
                    if($address_ == 1){
                    $value=( isset($client) ? $client->address : ''); ?>
                    <?php 
                        if(in_array('address', $custome_required))
                        {
                            $attrs = (isset($client) ? array() : array('autofocus'=>true, 'required'=>'required')); 
                        }
                        else
                        {
                            $attrs = (isset($client) ? array() : array('autofocus'=>true)); 
                        }
                    ?>
                  <?php echo render_textarea( 'address', 'client_address',$value, 'textarea', $attrs); } ?>
                  <?php 
                  if($city_ == 1){
                    $value=( isset($client) ? $client->city : ''); ?>
                    <?php 
                        if(in_array('city', $custome_required))
                        {
                            $attrs = (isset($client) ? array() : array('autofocus'=>true, 'required'=>'required')); 
                        }
                        else
                        {
                            $attrs = (isset($client) ? array() : array('autofocus'=>true)); 
                        }
                    ?>
                  <?php echo render_input( 'city', 'client_city',$value, 'text', $attrs); } ?>
                  <?php 
                    if($state_ == 1){
                    $value=( isset($client) ? $client->state : ''); ?>
                    <?php 
                        if(in_array('state', $custome_required))
                        {
                            $attrs = (isset($client) ? array() : array('autofocus'=>true, 'required'=>'required')); 
                        }
                        else
                        {
                            $attrs = (isset($client) ? array() : array('autofocus'=>true)); 
                        }
                    ?>
                  <?php echo render_input( 'state', 'client_state',$value, 'text', $attrs); } ?>
                  <?php 
                    if($zip_ == 1){
                        $value=( isset($client) ? $client->zip : ''); ?>
                    <?php 
                        if(in_array('zip', $custome_required))
                        {
                            $attrs = (isset($client) ? array() : array('autofocus'=>true, 'required'=>'required')); 
                        }
                        else
                        {
                            $attrs = (isset($client) ? array() : array('autofocus'=>true)); 
                        }
                    ?>
                  <?php echo render_input( 'zip', 'client_postal_code',$value, 'text', $attrs); }?>
                  <?php 
                    if($country_ == 1)
                    {
                        $countries= get_all_countries();
                        $customer_default_country = get_option('customer_default_country');
                        $selected =( isset($client) ? $client->country : $customer_default_country);
                        echo render_select( 'country',$countries,array( 'country_id',array( 'short_name')), 'clients_country',$selected,array('data-none-selected-text'=>_l('dropdown_non_selected_tex')));
                    }
                ?>
               </div>
            </div>
         </div>
         <?php if(isset($client)){ ?>
         <div role="tabpanel" class="tab-pane" id="customer_admins">
            <?php if (has_permission('customers', '', 'create') || has_permission('customers', '', 'edit')) { ?>
            <a href="#" data-toggle="modal" data-target="#customer_admins_assign" class="btn btn-info mbot30"><?php echo _l('assign_admin'); ?></a>
            <?php } ?>
            <table class="table dt-table">
               <thead>
                  <tr>
                     <th><?php echo _l('staff_member'); ?></th>
                     <th><?php echo _l('customer_admin_date_assigned'); ?></th>
                     <?php if(has_permission('customers','','create') || has_permission('customers','','edit')){ ?>
                     <th><?php echo _l('options'); ?></th>
                     <?php } ?>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach($customer_admins as $c_admin){ ?>
                  <tr>
                     <td><a href="<?php echo admin_url('profile/'.$c_admin['staff_id']); ?>">
                        <?php echo staff_profile_image($c_admin['staff_id'], array(
                           'staff-profile-image-small',
                           'mright5'
                           ));
                           echo get_staff_full_name($c_admin['staff_id']); ?></a>
                     </td>
                     <td data-order="<?php echo $c_admin['date_assigned']; ?>"><?php echo _dt($c_admin['date_assigned']); ?></td>
                     <?php if(has_permission('customers','','create') || has_permission('customers','','edit')){ ?>
                     <td>
                        <a href="<?php echo admin_url('clients/delete_customer_admin/'.$client->userid.'/'.$c_admin['staff_id']); ?>" class="btn btn-danger _delete btn-icon"><i class="fa fa-remove"></i></a>
                     </td>
                     <?php } ?>
                  </tr>
                  <?php } ?>
               </tbody>
            </table>
         </div>
         <?php } ?>
         <div role="tabpanel" class="tab-pane hidden" id="billing_and_shipping">
            <div class="row">
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-md-6">
                        <h4 class="no-mtop"><?php echo _l('billing_address'); ?> <a href="#" class="pull-right billing-same-as-customer"><small class="font-medium-xs"><?php echo _l('customer_billing_same_as_profile'); ?></small></a></h4>
                        <hr />
                        <?php $value=( isset($client) ? $client->billing_street : ''); ?>
                        <?php echo render_textarea( 'billing_street', 'billing_street',$value); ?>
                        <?php $value=( isset($client) ? $client->billing_city : ''); ?>
                        <?php echo render_input( 'billing_city', 'billing_city',$value); ?>
                        <?php $value=( isset($client) ? $client->billing_state : ''); ?>
                        <?php echo render_input( 'billing_state', 'billing_state',$value); ?>
                        <?php $value=( isset($client) ? $client->billing_zip : ''); ?>
                        <?php echo render_input( 'billing_zip', 'billing_zip',$value); ?>
                        <?php $selected=( isset($client) ? $client->billing_country : '' ); ?>
                        <?php echo render_select( 'billing_country',$countries,array( 'country_id',array( 'short_name')), 'billing_country',$selected,array('data-none-selected-text'=>_l('dropdown_non_selected_tex'))); ?>
                     </div>
                     <div class="col-md-6">
                        <h4 class="no-mtop">
                           <i class="fa fa-question-circle" data-toggle="tooltip" data-title="<?php echo _l('customer_shipping_address_notice'); ?>"></i>
                           <?php echo _l('shipping_address'); ?> <a href="#" class="pull-right customer-copy-billing-address"><small class="font-medium-xs"><?php echo _l('customer_billing_copy'); ?></small></a>
                        </h4>
                        <hr />
                        <?php $value=( isset($client) ? $client->shipping_street : ''); ?>
                        <?php echo render_textarea( 'shipping_street', 'shipping_street',$value); ?>
                        <?php $value=( isset($client) ? $client->shipping_city : ''); ?>
                        <?php echo render_input( 'shipping_city', 'shipping_city',$value); ?>
                        <?php $value=( isset($client) ? $client->shipping_state : ''); ?>
                        <?php echo render_input( 'shipping_state', 'shipping_state',$value); ?>
                        <?php $value=( isset($client) ? $client->shipping_zip : ''); ?>
                        <?php echo render_input( 'shipping_zip', 'shipping_zip',$value); ?>
                        <?php $selected=( isset($client) ? $client->shipping_country : '' ); ?>
                        <?php echo render_select( 'shipping_country',$countries,array( 'country_id',array( 'short_name')), 'shipping_country',$selected,array('data-none-selected-text'=>_l('dropdown_non_selected_tex'))); ?>
                     </div>
                     <?php if(isset($client) &&
                        (total_rows(db_prefix().'invoices',array('clientid'=>$client->userid)) > 0 || total_rows(db_prefix().'estimates',array('clientid'=>$client->userid)) > 0 || total_rows(db_prefix().'creditnotes',array('clientid'=>$client->userid)) > 0)){ ?>
                     <div class="col-md-12">
                        <div class="alert alert-warning">
                           <div class="checkbox checkbox-default">
                              <input type="checkbox" name="update_all_other_transactions" id="update_all_other_transactions">
                              <label for="update_all_other_transactions">
                              <?php echo _l('customer_update_address_info_on_invoices'); ?><br />
                              </label>
                           </div>
                           <b><?php echo _l('customer_update_address_info_on_invoices_help'); ?></b>
                           <div class="checkbox checkbox-default">
                              <input type="checkbox" name="update_credit_notes" id="update_credit_notes">
                              <label for="update_credit_notes">
                              <?php echo _l('customer_profile_update_credit_notes'); ?><br />
                              </label>
                           </div>
                        </div>
                     </div>
                     <?php } ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php echo form_close(); ?>
</div>
<?php if(isset($client)){ ?>
<?php if (has_permission('customers', '', 'create') || has_permission('customers', '', 'edit')) { ?>
<div class="modal fade" id="customer_admins_assign" tabindex="-1" role="dialog">
   <div class="modal-dialog">
      <?php echo form_open(admin_url('clients/assign_admins/'.$client->userid)); ?>
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo _l('assign_admin'); ?></h4>
         </div>
         <div class="modal-body">
            <?php
               $selected = array();
               foreach($customer_admins as $c_admin){
                  array_push($selected,$c_admin['staff_id']);
               }
               echo render_select('customer_admins[]',$staff,array('staffid',array('firstname','lastname')),'',$selected,array('multiple'=>true),array(),'','',false); ?>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
            <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
         </div>
      </div>
      <!-- /.modal-content -->
      <?php echo form_close(); ?>
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php } ?>
<?php } ?>
<?php $this->load->view('admin/clients/client_group'); ?>

<script>
  function getStatelist(Id)
    {
        $('#state').html('<option value="">Please wait...</option>');
        $('#city').html('<option value=""></option>');
        var str = "country="+Id+"&"+csrfData['token_name']+"="+csrfData['hash'];
        $.ajax({
            url: '<?= admin_url()?>clients/getStatelist',
            type: 'POST',
            data: str,
            datatype: 'json',
            cache: false,
            success: function(resp_){
                if(resp_)
                {
                    var resp = JSON.parse(resp_);
                    var res = '<option value=""></option>';
                    for(var i=0; i<resp.length; i++)
                    {
                       res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                    }
                    $('#state').html(res);
                }
                else
                {
                    $('#state').html('<option value=""></option>');
                }
            }
        });
    }
    
    function getCitylist(Id)
    {
        $('#city').html('<option value="">Please wait...</option>');
        var str = "state="+Id+"&"+csrfData['token_name']+"="+csrfData['hash'];
        $.ajax({
            url: '<?= admin_url()?>clients/getCitylist',
            type: 'POST',
            data: str,
            datatype: 'json',
            cache: false,
            success: function(resp_){
                if(resp_)
                {
                    var resp = JSON.parse(resp_);
                    var res = '<option value=""></option>';
                    for(var i=0; i<resp.length; i++)
                    {
                       res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                    }
                    $('#city').html(res);
                }
                else
                {
                    $('#city').html('<option value=""></option>');
                }
            }
        });
    }
  function getStatelist2(Id)
    {
        $('#state2').html('<option value="">Please wait...</option>');
        $('#city2').html('<option value=""></option>');
        var str = "country="+Id+"&"+csrfData['token_name']+"="+csrfData['hash'];
        $.ajax({
            url: '<?= admin_url()?>clients/getStatelist',
            type: 'POST',
            data: str,
            datatype: 'json',
            cache: false,
            success: function(resp_){
                if(resp_)
                {
                    var resp = JSON.parse(resp_);
                    var res = '<option value=""></option>';
                    for(var i=0; i<resp.length; i++)
                    {
                       res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                    }
                    $('#state2').html(res);
                }
                else
                {
                    $('#state2').html('<option value=""></option>');
                }
            }
        });
    }
    
    function getCitylist2(Id)
    {
        $('#city2').html('<option value="">Please wait...</option>');
        var str = "state="+Id+"&"+csrfData['token_name']+"="+csrfData['hash'];
        $.ajax({
            url: '<?= admin_url()?>clients/getCitylist',
            type: 'POST',
            data: str,
            datatype: 'json',
            cache: false,
            success: function(resp_){
                if(resp_)
                {
                    var resp = JSON.parse(resp_);
                    var res = '<option value=""></option>';
                    for(var i=0; i<resp.length; i++)
                    {
                       res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                    }
                    $('#city2').html(res);
                }
                else
                {
                    $('#city2').html('<option value=""></option>');
                }
            }
        });
    }
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
    function getServiceType(obj){
            if($('#service_type').val()!=''){
                    $("#service_type_error").hide();
            }else{
                $("#service_type_error").show();
            }
    }
    
    function getdepartment(obj){
            if($('#department_id').val()!=''){
                    $("#department_id_error").hide();
            }else{
                $("#department_id_error").show();
            }
    }

    

</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

<script>
    function checkImage(obj){
    //$("input[name=profile_image]").on('change',function(e){
            let file = obj.files[0];//e.target.files[0];
            if(file['type']=='image/jpeg' || file['type']=='image/jpg' || file['type']=='image/png' || file['type']=='image/gif' ){
               
            }else{
                alert('Please upload valid profile.');
                $('input[name=profile_image]').val('');
            }
        }
     //   });
    </script>

