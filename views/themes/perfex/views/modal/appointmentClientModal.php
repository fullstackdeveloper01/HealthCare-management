
<!-- Client Modal -->
<div class="modal fade" id="appointmentclientlistmodel" tabindex="-1" aria-labelledby="appointmentclientlistLabel" aria-hidden="true" style="display: none;">
  	<div class="modal-dialog full-modal">
	    <div class="modal-content">
	        <div class="modal-header-2">
		        <h5 class="modal-title" id="appointmentclientlistLabel">Appointment List</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        </div>
	        <div class="modal-body font-14">
				<div class="row mbot15">
					
					<div class="col-md-3">
						<?= _l('Client'); ?><span class="text-danger" id="cloclient-appointment"></span>
					</div>
				</div>
				<div class="table-responsive mt-2">
					<table class="table table-custom" data-order-col="0" data-order-type="asc" id='appointmentclientdata_list' style="width:100%">
						<thead>
							<th width="10%" class="th-ticket-number">#SNo.</th>
                            <th class="th-ticket-subject">Client Name</th>
							<th class="th-ticket-subject">Title</th>
							<th class="th-ticket-subject">Service Name</th>
							<th class="th-ticket-subject">Start Date/Start Time</th>
							<th class="th-ticket-subject">End Date / End Time</th>
							<th class="th-ticket-subject">Frequency</th>
                            <th class="th-ticket-subject">Description</th>
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
function getAllCloClientsAppointment()
{
	$.ajax({
		url: '<?=base_url()?>clients/getAllClientsAppointment',
		type: 'get',
		dataType: 'html',
		success: function(response){
           
            $('#cloclient-appointment').html(response);
            
		}
	});
}
//$(document).ready(function(){
function getclientappointment() {
   	var client_id= $('#cloclientappointment').val();
	if(client_id!=''){
		console.log($('#cloclientappointment').val());
		var table = $('#appointmentclientdata_list').DataTable(); 
		table.destroy();
		appointmentclientdata_table = $('#appointmentclientdata_list').DataTable({ 
			"processing": true, //Feature control the processing indicator.
			"serverSide": false, //Feature control DataTables' servermside processing mode.
			"order": [[0,'desc']], //Initial no order.
			"ordering": true,
			"searching": true,
			"ajax": {
				"url": "<?php echo base_url('clients/loadAppointmentsData')?>?client_id="+client_id,
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
					filename: 'Appointment Report',
					title: 'Appointment Report'
				},
				{
					extend: 'csv',
					filename: 'Appointment Report',
					title: 'Appointment Report',

				},
				{
					extend: 'pdf',
					filename: 'Appointment Report',
					title: 'Appointment Report'

				},
				
			],
		});
	}
	else{
		var table = $('#appointmentclientdata_list').DataTable(); 
		table.destroy();
		$('#appointmentclientdata_list tbody').html('');
	}
	
}
//	});
</script>