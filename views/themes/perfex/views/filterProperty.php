<?php
	if($agent_property)
	{
		foreach($agent_property as $res)
		{
			?>
				<div class="property-holder mt-20 pos-rel">
					<div class="d-flex align-items-center">
						<div class="img-holder">
							<a href="<?= site_url('clients/addListing/'.$res->id)?>" style="display:block;">
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
							<span class="view"><a href="<?= base_url('clients/allAppointment/'.$res->id); ?>"><?= $tproperty = $this->db->get_where(db_prefix().'appointment_booking', array('property_id' => $res->id))->num_rows(); ?> Appointments</a></span>
							<!--<a class="btn cbtn-btn" href="javascript:void(0);" data-toggle="modal" data-target="#shareModal">Share property</a>-->
							<!--<a class="btn cbtn-btn btn-outline" href="<?= site_url('clients/properties/'.$res->id)?>">Details</a>-->
						</div>
						<div class="dl" style="margin-left: 120px;">
							<!--<h4><?= $res->name; ?></h4>-->
							<!--<h5><?= $res->address; ?></h5>-->
							<!--<span class="view">0 Appointments</span>-->
							<!--<a class="btn cbtn-btn" href="javascript:void(0);" data-toggle="modal" data-target="#shareModal">Share property</a>&nbsp;&nbsp;&nbsp;&nbsp;-->
							<a class="btn btn-info cbtn-btn btn-outline" href="<?= site_url('clients/addListing/'.$res->id)?>">Edit</a>&nbsp;&nbsp;
							<a class="btn cbtn-btn btn-outline" href="<?= site_url('clients/properties/'.$res->id)?>">Details</a>&nbsp;&nbsp;
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