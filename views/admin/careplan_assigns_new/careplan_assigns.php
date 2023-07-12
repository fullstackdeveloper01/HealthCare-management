<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css"> -->
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
					<!-- <h4 class="customer-profile-group-heading"><?= _l($title); ?></h4> -->
					    <div class="no-margin">
    					    <a href="<?php echo admin_url('Careplan_assign_new/add'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('new '.$title); ?>
                            </a>
                        </div>
						<br>
						
						<?php ?>
                        <hr class="hr-panel-heading" />
						
						<table class="table table-responsive"  id="example">
							<thead>
								<th><?=_l('S.no')?></th>
								<th><?=_l('Client')?></th>
								<th><?=_l('Plan Title')?></th>
								<th><?=_l('Plan File')?></th>
								<th><?=_l('Date')?></th>
								<th><?=_l('options')?></th>
							</thead>
							<tbody>
								<?php
								foreach($response as $key=>$value){
									?>
									<tr>
										<td><?=$key+1?></td>
										<td><?=$value['firstname']?></td>
										<td><?= substr($value['title'],0,35)?></td>
										<td>
											<?php
												//echo $file = $this->db->get_where('tblfiles',['rel_id'=>$value['id']])->row('file_name');
												// print_r($files)
												echo $filename = $this->db->get_where('tblfiles', array('rel_id' => $value['id'], 'rel_type' => 'care_plan'))->row('file_name');
											?>
											<!-- <a href="<?=base_url('uploads/care_plan/'.$value['id'].'/').$file?>" target="_blank">View File</a> -->
										</td>
										<td><?= date('Y-m-d',strtotime($value['created_date']))?></td>
										<td>
											<a href="<?=admin_url().'Careplan_assign_new/add/'.$value['id']?>" class="btn btn-default btn-icon">
											<i class="fa fa-pencil-square-o"></i>
											</a>
											<a href="<?=admin_url().'Careplan_assign_new/delete_careplan_assign/'.$value['id']?>" class="btn btn-danger _delete btn-icon">
											<i class="fa fa-remove"></i>
											</a>
										</td>
									</tr>
								<?PHP }
									
								?>
							</tbody>
						</table>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script>
// 		initDataTable('.table-careplan_assign', window.location.href, [1], [1]);
		$(document).ready(function() {
			$.noConflict();
			$('#example').DataTable();
		} );
	</script>
</body>
</html>





