<div role="tabpanel" class="tab-pane" id="Clientstaff">

    <div class="table-responsive mt-2">
        <table class="table table-custom" data-order-col="0" data-order-type="asc" id='clientstaff_List' style="width:100%">
            <thead>
                <th class="not">Client ID </th>
                <th class="not">Client Name</th>
                <th>Care Plan</th>
                <th>Service</th>
                <th>Phone No</th>
                <th>Address</th>
                <th>Assign Date</th>
                <th>Assign By</th>
            </thead>
            <tbody>
            </tbody>
        </table>
        <!-- Paginate -->
        <div id='pagination'></div>
    </div>
</div>


<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script type='text/javascript'>
    $(document).ready(function() {
        clientstaff_table = $('#clientstaff_List').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' servermside processing mode.
            "order": [], //Initial no order.
            "ordering": false,
            "searching": false,
            "ajax": {
                "url": "<?php echo base_url('clients/loadClientStaffData') ?>",
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

    function getClientstaff() {
        clientstaff_table.ajax.reload();
    }
 
</script>