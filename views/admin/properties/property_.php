<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel_s">
    				<div class="panel-body">
    					<?= form_open_multipart(admin_url('properties/add/'.$article->id));  ?> 
    					    <h4 class="customer-profile-group-heading"><?= _l('Edit Property'); ?></h4>
						    <hr class="hr-panel-heading" />
    					    <div class="row form-group">
        					    <div class="col-md-1">
        					       <?= _l('Thumbnail'); ?>
        					       <?php $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => "propertyimg"))->row(); ?>
        					       <img src="<?= site_url('download/file/taskattachment/'. $imageArray->attachment_key); ?>" alt="<?= $imageArray->attachment_key; ?>" width="50xp" height="50px" />
        					    </div>
        					    <div class="col-md-2">
        					       <?= _l('Change'); ?>
        					       <input type="file" class="form-control" name="propertyimg">
        					    </div>
        					    <div class="col-md-1">
        					       <?= _l('Document'); ?>
        					       <?php $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => "documents"))->row(); ?>
        					       <a href="<?= site_url('download/file/taskattachment/'. $imageArray->attachment_key); ?>" alt="<?= $imageArray->attachment_key; ?>" width="50xp" height="50px"><i class="fa fa-download fa-2x"></i></a>
        					    </div>
        					    <div class="col-md-2">
        					       <?= _l('Change'); ?>
        					       <input type="file" class="form-control" name="documents">
        					    </div>
        					    <div class="col-md-3">
        					       <?= _l('Title'); ?>
        					       <input type="text" class="form-control" value="<?= $article->name; ?>" required name="name">
        					    </div>
        					    <div class="col-md-3">
        					       <?= _l('Price'); ?>
        					       <input type="text" class="form-control" value="<?= $article->price; ?>" required name="price">
        					    </div>
    					    </div>
    					    <div class="row form-group">
        					    <div class="col-md-3">
        					       <?= _l('Agent'); ?>
        					       <select name="agent_id" required class="form-control">
        					           <option >
            					       <?php
            					            if($agent_list)
            					            {
            					                foreach($agent_list as $res)
            					                {
            					                    ?>
            					                        <option value="<?= $res->userid; ?>" <?= ($article->agent_id == $res->userid)?"selected":""; ?>><?= $res->firstname.' '.@$res->lastname; ?></option>
            					                    <?php
            					                }
            					            }
            					            else
            					            {
            					                ?>
            					                    <option value="">No agent found</option>
            					                <?php
            					            }
            					       ?>
            					   </select>
        					    </div>
        					    <div class="col-md-3">
        					       <?= _l('SqFit.'); ?>
        					       <input type="text" class="form-control" value="<?= $article->sqfit; ?>" required name="sqfit">
        					    </div>
        					    <div class="col-md-3">
        					       <?= _l('Type'); ?>
        					       <input type="text" class="form-control" value="<?= $article->type; ?>" required name="type">
        					    </div>
        					    <div class="col-md-3">
        					       <?= _l('Active date'); ?>
        					       <input type="text" class="form-control datepicker" value="<?= $article->active_date; ?>" required name="active_date">
        					    </div>
    					    </div>
    					    <div class="row form-group">
    					        <div class="col-md-6">
        					       <?= _l('Description'); ?>
        					       <textarea name="description" class="form-control" required rows="5"><?= $article->description; ?></textarea>
        					    </div>
    					        <div class="col-md-6">
        					       <?= _l('Address'); ?>
        					       <textarea name="address" class="form-control" required rows="5"><?= $article->address; ?></textarea>
        					    </div>
        					</div>
        					<div class="row form-group">
        					    <div class="col-md-2">
        					       <?= _l('Image 1'); ?>
        					       <input type="file" class="form-control" name="property1"><br>
        					       <?php $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => "property1"))->row(); ?>
        					       <img src="<?= site_url('download/file/taskattachment/'. $imageArray->attachment_key); ?>" alt="<?= $imageArray->attachment_key; ?>" width="100xp" height="100px" />
        					    </div>
        					    <div class="col-md-2">
        					       <?= _l('Image 2'); ?>
        					       <input type="file" class="form-control" name="property2"><br>
        					       <?php $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => "property2"))->row(); ?>
        					       <img src="<?= site_url('download/file/taskattachment/'. $imageArray->attachment_key); ?>" alt="<?= $imageArray->attachment_key; ?>" width="100xp" height="100px" />
        					    </div>
        					    <div class="col-md-2">
        					       <?= _l('Image 3'); ?>
        					       <input type="file" class="form-control" name="property3"><br>
        					       <?php $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => "property3"))->row(); ?>
        					       <img src="<?= site_url('download/file/taskattachment/'. $imageArray->attachment_key); ?>" alt="<?= $imageArray->attachment_key; ?>" width="100xp" height="100px" />
        					    </div>
        					    <div class="col-md-2">
        					       <?= _l('Image 4'); ?>
        					       <input type="file" class="form-control" name="property4"><br>
        					       <?php $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => "property4"))->row(); ?>
        					       <img src="<?= site_url('download/file/taskattachment/'. $imageArray->attachment_key); ?>" alt="<?= $imageArray->attachment_key; ?>" width="100xp" height="100px" />
        					    </div>
        					    <div class="col-md-2">
        					       <?= _l('Image 5'); ?>
        					       <input type="file" class="form-control" name="property5"><br>
        					       <?php $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => "property5"))->row(); ?>
        					       <img src="<?= site_url('download/file/taskattachment/'. $imageArray->attachment_key); ?>" alt="<?= $imageArray->attachment_key; ?>" width="100xp" height="100px" />
        					    </div>
        					</div>
        					<div class="row form-group"><hr>
        					    <div class="col-md-2"><br/>
        					       <button type="submit" class="btn btn-info">Update properties</button>
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
