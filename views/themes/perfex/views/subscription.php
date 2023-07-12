<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="panel_s section-heading section-transaction">
    <div class="panel-body">
        <h4 class="no-margin section-text"><?php echo _l('Subscription Details'); ?></h4>
    </div>
</div>
<div class="panel_s">
    <div class="panel-body">
        <div><h4 class="fw-700">Subscription</h4></div><hr class="clear-fix">
        <?php if(count($subscription) > 0){ ?>
            <table class="table dt-table table-doc dt-inline dataTable" data-order-col="1" data-order-type="desc" id="DataTables_Table_0">
                <tbody>
                    <tr>
                        <td width="25%"><b>Plan Title</b></td>
                        <td><?= $subscription->title; ?></td>
                    </tr>
                    <tr>
                        <td width="25%"><b>Listing Quantity</b></td>
                        <td><?= $subscription->qty; ?></td>
                    </tr>
                    <tr>
                        <td width="25%"><b>Description</b></td>
                        <td><?= $subscription->description; ?></td>
                    </tr>
                    <tr>
                        <td width="25%"><b>Remaining Property</b></td>
                        <td><?= $property_limit; ?></td>
                    </tr>
                    <tr>
                        <td width="25%"><b>Expiry Date</b></td>
                        <?php
                            if($expired_date)
                            {
                                ?>
                                    <td><?= date('d M, Y h:i:s', $expired_date); ?></td>          
                                <?php
                            }
                            else
                            {
                                ?>
                                    <td>0000:00:00</td>
                                <?php
                            }
                        ?>
                    </tr>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="no-margin dataTables_empty"><?php echo _l('No subscriptions found'); ?></p>
        <?php } ?>
    </div>
</div>
