<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel_s">
    				<div class="panel-body">
    				    <div class="_buttons">
                            <a href="<?php echo admin_url('utilities/calendar'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('Calender'); ?>
                            </a>
                        </div>
                        <div class="clearfix"></div>
    				    <hr class="hr-panel-heading" />
						<?php render_datatable(array(
							_l('Agent'),
							_l('Property'),
							_l('Applicant'),
							_l('Email'),
							_l('Appointment date'),
							_l('Time'),
							_l('Created date')
				// 			_l('options')
							),'bookAppointment'); 
						?>
    				</div>
    			</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
	<script>
		initDataTable('.table-bookAppointment', window.location.href, [1], [1]);
	</script>
</body>
</html>
