
<!-- Client Modal -->
<div class="modal fade" id="requestamendmentclientlistmodel" tabindex="-1" aria-labelledby="requestamendmentclientlistLabel" aria-hidden="true" style="display: none;">
  	<div class="modal-dialog full-modal">
	    <div class="modal-content">
	        <div class="modal-header-2">
		        <h5 class="modal-title" id="requestamendmentclientlistLabel">Request Amendment List</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        </div>
	        <div class="modal-body font-14">
				<div class="row mbot15">
					
					<div class="col-md-3">
						<?= _l('Client'); ?><span class="text-danger" id="cloclient-requestamendment"></span>
					</div>
				</div>
				<div class="table-responsive mt-2">
					<table class="table table-custom" data-order-col="0" data-order-type="asc" id='requestamendmentclientdata_list' style="width:100%">
						<thead>
							<th width="10%" class="th-ticket-number">#SNo.</th>
                            <th class="th-ticket-subject">Client Name</th>
							<th class="th-ticket-subject">Request For</th>
							<th class="th-ticket-subject">Title</th>
							<th class="th-ticket-subject">Date</th>
                            <th class="th-ticket-subject">Description</th>
							<th class="th-ticket-subject">Status</th>
							
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
	        </div>
        </div>
    </div>
</div> 
<!--// -->

<script>

/* Get CLO Clients */
function getAllCloClientsRequestAmendment()
{
	$.ajax({
		url: '<?=base_url()?>clients/getAllClientsRequestAmendment',
		type: 'get',
		dataType: 'html',
		success: function(response){
           
            $('#cloclient-requestamendment').html(response);
            
		}
	});
}

//$(document).ready(function(){
function getclientrequestamendment() {
   	var client_id= $('#cloclientrequestammendment').val();
	if(client_id!=''){
		console.log($('#cloclientrequestammendment').val());
		var table = $('#requestamendmentclientdata_list').DataTable(); 
		table.destroy();
		requestamendmentclientdata_table = $('#requestamendmentclientdata_list').DataTable({ 
			"processing": true, //Feature control the processing indicator.
			"serverSide": false, //Feature control DataTables' servermside processing mode.
			"order": [[0,'desc']], //Initial no order.
			"ordering": true,
			"searching": true,
			"ajax": {
				"url": "<?php echo base_url('clients/loadRequestAmendmentClientData')?>?client_id="+client_id,
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
			dom: 'lBfrtip',
			buttons: [
				{
					extend: 'excel',
					filename: 'Request Amendment Report',
					title: 'Request Amendment Report'
				},
				{
					extend: 'csv',
					filename: 'Request Amendment Report',
					title: 'Request Amendment Report',

				},
				{
					extend: 'pdf',
					filename: 'Request Amendment Report',
					title: 'Request Amendment Report'

				},
				
			],
		});
	}
	else{
		var table = $('#requestamendmentclientdata_list').DataTable(); 
		table.destroy();
		$('#requestamendmentclientdata_list tbody').html('');
	}
	
}
//	});
</script>