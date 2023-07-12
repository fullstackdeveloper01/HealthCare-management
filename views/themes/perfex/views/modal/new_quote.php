<div class="modal fade" id="newQuoteModal" tabindex="-1" role="dialog" aria-labelledby="newQuoteModalLabel">
    <div class="modal-dialog full-modal" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="newQuoteModalLabel">Add Quote</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('clients/createQuoteSection',array('id'=>'addquoteForm', 'autocomplete' => 'off')); ?>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label>Quote By<span class="text-danger">*</span></label>
                            <input type="text" id="quote_by"  maxlength="30" minlength="3" name="quote_by"  class="form-control" required />
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Quote</label>
                        <div class="clearfix">
                            <input type="text" id="title" name="title" class="form-control" required />
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

<div class="modal fade" id="editQuoteModal" tabindex="-1" role="dialog" aria-labelledby="quoteModalLabel">
    <div class="modal-dialog full-modal" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="quoteModalLabel">Quote Update </h4>
            </div>
            <div class="modal-body quoteSectione_">
                
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
            quote_table = $('#quotedata_list').DataTable({ 
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' servermside processing mode.
                "order": [], //Initial no order.
                "ordering": false,
                "searching": false,
                "ajax": {
                    "url": "<?php echo base_url('clients/loadQuoteData')?>",
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
           appValidateForm($('#addquoteForm'), {
            quote_by: 'required',
            title: 'required'        
        }, quoteadd_form);
    });

    function quoteadd_form(form) {
        var formURL = form.action;
        var formData = new FormData($(form)[0]);
        jQuery('#addquoteForm').find('button[type="submit"]').prop("disabled",true);
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
                $("#addquoteForm")[0].reset();
                successmsg(response.message);
                $('.close').click();
                quote_table.ajax.reload();  
                $('#addquoteForm').validate().resetForm();
                $('#quotelistmodel').modal('show');
            }
            else
            {
                errormsg(response.message);
            }
            jQuery('#addquoteForm').find('button[type="submit"]').prop("disabled",true);
        });
        return false;
    }


    function getQuote() 
    {
        quote_table.ajax.reload();
    }
    function quoteUpdate_form(form) {
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
                $('#addquoteForm').validate().resetForm();
                quote_table.ajax.reload();  
            }
        });
        return false;
    }

    $('#newQuoteModal').on('hidden.bs.modal', function (e) {       

        $('#addquoteForm')[0].reset();  
        $('#addquoteForm').validate().resetForm();             
    });



    $('#newQuoteModal').on('shown.bs.modal', function (e) {
         $('#addquoteForm')[0].reset();  
        $('#addquoteForm').validate().resetForm();   

           appValidateForm($('#addquoteForm'), {
            quote_by: 'required',
            title: 'required'
        }, quoteadd_form);
    });



    function removequoteSection(id)
    {
        var r = confirm("Are you sure want to delete?");
        if (r == true) {
            $.ajax({
                url: '<?=base_url()?>clients/removequoteSection/'+id,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    $('#careid'+id).empty();
                    successmsg('Remove successfully');
                    quote_table.ajax.reload();
                }
           });
        }
    }

    function editquoteSection(careid)
    {
        $.ajax({
            url: '<?=base_url()?>clients/editquoteSection/'+careid,
            type: 'get',
            success: function(response){
              $('.quoteSectione_').html(response); 
             
              appValidateForm($('#updateQuote'), {
                   quote_by: 'required',
            title: 'required'
              }, quoteUpdate_form);
            }
       });
    }




</script>