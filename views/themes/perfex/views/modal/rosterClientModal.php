
<!-- Client Modal -->
<div class="modal fade" id="rosterclientlistmodel" tabindex="-1" aria-labelledby="rosterclientlistLabel" aria-hidden="true" style="display: none;">
  	<div class="modal-dialog full-modal">
	    <div class="modal-content">
	        <div class="modal-header-2">
		        <h5 class="modal-title" id="rosterclientlistLabel">Roster List</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        </div>
	        <div class="modal-body font-14">
				<div class="row mbot15">
					
					<div class="col-md-3">
						<?= _l('Client'); ?><span class="text-danger" id="cloclient"></span>
					</div>
				</div>
				<div class="table-responsive mt-2">
					<table class="table table-custom" data-order-col="0" data-order-type="asc" id='rosterclientdata_list' style="width:100%">
						<thead>
							<th width="10%" class="th-ticket-number">#SNo.</th>
							<th class="th-ticket-subject">Staff Name</th>
							<th class="th-ticket-subject">Start Date</th>
							<th class="th-ticket-subject">End Date</th>
							<th class="th-ticket-subject">Start Time</th>
							<th class="th-ticket-subject">End Time</th>
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
function getAllCloClients()
{
	$.ajax({
		url: '<?=base_url()?>clients/getAllClients',
		type: 'get',
		dataType: 'html',
		success: function(response){
           
            $('#cloclient').html(response);
            
		}
	});
}

function getclientroster() {
   	var client_id= $('#cloclientroster').val();
	if(client_id!=''){
		console.log($('#cloclientroster').val());
		var table = $('#rosterclientdata_list').DataTable(); 
		table.destroy();
		rosterclientdata_tabel = $('#rosterclientdata_list').DataTable({ 
			"processing": true, //Feature control the processing indicator.
			"serverSide": false, //Feature control DataTables' servermside processing mode.
			"order": [[0,'desc']], //Initial no order.
			"ordering": true,
			"searching": true,
			"ajax": {
				"url": "<?php echo base_url('clients/loadRostersData')?>?client_id="+client_id,
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
					filename: 'Roster Report',
					title: 'Roster Report'
				},
				{
					extend: 'csv',
					filename: 'Roster Report',
					title: 'Roster Report',

				},
				{
					extend: 'pdf',
					filename: 'Roster Report',
					title: 'Roster Report'

				},
				
			],
		});
	}
	else{
		var table = $('#rosterclientdata_list').DataTable(); 
		table.destroy();
		$('#rosterclientdata_list tbody').html('');
	}
	
}
</script>