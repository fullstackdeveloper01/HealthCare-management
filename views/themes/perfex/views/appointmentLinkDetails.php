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
                                <h4 class="fw-700 mt-0">Appointments Details</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mt-0 mb-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-10 bg-white">
                        <table class="table dt-table table-doc" data-order-col="1" data-order-type="desc">
                            <tr>
                                <td width="25%"><b>Agent Name</b></td>
                                <td>
                                    <?php
                                        $user_detailsres = $this->db->select('user_timezone,firstname,lastname')->get_where(db_prefix().'contacts', array('userid' => $propertyDetails->agent_id))->row();
                                    ?>
                                    <?= $user_detailsres->firstname.' '.@$user_detailsres->lastname; ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="25%"><b>Property Name</td>
                                <td><?= $propertyDetails->name; ?></td>
                            </tr>
                            <tr>
                                <td width="25%"><b>Address</td>
                                <td><?= $propertyDetails->address; ?></td>
                            </tr>
                            <tr>
                                <td width="25%"><b>Time zone</td>
                                <td><?= $user_detailsres->user_timezone; ?></td>
                            </tr>
                            <tr>
                                <td width="25%"><b>Date</td>
                                <td><?= date('d F Y', strtotime($appointmentDetail->appointment_date)); ?></td>
                            </tr>
                            <tr>
                                <td width="25%"><b>Time</td>
                                <td><?= $appointmentDetail->available_time; ?></td>
                            </tr>
                            <tr>
                                <td width="25%"><b>Status</td>
                                <td id="status">
                                    <?php
                                        if(strtotime($appointmentDetail->appointment_date) > time())
                                        {
                                            if($appointmentDetail->status == 1)
                                            {
                                                echo '<span class="badge badge-active">Scheduled</span>';
                                            }
                                            else
                                            {
                                                echo '<span class="badge badge-expired">Cancelled</span>';
                                            }
                                            ?>
                                                &nbsp;&nbsp;<span class="btn btn-info" onClick="changeAppointmentStatus(<?= $appointmentDetail->id; ?>)">Cancel</span>
                                            <?php
                                        }
                                        else
                                        {
                                            echo '<span class="badge badge-expired">Expired</span>';
                                        }
                                    ?>        
                                </td>
                            </tr>
                            <tr>
                                <td width="25%"><b>Documents</td>
                                <td>
                                    <table class="table dt-table table-doc">
                                        <?php
                                            if($appointmentDoc)
                                            {
                                                $ss = 1;
                                                foreach($appointmentDoc as $doc)
                                                {
                                                    $docname = '';
                                                    $docname = $this->db->get_where(db_prefix().'property_doc', array('id' => $doc->doc_id))->row('title');
                                                    ?>
                                                        <tr>
                                                            <td><?= $docname; ?></td>
                                                            <td><a href="<?= site_url('uploads/appointmentDoc/'.$doc->doc);?>" target="_blank"><?= 'Document '.$ss; ?></a></td>
                                                        </tr>
                                                    <?php
                                                    $ss++;
                                                }
                                            }
                                        ?>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
       </div>
    </div>
</div>
<script>
    function changeAppointmentStatus(Id)
    {
        var result = confirm("Want to cancel this?");
        if(result)
        {
            var str = "id="+Id+"&"+csrfData['token_name']+"="+csrfData['hash'];
    	    $.ajax({
    	        url: '<?= site_url()?>share/changeStatus',
    	        type: 'POST',
    	        data: str,
    	        dataType: 'json',
    	        cache: false,
    	        success: function(resp){
    	            $('#status').html('<span class="badge badge-expired">Cancelled</span>');
    	        }
    	    });
        }
    }
</script>

