<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
		    <?= $this->load->view('admin/properties/sidebar');?>
			<div class="col-md-9">
				<div class="panel_s">
    				<div class="panel-body">
    				    <?= form_open(admin_url('properties/updateDoc/'.$article->id));  ?> 
    					    <h4 class="customer-profile-group-heading"><?= _l('Upload Document'); ?></h4>
						    <hr class="hr-panel-heading" />
    					    <div class="row form-group">
        					    <div class="col-md-4">
        					       <?= _l('Title'); ?><span class="text-danger">*</span>
        					       <input type="text" class="form-control" required  name="title">
        					       <input type="text" class="hide" name="property_id" value="<?= $article->id; ?>">
        					    </div>
        					    <div class="col-md-8">
        					       <?= _l('Description'); ?><span class="text-danger">*</span>
        					       <textarea name="description" class="form-control" rows="3" required></textarea>
        					    </div>
    					    </div>
    					    <div class="row form-group">
        					    <div class="col-md-1">
        					       <?= _l('Required'); ?>
        					       <input type="checkbox"  name="required" value="1" />
        					    </div>
        					    <div class="col-md-4">
        					       <button type="submit" class="btn btn-info">Save Document</button>
        					    </div>
    					    </div>
    				    </form>
    				    <hr class="hr-panel-heading" />
						<?php render_datatable(array(
							_l('Name'),
							_l('Required'),
							_l('Description'),
							_l('options')
							),'propertyDoc'); 
						?>
    				</div>
    			</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
	<script>
		initDataTable('.table-propertyDoc', window.location.href, [1], [1]);
	</script>
</body>
</html>