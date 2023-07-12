<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
						<h4 class="customer-profile-group-heading">
						    <a href="<?php echo admin_url('documents/add'); ?>" class="btn btn-info pull-right"><?php echo _l('Add Document'); ?></a>
						    <?= _l($title); ?>
						</h4>
						<hr class="hr-panel-heading" />
						<?php render_datatable(array(
							_l('Title'),
							_l('File Name'),
							_l('Upload Date'),
							_l('Type'),
							_l('options')
							),'documents'); 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
	<script>
		initDataTable('.table-documents', window.location.href, [1], [1]);
	</script>
</body>
</html>
