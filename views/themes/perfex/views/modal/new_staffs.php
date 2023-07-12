<div class="modal fade" id="newStaffModal" tabindex="-1" role="dialog" aria-labelledby="newStaffModalLabel">
    <div class="modal-dialog full-modal" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" onclick="refrestpicker()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="newStaffModalLabel">Add Staff</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('clients/addStaff',array('id'=>'addstaffForm', 'autocomplete' => 'off')); ?>
                    <!-- <div class="form-group"> -->
                        <div class="row">
                            <div class="col-md-6  form-group">
                                <?= _l('Profile Image'); ?>
                                 <input type="file" class="form-control"  name="profile_image" accept=".jpg,.jpeg,.png">
                            </div>
                        </div>
                    <!-- </div> -->
                    <!-- <div class=" form-groupp"> -->
                        <div class="row">
                            <div class="col-md-4  form-group">
                               <?= _l('First name'); ?>
                                <input type="text" id="first_name" maxlength="20" minlength="2" name="first_name" class="form-control" required />
                            </div>
                            <div class="col-md-4  form-group">
                               <?= _l('Last name'); ?>
                                <input type="text" id="last_name" name="last_name" maxlength="20" minlength="2" class="form-control" required />
                            </div>
                            <div class="col-md-4  form-group">
                                <?= _l('Phone'); ?>
                                <input type="text" id="phonenumber" required name="phonenumber" maxlength="12" minlength="9" class="form-control" autofocus="1" />
                            </div>
                        </div>
                    <!-- </div> -->
                    <!-- <div class="form-group"> -->
                        <div class="row">
                            <div class="col-md-6  form-group">
                               <?= _l('Email'); ?>
                                <input type="email" autocomplete="off" id="email" name="email" class="form-control" required />
                            </div>
                            <div class="col-md-6  form-group">
                               <?= _l('Password'); ?>
                                <input type="password" autocomplete="off" id="password" name="password" class="form-control" required />
                            </div>
                        </div>
                   
                        <div class="row">
                            <div class="col-md-3  form-group">
                               <?= _l('Date of birth'); ?>
                                <input type="text" readonly autocomplete="off" class="form-control " name="dob"  id="dobs" placeholder="dd-mm-yyyy" required />
                            </div>
                            <div class="col-md-3  form-group">
                               <?= _l('Date of Joining'); ?>
                                <input type="text" readonly autocomplete="off" class="form-control " name="doj"  id="dojs" placeholder="dd-mm-yyyy" required />
                            </div>
                            <div class="col-md-3  form-group">
                                <?php
                                    $designation_res = $this->db->get_where(db_prefix().'designation')->result();
                                ?>
                               <?= _l('Designation'); ?>
                                <select name="designation_id"   id="designation_id"  class="form-control selectpicker" tabindex="-98" data-live-search="true" required="" >
                                    
                                    <?php
                                        if($designation_res)
                                        {
                                           ?>
                                          <option value=""></option>
                                          <?php
                                            foreach($designation_res as $rst)
                                            {
                                                ?>
                                                  <option value="<?= $rst->id; ?>"><?= $rst->name; ?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3  form-group">
                               <?= _l('Program/Department'); ?>
                                <?php
                                    $result_m = $this->db->get_where(db_prefix().'department')->result();
                                ?>
                                <select name="department_id[]"     id="department_id"   required="" class="form-control selectpicker"   tabindex="-98" data-live-search="true" multiple=""  onchange="getdepartmenthide(this.value);">
                                    <?php
                                     if($result_m)
                                      {

                                    ?>
                                          <option value=""></option>
                                          <?php
                                        foreach($result_m as $row_m)
                                        {
                                            echo "<option value='".$row_m->id."'>".$row_m->name."</option>";
                                        }
                                      }
                                    ?>
                                </select>
                            </div>
                          
                        </div>
                   
                        <div class="row">
                            <div class="col-md-12  form-group">
                               <?= _l('Address'); ?>
                                <input type="text" class="form-control" name="address" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3  form-group">
                              <?php 
                                $country_list = $this->db->get_where(db_prefix().'country')->result();
                              ?>
                               <?= _l('Country'); ?>
                                <select class="form-control  selectpicker"   tabindex="-98" data-live-search="true"   name="country" required  onchange="getStatelist(this.value);">

                                      <option value=""></option>
                                      <?php
                                          if($country_list)
                                          {
                                              foreach($country_list as $res)
                                              {
                                                  ?>
                                                      <option value="<?= $res->id; ?>"><?= $res->name; ?></option>
                                                  <?php
                                              }
                                          }
                                      ?>
                                 </select>
                            </div>
                            <div class="col-md-3  form-group">
                               <?= _l('State'); ?>
                                <div class="statelists">
                                    <select class="form-control selectpicker staten"   tabindex="-98" data-live-search="true"  name="state" required id="staten" onchange="getCitylist(this.value);">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3  form-group">
                               <?= _l('City'); ?>
                                <div class="citylists_">
                                 <select class="form-control selectpicker cityn"   tabindex="-98" data-live-search="true"  name="city" required id="cityn" onchange="getCityhide(this.value);">
                                     <option value=""></option>
                                 </select>
                                </div>
                            </div>
                            <div class="col-md-3  form-group">
                               <?= _l('Postal Code'); ?>
                                <input type="text" class="form-control"  name="postal_code"  required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12  form-group">
                               <?= _l('Favorite Food'); ?>
                                <input type="text" class="form-control" name="favorite_food"  />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12  form-group">
                               <?= _l('Favorite Sport'); ?>
                                <input type="text" class="form-control" name="favorite_sport"  />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12  form-group">
                               <?= _l('Travel Destination'); ?>
                                <input type="text" class="form-control" name="favorite_destination"  />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12  form-group">
                               <?= _l('Total Working Hours'); ?>
                                <input type="number" max="38" class="form-control" name="total_working_hours"  />
                            </div>
                        </div>
                    <!-- </div> -->
                    <div class="form-group">
                        <div class="row">
                            <div class="modal-footer">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editStaffModal" tabindex="-1" role="dialog" aria-labelledby="newStaffModalLabel">
    <div class="modal-dialog full-modal" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" onclick="refrestpicker()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="newStaffModalLabel">Edit Staff</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('clients/editStaff',array('id'=>'editstaffForm', 'autocomplete' => 'off')); ?>
                    <!-- <div class="form-group"> -->
                        <input type="hidden" name="id" id="user_id">
                        <div class="row">
                            <div class="col-md-2 form-group">
                                <a href="" target="_blank" id="profile_url">
                                <img src="" width="100" height="100" id="profile_src">
                                
                                </a>
                            </div> 
                            <div class="col-md-6  form-group">
                                <?= _l('Profile Image'); ?>
                                 <input type="file" class="form-control"  name="profile_image" accept=".jpg,.jpeg,.png">
                            </div>
                        </div>
                    <!-- </div> -->
                    <!-- <div class=" form-groupp"> -->
                        <div class="row">
                            <div class="col-md-4  form-group">
                               <?= _l('First name'); ?>
                                <input type="text" id="edit_first_name" maxlength="20" minlength="2" name="firstname" class="form-control" required />
                            </div>
                            <div class="col-md-4  form-group">
                               <?= _l('Last name'); ?>
                                <input type="text" id="edit_last_name" name="lastname" maxlength="20" minlength="2" class="form-control" required />
                            </div>
                            <div class="col-md-4  form-group">
                                <?= _l('Phone'); ?>
                                <input type="text" id="edit_phonenumber" required name="phonenumber" maxlength="12" minlength="9" class="form-control" autofocus="1" />
                            </div>
                        </div>
                    <!-- </div> -->
                    <!-- <div class="form-group"> -->
                        <!-- <div class="row">
                            <div class="col-md-6  form-group">
                               <?= _l('Email'); ?>
                                <input type="email" autocomplete="off" id="edit_email" name="email" class="form-control" required />
                            </div>
                            <div class="col-md-6  form-group">
                               <?= _l('Password'); ?>
                                <input type="password" autocomplete="off" id="edit_password" name="password" class="form-control" required />
                            </div>
                        </div> -->
                   
                        <div class="row">
                            <div class="col-md-3  form-group">
                               <?= _l('Date of birth'); ?>
                                <input type="text" readonly autocomplete="off" class="form-control " name="dob"  id="edit_dob" placeholder="dd-mm-yyyy" required />
                            </div>
                            <div class="col-md-3  form-group">
                               <?= _l('Date of Joining'); ?>
                                <input type="text" readonly autocomplete="off" class="form-control " name="doj"  id="edit_dojs" placeholder="dd-mm-yyyy" required />
                            </div>
                            <div class="col-md-3  form-group">
                                <?php
                                    $designation_res = $this->db->get_where(db_prefix().'designation')->result();
                                ?>
                               <?= _l('Designation'); ?>
                                <select name="designation_id"   id="edit_designation_id"  class="form-control selectpicker" tabindex="-98" data-live-search="true" required="" >
                                    
                                    <?php
                                        if($designation_res)
                                        {
                                           ?>
                                          <option value=""></option>
                                          <?php
                                            foreach($designation_res as $rst)
                                            {
                                                ?>
                                                  <option value="<?= $rst->id; ?>"><?= $rst->name; ?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3  form-group">
                               <?= _l('Program/Department'); ?>
                                <?php
                                    $result_m = $this->db->get_where(db_prefix().'department')->result();
                                ?>
                                <select name="department_id[]"     id="edit_department_id"   required="" class="form-control selectpicker"   tabindex="-98" data-live-search="true" multiple=""  onchange="getdepartmenthide(this.value);">
                                    <?php
                                     if($result_m)
                                      {

                                    ?>
                                          <option value=""></option>
                                          <?php
                                        foreach($result_m as $row_m)
                                        {
                                            echo "<option value='".$row_m->id."'>".$row_m->name."</option>";
                                        }
                                      }
                                    ?>
                                </select>
                            </div>
                          
                        </div>
                   
                        <div class="row">
                            <div class="col-md-12  form-group">
                               <?= _l('Address'); ?>
                                <input type="text" class="form-control" name="address" required id="edit_address"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3  form-group">
                              <?php 
                                $country_list = $this->db->get_where(db_prefix().'country')->result();
                              ?>
                               <?= _l('Country'); ?>
                                <select class="form-control  selectpicker"   tabindex="-98" data-live-search="true"   name="country" required  onchange="getStatelist(this.value);"  id="edit_country">

                                      <option value=""></option>
                                      <?php
                                          if($country_list)
                                          {
                                              foreach($country_list as $res)
                                              {
                                                  ?>
                                                      <option value="<?= $res->id; ?>"><?= $res->name; ?></option>
                                                  <?php
                                              }
                                          }
                                      ?>
                                 </select>
                            </div>
                            <div class="col-md-3  form-group">
                               <?= _l('State'); ?>
                                <div class="statelists">
                                    <select class="form-control selectpicker staten"   tabindex="-98" data-live-search="true"  name="state" required id="staten" onchange="getCitylist(this.value);">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3  form-group">
                               <?= _l('City'); ?>
                                <div class="citylists_">
                                 <select class="form-control selectpicker cityn"   tabindex="-98" data-live-search="true"  name="city" required id="cityn" onchange="getCityhide(this.value);">
                                     <option value=""></option>
                                 </select>
                                </div>
                            </div>
                            <div class="col-md-3  form-group">
                               <?= _l('Postal Code'); ?>
                                <input type="text" class="form-control"  name="postal_code"  required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12  form-group">
                               <?= _l('Favorite Food'); ?>
                                <input type="text" class="form-control" name="favorite_food"  />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12  form-group">
                               <?= _l('Favorite Sport'); ?>
                                <input type="text" class="form-control" name="favorite_sport"  />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12  form-group">
                               <?= _l('Travel Destination'); ?>
                                <input type="text" class="form-control" name="favorite_destination"  />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12  form-group">
                               <?= _l('Total Working Hours'); ?>
                                <input type="number" max="38" class="form-control" name="total_working_hours"  />
                            </div>
                        </div>
                    <!-- </div> -->
                    <div class="form-group">
                        <div class="row">
                            <div class="modal-footer">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script type='text/javascript'>
   /* Success message  */
    function successmsg(msg)
    {
        toastr.success('',msg);
    }
    
    function errormsg(msg)
    {
        toastr.error('',msg);
    }


    var islogin = '<?= $client_data->userid; ?>';
    var get_client_user_id = '<?= get_client_user_id(); ?>';
    $(document).ready(function() {
        if(get_client_user_id!=''){
                staffclientlist_table = $('#staffdata_list').DataTable({ 
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": false, //Feature control DataTables' servermside processing mode.
                    "order": [[0, 'desc']], //Initial no order.
                    "ordering": true,
                    "searching": true,
                    "ajax": {
                        "url": "<?php echo base_url('clients/loadStaffData')?>",
                        "type": "POST",
                        "dataType": "json",
                        "data":{},
                        "data": function ( data ) {
                        data.filter_by = {};
                        },
                        "dataSrc": function (jsonData) {
                        return jsonData.data;
                        }
                    },
                });
            }
        });

 function refrestpicker()
    {
        $('.selectpicker').selectpicker('refresh');
        $('#designation_id').selectpicker('refresh');
        // $('#gender').selectpicker('refresh');
    }


    $(document).ready(function(){
    
    $('.selectpicker').selectpicker('refresh');
      var dt = new Date();
      var dt1 = dt.setDate(dt.getDate() - 4748);

        $("#dobs").datetimepicker({
            timepicker:false,
            format: 'd-m-Y',
             maxDate: dt1,
             startDate: dt1,
            onSelect: function(selected) {
               $("#dobs").datetimepicker("option","maxDate", selected)
            }
        });

        $("#dojs").datetimepicker({ 
          timepicker:false,
            format: 'd-m-Y',
            // minDate:0,
            // onSelect: function(selected) {
            //    $("#doj").datetimepicker("option","maxDate", selected)
            // }
        });  
        var dt = new Date();
      var dt1 = dt.setDate(dt.getDate() - 4748);

        $("#edit_dob").datetimepicker({
            timepicker:false,
            format: 'd-m-Y',
             maxDate: dt1,
             startDate: dt1,
            onSelect: function(selected) {
               $("#edit_dob").datetimepicker("option","maxDate", selected)
            }
        });

        $("#edit_dojs").datetimepicker({ 
          timepicker:false,
            format: 'd-m-Y',
           
        }); 
    });
        
    window.addEventListener('load',function(){
           appValidateForm($('#addstaffForm'), {
           designation_id: 'required',
           department_id: 'required',
        }, staffadd_form);
    });

    function staffadd_form(form) {
        var formURL = form.action;
        var formData = new FormData($(form)[0]);
    
        $.ajax({
            type: $(form).attr('method'),
            data: formData,
            mimeType: $(form).attr('enctype'),
            contentType: false,
            cache: false,
            processData: false,
            url: formURL
        }).done(function(response) {
            response = JSON.parse(response);
            if (response.success == true) {
                successmsg(response.message);
                $('.close').click();
                $('#addstaffForm').validate().resetForm();
                staffclientlist_table.ajax.reload();  
                $('#stafflistmodel').modal('show');
            }
            else
            {
                errormsg(response.message);
            }
        });
        return false;
    }

    $('#newStaffModal').on('hidden.bs.modal', function (e) {       
                $('#addstaffForm').validate().resetForm(); 
                
        $('#addstaffForm')[0].reset(); 

    });

    function getStatelist(Id)
    {
        
        $('#country-error').text('');

        $('.statelists').html('<option value="">Please wait...</option>');
        // $('#cityn').html('<option value=""></option>');
        var str = "country="+Id+"&"+csrfData['token_name']+"="+csrfData['hash'];
        $.ajax({
            url: '<?= base_url()?>clients/getStatelist',
            type: 'POST',
            data: str,
            datatype: 'json',
            cache: false,
            success: function(resp_){ 
                if(resp_)
                {
                    var resp = JSON.parse(resp_);
                    var res = '<select class="form-control selectpicker staten"    data-live-search="true"  tabindex="-98"   name="state" required id="staten" onchange="getCitylist(this.value);">';
                        // res += '<option value="">Please Select</option>';
                    for(var i=0; i<resp.length; i++)
                    {
                       res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                    }
                    res += '</select>';
                    console.log(resp_);
                    $('.statelists').html(res);
                    $('.staten').selectpicker('refresh');
                }
                else
                {
                    $('.statelists').html('<option value=""></option>');
                    // $('#staten').selectpicker('refresh');
                }
            }
        });
    }
    
    function getCitylist(Id)
    {
       $('#staten-error').text('');
        $('.citylists_').html('<option value="">Please wait...</option>');
        var str = "state="+Id+"&"+csrfData['token_name']+"="+csrfData['hash'];
        $.ajax({
            url: '<?= base_url()?>clients/getCitylist',
            type: 'POST',
            data: str,
            datatype: 'json',
            cache: false,
            success: function(resp_){
                if(resp_)
                {
                    var resp = JSON.parse(resp_);

                    if(resp.length==0)
                    {
                        $('.bootstrap-select.is-invalid .dropdown-toggle, .error .bootstrap-select .dropdown-toggle, .has-error .bootstrap-select .dropdown-toggle, .was-validated .bootstrap-select select:invalid+.dropdown-toggle').css('border-color','#ffffff');
                        var res = '<select class="form-control  selectpicker cityn"    data-live-search="true"  tabindex="-98"    name="city" id="cityn"  onchange="getCityhide(this.value);">';
                            res += '<option value=""></option>';
                        for(var i=0; i<resp.length; i++)
                        {
                           res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                        }
                        res += '</select>';

                    }
                    else
                    {
                        var res = '<select class="form-control  selectpicker cityn"    data-live-search="true"  tabindex="-98"   required name="city" id="cityn"  onchange="getCityhide(this.value);">';
                            res += '<option value=""></option>';
                        for(var i=0; i<resp.length; i++)
                        {
                           res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                        }
                        res += '</select>';

                    }
                    $('.citylists_').html(res);
                    $('.cityn').selectpicker('refresh');
                }
                else
                {
                    $('.citylists_').html('<option value=""></option>');
                    $('.cityn').selectpicker('refresh');
                    // $('#cityn').selectpicker('refresh');
                }
            }
        });
    }
    function getCityhide(Id)
    {
      if(Id!=''){
       $('#cityn-error').text('');
      }
      
       
    }
    function getservicehide(Id)
    {
      if(Id!=''){
       $('#designation_id-error').text('');
      }
      
       
    }
    function getdepartmenthide(Id)
    {
      if(Id!=''){
       $('#department_id-error').text('');
      }
      
       
    }

    function changeClientStatus(userid,active)
    {

    var r = confirm("Are you sure want to Change Status?");
      if (r == true) {
        $.ajax({
              url: '<?=base_url()?>clients/changeClientStatus/'+userid+'/'+active,
              type: 'get',
              dataType: 'json',
              success: function(response){
                  successmsg('Status Change Successfully');
                  staffclientlist_table.ajax.reload(); 
              }
         });
      }
    }
   function getStaffdetail(id){
   
        $.ajax({
                url: '<?=base_url()?>clients/getstaffdetail/'+id,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    console.log(response);
                    $("#user_id").val(response.id);
                    $("#edit_first_name").val(response.firstname);
                    $("#edit_last_name").val(response.lastname);
                    $("#edit_phonenumber").val(response.phonenumber);
                    $("#edit_email").val(response.email);
                    $("#edit_password").val(response.password);
                    $("#edit_dob").val(response.dob);
                    $("#edit_dojs").val(response.doj);
                    //$("#edit_designation_id").val(response.designation_id);
                    //$("#edit_department_id").val(response.department_id);
                    $("#edit_address").val(response.address);
                    $("select[name=country]").val(response.country);
                    $('.selectpicker').selectpicker('refresh');


                    var str = "country="+response.country+"&"+csrfData['token_name']+"="+csrfData['hash'];
                    $.ajax({
                        url: '<?= base_url()?>clients/getStatelist',
                        type: 'POST',
                        data: str,
                        datatype: 'json',
                        cache: false,
                        success: function(resp_){ 
                            if(resp_)
                            {
                                var resp = JSON.parse(resp_);
                                var res = '<select class="form-control selectpicker staten"    data-live-search="true"  tabindex="-98"   name="state" required id="staten" onchange="getCitylist(this.value);">';
                                    // res += '<option value="">Please Select</option>';
                                for(var i=0; i<resp.length; i++)
                                {
                                res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                                }
                                res += '</select>';
                                console.log(resp_);
                                $('.statelists').html(res);
                                $('.staten').selectpicker('refresh');
                            }
                            else
                            {
                                $('.statelists').html('<option value=""></option>');
                                // $('#staten').selectpicker('refresh');
                            }
                        }
                    });
                    $("select[name=state]").val(response.state);
                    $('.selectpicker').selectpicker('refresh');

                    var str = "state="+response.state+"&"+csrfData['token_name']+"="+csrfData['hash'];
                    $.ajax({
                        url: '<?= base_url()?>clients/getCitylist',
                        type: 'POST',
                        data: str,
                        datatype: 'json',
                        cache: false,
                        success: function(resp_){
                            if(resp_)
                            {
                                var resp = JSON.parse(resp_);

                                if(resp.length==0)
                                {
                                    $('.bootstrap-select.is-invalid .dropdown-toggle, .error .bootstrap-select .dropdown-toggle, .has-error .bootstrap-select .dropdown-toggle, .was-validated .bootstrap-select select:invalid+.dropdown-toggle').css('border-color','#ffffff');
                                    var res = '<select class="form-control  selectpicker cityn"    data-live-search="true"  tabindex="-98"    name="city" id="editcityn"  onchange="getCityhide(this.value);">';
                                        res += '<option value=""></option>';
                                    for(var i=0; i<resp.length; i++)
                                    {
                                    res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                                    }
                                    res += '</select>';

                                }
                                else
                                {
                                    var res = '<select class="form-control  selectpicker cityn"    data-live-search="true"  tabindex="-98"   required name="city" id="editcityn"  onchange="getCityhide(this.value);">';
                                        res += '<option value=""></option>';
                                    for(var i=0; i<resp.length; i++)
                                    {
                                    res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                                    }
                                    res += '</select>';

                                }
                                $('.citylists_').html(res);
                                $('.cityn').selectpicker('refresh');
                            }
                            else
                            {
                                $('.citylists_').html('<option value=""></option>');
                                $('.cityn').selectpicker('refresh');
                                // $('#cityn').selectpicker('refresh');
                            }
                        }
                    });
                    $("select[name=city]").val(response.city);
                    $('.cityn').selectpicker('refresh');
                    

                    $('select[name=designation_id]').val(response.designation_id);
                    $('.selectpicker').selectpicker('refresh');

                    $("input[name=postal_code]").val(response.postal_code);
                    $("input[name=favorite_food]").val(response.favorite_food);
                    $("input[name=favorite_sport]").val(response.favorite_sport);
                    $("input[name=favorite_destination]").val(response.favorite_destination);
                    $("input[name=total_working_hours]").val(response.total_working_hours);

                    var department_array = response.department_id.split(",");
                    $("select[id=edit_department_id").val(department_array);
                    // console.log(department_array);
                    // for(var i=0; i<department_array.length;i++){
                    //     $("select[id=edit_department_id").val(department_array[i]);
                    // }

                    $("#profile_url").attr('href',response.profile_url);
                    $("#profile_src").attr('src',response.profile_url);
                   
                    $('.selectpicker').selectpicker('refresh');
                    

                    $("#editStaffModal").modal('show');
                }
            });
   }

   window.addEventListener('load',function(){
           appValidateForm($('#editstaffForm'), {
           designation_id: 'required',
           department_id: 'required',
        }, staffedit_form);
    });

    function staffedit_form(form) {
        var formURL = form.action;
        var formData = new FormData($(form)[0]);
    
        $.ajax({
            type: $(form).attr('method'),
            data: formData,
            mimeType: $(form).attr('enctype'),
            contentType: false,
            cache: false,
            processData: false,
            url: formURL
        }).done(function(response) {
            response = JSON.parse(response);
            if (response.success == true) {
                successmsg(response.message);
                $('.close').click();
                $('#editstaffForm').validate().resetForm();
                staffclientlist_table.ajax.reload();  
                $('#stafflistmodel').modal('show');
            }
            else
            {
                errormsg(response.message);
            }
        });
        return false;
    }
</script>