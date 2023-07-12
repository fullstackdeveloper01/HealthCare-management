
<!-- Client Modal -->
<div class="modal fade" id="serviceagreementclientlistmodel" tabindex="-1" aria-labelledby="serviceagreementclientlistLabel" aria-hidden="true" style="display: none;">
  	<div class="modal-dialog full-modal">
	    <div class="modal-content">
	        <div class="modal-header-2">
		        <h5 class="modal-title" id="serviceagreementclientlistLabel">Service Agreement List</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        </div>
	        <div class="modal-body font-14">
				<div class="row mbot15">
					
					<div class="col-md-3">
						<?= _l('Client'); ?><span class="text-danger" id="cloclientserviceagreement"></span>
					</div>
				</div>
				<div class="table-responsive mt-2">
					<table class="table table-custom" data-order-col="0" data-order-type="asc" id='serviceagreementclientdata_list' style="width:100%">
						<thead>
							<th width="10%" class="th-ticket-number">#SNo.</th>
                            <th class="th-ticket-subject">Client Name</th>
							<th class="th-ticket-subject">My Care Plan</th>
							<th class="th-ticket-subject">Start Date</th>
							<th class="th-ticket-subject">End Date</th>
							<th class="th-ticket-subject">Status</th>
							<th class="th-ticket-subject">Lock/Unlock</th>
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
function getAllCloClientsService()
{
	$.ajax({
		url: '<?=base_url()?>clients/getAllClientsService',
		type: 'get',
		dataType: 'html',
		success: function(response){
           
            $('#cloclientserviceagreement').html(response);
            
		}
	});
}


//$(document).ready(function(){
function getclientserviceagreement() {
   	var client_id= $('#cloclientservice').val();
	 
	if(client_id!=''){
		console.log($('#cloclientservice').val());
		var table = $('#serviceagreementclientdata_list').DataTable(); 
		table.destroy();
		serviceagreementclientdata_table = $('#serviceagreementclientdata_list').DataTable({ 
			"processing": false, //Feature control the processing indicator.
			"serverSide": false, //Feature control DataTables' servermside processing mode.
			"order": [[0,'desc']], //Initial no order.
			"ordering": true,
			"searching": true,
			"ajax": {
				"url": "<?php echo base_url('clients/loadServiceAgreementClientsData')?>?client_id="+client_id,
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
					filename: 'Service Agreement Report',
					title: 'Service Agreement Report'
				},
				{
					extend: 'csv',
					filename: 'Service Agreement Report',
					title: 'Service Agreement Report',

				},
				{
					extend: 'pdf',
					filename: 'Service Agreement Report',
					title: 'Service Agreement Report'

				},
				
			],
		});
	}
	else{
		var table = $('#serviceagreementclientdata_list').DataTable(); 
		table.destroy();
		$('#serviceagreementclientdata_list tbody').html('');
	}
	
}
//	});
</script>