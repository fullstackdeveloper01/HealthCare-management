<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
		    <?= $this->load->view('admin/properties/sidebar');?>
			<div class="col-md-9">
				<div class="panel_s">
    				<div class="panel-body">
    					<?= form_open_multipart(admin_url('properties/updateImg/'.$article->id));  ?> 
    					   <h4 class="customer-profile-group-heading"><?= _l('Upload Images'); ?></h4>
						    <hr class="hr-panel-heading" />
    					    <div class="row form-group">
    					        <div class="col-md-2">
        					       <?= _l('Selected'); ?>
        					       <?php $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => "propertyimg"))->row(); ?>
        					       <img src="<?= site_url('download/file/taskattachment/'. $imageArray->attachment_key); ?>" alt="<?= $imageArray->attachment_key; ?>" width="100px" height="100px" /><br>
        					       <input type="radio" name="defaultimg" value="1" <?= ($article->defaultimage == 1 || $article->defaultimage == '')?"checked":""; ?>> Default Image
        					       <input type="text" class="hide" name="id" value="<?= $article->id; ?>">
        					    </div>
    					        <div class="col-md-4">
        					       <?= _l('Image 1'); ?>
        					       <input type="file" class="form-control" name="propertyimg">
        					    </div>
        				    </div>
        				    <div class="row form-group">
        					    <div class="col-md-2">
        					       <?= _l('Selected'); ?>
        					       <?php $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => "property1"))->row(); ?>
        					       <img src="<?= site_url('download/file/taskattachment/'. $imageArray->attachment_key); ?>" alt="<?= $imageArray->attachment_key; ?>" width="100px" height="100px" /><br>
        					       <input type="radio" name="defaultimg" value="2" <?= ($article->defaultimage == 2)?"checked":""; ?>> Default Image
        					    </div>
        					    <div class="col-md-4">
        					       <?= _l('Image 2'); ?>
        					       <input type="file" class="form-control" name="property1">
        					    </div>
        					</div>
        				    <div class="row form-group">
        					    <div class="col-md-2">
        					       <?= _l('Selected'); ?>
        					       <?php $imageArray2 = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => "property2"))->row(); ?>
        					       <img src="<?= site_url('download/file/taskattachment/'. $imageArray2->attachment_key); ?>" alt="<?= $imageArray2->attachment_key; ?>" width="100px" height="100px" /><br>
        					       <input type="radio" name="defaultimg" value="3" <?= ($article->defaultimage == 3)?"checked":""; ?>> Default Image
        					    </div>
        					    <div class="col-md-4">
        					       <?= _l('Image 3'); ?>
        					       <input type="file" class="form-control" name="property2">
        					    </div>
        					</div>
        				    <div class="row form-group">
        					    <div class="col-md-2">
        					       <?= _l('Selected'); ?>
        					       <?php $imageArray3 = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => "property3"))->row(); ?>
        					       <img src="<?= site_url('download/file/taskattachment/'. $imageArray3->attachment_key); ?>" alt="<?= $imageArray3->attachment_key; ?>" width="100px" height="100px" /><br>
        					       <input type="radio" name="defaultimg" value="4" <?= ($article->defaultimage == 4)?"checked":""; ?>> Default Image
        					    </div>
        					    <div class="col-md-4">
        					       <?= _l('Image 4'); ?>
        					       <input type="file" class="form-control" name="property3">
        					    </div>
        					</div>
        				    <div class="row form-group">
        					    <div class="col-md-2">
        					       <?= _l('Image 5'); ?>
        					       <?= _l('Selected'); ?>
        					       <?php $imageArray4 = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => "property4"))->row(); ?>
        					       <img src="<?= site_url('download/file/taskattachment/'. $imageArray4->attachment_key); ?>" alt="<?= $imageArray4->attachment_key; ?>" width="100px" height="100px" /><br>
        					       <input type="radio" name="defaultimg" value="5"  <?= ($article->defaultimage == 5)?"checked":""; ?>> Default Image
        					    </div>
        					    <div class="col-md-4">
        					       <?= _l('Image 5'); ?>
        					       <input type="file" class="form-control" name="property4">
        					    </div>
        					</div>
        				    <div class="row form-group">
        					    <div class="col-md-2">
        					       <?= _l('Selected'); ?>
        					       <?php $imageArray5 = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => "property5"))->row(); ?>
        					       <img src="<?= site_url('download/file/taskattachment/'. $imageArray5->attachment_key); ?>" alt="<?= $imageArray5->attachment_key; ?>" width="100px" height="100px" /><br>
        					       <input type="radio" name="defaultimg" value="6"  <?= ($article->defaultimage == 6)?"checked":""; ?>> Default Image
        					    </div>
        					    <div class="col-md-4">
        					       <?= _l('Image 6'); ?>
        					       <input type="file" class="form-control" name="property5">
        					    </div>
        					</div>
        					<div class="row form-group"><hr>
        					    <div class="col-md-2">
        					       <button type="submit" class="btn btn-info">Save Images</button>
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
