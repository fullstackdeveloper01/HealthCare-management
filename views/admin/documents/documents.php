<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel_s">
				    <div class="panel-body">
				        <h4 class="customer-profile-group-heading"><?= _l($title); ?></h4>
						<hr class="hr-panel-heading" />
				        <?= form_open_multipart(admin_url('documents/add/'.$article->id));  ?>
				            <div class="form-group">
    					       <?= _l('Title'); ?>
    					       <input type="text" required autocomplete="off" class="form-control" value="<?= $article->title; ?>" name="title">
    					   </div>
    					   <div class="form-group">
    					       <div class="row">
    					            <div class="col-md-6">
    					               <?= _l('Type'); ?>
            					       <select name="type_id" id="type_id" required class="form-control">
            					           <option value=""></option>
            					           <?php
            					                if($type_result)
            					                {
            					                    foreach($type_result as $rrr)
            					                    {
            					                        ?>
            					                            <option value="<?= $rrr->id; ?>" <?= ($rrr->id == $article->type_id)?'selected':''; ?>><?= $rrr->name; ?></option>
            					                        <?php
            					                    }
            					                }
            					           ?>
            					       </select>
    					            </div>
    					            <div class="col-md-6">
    					                <div class="form-group">
                					       <?= _l('Document'); ?>
                					       <input type="file" class="form-control" required name="document"/>
                					   </div>
    					            </div>
    					       </div>
    					   </div>
    					   
    					   <div class="form-group">
    					       <button type="submit" class="btn btn-info">Submit</button>
    					   </div>
        				</form>
        			</div>
    			</div>
			</div>
			<!--
			<div class="col-md-8">
				<div class="panel_s">
					<div class="panel-body">
						<div class="_buttons">
							<a href="<?php echo admin_url('documents/add'); ?>" class="btn btn-info pull-left display-block"><?php echo _l('new '.$sh_text); ?></a>
						</div>
						<h4 class="customer-profile-group-heading"><?= _l($title); ?></h4>
						<hr class="hr-panel-heading" />
						<?php render_datatable(array(
							_l('Type'),
							_l('Title'),
							_l('options')
							),'documents'); 
						?>
					</div>
				</div>
			</div>
			-->
		</div>
	</div>
</div>
<?php init_tail(); ?>
	<script>
		initDataTable('.table-documents', window.location.href, [1], [1]);
	</script>
</body>
</html>
