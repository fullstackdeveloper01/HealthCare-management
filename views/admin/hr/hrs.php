<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
					    <div class="no-margin">
    					    <a href="<?php echo admin_url('hr/add'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('new '.$title); ?>
                            </a>
                        </div>
						<div class="col-md-3 pull-right">
							<select class="form-control" id="report_type_hr" onChange="hrFilter()">
								<option value="0" selected>Filter By Report Type</option>
								<option value="day">Today</option>
								<option value="week">Weekly</option>
								<option value="month">Monthly</option>
								<option value="year">Yearly</option>
							</select>
						</div>
						<div class="col-md-3 pull-right">
							<select class="form-control" id="hr_status" onChange="hrFilter()">
								<option value="">Filter By Status</option>
								<option value="1">Active</option>
								<option value="0">Inactive</option>
							</select>
						</div>
						<h4>&nbsp;</h4>
						<hr class="hr-panel-heading" />
						<div class="row mbot15">
						    <?php
						        $where_summary = '';
						    ?>
                            <div class="col-md-12">
                                <h4 class="no-margin"><?php echo _l($title.' Summary'); ?></h4>
                            </div>
                            <div class="col-md-4 col-xs-6 border-right">
                                <h3 class="bold"><?php echo $this->db->get_where(db_prefix().'contacts', array('role' => 4))->num_rows(); ?></h3>
                                <span class="text-dark"><?php echo _l($title.' Summary total'); ?></span>
                            </div>
                            <div class="col-md-4 col-xs-6 border-right">
                                <h3 class="bold" id="hr_status_active"><?php echo $this->db->get_where(db_prefix().'contacts', array('role' => 4, 'active' => 1))->num_rows(); ?></h3>
                                <span class="text-success"><?php echo _l('Active '.$title); ?></span>
                            </div>
                            <div class="col-md-4 col-xs-6 border-right">
                                <h3 class="bold" id="hr_status_inactive"><?php echo $this->db->get_where(db_prefix().'contacts', array('role' => 4, 'active' => 0))->num_rows(); ?></h3>
                                <span class="text-danger"><?php echo _l('Inactive Active '.$title); ?></span>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
						<?php render_datatable(array(
    							_l('Name'),
    							_l('Email'),
    							_l('Mobile'),
    							_l('Date of birth'),
    							_l('Date of joining'),
    							_l('Address'),
    							_l('Department'),
    							_l('Status'),
    							_l('options')
							),'hr'); 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
	<script>
		initDataTable('.table-hr', window.location.href, [1], [1],'',[0,'desc']);

		
    /* Filter */
    function hrFilter()
   {
      var report_type = $('#report_type_hr option:selected').val();
      var hr_status = $('#hr_status option:selected').val();

      var table = $('.table-hr').DataTable(); 
      table.destroy();
      var tAPI = initDataTable('.table-hr', '<?= admin_url() ?>hr/filter?report_type='+report_type+"&hr_status="+hr_status, [1], [1]); 
      tAPI.ajax.reload();

     
   }

   function changeStatus(obj,id){
		var total_inactive = $('#hr_status_inactive').text();
		var total_active = $('#hr_status_active').text();
		if(obj==1){
			total_inactive = parseInt(total_inactive)+1;
			total_active = parseInt(total_active)-1;
			$('#'+id).val('0');
			
		}else{
			total_inactive = parseInt(total_inactive)-1;
			total_active = parseInt(total_active)+1;
			$('#'+id).val('1');
		}

		$('#hr_status_inactive').text(total_inactive);
		$('#hr_status_active').text(total_active);
	}
	</script>
</body>
</html>
