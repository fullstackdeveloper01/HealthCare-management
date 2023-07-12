<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- <div class="panel_s section-heading section-tickets">
  <div class="panel-body">
    <h4 class="no-margin section-text"><?php echo _l('clients_tickets_heading'); ?></h4>
  </div>
</div> -->
<div class="container mt-5">
  <div class="white-box mt-5">
    <div class="clearfix">
      <div class="clearfix">
        <div class="row">
          <div class="col-md-12">
            <h4 class="text-success pull-left no-mtop tickets-summary-heading m-0">Incident</h4>
            <!-- <a href="<?php echo site_url('clients/open_ticket'); ?>" class="btn btn-info new-ticket pull-right">
          <?php echo _l('clients_ticket_open_subject'); ?>
        </a> -->
            <div class="clearfix"></div>
            <hr />
          </div>
          
        </div>
        <?php
    //echo"<pre>";print_r($data);echo"</pre>";
?>
         <div class="row">
          
 
          <div class="card card-primary">
                <div class="card-header">
                  <h4 class="mb-0">Report An Incident</h4>
                </div>
                <div class="card-body">
                  
                  <?= form_open_multipart(site_url('incident/update/'.$incident->id), array('id' => 'incident_update'));  ?>


<!--                   <form action="<?php echo site_url('incident/update/'); ?>"  autocomplete="off" enctype="multipart/form-data" class="ng-pristine ng-invalid ng-touched" method="post" accept-charset="utf-8"  >
 -->                    <input type="hidden" name="id" value="<?php echo $incident->id; ?>">
  
                        <table  class="table table-hover table-bordered results table-sorter" style="width: 100%;">
                            <tbody >
                                <tr  style="background: #2480be;">
                                    <th  colspan="12" style="text-align: center; width: 75%; font-weight: 600; color: #ffffff; border: 1px solid #2480be;">HAZARD/NEAR MISSES/INCIDENT/ACCIDENT &amp; INJURY REPORT FORM</th>
                                </tr>
                                <tr >
                                    <td  colspan="12">All incident/ injuries at workplace involving clients and workers must be reported to the manager/ supervisor immediately. IN CASE OF AN EMERGENCY DIAL 000.</td>
                                </tr>
                                <tr >
                                    <td   colspan="12">
                                        Then record- Complete this form and send to Caring Approach on <a  href="email:admin@caringapproach.com.au">Email: admin@caringapproach.com.au</a> OR send via your Smart phone OR visit the office with
                                        the completed form within 24 hours. For further information contact Caring Approach on Ph: 82125659 and refer to the Caring Approach incident Management policy.
                                    </td>
                                </tr>
                                <tr >
                                    <td   colspan="7" style="vertical-align: middle; font-weight: 600;">You are reporting about (Please tick)</td>
                                    <td  colspan="5">
                                        <label   class="checkbox-inline mr-2 mb-0">
                                            <input  type="radio" <?php echo ($incident->report_for == 'Hazard')? 'checked':''; ?> value="Hazard" disabled class="ng-untouched ng-pristine ng-invalid"  /> Hazard &amp; Near misses
                                        </label>
                                        <label  class="checkbox-inline mr-2 mb-0"><input  <?php echo ($incident->report_for == 'Accident')? 'checked':''; ?> disabled type="radio" value="Accident" class="ng-untouched ng-pristine ng-invalid" /> Accident </label>
                                        <label  class="checkbox-inline mr-2 mb-0"><input  <?php echo ($incident->report_for == 'Incident')? 'checked':''; ?> disabled type="radio" value="Incident" class="ng-untouched ng-pristine ng-invalid" /> Incident </label>
                                        <label  class="checkbox-inline mr-2 mb-0"><input  <?php echo ($incident->report_for == 'Injury')? 'checked':''; ?> disabled type="radio" value="Injury" class="ng-untouched ng-pristine ng-invalid" /> Injury </label>
                                        <!---->
                                    </td>
                                </tr>
                                <tr  style="background-color: #eee;">
                                    <td  colspan="12" style="font-weight: 600; vertical-align: middle;">Reporting Details</td>
                                </tr>
                                <tr >
                                    <td  colspan="7" style="vertical-align: middle; font-weight: 600;">Name of person(s) completing this report</td>
                                    <td  colspan="5"><input  class="form-control ng-untouched ng-pristine ng-invalid" name="pc_name" disabled value="<?php echo $incident->pc_name; ?>" maxlength="15" type="text" /></td>
                                </tr>
                                <tr >
                                    <td  colspan="3" style="vertical-align: middle; font-weight: 600;">Contact Details</td>
                                    <td  colspan="3"><input disabled class="form-control ng-untouched ng-pristine ng-invalid"   value="<?php echo $incident->pc_phone; ?>" placeholder="Phone" type="text" /></td>
                                    <td  colspan="3"><input disabled class="form-control ng-untouched ng-pristine ng-valid" placeholder="Mobile" value="<?php echo $incident->pc_mobile; ?>" type="text" /></td>
                                    <td  colspan="3"><input disabled class="form-control ng-untouched ng-pristine ng-invalid"  value="<?php echo $incident->pc_email; ?>" placeholder="Email" type="text" /></td>
                                </tr>
                                <tr >
                                    <td  colspan="3" style="vertical-align: middle; font-weight: 600;">Are you Caring Approach Worker?</td>
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <label  class="checkbox-inline mr-2 mb-0"><input type="radio" value="Yes" <?php echo ($incident->ca_worker == 'Yes')? 'checked':''; ?> class="ng-untouched ng-pristine ng-invalid" disabled /> Yes </label>
                                        <label  class="checkbox-inline mr-2 mb-0"><input type="radio" value="No" <?php echo ($incident->ca_worker == 'No')? 'checked':''; ?> class="ng-untouched ng-pristine ng-invalid" disabled /> No </label>
                                        <!---->
                                    </td>
                                    <td  colspan="3" style="vertical-align: middle; font-weight: 600;">If yes, your Job Title</td>
                                    <td  colspan="3"><input  class="form-control ng-untouched ng-pristine ng-invalid"  disabled value="<?php echo $incident->ca_worker_title; ?>" maxlength="30" placeholder="Job Title" type="text" /></td>
                                </tr>
                                <tr >
                                    <td  colspan="3" rowspan="2" style="vertical-align: middle; font-weight: 600;">Client’s Contact Details</td>
                                    <td  colspan="3">
                                        <select  class="form-control ng-untouched ng-pristine ng-invalid" formcontrolname="ccd_name">
                                            <option  disabled="" value="">Select</option>
                                            <option  value="Shubham  Jain" <?=isset($incident->ccd_name)&& $incident->ccd_name=='Shubham  Jain'?'selected':''?>>Shubham Jain</option>
                                            <option  value="Chandresh  Jain" <?=isset($incident->ccd_name)&& $incident->ccd_name=='Chandresh  Jain'?'selected':''?>>Chandresh Jain</option>
                                            <option  value="Client1222 client2" <?=isset($incident->ccd_name)&& $incident->ccd_name=='Client1222 client2'?'selected':''?>>Client1222 client2</option>
                                        </select>
                                    </td>
                                    <td  colspan="3"><input disabled value="<?php echo $incident->ccd_phone; ?>" class="form-control ng-untouched ng-pristine ng-invalid"   placeholder="Phone" type="text" /></td>
                                    <td  colspan="3"><input disabled value="<?php echo $incident->ccd_mobile; ?>" class="form-control ng-untouched ng-pristine ng-valid"   placeholder="Mobile" type="text" /></td>
                                </tr>
                                <tr >
                                    <td  colspan="12" style="vertical-align: middle; font-weight: 600;">
                                        <textarea disabled class="form-control ng-untouched ng-pristine ng-invalid"  placeholder="Address" rows="3" type="text"><?php echo $incident->ccd_address; ?></textarea>
                                    </td>
                                </tr>
                                <tr >
                                    <td  colspan="9" style="vertical-align: middle; font-weight: 600;">Date Report Submitted</td>
                                    <td  colspan="3">
                                        <div  class="form-group mb-0">
                                            <div  class="datepicker date input-group p-0">
                                                <input disabled class="form-control mt-7 ng-untouched ng-pristine ng-invalid" formcontrolname="date_report_submitted" value="<?php echo $incident->date_report_submitted; ?>" id="datepicker" name="dp" ngbdatepicker="" placeholder="Choose a date" />
                                                <div  class="input-group-append mt-7">
                                                    <span  class="input-group-text"><i  class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr >
                                    <td  colspan="9" style="vertical-align: middle; font-weight: 600;">Report Submitted to (Person’s Name)</td>
                                    <td  colspan="3"><input disabled class="form-control ng-untouched ng-pristine ng-invalid" formcontrolname="report_submitted_to" value="<?php echo $incident->report_submitted_to; ?>" placeholder="Name" type="text" /></td>
                                </tr>
                                <tr  style="background-color: #eee;">
                                    <td  colspan="12" style="font-weight: 600; vertical-align: middle;">Hazard/Accident/Incident Details</td>
                                </tr>
                                <tr >
                                    <td  colspan="4" style="vertical-align: middle; font-weight: 600;">(Where occurred) Location</td>
                                    <td  colspan="4" style="vertical-align: middle; font-weight: 600;">
                                        <input  class="form-control ng-untouched ng-pristine ng-invalid" formcontrolname="accident_location" value="<?=isset($incident->accident_location)?$incident->accident_location:''?>" placeholder="city/area" type="text" disabled />
                                    </td>
                                    <td  colspan="4" style="vertical-align: middle;">
                                        <div  class="form-group mb-0">
                                            <div  class="datepicker date input-group p-0">
                                                <input
                                                    disabled
                                                    autocomplete="off"
                                                    autofocus="autofocus"
                                                    class="form-control ng-pristine ng-invalid ng-touched"
                                                    formcontrolname="accident_date"
                                                    id="datepiker"
                                                    name="dp"
                                                    ngbdatepicker=""
                                                    placeholder="Hazard/Accident/Incident Date"
                                                    value="<?php echo $incident->accident_date; ?>"
                                                />
                                                <div  class="input-group-append">
                                                    <span  class="input-group-text"><i  class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr >
                                    <td  colspan="9" rowspan="2">
                                        <textarea disabled class="form-control mb-0 ng-untouched ng-pristine ng-invalid" formcontrolname="accident_address" placeholder="Address" rows="3" type="text"><?php echo $incident->accident_address; ?></textarea>
                                    </td>
                                    <td  colspan="3">Time</td>
                                </tr>
                                <tr >
                                    <td  colspan="3"><input disabled class="form-control ng-untouched ng-pristine ng-invalid" formcontrolname="accident_time" value="<?php echo $incident->accident_time; ?>" maxlength="8" placeholder="am/pm" type="text" /></td>
                                </tr>
                                <tr  style="background-color: #eee;">
                                    <td  colspan="12" style="font-weight: 600; vertical-align: middle;">Details of people involved in the accident/incident (including witnesses present)</td>
                                </tr>
                                <tr >
                                    <td  colspan="3" style="vertical-align: middle; font-weight: 600;">Please tick</td>
                                    <td  colspan="3" style="vertical-align: middle; font-weight: 600;">Name</td>
                                    <td  colspan="3" style="vertical-align: middle; font-weight: 600;">Location/Address</td>
                                    <td  colspan="3" style="vertical-align: middle; font-weight: 600;">Contact details ( Ph/M/Email )</td>
                                </tr>
                                <tr >
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <label  class="checkbox-inline mr-2 mb-0"><input  formcontrolname="pic" type="checkbox" value="Client" disabled="" <?=isset($incident->pic)&& $incident->pic=='Client' ? 'checked':''?> class="ng-untouched ng-pristine ng-valid" /> Client </label>
                                    </td>
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <input  class="form-control ng-untouched ng-pristine ng-valid" formcontrolname="pic_name" maxlength="15" disabled=""  placeholder="Name" value="<?=isset($incident->pic_name)? $incident->pic_name:''?>" type="text" />
                                    </td>
                                    <td  colspan="3" style="vertical-align: middle;"><input  class="form-control ng-untouched ng-pristine ng-valid" disabled="" formcontrolname="pic_address" value="<?=isset($incident->pic_address)? $incident->pic_address:''?>" placeholder="Address" type="text" /></td>
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <input  disabled="" class="form-control ng-untouched ng-pristine ng-valid" value="<?=isset($incident->pic_contact)? $incident->pic_contact:''?>" formcontrolname="pic_contact" placeholder="Phone/Mobile/Email" type="text" />
                                    </td>
                                </tr>
                                <tr >
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <label  class="checkbox-inline mr-2 mb-0"><input  formcontrolname="piw" type="checkbox" value="Worker" <?= isset($incident->piw)&& ($incident->piw == 'Worker')? 'checked':''; ?> class="ng-untouched ng-pristine ng-valid" disabled="" /> Worker </label>
                                    </td>
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <input  class="form-control ng-untouched ng-pristine ng-valid" formcontrolname="piw_name" maxlength="15" placeholder="Name" disabled="" value="<?=isset($incident->piw_name)? $incident->piw_name:''?>" type="text" />
                                    </td>
                                    <td  colspan="3" style="vertical-align: middle;"><input  class="form-control" fromcontrolname="piw_address" placeholder="Address" disabled="" value="<?=isset($incident->piw_address)? $incident->piw_address:''?>" type="text" /></td>
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <input  class="form-control ng-untouched ng-pristine ng-valid" formcontrolname="piw_contact" placeholder="Phone/Mobile/Email" disabled="" type="text" value="<?=isset($incident->pic_contact)? $incident->pic_contact:''?>" />
                                    </td>
                                </tr>
                                <tr >
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <label  class="checkbox-inline mr-2 mb-0">
                                            <input  formcontrolname="pio" <?= isset($incident->pio)&&($incident->pio == 'Other')? 'checked':''; ?> type="checkbox" value="Other" disabled="" class="ng-untouched ng-pristine ng-valid" /> Other (Volunteer/visitor/contractor)
                                        </label>
                                    </td>
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <input  class="form-control ng-untouched ng-pristine ng-valid" formcontrolname="pio_name" maxlength="15" placeholder="Name" disabled="" value="<?=isset($incident->pio_name)? $incident->pio_name:''?>" type="text" />
                                    </td>
                                    <td  colspan="3" style="vertical-align: middle;"><input value="<?=isset($incident->pio_address)? $incident->pio_address:''?>"disabled="" class="form-control ng-untouched ng-pristine ng-valid" formcontrolname="pio_address" placeholder="Address" type="text" /></td>
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <input  class="form-control ng-untouched ng-pristine ng-valid" formcontrolname="pio_contact" placeholder="Phone/Mobile/Email" disabled="" value="<?=isset($incident->pio_contact)? $incident->pio_contact:''?>" type="text" />
                                    </td>
                                </tr>
                                <tr >
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <label  class="checkbox-inline mr-2 mb-0"><input disabled="" <?= isset($incident->piwi)&& ($incident->piwi == 'Witnesses')? 'checked':''; ?> formcontrolname="piwi" type="checkbox" value="Witnesses" class="ng-untouched ng-pristine ng-valid" /> Witnesses </label>
                                    </td>
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <input  class="form-control ng-untouched ng-pristine ng-valid" formcontrolname="piwi_name" maxlength="15" placeholder="Name" disabled="" value="<?=isset($incident->piwi_name)? $incident->piwi_name:''?>" type="text" />
                                    </td>
                                    <td  colspan="3" style="vertical-align: middle;"><input  class="form-control ng-untouched ng-pristine ng-valid" value="<?=isset($incident->piwi_address)? $incident->piwi_address:''?>" formcontrolname="piwi_address" placeholder="Address" disabled="" type="text" /></td>
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <input  class="form-control ng-untouched ng-pristine ng-valid" formcontrolname="piwi_contact" disabled="" value="<?=isset($incident->piwi_contact)? $incident->piwi_contact:''?>" placeholder="Phone/Mobile/Email" type="text" />
                                    </td>
                                </tr>
                                <tr  style="background-color: #eee;">
                                    <td  colspan="12" style="font-weight: 600; vertical-align: middle;">Incident Details</td>
                                </tr>
                                <tr >
                                    <td  colspan="12" style="font-weight: 600; vertical-align: middle;">
                                        <textarea
                                            disabled=""
                                            class="form-control mb-0 ng-untouched ng-pristine ng-invalid"
                                            formcontrolname="incident_details"
                                            placeholder="(What happened ?, What tasks/job you were you doing? What area of the workplace were working, and What and where is/are the Risk(s)/Hazard(s))?"
                                            rows="3"
                                            type="text"
                                        ><?php echo $incident->incident_details; ?></textarea>
                                    </td>
                                </tr>
                                <tr >
                                    <td  colspan="9" style="vertical-align: middle; font-weight: 600;">Risk Assessment Table: Hazard’s Category (Risks/Hazard’s Colour coding- please Circle)</td>
                                    <td  colspan="3">
                                        <div  class="form-check-inline">
                                            <label  class="form-check-label text-red">
                                                <input disabled=""  class="form-check-input ng-untouched ng-pristine ng-invalid" formcontrolname="hazard_category" type="radio" <?php echo ($incident->hazard_category == 'High')? 'checked':''; ?> value="High" /> High
                                            </label>
                                        </div>
                                        <div  class="form-check-inline">
                                            <label  class="form-check-label text-amber">
                                                <input disabled="" class="form-check-input ng-untouched ng-pristine ng-invalid" formcontrolname="hazard_category" type="radio" <?php echo ($incident->hazard_category == 'Medium')? 'checked':''; ?> value="Medium" /> Medium
                                            </label>
                                        </div>
                                        <div  class="form-check-inline">
                                            <label  class="form-check-label text-green">
                                                <input disabled="" class="form-check-input ng-untouched ng-pristine ng-invalid" formcontrolname="hazard_category" type="radio" <?php echo ($incident->hazard_category == 'Low')? 'checked':''; ?> value="Low" /> Low
                                            </label>
                                        </div>
                                        <!---->
                                    </td>
                                </tr>
                                <tr >
                                    <td  colspan="9" style="vertical-align: middle; font-weight: 600;">Has injury occurred?</td>
                                    <td  colspan="3">
                                        <div  class="form-check-inline">
                                            <label  class="form-check-label"><input disabled="" class="form-check-input ng-untouched ng-pristine ng-invalid" formcontrolname="injury_occurred" type="radio" <?php echo ($incident->injury_occurred == 'Yes')? 'checked':''; ?> value="Yes" /> Yes </label>
                                        </div>
                                        <div  class="form-check-inline">
                                            <label  class="form-check-label"><input disabled="" class="form-check-input ng-untouched ng-pristine ng-invalid" formcontrolname="injury_occurred" type="radio" <?php echo ($incident->injury_occurred == 'No')? 'checked':''; ?> value="No" /> No </label>
                                        </div>
                                        <div  class="form-check-inline">
                                            <label  class="form-check-label">
                                                <input  class="form-check-input ng-untouched ng-pristine ng-invalid" formcontrolname="injury_occurred" disabled="" type="radio" <?php echo ($incident->injury_occurred == 'Unknown')? 'checked':''; ?> value="Unknown" /> Unknown
                                            </label>
                                        </div>
                                        <!---->
                                    </td>
                                </tr>
                                <!----><!---->
                                <tr >
                                    <td  colspan="8" style="vertical-align: middle; font-weight: 600;">First Aid given ?</td>
                                    <td  colspan="4">
                                        <div  class="form-check-inline">
                                            <label  class="form-check-label"><input disabled="" class="form-check-input ng-untouched ng-pristine ng-valid" formcontrolname="fag" type="radio" <?php echo ($incident->fag == 'Yes')? 'checked':''; ?> value="Yes" /> Yes </label>
                                        </div>
                                        <div  class="form-check-inline">
                                            <label  class="form-check-label"><input disabled="" class="form-check-input ng-untouched ng-pristine ng-valid" formcontrolname="fag" type="radio" <?php echo ($incident->fag == 'No')? 'checked':''; ?> value="No" /> No </label>
                                        </div>
                                    </td>
                                </tr>
                                <!----><!----><!----><!----><!---->
                                <tr >
                                    <td  colspan="8" style="vertical-align: middle; font-weight: 600;">First Aid referral</td>
                                    <td  colspan="4">
                                        <div  class="form-check-inline">
                                            <label  class="form-check-label"><input  disabled="" class="form-check-input ng-untouched ng-pristine ng-valid" formcontrolname="fag_referral" type="radio" <?php echo ($incident->fag_referral == 'Yes')? 'checked':''; ?> value="Yes" /> Yes </label>
                                        </div>
                                        <div  class="form-check-inline">
                                            <label  class="form-check-label"><input  disabled="" class="form-check-input ng-untouched ng-pristine ng-valid" formcontrolname="fag_referral" type="radio" <?php echo ($incident->fag_referral == 'No')? 'checked':''; ?> value="No" /> No </label>
                                        </div>
                                    </td>
                                </tr>
                                <!----><!---->
                                <tr  style="background-color: #eee;">
                                    <td  colspan="12" style="font-weight: 600; vertical-align: middle;">Possible Solutions (What actions would you suggest to fix/rectify the problem?</td>
                                </tr>
                                <tr >
                                    <td  colspan="12" style="font-weight: 600; vertical-align: middle;">
                                        <textarea disabled="" class="form-control mb-0 ng-untouched ng-pristine ng-valid" formcontrolname="possible_solution" rows="3" type="text"><?php echo $incident->possible_solution; ?></textarea>
                                    </td>
                                </tr>
                                <tr  style="background-color: #eee;">
                                    <th  colspan="12" style="font-weight: 600; vertical-align: middle;">Action Plan (what needs to be done and who will fix the issue)</th>
                                </tr>
                                <tr >
                                    <td  colspan="2" style="vertical-align: middle; font-weight: 600;">Action Needed</td>
                                    <td  colspan="2" style="vertical-align: middle; font-weight: 600;">By When</td>
                                    <td  colspan="2" style="vertical-align: middle; font-weight: 600;">By Whom</td>
                                    <td  colspan="2" style="vertical-align: middle; font-weight: 600;">Review Date</td>
                                    <td  colspan="4" style="vertical-align: middle; font-weight: 600;">Signature</td>
                                </tr>
                                <tr >
                                    <td  colspan="2" style="vertical-align: top;"><input  class="form-control ng-untouched ng-pristine ng-invalid" disabled=""  value="<?php echo $incident->ap_action_needed; ?>" placeholder="" type="text" /></td>
                                    <td  colspan="2" style="vertical-align: top;"><input  class="form-control ng-untouched ng-pristine ng-invalid"  disabled="" value="<?php echo $incident->ap_by_when; ?>" placeholder="" type="text" /></td>
                                    <td  colspan="2" style="vertical-align: top;"><input  class="form-control ng-untouched ng-pristine ng-invalid" disabled="" value="<?php echo $incident->ap_by_whom; ?>" placeholder="" type="text" /></td>
                                    <td  colspan="2" style="vertical-align: top;">
                                        <div  class="datepicker date input-group p-0">
                                            <input
                                                 disabled=""
                                                autocomplete="off"
                                                autofocus="autofocus"
                                                class="form-control ng-untouched ng-pristine ng-invalid"
                                                formcontrolname="ap_review_date"
                                                 ngbdatepicker=""
                                                placeholder=""
                                                value="<?php echo $incident->ap_review_date; ?>"
                                            />
                                            <div  class="input-group-append">
                                                <span  class="input-group-text"><i  class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td  colspan="4" style="vertical-align: top;">
                                        <div  class="row">
                                            <div  class="col-md-12">
                                                <label >Signature</label>
                                                <div  class="file-upload">
                                                    <div  class="file-select">
                                                        <button disabled=""  class="btn btn-primary mr-2" data-target="#signaturePad" data-toggle="modal" type="button">Pad</button>
                                                        <button disabled="" class="custom-file-button"><label  class="btn btn-primary custom-signature-label" for="chooseFile">File </label></button>
                                                        <input disabled="" accept="image/png, image/jpeg" hidden="" id="chooseFile" name="chooseFile" type="file" />
                                                        <!---->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr  style="background-color: #eee;">
                                    <th  colspan="12" style="font-weight: 600; vertical-align: middle;">Office use only</th>
                                </tr>
                                <tr >
                                    <td  colspan="2" style="vertical-align: middle; font-weight: 600;">Date</td>
                                    <td  colspan="2">
                                        <div  class="form-group mb-0">
                                            <div  class=" input-group p-0">
                                                <input 
                                                    class="form-control ng-untouched ng-pristine"
                                                    name="ou_date"
                                                    id="datepiker"
                                                     placeholder="Date"
                                                     value="<?php echo $incident->ou_date; ?>"
                                                     pattern="\d{2}-\d{2}-\d{4}" 
                                                 />
                                                <div  class="input-group-append">
                                                    <span  class="input-group-text"><i  class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td  colspan="2" style="vertical-align: middle; font-weight: 600;">By</td>
                                    <td  colspan="2"><input  class="form-control ng-untouched ng-pristine" name="ou_by" placeholder="By" type="text"  value="<?php echo $incident->ou_by; ?>" /></td>
                                    <td  colspan="2" style="vertical-align: middle; font-weight: 600;">Job Title</td>
                                    <td  colspan="2"><input  class="form-control ng-untouched ng-pristine" name="ou_job_title" placeholder="Job title" type="text" value="<?php echo $incident->ou_job_title; ?>" /></td>
                                </tr>
                                <tr >
                                    <th  colspan="12" style="font-weight: 600; vertical-align: middle;">To be completed by: Manager Health, Safety &amp; Risk for further investigation and recording</th>
                                </tr>
                                <tr >
                                    <td  colspan="2" rowspan="2" style="font-weight: 600; vertical-align: middle; background-color: #eee;">Action /Plan</td>
                                    <td  colspan="3" style="font-weight: 600; vertical-align: middle; text-align: center; background-color: #eee;">Action required</td>
                                    <td  colspan="2" rowspan="2" style="font-weight: 600; vertical-align: middle; background-color: #eee;">Date reported</td>
                                    <td  colspan="2" rowspan="2" style="font-weight: 600; vertical-align: middle; background-color: #eee;">Reported to (Event / reference number)</td>
                                    <td  colspan="3" rowspan="2" style="font-weight: 600; vertical-align: middle; background-color: #eee;">Comments</td>
                                </tr>
                                <tr >
                                    <td  colspan="3" style="font-weight: 600; vertical-align: middle; text-align: center;">YES/ NO/ NA</td>
                                </tr>
                                <tr >
                                    <td  colspan="2" style="font-weight: 600; vertical-align: middle;">1. Investigation completed</td>
                                    <td  colspan="3">
                                        <div  class="text-center">
                                            <div  class="form-check-inline">
                                                <label  class="form-check-label"><input  class="form-check-input ng-untouched ng-pristine" name="ic_action" <?php echo ($incident->ic_action == 'Yes')? 'checked':''; ?> type="radio" value="Yes" /> Yes </label>
                                            </div>
                                            <div  class="form-check-inline">
                                                <label  class="form-check-label"><input  class="form-check-input ng-untouched ng-pristine" name="ic_action" <?php echo ($incident->ic_action == 'No')? 'checked':''; ?> type="radio" value="No" /> No </label>
                                            </div>
                                            <div  class="form-check-inline">
                                                <label  class="form-check-label"><input  class="form-check-input ng-untouched ng-pristine" name="ic_action" <?php echo ($incident->ic_action == 'NA')? 'checked':''; ?> type="radio" value="NA" /> NA </label>
                                            </div>
                                        </div>
                                    </td>
                                    <td  colspan="2" style="vertical-align: middle;">
                                        <div  class="input-group p-0">
                                            <input  class="form-control ng-untouched ng-pristine" name="ic_date" id="datepiker"  pattern="\d{2}-\d{2}-\d{4}" placeholder="" value="<?php echo $incident->ic_date; ?>" <?php echo ($incident->ic_action == 'No')? 'style="display: none;"':''; ?> />
                                            <div  class="input-group-append">
                                                <span  class="input-group-text"><i  class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td  colspan="2" style="vertical-align: middle;"><input  class="form-control ng-untouched ng-pristine" value="<?php echo $incident->ic_report_no; ?>" name="ic_report_no" placeholder="---" type="text"  /></td>
                                    <td  colspan="3" style="vertical-align: middle;"><input  class="form-control ng-untouched ng-pristine" value="<?php echo $incident->ic_comment; ?>" name="ic_comment" placeholder="---" type="text"  /></td>
                                </tr>
                                <tr >
                                    <td  colspan="2" style="font-weight: 600; vertical-align: middle;">2. CEO informed</td>
                                    <td  colspan="3">
                                        <div  class="text-center">
                                            <div  class="form-check-inline">
                                                <label  class="form-check-label"><input <?php echo ($incident->ci_action == 'Yes')? 'checked':''; ?> class="form-check-input ng-untouched ng-pristine" name="ci_action" type="radio" value="Yes" /> Yes </label>
                                            </div>
                                            <div  class="form-check-inline">
                                                <label  class="form-check-label"><input <?php echo ($incident->ci_action == 'No')? 'checked':''; ?> class="form-check-input ng-untouched ng-pristine" name="ci_action" type="radio" value="No" /> No </label>
                                            </div>
                                            <div  class="form-check-inline">
                                                <label  class="form-check-label"><input <?php echo ($incident->ci_action == 'NA')? 'checked':''; ?> class="form-check-input ng-untouched ng-pristine" name="ci_action" type="radio" value="NA" /> NA </label>
                                            </div>
                                        </div>
                                    </td>
                                    <td  colspan="2" style="vertical-align: middle;">
                                        <div  class=" input-group p-0">
                                            <input  class="form-control ng-untouched ng-pristine" value="<?php echo $incident->ci_date; ?>" pattern="\d{2}-\d{2}-\d{4}" name="ci_date" placeholder="" <?php echo ($incident->ci_action == 'No')? 'style="display: none;"':''; ?> />
                                            <div  class="input-group-append">
                                                <span  class="input-group-text"><i  class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td  colspan="2" style="vertical-align: middle;"><input  class="form-control ng-untouched ng-pristine" value="<?php echo $incident->ci_report_no; ?>" name="ci_report_no" placeholder="---" type="text"  /></td>
                                    <td  colspan="3" style="vertical-align: middle;"><input  class="form-control ng-untouched ng-pristine" value="<?php echo $incident->ci_comment; ?>" name="ci_comment" placeholder="---" type="text"  /></td>
                                </tr>
                                <tr >
                                    <td  colspan="2" style="font-weight: 600; vertical-align: middle;">3. Issues resolved</td>
                                    <td  colspan="3">
                                        <div  class="text-center">
                                            <div  class="form-check-inline">
                                                <label  class="form-check-label"><input  class="form-check-input ng-untouched ng-pristine" name="ir_action" <?php echo ($incident->ir_action == 'Yes')? 'checked':''; ?> type="radio" value="Yes"  /> Yes </label>
                                            </div>
                                            <div  class="form-check-inline">
                                                <label  class="form-check-label"><input  class="form-check-input ng-untouched ng-pristine" name="ir_action" <?php echo ($incident->ir_action == 'No')? 'checked':''; ?> type="radio" value="No"  /> No </label>
                                            </div>
                                            <div  class="form-check-inline">
                                                <label  class="form-check-label"><input  class="form-check-input ng-untouched ng-pristine" name="ir_action" <?php echo ($incident->ir_action == 'NA')? 'checked':''; ?> type="radio" value="NA"  /> NA </label>
                                            </div>
                                        </div>
                                    </td>
                                    <td  colspan="2">
                                        <div  class=" input-group p-0">
                                            <input  autocomplete="off" autofocus="autofocus" class="form-control ng-untouched ng-pristine" pattern="\d{2}-\d{2}-\d{4}" name="ir_date" value="<?php echo $incident->ir_date; ?>" placeholder="" <?php echo ($incident->ir_action == 'No')? 'style="display: none;"':''; ?> />
                                            <div  class="input-group-append">
                                                <span  class="input-group-text"><i  class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td  colspan="2"><input  class="form-control ng-untouched ng-pristine" name="ir_report_no" placeholder="---" type="text" value="<?php echo $incident->ir_report_no; ?>"  /></td>
                                    <td  colspan="3"><input  class="form-control ng-untouched ng-pristine" name="ir_comment" placeholder="---" type="text" value="<?php echo $incident->ir_comment; ?>" /></td>
                                </tr>
                                <tr >
                                    <td  colspan="2" style="font-weight: 600; vertical-align: middle;">4. All internal stakeholders informed</td>
                                    <td  colspan="3">
                                        <div  class="text-center">
                                            <div  class="form-check-inline">
                                                <label  class="form-check-label"><input  class="form-check-input ng-untouched ng-pristine" name="isi_action" <?php echo ($incident->isi_action == 'Yes')? 'checked':''; ?> type="radio" value="Yes"  /> Yes </label>
                                            </div>
                                            <div  class="form-check-inline">
                                                <label  class="form-check-label"><input  class="form-check-input ng-untouched ng-pristine" name="isi_action" <?php echo ($incident->isi_action == 'No')? 'checked':''; ?> type="radio" value="No"  /> No </label>
                                            </div>
                                            <div  class="form-check-inline">
                                                <label  class="form-check-label"><input  class="form-check-input ng-untouched ng-pristine" name="isi_action" <?php echo ($incident->isi_action == 'NA')? 'checked':''; ?> type="radio" value="NA"  /> NA </label>
                                            </div>
                                        </div>
                                    </td> 
                                    <td  colspan="2" style="vertical-align: middle;">
                                        <div  class="datepicker date input-group p-0">
                                            <input  class="form-control ng-untouched ng-pristine" value="<?php echo $incident->isi_date; ?>" pattern="\d{2}-\d{2}-\d{4}" name="isi_date" placeholder="" <?php echo ($incident->isi_action == 'No')? 'style="display: none;"':''; ?> />
                                            <div  class="input-group-append">
                                                <span  class="input-group-text"><i  class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td  colspan="2" style="vertical-align: middle;"><input  class="form-control ng-untouched ng-pristine" value="<?php echo $incident->isi_report_no; ?>" name="isi_report_no" placeholder="---" type="text"  /></td>
                                    <td  colspan="3" style="vertical-align: middle;"><input  class="form-control ng-untouched ng-pristine" value="<?php echo $incident->isi_comment; ?>" name="isi_comment" placeholder="---" type="text"  /></td>
                                </tr>
                                <tr >
                                    <td  colspan="2" style="font-weight: 600; vertical-align: middle;">5. Reported to NDIS /Aged Care Quality</td>
                                    <td  colspan="3">
                                        <div  class="text-center">
                                            <div  class="form-check-inline">
                                                <label  class="form-check-label"><input  class="form-check-input ng-untouched ng-pristine" name="acq_action" <?php echo ($incident->acq_action == 'Yes')? 'checked':''; ?> type="radio" value="Yes"  /> Yes </label>
                                            </div>
                                            <div  class="form-check-inline">
                                                <label  class="form-check-label"><input  class="form-check-input ng-untouched ng-pristine" name="acq_action" <?php echo ($incident->acq_action == 'No')? 'checked':''; ?> type="radio" value="No"  /> No </label>
                                            </div>
                                            <div  class="form-check-inline">
                                                <label  class="form-check-label"><input  class="form-check-input ng-untouched ng-pristine" name="acq_action" <?php echo ($incident->acq_action == 'NA')? 'checked':''; ?> type="radio" value="NA"  /> NA </label>
                                            </div>
                                        </div>
                                    </td>
                                    <td  colspan="2" style="vertical-align: middle;">
                                        <div  class=" input-group p-0">
                                            <input  autocomplete="off" autofocus="autofocus" class="form-control ng-untouched ng-pristine" value="<?php echo $incident->acq_date; ?>" name="acq_date" pattern="\d{2}-\d{2}-\d{4}" placeholder="" <?php echo ($incident->acq_action == 'No')? 'style="display: none;"':''; ?> />
                                            <div  class="input-group-append">
                                                <span  class="input-group-text"><i  class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td  colspan="2" style="vertical-align: middle;"><input  class="form-control ng-untouched ng-pristine" value="<?php echo $incident->acq_report_no; ?>" name="acq_report_no" placeholder="---" type="text"  /></td>
                                    <td  colspan="3" style="vertical-align: middle;"><input  class="form-control ng-untouched ng-pristine" value="<?php echo $incident->acq_comment; ?>" name="acq_comment" placeholder="---" type="text"  /></td>
                                </tr>
                                <tr >
                                    <td  colspan="2" style="font-weight: 600; vertical-align: middle;">6. Reported to police</td>
                                    <td  colspan="3">
                                        <div  class="text-center">
                                            <div  class="form-check-inline">
                                                <label  class="form-check-label"><input  class="form-check-input ng-untouched ng-pristine" name="rtp_action" <?php echo ($incident->rtp_action == 'Yes')? 'checked':''; ?> type="radio" value="Yes"  /> Yes </label>
                                            </div>
                                            <div  class="form-check-inline">
                                                <label  class="form-check-label"><input  class="form-check-input ng-untouched ng-pristine" name="rtp_action" <?php echo ($incident->rtp_action == 'No')? 'checked':''; ?> type="radio" value="No"  /> No </label>
                                            </div>
                                            <div  class="form-check-inline">
                                                <label  class="form-check-label"><input  class="form-check-input ng-untouched ng-pristine" name="rtp_action" <?php echo ($incident->rtp_action == 'NA')? 'checked':''; ?> type="radio" value="NA"  /> NA </label>
                                            </div>
                                        </div>
                                    </td>
                                    <td  colspan="2" style="vertical-align: middle;">
                                        <div  class="  input-group p-0">
                                            <input  autocomplete="off" autofocus="autofocus" class="form-control ng-untouched ng-pristine" pattern="\d{2}-\d{2}-\d{4}" name="rtp_date" value="<?php echo $incident->rtp_date; ?>" ngbdatepicker="" placeholder="" <?php echo ($incident->rtp_action == 'No')? 'style="display: none;"':''; ?> />
                                            <div  class="input-group-append">
                                                <span  class="input-group-text"><i  class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td  colspan="2" style="vertical-align: middle;"><input  class="form-control ng-untouched ng-pristine" name="rtp_report_no" value="<?php echo $incident->rtp_report_no; ?>" placeholder="---" type="text"  /></td>
                                    <td  colspan="3" style="vertical-align: middle;"><input  class="form-control ng-untouched ng-pristine" name="rtp_comment" value="<?php echo $incident->rtp_comment; ?>" placeholder="---" type="text"  /></td>
                                </tr>
                                <tr >
                                    <th  colspan="6" style="font-weight: 600; vertical-align: middle; background-color: #eee;">If Injury has occurred to the worker</th>
                                    <th  colspan="6" style="font-weight: 600; vertical-align: middle; background-color: #eee;">Follow Up</th>
                                </tr>
                                <tr >
                                    <td  colspan="3" style="font-weight: 600; vertical-align: middle;">Worker’s injury Claim form completed</td>
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <div  class="form-group mb-0">
                                            <div  class=" input-group p-0">
                                                <input
                                                    
                                                    autocomplete="off"
                                                    autofocus="autofocus"
                                                    class="form-control ng-untouched ng-pristine"
                                                    name="injury_claim_form"
                                                    ngbdatepicker=""
                                                    placeholder="Date"
                                                    value="<?php echo $incident->injury_claim_form; ?>"
                                                    pattern="\d{2}-\d{2}-\d{4}"
                                                    
                                                />
                                                <div  class="input-group-append">
                                                    <span  class="input-group-text"><i  class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td  colspan="3" style="font-weight: 600; vertical-align: middle;">Client telephone follow-up</td>
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <div  class="form-group mb-0">
                                            <div  class=" input-group p-0">
                                                <input
                                                    
                                                    autocomplete="off"
                                                    autofocus="autofocus"
                                                    class="form-control ng-untouched ng-pristine"
                                                    name="client_telephone_followup"
                                                    value="<?php echo $incident->client_telephone_followup; ?>"
                                                    ngbdatepicker=""
                                                    placeholder="Date"
                                                    pattern="\d{2}-\d{2}-\d{4}"
                                                    
                                                />
                                                <div  class="input-group-append">
                                                    <span  class="input-group-text"><i  class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr >
                                    <td  colspan="3" style="font-weight: 600; vertical-align: middle;">Insurance/ Safe Work NSW notified</td>
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <div  class="form-group mb-0">
                                            <div  class="input-group p-0">
                                                <input
                                                    
                                                    autocomplete="off"
                                                    autofocus="autofocus"
                                                    class="form-control ng-untouched ng-pristine"
                                                    name="insurance_nsw_notified"
                                                     value="<?php echo $incident->insurance_nsw_notified; ?>"
                                                    ngbdatepicker=""
                                                    placeholder="Date"
                                                    pattern="\d{2}-\d{2}-\d{4}"
                                                    
                                                />
                                                <div  class="input-group-append">
                                                    <span  class="input-group-text"><i  class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td  colspan="3" style="font-weight: 600; vertical-align: middle;">Staff telephone follow-up (if applicable)</td>
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <div  class="form-group mb-0">
                                            <div  class=" input-group p-0">
                                                <input
                                                    
                                                    autocomplete="off"
                                                    autofocus="autofocus"
                                                    class="form-control ng-untouched ng-pristine"
                                                    name="staff_telephone_followup"
                                                     value="<?php echo $incident->staff_telephone_followup; ?>"
                                                    ngbdatepicker=""
                                                    placeholder="Date"
                                                    pattern="\d{2}-\d{2}-\d{4}"
                                                    
                                                />
                                                <div  class="input-group-append">
                                                    <span  class="input-group-text"><i  class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr >
                                    <td  colspan="3" style="font-weight: 600; vertical-align: middle;">Workcover NSW notified</td>
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <div  class="form-group mb-0">
                                            <div  class=" input-group p-0">
                                                <input
                                                    
                                                    autocomplete="off"
                                                    autofocus="autofocus"
                                                    class="form-control ng-untouched ng-pristine"
                                                    name="workcover_nsw_notified"
                                                    value="<?php echo $incident->workcover_nsw_notified; ?>"
                                                    ngbdatepicker=""
                                                    placeholder="Date"
                                                    pattern="\d{2}-\d{2}-\d{4}"
                                                    
                                                />
                                                <div  class="input-group-append">
                                                    <span  class="input-group-text"><i  class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td  colspan="3" style="font-weight: 600; vertical-align: middle;">WHS Staff site investigation</td>
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <div  class="form-group mb-0">
                                            <div  class="input-group p-0">
                                                <input
                                                    
                                                    autocomplete="off"
                                                    autofocus="autofocus"
                                                    class="form-control ng-untouched ng-pristine"
                                                    name="staff_investigation"
                                                    value="<?php echo $incident->staff_investigation; ?>"
                                                    ngbdatepicker=""
                                                    placeholder="Date"
                                                    pattern="\d{2}-\d{2}-\d{4}"
                                                    
                                                />
                                                <div  class="input-group-append">
                                                    <span  class="input-group-text"><i  class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr >
                                    <td  colspan="3" style="font-weight: 600; vertical-align: middle;">Incident &amp; Worker comp. database</td>
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <div  class="form-group mb-0">
                                            <div  class="input-group p-0">
                                                <input
                                                    
                                                    autocomplete="off"
                                                    autofocus="autofocus"
                                                    class="form-control ng-untouched ng-pristine"
                                                    name="incident_comp_database"
                                                    value="<?php echo $incident->incident_comp_database; ?>"
                                                    ngbdatepicker=""
                                                    placeholder="Date"
                                                    pattern="\d{2}-\d{2}-\d{4}"
                                                    
                                                />
                                                <div  class="input-group-append">
                                                    <span  class="input-group-text"><i  class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td  colspan="3" style="font-weight: 600; vertical-align: middle;">WHS Management investigation</td>
                                    <td  colspan="3" style="vertical-align: middle;">
                                        <div  class="form-group mb-0">
                                            <div  class=" input-group p-0">
                                                <input
                                                    
                                                    autocomplete="off"
                                                    autofocus="autofocus"
                                                    class="form-control ng-untouched ng-pristine"
                                                    name="management_investigation"
                                                    value="<?php echo $incident->management_investigation; ?>"
                                                    ngbdatepicker=""
                                                    placeholder="Date"
                                                    pattern="\d{2}-\d{2}-\d{4}"
                                                    
                                                />
                                                <div  class="input-group-append">
                                                    <span  class="input-group-text"><i  class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr >
                                    <th  colspan="12" style="font-weight: 600; vertical-align: middle; background-color: #eee;">Monitoring /Follow up Notes</th>
                                </tr>
                                <tr >
                                    <td  colspan="12" style="font-weight: 600; vertical-align: middle;">
                                        <textarea  class="form-control mb-0 ng-untouched ng-pristine" name="monitoring_note" placeholder="Follow Up Notes" rows="3" type="text" ><?php echo $incident->monitoring_note; ?></textarea>
                                    </td>
                                </tr>
                                <tr >
                                    <th  colspan="12" style="font-weight: 600; vertical-align: middle; background-color: #eee;">Comments/Recommendations</th>
                                </tr>
                                <tr >
                                    <td  colspan="12" style="font-weight: 600; vertical-align: middle;">
                                        <textarea  class="form-control mb-0 ng-untouched ng-pristine" name="recommendations" placeholder="Comments/Recommendations" rows="5" type="text" ><?php echo $incident->recommendations; ?></textarea>
                                    </td>
                                </tr>
                                <tr >
                                    <th  colspan="12" style="font-weight: 600; vertical-align: middle; background-color: #eee;">Completed By</th>
                                </tr>
                                <tr >
                                    <td  colspan="3" style="font-weight: 600; vertical-align: middle;">Name</td>
                                    <td  colspan="3" style="font-weight: 600; vertical-align: middle;">
                                        <input  class="form-control ng-untouched ng-pristine" value="<?php echo $incident->cb_name; ?>" name="cb_name" maxlength="15" placeholder="Name" type="text"  />
                                    </td>
                                    <td  colspan="3" style="font-weight: 600; vertical-align: middle;">Position</td>
                                    <td  colspan="3" style="font-weight: 600; vertical-align: middle;">
                                        <input  class="form-control ng-untouched ng-pristine" value="<?php echo $incident->cb_position; ?>" name="cb_position" placeholder="Position" type="text"  />
                                    </td>
                                </tr>
                                <tr >
                                    <td  colspan="6" style="font-weight: 600; vertical-align: middle;">
                                        <div  class="row">
                                            <div  class="col-md-12">
                                                <label >Signature</label>
                                                <div  class="file-upload">
                                                    <div  class="file-select">
                                                        <button  class="btn btn-primary mr-2" data-target="#signaturePad" data-toggle="modal" type="button">Pad</button>
                                                        <input type="hidden" name="signatureFile" id="signatureFile" value="">
                                                        <button type="button" class="custom-file-button">
                                                            <label  class="btn btn-primary custom-signature-label" for="chooseFile">File </label>
                                                            <div  class="disabled"></div>
                                                        </button>
                                                        <input  accept="image/png, image/jpeg" hidden="" id="chooseFile" name="chooseFile" type="file" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td  colspan="6" style="font-weight: 600; vertical-align: middle;">
                                        <label >Date</label>
                                        <div  class="form-group mb-0">
                                            <div  class="input-group p-0">
                                                <input id="datepiker_007"  class="form-control ng-untouched ng-pristine" name="cb_date" pattern="\d{2}-\d{2}-\d{4}" value="<?php echo $incident->cb_date; ?>"  placeholder="Date" />
                                                <div  class="input-group-append">
                                                    <span  class="input-group-text"><i  class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr  class="btn-row">
                                    <td  colspan="10"></td>
                                    <td  colspan="2" style="font-weight: 300; vertical-align: middle;">
                                        <div  aria-label="Basic example" class="btn-group action-btns" role="group">
                                            <button  class="btn theme-btn mr-10" type="submit">Save</button>
<!--                                             <button  class="btn btn-info mr-10" type="button">Print</button>
 -->                                            <button  class="btn btn-danger" type="button">Cancel</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                  </form>
                </div>
          </div>
 
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="signaturePad" tabindex="-1" role="dialog" aria-labelledby="newClientModalLabel">
    <div class="modal-dialog full-modal" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="newClientModalLabel">Add Client</h4>
            </div>
            <div class="modal-body">
                <div class="flex-row">
                   <div class="wrapper canvas-wrap">
                       <canvas id="signature-pad" width="400" height="200"></canvas>
                   </div>
 
               </div> 
            </div>
            <div _ngcontent-egd-c4="" class="modal-footer">
              <button  class="btn btn-secondary close" data-dismiss="modal" type="button">Close</button>
              <button id="clear" class="btn btn-danger" type="button">Clear</button>
              <button id="download" class="btn btn-primary" type="button">Add Signature</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

 <script type="text/javascript">
   var canvas = document.querySelector('canvas');
  canvas.style.position = 'relative';
  canvas.style.top = "0";
  canvas.style.left = "0";

var ctx = canvas.getContext('2d');
canvas.width = 500;
canvas.height = 350;

ctx.lineWidth = 3;
ctx.lineJoin = ctx.lineCap = 'round';

var isDrawing, drawLine;

canvas.onmousedown = function(event) {
  isDrawing = true;
  drawLine = { x: event.clientX, y: event.clientY };
};

canvas.onmousemove = function(event) {
  if (!isDrawing) return;

  ctx.beginPath();
  
  ctx.moveTo(drawLine.x, drawLine.y);
  ctx.lineTo(event.clientX, event.clientY);
  ctx.stroke();
     
  drawLine = { x: event.clientX, y: event.clientY };
};

canvas.onmouseup = function() {
  isDrawing = false;
};

document.getElementById('clear').addEventListener('click', function() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        canvas.clear();

      }, false);

window.onload = function(){
var save = document.getElementById('download');

 save.onclick = function(){
    download(canvas, 'signature.png');
  }

}

function download(canvas, filename) {
  var lnk = document.createElement('a'), e;
  lnk.download = filename;
  var sigImage = canvas.toDataURL("image/png;base64");
   jQuery('#signatureFile').val(sigImage);
  jQuery('#signaturePad').modal('hide');
  jQuery('#signaturePad').removeClass('show');

}

   /* $("#dobs").datetimepicker({
        timepicker:false,
        format: 'd-m-Y',
         maxDate: dt1,
         startDate: dt1,
        onSelect: function(selected) {
           $("#dobs").datetimepicker("option","maxDate", selected)
        }
    });*/

    $( function() {
        $( "#datepiker_007" ).datetimepicker({  timepicker:false, format: 'd-m-Y' });
        $( 'input[name="ou_date"]' ).datetimepicker({  timepicker:false, format: 'd-m-Y' });
        $( 'input[name="ic_date"]' ).datetimepicker({  timepicker:false, format: 'd-m-Y' });
        $( 'input[name="ci_date"]' ).datetimepicker({  timepicker:false, format: 'd-m-Y' });
        $( 'input[name="ir_date"]' ).datetimepicker({  timepicker:false, format: 'd-m-Y' });
        $( 'input[name="isi_date"]' ).datetimepicker({  timepicker:false, format: 'd-m-Y' });
        $( 'input[name="rtp_date"]' ).datetimepicker({  timepicker:false, format: 'd-m-Y' });
        $( 'input[name="injury_claim_form"]' ).datetimepicker({  timepicker:false, format: 'd-m-Y' });
        $( 'input[name="client_telephone_followup"]' ).datetimepicker({  timepicker:false, format: 'd-m-Y' });
        $( 'input[name="insurance_nsw_notified"]' ).datetimepicker({  timepicker:false, format: 'd-m-Y' });
        $( 'input[name="workcover_nsw_notified"]' ).datetimepicker({  timepicker:false, format: 'd-m-Y' });
        $( 'input[name="incident_comp_database"]' ).datetimepicker({  timepicker:false, format: 'd-m-Y' });
        $( 'input[name="staff_telephone_followup"]' ).datetimepicker({  timepicker:false, format: 'd-m-Y' });
        $( 'input[name="staff_investigation"]' ).datetimepicker({  timepicker:false, format: 'd-m-Y' });
        $( 'input[name="management_investigation"]' ).datetimepicker({  timepicker:false, format: 'd-m-Y' });
        $( 'input[name="acq_date"]' ).datetimepicker({  timepicker:false, format: 'd-m-Y' });

        $('input[name="ic_action"]').change(function(){
            var val = $(this).val();
            if(val== 'No')
            {
                $('input[name="ic_date"]').hide();
            }else{
                  $('input[name="ic_date"]').show();
            }
        });

        $('input[name="ci_action"]').change(function(){
            var val = $(this).val();
            if(val== 'No')
            {
                $('input[name="ci_date"]').hide();
            }else{
                  $('input[name="ci_date"]').show();
            }
        });

        $('input[name="ir_action"]').change(function(){
            var val = $(this).val();
            if(val== 'No')
            {
                $('input[name="ir_date"]').hide();
            }else{
                  $('input[name="ir_date"]').show();
            }
        });

        $('input[name="isi_action"]').change(function(){
            var val = $(this).val();
            if(val== 'No')
            {
                $('input[name="isi_date"]').hide();
            }else{
                  $('input[name="isi_date"]').show();
            }
        });

        $('input[name="acq_action"]').change(function(){
            var val = $(this).val();
            if(val== 'No')
            {
                $('input[name="acq_date"]').hide();
            }else{
                  $('input[name="acq_date"]').show();
            }
        });

        $('input[name="rtp_action"]').change(function(){
            var val = $(this).val();
            if(val== 'No')
            {
                $('input[name="rtp_date"]').hide();
            }else{
                  $('input[name="rtp_date"]').show();
            }
        });

    } );


    


 </script>

 <style type="text/css">
   .canvas-wrap {
  text-align: left;
  display: inline-block;
  max-width: 100%; 
}
  canvas {
    display: block;
    position: relative;
    border: 1px solid;    
  }
  img {
    position: absolute;
    left: 0;
    top: 0;
  }

 </style>