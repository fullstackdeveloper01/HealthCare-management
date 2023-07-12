<div class="modal fade" id="newTraningModal" tabindex="-1" role="dialog" aria-labelledby="newTraningModalLabel">
    <div class="modal-dialog full-modal" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="newTraningModalLabel">Add Traning</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('clients/createTraningSection',array('id'=>'addtraningForm', 'autocomplete' => 'off')); ?>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label>Title<span class="text-danger">*</span></label>
                            <input type="text" id="title" maxlength="50" minlength="3"  name="title"  class="form-control" required />
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <div class="clearfix">
                             <textarea name="description" id="description" rows="10" class="form-control" required></textarea>
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

<div class="modal fade" id="editTraningModal" tabindex="-1" role="dialog" aria-labelledby="traningModalLabel">
    <div class="modal-dialog full-modal" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="traningModalLabel">Traning Update </h4>
            </div>
            <div class="modal-body traningSectione_">
                
            </div>
        </div>
    </div>
</div>


<script type='text/javascript'>
    var islogin = '<?= $client_data->userid; ?>';
    var get_client_user_id = '<?= get_client_user_id(); ?>';
    var get_user_id_role = '<?= get_user_id_role(); ?>';
    $(document).ready(function() {
        if(get_user_id_role==4 && get_client_user_id!=''){
            traning_table = $('#traningdata_list').DataTable({ 
                "processing": true, //Feature control the processing indicator.
                "serverSide": false, //Feature control DataTables' servermside processing mode.
                "order": [[0,'desc']], //Initial no order.
                "ordering": true,
                "searching": true,
                "language": {
                        "emptyTable": "No Training added yet"
                    },
                "ajax": {
                    "url": "<?php echo base_url('clients/loadTraningData')?>",
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
           appValidateForm($('#addtraningForm'), {
            description: 'required',
            title: 'required'        
        }, traningadd_form);
    });

    function traningadd_form(form) {
        var formURL = form.action;
        var formData = new FormData($(form)[0]);
        jQuery('#addtraningForm').find('button[type="submit"]').prop("disabled",true);
        $.ajax({
            type: $(form).attr('method'),
            data: formData,
            mimeType: $(form).attr('enctype'),
            contentType: false,
            cache: false,
            processData: false,
            url: formURL
        }).done(function(response) {
            console.log('response',response)
            response = JSON.parse(response);
            if (response.success == true) {
                $("#addtraningForm")[0].reset();
                successmsg(response.message);
                $('.close').click();
                // traning_table.ajax.reload();  
                // $('#addtraningForm').validate().resetForm();
                getTraning();
                $('#traninglistmodel').modal('show');
            }
            else
            {
                errormsg(response.message);
            }
            jQuery('#addtraningForm').find('button[type="submit"]').prop("disabled",false);
        });
        return false;
    }


    function getTraning() 
    {
        traning_table.ajax.reload();
    }
 
    function traningUpdate_form(form) {
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
                $('#addtraningForm').validate().resetForm();
                 // $('#editTraningModal').modal('show');
                traning_table.ajax.reload();  
            }
        });
        return false;
    }

    $('#newTraningModal').on('hidden.bs.modal', function (e) {       

        $('#addtraningForm')[0].reset();  
        $('#addtraningForm').validate().resetForm();             
    });



    $('#newTraningModal').on('shown.bs.modal', function (e) {
         $('#addtraningForm')[0].reset();  
        $('#addtraningForm').validate().resetForm();   

           appValidateForm($('#addtraningForm'), {
            description: 'required',
            title: 'required'
        }, traningadd_form);
    });



    function removetraningSection(id)
    {
        var r = confirm("Are you sure want to delete?");
        console.log(r)
        if (r == true) {
            $.ajax({
                url: '<?=base_url()?>clients/removetraningSection/'+id,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    console.log(response)
                    $('#careid'+id).empty();
                    successmsg('Remove successfully');
                    traning_table.ajax.reload();
                }
           });
        }
    }

    function edittraningSection(careid)
    {
        $.ajax({
            url: '<?=base_url()?>clients/edittraningSection/'+careid,
            type: 'get',
            success: function(response){
              $('.traningSectione_').html(response); 
             
              appValidateForm($('#updateTraning'), {
                   title: 'required',
                    description: 'required'
              }, traningUpdate_form);
            }
       });
    }




</script>