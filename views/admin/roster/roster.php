<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
		    <div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
						<h4 class="customer-profile-group-heading"><?= _l($title); ?></h4>
    				    <?= form_open_multipart(admin_url('roster/add/'.$article->id), array('id' => 'rosterForm'));  ?>
        					<div class="row">
    					       <div class="col-md-4 form-group">
        					       <?= _l('Client'); ?><span class="text-danger">*</span>
        					       <select class="form-control selectpicker" data-live-search="true" name="client_id" required>
        					            <option value=""></option>
        					            <?php
        					                if($clients_list)
        					                {
        					                    foreach($clients_list as $res)
        					                    {
        					                        ?>
        					                            <option <?= ($article->client_id == $res->userid)?"selected":""; ?> value="<?= $res->userid; ?>"><?= $res->firstname.' '.$res->lastname; ?></option>
        					                        <?php
        					                    }
        					                }
        					            ?>
        					       </select>
        					   </div>
        					   <?php
        					        if($article == '')
        					        {
        					             ?>
        					               <div class="col-md-4 form-group">
                    					       <p></p>
                    					       <span class="btn btn-info" style="cursor:pointer;" onClick="addMoreRoster()"><i class="fa fa-plus"></i> Add More</span>
                    					   </div> 
        					            <?php
        					        }
        					   ?>
    					   </div>
    					   <div class="row">
    					       <div class="col-md-4 form-group">
        					       <?= _l('Staff'); ?><span class="text-danger">*</span>
        					       <select class="form-control selectpicker" data-live-search="true" name="staff_id" required>
        					            <option value=""></option>
        					            <?php
        					                if($employee_list)
        					                {
        					                    foreach($employee_list as $res)
        					                    {
        					                        ?>
        					                            <option <?= ($article->staff_id == $res->userid)?"selected":""; ?> value="<?= $res->userid; ?>"><?= $res->firstname.' '.$res->lastname; ?></option>
        					                        <?php
        					                    }
        					                }
        					            ?>
        					       </select>
        					   </div>
                               <div class="col-md-4 form-group">
        					       <?= _l('Type of service'); ?><span class="text-danger">*</span>
        					       <select class="form-control selectpicker" data-live-search="true" name="service_id" required>
        					            <option value=""></option>
        					            <?php
        					                if(serviceType())
        					                {
        					                    foreach(serviceType() as $skey => $svalue)
        					                    {
        					                        ?>
        					                            <option <?= ($article->service_id == $svalue['id'])?"selected":""; ?> value="<?= $svalue['id']; ?>"><?= $svalue['name']; ?></option>
        					                        <?php
        					                    }
        					                }
        					            ?>
        					       </select>
        					   </div>

        					   <div class="col-md-4 form-group">
        					        <?= _l('Start Date'); ?><span class="text-danger">*</span>
    					            <input type="text" required class="form-control" autocomplete="off" value="<?= $article->start_date; ?>" name="start_date" id="start_date">
        					   </div> 
        					   <div class="col-md-4 form-group">
        					        <?= _l('End Date'); ?><span class="text-danger">*</span>
    					            <input type="text" required class="form-control" autocomplete="off" value="<?= $article->end_date; ?>" name="end_date" id="end_date">
        					   </div>
    					    <!-- </div>
        					<div class="row"> -->
        					   <div class="col-md-4 form-group">
        					       <?= _l('Start Time'); ?><span class="text-danger">*</span>
        					       <select class="form-control selectpicker" data-live-search="true" name="time_from" required>
        					            <option value=""></option>
        					            <?php
        					                if($timeslot_list)
        					                {
        					                    foreach($timeslot_list as $res)
        					                    {
        					                        ?>
        					                            <option <?= ($article->time_from == $res->time_from)?"selected":""; ?> value="<?= $res->time_from; ?>"><?= $res->time_from; ?></option>
        					                        <?php
        					                    }
        					                }
        					            ?>
        					       </select>
        					   </div>
                               <div class="col-md-4 form-group">
                                   <?= _l('End Time'); ?><span class="text-danger">*</span>
                                   <select class="form-control selectpicker" data-live-search="true" name="time_to" required>
                                        <option value=""></option>
                                        <?php
                                            if($timeslot_list)
                                            {
                                                foreach($timeslot_list as $res)
                                                {
                                                    ?>
                                                        <option <?= ($article->time_to == $res->time_to)?"selected":""; ?> value="<?= $res->time_to; ?>"><?= $res->time_to; ?></option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                   </select>
                               </div> 
        					   <div class="col-md-4 form-group">
        					       <?= _l('Description'); ?>
        					       <textarea name="description" class="form-control" rows="3" required><?= (isset($article)?$article->description:""); ?></textarea>
        					   </div>
    					    </div>
    					    <div class="moreroster"></div>
    					    <hr class="hr-panel-heading" />
    					    <div class="row">
        					   <div class="col-md-6 form-group">
        					       <button type="submit" class="btn btn-success">Save</button>
        					       <a href="<?= admin_url('roster')?>" class="btn btn-warning">Cancel</a>
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
    <script>
		initDataTable('.table-roster', window.location.href, [1], [1],'',[0,'DESC']);
	</script>
	<script>
        $(function(){
            <?php
                if(isset($article))
                {
                    ?>
                        appValidateForm($('#rosterForm'),{client_id:'required',staff_id:'required',time_slot:'required',description:'required'});
                    <?php
                }
                else
                {
                    ?>
                        appValidateForm($('#rosterForm'),{client_id:'required',staff_id:'required',time_slot:'required',description:'required'});
                    <?php
                }
            ?>
        });
        
        $(document).ready(function(){
            $("#start_date").datepicker({
                minDate:0,
                dateFormat: 'yy-mm-dd',
                onSelect: function(selected) {
                  $("#end_date").datepicker("option","minDate", selected)
                }
            });
            $("#end_date").datepicker({ 
                minDate:0,
                dateFormat: 'yy-mm-dd',
                onSelect: function(selected) {
                   $("#start_date").datepicker("option","maxDate", selected)
                }
            });  
        });
        
        <?php
            if($article == '')
            {
                ?>
                    var click = 0;
                    function addMoreRoster()
                    {
                        click++;
                        var html = '';
                        html += '<div id="rid'+click+'"><hr>';
                        html += '<div class="row">';
                        html += '<div class="col-md-4 form-group">';
                        html += '<?= _l('Staff'); ?><span class="text-danger">*</span>';
                        html += '<select class="form-control selectpicker" data-live-search="true" name="staff_idArr[]" required>';
                        html += '<option value=""></option>';
                        <?php
        	                if($employee_list)
        	                {
        	                    foreach($employee_list as $res)
        	                    {
        	                        ?>
        	                            html += '<option value="<?= $res->userid; ?>"><?= $res->firstname.' '.$res->lastname; ?></option>';
        	                        <?php
        	                    }
        	                }
        	            ?>
                        html += '</select>';
                        html += '</div>';

                        html += '<div class="col-md-4 form-group">';
                        html += '<?= _l('Type of service'); ?><span class="text-danger">*</span>';
                        html += '<select class="form-control selectpicker" data-live-search="true" name="service_idArr[]" required>';
                        html += '<option value=""></option>';
                        <?php
                            if(serviceType())
                            {
                                foreach(serviceType() as $skey => $svalue)
                                {
                                    ?>
                                        html += '<option value="<?= $svalue['id']; ?>"><?= $svalue['name']; ?></option>';
                                    <?php
                                }
                            }
                        ?>
                        html += '</select>';
                        html += '</div>';

                        html += '<div class="col-md-4 form-group">';
                        html += '<?= _l('Start Date'); ?><span class="text-danger">*</span>';
                        html += '<input type="text" required class="form-control" autocomplete="off" name="start_dateArr[]" id="start_date'+click+'">';
                        html += '</div>';
                        html += '<div class="col-md-4 form-group">';
                        html += '<?= _l('End Date'); ?><span class="text-danger">*</span>';
                        html += '<input type="text" required class="form-control" autocomplete="off" name="end_dateArr[]" id="end_date'+click+'">';
                        html += '</div>';
                        // html += '</div>';
                        // html += '<div class="row">';
                        html += '<div class="col-md-4 form-group">';
                        html += '<?= _l('Start Time'); ?><span class="text-danger">*</span>';
                        html += '<select class="form-control selectpicker" data-live-search="true" name="time_fromArr[]" required>';
                        html += '<option value=""></option>';
                        <?php
        	                if($timeslot_list)
        	                {
        	                    foreach($timeslot_list as $res)
        	                    {
        	                        ?>
        	                            html += '<option value="<?= $res->time_from; ?>"><?= $res->time_from; ?></option>';
        	                        <?php
        	                    }
        	                }
        	            ?>
                        html += '</select>';
                        html += '</div> ';
                        html += '<div class="col-md-4 form-group">';
                        html += '<?= _l('End Time'); ?><span class="text-danger">*</span>';
                        html += '<select class="form-control selectpicker" data-live-search="true" name="time_toArr[]" required>';
                        html += '<option value=""></option>';
                        <?php
                            if($timeslot_list)
                            {
                                foreach($timeslot_list as $res)
                                {
                                    ?>
                                        html += '<option value="<?= $res->time_to; ?>"><?= $res->time_to; ?></option>';
                                    <?php
                                }
                            }
                        ?>
                        html += '</select>';
                        html += '</div> ';
                        html += '<div class="col-md-3 form-group">';
                        html += '<?= _l('Description'); ?>';
                        html += '<textarea name="descriptionArr[]" class="form-control" rows="3" required></textarea>';
                        html += '</div>';
                        html += '<div class="col-md-1 form-group"><label>';
                        html += '<?= _l('Remove'); ?>';
                        html += '</label><br><span class="btn btn-danger" style="cursor:pointer;" onClick="remveRoster('+click+')"><i class="fa fa-trash"></i></span>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        
                        $('.moreroster').append(html);
                        
                        $("#start_date"+click).datepicker({
                            minDate:0,
                            dateFormat: 'yy-mm-dd',
                            onSelect: function(selected) {
                              $("#end_date"+click).datepicker("option","minDate", selected)
                            }
                        });
                        $("#end_date"+click).datepicker({ 
                            minDate:0,
                            dateFormat: 'yy-mm-dd',
                            onSelect: function(selected) {
                               $("#start_date"+click).datepicker("option","maxDate", selected)
                            }
                        });  
                        $( '.selectpicker' ).selectpicker( 'refresh' );
                    }
                    
                    function remveRoster(rid)
                    {
                        $('#rid'+rid).empty();
                    }
                <?php
            }
        ?>
            
	</script>
</body>
</html>
