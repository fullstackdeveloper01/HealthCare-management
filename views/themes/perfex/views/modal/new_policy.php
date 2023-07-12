<div class="modal fade" id="newPolicyModal" tabindex="-1" role="dialog" aria-labelledby="newPolicyModalLabel">
    <div class="modal-dialog full-modal" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="newPolicyModalLabel">Add Policy</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('clients/createPolicySection',array('id'=>'addpolicyForm', 'autocomplete' => 'off')); ?>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label>Subject<span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name"  maxlength="60" minlength="3"   value="<?php echo $article->name; ?>" class="form-control" required />
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Upload(PDF)<span class="text-danger">*</span></label>
                        <div class="clearfix">
                            <input type="file" extension="pdf" accept=".pdf" name="policy" required class="form-control" id="policy" placeholder="Upload" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <div class="clearfix">
                            <textarea name="description" class="form-control" id="description" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="modal-footer">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editPolicyModal" tabindex="-1" role="dialog" aria-labelledby="policyModalLabel">
    <div class="modal-dialog full-modal" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="policyModalLabel">Policy Update </h4>
            </div>
            <div class="modal-body policySectione_">
                
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script type="text/javascript" id="moment-js" src="<?php echo base_url('assets/builds/moment.min.js?v=2.4.2'); ?>"></script>
<script type="text/javascript" id="bootstrap-select-js" src="<?php echo base_url('assets/builds/bootstrap-select.min.js?v=2.4.2'); ?>"></script>
<script type="text/javascript" id="tinymce-js" src="<?php echo base_url('assets/plugins/tinymce/tinymce.min.js?v=2.4.2'); ?>"></script>
<script type="text/javascript" id="jquery-validation-js" src="<?php echo base_url('assets/plugins/jquery-validation/jquery.validate.min.js?v=2.4.2'); ?>"></script>
<script type="text/javascript" id="app-js" src="<?php echo base_url('assets/js/main.min.js?v=2.4.2'); ?>"></script>
<script type="text/javascript" id="tinymce-stickytoolbar" src="<?php echo base_url('assets/plugins/tinymce-stickytoolbar/stickytoolbar.js'); ?>"></script>

<script type='text/javascript'>
    var islogin = '<?= $client_data->userid; ?>';
    var get_client_user_id = '<?= get_client_user_id(); ?>';
    var get_user_id_role = '<?= get_user_id_role(); ?>';
  
    $(document).ready(function() {
        if((get_user_id_role==4 || get_user_id_role==3) && get_client_user_id!=''){
            policy_table = $('#policydata_list').DataTable({ 
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' servermside processing mode.
                "order": [], //Initial no order.
                "ordering": false,
                "searching": false,
                "ajax": {
                    "url": "<?php echo base_url('clients/loadPolicyData')?>",
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





    window.addEventListener('load',function(){
           appValidateForm($('#addpolicyForm'), {
            name: 'required',
            policy: {
                required: true,
                extension: 'pdf'
            }
        }, policyadd_form);
    });

    function getPolicy() 
    {
        policy_table.ajax.reload();
    }
    function policyadd_form(form) {
        var formURL = form.action;
        var formData = new FormData($(form)[0]);
        jQuery('#addpolicyForm').find('button[type="submit"]').prop("disabled",true);
        $.ajax({
            type: $(form).attr('method'),
            data: formData,
            mimeType: $(form).attr('enctype'),
            contentType: false,
            cache: false,
            processData: false,
            url: formURL
        }).done(function(response) {
            console.log(response)
            response = JSON.parse(response);
            if (response.success == true) {
                $("#addpolicyForm")[0].reset();
                successmsg(response.message);
                $('.close').click();
                policy_table.ajax.reload();  
                $('#addpolicyForm').validate().resetForm();
                $('#policylistmodel').modal('show');
            }
            else
            {
                errormsg(response.message);
            }
            jQuery('#addpolicyForm').find('button[type="submit"]').prop("disabled",false);
        });
        return false;
    }


    function policyUpdate_form(form) {
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
                $('#addpolicyForm').validate().resetForm();
                policy_table.ajax.reload(); 
                $("#policylistmodel").modal('show');
                
            }
        });
        return false;
    }

    $('#newPolicyModal').on('hidden.bs.modal', function (e) {       

        $('#addpolicyForm')[0].reset();  
        $('#addpolicyForm').validate().resetForm();             
    });

    $('#newPolicyModal').on('shown.bs.modal', function (e) {
         $('#addpolicyForm')[0].reset();  
        $('#addpolicyForm').validate().resetForm();   

           appValidateForm($('#addpolicyForm'), {
            name: 'required',
            policy: {
                required: true,
                extension: 'pdf'
            }
        }, policyadd_form);
    });

    function removepolicySection(id)
    {
        var r = confirm("Are you sure want to delete?");
        if (r == true) {
            $.ajax({
                url: '<?=base_url()?>clients/removepolicySection/'+id,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    console.log(response);
                    $('#careid'+id).empty();
                    successmsg('Remove successfully');
                    policy_table.ajax.reload();
                }
           });
        }
    }

    function editpolicySection(careid)
    {
        $.ajax({
            url: '<?=base_url()?>clients/editpolicySection/'+careid,
            type: 'get',
            success: function(response){
              $('.policySectione_').html(response); 
             
              appValidateForm($('#updatePolicy'), {
                  name: 'required',
                  policy: {
                   // required: true,
                    extension: 'pdf'
                }
              }, policyUpdate_form);
            }
       });
    }




</script>