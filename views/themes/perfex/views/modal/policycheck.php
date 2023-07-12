<style>
    .spncss{
        color: #ff0000;
        font-weight: 800;
    }
</style>
    <div role="tabpanel" class="tab-pane" id="Policecheck">
    <div class="table-responsive mt-2">
        <table class="table table-custom" data-order-col="0" data-order-type="asc" id='policecheck_List' style="width:100%">
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

<div class="modal fade" id="editpolicecheckModal" tabindex="-1" role="dialog" aria-labelledby="policecheckModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="policecheckModalLabel">Police Check Update - <span class="clients_name"></span></h4>
            </div>
            <div class="modal-body Policechecke_">

            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script type='text/javascript'>
   /* $(document).ready(function() {
        policecheck_table = $('#policecheck_List').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' servermside processing mode.
            "order": [], //Initial no order.
            "ordering": false,
            "searching": false,
            "ajax": {
                "url": "<?php echo base_url('clients/loadPoliceCheckData') ?>",
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

    function getPoliceCheck() 
    {
        policecheck_table.ajax.reload();
    }
 

    function updatePolicecheck_form(form) {
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
                policecheck_table.ajax.reload();
            }
        });
        return false;
    }




    function editPolicecheck(careid) {
        $.ajax({
            url: '<?= base_url() ?>clients/editPolicecheck/' + careid,
            type: 'get',
            success: function(response) {
                $('.Policechecke_').html(response);
                $("#police_start_date").datepicker({
                    dateFormat: 'dd-mm-yy',
                    changeMonth: true,
                    changeYear: true,
                    onSelect: function(selected) {
                        $("#police_end_date").datepicker("option", "minDate", selected)
                    }
                });
                $("#police_end_date").datepicker({
                    dateFormat: 'dd-mm-yy',
                    changeMonth: true,
                    changeYear: true,
                    onSelect: function(selected) {
                        $("#police_start_date").datepicker("option", "maxDate", selected)
                    }
                });

                appValidateForm($('#createPolicecheckUpdate'), {
                    police_start_date: 'required',
                    police_end_date: 'required'
                }, updatePolicecheck_form);
            }
        });
    }

    $(document).ready(function() {
        $("#police_start_date").datepicker({
    dateFormat: 'dd-mm-yy',
    changeMonth: true,
    changeYear: true,
            onSelect: function(selected) {
                $("#police_end_date").datepicker("option", "minDate", selected)
            }
        });
        $("#police_end_date").datepicker({
    dateFormat: 'dd-mm-yy',
    changeMonth: true,
    changeYear: true,
            onSelect: function(selected) {
                $("#police_start_date").datepicker("option", "maxDate", selected)
            }
        });
    });


</script>