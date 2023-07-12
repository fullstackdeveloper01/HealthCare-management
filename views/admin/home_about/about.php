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
						<?php render_datatable(array(
							_l('SN'),
							_l('Image'),
							_l('Title'),
							_l('Content'),
							_l('Is Main'),
							_l('Other Content'),
							_l('Status'),
							_l('Action')
							),'homeAbout'); 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>    
<?php init_tail(); ?>  
	<script>
		initDataTable('.table-homeAbout', window.location.href, [1], [1]);
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
