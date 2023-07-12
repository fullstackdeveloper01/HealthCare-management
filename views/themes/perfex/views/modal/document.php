<div role="tabpanel" class="tab-pane" id="Document">
    <?php
    if(get_user_id_role()==3)
    {
    ?>
        <div class="text-right">
            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#documentModal">Add Document</a>
        </div>
    <?php
    }
    ?>
    <div class="table-responsive mt-2">
        <table class="table table-custom" data-order-col="0" data-order-type="asc" id='document_list' style="width:100%">
            <thead>
                <th>My Document</th>
                <th>Date</th>
                <th>Size</th>
    <?php
    if(get_user_id_role()==3)
    {
    ?>
                <th>Action</th>
                 <?php
    }
    ?>
            </thead>
            <tbody>
            </tbody>
        </table>
        <!-- Paginate -->
        <div id='pagination'></div>
    </div>
</div>

<!--Add update -->
<!-- Modal -->
<div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Document Assign - <span class="clients_name"></span></h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('clients/createDocument', array('id' => 'createdocument', 'class' => 'form-horizontal')); ?>
                <div class="form-group">
                    <label for="inputTitle" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" required class="form-control" id="inputTitle" />
                        <input type="text" name="client_id" required  value ="<?php echo $client_data->userid; ?>"  class="form-control clientid hide" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Upload</label>
                    <div class="col-sm-10">
                        <input type="file" extension="pdf" accept=".pdf,.docx" name="document" required class="form-control" id="inputUpload3" placeholder="Upload" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" id="doc-btn" class="btn btn-success">Submit</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editdocumentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Document Update - <span class="clients_name"></span></h4>
            </div>
            <div class="modal-body documente_">

            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    function documentSaveBtn(){
        $('#doc-btn').attr('disabled', 'disabled');
    }
    $(document).ready(function() {
        document_table = $('#document_list').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' servermside processing mode.
            "order": [], //Initial no order.
            "ordering": false,
            "searching": false,
            "oLanguage": {
                "sEmptyTable": "No Document added yet!!"
            },
            "ajax": {
                "url": "<?php echo base_url('clients/loadDocumentData') ?>",
                "type": "POST",
                "dataType": "json",
                "data": {},
                "data": function(data) {
                    data.filter_by = {
                        'client_id': <?php echo $this->uri->segment(3); ?>
                    };
                },
                "dataSrc": function(jsonData) {
                    return jsonData.data;
                }
            },
        });
    });

    function getDocument()
    {

        $('#createdocument').validate().resetForm();
        document_table.ajax.reload(); 
    }


    window.addEventListener('load', function() {
        appValidateForm($('#createdocument'), {
            title: {
            required: true,
            maxlength: 20
            },
            document: {
                required: true,
                extension: 'pdf,docx'
            }
        }, createdocument_form);
    });

    function createdocument_form(form) {
        var formURL = form.action;
        setTimeout(documentSaveBtn, 500)
        var formData = new FormData($(form)[0]);
        jQuery('#createdocument').find('button[type="submit"]').prop("disabled",true);

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
                $("#createdocument")[0].reset();
                successmsg(response.message);
                $('.close').click();
                $('#createdocument').validate().resetForm();
                document_table.ajax.reload();
            }
            jQuery('#createdocument').find('button[type="submit"]').prop("disabled",false);
        });
        return false;
    }

    function updatedocument_form(form) {
        var formURL = form.action;
        setTimeout(documentSaveBtn, 500)
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
                $('#createdocument').validate().resetForm();
                document_table.ajax.reload();
            }
        });
        return false;
    }

    $('#documentModal').on('hidden.bs.modal', function(e) {
        $('#createdocument')[0].reset();
        $('#createdocument').validate().resetForm();
        var clientid = '<?= $client_data->userid; ?>';
        $('.clientid').val(clientid);
    });

    function removeDocument(id) {
        var r = confirm("Are you sure want to delete?");
        if (r == true) {
            $.ajax({
                url: '<?= base_url() ?>clients/removeDocument/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#careid' + id).empty();
                    successmsg('Remove successfully');
                    document_table.ajax.reload();
                }
            });
        }
    }

    function editShowDocument(careid) {
        $.ajax({
            url: '<?= base_url() ?>clients/editShowDocument/' + careid,
            type: 'get',
            success: function(response) {
                $('.documente_').html(response);
                appValidateForm($('#createdocument2'), {
                    title: 'required',
                    // document:{required:true,extension: 'pdf'}
                }, updatedocument_form);

            }
        });
    }
</script>