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