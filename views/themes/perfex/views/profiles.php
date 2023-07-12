<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
    //echo"<pre>";print_r($contact);die;
?>
<style>
    .pos-rel{
        position:relative;
    }
    .prgm-overlay{
        position: absolute;
        width: 100%;
        height: 57%;
        z-index: 1;
        background-color: #f1f5f785;
        bottom: 0;
    }
    ul.dropdown-menu.inner {
        min-width: 82px!important;
    }
</style>
<div class="container pt-140">

    <div class="row section-heading section-profile">
        <div class="col-md-8">
            <div class="white-box">
                <?php echo form_open_multipart('clients/profiles', array('autocomplete' => 'off')); ?>
                <?php echo form_hidden('profile', true); ?>

                <div class="panel_s">
                    <div class="clearfix">
                        <h4 class="title"><?php echo _l('clients_profile_heading'); ?></h4>
                        <div class="row">
                            <div class="col-md-12">
                                

                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                    <?php 
                                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => get_client_user_id(), 'rel_type' => 'profile_image'))->row('file_name');
                                    if($filename==''){ 
                                    ?>
                                        <div class="form-group profile-image-upload-group">
                                            <label for="profile_image" class="profile-image"><?php echo _l('client_profile_image'); ?></label>
                                            <input type="file" name="profile_image"  extension="png,jpg,jpeg" accept=".png,.jpg,.jpeg" class="form-control" >
                                        </div>
                                    <?php } ?>
                                    <?php
                                    $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => get_client_user_id(), 'rel_type' => 'profile_image'))->row('file_name');

                                    if($filename!=''){  
                                    ?>
                                        <div class="form-group profile-image-group">
                                            <div class="mb-2">
                                                <img src="<?= base_url('uploads/profile_image/'.get_client_user_id().'/'.$filename); ?>" class="client-profile-image-thumb" width="140">
                                              </div>
                                            

                                            <div class="clearfix">
                                              <input type="file" name="profile_image" id="profile-image" extension="png,jpg,jpeg" accept=".png,.jpg,.jpeg"  class="form-control">
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group profile-firstname-group">
                                            <label for="firstname"><?php echo _l('clients_firstname'); ?></label>
                                            <input type="text" class="form-control" maxlength="15"  name="firstname" id="firstname" value="<?php echo set_value('firstname', $contact->firstname); ?>" required>
                                            <?php echo form_error('firstname'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group profile-lastname-group">
                                            <label for="lastname"><?php echo _l('clients_lastname'); ?></label>
                                            <input type="text" class="form-control" maxlength="15"  name="lastname" id="lastname" value="<?php echo set_value('lastname', $contact->lastname); ?>" required>
                                            <?php echo form_error('lastname'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group profile-email-group">
                                            <label for="email"><?php echo _l('clients_email'); ?></label>
                                            <input type="email" name="email" class="form-control" id="email"  value="<?php echo $contact->email; ?>">
                                            <?php echo form_error('email'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group profile-phone-group">
                                            <label for="phonenumber"><?php echo _l('clients_phone'); ?></label>
                                            <input type="text" class="form-control" name="phonenumber"  minlength="9" required maxlength="12"  id="phonenumber" value="<?php echo $contact->phonenumber; ?>">
                                            <?php echo form_error('phonenumber'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group p-0">
                                            <label>DOB</label>
                                            <input class="form-control" placeholder="DOB" name="dob"   id="dob_profile"  value="<?php echo date('d-m-Y', strtotime($contact->dob));  ?>">
                                            <?php echo form_error('dob'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group pos-rel">
                                            <label>Program/Department</label>
                                            <select name="department_id[]"  class="custom-dropdown selectpicker"  multiple="">
                                            <!-- <select name="department_id[]"  class="custom-dropdown selectpicker" readonly data-live-search="true" multiple=""> -->
                                           <!--  <select class="selectpicker custom-dropdown"> -->
                                                <option>Select Department</option>
                                                <?php 
                                                 if($contact->department_id!=''){
                                                          $department_ids = explode(",",$contact->department_id);
                                                          
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
                                                      if($department_res)
                                                      {
                                                          foreach($department_res as $r)
                                                          {
                                                              ?>
                                                                  <option value="<?= $r->id; ?>" ><?= $r->name; ?></option>
                                                              <?php
                                                          }
                                                      }
                                                 ?> 

                                                <?php } ?>
                                            </select>
                                            <div class="prgm-overlay"></div>
                                            <?php echo form_error('department_id'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control"  name="address" value="<?= (isset($contact)?$contact->address:""); ?>">
                                             <?php echo form_error('address'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <?php 
                                                $country_list = $this->db->get_where(db_prefix().'country')->result();

                                              ?>
                                            
                                            <select class="custom-dropdown selectpicker" data-live-search="true" name="country" id="profilecountry" required  onchange="getStatelistProfile(this.value);">
                                                <?php
                                                  if($country_list)
                                                  {
                                                      foreach($country_list as $res)
                                                      {
                                                          ?>
                                                              <option <?= ($contact->country == $res->id)?"selected":""; ?> value="<?= $res->id; ?>"><?= $res->name; ?></option>
                                                          <?php
                                                      }
                                                  }
                                              ?>
                                            </select>
                                             <?php echo form_error('country'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <?php 
                                                $state_list = $this->db->get_where(db_prefix().'state')->result();

                                              ?>
                                            <select class="custom-dropdown selectpicker profilestate"  data-live-search="true" name="state" required id="profilestate" onchange="getCitylistProfile(this.value);">
                                                <?php
                                                  if($state_list)
                                                  {
                                                      foreach($state_list as $sk=>$sv)
                                                      {
                                                          ?>
                                                              <option <?= ($contact->state == $sv->id)?"selected":""; ?> value="<?= $sv->id; ?>"><?= $sv->name; ?></option>
                                                          <?php
                                                      }
                                                  }
                                                ?>
                                             </select>
                                              <?php echo form_error('state'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <?php 
                                                $city_list = $this->db->get_where(db_prefix().'city')->result();
                                            ?>
                                             <select class="custom-dropdown selectpicker profilecity "  data-live-search="true" name="city" required id="profilecity">
                                                <?php
                                                  if($state_list)
                                                  {
                                                      foreach($city_list as $ck=>$cv)
                                                      {
                                                          ?>
                                                              <option <?= ($contact->city == $cv->id)?"selected":""; ?> value="<?= $cv->id; ?>"><?= $cv->name; ?></option>
                                                          <?php
                                                      }
                                                  }
                                                ?>
                                                
                                             </select>
                                              <?php echo form_error('city'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group profile-lastname-group">
                                            <label for="postal_code"><?= _l('Postal Code'); ?></label>
                                             <input type="text" class="form-control" name="postal_code" value="<?= @$contact->postal_code; ?>" required>
                                            <?php echo form_error('postal_code'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-info contact-profile-save pr-2 pl-2 mt-1"><?php echo _l('clients_edit_profile_update_btn'); ?></button>
                                    </div>
                                </div>


                                

                            </div>

                        </div>
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>

        <div class="col-md-4 contact-profile-change-password-section">
            <div class="white-box">
                <div class="panel_s">
                    <div class="clearfix">
                        <h4 class="title"><?php echo _l('clients_edit_profile_change_password_heading'); ?></h4>
                        <?php echo form_open('clients/profiles'); ?>
                        <?php echo form_hidden('change_password', true); ?>
                        <div class="form-group">
                            <label for="oldpassword"><?php echo _l('clients_edit_profile_old_password'); ?></label>
                            <input type="password" class="form-control" name="oldpassword" id="oldpassword">
                            <?php echo form_error('oldpassword'); ?>
                        </div>
                        <div class="form-group">
                            <label for="newpassword"><?php echo _l('clients_edit_profile_new_password'); ?></label>
                            <input type="password" class="form-control" name="newpassword" id="newpassword">
                            <?php echo form_error('newpassword'); ?>
                        </div>
                        <div class="form-group">
                            <label for="newpasswordr"><?php echo _l('clients_edit_profile_new_password_repeat'); ?></label>
                            <input type="password" class="form-control" name="newpasswordr" id="newpasswordr">
                            <?php echo form_error('newpasswordr'); ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block mt-2"><?php echo _l('clients_edit_profile_change_password_btn'); ?></button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <?php if ($contact->last_password_change !== NULL) { ?>
                        <div class="panel-footer last-password-change">
                            <?php echo _l('clients_profile_last_changed_password', time_ago($contact->last_password_change)); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/toastr.min.css'); ?>">
  <script type="text/javascript" src="<?php echo base_url('assets/js/toastr.min.js'); ?>"></script>
<script type="text/javascript">
    function getStatelistProfile(Id)
    {
        $('#profilestate').html('<option value="">Please wait...</option>');
        $('#profilecity').html('<option value=""></option>');
        var str = "country="+Id+"&"+csrfData['token_name']+"="+csrfData['hash'];
        $.ajax({
            url: '<?php echo base_url('clients/getStatelist')?>',
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
                    $('#profilestate').html(res);
                     $('.profilestate').selectpicker('refresh');

                }
                else
                {
                    $('#profilestate').html('<option value=""></option>');
                     $('.profilestate').selectpicker('refresh');
                }
            }
        });
    }
    
    function getCitylistProfile(Id)
    {
        $('#profilecity').html('<option value="">Please wait...</option>');
        var str = "state="+Id+"&"+csrfData['token_name']+"="+csrfData['hash'];
        // console.log('str',str);
        $.ajax({
            url: '<?php echo base_url('clients/getCitylist')?>',
            type: 'POST',
            data: str,
            datatype: 'json',
            cache: false,
            success: function(resp_){
                // console.log('data',resp_)
                if(resp_)
                {
                    var resp = JSON.parse(resp_);
                    var res = '<option value=""></option>';
                    for(var i=0; i<resp.length; i++)
                    {
                       res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                    }
                    $('#profilecity').html(res);
                     $('.profilecity').selectpicker('refresh');
                }
                else
                {
                    $('#profilecity').html('<option value=""></option>');
                     $('.profilecity').selectpicker('refresh');
                }
            }
        });
    }

 $(document).ready(function(){
    
      var dt = new Date();
      var dt1 = dt.setDate(dt.getDate() - 4827);

        $("#dob_profile").datetimepicker({
            timepicker:false,
            format: 'd-m-Y',
            maxDate: dt1,
            // onSelect: function(selected) {
            //    $("#dob_profile").datetimepicker("option","maxDate", dt)
            // }
        });
    });

<?php if($this->session->flashdata('success')){ ?>
toastr.success("<?php echo $this->session->flashdata('success'); ?>", {timeOut: 10});

<?php }else if($this->session->flashdata('error')){ ?>
toastr.error("<?php echo $this->session->flashdata('error'); ?>", {timeOut: 10});
<?php }else if($this->session->flashdata('warning')){ ?>
toastr.warning("<?php echo $this->session->flashdata('warning'); ?>", {timeOut: 10});
<?php }else if($this->session->flashdata('info')){ ?>
toastr.info("<?php echo $this->session->flashdata('info'); ?>", {timeOut: 10});
<?php } ?>
</script>