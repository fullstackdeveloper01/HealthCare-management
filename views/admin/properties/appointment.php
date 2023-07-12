<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
		    <?= $this->load->view('admin/properties/sidebar');?>
			<div class="col-md-9">
				<div class="panel_s">
    				<div class="panel-body">
    				    <h4 class="customer-profile-group-heading"><?= _l('Appointment List'); ?></h4>
    				    <hr class="hr-panel-heading" />
						<?php render_datatable(array(
							_l('Name'),
							_l('Email'),
							_l('Appointment Date'),
							_l('Appointment Time')
						//	_l('options')
							),'appointment'); 
						?>
    				</div>
    			</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
	<script>
		initDataTable('.table-appointment', window.location.href, [1], [1]);
	</script>
</body>
</html>