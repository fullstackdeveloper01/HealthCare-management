<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
		    <div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
						<h4 class="customer-profile-group-heading"><?= _l($title); ?></h4>
    				    <?= form_open_multipart(admin_url('Careplan_assign_new/add/'.$article->id), array('id' => 'careplan_assignForm'));  ?>
        					<div class="row">
    					       <div class="col-md-4 form-group">
        					       <?= _l('Client'); ?><span class="text-danger">*</span>
								   <?php //echo  "<pre>";print_r($article);die;?>
        					       <select class="form-control selectpicker" data-live-search="true" name="client_id" required>
        					            <option value=""></option>
        					            <?php
        					                if($clients_list)
        					                {
        					                    foreach($clients_list as $res)
        					                    {
        					                        ?>
        					                            <option <?= ($article->client_id == $res->userid)? "selected":""; ?> value="<?= $res->userid; ?>"><?= $res->firstname.' '.$res->lastname; ?></option>
        					                        <?php
        					                    }
        					                }
        					            ?>
        					       </select>
        					   </div>
							</div>
							<div class="row">
							   <div class="col-md-4 form-group">
        					       <?= _l('Title'); ?><span class="text-danger">*</span>
        					       <input type="text" class="form-control" name="title" maxlength="35" value="<?= $article->title; ?>">
        					   </div>
        					   <?php
        					        if($article == '')
        					        {
        					             ?>
        					               <!-- <div class="col-md-4 form-group">
                    					       <p></p>
                    					       <span class="btn btn-info" style="cursor:pointer;" onClick="addMorecareplan_assign()"><i class="fa fa-plus"></i> Add More</span>
                    					   </div>  -->
        					            <?php
        					        }
        					   ?>
    					   </div>
    					   <div class="row">
    					       <div class="col-md-4 form-group">
								   <?php if($article == ''){ ?>
        					       <?= _l('Plan'); ?><span class="text-danger">*</span>
								   <input type="file" extension="pdf" accept=".pdf" name="care_plan" required="" class="form-control" placeholder="Upload">
									<?php }else{ ?>
								   <?php
												//echo $file = $this->db->get_where('tblfiles',['rel_id'=>$value['id']])->row('file_name');
												$filename = $this->db->get_where('tblfiles', array('rel_id' => $article->id, 'rel_type' => 'care_plan'))->row('file_name');
												$filenamelink = base_url().'uploads/care_plan/'.$article->id.'/'.$filename;
											   
									?>
									<label class="col-md-12"><a href="<?php echo $filenamelink; ?>" target="_blank"><?php echo $filename; ?></a></label>
								   <input type="file" extension="pdf" accept=".pdf" name="care_plan" class="form-control" placeholder="Upload">
									<?php }?>
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
        					       <a href="<?= admin_url('careplan_assign_new')?>" class="btn btn-warning">Cancel</a>
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
