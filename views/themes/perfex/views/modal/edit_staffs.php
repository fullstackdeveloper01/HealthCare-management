
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
</script>