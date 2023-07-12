<div class="modal fade" id="newClientModal" tabindex="-1" role="dialog" aria-labelledby="newClientModalLabel">
    <div class="modal-dialog full-modal" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="newClientModalLabel">Add Client</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('clients/addClient',array('id'=>'addclientForm', 'autocomplete' => 'off')); ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <?= _l('Profile Image'); ?>
                                 <input type="file" class="form-control" required name="profile_image" accept=".jpg,.png">
                            </div>
                        </div>
                    </div>
                    <div class=" form-group">
                        <div class="row">
                            <div class="col-md-6">
                               <?= _l('First name'); ?>
                                <input type="text" id="first_name" name="first_name" class="form-control" required />
                            </div>
                            <div class="col-md-6">
                               <?= _l('Last name'); ?>
                                <input type="text" id="last_name" name="last_name" class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                               <?= _l('Email'); ?>
                                <input type="email" autocomplete="off" id="email" name="email" class="form-control" required />
                            </div>
                            <div class="col-md-6">
                               <?= _l('Password'); ?>
                                <input type="password" autocomplete="off" id="password" name="password" class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <div class=" form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <?= _l('Phone'); ?>
                                <input type="number" id="phonenumber" required name="phonenumber" class="form-control" autofocus="1" />
                            </div>
                            <div class="col-md-6">
                               <?= _l('Alternative Number'); ?>
                                <input type="text" class="form-control" name="alternative_mobile" required />
                            </div>
                        </div>
                    </div>
                    <div class=" form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <?= _l('Date of birth'); ?>
                                <input type="text" autocomplete="off" class="form-control " name="dob"  id="dob" placeholder="yyyy-mm-dd" required />
                            </div>
                            <div class="col-md-4">
                               <?= _l('Date of Joining'); ?>
                                <input type="text" autocomplete="off" class="form-control " name="doj"  id="doj" placeholder="yyyy-mm-dd" required />
                            </div>
                            <div class="col-md-4">
                               <?= _l('Gender'); ?>
                                <select class="form-control" name="gender" required>
                                    <option>Select Gender</option>
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=" form-group">
                        <div class="row">
                            <div class="col-md-12">
                               <?= _l('Address'); ?>
                                <input type="text" class="form-control" name="address" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                              <?php 
                                $country_list = $this->db->get_where(db_prefix().'country')->result();
                              ?>
                               <?= _l('Country'); ?>
                                <select class="form-control"  name="country"   onchange="getStatelist(this.value);">

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
                            <div class="col-md-3">
                               <?= _l('State'); ?>
                                <div class="statelists">
                                    <select class="form-control" name="state"  id="staten" onchange="getCitylist(this.value);">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                               <?= _l('City'); ?>
                                <div class="citylists_">
                                 <select class="form-control" name="city"  id="cityn">
                                     <option value=""></option>
                                 </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                               <?= _l('Postal Code'); ?>
                                <input type="text" class="form-control" name="postal_code"  required>
                            </div>
                        </div>
                    </div>
                    <div class=" form-group">
                        <div class="row">
                            <div class="col-md-12">
                               <?= _l('Address'); ?>
                                <input type="text" class="form-control" name="address2" required>
                            </div>
                        </div>
                    </div>
                    <div class=" form-group">
                        <div class="row">
                            <div class="col-md-3">
                               <?= _l('Country'); ?>
                                <select class="form-control "  name="country2"   onchange="getStatelist2(this.value);">
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
                            <div class="col-md-3">
                               <?= _l('State'); ?>
                                <div class="firststatelist">
                                 <select class="form-control" name="state2"  id="staten2" onchange="getCitylist2(this.value);">
                                     <option value=""></option>
                                 </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                               <?= _l('City'); ?>
                                <div class="firstcitylist">
                                    <select class="form-control" name="city2"  id="cityn2">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                               <?= _l('Postal Code'); ?>
                                <input type="text" class="form-control" name="postal_code2" required>
                            </div>
                        </div>
                    </div>
                    <div class=" form-group">
                        <div class="row">
                            <div class="col-md-12">
                               <?= _l('Office Location'); ?>
                                <input type="text" class="form-control" name="office_location" required />
                            </div>
                        </div>
                    </div>
                    <div class=" form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                    $service_type_res = $this->db->get_where(db_prefix().'service_type')->result();
                                ?>
                               <?= _l('Service Type'); ?>
                                <select name="service_type"   required="" class="form-control"  >
                                    <option>Select Service Type</option>
                                    <?php
                                        if($service_type_res)
                                        {
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
                            <div class="col-md-6">
                               <?= _l('Caring Plan/Department'); ?>
                                <?php
                                    $result_m = $this->db->get_where(db_prefix().'department')->result();
                                ?>
                                <select name="department_id[]"   required="" class="form-control"  multiple="" tabindex="-98">
                                    <?php
                                        foreach($result_m as $row_m)
                                        {
                                            echo "<option value='".$row_m->id."'>".$row_m->name."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
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
    var islogin = '<?= $client_data->userid; ?>';
    var get_client_user_id = '<?= get_client_user_id(); ?>';
    $(document).ready(function() {
        if(get_client_user_id!=''){
                clientlist_table = $('#clientdata_list').DataTable({ 
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' servermside processing mode.
                    "order": [], //Initial no order.
                    "ordering": false,
                    "searching": false,
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


    $(document).ready(function(){
    
    

        $("#dob").datepicker({
            maxDate: '-1d',
            dateFormat: 'yy-mm-dd',
            onSelect: function(selected) {
               $("#dob").datepicker("option","maxDate", selected)
            }
        });

        $("#doj").datepicker({ 
            minDate:0,
            dateFormat: 'yy-mm-dd',
            onSelect: function(selected) {
               $("#doj").datepicker("option","maxDate", selected)
            }
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
        $('#addclientForm')[0].reset();               
    });

    function getStatelist(Id)
    {
        //$('#staten').selectpicker('refresh');
        $('#staten').html('<option value="">Please wait...</option>');
        $('#cityn').html('<option value=""></option>');
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
                    var res = '<select class="form-control" name="state" required id="staten" onchange="getCitylist(this.value);">';
                        res += '<option value=""></option>';
                    for(var i=0; i<resp.length; i++)
                    {
                       res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                    }
                    res += '</select>';
                    $('.statelists').html(res);
                    // $('#staten').selectpicker('refresh');
                }
                else
                {
                    $('#staten').html('<option value=""></option>');
                    // $('#staten').selectpicker('refresh');
                }
            }
        });
    }
    
    function getCitylist(Id)
    {
        $('#cityn').html('<option value="">Please wait...</option>');
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
                    var res = '<select class="form-control" required name="city" id="cityn">';
                        res += '<option value=""></option>';
                    for(var i=0; i<resp.length; i++)
                    {
                       res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                    }
                    res += '</select>';
                    $('.citylists_').html(res);
                    // $('#cityn').selectpicker('refresh');
                }
                else
                {
                    $('#cityn').html('<option value=""></option>');
                    // $('#cityn').selectpicker('refresh');
                }
            }
        });
    }
  function getStatelist2(Id)
    {
        $('#staten2').html('<option value="">Please wait...</option>');
        $('#cityn2').html('<option value=""></option>');
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
                    var res = '<select class="form-control " required  name="state2" id="staten2" onchange="getCitylist2(this.value)">';
                        res += '<option value=""></option>';
                    for(var i=0; i<resp.length; i++)
                    {
                       res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                    }
                        res += '</select>';
                    $('.firststatelist').html(res);
                    // $('#staten2').selectpicker('refresh');
                }
                else
                {
                    $('#staten2').html('<option value=""></option>');
                }
            }            
        });        
    }
    
    function getCitylist2(Id)
    {
        $('#cityn2').html('<option value="">Please wait...</option>');
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
                    var res = '<select class="form-control " required  name="city2" id="cityn2">';
                     res += '<option value=""></option>';
                    for(var i=0; i<resp.length; i++)
                    {
                       res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                    }
                    res += '</select>';
                    $('.firstcitylist').html(res);
                    // $('#cityn2').selectpicker('refresh');
                }
                else
                {
                    $('#cityn2').html('<option value=""></option>');
                }
            }
        });
    }
</script>