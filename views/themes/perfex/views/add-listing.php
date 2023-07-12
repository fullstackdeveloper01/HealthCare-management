<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="panel_s section-heading section-appointmens">
    <div class="panel-body">
        <h4 class="no-margin section-text"><?php echo _l($title); ?></h4>
    </div>
</div>
<divc lass="row">
    <div class="panel_s">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="header-wrap bg-white">
                        <div class="d-flex align-items-center">
                            <div>
                                <h4 class="fw-700 mt-0"><?= $title; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mt-0 mb-0">
            <?php
                $segment = $this->uri->segment(4);
            ?>
            <ul class="nav nav-tabs">
                <li class='<?= ($segment == 1 || $segment == '')?"active":""; ?>'>
                    <a data-toggle="tab" href="#home"><?= _l('Information'); ?></a>
                </li>
                <li class='<?= ($segment == 2)?"active":""; ?>'>
                    <a data-toggle="tab" href="#menu1"><?= _l('Images'); ?></a>
                </li>
                <!--
                <li>
                    <a data-toggle="tab" href="#menu2"><?= _l('Distances'); ?></a>
                </li>
                -->
                <li class='<?= ($segment == 3)?"active":""; ?>'>
                    <a data-toggle="tab" href="#menu3"><?= _l('Documents'); ?></a>
                </li>
            </ul>
            
            <div class="tab-content">
                <div id="home" class="tab-pane fade <?= ($segment == 1 || $segment == '')?"in active":""; ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="stats-wrap p-10 bg-white">
                                <?php
            				        if($article)
            				        {
            				            ?>
            				                <?= form_open(base_url('clients/addListing/'.$article->id));  ?> 
            				            <?php
            				        }
            				        else
            				        {
            				            ?>
            				                <?= form_open(base_url('clients/addListing'));  ?> 
            				            <?php
            				        }
            				    ?>
                                    <div class="row form-group">
                					    <div class="col-md-4">
                					       <?= _l('Title'); ?><span class="text-danger">*</span>
                					       <input type="text" class="form-control" value="<?= (isset($article))?$article->name:""; ?>" required name="name">
                					    </div>
                					    <div class="col-md-4">
                					       <?= DEFAULT_CURRENCY; ?> <?= _l('Price'); ?><span class="text-danger">*</span>
                					       <input type="text" class="form-control" value="<?= (isset($article))?$article->price:""; ?>" required name="price">
                					    </div>
                					    <div style="display:none;" class="col-md-4">
                					      <i class="fa fa-inr" aria-hidden="true"></i> <?= _l('SqFit Price'); ?>
                					       <input type="text" class="form-control" value="<?= (isset($article))?$article->sqfit_price:""; ?>" name="sqfit_price">
                					    </div>
                					    <div class="col-md-4">
                					       <?= _l('Lot Size'); ?><span class="text-danger">*</span>
                					       <input type="text" class="form-control" value="<?= (isset($article))?$article->plot_sqfit:""; ?>" required name="plot_sqfit">
                					    </div>
            					     </div>
            					     <div class="row form-group">
                					    <div class="col-md-4 hide">
                					       <?= _l('Agent'); ?><span class="text-danger">*</span>
                					       <select name="agent_id" disabled class="form-control">
                					           <option value="<?= get_client_user_id(); ?>"><?= get_company_name(get_client_user_id()); ?></option>
                    					   </select>
                					    </div>
                					    
                					    <div class="col-md-4">
                					       <?= _l('Sq. Ft.'); ?><span class="text-danger">*</span>
                					       <input type="text" class="form-control" value="<?= (isset($article))?$article->sqfit:""; ?>" required name="sqfit">
                					    </div>
                					    <div class="col-md-4">
                					       <?= _l('Type'); ?><span class="text-danger">*</span>
                					        <select name="type" class="form-control" id="type" placeholder="Type">
                                                <option value="Condo" <?= (isset($article) && $article->type == 'Condo')?"selected":""; ?>>Condo</option>
                                                <option value="Townhouse" <?= (isset($article) && $article->type == 'Townhouse')?"selected":""; ?>>Townhouse</option>
                                                <option value="Single Family" <?= (isset($article) && $article->type == 'Single Family')?"selected":""; ?>>Single Family</option>
                                                <option value="Multi-Unit" <?= (isset($article) && $article->type == 'Multi-Unit')?"selected":""; ?>>Multi-Unit</option>
                                            </select>
                					    </div>
                					    <div class="col-md-4">
                					       <?= _l('Year Built'); ?><span class="text-danger">*</span>
                					       <input type="text" class="form-control" value="<?= (isset($article))?$article->year:""; ?>" required name="year">
                					    </div>
                				    </div>
                				    <div class="row form-group">
                					    <div class="col-md-4">
                					       <?= _l('Active date'); ?><span class="text-danger">*</span>
                					       <input type="text" class="form-control datepicker" autocomplete="off" value="<?= (isset($article))?$article->active_date:""; ?>" required name="active_date">
                					    </div>
            					        <div class="col-md-4">
            					           <?= _l('Bedrooms'); ?><span class="text-danger">*</span>
                					       <input type="text" class="form-control" value="<?= (isset($article))?$article->bedroom:""; ?>" required name="bedroom"> 
            					        </div>
            					        <div class="col-md-4">
            					           <?= _l('Bathrooms'); ?><span class="text-danger">*</span>
                					       <input type="text" class="form-control" value="<?= (isset($article))?$article->bathroom:""; ?>" required name="bathroom"> 
            					        </div>
            					    </div>
            					    <div class="row form-group hide">
            					        
            					        <div style="display:none;">
                					        <div class="col-md-4">
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
                					        <div class="col-md-4">
                					           <?= _l('Purpose'); ?>
                    					       <select name="purpose" class="form-control" id="purpose" placeholder="Purpose">
                                                    <option value=""></option>
                                                    <option value="Sale" <?= (isset($article) && $article->purpose == 'Sale')?"selected":""; ?>>Sale</option>
                                                    <option value="Rent" <?= (isset($article) && $article->purpose == 'Rent')?"selected":""; ?>>Rent</option>
                                                </select>
                					        </div>
            					        </div>
            					    </div>
            					    <div class="row form-group hide">
            					        <div style="display:none;">
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
            					    </div>
            					    <div class="row form-group">
            					        <div class="col-md-4">
            					            <?= _l('County'); ?><span class="text-danger">*</span>
                					        <input type="text" class="form-control" value="<?= (isset($article))?$article->country:""; ?>" required name="country"> 
            					       </div>
            					        <div class="col-md-4">
            					            <?= _l('City'); ?><span class="text-danger">*</span>
                					        <input type="text" class="form-control" value="<?= (isset($article))?$article->city:""; ?>" required name="city"> 
            					       </div>
            					        <div class="col-md-4">
            					            <?= _l('Zipcode'); ?><span class="text-danger">*</span>
                					        <input type="text" class="form-control" value="<?= (isset($article))?$article->zipcode:""; ?>" required name="zipcode"> 
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
                					<?php
                					    $propertylist = '';
                					    $setDateArr = [];
                					    $setSlot = '';
                					    $setTimearr = [];
                					    if(isset($article))
                					    {
                					        $propertylist = $this->db->get_where(db_prefix().'property_calender', array('property_id' => $article->id))->row();
                    					    $setTime = $propertylist->setTime;
                    					    $setDateArr = explode(',', $propertylist->setDay);
                    					    $setSlot = $propertylist->timeSlot;
                    					    $setTimearr = explode(',', $setTime);
                					    }
                					?>
                					<div class="row form-group">
            					        <div class="col-md-4">
            					            <?= _l('Days'); ?><span class="text-danger">*</span>
                					        <select class="form-control" data-live-search="true" name="setDay[]" multiple required>
                					            <option <?= (in_array('Monday', $setDateArr)?"selected":""); ?> value="Monday">Monday</option>
                					            <option <?= (in_array('Tuesday', $setDateArr)?"selected":""); ?> value="Tuesday">Tuesday</option>
                					            <option <?= (in_array('Wednesday', $setDateArr)?"selected":""); ?> value="Wednesday">Wednesday</option>
                					            <option <?= (in_array('Thursday', $setDateArr)?"selected":""); ?> value="Thursday">Thursday</option>
                					            <option <?= (in_array('Friday', $setDateArr)?"selected":""); ?> value="Friday">Friday</option>
                					            <option <?= (in_array('Saturday', $setDateArr)?"selected":""); ?> value="Saturday">Saturday</option>
                					            <option <?= (in_array('Sunday', $setDateArr)?"selected":""); ?> value="Sunday">Sunday</option>
                					        </select>
            					       </div>
            					        <div class="col-md-4">
            					            <?= _l('Time Slot'); ?><span class="text-danger">*</span>
                					        <select class="form-control" data-live-search="true" name="timeSlot" onChange="selecttimeslot(this.value)" required>
                					            <option <?= ($setSlot == 1)?"selected":""; ?> value="1">1 Hour</option>
                					            <option <?= ($setSlot == 2)?"selected":""; ?>  value="2">30 Minutes</option>
                					        </select>
            					       </div>
            					        <div class="col-md-4">
            					            <?= _l('Time'); ?><span class="text-danger">*</span>
            					            <div class="utime">
            					                <select class="form-control" data-live-search="true" name="setTime[]" multiple required>
                    					            <?php
                    					                if(isset($article))
                    					                {
                    					                    if($setSlot == 1)
                    					                    {
                    					                        ?>
                    					                            <option <?= (in_array('07:00am - 08:00am', $setTimearr)?"selected":""); ?> value="07:00am - 08:00am">07:00am - 08:00am</option>
                                                                    <option <?= (in_array('08:00am - 09:00am', $setTimearr)?"selected":""); ?> value="08:00am - 09:00am">08:00am - 09:00am</option>
                                                                    <option <?= (in_array('09:00am - 10:00am', $setTimearr)?"selected":""); ?> value="09:00am - 10:00am">09:00am - 10:00am</option>
                                                                    <option <?= (in_array('10:00am - 11:00am', $setTimearr)?"selected":""); ?> value="10:00am - 11:00am">10:00am - 11:00am</option>
                                                                    <option <?= (in_array('11:00am - 12:00pm', $setTimearr)?"selected":""); ?> value="11:00am - 12:00pm">11:00am - 12:00pm</option>
                                                                    <option <?= (in_array('12:00pm - 01:00pm', $setTimearr)?"selected":""); ?> value="12:00pm - 01:00pm">12:00pm - 01:00pm</option>
                                                                    <option <?= (in_array('01:00pm - 02:00pm', $setTimearr)?"selected":""); ?> value="01:00pm - 02:00pm">01:00pm - 02:00pm</option>
                                                                    <option <?= (in_array('02:00pm - 03:00pm', $setTimearr)?"selected":""); ?> value="02:00pm - 03:00pm">02:00pm - 03:00pm</option>
                                                                    <option <?= (in_array('03:00pm - 04:00pm', $setTimearr)?"selected":""); ?> value="03:00pm - 04:00pm">03:00pm - 04:00pm</option>
                                                                    <option <?= (in_array('04:00pm - 05:00pm', $setTimearr)?"selected":""); ?> value="04:00pm - 05:00pm">04:00pm - 05:00pm</option>
                                                                    <option <?= (in_array('05:00pm - 06:00pm', $setTimearr)?"selected":""); ?> value="05:00pm - 06:00pm">05:00pm - 06:00pm</option>
                                                                    <option <?= (in_array('06:00pm - 07:00pm', $setTimearr)?"selected":""); ?> value="06:00pm - 07:00pm">06:00pm - 07:00pm</option>
                                                                    <option <?= (in_array('07:00pm - 08:00pm', $setTimearr)?"selected":""); ?> value="07:00pm - 08:00pm">07:00pm - 08:00pm</option>
                    					                        <?php
                    					                    }
                    					                    else
                    					                    {
                    					                        ?>
                    					                            <option <?= (in_array('07:00am - 07:30am', $setTimearr)?"selected":""); ?> value="07:00am - 07:30am">07:00am - 07:30am</option>
                                                                    <option <?= (in_array('07:30am - 08:00am', $setTimearr)?"selected":""); ?> value="07:30am - 08:00am">07:30am - 08:00am</option>
                                                                    <option <?= (in_array('08:00am - 08:30am', $setTimearr)?"selected":""); ?> value="08:00am - 08:30am">08:00am - 08:30am</option>
                                                                    <option <?= (in_array('08:30am - 09:00am', $setTimearr)?"selected":""); ?> value="08:30am - 09:00am">08:30am - 09:00am</option>
                                                                    <option <?= (in_array('09:00am - 09:30am', $setTimearr)?"selected":""); ?> value="09:00am - 09:30am">09:00am - 09:30am</option>
                                                                    <option <?= (in_array('09:30am - 10:00am', $setTimearr)?"selected":""); ?> value="09:30am - 10:00am">09:30am - 10:00am</option>
                                                                    <option <?= (in_array('10:00am - 10:30am', $setTimearr)?"selected":""); ?> value="10:00am - 10:30am">10:00am - 10:30am</option>
                                                                    <option <?= (in_array('10:30am - 11:00am', $setTimearr)?"selected":""); ?> value="10:30am - 11:00am">10:30am - 11:00am</option>
                                                                    <option <?= (in_array('11:00am - 11:30am', $setTimearr)?"selected":""); ?> value="11:00am - 11:30am">11:00am - 11:30am</option>
                                                                    <option <?= (in_array('11:30am - 12:00pm', $setTimearr)?"selected":""); ?> value="11:30am - 12:00pm">11:30am - 12:00pm</option>
                                                                    <option <?= (in_array('12:00pm - 12:30pm', $setTimearr)?"selected":""); ?> value="12:00pm - 12:30pm">12:00pm - 12:30pm</option>
                                                                    <option <?= (in_array('12:30pm - 01:00pm', $setTimearr)?"selected":""); ?> value="12:30pm - 01:00pm">12:30pm - 01:00pm</option>
                                                                    <option <?= (in_array('01:00pm - 01:30pm', $setTimearr)?"selected":""); ?> value="01:00pm - 01:30pm">01:00pm - 01:30pm</option>
                                                                    <option <?= (in_array('01:30pm - 02:00pm', $setTimearr)?"selected":""); ?> value="01:30pm - 02:00pm">01:30pm - 02:00pm</option>
                                                                    <option <?= (in_array('02:00pm - 02:30pm', $setTimearr)?"selected":""); ?> value="02:00pm - 02:30pm">02:00pm - 02:30pm</option>
                                                                    <option <?= (in_array('02:30pm - 03:00pm', $setTimearr)?"selected":""); ?> value="02:30pm - 03:00pm">02:30pm - 03:00pm</option>
                                                                    <option <?= (in_array('03:00pm - 03:30pm', $setTimearr)?"selected":""); ?> value="03:00pm - 03:30pm">03:00pm - 03:30pm</option>
                                                                    <option <?= (in_array('03:30pm - 04:00pm', $setTimearr)?"selected":""); ?> value="03:30pm - 04:00pm">03:30pm - 04:00pm</option>
                                                                    <option <?= (in_array('04:00pm - 04:30pm', $setTimearr)?"selected":""); ?> value="04:00pm - 04:30pm">04:00pm - 04:30pm</option>
                                                                    <option <?= (in_array('04:30pm - 05:00pm', $setTimearr)?"selected":""); ?> value="04:30pm - 05:00pm">04:30pm - 05:00pm</option>
                                                                    <option <?= (in_array('05:00pm - 05:30pm', $setTimearr)?"selected":""); ?> value="05:00pm - 05:30pm">05:00pm - 05:30pm</option>
                                                                    <option <?= (in_array('05:30pm - 06:00pm', $setTimearr)?"selected":""); ?> value="05:30pm - 06:00pm">05:30pm - 06:00pm</option>
                                                                    <option <?= (in_array('06:00pm - 06:30pm', $setTimearr)?"selected":""); ?> value="06:00pm - 06:30pm">06:00pm - 06:30pm</option>
                                                                    <option <?= (in_array('06:30pm - 07:00pm', $setTimearr)?"selected":""); ?> value="06:30pm - 07:00pm">06:30pm - 07:00pm</option>
                                                                    <option <?= (in_array('07:00pm - 07:30pm', $setTimearr)?"selected":""); ?> value="07:00pm - 07:30pm">07:00pm - 07:30pm</option>
                                                                    <option <?= (in_array('07:30pm - 08:00pm', $setTimearr)?"selected":""); ?> value="07:30pm - 08:00pm">07:30pm - 08:00pm</option>
                    					                        <?php
                    					                    }
                    					                }
                    					                else
                    					                {
                    					                    ?>
                    					                        <option value="07:00am - 08:00am">07:00am - 08:00am</option>
                                                                <option value="08:00am - 09:00am">08:00am - 09:00am</option>
                                                                <option value="09:00am - 10:00am">09:00am - 10:00am</option>
                                                                <option value="10:00am - 11:00am">10:00am - 11:00am</option>
                                                                <option value="11:00am - 12:00pm">11:00am - 12:00pm</option>
                                                                <option value="12:00pm - 01:00pm">12:00pm - 01:00pm</option>
                                                                <option value="01:00pm - 02:00pm">01:00pm - 02:00pm</option>
                                                                <option value="02:00pm - 03:00pm">02:00pm - 03:00pm</option>
                                                                <option value="03:00pm - 04:00pm">03:00pm - 04:00pm</option>
                                                                <option value="04:00pm - 05:00pm">04:00pm - 05:00pm</option>
                                                                <option value="05:00pm - 06:00pm">05:00pm - 06:00pm</option>
                                                                <option value="06:00pm - 07:00pm">06:00pm - 07:00pm</option>
                                                                <option value="07:00pm - 08:00pm">07:00pm - 08:00pm</option>
                    					                    <?php
                    					                }
                    					            ?>
                    					            <?php
                    					               /* if($setTimeArr)
                    					                {
                    					                    if($setSlot == 1)
                    					                    {
                    					                        ?>
                        					                        <option <?= (in_array('07:00am - 08:00am', $setTimearr)?"selected":""); ?> value="07:00am - 08:00am">07:00am - 08:00am</option>
                                                                    <option <?= (in_array('08:00am - 09:00am', $setTimearr)?"selected":""); ?> value="08:00am - 09:00am">08:00am - 09:00am</option>
                                                                    <option <?= (in_array('09:00am - 10:00am', $setTimearr)?"selected":""); ?> value="09:00am - 10:00am">09:00am - 10:00am</option>
                                                                    <option <?= (in_array('10:00am - 11:00am', $setTimearr)?"selected":""); ?> value="10:00am - 11:00am">10:00am - 11:00am</option>
                                                                    <option <?= (in_array('11:00am - 12:00pm', $setTimearr)?"selected":""); ?> value="11:00am - 12:00pm">11:00am - 12:00pm</option>
                                                                    <option <?= (in_array('12:00pm - 01:00pm', $setTimearr)?"selected":""); ?> value="12:00pm - 01:00pm">12:00pm - 01:00pm</option>
                                                                    <option <?= (in_array('01:00pm - 02:00pm', $setTimearr)?"selected":""); ?> value="01:00pm - 02:00pm">01:00pm - 02:00pm</option>
                                                                    <option <?= (in_array('02:00pm - 03:00pm', $setTimearr)?"selected":""); ?> value="02:00pm - 03:00pm">02:00pm - 03:00pm</option>
                                                                    <option <?= (in_array('03:00pm - 04:00pm', $setTimearr)?"selected":""); ?> value="03:00pm - 04:00pm">03:00pm - 04:00pm</option>
                                                                    <option <?= (in_array('04:00pm - 05:00pm', $setTimearr)?"selected":""); ?> value="04:00pm - 05:00pm">04:00pm - 05:00pm</option>
                                                                    <option <?= (in_array('05:00pm - 06:00pm', $setTimearr)?"selected":""); ?> value="05:00pm - 06:00pm">05:00pm - 06:00pm</option>
                                                                    <option <?= (in_array('06:00pm - 07:00pm', $setTimearr)?"selected":""); ?> value="06:00pm - 07:00pm">06:00pm - 07:00pm</option>
                                                                    <option <?= (in_array('07:00pm - 08:00pm', $setTimearr)?"selected":""); ?> value="07:00pm - 08:00pm">07:00pm - 08:00pm</option>
                        					                    <?php
                    					                    }
                    					                    else
                    					                    {
                    					                        ?>
                        					                        <option <?= (in_array('07:00am - 07:30am', $setTimearr)?"selected":""); ?> value="07:00am - 07:30am">07:00am - 07:30am</option>
                                                                    <option <?= (in_array('07:30am - 08:00am', $setTimearr)?"selected":""); ?> value="07:30am - 08:00am">07:30am - 08:00am</option>
                                                                    <option <?= (in_array('08:00am - 08:30am', $setTimearr)?"selected":""); ?> value="08:00am - 08:30am">08:00am - 08:30am</option>
                                                                    <option <?= (in_array('08:30am - 09:00am', $setTimearr)?"selected":""); ?> value="08:30am - 09:00am">08:30am - 09:00am</option>
                                                                    <option <?= (in_array('09:00am - 09:30am', $setTimearr)?"selected":""); ?> value="09:00am - 09:30am">09:00am - 09:30am</option>
                                                                    <option <?= (in_array('09:30am - 10:00am', $setTimearr)?"selected":""); ?> value="09:30am - 10:00am">09:30am - 10:00am</option>
                                                                    <option <?= (in_array('10:00am - 10:30am', $setTimearr)?"selected":""); ?> value="10:00am - 10:30am">10:00am - 10:30am</option>
                                                                    <option <?= (in_array('10:30am - 11:00am', $setTimearr)?"selected":""); ?> value="10:30am - 11:00am">10:30am - 11:00am</option>
                                                                    <option <?= (in_array('11:00am - 11:30am', $setTimearr)?"selected":""); ?> value="11:00am - 11:30am">11:00am - 11:30am</option>
                                                                    <option <?= (in_array('11:30am - 12:00pm', $setTimearr)?"selected":""); ?> value="11:30am - 12:00pm">11:30am - 12:00pm</option>
                                                                    <option <?= (in_array('12:00pm - 12:30pm', $setTimearr)?"selected":""); ?> value="12:00pm - 12:30pm">12:00pm - 12:30pm</option>
                                                                    <option <?= (in_array('12:30pm - 01:00pm', $setTimearr)?"selected":""); ?> value="12:30pm - 01:00pm">12:30pm - 01:00pm</option>
                                                                    <option <?= (in_array('01:00pm - 01:30pm', $setTimearr)?"selected":""); ?> value="01:00pm - 01:30pm">01:00pm - 01:30pm</option>
                                                                    <option <?= (in_array('01:30pm - 02:00pm', $setTimearr)?"selected":""); ?> value="01:30pm - 02:00pm">01:30pm - 02:00pm</option>
                                                                    <option <?= (in_array('02:00pm - 02:30pm', $setTimearr)?"selected":""); ?> value="02:00pm - 02:30pm">02:00pm - 02:30pm</option>
                                                                    <option <?= (in_array('02:30pm - 03:00pm', $setTimearr)?"selected":""); ?> value="02:30pm - 03:00pm">02:30pm - 03:00pm</option>
                                                                    <option <?= (in_array('03:00pm - 03:30pm', $setTimearr)?"selected":""); ?> value="03:00pm - 03:30pm">03:00pm - 03:30pm</option>
                                                                    <option <?= (in_array('03:30pm - 04:00pm', $setTimearr)?"selected":""); ?> value="03:30pm - 04:00pm">03:30pm - 04:00pm</option>
                                                                    <option <?= (in_array('04:00pm - 04:30pm', $setTimearr)?"selected":""); ?> value="04:00pm - 04:30pm">04:00pm - 04:30pm</option>
                                                                    <option <?= (in_array('04:30pm - 05:00pm', $setTimearr)?"selected":""); ?> value="04:30pm - 05:00pm">04:30pm - 05:00pm</option>
                                                                    <option <?= (in_array('05:00pm - 05:30pm', $setTimearr)?"selected":""); ?> value="05:00pm - 05:30pm">05:00pm - 05:30pm</option>
                                                                    <option <?= (in_array('05:30pm - 06:00pm', $setTimearr)?"selected":""); ?> value="05:30pm - 06:00pm">05:30pm - 06:00pm</option>
                                                                    <option <?= (in_array('06:00pm - 06:30pm', $setTimearr)?"selected":""); ?> value="06:00pm - 06:30pm">06:00pm - 06:30pm</option>
                                                                    <option <?= (in_array('06:30pm - 07:00pm', $setTimearr)?"selected":""); ?> value="06:30pm - 07:00pm">06:30pm - 07:00pm</option>
                                                                    <option <?= (in_array('07:00pm - 07:30pm', $setTimearr)?"selected":""); ?> value="07:00pm - 07:30pm">07:00pm - 07:30pm</option>
                                                                    <option <?= (in_array('07:30pm - 08:00pm', $setTimearr)?"selected":""); ?> value="07:30pm - 08:00pm">07:30pm - 08:00pm</option>
                        					                    <?php
                    					                    }
                    					                } */
                    					            ?>
                    					        </select>
            					            </div>
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
                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-info"><?= (isset($article))?"Update":"Add";?> listing</button>
                                            <button type="button" class="btn btn-danger">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    if(isset($article))
                    {
                        ?>
                            <div id="menu1" class="tab-pane fade <?= ($segment == 2)?"in active":""; ?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="stats-wrap p-10 bg-white">
                                            <?= form_open_multipart(base_url('clients/updateImg/'.$article->id));  ?> 
                                                <div class="row form-group">
                        					        <div class="col-md-2">
                            					       <!--<?= _l('Selected'); ?><br>-->
                            					       <?php $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => "propertyimg"))->row(); ?>
                            					       <img src="<?= site_url('download/file/taskattachment/'. $imageArray->attachment_key); ?>" alt="<?= $imageArray->attachment_key; ?>" width="100px" height="100px" /><br>
                            					       <?php
                            					            if($imageArray)
                            					            {
                            					                ?>
                            					                    <input type="radio" name="defaultimg" value="1" <?= ($article->defaultimage == 1 || $article->defaultimage == '')?"checked":""; ?>> Default Image
                            					                <?php
                            					            }
                            					            else
                            					            {
                            					                ?>
                            					                    <input type="radio" name="defaultimg" value="1" checked> Default Image
                            					                <?php
                            					            }
                            					       ?>
                            					       <input type="text" class="hide" name="id" value="<?= $article->id; ?>">
                            					    </div>
                        					        <div class="col-md-4">
                            					       <?= _l('Image 1'); ?>
                            					       <input type="file" class="form-control" name="propertyimg">
                            					    </div>
                            				    </div>
                            				    <div class="row form-group">
                            					    <div class="col-md-2">
                            					       <!--<?= _l('Selected'); ?>-->
                            					       <?php $imageArray1 = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => "property1"))->row(); ?>
                            					       <img src="<?= site_url('download/file/taskattachment/'. $imageArray1->attachment_key); ?>" alt="<?= $imageArray1->attachment_key; ?>" width="100px" height="100px" /><br>
                            					       <?php
                            					            if($imageArray1)
                            					            {
                            					                ?>
                            					                    <input type="radio" name="defaultimg" value="2" <?= ($article->defaultimage == 2)?"checked":""; ?>> Default Image
                            					                <?php
                            					            }
                            					       ?>
                            					    </div>
                            					    <div class="col-md-4">
                            					       <?= _l('Image 2'); ?>
                            					       <input type="file" class="form-control" name="property1">
                            					    </div>
                            					</div>
                            				    <div class="row form-group">
                            					    <div class="col-md-2">
                            					       <!--<?= _l('Selected'); ?>-->
                            					       <?php $imageArray2 = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => "property2"))->row(); ?>
                            					       <img src="<?= site_url('download/file/taskattachment/'. $imageArray2->attachment_key); ?>" alt="<?= $imageArray2->attachment_key; ?>" width="100px" height="100px" /><br>
                            					       <?php
                            					            if($imageArray2)
                            					            {
                            					                ?>
                            					                    <input type="radio" name="defaultimg" value="3" <?= ($article->defaultimage == 3)?"checked":""; ?>> Default Image
                            					                <?php
                            					            }
                            					       ?>
                            					    </div>
                            					    <div class="col-md-4">
                            					       <?= _l('Image 3'); ?>
                            					       <input type="file" class="form-control" name="property2">
                            					    </div>
                            					</div>
                            				    <div class="row form-group">
                            					    <div class="col-md-2">
                            					       <!--<?= _l('Selected'); ?>-->
                            					       <?php $imageArray3 = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => "property3"))->row(); ?>
                            					       <img src="<?= site_url('download/file/taskattachment/'. $imageArray3->attachment_key); ?>" alt="<?= $imageArray3->attachment_key; ?>" width="100px" height="100px" /><br>
                            					       <?php
                            					            if($imageArray3)
                            					            {
                            					                ?>
                            					                    <input type="radio" name="defaultimg" value="4" <?= ($article->defaultimage == 4)?"checked":""; ?>> Default Image
                            					                <?php
                            					            }
                            					       ?>
                            					    </div>
                            					    <div class="col-md-4">
                            					       <?= _l('Image 4'); ?>
                            					       <input type="file" class="form-control" name="property3">
                            					    </div>
                            					</div>
                            				    <div class="row form-group">
                            					    <div class="col-md-2">
                            					       <!--<?= _l('Selected'); ?>-->
                            					       <?php $imageArray4 = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => "property4"))->row(); ?>
                            					       <img src="<?= site_url('download/file/taskattachment/'. $imageArray4->attachment_key); ?>" alt="<?= $imageArray4->attachment_key; ?>" width="100px" height="100px" /><br>
                            					       <?php
                            					            if($imageArray4)
                            					            {
                            					                ?>
                            					                    <input type="radio" name="defaultimg" value="5"  <?= ($article->defaultimage == 5)?"checked":""; ?>> Default Image
                            					                <?php
                            					            }
                            					       ?>
                            					    </div>
                            					    <div class="col-md-4">
                            					       <?= _l('Image 5'); ?>
                            					       <input type="file" class="form-control" name="property4">
                            					    </div>
                            					</div>
                            				    <div class="row form-group">
                            					    <div class="col-md-2">
                            					       <!--<?= _l('Selected'); ?>-->
                            					       <?php $imageArray5 = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => "property5"))->row(); ?>
                            					       <img src="<?= site_url('download/file/taskattachment/'. $imageArray5->attachment_key); ?>" alt="<?= $imageArray5->attachment_key; ?>" width="100px" height="100px" /><br>
                            					       <?php
                            					            if($imageArray5)
                            					            {
                            					                ?>
                            					                    <input type="radio" name="defaultimg" value="6"  <?= ($article->defaultimage == 6)?"checked":""; ?>> Default Image
                            					                <?php
                            					            }
                            					       ?>
                            					    </div>
                            					    <div class="col-md-4">
                            					       <?= _l('Image 6'); ?>
                            					       <input type="file" class="form-control" name="property5">
                            					    </div>
                            					</div>
                            					<div class="row form-group"><hr>
                            					    <div class="col-md-2">
                            					       <button type="submit" class="btn btn-info">Save Images</button>
                            					    </div>
                            					</div>
                            				</form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="stats-wrap p-10 bg-white">
                                            <?= form_open(base_url('clients/distances/'.$article->id));  ?> 
                                                <div class="row form-group">
                            					    <div class="col-md-4">
                            					       <?= _l('Beach'); ?>
                            					       <input type="text" class="form-control" value="<?= (isset($article))?$article->Beach:""; ?>" required name="Beach">
                            					    </div>
                            					    <div class="col-md-4">
                            					       <?= _l('Train'); ?>
                            					       <input type="text" class="form-control" value="<?= (isset($article))?$article->Train:""; ?>" required name="Train">
                            					    </div>
                            					    <div class="col-md-4">
                            					       <?= _l('Metro'); ?>
                            					       <input type="text" class="form-control" value="<?= (isset($article))?$article->Metro:""; ?>" required name="Metro">
                            					    </div>
                        					     </div>
                        					     <div class="row form-group">
                            					    <div class="col-md-4">
                            					       <?= _l('Bus'); ?>
                            					       <input type="text" class="form-control" value="<?= (isset($article))?$article->Bus:""; ?>" required name="Bus">
                            					    </div>
                            					    <div class="col-md-4">
                            					       <?= _l('Pharmacies'); ?>
                            					       <input type="text" class="form-control" value="<?= (isset($article))?$article->Pharmacies:""; ?>" required name="Pharmacies">
                            					    </div>
                            					    <div class="col-md-4">
                            					       <?= _l('Bakery'); ?>
                            					       <input type="text" class="form-control" value="<?= (isset($article))?$article->Bakery:""; ?>" required name="Bakery">
                            					    </div>
                        					     </div>
                        					     <div class="row form-group">
                            					    <div class="col-md-4">
                            					       <?= _l('Restourant'); ?>
                            					       <input type="text" class="form-control" value="<?= (isset($article))?$article->Restourant:""; ?>" required name="Restourant">
                            					    </div>
                            					    <div class="col-md-4">
                            					       <?= _l('Coffee shop'); ?>
                            					       <input type="text" class="form-control" value="<?= (isset($article))?$article->Coffee_shop:""; ?>" required name="Coffee_shop">
                            					    </div>
                        					     </div>
                            					<div class="row form-group"><hr>
                            					    <div class="col-md-2">
                            					       <button type="submit" class="btn btn-info">Update Distances</button>
                            					    </div>
                            					</div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="menu3" class="tab-pane fade <?= ($segment == 3)?"in active":""; ?>">
                                 <div class="row">
                                    <div class="col-md-12">
                                        <div class="stats-wrap p-10 bg-white">
                                            <?= form_open(base_url('clients/updateDoc/'.$article->id));  ?> 
                        					    <div class="row form-group">
                            					    <div class="col-md-4">
                            					       <?= _l('Title'); ?>
                            					       <input type="text" class="form-control" required  name="title">
                            					       <input type="text" class="hide" name="property_id" value="<?= $article->id; ?>">
                            					    </div>
                            					    <div class="col-md-8">
                            					       <?= _l('Description'); ?><span class="text-danger">*</span>
                            					       <textarea name="description" class="form-control" rows="3" required></textarea>
                            					    </div>
                        					    </div>
                        					    <div class="row form-group">
                            					    <div class="col-md-1">
                            					       <?= _l('Required'); ?>
                            					       <input type="checkbox"  name="required" value="1" />
                            					    </div>
                            					    <div class="col-md-4">
                            					       <button type="submit" class="btn btn-info">Save Document</button>
                            					    </div>
                        					    </div>
                        				    </form><hr>
                        				    <div class="row form-group">
                        				        <div class="col-md-12">
                        				            <table class="table dt-table table-doc" data-order-col="1" data-order-type="desc">
                                                        <thead>
                                                            <tr>
                                                                <th class="th-doc-title"><?php echo _l('Title'); ?></th>
                                                                <th class="th-doc-size"><?php echo _l('Required'); ?></th>
                                                                <th class="th-doc-size"><?php echo _l('Description'); ?></th>
                                                                <th class="th-doc-date"><?php echo _l('Created Deate'); ?></th>
                                                                <th class="th-doc-date"><?php echo _l('Action'); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach($document_result as $res){ ?>
                                                            <tr id="remove_<?= $res->id; ?>">
                                                                <td>
                                                                    <?= $res->title; ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                        if($res->required == 1)
                                                                        echo 'Yes';
                                                                        else
                                                                        echo 'No';
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?= $res->description; ?>
                                                                </td>
                                                                <td data-order="<?php echo $res->createddate; ?>"><?php echo _d($res->createddate); ?></td>
                                                                <td onclick="removeDoc(<?= $res->id ?>);" style="cursor:pointer;"><i class="fa fa-trash fa-2x"></i></td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                        				        </div>
                        				    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                ?>
            </div>
       </div>
    </div>
</div>
<script>
    $('.input-group.date').datepicker({format: "dd.mm.yyyy"}); 
    
    /* removeDoc */
    function removeDoc(id)
    {
        var result = confirm("Confirm want to delete?");
        if(result)
        {
            var str = "id="+id+"&"+csrfData['token_name']+"="+csrfData['hash'];
    	    $.ajax({
    	        url: '<?= site_url()?>clients/removeDoc',
    	        type: 'POST',
    	        data: str,
    	        cache: false,
    	        success: function(resp){
    	            $('#remove_'+id).remove();
    	        }
    	    });
        }
    }
    
    function selecttimeslot(val)
    {
        if(val == 1)
        {
            $('.utime').html('<select class="form-control" data-live-search="true" name="setTime[]" multiple required>'
                +'<option value="07:00am - 08:00am">07:00am - 08:00am</option>'+
                '<option value="08:00am - 09:00am">08:00am - 09:00am</option>'
                +'<option value="09:00am - 10:00am">09:00am - 10:00am</option>'
                +'<option value="10:00am - 11:00am">10:00am - 11:00am</option>'
                +'<option value="11:00am - 12:00pm">11:00am - 12:00pm</option>'
                +'<option value="12:00pm - 01:00pm">12:00pm - 01:00pm</option>'
                +'<option value="01:00pm - 02:00pm">01:00pm - 02:00pm</option>'
                +'<option value="02:00pm - 03:00pm">02:00pm - 03:00pm</option>'
                +'<option value="03:00pm - 04:00pm">03:00pm - 04:00pm</option>'
                +'<option value="04:00pm - 05:00pm">04:00pm - 05:00pm</option>'
                +'<option value="05:00pm - 06:00pm">05:00pm - 06:00pm</option>'
                +'<option value="06:00pm - 07:00pm">06:00pm - 07:00pm</option>'
                +'<option value="07:00pm - 08:00pm">07:00pm - 08:00pm</option>'
                +'<select>');
        }
        else
        {
            $('.utime').html('<select class="form-control" data-live-search="true" name="setTime[]" multiple required>'
                +'<option value="07:00am - 07:30am">07:00am - 07:30am</option>'
                +'<option value="07:30am - 08:00am">07:30am - 08:00am</option>'
                +'<option value="08:00am - 08:30am">08:00am - 08:30am</option>'
                +'<option value="08:30am - 09:00am">08:30am - 09:00am</option>'
                +'<option value="09:00am - 09:30am">09:00am - 09:30am</option>'
                +'<option value="09:30am - 10:00am">09:30am - 10:00am</option>'
                +'<option value="10:00am - 10:30am">10:00am - 10:30am</option>'
                +'<option value="10:30am - 11:00am">10:30am - 11:00am</option>'
                +'<option value="11:00am - 11:30am">11:00am - 11:30am</option>'
                +'<option value="11:30am - 12:00pm">11:30am - 12:00pm</option>'
                +'<option value="12:00pm - 12:30pm">12:00pm - 12:30pm</option>'
                +'<option value="12:30pm - 01:00pm">12:30pm - 01:00pm</option>'
                +'<option value="01:00pm - 01:30pm">01:00pm - 01:30pm</option>'
                +'<option value="01:30pm - 02:00pm">01:30pm - 02:00pm</option>'
                +'<option value="02:00pm - 02:30pm">02:00pm - 02:30pm</option>'
                +'<option value="02:30pm - 03:00pm">02:30pm - 03:00pm</option>'
                +'<option value="03:00pm - 03:30pm">03:00pm - 03:30pm</option>'
                +'<option value="03:30pm - 04:00pm">03:30pm - 04:00pm</option>'
                +'<option value="04:00pm - 04:30pm">04:00pm - 04:30pm</option>'
                +'<option value="04:30pm - 05:00pm">04:30pm - 05:00pm</option>'
                +'<option value="05:00pm - 05:30pm">05:00pm - 05:30pm</option>'
                +'<option value="05:30pm - 06:00pm">05:30pm - 06:00pm</option>'
                +'<option value="06:00pm - 06:30pm">06:00pm - 06:30pm</option>'
                +'<option value="06:30pm - 07:00pm">06:30pm - 07:00pm</option>'
                +'<option value="07:00pm - 07:30pm">07:00pm - 07:30pm</option>'
                +'<option value="07:30pm - 08:00pm">07:30pm - 08:00pm</option></select>');
        }
    }
</script>