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
                        <h4 class="fw-700 mt-0">
                            My Listings
                        </h4>
                        <span class="float-right"><b>Subscription expires</b>
                            <?php
                                if($planlimit->plan_expired > 0)
                                {
                                    echo '<span class="text-info">'.date('d-M,Y', $planlimit->plan_expired).'</span> ';
                                }
                                else
                                {
                                    echo '<span class="text-danger"> Expired </span> ';
                                }
                            ?>, 
                            <b> Active limit</b>: <?= $planlimit->property_limit; ?>
                        </span>
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
                  <div class="d-flex align-items-center pl-20 pr-20 hide" style="background-color: #eee;padding: 10px;">
                     <div>
                        <form class="form-inline">
                           <div class="form-group">
                              <label>Filter</label>
                              <select class="form-control">
                                 <option>Select filter</option>
                                 <option>Name</option>
                                 <option>City</option>
                                 <option>Date listed</option>
                              </select>
                           </div>
                           <div class="form-group">
                              <label>Sort</label>
                              <select class="form-control">
                                 <option>All</option>
                                 <option>Active</option>
                                 <option>Inactive</option>
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
                  <?php
                    if($agent_property)
                    {
                        foreach($agent_property as $res)
                        {
                            ?>
                                <div class="property-holder mt-20 pos-rel">
                                    <div class="d-flex align-items-center">
                                        <div class="img-holder">
                                            <a href="<?= site_url('clients/properties/'.$res->id)?>" style="display:block;">
                                                <?php 
                                                    if($res->defaultimage == 1)
                                                    {
                                                        $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $res->id, 'rel_type' => "propertyimg"))->row(); 
                                                    }
                                                    else
                                                    {
                                                        $i = $res->defaultimage - 1;
                                                        $property = 'property'.$i;
                                                        $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $res->id, 'rel_type' => $property))->row(); 
                                                    }
                                                ?>
        					                    <img src="<?= site_url('download/file/taskattachment/'. $imageArray->attachment_key); ?>" style="width:150px; height:150px;box-shadow: 0px 5px 15px 0px #ccc;" alt="<?= $imageArray->attachment_key; ?>" />
                                            </a>
                                        </div>
                						<div class="dl" style="width: 350px;">
                							<h4><?= $res->name; ?></h4>
                							<h5><?= substr($res->address, 0, 30); ?></h5>
                							<span class="view"><?= $tproperty = $this->db->get_where(db_prefix().'appointment_booking', array('property_id' => $res->id))->num_rows(); ?> Appointments</span>
                							<!--<a class="btn cbtn-btn" href="javascript:void(0);" data-toggle="modal" data-target="#shareModal">Share property</a>-->
                							<!--<a class="btn cbtn-btn btn-outline" href="<?= site_url('clients/properties/'.$res->id)?>">Details</a>-->
                						</div>
                						<div class="dl" style="margin-left: 120px;">
                							<!--<h4><?= $res->name; ?></h4>-->
                							<!--<h5><?= $res->address; ?></h5>-->
                							<!--<span class="view">0 Appointments</span>-->
                							<!--<a class="btn cbtn-btn" href="javascript:void(0);" data-toggle="modal" data-target="#shareModal">Share property</a>&nbsp;&nbsp;&nbsp;&nbsp;-->
                							<a class="btn cbtn-btn btn-outline" href="<?= site_url('clients/properties/'.$res->id)?>">Details</a>
                							<label>  
                							     <span>Active</span><br>
                							    <?php
                							        if($res->status == 1)
                							        {
                							            ?>
                							                <input type="checkbox" onClick="changeStatus(<?= $res->id ?>);" checked name="propertyid<?= $res->id; ?>" id="propertyid<?= $res->id; ?>">         
                							            <?php
                							        }
                							        else
                							        {
                							            ?>
                							                <input type="checkbox" onClick="changeStatus(<?= $res->id ?>);" name="propertyid<?= $res->id; ?>" id="propertyid<?= $res->id; ?>">         
                							            <?php
                							        }
                							    ?>
                							</label>
                						</div>
                						<div class="ml-auto align-items-center text-center">
                							<img src="<?php echo contact_profile_image_url($this->db->get_where(db_prefix().'contacts', array('userid' => $res->agent_id))->row('id'),'thumb'); ?>" class="img-fluid" style="width:50px; height:50px;border-radius:50%;box-shadow: 0px 5px 15px 0px #ccc;"><br>
                							<span>PropertyID : <?= $res->id; ?></span>
                						</div>
                					</div>
                                </div>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                            <p class="dataTables_empty text-center">No Properties!</p>
                        <?php
                    }
                  ?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script>
    
    /* Success message  */
    function successmsg(msg)
    {
        toastr.success('',msg);
    }
    
    function errormsg(msg)
    {
        toastr.error('',msg);
    }

    function changeStatus(id)
    {
        var checkBox = document.getElementById("propertyid"+id);
        var status = '';
        if (checkBox.checked == true)
        {
            status = 1;
        }
        else
        {
            status = 2;
        }
        
        var str = "status="+status+"&id="+id+"&"+csrfData['token_name']+"="+csrfData['hash'];
	    $.ajax({
	        url: '<?= site_url()?>clients/propertyActiveInactive',
	        type: 'POST',
	        data: str,
	        dataType: 'json',
	        cache: false,
	        success: function(resp){
	            if(resp.status == 'success')
	            {
	                successmsg(resp.msg);
	            }
	            else
	            {
	                errormsg(resp.msg);
	                $("#propertyid"+id).prop("checked", false);
	            }
	        }
	    });
    }
</script>