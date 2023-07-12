<div role="tabpanel" class="tab-pane" id="RequestAmendment">

    <div class="table-responsive mt-2">
        <table class="table table-custom requestamendment-table-custom" data-order-col="0" data-order-type="asc" id='requestamendment_List' style="width:100%">
            <thead>
                <th>Client name</th>
                <th>Request For</th>
                <th>Title</th>
                <th>Date</th>
                <th>Description</th>
                <th>Status</th>
                <th class="th-ticket-subject text-right">Action</th>
            </thead>
            <tbody>
            </tbody>
        </table>
        <!-- Paginate -->
        <div id='pasinationrequestamendment'></div>
    </div>
</div>

<!--Add update -->



<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script type='text/javascript'>
    $(document).ready(function() {
        requestamendment_table = $('#requestamendment_List').DataTable({ 
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' servermside processing mode.
            "order": [], //Initial no order.
            "ordering": false,
            "searching": false,
            "ajax": {
                "url": "<?php echo base_url('clients/loadRequestAmendmentData')?>",
                "type": "POST",
                "dataType": "json",
                "data":{},
                "data": function ( data ) {
                    data.filter_by = {'client_id':<?php echo $this->uri->segment(3); ?>};
                },
                "dataSrc": function (jsonData) {
                  return jsonData.data;
                }
            },
        });
    });


    $(document).ready(function(){
   
    });

    
    function getRequestAmendment()
    {
        requestamendment_table.ajax.reload(); 
    }





    function changeStatusRequestAmendment(id,status)
    {
        // var r = confirm("Are you sure want to Change Status?");
        // if (r == true) {
            $.ajax({
                url: '<?=base_url()?>clients/changeStatusRequestAmendment/'+id+'/'+status,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    $('#careid'+id).empty();
                    successmsg('Status Change Successfully');
                    requestamendment_table.ajax.reload(); 
                }
           });
        // }
    }

 



  
</script>
