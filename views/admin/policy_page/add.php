<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel_s">
				    <?= form_open_multipart(admin_url('policyPage/add/'), array('id' => 'import_form'));  ?>
						 
    					<div class="panel-body">
    					   <div class="form-group">
    					       <?= _l('Select Position'); ?> 
							   <select name="position" class="form-control" require> 
									<option selected value="1">Our Information Handling Practices</option>
									<option value="2">Quality and Security of Personal Information</option>
									<option value="3">Our Files and You</option>
									<option value="4">Access and Correction</option>
									<option value="5">Complaints</option>
									<option value="6">Direct Marketing</option>
									<option value="7">Online/Electronic Communications</option>
									<option value="8">Amendments to Policy</option> 
							   </select> 
    					   </div>
    					   <div class="form-group">
    					       <?= _l('Title'); ?>
    					       <input type="text" name="title"  value="" required class="form-control">
    					   </div>
    					   
    					   <div class="form-group">
    					       <?= _l('Description'); ?>
							   <textarea class="form-control" name="content" required></textarea>
     					   </div> 
                           <div class="form-group">
    					       <?= _l('Other Content'); ?>
							   <textarea class="form-control" name="other_content" ></textarea>
     					   </div>
    					   <div class="form-group">
    					       <button type="submit" class="btn btn-info">Save</button> 
    					   </div>
    					</div>
    				</form>
    			</div>
			</div>
		 
		</div>
	</div>
</div>
<?php init_tail(); ?>
	<script>
		initDataTable('.table-slider', window.location.href, [1], [1]);
		var sid = '<?= $article->id ?>';
		$(function(){
		    if(sid)
                appValidateForm($('#import_form'),{slider:{extension: "png,jpg,jpeg,gif"}});
            else
                appValidateForm($('#import_form'),{slider:{required:true,extension: "png,jpg,jpeg,gif"}});
        });     

	</script>
</body>
</html>
