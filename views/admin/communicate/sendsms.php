<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <?php echo form_open($this->uri->uri_string(),array('id'=>'article-form')); ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="panel_s">
                       <div class="panel-body">
                          <h4 class="no-margin">
                             <?php echo $title; ?>
                          </h4>
                          <hr class="hr-panel-heading" />
                          <div class="clearfix"></div>
                          <div class="form-group">
                              <?= _l('Title'); ?>
                              <input type="text" class="form-control" required name="title">
                          </div>
                          <div class="form-group">
                              <?= _l('Message'); ?>
                              <textarea name="description" class="form-control" required rows="8"></textarea>
                          </div>
                       </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel_s">
                       <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><input id="groupradio" class="hide" checked value="group" type="radio" name="type"><a onclick="settype('groupradio');" data-toggle="tab" href="#group">Clients</a></li>
                                <li><input type="radio" id="individualradio"  class="hide" value="individual" name="type"><a onclick="settype('individualradio');" data-toggle="tab" href="#individual">Staff</a></li>
                                <!--<li><input type="radio" id="classradio"  class="hide" value="class" name="type"><a onclick="settype('classradio');" data-toggle="tab" href="#class">Class</a></li>-->
                            </ul>
                            <div class="clearfix"></div>
                            <div class="tab-content">
                                <div id="group" class="tab-pane fade in active">
                                    <div class="row">
                                        <div class="col-md-8 form-group">
                                            <label><?= _l('Message To'); ?></label>
                                            <select class="selectpicker" multiple data-live-search="true" name="emails[]">
                                                <?php
                                                    if($garage_list)
                                                    {
                                                        foreach($garage_list as $rrr){
                                                            if($rrr->firstname != '')
                                                            {
                                                                $role = $this->db->get_where(db_prefix().'clients', array('userid' => $rrr->userid))->row('role');
                                                                if($role == 2)
                                                                {
                                                                    ?>
                                                                        <option value="<?= $rrr->email; ?>"><?= $rrr->firstname; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label><?= _l('All Clients'); ?></label><br>
                                            <input type="checkbox" name="clientsall">
                                        </div>
                                    </div>
                                </div>
                                <div id="individual" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-8 form-group">
                                            <label><?= _l('Message To'); ?></label>
                                            <select class="selectpicker" multiple data-live-search="true" name="emails[]">
                                                <?php
                                                    if($garage_list)
                                                    {
                                                        foreach($garage_list as $rrr){
                                                            if($rrr->firstname != '')
                                                            {
                                                                $role = $this->db->get_where(db_prefix().'clients', array('userid' => $rrr->userid))->row('role');
                                                                if($role == 1)
                                                                {
                                                                    ?>
                                                                        <option value="<?= $rrr->email; ?>"><?= $rrr->firstname; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label><?= _l('All Staff'); ?></label><br>
                                            <input type="checkbox" name="staffall">
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
                <div class="btn-bottom-toolbar btn-toolbar-container-out text-right">
                    <button type="submit" class="btn btn-info pull-right"><?php echo _l('submit'); ?></button>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
<?php init_tail(); ?>
<script>
   $(function(){
     init_editor('#description', {append_plugins: 'stickytoolbar'});
     appValidateForm($('#article-form'),{subject:'required',articlegroup:'required'});
   });
</script>
</body>
</html>
