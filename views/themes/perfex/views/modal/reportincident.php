<div role="tabpanel" class="tab-pane" id="Reportincident">
  
    <div class="table-responsive mt-2">
        <table class="table table-custom" data-order-col="0" data-order-type="asc" id='reportincident_list' style="width:100%">
            <thead>
                <!-- <th>Sr.no</th> -->
                <th>Date</th>
                <th>Time</th>
                <th>Client</th>
                <th>CLO</th>
                <th>Description</th>
                <th>Action</th> 
            </thead>
            <tbody>
            </tbody>
        </table>
        <!-- Paginate -->
        <div id='pagination'></div>
    </div>
</div>


<div class="modal fade" id="editreportincidentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="reportincident">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Report Incident Update - <span class="clients_name"></span></h4>
            </div>
            <div class="modal-body reportincidente_">

            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function() {
        reportincident_table = $('#reportincident_list').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' servermside processing mode.
            "order": [], //Initial no order.
            "ordering": false,
            "searching": false,
            "ajax": {
                "url": "<?php echo base_url('clients/loadReportincidentData') ?>",
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

    function getReportIncident()
    {

        $('#createreportincident').validate().resetForm();
        reportincident_table.ajax.reload(); 
    }


    window.addEventListener('load', function() {
        appValidateForm($('#createreportincident'), {
            title: 'required',
            reportincident: {
                required: true,
                extension: 'pdf'
            }
        }, createreportincident_form);
    });

    function createreportincident_form(form) {
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
                $('#createreportincident').validate().resetForm();
                reportincident_table.ajax.reload();
            }
        });
        return false;
    }

    function updatereportincident_form(form) {
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
                $('#createreportincident').validate().resetForm();
                reportincident_table.ajax.reload();
            }
        });
        return false;
    }

    $('#reportincidentModal').on('hidden.bs.modal', function(e) {
        $('#createreportincident')[0].reset();
        $('#createreportincident').validate().resetForm();
        var clientid = '<?= $client_data->userid; ?>';
        $('.clientid').val(clientid);
    });

    function removeReportincident(id) {
        var r = confirm("Are you sure want to delete?");
        if (r == true) {
            $.ajax({
                url: '<?= base_url() ?>clients/removeReportincident/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#careid' + id).empty();
                    successmsg('Remove successfully');
                    reportincident_table.ajax.reload();
                }
            });
        }
    }

    function editShowReportincident(careid) {
        $.ajax({
            url: '<?= base_url() ?>clients/editShowReportincident/' + careid,
            type: 'get',
            success: function(response) {
               
                appValidateForm($('#createreportincident2'), {
                    title: 'required',
                    // document:{required:true,extension: 'pdf'}
                }, updatereportincident_form);

            }
        });
    }
</script>