<div role="tabpanel" class="tab-pane" id="ServiceAgreements">

    <div class="text-right">
        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#serviceAgreementsModal" id="serviceAgreementsModalBTN">Add Service Agreements</a>
    </div>
    <div class="table-responsive mt-2">
        <table class="table table-custom serviceAgreements-table-custom" data-order-col="0" data-order-type="asc" id='serviceAgreements_List' style="width:100%">
            <thead>
                <th>My Care Plan</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Lock/Unlock</th>
                <th class="th-ticket-subject text-right">Action</th>
            </thead>
            <tbody>
            </tbody>
        </table>
        <!-- Paginate -->
        <div id='pasinationserviceAgreements'></div>
    </div>
</div>

<!--Add update -->
<!-- Modal -->
<div class="modal fade" id="serviceAgreementsModal" tabindex="-1" role="dialog" aria-labelledby="serviceAgreementsModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="serviceAgreementsModalLabel">Service Agreements - <span class="clients_name"></span></h4>
            </div>
            <div class="modal-body">
                
                <?php echo form_open_multipart('clients/createServiceAgreements',array('id'=>'createServiceAgreements', 'class' => 'form-horizontal')); ?>            
                    <div class="form-group" id="allClear">
                        <label for="Date" class="col-sm-2 control-label">Form</label>
                        <div class="col-sm-10">
                            <input type="text" name="client_id"   id="client_id"  value ="<?php echo $client_data->userid; ?>"  required class="form-control clientid hide" />
                            <div id="formType">
                                
                            </div>
                        </div>
                    </div>
                    <div class="moreserviceAgreements"></div>
                    <hr class="hr-panel-heading" />
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script>
    
    /* Success message  */
    function successmsg(msg)
    {
        toastr.success('',msg);
    }
    
    function errormsg(msg)
    {
        toastr.error('',msg);
    }
    $(document).ready(function() {
        serviceAgreements_table = $('#serviceAgreements_List').DataTable({ 
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' servermside processing mode.
            "order": [], //Initial no order.
            "ordering": false,
            "searching": false,
            "ajax": {
                "url": "<?php echo base_url('clients/loadServiceAgreementsData')?>",
                "type": "POST",
                "dataType": "json",
                "data":{},
                "data": function ( data ) {
                    data.filter_by = {'client_id':<?php echo $this->uri->segment(3); ?>};
                },
                "dataSrc": function (jsonData) {
                  return jsonData.data;
                }
            },
        });
        getFormType();
    });


    
    function getServiceAgreements()
    {
        serviceAgreements_table.ajax.reload(); 
        getFormType();
    }

    window.addEventListener('load',function(){
           appValidateForm($('#createServiceAgreements'), {
            form_id: 'required'
        }, createServiceAgreements_form);
    });

    function createServiceAgreements_form(form) {
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
                $('#createServiceAgreements').validate().resetForm();
                getFormType();
                serviceAgreements_table.ajax.reload(); 
            }else{
                errormsg(response.message);
            }
        });
        return false;
    }


    $('#serviceAgreementsModal').on('hidden.bs.modal', function (e) {        
        $('#createServiceAgreements')[0].reset();  
                $('#createServiceAgreements').validate().resetForm();
        // var client_id = '<?= $client_data->userid; ?>';
        // $('.client_id').val(client_id);  
        $( '.selectpicker' ).selectpicker( 'refresh' );   
    });


    function getFormType()
    {
        $.ajax({
            url: '<?= base_url()?>clients/getFormType',
            type: 'POST',
            data: {'client_id':<?php echo $this->uri->segment(3); ?>},
            datatype: 'json',
            cache: false,
            success: function(resp_){ 
               
                if(resp_!='null')
                {
                     $('#serviceAgreementsModalBTN').show();
                    var resp = JSON.parse(resp_);
                    var res = '<select class="form-control" required  name="form_id" id="form_id" >';
                    for(var i=0; i<resp.length; i++)
                    {
                       res += '<option value="'+resp[i].id+'" data-value="'+resp[i].id+'">'+resp[i].name+'</option>';
                    }
                    res += '</select>';
                    $('#formType').html(res);
                   
                }
                else
                { 

                    $('#serviceAgreementsModalBTN').hide();
                    
                }
            }
        });
    }



    function removeServiceAgreementsSection(id)
    {
        var r = confirm("Are you sure want to delete?");
        if (r == true) {
            $.ajax({
                url: '<?=base_url()?>clients/removeServiceAgreementsSection/'+id,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    $('#careid'+id).empty();
                    getFormType();
                    successmsg('Remove successfully');
                    serviceAgreements_table.ajax.reload();
                }
           });
        }
    }


function form_open_as(key,form_id)
    {
         

         var str = "key="+key+"&"+csrfData['token_name']+"="+csrfData['hash'];
            $.ajax({
                url: '<?= base_url()?>api/client/login_as',
                type: 'GET',
                data: str,
                datatype: 'json',
                cache: false,
                success: function(response){
                    if(response)
                    {
                        var key_final = response.result;
                        window.open("http://caringapproach.manageprojects.in/client/"+key_final+"/"+form_id, "_blank");
                      
                    }
                    else
                    {
                    }
                }
            });


    }


    function changeLockStatus(id,lock_status)
    {

    // var r = confirm("Are you sure want to Change Status?");
    //   if (r == true) {
        $.ajax({
              url: '<?=base_url()?>clients/changeLockStatus/'+id+'/'+lock_status,
              type: 'get',
              dataType: 'json',
              success: function(response){
                  successmsg('Change Successfully');
                  serviceAgreements_table.ajax.reload(); 
              }
         });
      // }
    }



  
</script>
