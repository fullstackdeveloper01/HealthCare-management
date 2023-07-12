<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel_s">
				    <?= form_open_multipart(admin_url('policyPage/edit/'.$article->id), array('id' => 'import_form'));  ?>
    					<div class="panel-body"> 
    					   <div class="form-group">
    					       <?= _l('Title'); ?>
    					       <input type="text" name="title" maxlength ="100" value="<?= (isset($article))?$article->title:''; ?>" required class="form-control">
    					   </div> 
						   
    					   <div class="form-group">
    					       <?= _l('Description'); ?>
							   <textarea name="content" class="form-control" required><?= (isset($article))?$article->content:''; ?></textarea>
    					       <!-- <input type="text" name="content" maxlength="100" value="<?= (isset($article))?$article->content:''; ?>" required class="form-control"> -->
    					   </div> 
						   <div class="form-group">
						   		<?= _l('Other Content'); ?>
								<textarea name="other_content" class="form-control" ><?= (isset($article))?$article->other_content:''; ?></textarea>
     					   </div> 
    					   <div class="form-group">
    					       <button type="submit" class="btn btn-info">Save</button>
    					       <?php
    					            if(isset($article))
    					            {
    					                echo '<a href="'.admin_url().'policyPage" class="btn btn-warning pull-right">Cancel</a>';
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
