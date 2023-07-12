<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel_s">
    				<div class="panel-body">
    				    <div class="_buttons">
                        <a href="<?php echo admin_url('properties/property'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('Add '.$title); ?>
                            </a>
                        </div>
                        <div class="clearfix"></div>
    				    <hr class="hr-panel-heading" />
						<?php render_datatable(array(
							_l('Image'),
							_l('Title'),
							_l('Agent'),
							_l('Price'),
							_l('Posted date'),
							_l('Active date'),
							_l('options')
							),'properties'); 
						?>
    				</div>
    			</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
	<script>
		initDataTable('.table-properties', window.location.href, [1], [1]);
	</script>
</body>
</html>
