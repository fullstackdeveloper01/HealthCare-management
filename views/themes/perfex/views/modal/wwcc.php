<style>
    .spncss{
        color: #ff0000;
        font-weight: 800;
    }
</style>
<div role="tabpanel" class="tab-pane" id="Wwcc">
    <div class="table-responsive mt-2">
        <table class="table table-custom" data-order-col="0" data-order-type="asc" id='wwcc_List' style="width:100%">
            <thead>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Days</th>
                <th>Last Updated By</th>
                <th>Last Updated Date</th>
                <th>Action</th>
            </thead>
            <tbody>
            </tbody>
        </table>
        <!-- Paginate -->
        <div id='pagination'></div>
    </div>
</div>

<div class="modal fade" id="editwwccModal" tabindex="-1" role="dialog" aria-labelledby="wwccModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="wwccModalLabel">WWCC/WWVP Update - <span class="clients_name"></span></h4>
            </div>
            <div class="modal-body Wwcce_">

            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script type='text/javascript'>
     /*$(document).ready(function() {
        wwcc_table = $('#wwcc_List').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' servermside processing mode.
            "order": [], //Initial no order.
            "ordering": false,
            "searching": false,
            "ajax": {
                "url": "<?php echo base_url('clients/loadWwccData') ?>",
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
    });*/

    function getWwcc() 
    {
        wwcc_table.ajax.reload();
    }
 

    function updateWwcc_form(form) {
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
                wwcc_table.ajax.reload();
            }
        });
        return false;
    }




    function editWwcc(careid) {
        $.ajax({
            url: '<?= base_url() ?>clients/editWwcc/' + careid,
            type: 'get',
            success: function(response) {
                $('.Wwcce_').html(response);
                $("#wwcc_start_date").datepicker({
                    dateFormat: 'dd-mm-yy',
                    changeMonth: true,
                    changeYear: true,
                    onSelect: function(selected) {
                        $("#wwcc_end_date").datepicker("option", "minDate", selected)
                    }
                });
                $("#wwcc_end_date").datepicker({
                    dateFormat: 'dd-mm-yy',
                    changeMonth: true,
                    changeYear: true,
                    onSelect: function(selected) {
                        $("#wwcc_start_date").datepicker("option", "maxDate", selected)
                    }
                });

                appValidateForm($('#createWwccUpdate'), {
                    wwcc_start_date: 'required',
                    wwcc_end_date: 'required'
                }, updateWwcc_form);
            }
        });
    }

    $(document).ready(function() {
        $("#wwcc_start_date").datepicker({
                    dateFormat: 'dd-mm-yy',
                    changeMonth: true,
                    changeYear: true,
            onSelect: function(selected) {
                $("#wwcc_end_date").datepicker("option", "minDate", selected)
            }
        });
        $("#wwcc_end_date").datepicker({
                    dateFormat: 'dd-mm-yy',
                    changeMonth: true,
                    changeYear: true,
            onSelect: function(selected) {
                $("#wwcc_start_date").datepicker("option", "maxDate", selected)
            }
        });
    });


</script>