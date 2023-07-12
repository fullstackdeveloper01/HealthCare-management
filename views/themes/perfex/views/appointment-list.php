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
                    <div class="header-wrap bg-white">
                        <div class="d-flex align-items-center">
                            <div>
                                <h4 class="fw-700 mt-0">My Listings</h4>
                            </div>
                            <div class="ml-auto align-items-center">
                                <div class="dl">
                                    <a class="btn btn-info" href="<?= base_url('clients/calendar'); ?>"><?= _l('calendar'); ?></a>
                                    <a class="btn btn-info" href="<?= base_url('all-appointments'); ?>">All appointments</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    if($property_result)
                    {
                        foreach($property_result as $res)
                        {
                            ?>
                                <div class="col-md-3">
                                    <div class="appt-box box-2">
                                        <h4>
                                            <a href="<?= site_url('clients/properties/'.$res->id)?>" class="apppt-box-wrap">
                                                <?= substr($res->name, 0, 20); ?>
                                            </a>
                                        </h4>
                                        <h5><?= substr($res->address, 0, 20); ?></h5>
                                        <p><?= date('d F Y', strtotime($res->active_date));?></p>
                                        <a href="<?= site_url('clients/allAppointment/'.$res->id)?>">
                                            <span class="view-count"><?= $tproperty = $this->db->get_where(db_prefix().'appointment_booking', array('property_id' => $res->id))->num_rows(); ?> Appointments</span>
                                        </a>
                                    </div>
                                </div>
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
                                
            </div>
            <!--
            <div class="row">
                <div class="col-md-3">
                    <a href="<?= site_url('clients/properties')?>" class="apppt-box-wrap">
                        <div class="appt-box box-1">
                            <h4>Silver Springs</h4>
                            <h5>137, silver springs, tx</h5>
                            <p>13 May 2020</p>
                            <span class="view-count">05 Appointments</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="<?= site_url('clients/properties')?>" class="apppt-box-wrap">
                        <div class="appt-box box-2">
                            <h4>Rose Villa</h4>
                            <h5>2, rose villa, ca</h5>
                            <p>01 June 2020</p>
                            <span class="view-count">16 Appointments</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="<?= site_url('clients/properties')?>" class="apppt-box-wrap">
                        <div class="appt-box box-3">
                            <h4>New homes</h4>
                            <h5>49d, new homes, ca</h5>
                            <p>22 Sept 2020</p>
                            <span class="view-count">26 Appointments</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="<?= site_url('clients/properties')?>" class="apppt-box-wrap">
                        <div class="appt-box box-4">
                            <h4>Classic Panorama</h4>
                            <h5>07, classic panorama, tx</h5>
                            <p>17 May 2020</p>
                            <span class="view-count">03 Appointments</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row mt-20">
                <div class="col-md-3">
                    <a href="<?= site_url('clients/properties')?>" class="apppt-box-wrap">
                        <div class="appt-box box-5">
                            <h4>Lakeview Appartments</h4>
                            <h5>13, lakeview appartments, ca</h5>
                            <p>13 May 2020</p>
                            <span class="view-count">10 Appointments</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="<?= site_url('clients/properties')?>" class="apppt-box-wrap">
                        <div class="appt-box box-6">
                            <h4>Luxury houses</h4>
                            <h5>02, luxury houses, tx</h5>
                            <p>08 Feb 2020</p>
                            <span class="view-count">25 Appointments</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="<?= site_url('clients/properties')?>" class="apppt-box-wrap">
                        <div class="appt-box box-7">
                            <h4>Marina bay homes</h4>
                            <h5>2c, marina bay homes, hawai</h5>
                            <p>30 Oct 2020</p>
                            <span class="view-count">08 Appointments</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="<?= site_url('clients/properties')?>" class="apppt-box-wrap">
                        <div class="appt-box box-8">
                            <h4>BCM Heights</h4>
                            <h5>22, bcm heights, ny</h5>
                            <p>03 Dec 2020</p>
                            <span class="view-count">15 Appointments</span>
                        </div>
                    </a>
                </div>
            </div>
            -->
       </div>
    </div>
</div>
<script>
    $('.input-group.date').datepicker({format: "dd.mm.yyyy"}); 
</script>