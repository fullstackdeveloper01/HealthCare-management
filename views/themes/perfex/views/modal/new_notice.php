<div class="modal fade" id="newNoticeModal" tabindex="-1" role="dialog" aria-labelledby="newNoticeModalLabel">
    <div class="modal-dialog full-modal" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="newNoticeModalLabel">Add Notice</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('clients/createNoticeSection',array('id'=>'addnoticeForm', 'autocomplete' => 'off')); ?>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label>Title<span class="text-danger">*</span></label>
                            <input type="text" id="title"   maxlength="60" minlength="3"    name="title"  class="form-control" required />
                            
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

<div class="modal fade" id="editNoticeModal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel">
    <div class="modal-dialog full-modal" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="noticeModalLabel">Notice Update </h4>
            </div>
            <div class="modal-body noticeSectione_">
                
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
            notice_table = $('#noticedata_list').DataTable({ 
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' servermside processing mode.
                "order": [], //Initial no order.
                "ordering": false,
                "searching": false,
                "ajax": {
                    "url": "<?php echo base_url('clients/loadNoticeData')?>",
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
           appValidateForm($('#addnoticeForm'), {
            description: 'required',
            title: 'required'        
        }, noticeadd_form);
    });

    function noticeadd_form(form) {
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
            // console.log(response);
            response = JSON.parse(response);
            if (response.success == true) {
                successmsg(response.message);
                $('.close').click();
                notice_table.ajax.reload();  
                $('#addnoticeForm').validate().resetForm();
                
                setTimeout(function() {
                    $('#noticelistmodel').modal('show');
                }, 1000);
            }
            else
            {
                errormsg(response.message);
            }
        });
        return false;
    }

    function getNotice() 
    {
        notice_table.ajax.reload();
    }

    function noticeUpdate_form(form) {
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
                $('#addnoticeForm').validate().resetForm();
                notice_table.ajax.reload();  
                setTimeout(function() {
                    $('#noticelistmodel').modal('show');
                }, 1000);
            }
        });
        return false;
    }

    $('#newNoticeModal').on('hidden.bs.modal', function (e) {       

        $('#addnoticeForm')[0].reset();  
        $('#addnoticeForm').validate().resetForm();             
    });



    $('#newNoticeModal').on('shown.bs.modal', function (e) {
         $('#addnoticeForm')[0].reset();  
        $('#addnoticeForm').validate().resetForm();   

           appValidateForm($('#addnoticeForm'), {
            description: 'required',
            title: 'required'
        }, noticeadd_form);
    });



    function removenoticeSection(id)
    {
        var r = confirm("Are you sure want to delete?");
        if (r == true) {
            $.ajax({
                url: '<?=base_url()?>clients/removenoticeSection/'+id,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    $('#careid'+id).empty();
                    successmsg('Remove successfully');
                    notice_table.ajax.reload();
                }
           });
        }
    }

    function editnoticeSection(careid)
    {
        $.ajax({
            url: '<?=base_url()?>clients/editnoticeSection/'+careid,
            type: 'get',
            success: function(response){
              $('.noticeSectione_').html(response); 
             
              appValidateForm($('#updateNotice'), {
                   title: 'required',
                    description: 'required'
              }, noticeUpdate_form);
            }
       });
    }




</script>