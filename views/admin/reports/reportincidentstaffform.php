<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
						<div class="no-margin">
                            <div class="row">
                                 
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        <div class="row mt-20">
                <div class="col-lg-12 col-md-12 co-xs-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered results table-sorter" style="width:100%;">
                                     
                                    <tbody>
                                        <tr class="first-heading" style="background-color:#2480be;-webkit-print-color-adjust: exact; ">
                                            <th colspan="12" style="text-align:center;width:75%;font-weight: 600;color:#ffffff;border: 1px solid #2480be;">HAZARD/NEAR MISSES/INCIDENT/ACCIDENT & INJURY REPORT FORM</th>
                                        </tr>
                                        <tr>
                                            <td colspan="12">All incident/ injuries at workplace involving clients and workers must be reported to the manager/ supervisor
                                                immediately. IN CASE OF AN EMERGENCY DIAL 000. </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12">
                                                Then record- Complete this form and send to Caring Approach on <a href="email:admin@caringapproach.com.au">Email: admin@caringapproach.com.au</a> OR
                                                send via your Smart phone OR visit the office with the completed form within 24 hours. For further
                                                information contact Caring Approach on Ph: 82125659 and refer to the Caring Approach incident Management
                                                policy.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" style="vertical-align:middle;font-weight: 600;">You are reporting about (Please tick) </td>
                                            <td colspan="5">
                                                <?php 
                                                // echo $report_data->report_for;
                                                 $report_for = $report_data->report_for;
                                                // $report_for = explode(",",$report_data->report_for);
                                               
                                                if($report_for=='Hazard')
                                                {
                                                    $hazard='checked';
                                                }
                                                else
                                                {
                                                    $hazard='';
                                                }
                                                if($report_for=='Accident' )
                                                {
                                                    $accident='checked';
                                                }
                                                else
                                                {
                                                    $accident='';
                                                }
                                                if($report_for=='Incident' )
                                                {
                                                    $incident='checked';
                                                }
                                                else
                                                {
                                                    $incident='';
                                                }
                                                if($report_for=='Injury' )
                                                {
                                                    $injury='checked';
                                                }
                                                else
                                                {
                                                    $injury='';
                                                }
                                                
                                                ?>

                                                    <label class="checkbox-inline mr-2 mb-0">
                                                        <input type="checkbox" disabled <?= $hazard; ?> value="hazard"> Hazard & Near misses
                                                    </label>
                                                    <label class="checkbox-inline mr-2 mb-0">
                                                        <input type="checkbox" disabled <?= $accident; ?> value="accident"> Accident 
                                                    </label>
                                                    <label class="checkbox-inline mr-2 mb-0">
                                                        <input type="checkbox" disabled <?= $incident; ?> value="incident"> Incident
                                                    </label>
                                                    <label class="checkbox-inline mr-2 mb-0">
                                                        <input type="checkbox" disabled <?= $injury; ?> value="injury"> Injury
                                                    </label>
                                                
                                            </td>
                                        </tr>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <td colspan="12" style="font-weight: 600;vertical-align:middle;">Reporting Details</td>
                                        </tr>

                                        <tr>
                                            <td colspan="7" style="vertical-align:middle;font-weight: 600;">Name of person(s) completing this report</td>
                                            <td colspan="5">
                                                <input type="text" value='<?= $report_data->pc_name; ?>' readonly class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="vertical-align:middle;font-weight: 600;">Contact Details</td>
                                            <td colspan="3">
                                                <input type="text" value='<?= $report_data->pc_phone; ?>' readonly class="form-control" placeholder="Phone">
                                            </td>
                                            <td colspan="3">
                                                <input type="text" value='<?= $report_data->pc_mobile; ?>' readonly class="form-control" placeholder="Mobile">
                                            </td>
                                            <td colspan="3">
                                                <input type="text" value='<?= $report_data->pc_email; ?>' readonly class="form-control" placeholder="Email">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="vertical-align:middle;font-weight: 600;">Are you Caring Approach Worker? </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                
                                                    <label class="checkbox-inline mr-2 mb-0">
                                                        <input type="radio" disabled  value="yes" <?php if($report_data->ca_worker == 'Yes') { echo 'checked'; }?> > Yes
                                                    </label>
                                                    <label class="checkbox-inline mr-2 mb-0">
                                                        <input type="radio"  disabled value="no" <?php if($report_data->ca_worker == 'No') { echo 'checked'; }?> > No
                                                    </label>
                                                
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;font-weight: 600;">If yes, your Job Title</td>
                                            <td colspan="3">
                                                <input type="text" readonly value='<?= $report_data->ca_worker_title; ?>' class="form-control" placeholder="Job Title">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" rowspan="2" style="vertical-align:middle;font-weight: 600;">Client’s Contact Details</td>
                                            <td colspan="3">
                                                <input type="text" readonly value='<?= $report_data->ccd_name; ?>' class="form-control" placeholder="Name">
                                            </td>
                                            <td colspan="3">
                                                <input type="text"  readonly value='<?= $report_data->ccd_phone; ?>' class="form-control" placeholder="Phone">
                                            </td>
                                            <td colspan="3">
                                                <input type="text" readonly value='<?= $report_data->ccd_mobile; ?>' class="form-control" placeholder="Mobile">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;font-weight: 600;">
                                                <textarea type="text" readonly  rows="3" class="form-control" placeholder="Address"><?= $report_data->ccd_address; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="9" style="vertical-align:middle;font-weight: 600;">Date Report Submitted</td>
                                            <td colspan="3">
                                                <div class="form-group mb-0">
                                                    <div class="input-group p-0">
                                                        <input type='text' value='<?= $report_data->date_report_submitted; ?>'  class="form-control mt-7" readonly placeholder="" >
                                                        
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="9" style="vertical-align:middle;font-weight: 600;">Report Submitted to (Person’s Name)</td>
                                            <td colspan="3">
                                                <input type="text"  readonly  value='<?= $report_data->report_submitted_to; ?>' class="form-control" placeholder="Name">
                                            </td>
                                        </tr>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <td colspan="12" style="font-weight: 600;vertical-align:middle;">Hazard/Accident/Incident Details</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align:middle;font-weight: 600;">(Where occurred) Location</td>
                                            <td colspan="4" style="vertical-align:middle;font-weight: 600;">
                                                <input type="text"  readonly  value='<?= $report_data->accident_location; ?>' class="form-control" placeholder="bathroom/ bedroom etc">
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;">
                                                <div class="form-group mb-0">
                                                    <div class="input-group p-0">
                                                        <input type='text'  readonly  value='<?= $report_data->accident_date; ?>'  class="form-control" placeholder="Hazard/Accident/Incident Date" autofocus="autofocus" autocomplete="off">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="9" rowspan="2">
                                                <textarea type="text" readonly  rows="3" class="form-control mb-0" placeholder="Address"> <?= $report_data->accident_address; ?></textarea>
                                            </td>
                                            <td colspan="3">
                                                Time
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <input type="text" readonly  class="form-control"  value='<?= $report_data->accident_time; ?>'  placeholder="am/pm">
                                            </td>
                                        </tr>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <td colspan="12" style="font-weight: 600;vertical-align:middle;">Details of people involved in the accident/incident (including witnesses present)</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="vertical-align:middle;font-weight: 600;">
                                                Please tick
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;font-weight: 600;">
                                                Name
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;font-weight: 600;">
                                                Location/Address
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;font-weight: 600;">
                                                Contact details ( Ph/M/Email )
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="vertical-align:middle;">
                                               
                                                    <label class="checkbox-inline mr-2 mb-0">
                                                        <input type="checkbox"  disabled  <?php if($report_data->pic == 'true') { echo 'checked'; }?> value="Client"> Client
                                                    </label>
                                                
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input type="text"   readonly value='<?= $report_data->pic_name; ?>'  class="form-control" placeholder="Name">
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input type="text"  readonly  value='<?= $report_data->pic_address; ?>' class="form-control" placeholder="Address">
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input type="text" readonly   value='<?= $report_data->pic_contact; ?>' class="form-control" placeholder="Phone/Mobile/Email">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="vertical-align:middle;">
                                               
                                                    <label class="checkbox-inline mr-2 mb-0">
                                                        <input type="checkbox"  disabled  <?php if($report_data->piw == 'true') { echo 'checked'; }?> value="Worker"> Worker
                                                    </label>
                                               
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input type="text"  readonly value='<?= $report_data->piw_name; ?>'  class="form-control" placeholder="Name">
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input type="text"  readonly value='<?= $report_data->piw_address; ?>'  class="form-control" placeholder="Address">
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input type="text"  readonly value='<?= $report_data->piw_contact; ?>'  class="form-control" placeholder="Phone/Mobile/Email">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="vertical-align:middle;">
                                               
                                                    <label class="checkbox-inline mr-2 mb-0">
                                                        <input type="checkbox" disabled  <?php if($report_data->pio == 'true') { echo 'checked'; }?>  value="Other"> Other (Volunteer/visitor/contractor)
                                                    </label>
                                                
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input type="text"  readonly  value='<?= $report_data->pio_name; ?>' class="form-control" placeholder="Name">
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input type="text"  readonly  value='<?= $report_data->pio_address; ?>' class="form-control" placeholder="Address">
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input type="text"  readonly  value='<?= $report_data->pio_contact; ?>' class="form-control" placeholder="Phone/Mobile/Email">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="vertical-align:middle;">
                                               
                                                    <label class="checkbox-inline mr-2 mb-0">
                                                        <input type="checkbox"  disabled  <?php if($report_data->piwi == 'true') { echo 'checked'; }?> value="Witnesses"> Witnesses
                                                    </label>
                                               
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input type="text" readonly  value='<?= $report_data->piwi_name; ?>'  class="form-control" placeholder="Name">
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input type="text" readonly   value='<?= $report_data->piwi_address; ?>' class="form-control" placeholder="Address">
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input type="text" readonly  value='<?= $report_data->piwi_contact; ?>'  class="form-control" placeholder="Phone/Mobile/Email">
                                            </td>
                                        </tr>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <td colspan="12" style="font-weight: 600;vertical-align:middle;">Incident Details</td>
                                        </tr> 
                                        <tr>
                                            <td colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <textarea type="text" readonly rows="3" class="form-control mb-0" placeholder="(What happened ?, What tasks/job you were you doing? What area of the workplace were working, and What and where is/are the Risk(s)/Hazard(s))?"><?= $report_data->incident_details; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="9" style="vertical-align:middle;font-weight: 600;">Risk Assessment Table: Hazard’s Category (Risks/Hazard’s Colour coding- please Circle)</td>
                                            <td colspan="3">
                                               
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label text-red">
                                                            <input type="radio"  <?php if ($report_data->hazard_category == 'High'){ echo 'checked'; } ?> disabled class="form-check-input"> High
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label text-amber">
                                                            <input type="radio"  <?php if ($report_data->hazard_category == 'Medium'){ echo 'checked'; } ?> disabled class="form-check-input"> Medium 
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label text-green">
                                                            <input type="radio"  <?php if ($report_data->hazard_category == 'Low'){ echo 'checked'; } ?> disabled class="form-check-input"> Low
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="9" style="vertical-align:middle;font-weight: 600;">Has injury occurred?</td>
                                            <td colspan="3">
                                               
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio"   <?php if ($report_data->injury_occurred == 'Yes'){ echo 'checked'; } ?>  disabled  class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio"   <?php if ($report_data->injury_occurred == 'No'){ echo 'checked'; } ?>  disabled  class="form-check-input"> No
                                                            
                                                        </label>
                                                    </div>
                                                    <!-- <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio"   <?php if ($report_data->injury_occurred == 'Unknown'){ echo 'checked'; } ?>  disabled  class="form-check-input"> Unknown
                                                        </label>
                                                    </div> -->
                                                
                                            </td>
                                         </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600;vertical-align:middle;">If YES , injury occurred provide details</td>
                                        </tr> 
                                        <tr>
                                            <td colspan="3" style="font-weight: 600;vertical-align:middle;">
                                                Who is injured
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input type="text"  value='<?= $report_data->who_is_injured; ?>' readonly  placeholder="---" class="form-control">
                                            </td>
                                            <td colspan="3" style="font-weight: 600;vertical-align:middle;">
                                                Where/which part of the body is injured
                                            </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <input type="text" value='<?= $report_data->injured_body; ?>'  readonly  placeholder="---" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" style="vertical-align: middle; font-weight: 600;">First Aid given ?</td>
                                            <td colspan="4">
                                               
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio"   <?php if ($report_data->fag == 'Yes'){ echo 'checked'; } ?>   disabled class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio"   <?php if ($report_data->fag == 'No'){ echo 'checked'; } ?>  disabled class="form-check-input"> No
                                                        </label>
                                                    </div>
                                               
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                If Yes, provide details
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td colspan="8" style="vertical-align: middle; font-weight: 600;">Time First aid given on site</td>
                                            <td colspan="4">
                                                <input type="text"   readonly value='<?= $report_data->fag_time; ?>' class="form-control" placeholder="am/pm">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                Description of First aid given
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <textarea type="text" readonly    rows="3" class="form-control mb-0"><?= $report_data->fag_description; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" style="vertical-align: middle; font-weight: 600;">First aid given by whom</td>
                                            <td colspan="4">
                                                <input type="text"   readonly value='<?= $report_data->fag_by_whom; ?>' class="form-control" placeholder=" Ambulance/doctor/hospital ">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" style="vertical-align: middle; font-weight: 600;">First Aid referral</td>
                                            <td colspan="4">
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio"  <?php if ($report_data->fag_referral == 'Yes'){ echo 'checked'; } ?>  disabled class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio"  <?php if ($report_data->fag_referral == 'No'){ echo 'checked'; } ?>  disabled  class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                If yes, Please specify
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td colspan="12" style="vertical-align:middle;">
                                                <input type="text"  readonly  value='<?= $report_data->fag_specify; ?>' class="form-control" placeholder=" Ambulance/doctor/hospital ">
                                            </td>
                                        </tr>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <td colspan="12" style="font-weight: 600;vertical-align:middle;">Possible Solutions (What actions would you suggest to fix/rectify the problem?</td>
                                        </tr> 
                                        <tr>
                                            <td colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <textarea type="text"  readonly rows="3" class="form-control mb-0"> <?= $report_data->possible_solution; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">Action Plan (what needs to be done and who will fix the issue)</th>
                                        </tr> 
                                        <tr>
                                            <td colspan="2" style="vertical-align:middle;font-weight: 600;">
                                                Action Needed
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;font-weight: 600;">
                                                By When
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;font-weight: 600;">
                                                By Whom
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;font-weight: 600;">
                                                Review Date
                                            </td>
                                            <td colspan="4" style="vertical-align:middle;font-weight: 600;">
                                                Signature
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align:top;">
                                                <input type="text"  readonly value='<?= $report_data->ap_action_needed; ?>'  class="form-control" placeholder="">
                                            </td>
                                            <td colspan="2" style="vertical-align:top;">
                                                <input type="text" readonly  value='<?= $report_data->ap_by_when; ?>'  class="form-control" placeholder="">
                                            </td>
                                            <td colspan="2" style="vertical-align:top;">
                                                <input type="text" readonly  value='<?= $report_data->ap_by_whom; ?>'  class="form-control" placeholder="">
                                            </td>
                                            <td colspan="2" style="vertical-align:top;">
                                                <input type="text"  readonly  value='<?= $report_data->ap_review_date; ?>' class="form-control" placeholder="">
                                            </td>
                                            <td colspan="4" style="vertical-align:top;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Signature</label>
                                                        <!-- <p>Sign in the canvas below and save your signature as an image!</p> -->
                                                        <!-- <canvas id="sig-canvas" width="450" height="100" style="background-color:#fff;">
                                                            Get a better browser, bro.
                                                        </canvas> -->
                                                        <?php if($report_data->ap_signature!=''){ ?>
                                                            <img width="100px" src="<?= $report_data->ap_signature; ?>">
                                                        <?php } if($report_data->ap_signature_base!=''){ ?>
                                                            <img width="100px" src="<?= $report_data->ap_signature_base; ?>">
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                               <!--  <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="d-flex align-items-center">
                                                           
                                                            <button class="btn btn-secondary btn-sm mr-20" id="sig-clearBtn">Clear</button>
                                                            <span class="mr-20">OR</span>
                                                            <input type="file">
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" style="vertical-align: middle;font-weight: 600;">Signature of person completing this report</td>
                                            <td colspan="6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Signature</label>
                                                        <?php if($report_data->spcr_signature!=''){ ?>
                                                            <img width="100px" src="<?= $report_data->spcr_signature; ?>">
                                                        <?php } if($report_data->spcr_signature_base!=''){ ?>
                                                            <img width="100px" src="<?= $report_data->spcr_signature_base; ?>">
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <!-- <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="d-flex align-items-center">
                                                           
                                                            <button class="btn btn-secondary btn-sm mr-20" id="sig-clearBtn">Clear</button>
                                                            <span class="mr-20">OR</span>
                                                            <input type="file">
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <!-- <td colspan="3" style="vertical-align: middle;font-weight: 600;">Name</td> -->
                                            <!-- <td colspan="3">
                                                <input type="text"  readonly  value='<?= $report_data->spcr_name; ?>' placeholder="Phone" class="form-control">
                                            </td>
                                            <td colspan="3" style="vertical-align: middle;font-weight: 600;">Date</td>
                                            <td colspan="3">
                                                <div class="form-group mb-0">
                                                    <div class="datepicker date input-group p-0">
                                                        <input value='<?= $report_data->spcr_date; ?>' type='text' class="form-control" placeholder="Date" readonly  autocomplete="off">
                                                       
                                                    </div>
                                                </div>  
                                            </td> -->
                                        </tr>
                                        <tr class="sub-heading" style="background-color:#eee;">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">Office use only</th>
                                        </tr> 
                                        <tr>
                                            <td colspan="2" style="vertical-align: middle;font-weight: 600;">Date</td>
                                            <td colspan="2">
                                                <div class="form-group mb-0">
                                                    <div class="input-group p-0">
                                                        <input  type="date"  value='<?= $report_data->ou_date; ?>' name="ou_date"  class="form-control">
                                                        <!-- <input  type="date"  value='<?= $report_data->ou_date; ?>' name="ou_date" id="ou_date" class="form-control"   autofocus="autofocus" autocomplete="off"> -->
                                                        <!-- <div class="input-group-addon">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </div> -->
                                                    </div>
                                                </div>  
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;font-weight: 600;">By</td>
                                            <td colspan="2">
                                                <input type="text"    value='<?= $report_data->ou_by; ?>' name="ou_by" id="ou_by"  placeholder="By" class="form-control" minlength="3" maxlength="20" >
                                            </td>
                                            <td colspan="2" style="vertical-align: middle;font-weight: 600;">Job Title</td>
                                            <td colspan="2">
                                                <input type="text"   value='<?= $report_data->ou_job_title; ?>' name="ou_job_title" id="ou_job_title"   minlength="3" maxlength="20"  placeholder="Job title" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;">To be completed by: Manager Health, Safety & Risk for further investigation and recording </th>
                                        </tr>
                                        <tr class="sub-heading">
                                            <td rowspan="2" colspan="2" style="font-weight: 600;vertical-align:middle;background-color:#eee;">Action /Plan</td>
                                            <td colspan="3" style="font-weight: 600;vertical-align:middle;text-align:center;background-color:#eee;">Action required </td>
                                            <td rowspan="2" colspan="2" style="font-weight: 600;vertical-align:middle;background-color:#eee;">Date reported</td>
                                            <td rowspan="2" colspan="2" style="font-weight: 600;vertical-align:middle;background-color:#eee;">Reported to (Event / reference number)</td>
                                            <td rowspan="2" colspan="3" style="font-weight: 600;vertical-align:middle;background-color:#eee;">Comments</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="font-weight: 600;vertical-align:middle;text-align:center;">YES/ NO/ NA</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="font-weight: 600;vertical-align:middle;">1. Investigation completed </td>
                                            <td colspan="3">
                                             
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="ic_action"  value="Yes" <?php if ($report_data->ic_action == 'Yes'){ echo 'checked'; } ?>  class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="ic_action" value="No" <?php if ($report_data->ic_action == 'No'){ echo 'checked'; } ?>  class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="ic_action"   value="NA"  <?php if ($report_data->ic_action == 'NA'){ echo 'checked'; } ?>  class="form-check-input"> NA
                                                        </label>
                                                    </div>
                                               
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <div class="date input-group p-0">
                                                    <input  type="text"  value='<?php if($report_data->ic_date!="null"){echo $report_data->ic_date; }else{echo "dd-mm-yyyy";} ?>' readonly name="ic_date" id="ic_date" placeholder="---" class="form-control">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;"><input    value='<?= $report_data->ic_report_no; ?>' name="ic_report_no" id="ic_report_no" type="text" placeholder="---" class="form-control"  minlength="3" maxlength="40" ></td>
                                            <td colspan="3" style="vertical-align:middle;"><input    value='<?= $report_data->ic_comment; ?>' name="ic_comment" id="ic_comment" type="text" placeholder="---" class="form-control" minlength="3" maxlength="40" ></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="font-weight: 600;vertical-align:middle;">2. CEO informed </td>
                                            <td colspan="3">
                                               
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="ci_action"  value="Yes"  <?php if ($report_data->ci_action == 'Yes'){ echo 'checked'; } ?>  class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="ci_action"   value="No" <?php if ($report_data->ci_action == 'No'){ echo 'checked'; } ?>  class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="ci_action"  value="NA"  <?php if ($report_data->ci_action == 'NA'){ echo 'checked'; } ?>  class="form-check-input"> NA
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <div class="date input-group p-0">
                                                    <input    value='<?php if($report_data->ci_date!="null"){echo $report_data->ci_date;}else{echo "dd-mm-yyyy";} ?>' readonly  name="ci_date" id="ci_date" type="text" placeholder="---" class="form-control">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;"><input    value='<?= $report_data->ci_report_no; ?>' name="ci_report_no" id="ci_report_no" type="text" placeholder="---" class="form-control"  minlength="3" maxlength="40" ></td>
                                            <td colspan="3" style="vertical-align:middle;"><input    value='<?= $report_data->ci_comment; ?>' name="ci_comment" id="ci_comment" type="text" placeholder="---" class="form-control"  minlength="3" maxlength="40" ></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="font-weight: 600;vertical-align:middle;">3. Issues resolved </td>
                                            <td colspan="3">
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="ir_action"   value="Yes"   <?php if ($report_data->ir_action == 'Yes'){ echo 'checked'; } ?>  class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="ir_action"   value="No"   <?php if ($report_data->ir_action == 'No'){ echo 'checked'; } ?>  class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="ir_action"   value="NA"   <?php if ($report_data->ir_action == 'NA'){ echo 'checked'; } ?>  class="form-check-input"> NA
                                                        </label>
                                                    </div>
                                               
                                            </td>
                                            <td colspan="2">
                                                <div class="date input-group p-0">
                                                    <input type="text"    value='<?php if($report_data->ir_date!="null"){echo $report_data->ir_date;}else{echo "dd-mm-yyyy";} ?>' name="ir_date" id="ir_date"  readonly placeholder="---" class="form-control">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="2"><input type="text"    value='<?= $report_data->ir_report_no; ?>' name="ir_report_no" id="ir_report_no" placeholder="---" class="form-control"  minlength="3" maxlength="40" ></td>
                                            <td colspan="3"><input type="text"    value='<?= $report_data->ir_comment; ?>' name="ir_comment" id="ir_comment" placeholder="---" class="form-control"  minlength="3" maxlength="40" ></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="font-weight: 600;vertical-align:middle;">4. All internal stakeholders informed </td>
                                            <td colspan="3">
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="isi_action"  value="Yes"   <?php if ($report_data->isi_action == 'Yes'){ echo 'checked'; } ?>   class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="isi_action"  value="No"   <?php if ($report_data->isi_action == 'No'){ echo 'checked'; } ?>   class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="isi_action"  value="NA"   <?php if ($report_data->isi_action == 'NA'){ echo 'checked'; } ?>   class="form-check-input"> NA
                                                        </label>
                                                    </div>
                                               
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <div class="date input-group p-0">
                                                <input type="text"  value='<?php if($report_data->isi_date!="null"){echo $report_data->isi_date;}else{echo "dd-mm-yyyy";} ?>' readonly  name="isi_date" id="isi_date"   placeholder="---" class="form-control">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;"><input type="text"  value='<?= $report_data->isi_report_no; ?>' name="isi_report_no" id="isi_report_no"   placeholder="---" class="form-control"  minlength="3" maxlength="40" ></td>
                                            <td colspan="3" style="vertical-align:middle;"><input type="text"  value='<?= $report_data->isi_comment; ?>' name="isi_comment" id="isi_comment"   placeholder="---" class="form-control"  minlength="3" maxlength="40" ></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="font-weight: 600;vertical-align:middle;">5. Reported to NDIS /Aged Care Quality </td>
                                            <td colspan="3">
                                                
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="acq_action"   value="Yes"  <?php if ($report_data->acq_action == 'Yes'){ echo 'checked'; } ?>  class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="acq_action"   value="No"  <?php if ($report_data->acq_action == 'No'){ echo 'checked'; } ?>  class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="acq_action"   value="NA"  <?php if ($report_data->acq_action == 'NA'){ echo 'checked'; } ?>  class="form-check-input"> NA
                                                        </label>
                                                    </div>
                                               
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <div class="date input-group p-0">
                                                <input type="text" value='<?php if($report_data->acq_date!="null"){echo $report_data->acq_date;}else{echo "dd-mm-yyyy";} ?>' readonly  name="acq_date" id="acq_date"   placeholder="---" class="form-control">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;"><input type="text" value='<?= $report_data->acq_report_no; ?>'   minlength="3" maxlength="40"  name="acq_report_no" id="acq_report_no"    placeholder="---" class="form-control"></td>
                                            <td colspan="3" style="vertical-align:middle;"><input type="text"  value='<?= $report_data->acq_comment; ?>'   minlength="3" maxlength="40"  name="acq_comment" id="acq_comment"   placeholder="---" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="font-weight: 600;vertical-align:middle;">6. Reported to police</td>
                                            <td colspan="3">
                                              
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="rtp_action"  value="Yes"  <?php if ($report_data->rtp_action == 'Yes'){ echo 'checked'; } ?>   class="form-check-input"> Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="rtp_action"  value="No"  <?php if ($report_data->rtp_action == 'No'){ echo 'checked'; } ?>   class="form-check-input"> No
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="rtp_action"  value="NA"  <?php if ($report_data->rtp_action == 'NA'){ echo 'checked'; } ?>   class="form-check-input"> NA
                                                        </label>
                                                    </div>
                                                
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;">
                                                <div class="date input-group p-0">
                                                    <input type="text" value='<?php if($report_data->rtp_date!="null"){echo $report_data->rtp_date;}else{echo "dd-mm-yyyy";} ?>' readonly  name="rtp_date" id="rtp_date"    placeholder="---" class="form-control">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text" >
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="2" style="vertical-align:middle;"><input type="text"  value='<?= $report_data->rtp_report_no; ?>'   minlength="3" maxlength="40"  name="rtp_report_no" id="rtp_report_no"   placeholder="---" class="form-control"></td>
                                            <td colspan="3" style="vertical-align:middle;"><input type="text" value='<?= $report_data->rtp_comment; ?>'   minlength="3" maxlength="40"  name="rtp_comment" id="rtp_comment"    placeholder="---" class="form-control"></td>
                                        </tr>
                                        <tr class="sub-heading">
                                            <th colspan="6" style="font-weight: 600;vertical-align:middle;background-color:#eee;">If Injury has occurred to the worker </th>
                                            <th colspan="6" style="font-weight: 600;vertical-align:middle;background-color:#eee;">Follow Up</th>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="font-weight: 600;vertical-align:middle;">Worker’s injury Claim form completed </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <div class="form-group mb-0">
                                                    <div class="input-group p-0">
                                                        <input  readonly  value='<?php if($report_data->injury_claim_form!='null'){echo $report_data->injury_claim_form;}else{echo 'dd-mm-yyyy'; }?>' name="injury_claim_form" id="injury_claim_form" class="form-control" placeholder="Date"    autofocus="autofocus" autocomplete="off">
                                                        <div class="input-group-addon">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="3" style="font-weight: 600;vertical-align:middle;">Client telephone follow-up </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <div class="form-group mb-0">
                                                    <div class="input-group p-0">
                                                        <input  readonly  value='<?php if($report_data->client_telephone_followup!="null"){echo $report_data->client_telephone_followup; }else{echo "dd-mm-yyyy";} ?>' name="client_telephone_followup" id="client_telephone_followup" class="form-control"   autofocus="autofocus" autocomplete="off">
                                                        <div class="input-group-addon">
                                                            <span class="input-group-text" >
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="font-weight: 600;vertical-align:middle;">Insurance/ Safe Work NSW notified </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <div class="form-group mb-0">
                                                    <div class="input-group p-0">
                                                        <input  readonly  value='<?php  if($report_data->insurance_nsw_notified!="null"){echo $report_data->insurance_nsw_notified; }else{ echo "dd-mm-yyyy";} ?>' name="insurance_nsw_notified" id="insurance_nsw_notified" class="form-control"   autofocus="autofocus" autocomplete="off">
                                                        <div class="input-group-addon">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="3" style="font-weight: 600;vertical-align:middle;">Staff telephone follow-up (if applicable)  </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <div class="form-group mb-0">
                                                    <div class="input-group p-0">
                                                        <input  readonly  value='<?php if($report_data->staff_telephone_followup!="null"){echo $report_data->staff_telephone_followup;}else{ echo "dd-mm-yyyy";} ?>' name="staff_telephone_followup" id="staff_telephone_followup" class="form-control"   autofocus="autofocus" autocomplete="off">
                                                        <div class="input-group-addon">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="font-weight: 600;vertical-align:middle;">Workcover NSW notified  </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <div class="form-group mb-0">
                                                    <div class="input-group p-0">
                                                        <input  readonly  value='<?php if($report_data->workcover_nsw_notified!="null"){echo $report_data->workcover_nsw_notified;}else{echo "dd-mm-yyyy";} ?>' name="workcover_nsw_notified" id="workcover_nsw_notified" class="form-control"    autofocus="autofocus" autocomplete="off">
                                                        <div class="input-group-addon">
                                                            <span class="input-group-text" >
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="3" style="font-weight: 600;vertical-align:middle;">WHS Staff site investigation  </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <div class="form-group mb-0">
                                                    <div class="input-group p-0">
                                                        <input   readonly value='<?php if($report_data->staff_investigation!="null"){echo $report_data->staff_investigation;}else{ echo "dd-mm-yyyy";} ?>' name="staff_investigation" id="staff_investigation" class="form-control"   autofocus="autofocus" autocomplete="off">
                                                        <div class="input-group-addon">
                                                            <span class="input-group-text" >
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="font-weight: 600;vertical-align:middle;">Incident & Worker comp. database   </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <div class="form-group mb-0">
                                                    <div class="input-group p-0">
                                                        <input  readonly  value='<?php if($report_data->incident_comp_database!="null"){echo "$report_data->incident_comp_database";}else{echo "dd-mm-yyyy";} ?>' name="incident_comp_database" id="incident_comp_database" class="form-control"   autofocus="autofocus" autocomplete="off">
                                                        <div class="input-group-addon">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="3" style="font-weight: 600;vertical-align:middle;">WHS Management investigation   </td>
                                            <td colspan="3" style="vertical-align:middle;">
                                                <div class="form-group mb-0">
                                                    <div class="input-group p-0">
                                                        <input  readonly value='<?php if($report_data->management_investigation!="null"){echo $report_data->management_investigation;}else{echo "dd-mm-yyyy";} ?>' name="management_investigation" id="management_investigation" class="form-control"   autofocus="autofocus" autocomplete="off">
                                                        <div class="input-group-addon">
                                                            <span class="input-group-text" >
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="sub-heading">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;background-color:#eee;">Monitoring /Follow up Notes</th>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <textarea type="text"   rows="3" class="form-control mb-0" placeholder="Follow Up Notes"><?= $report_data->monitoring_note; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr class="sub-heading">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;background-color:#eee;">Comments/Recommendations</th>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: 600;vertical-align:middle;">
                                                <textarea type="text"   rows="5" class="form-control mb-0" placeholder="Comments/Recommendations"> <?= $report_data->recommendations; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr class="sub-heading">
                                            <th colspan="12" style="font-weight: 600;vertical-align:middle;background-color:#eee;">Completed By</th>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="font-weight: 600;vertical-align:middle;">
                                                Name
                                            </td>
                                            <td colspan="3" style="font-weight: 600;vertical-align:middle;">
                                                <input type="text"    value='<?= $report_data->cb_name; ?>' name="cb_name" id="cb_name" placeholder="Name" class="form-control">
                                            </td>
                                            <td colspan="3" style="font-weight: 600;vertical-align:middle;">
                                                Position
                                            </td>
                                            <td colspan="3" style="font-weight: 600;vertical-align:middle;">
                                                <input type="text"    value='<?= $report_data->cb_position; ?>' name="cb_position" id="cb_position" placeholder="Position" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" style="font-weight: 600;vertical-align:middle;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Signature</label>
                                                        <p>Sign in the canvas below and save your signature as an image!</p>
                                                         <?php if($report_data->cb_signature!=''){ ?>
                                                            <img width="100px" src="<?= $report_data->cb_signature; ?>">
                                                        <?php } if($report_data->cb_signature_base!=''){ ?>
                                                            <img width="100px" src="<?= $report_data->cb_signature_base; ?>">
                                                        <?php } ?>
                                                       <canvas id="sig-canvas" width="620" height="160">
                    Get a better browser, bro.
                </canvas>
                                                        <!-- <canvas id="canvas" onclick="getCanvasImg();"width="620" height="100" style="background-color:#fff;">
                                                            Get a better browser, bro.
                                                        </canvas>
                                                        <textarea id="signature64" name="signed" style="display: none"></textarea> -->
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="d-flex align-items-center">
                                                            <!--<button class="btn btn-primary" id="sig-submitBtn">Submit Signature</button>-->
                                                        <button class="btn secondary btn-sm mr-20" id="sig-clearBtn">Clear Signature</button>
                                                        <button class="btn secondary btn-sm mr-20" id="sig-submitBtn">Clear Signature</button>
                                                        <input type="hidden" name="cb_signature_base" id="cb_signature_base">
                                                            <!-- <button type="button" class="btn btn-danger btn-sm" >Clear</button>
                                                            <button id="clear">Clear Signature</button>
                                                            <input type="hidden" name="cb_signature_base" id="cb_signature_base" value=""> -->
                                                            <!-- <span class="or mr-20">OR</span> -->
                                                            <!-- <input type="file"> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="6" style="font-weight: 600;vertical-align:middle;">
                                                <label>Date</label>
                                                <div class="form-group mb-0">
                                                    <div class="input-group p-0">
                                                        <input value='<?php if($report_data->cb_date!="null"){echo $report_data->cb_date;}; ?>' name="cb_date" id="cb_date"  class="form-control" readonly  autofocus="autofocus" autocomplete="off" placeholder="dd-mm-yyyy">
                                                        <div class="input-group-addon">
                                                            <span class="input-group-text" >
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="btn-row">
                                            <td colspan="9"></td>
                                            <td colspan="3" style="font-weight: 300; vertical-align: middle;">
                                                <div role="group" aria-label="Basic example" class="btn-group action-btns">
                                                     <button type="button" class="btn btn-primary mr-10" id="reportincidentformpint">Print</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                        
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                        
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
<script>
    
 $(document).ready(function() {
 

 $("#reportincidentformpint").click(function(){
     window.print();
 });
});
 
</script>
</body>
</html>
