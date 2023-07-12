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
										<option value="">All</option>
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
                                    <span class="text-danger" id="cloclient-serviceagreement"></span>
                                    <!-- <select class="form-control selectpicker" data-live-search="true" onChange="filterByClient(this.value)" id="cloclient-serviceagreement">
										<option value=""></option>
                                    </select> -->
                                </div>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        <?php render_datatable(array(
    							_l('#SNo.'),
    							_l('Client'),
    							_l('My Care Plan'),
    							_l('Start Date'),
    							_l('End Date'),
    							_l('Status'),
    							_l('Action')
							),'ndis_supplementaryserviceagreementcloclientdata_list'); 
						?>
                        <!--
                        <div class="table-responsive mt-2">
                            <table class="table table-custom" data-order-col="0" data-order-type="asc" id='serviceagreementcloclientdata_list' style="width:100%">
                                <thead>
                                    <tr>
                                    <th width="10%" class="th-ticket-number">#SNo.</th>
                                    <th class="th-ticket-subject">Client Name</th>
                                    <th class="th-ticket-subject">My Care Plan</th>
                                    <th class="th-ticket-subject">Start Date</th>
                                    <th class="th-ticket-subject">End Date</th>
                                    <th class="th-ticket-subject">Status</th>
                                    <th class="th-ticket-subject">Lock/Unlock</th>
                                        </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div> -->
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
		initDataTable('.table-ndis_supplementaryserviceagreementcloclientdata_list', '<?= admin_url() ?>reports/loadNdisSupplementaryServiceAgreementClientsData?client_id='+client_id+'&clo_id='+clo_id,[1],[1]);//'+clo_id+'/'+client_id, [1], [1])
    /* Filter By Client */
    function filterByClo(cid)
    {
        if(cid == '')
        {
            getcloclientserviceagreementreport(0, 0);
            $('#cloclient-serviceagreement').html('');
        }

        $.ajax({
            url: '<?=base_url()?>admin/clients/getAllCloClients?cid='+cid,
            type: 'get',
            dataType: 'html',
            success: function(response){
            
                $('#cloclient-serviceagreement').html(response);
                
            }
        });
    }

    /* Filter By Client */
    function getcloclientserviceagreementreport(client_id,clo_id) 
    {
        
        var table = $('.table-ndis_supplementaryserviceagreementcloclientdata_list').DataTable(); 
        table.destroy();
        var tAPI = initDataTable('.table-ndis_supplementaryserviceagreementcloclientdata_list', '<?= admin_url() ?>reports/loadNdisSupplementaryServiceAgreementClientsData?client_id='+client_id+'&clo_id='+clo_id,[1],[1]);
        tAPI.ajax.reload();
        
        /*
        $('#serviceagreementcloclientdata_list tbody').html('');
        if(client_id!=''){
            console.log($('#cloclient-serviceagreementreport').val());
            var table = $('#serviceagreementcloclientdata_list').DataTable(); 
            table.destroy();
            serviceagreementclientdata_table = $('#serviceagreementcloclientdata_list').DataTable({ 
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' servermside processing mode.
                "order": [], //Initial no order.
                "ordering": false,
                "searching": false,
                "ajax": {
                    "url": "<?php echo base_url('admin/reports/loadServiceAgreementClientsData')?>?client_id="+client_id+"&clo_id="+clo_id,
                    "type": "POST",
                    "dataType": "json",
                    "data":{},
                    "data": function ( data ) {
                    data.filter_by = {};
                    },
                    "dataSrc": function (jsonData) {
                        var table = $('#serviceagreementcloclientdata_list').DataTable(); 
                        table.destroy();
                        return jsonData.data;
                        // if(jsonData.data.length>0){
                        //     return jsonData.data;
                        // }else{
                        //     var table = $('#serviceagreementcloclientdata_list').DataTable(); 
                        //     table.destroy();
                        //     // $('#serviceagreementcloclientdata_list').DataTable( {
                        //     //     "language": {
                        //     //     "emptyTable": "No data available in table"
                        //     //     }
                        //     // });
                        //     var html = "<tr><td colspan='7' class='dataTables_empty'>No data available in table</td></tr>"
                        //     $('#serviceagreementcloclientdata_list tbody').html(html);
                        // }
                      

                    }
                },
               
            });
        }
        else{
            var table = $('#serviceagreementcloclientdata_list').DataTable(); 
            table.destroy();
            $('#serviceagreementcloclientdata_list tbody').html('');
        }
        */

    }

    function loginClientForReport(data) {
        // Remove saved data from sessionStorage
        console.log(data);
        var obj = JSON.stringify(data);

        console.log(obj);

        sessionStorage.removeItem("auth");
        sessionStorage.setItem('auth', obj);
        var base_url = window.location.origin;
        window.open(base_url+'/client/my-service-agreements/ndis-supplementary-service-agreement/'+data.token, '_blank');
    }

	</script>
</body>
</html>
