<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="panel_s section-heading section-projects">
   <div class="panel-body">
      <h4 class="no-margin section-text"><?php echo _l('clients_my_projects'); ?></h4>
   </div>
</div>
<div class="panel_s">
   <div class="panel-body">
      <div class="row">
         <div class="col-md-12">
            <div class="header-wrap p-10 bg-white">
               <div class="d-flex align-items-center">
                  <div>
                     <h4 class="fw-700 mt-0">My Properties</h4>
                  </div>
                  <div class="ml-auto align-items-center">
                     <div class="dl">
                        <select class="form-control">
                           <option>Select filter</option>
                           <option>Home</option>
                           <option>Row House</option>
                           <option>Appartment</option>
                           <option>Duplex</option>
                           <option>Bunglow</option>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <hr class="mt-0 mb-0">
      <div class="row">
         <div class="col-md-12">
            <div class="stats-wrap p-10 bg-white">
               <div class="propert-div-wrap">
                  <h4>2253 Lenox Place</h4>
                  <h5>Santa Clara, CA 95054 | Santa Clara County</h5>
                  <a class="btn cbtn-btn" href="javascript:void(0);" data-toggle="modal" data-target="#shareModal">Share property</a>
                  <hr>
                  <div class="d-flex align-items-center">
                     <div class="img-holder">
                        <a href="<?= site_url('clients/properties')?>" style="display:block;">
                           <img src="http://php.manageprojects.in/reppointment_admin/assets/images/property/property1.png">
                        </a>
                     </div>
                     <div class="dl">
                        <div class="amenities-wrap">
                           <div class="icons-list" data-type="list">
                              <div class="listitem">
                                 <div class="outside-container">
                                    <div class="txt">ASKING PRICE</div>
                                    <div class="txt-specs">$1,320,000</div>
                                 </div>
                              </div>
                              <div class="listitem">
                                 <div class="outside-container">
                                    <div class="txt">BEDROOMS</div>
                                    <div class="txt-specs">4</div>
                                 </div>
                              </div>
                              <div class="listitem">
                                 <div class="outside-container">
                                    <div class="txt">SQ. FT.</div>
                                    <div class="txt-specs">1599</div>
                                 </div>
                              </div>
                              <div class="listitem">
                                 <div class="outside-container">
                                    <div class="txt">LOT SIZE</div>
                                    <div class="txt-specs">2297 Sq. Ft</div>
                                 </div>
                              </div>
                              <div class="listitem">
                                 <div class="outside-container">
                                    <div class="txt">PROPERTY TYPE</div>
                                    <div class="txt-specs">Single Family</div>
                                 </div>
                              </div>
                              <div class="listitem">
                                 <div class="outside-container">
                                    <div class="txt">BATHROOMS</div>
                                    <div class="txt-specs">2.5</div>
                                 </div>
                              </div>
                              <div class="listitem">
                                 <div class="outside-container">
                                    <div class="txt">$/SQ. FT.</div>
                                    <div class="txt-specs">$826</div>
                                 </div>
                              </div>
                              <div class="listitem">
                                 <div class="outside-container">
                                    <div class="txt">YEAR BUILT</div>
                                    <div class="txt-specs">1998</div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <ul class="nav nav-tabs mb-5">
                  <li class="active"><a data-toggle="tab" href="#home">DOCS</a></li>
                  <li><a data-toggle="tab" href="#menu1">OFFER</a></li>
                  <li><a data-toggle="tab" href="#menu2">VIEWER</a></li>
                  <li><a data-toggle="tab" href="#menu3">ACTIVITY</a></li>
                  <li><a data-toggle="tab" href="#menu4">SETTINGS</a></li>
               </ul>

               <div class="tab-content">
                  <div id="home" class="tab-pane fade in active">
                     <div class="home-wrap">
                        <div class="d-flex align-items-center">
                           <div>
                              <h5 class="text-large text-bold text-underline">15 Documents</h5>
                           </div>
                           <div class="ml-auto align-items-center">
                              <div class="dl">
                                 <div class="form-group mb-0">
                                    <input type="text" class="form-control" placeholder="Search">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <a class="btn cbtn-btn" href="javascript:void(0);" style="color:#fff;">Download</a>
                        <a class="btn cbtn-btn" href="javascript:void(0);" style="color:#fff;">Docusign</a>
                     </div>
                     <div class="doc-list">
                        <div class="d-flex align-items-center mt-20">
                           <div class="img-holder">
                              <img src="http://php.manageprojects.in/reppointment_admin/assets/images/property/doc.png" class="img-fluid">
                           </div>
                           <div class="content ml-20">
                              <h3 class="mt-0"><b>Elevate Group</b></h3>
                              <div class="card-subtitle text-gray mb-2">
                                 <span>5 pages</span>
                                 <span> | </span>
                                 <span>414.64 kB</span>
                                 <span> | </span>
                                 <span>Updated Jun 8, 2020 03:06AM</span>
                              </div>
                           </div>
                        </div>

                        <div class="d-flex align-items-center mt-20">
                           <div class="img-holder">
                              <img src="http://php.manageprojects.in/reppointment_admin/assets/images/property/doc.png" class="img-fluid">
                           </div>
                           <div class="content ml-20">
                              <h3 class="mt-0"><b>Elevate Group</b></h3>
                              <div class="card-subtitle text-gray mb-2">
                                 <span>5 pages</span>
                                 <span> | </span>
                                 <span>414.64 kB</span>
                                 <span> | </span>
                                 <span>Updated Jun 8, 2020 03:06AM</span>
                              </div>
                           </div>
                        </div>

                        <div class="d-flex align-items-center mt-20">
                           <div class="img-holder">
                              <img src="http://php.manageprojects.in/reppointment_admin/assets/images/property/doc.png" class="img-fluid">
                           </div>
                           <div class="content ml-20">
                              <h3 class="mt-0"><b>Elevate Group</b></h3>
                              <div class="card-subtitle text-gray mb-2">
                                 <span>5 pages</span>
                                 <span> | </span>
                                 <span>414.64 kB</span>
                                 <span> | </span>
                                 <span>Updated Jun 8, 2020 03:06AM</span>
                              </div>
                           </div>
                        </div>

                        <div class="d-flex align-items-center mt-20">
                           <div class="img-holder">
                              <img src="http://php.manageprojects.in/reppointment_admin/assets/images/property/doc.png" class="img-fluid">
                           </div>
                           <div class="content ml-20">
                              <h3 class="mt-0"><b>Elevate Group</b></h3>
                              <div class="card-subtitle text-gray mb-2">
                                 <span>5 pages</span>
                                 <span> | </span>
                                 <span>414.64 kB</span>
                                 <span> | </span>
                                 <span>Updated Jun 8, 2020 03:06AM</span>
                              </div>
                           </div>
                        </div>

                        <div class="d-flex align-items-center mt-20">
                           <div class="img-holder">
                              <img src="http://php.manageprojects.in/reppointment_admin/assets/images/property/doc.png" class="img-fluid">
                           </div>
                           <div class="content ml-20">
                              <h3 class="mt-0"><b>Elevate Group</b></h3>
                              <div class="card-subtitle text-gray mb-2">
                                 <span>5 pages</span>
                                 <span> | </span>
                                 <span>414.64 kB</span>
                                 <span> | </span>
                                 <span>Updated Jun 8, 2020 03:06AM</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="menu1" class="tab-pane fade">
                     <div class="menu1 text-center">
                        <h3><b>OFFERS DISABLED</b></h3>
                        <p>The Listing Agent has disabled offers for this listing. To submit an offer, please reach out to them directly.</p>
                     </div>
                  </div>
                  <div id="menu2" class="tab-pane fade">
                     <div class="menu2">
                        <div class="d-flex align-items-center pl-20 pr-20" style="background-color: #eee;padding: 10px;">
                           <div>
                              <form class="form-inline">
                                 <div class="form-group">
                                    <label>Filter</label>
                                    <select class="form-control">
                                       <option>Select filter</option>
                                       <option>Active</option>
                                       <option>Lsiting team</option>
                                       <option>Team leader</option>
                                       <option>Buyer</option>
                                       <option>Seller</option>
                                       <option>Removed</option>
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label>Sort</label>
                                    <select class="form-control">
                                       <option>Name(A-Z)</option>
                                       <option>Email(A-Z)</option>
                                       <option>Shared(First-Last)</option>
                                    </select>
                                 </div>
                              </form>
                           </div>
                           <div class="ml-auto align-items-center">
                              <div class="dl">
                                 <div class="form-group mb-0">
                                    <input type="text" class="form-control" placeholder="Search">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <hr class="mt-20 mb-0">
                        <div class="card">
                           <div class="card-header">
                              <div class="d-flex align-items-center">
                                 <div>
                                    <a class="btn cbtn-btn" href="javascript:void(0);" style="color:#fff;">Share property</a>
                                 </div>
                                 <div class="ml-auto align-items-center">
                                    <div class="dl">
                                       <a class="btn cbtn-btn" href="javascript:void(0);" style="color:#fff;">Manage Pending Viewers</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="card-body">
                              <div class="d-flex align-items-center">
                                 <div class="img-holder">
                                    <span>GS</span>
                                 </div>
                                 <div class="content ml-20">
                                    <h3><b>Elevate Group</b></h3>
                                    <h5>team@elevate.homes</h5>
                                    <h6>(650) 918-6511</h6>
                                    <h6>Listing Team</h6>
                                 </div>
                              </div>
                              <a class="btn cbtn-btn mt-20" href="javascript:void(0);">View Activity</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="menu3" class="tab-pane fade">
                     <div class="menu3">
                        <ul style="list-style:disc;margin-left:40px;">
                           <li style="line-height:40px;font-size: 16px;font-weight: 500;">Learn which buyers are most active in your property</li>
                           <li style="line-height:40px;font-size: 16px;font-weight: 500;">Track every share, view and download of your disclosures</li>
                           <li style="line-height:40px;font-size: 16px;font-weight: 500;">Verify the sending, receipt and viewing of all documents</li>
                        </ul>
                        <br>
                        <a class="btn cbtn-btn" href="javascript:void(0);" style="color:#fff;">Update to Pro</a>
                     </div>
                  </div>
                  <div id="menu4" class="tab-pane fade">
                     <div class="home-wrap">
                        <div class="pb-12">
                           <h5 class="text-large text-bold text-underline">Notification Preferences</h5>
                           <div class="form-group ">
                              <label class="form-checkbox">
                                 <input id="mute-notifications" type="checkbox">
                                 <i class="form-icon"></i> Mute view and download notifications
                              </label>
                           </div>
                           <div>To manage notifications for all properties, <a href="javascript:void(0);">go here</a>.</div>
                        </div>
                        <div class="pb-12">
                           <h5 class="text-large text-bold text-underline">Leave Property</h5>
                           <p>You and your clients will lose access and stop receiving updates. This action cannot be undone.</p>
                           <button class="btn cbtn-btn">Leave Property</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>







      <!--<div class="row mbot15">
         <div class="col-md-12">
            <h3 class="text-success projects-summary-heading no-mtop mbot15"><?php echo _l('projects_summary'); ?></h3>
         </div>
         <?php get_template_part('projects/project_summary'); ?>
      </div>
      <hr />
         <table class="table dt-table table-projects" data-order-col="2" data-order-type="desc">
            <thead>
               <tr>
                  <th class="th-project-name"><?php echo _l('project_name'); ?></th>
                  <th class="th-project-start-date"><?php echo _l('project_start_date'); ?></th>
                  <th class="th-project-deadline"><?php echo _l('project_deadline'); ?></th>
                  <th class="th-project-billing-type"><?php echo _l('project_billing_type'); ?></th>
                  <?php
                     $custom_fields = get_custom_fields('projects',array('show_on_client_portal'=>1));
                     foreach($custom_fields as $field){ ?>
                  <th><?php echo $field['name']; ?></th>
                  <?php } ?>
                  <th><?php echo _l('project_status'); ?></th>
               </tr>
            </thead>
            <tbody>
               <?php foreach($projects as $project){ ?>
               <tr>
                  <td><a href="<?php echo site_url('clients/project/'.$project['id']); ?>"><?php echo $project['name']; ?></a></td>
                  <td data-order="<?php echo $project['start_date']; ?>"><?php echo _d($project['start_date']); ?></td>
                  <td data-order="<?php echo $project['deadline']; ?>"><?php echo _d($project['deadline']); ?></td>
                  <td>
                     <?php
                        if($project['billing_type'] == 1){
                          $type_name = 'project_billing_type_fixed_cost';
                        } else if($project['billing_type'] == 2){
                          $type_name = 'project_billing_type_project_hours';
                        } else {
                          $type_name = 'project_billing_type_project_task_hours';
                        }
                        echo _l($type_name);
                        ?>
                  </td>
                  <?php foreach($custom_fields as $field){ ?>
                  <td><?php echo get_custom_field_value($project['id'],$field['id'],'projects'); ?></td>
                  <?php } ?>
                  <td>
                     <?php
                        $status = get_project_status_by_id($project['status']);
                        echo '<span class="label inline-block" style="color:'.$status['color'].';border:1px solid '.$status['color'].'">'.$status['name'].'</span>';
                        ?>
                  </td>
               </tr>
               <?php } ?>
            </tbody>
         </table>-->
   </div>
</div>


<!-- Edit Modal -->
<div class="modal" id="editModal">
  	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Edit Property</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form>
					<div class="row">
						<div class="col-md-4">
							
						</div>
						<div class="col-md-8">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="title">Title</label>
										<input type="text" class="form-control" placeholder="Enter title" id="title">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="price">Price</label>
										<input type="text" class="form-control" placeholder="Enter price" id="price">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="price">Address</label>
								<textarea class="form-control" placeholder="Enter address" id="address" rows="2"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="price">Builder name</label>
								<input type="text" class="form-control" placeholder="Enter builder name" id="builder name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="price">Status</label>
								<select class="form-control">
									<option>Select status</option>
									<option>Active</option>
									<option>Expired</option>
									<option>On hold</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Discard</button>
			</div>
		</div>
	</div>
</div>

<!-- Delete Modal -->
<div class="modal" id="deleteModal">
  	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Delete Confirmation</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				Are you sue, want to delete this property?
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Confirm</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<!-- Add Property Modal -->
<div class="modal" id="addpropertyModal">
  	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Add New Property</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form>
					<div class="row">
						<div class="col-md-4">
							
						</div>
						<div class="col-md-8">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="title">Title</label>
										<input type="text" class="form-control" placeholder="Enter title" id="title">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="details">Details</label>
										<textarea class="form-control" placeholder="Enter details" id="details" rows="3"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="price">property type</label>
								<select class="form-control">
									<option>Select type</option>
									<option>Home</option>
									<option>Appartment</option>
									<option>Duplex</option>
									<option>Bunglow</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="amount">Amount</label>
								<input type="text" class="form-control" placeholder="Enter amount" id="amount">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="age">Poperty age</label>
								<input type="text" class="form-control" placeholder="Enter age" id="age">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="land">Land</label>
								<input type="text" class="form-control" placeholder="Enter land" id="land">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="size">Size</label>
								<input type="text" class="form-control" placeholder="Enter size" id="size">
							</div>
						</div>
					</div>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Discard</button>
			</div>
		</div>
	</div>
</div>

<!-- Share Property Modal -->
<div class="modal" id="shareModal">
  	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Share property</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
            <form>
               <div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="price">Role </label>
								<select class="form-control">
									<option>Select role</option>
									<option>Buyer</option>
									<option>Team member</option>
								</select>
							</div>
						</div>
               </div>
               <div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" class="form-control" placeholder="Enter name" id="name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="text" class="form-control" placeholder="Enter email" id="email">
							</div>
						</div>
					</div>
               <div class="row">
						<div class="col-md-12">
							<div class="form-group">
                        <label for="msg">Custom Message</label>
								<textareea class="form-control" placeholder="Enter custom message" id="msg" rows="3"></textarea>
							</div>
						</div>
               </div>
            </form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Share property</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>