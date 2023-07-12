<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="panel_s section-heading section-transaction">
    <div class="panel-body">
        <h4 class="no-margin section-text"><?php echo _l('Transaction list'); ?></h4>
    </div>
</div>
<div class="panel_s">
    <div class="panel-body">
        <div><h4 class="fw-700">Transaction List</h4></div><hr class="clear-fix">
        <?php if(count($transactionList) > 0){ ?>
            <table class="table dt-table table-transaction" data-order-col="1" data-order-type="desc">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Plan Title</th>
                        <th>Transaction ID</th>
                        <th>Create Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($transactionList as $rrr){ ?>
                    <tr>
                        <td>
                            <?= $rrr->id; ?>
                        </td>
                        <td>
                            <?php
                               echo $title = $this->db->get_where(db_prefix().'subscription', array('id' => $rrr->planid))->row('title');
                            ?>
                        </td>
                        <td>
                            <?= $rrr->transactionid; ?>
                        </td>
                        <td>
                            <?= date('d M, Y',$rrr->created); ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="no-margin dataTables_empty"><?php echo _l('No transaction founds'); ?></p>
        <?php } ?>
    </div>
</div>
