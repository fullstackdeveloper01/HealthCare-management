<div role="tabpanel" class="tab-pane" id="CarePlan">
    <div class="text-right">
        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#cateplanModal">Add Care plan</a>
    </div>
    <div class="table-responsive mt-2">
        <table class="table table-custom" data-order-col="0" data-order-type="asc" id='careplan_list' style="width:100%">
            <thead>
                <th>My Care Plan</th>
                <th>Date</th>
                <th>Action</th>
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
<div class="modal fade" id="cateplanModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Plan Assign - <span class="clients_name"></span></h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('clients/createCarePlan', array('id' => 'createcareplan', 'class' => 'form-horizontal')); ?>
                <div class="form-group">
                    <label for="inputTitle" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" required class="form-control" id="inputTitle" />
                        <input type="text" name="client_id"  value ="<?php echo $client_data->userid; ?>"   required class="form-control clientid hide" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Upload</label>
                    <div class="col-sm-10">
                        <input type="file" extension="pdf" accept=".pdf" name="care_plan" required class="form-control" id="inputUpload3" placeholder="Upload" />
                    </div>
                </div>
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
<div class="modal fade" id="editcateplanModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Plan Update - <span class="clients_name"></span></h4>
            </div>
            <div class="modal-body careplane_">

            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function() {
        carplan_table = $('#careplan_list').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' servermside processing mode.
            "order": [], //Initial no order.
            "ordering": false,
            "searching": false,
            "ajax": {
                "url": "<?php echo base_url('clients/loadCarePlanData') ?>",
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

    var fileInput = document.getElementById("inputUpload3");
     
    fileInput.addEventListener("change", function () {
        console.log('file ciongs', fileInput.files.length);
        jQuery('.error-file').remove();
        if (fileInput.files.length > 0) {
            var fileSize = fileInput.files.item(0).size;
            var file = Math.round((fileSize / 1024));
           // const fileMb = fileSize / 1024 ** 3;
            if (file >= 3096) {  
                jQuery('#inputUpload3').after("<p class='error-file' style='color:red;font-size:12px;'>Please select a file less than 3MB.</p>");
                jQuery('#createcareplan').find('button[type="submit"]').prop("disabled",true);
            } else {
             jQuery('#createcareplan').find('button[type="submit"]').prop("disabled",false);
            }
        }
    });


    window.addEventListener('load', function() {
        appValidateForm($('#createcareplan'), {
            title: 'required',
            care_plan: {
                required: true,
                extension: 'pdf'
            }
        }, createcareplan_form);
    });

    function createcareplan_form(form) {
        var formURL = form.action;
        var formData = new FormData($(form)[0]);
        // console.log('aliakbar');
        jQuery('#createcareplan').find('button[type="submit"]').prop("disabled",true);
        $.ajax({
            type: $(form).attr('method'),
            data: formData,
            mimeType: $(form).attr('enctype'),
            contentType: false,
            cache: false,
            processData: false,
            url: formURL
        }).done(function(response) {
            console.log(response);
            
            response = JSON.parse(response);
            if (response.success == true) {
                $("#createcareplan")[0].reset();
                successmsg(response.message);
                $('.close').click();
                 $('#createcareplan').validate().resetForm(); 
                carplan_table.ajax.reload();
            }
            
            jQuery('#createcareplan').find('button[type="submit"]').prop("disabled",false);
        });
        return false;
    }

    function updatecareplan_form(form) {
        var formURL = form.action;
        var formData = new FormData($(form)[0]);
        // console.log('aliakbar');
        $.ajax({
            type: $(form).attr('method'),
            data: formData,
            mimeType: $(form).attr('enctype'),
            contentType: false,
            cache: false,
            processData: false,
            url: formURL
        }).done(function(response) {
            console.log(response);
            response = JSON.parse(response);
            if (response.success == true) {
                successmsg(response.message);
                $('.close').click();
                 $('#createcareplan').validate().resetForm();
                carplan_table.ajax.reload();
            }
        });
        return false;
    }

    $('#cateplanModal').on('hidden.bs.modal', function(e) {
        $('#createcareplan')[0].reset();
                 $('#createcareplan').validate().resetForm();
        // var clientid = '<?= $client_data->userid; ?>';
        // $('.clientid').val(clientid);
    });

    function removeCareplan(id) {
        var r = confirm("Are you sure want to delete?");
        if (r == true) {
            $.ajax({
                url: '<?= base_url() ?>clients/removeCareplan/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    $('#careid' + id).empty();
                    successmsg('Remove successfully');
                    carplan_table.ajax.reload();
                }
            });
        }
    }

    function editShowCarePlan(careid) {
        $.ajax({
            url: '<?= base_url() ?>clients/editShowCarePlan/' + careid,
            type: 'get',
            success: function(response) {
                $('.careplane_').html(response);
                appValidateForm($('#createcareplan2'), {
                    title: 'required',
                    // care_plan:{required:true,extension: 'pdf'}
                }, updatecareplan_form);

            }
        });
    }
</script>