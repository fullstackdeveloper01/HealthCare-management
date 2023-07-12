
<!-- Client Modal -->
<div class="modal fade" id="invoiceclientlistmodel" tabindex="-1" aria-labelledby="invoiceclientlistLabel" aria-hidden="true" style="display: none;">
  	<div class="modal-dialog full-modal">
	    <div class="modal-content">
	        <div class="modal-header-2">
		        <h5 class="modal-title" id="invoiceclientlistLabel">Invoice List</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        </div>
	        <div class="modal-body font-14">
				<div class="row mbot15">
					
					<div class="col-md-3">
						<?= _l('Client'); ?><span class="text-danger" id="cloclient-invoice"></span>
					</div>
				</div>
				<div class="table-responsive mt-2">
					<table class="table table-custom" data-order-col="0" data-order-type="asc" id='invoiceclientdata_list' style="width:100%">
						<thead>
							<th width="10%" class="th-ticket-number">#SNo.</th>
                            <th class="th-ticket-subject">Client Name</th>
							<th class="th-ticket-subject">Title</th>
							<th class="th-ticket-subject">Invoice Number</th>
							<th class="th-ticket-subject">Date</th>
							<th class="th-ticket-subject">Total Amount</th>
							<th class="th-ticket-subject">Invoice</th>
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
function getAllCloClientsInvoice()
{
	$.ajax({
		url: '<?=base_url()?>clients/getAllClientsInvoice',
		type: 'get',
		dataType: 'html',
		success: function(response){
           
            $('#cloclient-invoice').html(response);
            
		}
	});
}

//$(document).ready(function(){
function getclientinvoice() {
   	var client_id= $('#cloclientinvoice').val();
	if(client_id!=''){
		console.log($('#cloclientinvoice').val());
		var table = $('#invoiceclientdata_list').DataTable(); 
		table.destroy();
		invoiceclientdata_table = $('#invoiceclientdata_list').DataTable({ 
			"processing": true, //Feature control the processing indicator.
			"serverSide": false, //Feature control DataTables' servermside processing mode.
			"order": [[0,'desc']], //Initial no order.
			"ordering": true,
			"searching": true,
			"ajax": {
				"url": "<?php echo base_url('clients/loadInvoicesData')?>?client_id="+client_id,
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
					filename: 'Invoice Report',
					title: 'Invoice Report'
				},
				{
					extend: 'csv',
					filename: 'Invoice Report',
					title: 'Invoice Report'

				},
				{
					extend: 'pdf',
					filename: 'Invoice Report',
					title: 'Invoice Report'

				},
				
			],
		});
	}
	else{
		var table = $('#invoiceclientdata_list').DataTable(); 
		table.destroy();
		$('#invoiceclientdata_list tbody').html('');
	}
	
}
//	});
</script>