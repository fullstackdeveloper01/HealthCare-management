<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel_s">
				    <?= form_open_multipart(admin_url('homeAbout/edit/'.$article->id), array('id' => 'import_form'));  ?>
    					<div class="panel-body">
    					   <div class="form-group">
    					       <?= _l('Home About'); ?>
    					       <input type="file" filesize="<?php echo file_upload_max_size(); ?>" class="form-control" name="home_about">
    					       <?php
    					            if(isset($article))
    					            {
    					                $filename = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => 'home_about'))->row('file_name');
    					                echo '<img src="'.site_url('uploads/home_about/'.$article->id.'/'. $filename).'" width="50" height="50" alt="">';
    					            }
    					       ?>
    					   </div>
    					   <div class="form-group">
    					       <?= _l('Title'); ?>
    					       <input type="text" name="title" maxlength ="100" value="<?= (isset($article))?$article->title:''; ?>" required class="form-control">
    					   </div> 
						   
    					   <div class="form-group">
    					       <?= _l('Description'); ?>
    					       <input type="text" name="content" maxlength="100" value="<?= (isset($article))?$article->content:''; ?>" required class="form-control">
    					   </div>
						   <div class="form-group">
                                <?= _l('Is Main'); ?>
                                <select name="is_main" >
                                    <<option value="1">Yes</option>
                                    <<option selected value="0">No</option>
                                </select>
                           </div>
						   <div class="form-group">
						   		<?= _l('Other Content'); ?>
    					       <input type="text" name="other_content" maxlength="100" value="<?= (isset($article))?$article->other_content:''; ?>" required class="form-control">
    					   </div> 
    					   <div class="form-group">
    					       <button type="submit" class="btn btn-info">Save</button>
    					       <?php
    					            if(isset($article))
    					            {
    					                echo '<a href="'.admin_url().'homeAbout" class="btn btn-warning pull-right">Cancel</a>';
    					            }
    					       ?>
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
