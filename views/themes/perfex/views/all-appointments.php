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
                    <div class="header-wrap p-10 bg-white">
                    <div class="d-flex align-items-center">
                        <div>
                            <h4 class="fw-700 mt-0">All Appointments</h4>
                        </div>
                        <div class="ml-auto align-items-center">
                            <div class="dl">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <label>Filter</label>
                                        <select class="form-control" id="propertystatus">
                                            <option value="">Select filter</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Sort</label>
                                        <select class="form-control" id="nametime">
                                            <option value="">Type</option>
                                            <option value="name">Property Name</option>
                                            <option value="time">Appointment Time</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="filterDate2">
                                        <!-- Datepicker as text field -->         
                                        <div class="input-group date" data-date-format="dd.mm.yyyy">
                                            <input type="text" id="selectdate" class="form-control" placeholder="dd.mm.yyyy">
                                            <div class="input-group-addon" >
                                            <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
										<div class="form-group">
											<button class="btn btn-theme" onClick="filterAllAppointments();" type="button" style="margin-top: -10px;"> Search </button>
										</div>
                                    </div>    
                                </form> 
                                <!--<button class="btn btn-info" data-toggle="modal" data-target="#createappointmentModal">Create Appointment</button>-->
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
                        <ul class="responsive-table searchresult">
                            <li class="table-header">
                                <div class="col col-1">Client Name</div>
                                <div class="col col-2">Property Name</div>
                                <div class="col col-3">Date</div>
                                <div class="col col-4">Time</div>
                                <div class="col col-5">Address</div>
                                <div class="col col-6">Status</div>
                            </li>
                            <?php
                                if($appointment_result)
                                {
                                    foreach($appointment_result as $res)
                                    {
                                        ?>
                                            <li class="table-row">
                                                <div class="col col-1"><a href="<?= site_url('clients/appointmentDetails/'.$res->id); ?>"><?= $res->name; ?></a></div>
                                                <div class="col col-2"><?= $propertytitle = $this->db->get_where(db_prefix().'property', array('id' => $res->property_id))->row('name'); ?></div>
                                                <div class="col col-3"><?= date('d F Y', strtotime($res->appointment_date)); ?></div>
                                                <div class="col col-4"><?= $res->available_time; ?></div>
                                                <div class="col col-5"><?= $propertyaddress = $this->db->get_where(db_prefix().'property', array('id' => $res->property_id))->row('address'); ?></div>
                                                <div class="col col-6">
                                                    <?php
                                                        if($res->status == 1)
                                                        {
                                                            echo '<span class="badge badge-active">Scheduled</span>';
                                                        }
                                                        else
                                                        {
                                                            echo '<span class="badge badge-expired">Cancelled</span>';
                                                        }
                                                    ?>
                                                    
                                                </div>
                                            </li>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                        <p class="dataTables_empty">No Appointments</p>
                                    <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
       </div>
    </div>
</div>

<!-- Create Appointment Modal -->
<div class="modal" id="createappointmentModal">
  	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Create Appointment</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<form>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Client name</label>
                                <input type="text" class="form-control" placeholder="Enter client name" id="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Property name">Property name</label>
                                <input type="text" class="form-control" placeholder="Enter property name" id="price">
                            </div>
                        </div>
                    </div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="date">Date</label>
								<input type="text" class="form-control" placeholder="Enter date" id="date">
							</div>
						</div>
                        <div class="col-md-4">
							<div class="form-group">
								<label for="time">Time</label>
								<input type="text" class="form-control" placeholder="Enter time" id="time">
							</div>
						</div>
                        <div class="col-md-4">
							<div class="form-group">
								<label for="status">Status</label>
								<select class="form-control">
									<option>Select status</option>
									<option>Active</option>
									<option>Expired</option>
									<option>On hold</option>
								</select>
							</div>
						</div>
					</div>
                    <div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="address">Address</label>
								<textarea class="form-control" placeholder="Enter address" id="address" rows="2"></textarea>
							</div>
						</div>
					</div>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Create</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>
<script>
    $('.input-group.date').datepicker({format: "dd.mm.yyyy"}); 
	
	/** Search Filter **/
	function filterAllAppointments()
	{
		var propertystatus = $("#propertystatus option:selected").val();
		var nametime = $('#nametime option:selected').val();
		var selectdate = $('#selectdate').val();
		
		var str = "status="+propertystatus+"&nametime="+nametime+"&selectdate="+selectdate+"&"+csrfData['token_name']+"="+csrfData['hash'];
		$.ajax({
			url: '<?= site_url()?>clients/filterAllAppointments',
			type: 'POST',
			data: str,
			dataType: 'json',
			cache: false,
			success: function(resp){
				if(resp.status == 'success')
				{
					//successmsg(resp.msg);
					$('.searchresult').html(resp.result);
				}
				else
				{
					//errormsg(resp.msg);
					$('.searchresult').html(resp.result);
				}
			}
		});
	}
</script>


