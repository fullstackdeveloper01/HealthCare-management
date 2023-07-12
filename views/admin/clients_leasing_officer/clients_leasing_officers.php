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
                                <div class="col-md-8">
                                    <a href="<?php echo admin_url('clients_leasing_officer/add'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                        <?php echo _l('new '.$title); ?>
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="report_type" onChange="cloFilter()">
                                        <option value="0" selected>Filter By Report Type</option>
                                        <option value="1">Today</option>
                                        <option value="2">Weekly</option>
                                        <option value="3">Monthly</option>
                                        <option value="4">Yearly</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="clo_status" onChange="cloFilter()">
                                        <option value="">Filter By Status</option>
                                        <option value="1">Active</option>
                                        <option value="5">Inactive</option>
                                    </select>
                                </div>
                                <!--
                                <div class="col-md-1">
                                    <a href="<?php echo admin_url('export/exportClientLiaisonOffice'); ?>" onClick="cloFilter()" class="btn btn-success pull-right" target="_blank"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</a>
                                </div>-->
                            </div>
                        </div>
						<hr class="hr-panel-heading" />
						<div class="row mbot15">
						    <?php
						        $where_summary = '';
						    ?>
                            <div class="col-md-12">
                                <h4 class="no-margin"><?php echo _l($title.' Summary'); ?></h4>
                            </div>
                            <div class="col-md-4 col-xs-6 border-right">
                                <h3 class="bold" ><?php echo $this->db->get_where(db_prefix().'contacts', array('role' => 3))->num_rows(); ?></h3>
                                <span class="text-dark"><?php echo _l($title.' Summary total'); ?></span>
                            </div>
                            <div class="col-md-4 col-xs-6 border-right">
                                <h3 class="bold" id="clo_status_active"><?php echo $this->db->get_where(db_prefix().'contacts', array('role' => 3, 'active' => 1))->num_rows(); ?></h3>
                                <span class="text-success" ><?php echo _l('Active '.$title); ?></span>
                            </div>
                            <div class="col-md-4 col-xs-6 border-right">
                                <h3 class="bold" id="clo_status_inactive"><?php echo $this->db->get_where(db_prefix().'contacts', array('role' => 3, 'active' => 0))->num_rows(); ?></h3>
                                <span class="text-danger" ><?php echo _l('Inactive '.$title); ?></span>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
						<?php render_datatable(array(
    							_l('ID'),
                                _l('Name'),
                                _l('Email'),
                                _l('Mobile'),
                                _l('Date of birth'),
                                _l('Date of joining'),
                                _l('Address'),
                                _l('Department'),
                                _l('Status'),
                                _l('Created Date'),
    							_l('options')
							),'clients_leasing_officer'); 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php init_tail(); ?>
	<script>
		initDataTable('.table-clients_leasing_officer', window.location.href,[1], [1],'',[0,'desc']);

        /* Filter */
        function cloFilter()
        {
            var report_type = $('#report_type option:selected').val();
            var clo_status = $('#clo_status option:selected').val();

            var table = $('.table-clients_leasing_officer').DataTable(); 
            table.destroy();
            var tAPI = initDataTable('.table-clients_leasing_officer', '<?= admin_url() ?>clients_leasing_officer/filterCLORecord/'+report_type+"/"+clo_status, [1], [1]); 
            tAPI.ajax.reload();

            //var daybookURL = admin_url+"export/exportClientLiaisonOffice/"+report_type+"/"+clo_status;
            //window.open(daybookURL, '_blank');
        }

        function changeStatus(obj,id){
            var total_inactive = $('#clo_status_inactive').text();
            var total_active = $('#clo_status_active').text();
            if(obj==1){
                total_inactive = parseInt(total_inactive)+1;
                total_active = parseInt(total_active)-1;
                $('#'+id).val('0');
                
            }else{
                total_inactive = parseInt(total_inactive)-1;
                total_active = parseInt(total_active)+1;
                $('#'+id).val('1');
            }

            $('#clo_status_inactive').text(total_inactive);
            $('#clo_status_active').text(total_active);
        }
	</script>
</body>
</html>
