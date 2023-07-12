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
							<a href="<?php echo admin_url('anniversary/add'); ?>" class="btn btn-info pull-left display-block"><?php echo _l('new '.$sh_text); ?></a>
						</div>
						-->
						<h4 class="customer-profile-group-heading"><?= _l($title); ?></h4>
						<hr class="hr-panel-heading" />
						<?php render_datatable(array(
							_l('Id'),
							_l('Staff Name'),
							_l('Email'),
							_l('Mobile'),
							_l('Department'),
							_l('Designation'),
							_l('Date')
							),'anniversary'); 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
	<script>
		initDataTable('.table-anniversary', window.location.href, [1], [1]);
	</script>
</body>
</html>
