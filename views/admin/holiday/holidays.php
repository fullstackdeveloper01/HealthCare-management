<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-4">
				<div class="panel_s">
				    <?= form_open_multipart(admin_url('holiday/add'), array('id' => 'holiday'));  ?>
    					<div class="panel-body">
    					   <div class="form-group">
    					       <?= _l('Title'); ?><span class="text-danger">*</span>
    					       <input type="text" required class="form-control" name="title" >
    					   </div>
    					   <div class="form-group">
    					       <?= _l('From Date'); ?><span class="text-danger">*</span>
    					       <input type="text" required class="form-control" autocomplete="off" name="from_date" id="from_date">
    					   </div>
    					   <div class="form-group">
    					       <?= _l('To Date'); ?><span class="text-danger">*</span>
    					       <input type="text" required class="form-control" autocomplete="off" name="to_date" id="to_date">
    					   </div><hr>
    					   <div class="form-group">
    					       <button type="submit" class="btn btn-success">Save</button>
    					   </div>
    					</div>
    				</form>
    			</div>
			</div>
			<div class="col-md-8">
				<div class="panel_s">
					<div class="panel-body">
						<h4 class="customer-profile-group-heading"><?= _l($title); ?></h4>
						<hr class="hr-panel-heading" />
						<?php render_datatable(array(
							_l('Title'),
							_l('From Date'),
							_l('To Date'),
							_l('options')
							),'holiday'); 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
	<script>
		initDataTable('.table-holiday', window.location.href, [1], [1]);
		
		$(document).ready(function(){
            $("#from_date").datepicker({
                minDate:0,
                dateFormat: 'yy-mm-dd',
                onSelect: function(selected) {
                  $("#to_date").datepicker("option","minDate", selected)
                }
            });
            $("#to_date").datepicker({ 
                minDate:0,
                dateFormat: 'yy-mm-dd',
                onSelect: function(selected) {
                   $("#from_date").datepicker("option","maxDate", selected)
                }
            });  
            
            appValidateForm($('#holiday'),{title:'required',from_date:'required',to_date:'required'});
        });
	</script>
</body>
</html>
