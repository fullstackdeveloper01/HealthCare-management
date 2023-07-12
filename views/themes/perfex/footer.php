<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- <div class="pusher"></div>
<footer class="footer navbar-fixed-bottom <?= ($this->uri->segment(1) == 'authentication')?"hide":""; ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<span class="copyright-footer"><?php echo date('Y'); ?> <?php echo _l('clients_copyright', get_option('companyname')); ?></span>
				<?php if(is_gdpr() && get_option('gdpr_show_terms_and_conditions_in_footer') == '1') { ?>
					- <a href="<?php echo terms_url(); ?>" class="terms-and-conditions-footer"><?php echo _l('terms_and_conditions'); ?></a>
				<?php } ?>
			</div>
		</div>
	</div>
</footer> -->

<!-- Client Modal -->
<div class="modal fade" id="studentlistmodel" tabindex="-1" aria-labelledby="studentlistLabel" aria-hidden="true" style="display: none;">
  	<div class="modal-dialog full-modal">
	    <div class="modal-content">
	        <div class="modal-header-2">
		        <h5 class="modal-title" id="studentlistLabel">Clients</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        </div>
	        <div class="modal-body font-14">
	        	<?php
                	if(get_user_id_role()==3)
                	{
                ?>
				<!-- <div class="clearfix"> -->

					<div class="row mbot15">
						<div class="col-md-3 form-group">
							<?= _l('From Date'); ?><span class="text-danger"></span>
							<input type="text"  class="form-control" autocomplete="off" name="from_date" id="from_date">
						</div> 
						<div class="col-md-3 form-group">
							<?= _l('To Date'); ?><span class="text-danger"></span>
							<input type="text"  class="form-control" autocomplete="off"  name="to_date" id="to_date">
						</div>
						
					
						<!-- <div class="col-md-3">
							<?= _l('Report'); ?><span class="text-danger"></span>
							<select class="form-control" id="report_type" name="report_type">
								<option value="0" selected>Filter By Report Type</option>
								<option value="1">Today</option>
								<option value="2">Weekly</option>
								<option value="3">Monthly</option>
								<option value="4">Yearly</option>
							</select>
						</div> -->
						<div class="col-md-2">
							<?= _l('Status'); ?><span class="text-danger"></span>
							<select class="form-control" id="clo_status" name="status">
								<option value="">Filter By Status</option>
								<option value="1">Active</option>
								<option value="0">Inactive</option>
							</select>
						</div>
						<div class="col-md-2">
							<span class="text-danger"></span>
							<button id="filter" class="btn btn-primary mt-2 btn-block">Filter</button>
						</div>
						<div class="col-md-2">
							<span class="text-danger"></span>
							<button id="clearfilter" class=" btn btn-primary mt-2 btn-block">Clear Filter</button>
						</div>
					</div>
					<div class="row mbot15">
						<div class="col-md-8">
							<h4 class="no-margin">Clients Summary</h4>
						</div>
						<div class="col-md-2 col-xs-6">
						<!-- <a href='<?= base_url() ?>clients/exportClients'>Export</a><br><br> -->
							<button class="btn btn-primary btn-block" id="client_export"><?= _l('Export'); ?></button>
						</div>
						<div class="col-md-2 col-xs-6">
							<a href="javascript:void(0);" data-toggle="modal" data-target="#newClientModal" class="btn btn-primary btn-block pull-right" data-dismiss="modal" aria-label="Close">
								<?= _l('Add new'); ?>
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-xs-6 border-right">
							<h3 class="bold totalclo_client">0</h3>
							<span class="text-dark">Summary total</span>
						</div>
						<div class="col-md-2 col-xs-6 border-right">
							<h3 class="bold totalclo_client_active">0</h3>
							<span class="text-success">Active</span>
						</div>
						<div class="col-md-2 col-xs-6 border-right">
							<h3 class="bold totalclo_client_deactive">0</h3>
							<span class="text-danger">Deactivate</span>
						</div>
						<div class="col-md-2 col-xs-6 border-right">
							<h3 class="bold totalclo_client_week">0</h3>
							<span class="text-info">Added in a Week</span>
						</div>
						<div class="col-md-2 col-xs-6 border-right">
							<h3 class="bold totalclo_client_month">0</h3>
							<span class="text-primary">Added in a Month</span>
						</div>
						<div class="col-md-2 col-xs-6 border-right">
							<h3 class="bold totalclo_client_year">0</h3>
							<span class="text-default">Added in a Year</span>
						</div>						
                    </div>
				
					<hr class="hr-panel-heading">
                <?php
                 	}
                ?>
				<div class="table-responsive mt-2">
					<table class="table table-custom" data-order-col="0" data-order-type="asc" id='clientdata_list' style="width:100%">
						<thead>
							<th width="10%" class="th-ticket-number">#ID</th>
							<th class="th-ticket-subject">First Name</th>
							<th class="th-ticket-subject">Last Name</th>
							<th class="th-ticket-subject">Email</th>
							<th class="th-ticket-subject">Phone</th>
							<th class="th-ticket-subject">Address</th>
							<th class="th-ticket-subject">Office Location</th>
                            <th class="th-ticket-subject">Status</th>
                            <?php
                            	if(get_user_id_role()==3)
                            	{
                            ?>
							<th class="th-ticket-subject">Action</th>
                            <?php
                             	}
                            ?>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
	        </div>
        </div>
    </div>
</div>


 <!-- Add new clients -->
   <?php include 'views/modal/new_clients.php';?>

<!-- Staff Modal -->
<div class="modal" id="stafflistmodel" tabindex="-1" aria-labelledby="stafflistmodel" aria-hidden="true" style="display: none;">
  	<div class="modal-dialog full-modal">
	    <div class="modal-content">
	        <div class="modal-header-2">
		        <h5 class="modal-title" id="stafflistLabel">Staff</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        </div>
	        	<?php
                	if(get_user_id_role()==4)
                	{
                ?>
	        	<div class="panel_s">
               		<div class="panel-body">	 	                  
                		<div class="_buttons">
                			<a href="javascript:void(0);" data-toggle="modal" data-target="#newStaffModal" class="btn btn-info pull-right" data-dismiss="modal" aria-label="Close">
                				<?= _l('Add new'); ?>
                			</a>
                		</div>
                	</div>
                </div>
                <?php
                 	}
                ?>
				
	        <div class="modal-body font-14">
				<div class="table-responsive mt-2">
					<table class="table table-custom" data-order-col="0" data-order-type="asc" id='staffdata_list' style="width:100%">
						<thead>
							<th width="10%" class="th-ticket-number">#ID</th>
							<th class="th-ticket-subject">First Name</th>
							<th class="th-ticket-subject">Last Name</th>
							<th class="th-ticket-subject">Email</th>
							<th class="th-ticket-subject">Phone</th>
							<th class="th-ticket-subject">Address</th>
							<th class="th-ticket-subject">Department</th>
							<th class="th-ticket-subject">Designation</th>
							<!-- <th class="th-ticket-subject">Service Type</th> -->
							<!-- <th class="th-ticket-subject">Office Location</th> -->
							<?php
                        	if(get_user_id_role()==4)
                        	{
                            ?>
							<th class="th-ticket-subject">Action</th>
							<?php
                            }
                            ?>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
	        </div>
        </div>
    </div>
</div>
 <!-- Add new clients -->
   <?php include 'views/modal/new_staffs.php';?>
<!--// -->
<!-- modal end -->
<!-- Staff Modal -->
<div class="modal fade" id="newslistmodel" tabindex="-1" aria-labelledby="newslistmodel" aria-hidden="true" style="display: none;">
  	<div class="modal-dialog full-modal">
	    <div class="modal-content">
	        <div class="modal-header-2">
		        <h5 class="modal-title" id="newslistmodel">News</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        </div>
	        <div class="modal-body font-14">
	        	<div class="panel_s">
               		<div class="panel-body">	 	                  
                		<div class="_buttons">
                			<a href="javascript:void(0);" data-toggle="modal" data-target="#newNewsModal" class="btn btn-info pull-right" data-dismiss="modal" aria-label="Close">
                				<?= _l('Add new'); ?>
                			</a>
                		</div>
                	</div>
                </div>
				<div class="table-responsive mt-2">
					<table class="table table-custom" data-order-col="0" data-order-type="asc" id='newsdata_list' style="width:100%">
						<thead>
							<th class="th-ticket-subject">Image</th>
                            <th class="th-ticket-subject">Subject</th>
							<th class="th-ticket-subject">News Description</th>
							<th class="th-ticket-subject">Date</th>
							<th class="th-ticket-subject">Action</th>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
	        </div>
        </div>
    </div>
</div>
<!-- Add new clients -->
   <?php include 'views/modal/new_news.php';?>
<!--// -->
<!-- modal end -->
<!-- Staff Modal -->
<div class="modal fade" id="tipslistmodel" tabindex="-1" aria-labelledby="tipslistmodel" aria-hidden="true" style="display: none;">
  	<div class="modal-dialog full-modal">
	    <div class="modal-content">
	        <div class="modal-header-2">
		        <h5 class="modal-title" id="tipslistmodel">Tips</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        </div>
	        <div class="modal-body font-14">
	        	<div class="panel_s">
               		<div class="panel-body">	 	                  
                		<div class="_buttons">
                			<a href="javascript:void(0);" data-toggle="modal" data-target="#newTipsModal" class="btn btn-info pull-right" data-dismiss="modal" aria-label="Close">
                				<?= _l('Add new'); ?>
                			</a>
                		</div>
                	</div>
                </div>
				<div class="table-responsive mt-2">
					<table class="table table-custom" data-order-col="0" data-order-type="asc" id='tipsdata_list' style="width:100%">
						<thead>
							<th class="th-ticket-subject">Image</th>
                            <th class="th-ticket-subject">Subject</th>
							<th class="th-ticket-subject">Description</th>
							<th class="th-ticket-subject">Date</th>
							<th class="th-ticket-subject">Action</th>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
	        </div>
        </div>
    </div>
</div>
<!-- Add new clients -->
   <?php include 'views/modal/new_tips.php';?>
<!-- Add new clients -->
<div class="modal " id="traninglistmodel" tabindex="-1" aria-labelledby="traninglistmodel" aria-hidden="true" style="display: none;">
  	<div class="modal-dialog full-modal">
	    <div class="modal-content">
	        <div class="modal-header-2">
		        <h5 class="modal-title" id="traninglistmodel">Upcoming Traning</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        </div>
	        <div class="modal-body font-14">
	        	<div class="panel_s">
               		<div class="panel-body">	 	                  
                		<div class="_buttons">
                			<a href="javascript:void(0);" data-toggle="modal" data-target="#newTraningModal" class="btn btn-info pull-right" data-dismiss="modal" aria-label="Close">
                				<?= _l('Add new'); ?>
                			</a>
                		</div>
                	</div>
                </div>
				<div class="table-responsive mt-2">
					<table class="table table-custom" data-order-col="0" data-order-type="asc" id='traningdata_list' style="width:100%">
						<thead>
							<th class="th-ticket-subject">No</th>
							<th class="th-ticket-subject">Title</th>
							<th class="th-ticket-subject">Description</th>
							<th class="th-ticket-subject">Date</th>
							<th class="th-ticket-subject">Action</th>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
	        </div>
        </div>
    </div>
</div>
<!-- Add new clients -->
   <?php include 'views/modal/new_traning.php';?>


<!-- Add new clients -->
<div class="modal fade" id="policylistmodel" tabindex="-1" aria-labelledby="policylistmodel" aria-hidden="true" style="display: none;">
  	<div class="modal-dialog full-modal">
	    <div class="modal-content">
	        <div class="modal-header-2">
		        <h5 class="modal-title" id="policylistmodel">Policy</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        </div>
	        <div class="modal-body font-14">
				<?php
                	if(get_user_id_role()==4)
                	{
                ?>
	        	<div class="panel_s">
               		<div class="panel-body">	 	                  
                		<div class="_buttons">
                			<a href="javascript:void(0);" data-toggle="modal" data-target="#newPolicyModal" class="btn btn-info pull-right" data-dismiss="modal" aria-label="Close">
                				<?= _l('Add new'); ?>
                			</a>
                		</div>
                	</div>
                </div>
				<?php } ?>
				<div class="table-responsive mt-2">
					<table class="table table-custom" data-order-col="0" data-order-type="asc" id='policydata_list' style="width:100%">
						<thead>
							<th class="th-ticket-subject">Image</th>
                            <th class="th-ticket-subject">Subject</th>
							<th class="th-ticket-subject">Date</th>
							<?php
								if(get_user_id_role()==4)
								{
							?>
							<th class="th-ticket-subject">Action</th>
							<?php }?>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
	        </div>
        </div>
    </div>
</div>
<!-- Add new clients -->
   <?php include 'views/modal/new_policy.php';?>


<!-- Add new clients -->
<div class="modal fade" id="quotelistmodel" tabindex="-1" aria-labelledby="quotelistmodel" aria-hidden="true" style="display: none;">
  	<div class="modal-dialog full-modal">
	    <div class="modal-content">
	        <div class="modal-header-2">
		        <h5 class="modal-title" id="quotelistmodel">Quote</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        </div>
	        <div class="modal-body font-14">
	        	<div class="panel_s">
               		<div class="panel-body">	 	                  
                		<div class="_buttons">
                			<a href="javascript:void(0);" data-toggle="modal" data-target="#newQuoteModal" class="btn btn-info pull-right" data-dismiss="modal" aria-label="Close">
                				<?= _l('Add new'); ?>
                			</a>
                		</div>
                	</div>
                </div>
				<div class="table-responsive mt-2">
					<table class="table table-custom" data-order-col="0" data-order-type="asc" id='quotedata_list' style="width:100%">
						<thead>
							<th class="th-ticket-subject">ID</th>
                            <th class="th-ticket-subject">Quote By</th>
							<th class="th-ticket-subject">Quote</th>
							<th class="th-ticket-subject">Date</th>
							<th class="th-ticket-subject">Action</th>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
	        </div>
        </div>
    </div>
</div>
<!-- Add new clients -->
   <?php include 'views/modal/new_quote.php';?>


<!-- Add new clients -->
<div class="modal fade" id="noticelistmodel" tabindex="-1" aria-labelledby="noticelistmodel" aria-hidden="true" style="display: none;">
  	<div class="modal-dialog full-modal">
	    <div class="modal-content">
	        <div class="modal-header-2">
		        <h5 class="modal-title" id="noticelistmodel">Notice</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        </div>
	        <div class="modal-body font-14">
	        	<div class="panel_s">
               		<div class="panel-body">	 	                  
                		<div class="_buttons">
                			<a href="javascript:void(0);" data-toggle="modal" data-target="#newNoticeModal" class="btn btn-info pull-right" data-dismiss="modal" aria-label="Close">
                				<?= _l('Add new'); ?>
                			</a>
                		</div>
                	</div>
                </div>
				<div class="table-responsive mt-2">
					<table class="table table-custom" data-order-col="0" data-order-type="asc" id='noticedata_list' style="width:100%">
						<thead>
							<th class="th-ticket-subject">No</th>
                            <th class="th-ticket-subject">Title</th>
							<th class="th-ticket-subject">Description</th>
							<th class="th-ticket-subject">Date</th>
							<th class="th-ticket-subject">Action</th>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
	        </div>
        </div>
    </div>
</div>
<!-- Add new clients -->
   <?php include 'views/modal/new_notice.php';?>

   
<!-- Add new clients -->
<div class="modal fade" id="leavelistmodel" tabindex="-1" aria-labelledby="leavelistmodel" aria-hidden="true" style="display: none;">
  	<div class="modal-dialog full-modal">
	    <div class="modal-content">
	        <div class="modal-header-2">
		        <h5 class="modal-title" id="tipslistmodel">Leave</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        </div>
	        <div class="modal-body font-14">
				<div class="table-responsive mt-2">
					<table class="table table-custom" data-order-col="0" data-order-type="asc" id='leavedata_list' style="width:100%">
						<thead>
                            <th class="th-ticket-subject">Employee ID</th>
                            <th class="th-ticket-subject">Name</th>
                            <th class="th-ticket-subject">Email</th>
                            <th class="th-ticket-subject">Phone No</th>
							<th class="th-ticket-subject">Leave Type</th>
							<th class="th-ticket-subject">Half Day Leave</th>
							<th class="th-ticket-subject">From Date</th>
							<th class="th-ticket-subject">To Date</th>
							<th class="th-ticket-subject">Date</th>
							<th class="th-ticket-subject">Description</th>
							<th class="th-ticket-subject">Action</th>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
	        </div>
        </div>
    </div>
</div>

<!-- Staff Modal -->
<div class="modal fade" id="supportlistmodel" tabindex="-1" aria-labelledby="supportlistmodel" aria-hidden="true" style="display: none;">
  	<div class="modal-dialog full-modal">
	    <div class="modal-content">
	        <div class="modal-header-2">
		        <h5 class="modal-title" id="supportlistmodel">Tickets Summary</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        </div>
	        <div class="white-box mt-5">
				<div class="clearfix">
					<div class="clearfix">
						<div class="row">
						<div class="col-md-12">
							<h4 class="text-success pull-left no-mtop tickets-summary-heading m-0"><?php echo _l('tickets_summary'); ?></h4>
							<!-- <a href="<?php echo site_url('clients/open_ticket'); ?>" class="btn btn-info new-ticket pull-right">
						<?php echo _l('clients_ticket_open_subject'); ?>
						</a> -->
							<div class="clearfix"></div>
							<hr />
						</div>
						<div class="clearfix">
							<?php foreach (get_clients_area_tickets_summary_clo($ticket_statuses) as $status) { ?>

							<div class="col-md-2 list-status ticket-status">
								<a href="<?php echo $status['url']; ?>" class="<?php if (in_array($status['ticketstatusid'], $list_statuses)) {
																				echo 'active';
																				} ?>">
								<h3 class="bold ticket-status-heading">
									<?php echo $status['total_tickets'] ?>
								</h3>
								<span style="color:<?php echo $status['statuscolor']; ?>">
									<?php echo $status['translated_name']; ?>
								</span>
								</a>
							</div>
							<?php } ?>
						</div>
						</div>
						<div class="clearfix"></div>
						<hr />
						<div class="clearfix"></div>
						<div class="row">
						<div class="col-md-12">
						<div class="table-responsive mt-2">
							<table class="table table-custom" data-order-col="0" data-order-type="asc" id='loadTicketData_list' style="width:100%">
								<thead>
									<th class="th-ticket-subject">Ticket #</th>
									<th class="th-ticket-subject">Client Name</th>
									<th class="th-ticket-subject">Subject</th>
									<th class="th-ticket-subject">Priority</th>
									<th class="th-ticket-subject">Status</th>
									<th class="th-ticket-subject">Last Reply</th>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
							<?php //get_template_part('tickets_table'); ?>
						</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- incident list -->
<div class="modal fade" id="Incidentlistmodel" tabindex="-1" aria-labelledby="Incidentlistmodel" aria-hidden="true" style="display: none;">
  	<div class="modal-dialog full-modal">
	    <div class="modal-content">
	        <div class="modal-header-2">
		        <h5 class="modal-title" id="tipslistmodel">Incident List</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        </div>
	        <div class="modal-body font-14">
				<div class="table-responsive mt-2">
					<table class="table table-custom" data-order-col="0" data-order-type="asc" id='loadincdentData_list' style="width:100%">
						<thead>
                            <th class="th-ticket-subject">Ticket #</th>
                            <th class="th-ticket-subject">Employee Name</th>
                            <th class="th-ticket-subject">Client Name</th>
                            <th class="th-ticket-subject">Date / Time</th>
							<th class="th-ticket-subject">Status</th>
							<th class="th-ticket-subject">Last Reply</th>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
	        </div>
        </div>
    </div>
</div>

<!-- Account model -->
<div class="modal fade" id="profileviewmodel" tabindex="-1" aria-labelledby="profileviewmodel" aria-hidden="true" style="display: none;">
  	<div class="modal-dialog full-modal">
	    <div class="modal-content">
	        <div class="modal-header-2">
		        <h5 class="modal-title" id="tipslistmodel">Incident List</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
	        </div>
	        <div class="row section-heading section-profile">
				<div class="col-md-8">
					<div class="white-box">
						<?php echo form_open_multipart('clients/profiles', array('autocomplete' => 'off')); ?>
						<?php echo form_hidden('profile', true); ?>

						<div class="panel_s">
							<div class="clearfix">
								<h4 class="title"><?php echo _l('clients_profile_heading'); ?></h4>
								<div class="row">
									<div class="col-md-12">
										

										<div class="row">
											<div class="col-md-6">
											<div class="form-group">
											<?php 
											$filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => get_client_user_id(), 'rel_type' => 'profile_image'))->row('file_name');
											if($filename==''){ 
											?>
												<div class="form-group profile-image-upload-group">
													<label for="profile_image" class="profile-image"><?php echo _l('client_profile_image'); ?></label>
													<input type="file" name="profile_image"  extension="png,jpg,jpeg" accept=".png,.jpg,.jpeg" class="form-control" >
												</div>
											<?php } ?>
											<?php
											$filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => get_client_user_id(), 'rel_type' => 'profile_image'))->row('file_name');

											if($filename!=''){  
											?>
												<div class="form-group profile-image-group">
													<div class="mb-2">
														<img src="<?= base_url('uploads/profile_image/'.get_client_user_id().'/'.$filename); ?>" class="client-profile-image-thumb" width="140">
													</div>
													

													<div class="clearfix">
													<input type="file" name="profile_image" id="profile-image" extension="png,jpg,jpeg" accept=".png,.jpg,.jpeg"  class="form-control">
													</div>
												</div>
											<?php } ?>
										</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group profile-firstname-group">
													<label for="firstname"><?php echo _l('clients_firstname'); ?></label>
													<input type="text" class="form-control" maxlength="15"  name="firstname" id="firstname" value="<?php echo set_value('firstname', $contact->firstname); ?>" required>
													<?php echo form_error('firstname'); ?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group profile-lastname-group">
													<label for="lastname"><?php echo _l('clients_lastname'); ?></label>
													<input type="text" class="form-control" maxlength="15"  name="lastname" id="lastname" value="<?php echo set_value('lastname', $contact->lastname); ?>" required>
													<?php echo form_error('lastname'); ?>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group profile-email-group">
													<label for="email"><?php echo _l('clients_email'); ?></label>
													<input type="email" name="email" class="form-control" id="email" readonly value="<?php echo $contact->email; ?>">
													<?php echo form_error('email'); ?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group profile-phone-group">
													<label for="phonenumber"><?php echo _l('clients_phone'); ?></label>
													<input type="text" class="form-control" name="phonenumber" readonly minlength="9" required maxlength="12"  id="phonenumber" value="<?php echo $contact->phonenumber; ?>">
													<?php echo form_error('phonenumber'); ?>
												</div>
											</div>
										</div>

										<div class="row">

											<div class="col-md-6">
												<div class="form-group p-0">
													<label>DOB</label>
													<input class="form-control" placeholder="DOB" name="dob"  readonly id="dob_profile"  value="<?php echo date('d-m-Y', strtotime($contact->dob));  ?>">
													<?php echo form_error('dob'); ?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group pos-rel">
													<label>Program/Department</label>
													<select name="department_id[]"  class="custom-dropdown selectpicker"  multiple="">
													<!-- <select name="department_id[]"  class="custom-dropdown selectpicker" readonly data-live-search="true" multiple=""> -->
												<!--  <select class="selectpicker custom-dropdown"> -->
														<option>Select Department</option>
														<?php 
														if($contact->department_id!=''){
																$department_ids = explode(",",$contact->department_id);
																
																$result_m = $this->db->get_where(db_prefix().'department')->result();

															foreach($result_m as $row_m)
															{
																if (in_array($row_m->id, $department_ids))
																{
																	echo $selected = 'selected';
																}
																else
																{
																	echo    $selected = '';
																}   
																
																	echo "<option value='".$row_m->id."' ".$selected." >".$row_m->name."</option>";
																
															}
														}else{
															?>
															<?php
															if($department_res)
															{
																foreach($department_res as $r)
																{
																	?>
																		<option value="<?= $r->id; ?>" ><?= $r->name; ?></option>
																	<?php
																}
															}
														?> 

														<?php } ?>
													</select>
													<div class="prgm-overlay"></div>
													<?php echo form_error('department_id'); ?>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Address</label>
													<input type="text" class="form-control"  name="address" value="<?= (isset($contact)?$contact->address:""); ?>">
													<?php echo form_error('address'); ?>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Country</label>
													<?php 
														$country_list = $this->db->get_where(db_prefix().'country')->result();

													?>
													
													<select class="custom-dropdown selectpicker" data-live-search="true" name="country" id="profilecountry" required  onchange="getStatelistProfile(this.value);">
														<?php
														if($country_list)
														{
															foreach($country_list as $res)
															{
																?>
																	<option <?= ($contact->country == $res->id)?"selected":""; ?> value="<?= $res->id; ?>"><?= $res->name; ?></option>
																<?php
															}
														}
													?>
													</select>
													<?php echo form_error('country'); ?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>State</label>
													<?php 
														$state_list = $this->db->get_where(db_prefix().'state')->result();

													?>
													<select class="custom-dropdown selectpicker profilestate"  data-live-search="true" name="state" required id="profilestate" onchange="getCitylistProfile(this.value);">
														<?php
														if($state_list)
														{
															foreach($state_list as $sk=>$sv)
															{
																?>
																	<option <?= ($contact->state == $sv->id)?"selected":""; ?> value="<?= $sv->id; ?>"><?= $sv->name; ?></option>
																<?php
															}
														}
														?>
													</select>
													<?php echo form_error('state'); ?>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>City</label>
													<?php 
														$city_list = $this->db->get_where(db_prefix().'city')->result();
													?>
													<select class="custom-dropdown selectpicker profilecity "  data-live-search="true" name="city" required id="profilecity">
														<?php
														if($state_list)
														{
															foreach($city_list as $ck=>$cv)
															{
																?>
																	<option <?= ($contact->city == $cv->id)?"selected":""; ?> value="<?= $cv->id; ?>"><?= $cv->name; ?></option>
																<?php
															}
														}
														?>
														
													</select>
													<?php echo form_error('city'); ?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group profile-lastname-group">
													<label for="postal_code"><?= _l('Postal Code'); ?></label>
													<input type="text" class="form-control" name="postal_code" value="<?= @$contact->postal_code; ?>" required>
													<?php echo form_error('postal_code'); ?>
												</div>
											</div>
										</div>

										<div class="row">
											
											<div class="col-md-6">
												<button type="submit" class="btn btn-info contact-profile-save pr-2 pl-2 mt-1"><?php echo _l('clients_edit_profile_update_btn'); ?></button>
											</div>
										</div>


										

									</div>

								</div>
							</div>
						</div>

						<?php echo form_close(); ?>
					</div>
				</div>

				<div class="col-md-4 contact-profile-change-password-section">
					<div class="white-box">
						<div class="panel_s">
							<div class="clearfix">
								<h4 class="title"><?php echo _l('clients_edit_profile_change_password_heading'); ?></h4>
								<?php echo form_open('clients/profiles'); ?>
								<?php echo form_hidden('change_password', true); ?>
								<div class="form-group">
									<label for="oldpassword"><?php echo _l('clients_edit_profile_old_password'); ?></label>
									<input type="password" class="form-control" name="oldpassword" id="oldpassword">
									<?php echo form_error('oldpassword'); ?>
								</div>
								<div class="form-group">
									<label for="newpassword"><?php echo _l('clients_edit_profile_new_password'); ?></label>
									<input type="password" class="form-control" name="newpassword" id="newpassword">
									<?php echo form_error('newpassword'); ?>
								</div>
								<div class="form-group">
									<label for="newpasswordr"><?php echo _l('clients_edit_profile_new_password_repeat'); ?></label>
									<input type="password" class="form-control" name="newpasswordr" id="newpasswordr">
									<?php echo form_error('newpasswordr'); ?>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-info btn-block mt-2"><?php echo _l('clients_edit_profile_change_password_btn'); ?></button>
								</div>
								<?php echo form_close(); ?>
							</div>
							<?php if ($contact->last_password_change !== NULL) { ?>
								<div class="panel-footer last-password-change">
									<?php echo _l('clients_profile_last_changed_password', time_ago($contact->last_password_change)); ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- modal end -->


<script>
	$(document).ready(function(){
		$("#add-roster").click(function(){
	    	$("#append-roster").append("<hr><div class='form-group mr-0 ml-0'><label for='inputTitle' class='control-label'>Title</label><div class='col-sm-10'><input type='text' class='form-group mr-0 ml-0'></div></div><div class='form-group'><label for='inputTitle' class='control-label'>Upload</label><div class='col-sm-10'><input type='file' class='form-control'></div></div>");
	  	});
	});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script>
    /* Success message  */
    // function successmsg(msg)
    // {
    //     toastr.success('',msg);
    // }
    
    // function errormsg(msg)
    // {
    //     toastr.error('',msg);
    // }

    <?php if($this->session->flashdata('success')){ ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php }else if($this->session->flashdata('error')){ ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
    <?php }else if($this->session->flashdata('warning')){ ?>
    toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
    <?php }else if($this->session->flashdata('info')){ ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>



    var clients_name = '<?= $client_data->firstname.' ' .$client_data->lastname?>';
    $('.clients_name').text(clients_name);
    var clientid = '<?= $client_data->userid; ?>';
    $('.clientid').val(clientid);

</script>



<script type='text/javascript'>
    var islogin = '<?= $client_data->userid; ?>';
     var get_client_user_id = '<?= get_client_user_id(); ?>';
    var get_user_id_role = '<?= get_user_id_role(); ?>';
    $(document).ready(function() {

        if(get_user_id_role=='4' && get_client_user_id!=''){
            leaveclientlist_table = $('#leavedata_list').DataTable({ 
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' servermside processing mode.
                "order": [], //Initial no order.
                "ordering": false,
                "searching": false,
                "ajax": {
                    "url": "<?php echo base_url('clients/loadLeaveData')?>",
                    "type": "POST",
                    "dataType": "json",
                    "data":{},
                    "data": function ( data ) {
                    data.filter_by = {};
                    },
                    "dataSrc": function (jsonData) {
                    return jsonData.data;
                    }
                },
            });

			leaveclientlist_table = $('#loadincdentData_list').DataTable({ 
                "processing": true, //Feature control the processing indicator.
                "serverSide": false, //Feature control DataTables' servermside processing mode.
                "order": [[0,'desc']], //Initial no order.
                "ordering": true,
                "searching": true,
                "ajax": {
                    "url": "<?php echo base_url('incident/loadincdentData')?>",
                    "type": "POST",
                    "dataType": "json",
                    "data":{},
                    "data": function ( data ) {
                    data.filter_by = {};
                    },
                    "dataSrc": function (jsonData) {
                    return jsonData.data;
                    }
                },
            });

			leaveclientlist_table = $('#loadTicketData_list').DataTable({ 
                "processing": true, //Feature control the processing indicator.
                "serverSide": false, //Feature control DataTables' servermside processing mode.
                "order": [[0,'desc']], //Initial no order.
                "ordering": true,
                "searching": true,
                "ajax": {
                    "url": "<?php echo base_url('clients/loadticketData')?>",
                    "type": "POST",
                    "dataType": "json",
                    "data":{},
                    "data": function ( data ) {
                    data.filter_by = {};
                    },
                    "dataSrc": function (jsonData) {
                    return jsonData.data;
                    }
                },
            });
        }
        });



    function getLeave() 
    {
        leaveclientlist_table.ajax.reload();
    }
    
function changeLeaveStatus(id,status)
{

// var r = confirm("Are you sure want to Change Status?");
//   if (r == true) {
    $.ajax({
          url: '<?=base_url()?>clients/changeLeaveStatus/'+id+'/'+status,
          type: 'get',
          dataType: 'json',
          success: function(response){
              successmsg('Status Change Successfully');
              leaveclientlist_table.ajax.reload(); 
          }
     });
//   }
}


function changeClientStatus(userid,active)
    {        
        var r = confirm("Are you sure want to Change Status?");
        if (r == true) {
        $.ajax({
              url: '<?=base_url()?>clients/changeClientStatus/'+userid+'/'+active,
              type: 'get',
              dataType: 'json',
              success: function(response){
				  successmsg('Status Change Successfully');
                  clientlist_table.ajax.reload();
                  
              }
         });
		 setTimeout(function() {
			getCLOClients();
		}, 100);		 
      }
    }


    // $(".toggle-tt").click(function(){
    //   $(".hover-tooltip a").tooltip('toggle'); 
    // });



	$('.wrapper-loader').show();

setTimeout(function() {
		  $('.wrapper-loader').hide();

}, 500);

/* Get CLO Clients */
function getCLOClients()
{
	$.ajax({
		url: '<?=base_url()?>clients/countCLOClient',
		type: 'get',
		dataType: 'json',
		success: function(response){
			$('.totalclo_client').text(response.totalclo_client);
			$('.totalclo_client_active').text(response.totalclo_client_active);
			$('.totalclo_client_deactive').text(response.totalclo_client_deactive);
			$('.totalclo_client_week').text(response.totalclo_client_week);
			$('.totalclo_client_month').text(response.totalclo_client_month);
			$('.totalclo_client_year').text(response.totalclo_client_year);
		}
	});
}


$(document).ready(function(){
	$("#from_date").datepicker({
		//minDate:0,
		dateFormat: 'yy-mm-dd',
		onSelect: function(selected) {
			$("#to_date").datepicker("option","minDate", selected)
		}
	});
	$("#to_date").datepicker({ 
		//minDate:0,
		dateFormat: 'yy-mm-dd',
		onSelect: function(selected) {
			$("#from_date").datepicker("option","maxDate", selected)
		}
	});  
});



$('#filter').click(function(){
	var status = $('#clo_status option:selected').val();
	if($('#from_date').val()!='' && $('#to_date').val() ==''){
		$('#to_date').val($('#from_date').val());
	}
	if($('#to_date').val()!='' && $('#from_date').val() ==''){
		$('#from_date').val($('#to_date').val());
	}
	var from_date = $('#from_date').val();
	var to_date = $('#to_date').val();
	
	var table = $('#clientdata_list').DataTable(); 
    table.destroy();
	clientlist_table = $('#clientdata_list').DataTable({ 
		"processing": true, //Feature control the processing indicator.
		"serverSide": false, //Feature control DataTables' servermside processing mode.
		"order": [['0','desc']], //Initial no order.
		"ordering": true,
		"searching": true,
		"ajax": {
			"url": "<?php echo base_url('clients/loadClientsData')?>?from_date="+from_date+"&&to_date="+to_date+'&&status='+status,
			"type": "POST",
			"dataType": "json",
			"data":{},
			"data": function ( data ) {
			data.filter_by = {};
			},
			"dataSrc": function (jsonData) {
			return jsonData.data;
			}
		},
	});
});

$('#clearfilter').click(function(){
	$('#clo_status option:first').prop('selected',true).trigger( "change" );
	$('#from_date').val('');
	$('#to_date').val('');
	var table = $('#clientdata_list').DataTable(); 
    table.destroy();
	clientlist_table = $('#clientdata_list').DataTable({ 
		"processing": true, //Feature control the processing indicator.
		"serverSide": false, //Feature control DataTables' servermside processing mode.
		"order": [[0,'desc']], //Initial no order.
		"ordering": true,
		"searching": true,
		"ajax": {
			"url": "<?php echo base_url('clients/loadClientsData')?>",
			"type": "POST",
			"dataType": "json",
			"data":{},
			"data": function ( data ) {
			data.filter_by = {};
			},
			"dataSrc": function (jsonData) {
			return jsonData.data;
			}
		},
	});
});

$('#client_export').click(function(){

	var status = $('#clo_status option:selected').val();
	if($('#from_date').val()!='' && $('#to_date').val() ==''){
		$('#to_date').val($('#from_date').val());
	}
	if($('#to_date').val()!='' && $('#from_date').val() ==''){
		$('#from_date').val($('#to_date').val());
	}
	var from_date = $('#from_date').val();
	var to_date = $('#to_date').val();
	
	window.location.href="<?php echo base_url('clients/exportClients')?>?from_date="+from_date+"&&to_date="+to_date+'&&status='+status;//'<?= base_url() ?>clients/exportClients';
});

//var str = "<?php echo $_GET['showModel'];?>";
var id=localStorage.getItem('openModal');
if(id){
	setTimeout(function() {
			$("#"+id).modal('show');
		}, 1000);

		localStorage.clear();


}
</script>

