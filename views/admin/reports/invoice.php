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
                                    <span class="text-danger" id="cloclient-invoice"></span>
                                </div>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        <?php render_datatable(array(
    							_l('#SNo.'),
    							//_l('Client Name'),
    							_l('Title'),
    							_l('Invoice Number'),
    							_l('Date'),
                                _l('Total Amount'),
                                _l('Invoice'),
    							_l('Status'),
							),'invoice_report'); 
						?>
                        
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
		initDataTable('.table-invoice_report', '<?= admin_url() ?>clients/loadInvoiceClientData?client_id='+client_id+'&clo_id='+clo_id,[1],[1]);
       
    /* Filter By Client */
    function filterByClo(cid)
    {
        $.ajax({
            url: '<?=base_url()?>admin/clients/getAllCloClientsInvoice?cid='+cid,
            type: 'get',
            dataType: 'html',
            success: function(response){
            
                $('#cloclient-invoice').html(response);
                
            }
        });
    }

    /* Filter By Client */
    function getcloclientinvoicereport(client_id,clo_id) 
    {
        var table = $('.table-invoice_report').DataTable(); 
        table.destroy();
        var tAPI = initDataTable('.table-invoice_report', '<?= admin_url() ?>clients/loadInvoiceClientData?client_id='+client_id+'&clo_id='+clo_id,[1],[1]);
        tAPI.ajax.reload();

    }

	</script>
</body>
</html>
