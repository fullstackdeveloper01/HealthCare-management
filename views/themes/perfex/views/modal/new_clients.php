<div class="modal fade" id="newClientModal" tabindex="-1" role="dialog" aria-labelledby="newClientModalLabel">
    <div class="modal-dialog full-modal" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" onclick="refrestpicker()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="newClientModalLabel">Add Clients</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('clients/addClient',array('id'=>'addclientForm', 'autocomplete' => 'off')); ?>
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
                            <div class="col-md-6  form-group">
                               <?= _l('First name'); ?>
                                <input type="text" id="first_name" maxlength="20" minlength="2" name="first_name" class="form-control" required />
                            </div>
                            <div class="col-md-6  form-group">
                               <?= _l('Last name'); ?>
                                <input type="text" id="last_name" name="last_name" maxlength="20" minlength="2" class="form-control" required />
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
                    <!-- </div> -->
                    <!-- <div class=" form-group"> -->
                        <div class="row">
                            <div class="col-md-6  form-group">
                                <?= _l('Phone'); ?>
                                <input type="text" id="phonenumber" required name="phonenumber" maxlength="12" minlength="9" class="form-control" autofocus="1" />
                            </div>
                            <div class="col-md-6  form-group">
                               <?= _l('Alternative Number'); ?>
                                <input type="text" class="form-control" maxlength="12" minlength="9" name="alternative_mobile"  />
                            </div>
                        </div>
                    <!-- </div> -->
                    <!-- <div class=" form-group"> -->
                        <div class="row">
                            <div class="col-md-4  form-group">
                               <?= _l('Date of birth'); ?>
                                <input type="text" readonly autocomplete="off" class="form-control " name="dob"  id="dob" placeholder="dd-mm-yyyy" required />
                            </div>
                            <div class="col-md-4  form-group">
                               <?= _l('Date of Joining'); ?>
                                <input type="text" readonly autocomplete="off" class="form-control " name="doj"  id="doj" placeholder="dd-mm-yyyy" required />
                            </div>
                            <div class="col-md-4  form-group">
                               <?= _l('Gender'); ?>
                                <select class="form-control selectpicker" name="gender" id="gender" tabindex="-98" data-live-search="true"  required>
                                   
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                    <option value="Not defined">Not defined</option>
                                </select>
                            </div>
                        </div>
                    <!-- </div> -->
                    <!-- <div class=" form-group"> -->
                        <div class="row">
                            <div class="col-md-12  form-group">
                               <?= _l('Address'); ?>
                                <input type="text" class="form-control" name="address" required />
                            </div>
                        </div>
                    <!-- </div> -->
                    <!-- <div class="form-group"> -->
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
                    <!-- </div> -->
                    <!-- <div class=" form-group"> -->
                        <div class="row">
                            <div class="col-md-12  form-group">
                               <?= _l('Address'); ?>
                                <input type="text" class="form-control" name="address2" >
                            </div>
                        </div>
                    <!-- </div> -->
                    <!-- <div class=" form-group"> -->
                        <div class="row">
                            <div class="col-md-3  form-group">
                               <?= _l('Country'); ?>
                                <select class="form-control  selectpicker"   tabindex="-98" data-live-search="true"   name="country2"   onchange="getStatelist2(this.value);">
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
                                <div class="firststatelist">
                                 <select class="form-control selectpicker staten2"   tabindex="-98" data-live-search="true"  name="state2"   id="staten2" onchange="getCitylist2(this.value);">
                                     <option value=""></option>
                                 </select>
                                </div>
                            </div>
                            <div class="col-md-3  form-group">
                               <?= _l('City'); ?>
                                <div class="firstcitylist">
                                    <select class="form-control selectpicker cityn2"   tabindex="-98" data-live-search="true"  name="city2"  id="cityn2">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3  form-group">
                               <?= _l('Postal Code'); ?>
                                <input type="text" class="form-control" name="postal_code2" >
                            </div>
                        </div>
                    <!-- </div> -->
                    <!-- <div class=" form-group"> -->
                        <div class="row">
                            <div class="col-md-3  form-group">
                               <?= _l('Budget Amount'); ?>
                                <input type="number" class="form-control" required name="budget_amount"  />
                            </div>
                            <div class="col-md-3  form-group">
                               <?= _l('Office Location'); ?>
                               <select class="form-control selectpicker" name="office_location" id="office_location" tabindex="-98" data-live-search="true"  required >
                                  
                                      <?php
                                      $officeLocation_list = $this->db->get_where(db_prefix().'office_location')->result();
                                          if($officeLocation_list)
                                          {
                                              foreach($officeLocation_list as $ress)
                                              {
                                                  ?>
                                                      <option value="<?= $ress->name; ?>"><?= $ress->name; ?></option>
                                                  <?php
                                              }
                                          }
                                      ?>
                                </select>
                                
                            </div>
                      
                            <div class="col-md-3  form-group">
                                <?php
                                    $service_type_res = $this->db->get_where(db_prefix().'service_type')->result();
                                ?>
                               <?= _l('Service Type'); ?>
                                <select name="service_type[]"   id="service_type"  class="form-control selectpicker" tabindex="-98" data-live-search="true" required=""   multiple=""  onchange="getservicehide(this.value);">
                                    
                                    <?php
                                        if($service_type_res)
                                        {
                                           ?>
                                          
                                          <?php
                                            foreach($service_type_res as $rst)
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
    //var islogin = '<?= $client_data->userid; ?>';
    var get_client_user_id = '<?= get_client_user_id(); ?>';
    $(document).ready(function() {
        if(get_client_user_id!=''){
                clientlist_table = $('#clientdata_list').DataTable({ 
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": false, //Feature control DataTables' servermside processing mode.
                    "order": [[0,'desc']], //Initial no order.
                    "ordering": true,
                    "searching": true,
                    "ajax": {
                        "url": "<?php echo base_url('clients/loadClientsData')?>",
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
        $('#service_type').selectpicker('refresh');
        $('#gender').selectpicker('refresh');
    }


    $(document).ready(function(){
    
    $('.selectpicker').selectpicker('refresh');
      var dt = new Date();
      var dt1 = dt.setDate(dt.getDate() - 4748);

        $("#dob").datetimepicker({
            timepicker:false,
            format: 'd-m-Y',
             maxDate: dt1,
             startDate: dt1,
            onSelect: function(selected) {
               $("#dob").datetimepicker("option","maxDate", selected)
            }
        });

        $("#doj").datetimepicker({ 
          timepicker:false,
            format: 'd-m-Y',
            // minDate:0,
            // onSelect: function(selected) {
            //    $("#doj").datetimepicker("option","maxDate", selected)
            // }
        });  
    });
        
    window.addEventListener('load',function(){
           appValidateForm($('#addclientForm'), {
           service_type: 'required',
           department_id: 'required',
        }, clientadd_form);
    });

    function clientadd_form(form) {
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
                $('#addclientForm').validate().resetForm();
                clientlist_table.ajax.reload();  
                $('#studentlistmodel').modal('show');
            }
            else
            {
                errormsg(response.message);
            }
        });
        return false;
    }

    $('#newClientModal').on('hidden.bs.modal', function (e) {       
                $('#addclientForm').validate().resetForm(); 
                
        $('#addclientForm')[0].reset(); 

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
                        $('.bootstrap-select.is-invalid .dropdown-toggle, .error .bootstrap-select .dropdown-toggle, .has-error .bootstrap-select .dropdown-toggle, .was-validated .bootstrap-select select:invalid+.dropdown-toggle').css('border-color', '#ffffff');
                        var res = '<select class="form-control  selectpicker cityn"    data-live-search="true"  tabindex="-98"    name="city" id="cityn"  onchange="getCityhide(this.value);">';
                            //res += '<option value=""></option>';
                        for(var i=0; i<resp.length; i++)
                        {
                           res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                        }
                        res += '</select>';

                    }
                    else
                    {
                        var res = '<select class="form-control  selectpicker cityn"    data-live-search="true"  tabindex="-98"   required name="city" id="cityn"  onchange="getCityhide(this.value);">';
                           // res += '<option value=""></option>';
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
       $('#service_type-error').text('');
      }
      
       
    }
    function getdepartmenthide(Id)
    {
      if(Id!=''){
       $('#department_id-error').text('');
      }
      
       
    }
  function getStatelist2(Id)
    {
        $('.firststatelist').html('<option value="">Please wait...</option>');
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
                    var res = '<select class="form-control  selectpicker staten2"  data-live-search="true"    tabindex="-98"     name="state2" id="staten2" onchange="getCitylist2(this.value)">';
                        // res += '<option value=""></option>';
                    for(var i=0; i<resp.length; i++)
                    {
                       res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                    }
                        res += '</select>';
                    $('.firststatelist').html(res);
                    $('.staten2').selectpicker('refresh');
                }
                else
                {
                    $('.firststatelist').html('<option value=""></option>');
                    $('.staten2').selectpicker('refresh');
                }
            }            
        });        
    }
    
    function getCitylist2(Id)
    {
        $('.firstcitylis').html('<option value="">Please wait...</option>');
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
                    var res = '<select class="form-control selectpicker cityn2"   data-live-search="true"   tabindex="-98"     name="city2" id="cityn2">';
                     // res += '<option value=""></option>';
                    for(var i=0; i<resp.length; i++)
                    {
                       res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                    }
                    res += '</select>';
                    $('.firstcitylist').html(res);
                    $('.cityn2').selectpicker('refresh');
                }
                else
                {
                    $('.firstcitylis').html('<option value=""></option>');
                    $('.cityn2').selectpicker('refresh');
                }
            }
        });
    }

   $("select[name=country]").on("change",function(){
    getCitylist('1');
   });

   $("select[name=country2]").on("change",function(){
    getCitylist2('1');
   });
</script>