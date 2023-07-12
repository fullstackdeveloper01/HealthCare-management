<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
					    <!--
						<div class="_buttons">
							<a href="<?php echo admin_url('leaveRequest/add'); ?>" class="btn btn-info pull-left display-block"><?php echo _l('new '.$sh_text); ?></a>
						</div>
						-->
						<h4 class="customer-profile-group-heading"><?= _l($title); ?></h4>
						<hr class="hr-panel-heading" />
						<?php render_datatable(array(
							_l('Id'),
							_l('Staff'),
							_l('Leave Type'),
							_l('From Date'),
							_l('To Date'),
							_l('Status'),
							_l('options')
							),'leaveRequest'); 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
	<script>
		initDataTable('.table-leaveRequest', window.location.href, [1], [1]);
	</script>
</body>
</html>
