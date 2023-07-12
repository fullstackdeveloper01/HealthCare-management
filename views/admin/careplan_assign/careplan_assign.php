<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
		    <div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
						<h4 class="customer-profile-group-heading"><?= _l($title); ?></h4>
    				    <?= form_open_multipart(admin_url('careplan_assign/add/'.$article->id), array('id' => 'careplan_assignForm'));  ?>
        					<div class="row">
    					       <div class="col-md-4 form-group">
        					       <?= _l('Client'); ?><span class="text-danger">*</span>
        					       <select class="form-control selectpicker" data-live-search="true" name="userid" required>
        					            <option value=""></option>
        					            <?php
        					                if($clients_list)
        					                {
        					                    foreach($clients_list as $res)
        					                    {
        					                        ?>
        					                            <option <?= ($article->userid == $res->userid)?"selected":""; ?> value="<?= $res->userid; ?>"><?= $res->firstname.' '.$res->lastname; ?></option>
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
                    					       <span class="btn btn-info" style="cursor:pointer;" onClick="addMorecareplan_assign()"><i class="fa fa-plus"></i> Add More</span>
                    					   </div> 
        					            <?php
        					        }
        					   ?>
    					   </div>
						   <div class="row">
    					       <div class="col-md-4 form-group">
        					       <?= _l('Title'); ?><span class="text-danger">*</span>
								   <input type="text" required autocomplete="off" class="form-control" name="title" required>
        					   </div>
        					  
    					    </div>
        					
    					   <div class="row">
    					       <div class="col-md-4 form-group">
        					       <?= _l('Plan'); ?><span class="text-danger">*</span>
								   <input type="file" extension="pdf" accept=".pdf" name="care_plan" required="" class="form-control" placeholder="Upload">
        					       <!-- <select class="form-control selectpicker" data-live-search="true" name="plan_id" required>
        					            <option value=""></option> -->
        					            <?php
        					                // if($care_plan_list)
        					                // {
        					                //     foreach($care_plan_list as $res)
        					                //     {
        					                        ?>
        					                            <!-- <option <?// ($article->plan_id == $res->id)?"selected":""; ?> value="<?= $res->id; ?>"><?= $res->title.' ('.$res->officer.')'; ?></option> -->
        					                        <?php
        					                //     }
        					                // }
        					            ?>
        					       <!-- </select> -->
        					   </div>
        					  
    					    </div>
        					
    				
    					    <div class="morecareplan_assign"></div>
    					    <hr class="hr-panel-heading" />
    					    <div class="row">
        					   <div class="col-md-6 form-group">
        					       <button type="submit" class="btn btn-success">Save</button>
        					       <a href="<?= admin_url('careplan_assign')?>" class="btn btn-warning">Cancel</a>
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
		initDataTable('.table-careplan_assign', window.location.href, [1], [1]);
	</script>
	<script>
        $(function(){
            <?php
                if(isset($article))
                {
                    ?>
                        appValidateForm($('#careplan_assignForm'),{userid:'required',plan_id:'required'});
                    <?php
                }
                else
                {
                    ?>
                        appValidateForm($('#careplan_assignForm'),{userid:'required',plan_id:'required'});
                    <?php
                }
            ?>
        });
        

        
        <?php
            if($article == '')
            {
                ?>
                    var click = 0;
                   function addMorecareplan_assign()
                    {
                        click++;
                        var html = '';
						
                        html += '<div id="rid'+click+'"><hr>';
						html +='<div class="row">';
    					html += '<div class="col-md-4 form-group">';
        				html +='<?= _l('Title'); ?><span class="text-danger">*</span>';
						html +='<input type="text" required autocomplete="off" class="form-control" name="title[]" required>';
        				html +='</div>';
        				html +='</div>';
                        html += '<div class="row">';
                        html += '<div class="col-md-4 form-group">';
                        html += '<?= _l('Plan'); ?><span class="text-danger">*</span>';
						html += '<input type="file" extension="pdf" accept=".pdf" name="care_planArr[]" required="" class="form-control" placeholder="Upload">';
                        // html += '<select class="form-control selectpicker" data-live-search="true" name="plan_idArr[]" required>';
                        // html += '<option value=""></option>';
                        <?php
        	                // if($care_plan_list)
        	                // {
        	                //     foreach($care_plan_list as $res)
        	                //     {
        	                        ?>
        	                            // html += '<option value="<?// $res->id; ?>"><?// $res->title.' ('.$res->officer.')'; ?></option>';
        	                        <?php
        	                //     }
        	                // }
        	            ?>
                        // html += '</select>';
                        html += '</div>';
                       
                        html += '<div class="col-md-1 form-group"><label>';
                        html += '<?= _l('Remove'); ?>';
                        html += '</label><br><span class="btn btn-danger" style="cursor:pointer;" onClick="remvecareplan_assign('+click+')"><i class="fa fa-trash"></i></span>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        
                        $('.morecareplan_assign').append(html);
                        
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
                    
                    function remvecareplan_assign(rid)
                    {
                        $('#rid'+rid).empty();
                    }
                <?php
            }
        ?>
            
	</script>
</body>
</html>
