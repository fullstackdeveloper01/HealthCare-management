<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
		    <?= $this->load->view('admin/properties/sidebar');?>
			<div class="col-md-9">
				<div class="panel_s">
    				<div class="panel-body">
    				    <?= form_open(admin_url('properties/distances/'.$article->id));  ?> 
    					     <h4 class="customer-profile-group-heading"><?= _l('Distances'); ?></h4>
						     <hr class="hr-panel-heading" />
    					     <div class="row form-group">
        					    <div class="col-md-4">
        					       <?= _l('Beach'); ?>
        					       <input type="text" class="form-control" value="<?= (isset($article))?$article->Beach:""; ?>" required name="Beach">
        					    </div>
        					    <div class="col-md-4">
        					       <?= _l('Train'); ?>
        					       <input type="text" class="form-control" value="<?= (isset($article))?$article->Train:""; ?>" required name="Train">
        					    </div>
        					    <div class="col-md-4">
        					       <?= _l('Metro'); ?>
        					       <input type="text" class="form-control" value="<?= (isset($article))?$article->Metro:""; ?>" required name="Metro">
        					    </div>
    					     </div>
    					     <div class="row form-group">
        					    <div class="col-md-4">
        					       <?= _l('Bus'); ?>
        					       <input type="text" class="form-control" value="<?= (isset($article))?$article->Bus:""; ?>" required name="Bus">
        					    </div>
        					    <div class="col-md-4">
        					       <?= _l('Pharmacies'); ?>
        					       <input type="text" class="form-control" value="<?= (isset($article))?$article->Pharmacies:""; ?>" required name="Pharmacies">
        					    </div>
        					    <div class="col-md-4">
        					       <?= _l('Bakery'); ?>
        					       <input type="text" class="form-control" value="<?= (isset($article))?$article->Bakery:""; ?>" required name="Bakery">
        					    </div>
    					     </div>
    					     <div class="row form-group">
        					    <div class="col-md-4">
        					       <?= _l('Restourant'); ?>
        					       <input type="text" class="form-control" value="<?= (isset($article))?$article->Restourant:""; ?>" required name="Restourant">
        					    </div>
        					    <div class="col-md-4">
        					       <?= _l('Coffee shop'); ?>
        					       <input type="text" class="form-control" value="<?= (isset($article))?$article->Coffee_shop:""; ?>" required name="Coffee_shop">
        					    </div>
    					     </div>
        					<div class="row form-group"><hr>
        					    <div class="col-md-2">
        					       <button type="submit" class="btn btn-info">Update Distances</button>
        					    </div>
        					</div>
    				    </form>
    				</div>
    			</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
</body>
</html>
