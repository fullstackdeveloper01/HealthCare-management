<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- <nav class="navbar nav-profile">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse p-0 text-center" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav mb-0">
        <li class="active"><a href="#">Profile</a></li>
        <li><a href="#">Care Plan</a></li>
        <li><a href="#">Roster</a></li>
        <li><a href="#">Service Agreements</a></li>
        <li><a href="#">Reports/ Documents</a></li>
        <li><a href="#">Invoices</a></li>
        <li><a href="#">Support staff </a></li>
        <li><a href="#">Appointment</a></li>
        <li><a href="#">Review</a></li>
      </ul>
    </div>
  </div>
</nav> -->

<div class="container pt-140">

    <div class="white-box">

        <div class="row">
            <div class="col-md-6">
                <div class="clearfix">
                    <div class="media media-user">
                        <div class="media-left media-middle">
                            

                                 <?php
                                    if(isset($client_data))
                                    {
                                        $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => $client_data->userid, 'rel_type' => 'profile_image'))->row('file_name');
                                        if($filename!=''){
                                        ?>
                                          <img src="<?= base_url('uploads/profile_image/'.$client_data->userid.'/'.$filename); ?>" data-toggle="tooltip" data-title="<?php echo html_escape($client_data->firstname . ' ' . $client_data->lastname); ?>" data-placement="bottom" class="client-profile-image-small mright5 media-object" onerror="this.onerror=null;this.src='<?php echo base_url(); ?>assets/images/user.png';">
                                          
                                        <?php 
                                    }else{
                                        ?>
                                          <a class="user-profile-text media-object" style="background: <?php printf( "#%06X\n", mt_rand( 0, 0xFFFFFF )); ?>;" ><?= ucfirst(substr($client_data->firstname,0,1)).''.ucfirst(substr($client_data->lastname, 0, 1))?></a>
                                        <?php 

                                    }
                                    }
                               ?>

                            
                        </div>
                        <div class="media-body media-middle pl-2">
                            <h4 class="media-heading">
                                <?php echo html_escape($client_data->firstname . ' ' . $client_data->lastname); ?>
                                
                            </h4>
                            <p><?php echo 'Last Login : '.html_escape($client_data->last_login); ?><br>
                                <?php echo 'Last Login IP : '.html_escape($client_data->last_ip); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 text-right">
                <div class="mt-1">
                    <?php
                    if(get_user_id_role()==3)
                    {
                    ?>
                    <a href="#" onclick="login_as('<?= $client_id_encrypt; ?>')" class="btn btn-blue">Login as</a>

                    <?php
                    }
                    if(get_user_id_role()==4)
                    {
                        
                    ?>
                   <!--  <a href="#" onclick="login_as_employee('<?= $client_id_encrypt; ?>')" class="btn btn-blue">Login as</a> -->

                    <?php
                    }
                    ?>

                    <a href="<?php echo site_url(); ?>" class="btn btn-blue">Back</a>
                </div>
            </div>
        </div>


        <div class="profile-details">
            <div class="row">
                <?php
                    if(get_user_id_role()==3)
                    {
                ?>
                <div class="col-md-6">
                    <h4 class="mb-1 bold mt-0">Services Type</h4>
                    <ul class="list-services">
                        <?php 
                        $service_type = $this->db->get_where(db_prefix().'contacts', array('userid' => $client_data->userid))->row('service_type');
                            $servicetype = servicename($service_type); 
                            $servicetypearray = explode(",",$servicetype); 
                          
                            foreach ($servicetypearray as  $value) {
                        ?>
                        <li><?php print_r($value);?></li>
                    <?php  } ?>
                    </ul>
                </div>
                <?php
                }else
                {
                ?>
                <div class="col-md-6">
                    <h4 class="mb-1 bold mt-0">Designation</h4>
                    <ul class="list-services">
                        <?php 
                        $designation_type = $this->db->get_where(db_prefix().'contacts', array('userid' => $client_data->userid))->row('designation_id');
                            $designationtype = designationname($designation_type); 
                            $designationtypearray = explode(",",$designationtype); 
                          
                            foreach ($designationtypearray as  $value) {
                        ?>
                        <li><?php print_r($value);?></li>
                    <?php  } ?>
                    </ul>
                </div>

                <?php
                }
                ?>

                <div class="col-md-6">
                    <h4 class="mb-1 bold mt-0">Program/Department</h4>
                    <ul class="list-services">
                        <?php 
                        $department_id = $this->db->get_where(db_prefix().'contacts', array('userid' => $client_data->userid))->row('department_id');
                            $departmenttype = departementname($department_id); 
                            $departmenttypearray = explode(",",$departmenttype); 
                          
                            foreach ($departmenttypearray as  $value) {
                               
                            
                        ?>
                        <li><?php print_r($value);?></li>
                    <?php  } ?>
                    </ul>
                </div>
            </div>
        </div>


        <?php
            if(get_user_id_role()==3)
            {
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="custom-tabs mb-2">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#Profile" aria-controls="Profile" role="tab" data-toggle="tab">Profile</a></li>
                        <!-- <li role="presentation"><a href="#changePassword" aria-controls="changePassword" role="tab" data-toggle="tab">changePassword</a></li> -->
                        <li role="presentation"><a href="#CarePlan" aria-controls="CarePlan" role="tab" data-toggle="tab">Care Plan</a></li>
                        <li role="presentation"><a href="#Roster" aria-controls="Roster" role="tab" data-toggle="tab" onclick="getRoaster();" >Roster</a></li>
                        <li role="presentation"><a href="#ServiceAgreements" aria-controls="ServiceAgreements" role="tab" data-toggle="tab"  onclick="getServiceAgreements()">Service Agreements</a></li>
                        <li role="presentation"><a href="#Document" aria-controls="Document" role="tab" data-toggle="tab" onclick="getDocument()">Reports Documents</a></li>
                        <li role="presentation"><a href="#Invoices" aria-controls="Invoices" role="tab" data-toggle="tab"  onclick="getInvoice();">Invoices</a></li>
                        <li role="presentation"><a href="#Supportstaff" aria-controls="Supportstaff" role="tab" data-toggle="tab" onclick="getSupportstaff();">Support Staff</a></li>
                        <li role="presentation"><a href="#Appointment" aria-controls="Appointment" role="tab" data-toggle="tab"   onclick="getAppointment();">Appointment</a></li>
                        <li role="presentation"><a href="#Review" aria-controls="Review" role="tab" data-toggle="tab" onclick="getReview();">Review</a></li>
                        <li role="presentation"><a href="#RequestAmendment" aria-controls="RequestAmendment" role="tab" data-toggle="tab" onclick="getRequestAmendment();">Request Amendment</a></li>
                    </ul>
                </div>
            </div>
            <!-- col end -->

            <div class="col-md-12">

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="Profile">
                        <?php echo form_open_multipart('clients/profile', array('autocomplete' => 'off')); ?>
                        <?php echo form_hidden('profile', true); ?>
                        <div class="card right-tab-wrap">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div _ngcontent-pgh-c74="">
                                        <h4 class="mb-0"><?php echo _l('clients_profile_heading'); ?></h4>
                                        <small>Personal information</small>
                                    </div>
                                    <div class="ml-auto align-items-center">
                                        <!-- <div class="dl d-flex align-items-center">
                                            <div class="btn-group br-0">
                                                <button type="button" class="btn btn-warning edit"><i class="fa fa-edit"></i> Edit</button>
                                                <button type="button" class="btn btn-success save"><i class="fa fa-save"></i> Save</button>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name">Office Location<sup class="text-danger">*</sup></label>
                                                 <select class="form-control dis" id="office_location">
                                                    <option value="<?= $client_data->office_location; ?>"><?= $client_data->office_location; ?></option>
                                                </select>

                                                <!-- <select class="form-control dis">
                                                    <option>NSW</option>
                                                    <option>ACT</option>
                                                </select> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group profile-firstname-group">
                                                <label for="firstname"><?php echo _l('clients_firstname'); ?><sup class="text-danger" sup>*</sup></label>
                                                <input type="text" disabled class="form-control" name="firstname" maxlength="15" id="firstname" value="<?php echo set_value('firstname', $client_data->firstname); ?>">
                                                <?php echo form_error('firstname'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group profile-lastname-group">
                                                <label for="lastname"><?php echo _l('clients_lastname'); ?><sup class="text-danger" sup>*</sup></label>
                                                <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo set_value('lastname', $client_data->lastname); ?>" disabled>
                                                <?php echo form_error('lastname'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group profile-email-group">
                                                <label for="email"><?php echo _l('clients_email'); ?></label>
                                                <input type="email" name="email" class="form-control" id="email" value="<?php echo $client_data->email; ?>" disabled>
                                                <?php echo form_error('email'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="phone">Phone<sup class="text-danger">*</sup></label>
                                                <input type="text" class="form-control dis" id="phone" placeholder="Phone" value="<?php echo $client_data->phonenumber; ?>" disabled />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="phone">Alternative Mobile</label>
                                                <input type="text" class="form-control dis" value="<?php echo $client_data->alternative_mobile; ?>" id="alternative_mobile" placeholder="Alternative Mobile" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-12">
                                             <div class="form-group">
                                                <label for="gender">Gender<sup class="text-danger">*</sup></label>
                                                <select class="form-control dis" id="gender">
                                                    <option value="<?= $client_data->gender; ?>"><?= $client_data->gender; ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="dob">Date of Birth</label>
                                                <div class="datepicker date input-group p-0">
                                                    <input class="form-control dis" value="<?php echo getDateDMYOnly($client_data->dob); ?>" placeholder="Dob" name="dp" ngbDatepicker id="datepiker" #d="ngbDatepicker" [showWeekNumbers]="true" autofocus="autofocus" autocomplete="off" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="doj">Date of Joining</label>
                                                <div class="datepicker date input-group p-0">
                                                    <input class="form-control dis" value="<?php echo getDateDMYOnly($client_data->doj); ?>" placeholder="doj" name="dp" ngbDatepicker id="datepiker" #d="ngbDatepicker" [showWeekNumbers]="true" autofocus="autofocus" autocomplete="off" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="gender">Budget Amount<sup class="text-danger">*</sup></label>
                                                    <input type="text" class="form-control dis" id="budget_amount" placeholder="Budget Amount" value="<?php echo $client_data->budget_amount; ?>" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <h4>Service Location</h4>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="address">Address 1<sup class="text-danger">*</sup></label>
                                                <textarea class="form-control dis" id="address" placeholder="Address" disabled><?php echo $client_data->address; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="country">Country<sup class="text-danger">*</sup></label>
                                                <select class="form-control dis" id="country">
                                                    <option value="<?= countryname($client_data->country); ?>"><?= countryname($client_data->country); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="state">State<sup class="text-danger">*</sup></label>
                                                <select class="form-control dis" id="state">
                                                    <option value="<?= statename($client_data->state); ?>"><?= statename($client_data->state); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="city">City<sup class="text-danger">*</sup></label>
                                                <select class="form-control dis" id="city">
                                                    <option value="<?= cityname($client_data->city); ?>"><?= cityname($client_data->city); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="postal-code">Postal Code<sup class="text-danger">*</sup></label>
                                                <input type="text" value="<?php echo $client_data->postal_code; ?>" class="form-control dis" id="postal-code" placeholder="Postal Code" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="address">Address 2</label>
                                                <textarea class="form-control dis" id="address" placeholder="Address" disabled><?php echo $client_data->address2; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="country">Country<sup class="text-danger">*</sup></label>
                                                <select class="form-control dis" id="country">
                                                    <option value="<?= countryname($client_data->country2); ?>"><?= countryname($client_data->country2); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="state">State<sup class="text-danger">*</sup></label>
                                                <select class="form-control dis" id="state">
                                                    <option value="<?= statename($client_data->state2); ?>"><?= statename($client_data->state2); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="city">City<sup class="text-danger">*</sup></label>
                                                <select class="form-control dis" id="city">
                                                    <option value="<?= cityname($client_data->city2); ?>"><?= cityname($client_data->city2); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="postal-code">Postal Code</label>
                                                <input type="text" value="<?php echo $client_data->postal_code2; ?>" class="form-control dis" id="postal-code" placeholder="Postal Code" disabled />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <!-- Care plan -->
                    <?php include 'modal/careplan.php'; ?>
                    <!--// -->
                    <!-- invoices -->
                    <?php include 'modal/serviceAgreements.php'; ?>
                    <!-- invoices -->
                    <?php include 'modal/invoices.php'; ?>
                    <!--// -->
                    <!-- roster -->
                    <?php include 'modal/roster.php'; ?>
                    <!--// -->

                    <!-- roster -->
                    <?php include 'modal/document.php'; ?>
                    <!-- roster -->
                    <?php include 'modal/appointment.php'; ?>

                  
                    <!-- roster -->
                    <?php include 'modal/supportstaff.php'; ?>
                    <?php include 'modal/reviews.php'; ?>
                    <?php include 'modal/requestamendment.php'; ?>

                </div>
            </div>
        </div>
        <?php
            }else{
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="custom-tabs mb-2">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#ProfileS" aria-controls="Profile" role="tab" data-toggle="tab">Profile</a></li>
                        <!-- <li role="presentation"><a href="#Policecheck" aria-controls="Policecheck" role="tab" data-toggle="tab" onclick="getPoliceCheck();" >POLICE CHECK</a></li> -->
                        <!-- <li role="presentation"><a href="#Wwcc" aria-controls="Wwcc" role="tab" data-toggle="tab" onclick="getWwcc();" >WWCC/WWVP</a></li> -->
                        <!-- <li role="presentation"><a href="#Firstaid" aria-controls="Firstaid" role="tab" data-toggle="tab" onclick="getFirstaid();" >First Aid</a></li> -->
                        <li role="presentation"><a href="#Clientstaff" aria-controls="Clientstaff" role="tab" data-toggle="tab" onclick="getClientstaff();" >Client</a></li>
                        <li role="presentation"><a href="#Roster" aria-controls="Roster" role="tab" data-toggle="tab" onclick="getRoaster();" >Roster</a></li>
                        <li role="presentation"><a href="#Document" aria-controls="Document" role="tab" data-toggle="tab" onclick="getDocument()">Documents</a></li>
                         <li role="presentation"><a href="#Review" aria-controls="Review" role="tab" data-toggle="tab" onclick="getReview();">Feedback</a></li>
                        <li role="presentation"><a href="#Reportincident" aria-controls="Reportincident" role="tab" data-toggle="tab" onclick="getReportIncident()">Report Incident</a></li>
                       
                    </ul>
                </div>
            </div>
            <!-- col end -->

            <div class="col-md-12">

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="ProfileS">
                        <?php echo form_open_multipart('clients/profile', array('autocomplete' => 'off')); ?>
                        <?php echo form_hidden('profile', true); ?>
                        <div class="card right-tab-wrap">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div _ngcontent-pgh-c74="">
                                        <h4 class="mb-0"><?php echo _l('clients_profile_heading'); ?></h4>
                                        <small>Personal information</small>
                                    </div>
                                    <div class="ml-auto align-items-center">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-2 col-12">
                                            <div class="form-group profile-employee_date-group">
                                                <label for="employee_date">Form Update Date</label>
                                                    <input class="form-control dis" value="<?php echo ($client_data->employee_date=='')?'':getDateDMYOnly($client_data->employee_date); ?>" placeholder="employee_date" name="employee_date"  autofocus="autofocus" autocomplete="off" disabled>
                                               
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="form-group profile-employee_date-group">
                                                <label for="added_by">Form Update By</label>
                                                    <input class="form-control dis" value="<?php echo $employee_data->added_by; ?>" placeholder="Last Update By" name="added_by"  autofocus="autofocus" autocomplete="off" disabled>
                                               
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6 col-12">
                                            <div class="form-group profile-firstname-group">
                                                <label for="progressbar"><?php //echo _l('Employee Form'); ?> <?=$client_data->employee_form?></label>
                                                <div class="progress mb-0">
                                                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?= $client_data->employee_form; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $client_data->employee_form; ?>%">
                                                       <span class="sr-only"><?php // $client_data->employee_form; ?>%</span>
                                                    </div>
                                                 </div>
                                            </div>
                                        </div> -->
                                        <div class="col-md-6 col-12">
                                            <div class="form-group profile-firstname-group">
                                                <label for="progressbar"><?php echo _l('Employee Form'); ?> <?=$client_data->employee_form?></label>
                                                <div class="mb-0">
                                                    <!-- <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?= $client_data->employee_form; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $client_data->employee_form; ?>%">
                                                       <span class="sr-only"><?php // $client_data->employee_form; ?>%</span>
                                                    </div> -->
                                                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?= $client_data->employee_form; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $client_data->employee_form; ?>%">
                                                       <?php echo $client_data->employee_form; ?>%
                                                    </div>
                                                 </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">

                                            <?php $form_id = $this->db->get_where(db_prefix().'employee',array('userid' =>$client_data->userid))->row('id'); 
                                            if($form_id){
                                            ?>
                                             <label for="progressbar"><?php echo _l('Option'); ?></label>
                                          
                                          <div class='d-flex'  ><a target="_blank" href="<?php echo site_url('clients/editEmployeeForm/'.$form_id.'/'.$client_data->userid); ?>" class="btn btn-blue"><i class='fa fa-edit'></i></a>&nbsp;&nbsp;&nbsp;</div>
                                            <?php } ?>
                                           
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group profile-firstname-group">
                                                <label for="firstname"><?php echo _l('clients_firstname'); ?><sup class="text-danger" sup>*</sup></label>
                                                <input type="text" disabled class="form-control" name="firstname" maxlength="15" id="firstname" value="<?php echo set_value('firstname', $client_data->firstname); ?>">
                                                <?php echo form_error('firstname'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group profile-lastname-group">
                                                <label for="lastname"><?php echo _l('clients_lastname'); ?><sup class="text-danger" sup>*</sup></label>
                                                <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo set_value('lastname', $client_data->lastname); ?>" disabled>
                                                <?php echo form_error('lastname'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group profile-email-group">
                                                <label for="email"><?php echo _l('clients_email'); ?></label>
                                                <input type="email" name="email" class="form-control" id="email" value="<?php echo $client_data->email; ?>" disabled>
                                                <?php echo form_error('email'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="phone">Phone<sup class="text-danger">*</sup></label>
                                                <input type="text" class="form-control dis" id="phone" placeholder="Phone" value="<?php echo $client_data->phonenumber; ?>" disabled />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="phone">Alternative Mobile</label>
                                                <input type="text" class="form-control dis" value="<?php echo $client_data->alternative_mobile; ?>" id="alternative_mobile" placeholder="Alternative Mobile" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- <div class="col-md-3 col-12">
                                             <div class="form-group">
                                                <label for="gender">Gender<sup class="text-danger">*</sup></label>
                                                <select class="form-control dis" id="gender">
                                                    <option value="<?= $client_data->gender; ?>"><?= $client_data->gender; ?></option>
                                                </select>
                                            </div>
                                        </div> -->
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="dob">Date of Birth</label>
                                                <div class="datepicker date input-group p-0">
                                                    <input class="form-control dis" value="<?php echo getDateDMYOnly($client_data->dob); ?>" placeholder="Dob" name="dp" ngbDatepicker id="datepiker" #d="ngbDatepicker" [showWeekNumbers]="true" autofocus="autofocus" autocomplete="off" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="doj">Date of Joining</label>
                                                <div class="datepicker date input-group p-0">
                                                    <input class="form-control dis" value="<?php echo getDateDMYOnly($client_data->doj); ?>" placeholder="doj" name="dp" ngbDatepicker id="datepiker" #d="ngbDatepicker" [showWeekNumbers]="true" autofocus="autofocus" autocomplete="off" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="total_working_hours">Total Working Hours</label>
                                                    <input type="text" class="form-control dis" value="<?php echo $client_data->total_working_hours; ?>" id="total_working_hours" placeholder="Total Working Hours" disabled />
                                            </div>
                                        </div>
                                       <!--  <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="gender">Budget Amount<sup class="text-danger">*</sup></label>
                                                    <input type="text" class="form-control dis" id="budget_amount" placeholder="Budget Amount" value="<?php echo $client_data->budget_amount; ?>" disabled />
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <h4>Current Address</h4>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="address">Address<sup class="text-danger">*</sup></label>
                                                <textarea class="form-control dis" id="address" placeholder="Address" disabled>c</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="country">Country<sup class="text-danger">*</sup></label>
                                                <select class="form-control dis" id="country">
                                                    <option value="<?= countryname($client_data->country); ?>"><?= countryname($client_data->country); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="state">State<sup class="text-danger">*</sup></label>
                                                <select class="form-control dis" id="state">
                                                    <option value="<?= statename($client_data->state); ?>"><?= statename($client_data->state); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="city">City<sup class="text-danger">*</sup></label>
                                                <select class="form-control dis" id="city">
                                                    <option value="<?= cityname($client_data->city); ?>"><?= cityname($client_data->city); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="postal-code">Postal Code<sup class="text-danger">*</sup></label>
                                                <input type="text" value="<?php echo $client_data->postal_code; ?>" class="form-control dis" id="postal-code" placeholder="Postal Code" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <h4>Permanent Address</h4>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea class="form-control dis" id="address" placeholder="Address" disabled><?php echo $client_data->address2; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="country">Country<sup class="text-danger">*</sup></label>
                                                <select class="form-control dis" id="country">
                                                    <option value="<?= countryname($client_data->country2); ?>"><?= countryname($client_data->country2); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="state">State<sup class="text-danger">*</sup></label>
                                                <select class="form-control dis" id="state">
                                                    <option value="<?= statename($client_data->state2); ?>"><?= statename($client_data->state2); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="city">City<sup class="text-danger">*</sup></label>
                                                <select class="form-control dis" id="city">
                                                    <option value="<?= cityname($client_data->city2); ?>"><?= cityname($client_data->city2); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="postal-code">Postal Code</label>
                                                <input type="text" value="<?php echo $client_data->postal_code2; ?>" class="form-control dis" id="postal-code" placeholder="Postal Code" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <h4>Emergency Contact Details</h4>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="emg_name">Name<sup class="text-danger">*</sup></label>
                                                <input type="text" value="<?php echo $client_data->emg_name; ?>" class="form-control dis" id="emg_name" placeholder="Name" disabled />
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="emg_relatiopnship">Relatiopnship<sup class="text-danger">*</sup></label>
                                                <input type="text" value="<?php echo $client_data->emg_relatiopnship; ?>" class="form-control dis" id="emg_relatiopnship" placeholder="Relatiopnship" disabled />
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="emg_phone">Home Phone<sup class="text-danger">*</sup></label>
                                                <input type="text" value="<?php echo $client_data->emg_phone; ?>" class="form-control dis" id="emg_phone" placeholder="Phone" disabled />
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="emg_mobile">Mobile<sup class="text-danger">*</sup></label>
                                                <input type="text" value="<?php echo $client_data->emg_mobile; ?>" class="form-control dis" id="emg_mobile" placeholder="Mobile No" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="emg_address">Address</label>
                                                <textarea class="form-control dis" id="emg_address" placeholder="Address" disabled><?php echo $client_data->emg_address; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="emg_country">Country<sup class="text-danger">*</sup></label>
                                                <select class="form-control dis" id="emg_country">
                                                    <option value="<?= countryname($client_data->emg_country); ?>"><?= countryname($client_data->emg_country); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="emg_state">State<sup class="text-danger">*</sup></label>
                                                <select class="form-control dis" id="emg_state">
                                                    <option value="<?= statename($client_data->emg_state); ?>"><?= statename($client_data->emg_state); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="emg_city">City<sup class="text-danger">*</sup></label>
                                                <select class="form-control dis" id="emg_city">
                                                    <option value="<?= cityname($client_data->emg_city); ?>"><?= cityname($client_data->emg_city); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="emg_postalcode">Postal Code</label>
                                                <input type="text" value="<?php echo $client_data->emg_postalcode; ?>" class="form-control dis" id="emg_postalcode" placeholder="Postal Code" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <h4>Favorite:</h4>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="favorite_food">Favorite Food</label>
                                                <textarea class="form-control dis" id="favorite_food" placeholder="Favorite Food" disabled><?php echo $client_data->favorite_food; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="favorite_sport">Favorite Sport</label>
                                                <textarea class="form-control dis" id="favorite_sport" placeholder="Favorite Sport" disabled><?php echo $client_data->favorite_sport; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="favorite_destination">Favorite Destination</label>
                                                <textarea class="form-control dis" id="favorite_destination" placeholder="Favorite Destination" disabled><?php echo $client_data->favorite_destination; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                   
                    <?php include 'modal/policycheck.php'; ?>
                    <?php include 'modal/wwcc.php'; ?>
                    <?php include 'modal/firstaid.php'; ?>
                    <?php include 'modal/clientstaff.php'; ?>
                    <?php include 'modal/roster.php'; ?>
                    <?php include 'modal/reviews.php'; ?>
                    <?php include 'modal/document.php'; ?>
                    <?php include 'modal/reportincident.php'; ?>

                </div>
            </div>
        </div>

        <?php
            }
        ?>
    </div>
</div>


<!--  -->
<div class="modal fade" id="addDocument" tabindex="-1" aria-labelledby="data" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header-2">
                <h5 class="modal-title" id="studentlistLabelDOC">Add document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body font-14">
                <div class="panel_s">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Title">
                    </div>

                    <!-- COMPONENT START -->
                    <div class="form-group">
                        <div class="input-group input-file" name="Fichier1">
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-choose btn-success" type="button">Choose</button>
                            </span>
                            <input type="text" class="form-control" placeholder='Choose a file...' />
                            <span class="input-group-btn">
                                <button class="btn btn-danger btn-reset" type="button">Reset</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="form-control datepicker" placeholder="Choose date">
                    </div>
                    <button type="button" class="btn btn btn-info pr-2 pl-2">Upload</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function login_as(key)
    {
         

         var str = "key="+key+"&"+csrfData['token_name']+"="+csrfData['hash'];
            $.ajax({
                url: '<?= base_url()?>api/client/login_as',
                type: 'GET',
                data: str,
                datatype: 'json',
                cache: false,
                success: function(response){
                    if(response)
                    {
                        var base_url = window.location.origin;
                        var key = response.result;
                        window.open(base_url+"/client/"+key, "_blank");
                        
                        
                    }
                    else
                    {
                    }
                }
            });


    }
    function login_as_employee(key)
    {
         

         var str = "key="+key+"&"+csrfData['token_name']+"="+csrfData['hash'];
            $.ajax({
                url: '<?= base_url()?>api/employee/login_as_employee',
                type: 'GET',
                data: str,
                datatype: 'json',
                cache: false,
                success: function(response){
                    if(response)
                    {
                        var base_url = window.location.origin;
                        var key = response.result;
                        window.open(base_url+"/employee/"+key, "_blank");
                        
                        
                    }
                    else
                    {
                    }
                }
            });


    }



function employeeform_open_as(key,form_id)
{
     
console.log(form_id);
     var str = "key="+key+"&"+csrfData['token_name']+"="+csrfData['hash'];
        $.ajax({
            url: '<?= base_url()?>api/employee/login_as_employee',
            type: 'GET',
            data: str,
            datatype: 'json',
            cache: false,
            success: function(response){
                if(response)
                {
                    var base_url = window.location.origin;
                    var key_final = response.result;
                    window.open(base_url+"/employee/"+key_final+"/"+form_id, "_blank");
                  
                }
                else
                {
                }
            }
        });


}



</script>
