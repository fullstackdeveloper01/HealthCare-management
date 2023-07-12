<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
						<div class="no-margin">
                            <div class="row">
                                <div class="col-md-3">
									<?= _l('Search By Clo Name'); ?>
                                    <select class="form-control selectpicker" data-live-search="true" onChange="filterByClo(this.value)" id="closervice">
										<option value=""></option>
                                        <?php
											if($clo_list)
											{
												foreach($clo_list as $res)
												{
													?>
														<option value="<?= $res->userid; ?>"><?= $res->firstname." ".$res->lastname; ?></option>
													<?php
												}
											}
										?>
                                    </select>
                                </div>
                                <div class="col-md-3">
									<?= _l('Search By Client Name'); ?>
                                    <span class="text-danger" id="cloclient-appointment"></span>
                                    <!-- <select class="form-control selectpicker" data-live-search="true" onChange="filterByClient(this.value)" id="cloclient-serviceagreement">
										<option value=""></option>
                                    </select> -->
                                </div>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        <?php render_datatable(array(
    							_l('#SNo.'),
    							//_l('Client Name'),
    							_l('Title'),
                                _l('Service Name'),
    							_l('Start Date / Start Time'),
    							_l('End Date / End Time'),
    							_l('Frequency'),
    							_l('Description')
							),'appointmentcloclientdata_list'); 
						?>
                        <!--
                        <div class="table-responsive mt-2">
                            <table class="table table-custom" data-order-col="0" data-order-type="asc" id='appointmentcloclientdata_list' style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="10%" class="th-ticket-number">#SNo.</th>
                                        <th class="th-ticket-subject">Client Name</th>
                                        <th class="th-ticket-subject">Title</th>
                                        <th class="th-ticket-subject">Service Name</th>
                                        <th class="th-ticket-subject">Start Date/Start Time</th>
                                        <th class="th-ticket-subject">End Date / End Time</th>
                                        <th class="th-ticket-subject">Frequency</th>
                                        <th class="th-ticket-subject">Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
<script>
		 var client_id = 0;
        var clo_id = '';
		initDataTable('.table-appointmentcloclientdata_list', '<?= admin_url() ?>clients/loadAppointmentsData?client_id='+client_id+'&clo_id='+clo_id,[1],[1]);
        /* Filter By Client */
    function filterByClo(cid)
    {
        $.ajax({
            url: '<?=base_url()?>admin/clients/getAllCloClientsAppointment?cid='+cid,
            type: 'get',
            dataType: 'html',
            success: function(response){
            
                $('#cloclient-appointment').html(response);
                
            }
        });
    }

    /* Filter By Client */
    function getcloclientappointmentreport(client_id,clo_id) 
    { 
        var table = $('.table-appointmentcloclientdata_list').DataTable(); 
        table.destroy();
        var tAPI = initDataTable('.table-appointmentcloclientdata_list', '<?= admin_url() ?>clients/loadAppointmentsData?client_id='+client_id+'&clo_id='+clo_id,[1],[1]);
        tAPI.ajax.reload();
        /*
        $('#appointmentcloclientdata_list tbody').html('');
        if(client_id!=''){
            //console.log($('#cloclient-serviceagreementreport').val());
            var table = $('#appointmentcloclientdata_list').DataTable(); 
            table.destroy();
            serviceagreementclientdata_table = $('#appointmentcloclientdata_list').DataTable({ 
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' servermside processing mode.
                "order": [], //Initial no order.
                "ordering": false,
                "searching": false,
                "ajax": {
                    "url": "<?php echo base_url('admin/clients/loadAppointmentsData')?>?client_id="+client_id+"&clo_id="+clo_id,
                    "type": "POST",
                    "dataType": "json",
                    "data":{},
                    "data": function ( data ) {
                    data.filter_by = {};
                    },
                    "dataSrc": function (jsonData) {
                        var table = $('#appointmentcloclientdata_list').DataTable(); 
                        table.destroy();
                        return jsonData.data;
                       
                    }
                },
               
            });
        }
        else{
            var table = $('#appointmentcloclientdata_list').DataTable(); 
            table.destroy();
            $('#appointmentcloclientdata_list tbody').html('');
        }
        */
    }

	</script>
</body>
</html>
