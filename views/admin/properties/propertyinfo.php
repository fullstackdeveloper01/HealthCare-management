<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
		    <?= $this->load->view('admin/properties/sidebar');?>
			<div class="col-md-9">
				<div class="panel_s">
    				<div class="panel-body">
    				    <?php
    				        if($article)
    				        {
    				            ?>
    				                <?= form_open(admin_url('properties/addInfo/'.$article->id));  ?> 
    					            <h4 class="customer-profile-group-heading"><?= _l('Edit Property'); ?></h4>
    				            <?php
    				        }
    				        else
    				        {
    				            ?>
    				                <?= form_open(admin_url('properties/addInfo'));  ?> 
    					            <h4 class="customer-profile-group-heading"><?= _l('Add Property'); ?></h4>
    				            <?php
    				        }
    				    ?>
						    <hr class="hr-panel-heading" />
    					    <div class="row form-group">
    					        <div class="col-md-4">
        					       <?= _l('Agent'); ?><span class="text-danger">*</span>
        					       <select name="agent_id" required class="form-control">
        					           <option value=""></option>
            					       <?php
            					            if($agent_list)
            					            {
            					                if(isset($article))
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
            					                    foreach($agent_list as $res)
                					                {
                					                    ?>
                					                        <option value="<?= $res->userid; ?>"><?= $res->firstname.' '.@$res->lastname; ?></option>
                					                    <?php
                					                }  
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
        					    <div class="col-md-4">
        					       <?= _l('Title'); ?><span class="text-danger">*</span>
        					       <input type="text" class="form-control" value="<?= (isset($article))?$article->name:""; ?>" required name="name">
        					    </div>
        					    <div class="col-md-4">
        					       <?= _l('Price'); ?><span class="text-danger">*</span>
        					       <input type="text" class="form-control" value="<?= (isset($article))?$article->price:""; ?>" required name="price">
        					    </div>
        					    <div class="col-md-4 hide">
        					       <?= _l('SqFit Price'); ?><span class="text-danger">*</span>
        					       <input type="text" class="form-control" value="<?= (isset($article))?$article->sqfit_price:""; ?>" name="sqfit_price">
        					    </div>
    					    </div>
    					    <div class="row form-group">
        					    <div class="col-md-4">
        					       <?= _l('Lot Size.'); ?><span class="text-danger">*</span>
        					       <input type="text" class="form-control" value="<?= (isset($article))?$article->plot_sqfit:""; ?>" required name="plot_sqfit">
        					    </div>
        					    <div class="col-md-4">
        					       <?= _l('Sq. Ft.'); ?><span class="text-danger">*</span>
        					       <input type="text" class="form-control" value="<?= (isset($article))?$article->sqfit:""; ?>" required name="sqfit">
        					    </div>
        					     <div class="col-md-4">
        					       <?= _l('Type'); ?><span class="text-danger">*</span>
        					       <!--<input type="text" class="form-control" value="<?= (isset($article))?$article->type:""; ?>" required name="type">-->
        					        <select name="type" class="form-control" id="type" placeholder="Type">
                                        <option value=""></option>
                                        <option value="Condo" <?= (isset($article) && $article->type == 'Condo')?"selected":""; ?>>Condo</option>
                                        <option value="Townhouse" <?= (isset($article) && $article->type == 'Townhouse')?"selected":""; ?>>Townhouse</option>
                                        <option value="Single Family" <?= (isset($article) && $article->type == 'Single Family')?"selected":""; ?>>Single Family</option>
                                        <option value="Multi-Unit" <?= (isset($article) && $article->type == 'Multi-Unit')?"selected":""; ?>>Multi-Unit</option>
                                    </select>
        					    </div>
        				    </div>
        				    <div class="row form-group">
        					    <div class="col-md-4">
        					       <?= _l('Year Built'); ?><span class="text-danger">*</span>
        					       <input type="text" class="form-control" value="<?= (isset($article))?$article->year:""; ?>" required name="year">
        					    </div>
        					    <div class="col-md-4">
        					       <?= _l('Active date'); ?><span class="text-danger">*</span>
        					       <input type="text" class="form-control datepicker" autocomplete="off" value="<?= (isset($article))?$article->active_date:""; ?>" required name="active_date">
        					    </div>
        					    <div class="col-md-4">
    					           <?= _l('Bedrooms'); ?><span class="text-danger">*</span>
        					       <input type="text" class="form-control" value="<?= (isset($article))?$article->bedroom:""; ?>" required name="bedroom"> 
    					        </div>
    					    </div>
    					    <div class="row form-group">
    					        <div class="col-md-4">
    					           <?= _l('Bathrooms'); ?><span class="text-danger">*</span>
        					       <input type="text" class="form-control" value="<?= (isset($article))?$article->bathroom:""; ?>" required name="bathroom"> 
    					        </div>
    					        <div class="col-md-4">
    					            <?= _l('County'); ?><span class="text-danger">*</span>
        					        <input type="text" class="form-control" value="<?= (isset($article))?$article->country:""; ?>" name="country"> 
    					       </div>
    					        <div class="col-md-4">
    					            <?= _l('City'); ?><span class="text-danger">*</span>
        					        <input type="text" class="form-control" value="<?= (isset($article))?$article->city:""; ?>" name="city"> 
    					       </div>
    					        <div class="col-md-4 hide">
    					           <?= _l('Energy efficiency'); ?>
        					       <select name="energy_efficiency" class="form-control" id="energy_efficiency" placeholder="energy efficiency">
                                        <option value=""></option>
                                        <option value="A++" <?= (isset($article) && $article->energy_efficiency == 'A++')?"selected":""; ?>>A++</option>
                                        <option value="A+" <?= (isset($article) && $article->energy_efficiency == 'A+')?"selected":""; ?>>A+</option>
                                        <option value="A" <?= (isset($article) && $article->energy_efficiency == 'A')?"selected":""; ?>>A</option>
                                        <option value="B" <?= (isset($article) && $article->energy_efficiency == 'B')?"selected":""; ?>>B</option>
                                        <option value="C" <?= (isset($article) && $article->energy_efficiency == 'C')?"selected":""; ?>>C</option>
                                        <option value="D" <?= (isset($article) && $article->energy_efficiency == 'D')?"selected":""; ?>>D</option>
                                        <option value="E" <?= (isset($article) && $article->energy_efficiency == 'E')?"selected":""; ?>>E</option>
                                        <option value="F" <?= (isset($article) && $article->energy_efficiency == 'F')?"selected":""; ?>>F</option>
                                        <option value="G" <?= (isset($article) && $article->energy_efficiency == 'G')?"selected":""; ?>>G</option>
                                        <option value="H" <?= (isset($article) && $article->energy_efficiency == 'H')?"selected":""; ?>>H</option>
                                    </select>
    					        </div>
    					    </div>
    					    <div class="row form-group hide">
    					        <div class="col-md-4">
    					           <?= _l('Purpose'); ?>
        					       <select name="purpose" class="form-control" id="purpose" placeholder="Purpose">
                                        <option value=""></option>
                                        <option value="Sale" <?= (isset($article) && $article->purpose == 'Sale')?"selected":""; ?>>Sale</option>
                                        <option value="Rent" <?= (isset($article) && $article->purpose == 'Rent')?"selected":""; ?>>Rent</option>
                                    </select>
    					        </div>
    					        <div class="col-md-4">
    					             <?= _l('Area'); ?>
        					         <!--<input type="text" class="form-control" value="<?= (isset($article))?$article->area:""; ?>" name="year">-->
        					         <select name="area" class="form-control" id="area" placeholder="Area">
        					             <option value=""></option>
                                        <option value="Less than 50m2" <?= (isset($article) && $article->area == 'Less than 50m2')?"selected":""; ?>>Less than 50m2</option>
                                        <option value="50-100m2"<?= (isset($article) && $article->area == '50-100m2')?"selected":""; ?>>50-100m2</option>
                                        <option value="More than 100m2" <?= (isset($article) && $article->area == 'More than 100m2')?"selected":""; ?>>More than 100m2</option>
                                    </select>
    					        </div>
    					        <div class="col-md-4">
    					            <?= _l('Ownership'); ?>
        					        <!--<input type="text" class="form-control" value="<?= (isset($article))?$article->ownership:""; ?>" name="year">-->
        					        <select name="ownership" class="form-control ui-state-valid" id="ownership" placeholder="Ownership">
                                        <option value=""></option>
                                        <option value="Agent" <?= (isset($article) && $article->ownership == 'Agent')?"selected":""; ?>>Agent</option>
                                        <option value="Owner" <?= (isset($article) && $article->ownership == 'Owner')?"selected":""; ?>>Owner</option>
                                        <option value="Builder" <?= (isset($article) && $article->ownership == 'Builder')?"selected":""; ?>>Builder</option>
                                    </select>
    					        </div>
    					    </div>
    					    <div class="row form-group">
    					        <div class="col-md-4">
    					            <?= _l('Zipcode'); ?><span class="text-danger">*</span>
        					        <input type="text" class="form-control" value="<?= (isset($article))?$article->zipcode:""; ?>" name="zipcode"> 
    					       </div>
    					    </div>
    					    <div class="row form-group">
    					        <div class="col-md-6">
        					       <?= _l('Description short'); ?><span class="text-danger">*</span>
        					       <textarea name="short_description" class="form-control" required rows="5"><?= (isset($article))?$article->short_description:""; ?></textarea>
        					    </div>
    					        <div class="col-md-6">
        					       <?= _l('Street Address'); ?><span class="text-danger">*</span>
        					       <textarea name="address" class="form-control" required rows="5"><?= (isset($article))?$article->address:""; ?></textarea>
        					    </div>
        					</div>
        					<div class="row form-group">
    					        <div class="col-md-12">
        					       <?= _l('Description Long'); ?><span class="text-danger">*</span>
        					       <textarea name="description" class="form-control" required rows="5"><?= (isset($article))?$article->description:""; ?></textarea>
        					    </div>
        					</div>
        					<div class="row form-group hide">
        					    <div class="col-md-12">
    					           <h5><?= _l('Outdoor amenities'); ?></h5>
    					           <?php
    					                $amenitiesRes = [];
    					                if(isset($article))
    					                {
    					                    $amenitiesRes = explode(',', $article->amenities);
    					                }
    					                
    					           ?>
    					           <div class="row form-group">
    					               <div class="col-md-2">
    					                   Balcony&nbsp;&nbsp; <input type="checkbox" <?= (in_array('Balcony', $amenitiesRes))?"checked":"";?> value="Balcony" name="amenities[]">
    					               </div>
    					               <div class="col-md-2">
    					                   <p>Lift &nbsp;&nbsp; <input type="checkbox" <?= (in_array('Lift', $amenitiesRes))?"checked":"";?> value="Lift" name="amenities[]"> </p>
    					               </div>
    					               <div class="col-md-2">
    					                   <p>Grill&nbsp;&nbsp;  <input type="checkbox" <?= (in_array('Grill', $amenitiesRes))?"checked":"";?> value="Grill" name="amenities[]"> </p>
    					               </div>
    					               <div class="col-md-2">
    					                   <p>Pool&nbsp;&nbsp;  <input type="checkbox" <?= (in_array('Pool', $amenitiesRes))?"checked":"";?> value="Pool" name="amenities[]"> </p>
    					               </div>
    					               <div class="col-md-2">
    					                   <p>Parking&nbsp;&nbsp;  <input type="checkbox" <?= (in_array('Parking', $amenitiesRes))?"checked":"";?> value="Parking" name="amenities[]"> </p>
    					               </div>
    					           </div>
    					        </div>
        					</div>
        					<div class="row form-group"><hr>
        					    <div class="col-md-2">
        					       <button type="submit" class="btn btn-info">Save Property</button>
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
