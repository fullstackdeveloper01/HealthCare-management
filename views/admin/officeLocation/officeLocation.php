<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-4">
				<div class="panel_s">
				    <?= form_open(admin_url('officeLocation/add/'.$article->id));  ?>
    					<div class="panel-body">
    					   <div class="form-group">
    					       <?= _l('Name'); ?>
    					       <input type="text" required autocomplete="off" class="form-control" value="<?= $article->name; ?>" name="name" required>
    					   </div>
    					   <div class="form-group">
    					       <button type="submit" class="btn btn-success">Update</button>
    					   </div>
    					</div>
    				</form>
    			</div>
			</div>
			<div class="col-md-8">
				<div class="panel_s">
					<div class="panel-body">
					    <!--
						<div class="_buttons">
							<a href="<?php echo admin_url('officeLocation/add'); ?>" class="btn btn-info pull-left display-block"><?php echo _l('new '.$sh_text); ?></a>
						</div>
						-->
						<h4 class="customer-profile-group-heading"><?= _l($title); ?></h4>
						<hr class="hr-panel-heading" />
						<?php render_datatable(array(
							_l('Name'),
							_l('options')
							),'officeLocation'); 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
	<script>
		initDataTable('.table-officeLocation', window.location.href, [1], [1]);
	</script>
</body>
</html>
