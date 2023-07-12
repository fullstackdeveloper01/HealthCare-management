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
                                <div class="col-md-6">
									<a href="<?php echo admin_url('invoice/add'); ?>" class="btn btn-info mright5 test pull-left display-block">
										<?php echo _l('new '.$title); ?>
									</a>
                                </div>
								<div class="col-md-3">
									<?= _l('Search By Day/Week/Month Wise'); ?>
                                    <select id="iday" class="form-control selectpicker" data-live-search="true" onChange="filterByDayWise(this.value)">
										<option value=""></option>
										<option value="day">1 Day</option>
										<option value="week">1 Week</option>
										<option value="month">1 Month</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
									<?= _l('Search By Client Name'); ?>
                                    <select id="iclient" class="form-control selectpicker" data-live-search="true" onChange="filterByClient(this.value)">
										<option value=""></option>
										<?php
											if($client_list)
											{
												foreach($client_list as $res)
												{
													?>
														<option value="<?= $res->userid; ?>"><?= $res->firstname." ".$res->lastname; ?></option>
														<!-- <option value="<?= $res->userid; ?>"><?= $res->full_name; ?></option> -->
													<?php
												}
											}
										?>
                                    </select>
                                </div>
                            </div>
                        </div>
						<?php /* ?>
						<hr class="hr-panel-heading" />
						<div class="row mbot15">
						    <?php
						        $where_summary = '';
						    ?>
                            <div class="col-md-12">
                                <h4 class="no-margin"><?php echo _l($title.' Summary'); ?></h4>
                            </div>
                            <div class="col-md-4 col-xs-6 border-right">
                                <h3 class="bold"><?php echo $this->db->get_where(db_prefix().'contacts', array('role' => 1))->num_rows(); ?></h3>
                                <span class="text-dark"><?php echo _l($title.' Summary total'); ?></span>
                            </div>
                            <div class="col-md-4 col-xs-6 border-right">
                                <h3 class="bold"><?php echo $this->db->get_where(db_prefix().'contacts', array('role' => 1, 'active' => 1))->num_rows(); ?></h3>
                                <span class="text-success"><?php echo _l('Active '.$title); ?></span>
                            </div>
                            <div class="col-md-4 col-xs-6 border-right">
                                <h3 class="bold"><?php echo $this->db->get_where(db_prefix().'contacts', array('role' => 1, 'active' => 0))->num_rows(); ?></h3>
                                <span class="text-danger"><?php echo _l('Inactive Active '.$title); ?></span>
                            </div>
                        </div>
                        <?php */ ?>
                        <hr class="hr-panel-heading" />
						<?php render_datatable(array(
    							_l('Added By'),
                                _l('Client Name'),
    							_l('Title'),
    							_l('Invoice Number'),
    							_l('Date'),
    							_l('Total Amount'),
    							_l('Invoice'),
                                _l('Status'),
    							_l('options')
							),'invoice'); 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
	<script>
		initDataTable('.table-invoice', window.location.href, [1], [1],'',[0,'DESC']);

		/* Filter By Client */
		function filterByClient(cid)
		{
			var obj= $('#iday').val();
			var table = $('.table-invoice').DataTable(); 
            table.destroy();
            var tAPI = initDataTable('.table-invoice', '<?= admin_url() ?>invoice/filterByClient?client_id='+cid+'&filter='+obj, [1], [1]);  
            tAPI.ajax.reload();
		}

		function filterByDayWise(obj)
		{
			var cid= $('#iclient').val();
			
			var table = $('.table-invoice').DataTable(); 
            table.destroy();
            var tAPI = initDataTable('.table-invoice', '<?= admin_url() ?>invoice/filterByClient?client_id='+cid+'&filter='+obj, [1], [1]); 
            tAPI.ajax.reload();
		}
	</script>
</body>
</html>
