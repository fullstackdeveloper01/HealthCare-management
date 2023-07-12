<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel_s">
					<div class="panel-body">
					<h4 class="no-margin">
					<?php echo $title; ?>
					</h4>
					<hr class="hr-panel-heading" />
						<?php echo form_open($this->uri->uri_string()); ?>

						<?php $value = (isset($announcement) ? $announcement->name : ''); ?>
						<?php echo render_input('name','announcement_name',$value); ?>

						<p class="bold"><?php echo _l('announcement_message'); ?></p>
						<?php $contents = ''; if(isset($announcement)){$contents = $announcement->message;} ?>
						<?php echo render_textarea('message','',$contents,array(),array(),'','tinymce'); ?>

						<div class="checkbox checkbox-primary checkbox-inline">
						    <?= _l('Select individual'); ?>
						    <select class="selectpicker" multiple name="agents_ids[]">
						        <?php
						            $selected_garage = [];
						            $selected_garage = (isset($announcement) ? explode(',',$announcement->agents_ids) : '');
						            if($user_list)
						            {
						                $selectedgarageid = '';
						                $sn = 1;
						                foreach($user_list as $rrr)
						                {
						                    if($rrr->firstname != '')
                                            {
                                                $role = $this->db->get_where(db_prefix().'clients', array('userid' => $rrr->userid))->row('role');
                                                if($role == 1)
                                                {
                                                    if($sn == 1)
                                                    {
                                                        $selectedgarageid .= $rrr->userid;
                                                    }
                                                    else
                                                    {
                                                        $selectedgarageid .= ','.$rrr->userid;
                                                    }
                                                    if(in_array($rrr->userid, $selected_garage))
                                                    {
                                                        ?>
                                                            <option value="<?= $rrr->userid; ?>" selected><?= $rrr->firstname.' '.$rrr->lastname; ?></option>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                            <option value="<?= $rrr->userid; ?>"><?= $rrr->firstname.' '.$rrr->lastname; ?></option>
                                                        <?php
                                                    }
                                                    $sn++;
                                                }
                                            }
						                }
						            }
						        ?>
						    </select>
						</div>
						<div class="checkbox checkbox-primary checkbox-inline hide">
							<input type="checkbox" name="showtostaff" id="showtostaff" <?php if(isset($announcement)){if($announcement->showtostaff == 1){echo 'checked';} } else {echo 'checked';} ?>>
							<label for="showtostaff"><?php echo _l('announcement_show_to_staff'); ?></label>
						</div>
						<div class="checkbox checkbox-primary checkbox-inline">
							<input type="checkbox" name="showgarage" value="<?= $selectedgarageid; ?>" id="showtousers" <?php if(isset($announcement)){if($announcement->showtousers == 1){echo 'checked';}} ?>>
							<label for="showtousers"><?php echo _l('Show to all staff'); ?></label>
						</div>
						<div class="checkbox checkbox-primary checkbox-inline hide">
							<input type="checkbox" name="showname" id="showname" <?php if(isset($announcement)){if($announcement->showname == 1){echo 'checked';}} ?>>
							<label for="showname"><?php echo _l('announcement_show_my_name'); ?></label>
						</div>
						<button type="submit" class="btn btn-info pull-right"><?php echo _l('submit'); ?></button>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
<script>
	$(function(){
		appValidateForm($('form'),{name:'required'});
	});
</script>
</body>
</html>
