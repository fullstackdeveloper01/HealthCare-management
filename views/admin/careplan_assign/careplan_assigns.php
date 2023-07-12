<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
					    <div class="no-margin">
    					    <a href="<?php echo admin_url('careplan_assign/add'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('new '.$title); ?>
                            </a>
                        </div>
						<h4>&nbsp;</h4>
						<?php ?>
                        <hr class="hr-panel-heading" />
						<?php render_datatable(array(
    							_l('#'),
    							_l('Client'),
    							_l('Plan Title'),
                                _l('Plan Officer'),
    							_l('Plan file'),
    							_l('Date'),
    							_l('options')
							),'careplan_assign'); 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
	<script>
		initDataTable('.table-careplan_assign', window.location.href, [1], [1]);
	</script>
</body>
</html>
