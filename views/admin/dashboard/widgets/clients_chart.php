<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="widget" id="widget-<?php echo basename(__FILE__,".php"); ?>" data-name="<?php echo _l('s_chart',_l('client')); ?>">
  <div class="row">
    <div class="col-md-12">
     <div class="panel_s">
       <div class="panel-body padding-10">
        <div class="widget-dragger"></div>
        <p class="padding-5"><?php echo _l('Chart'); ?></p>
        <hr class="hr-panel-heading-dashboard">
        <div class="relative" style="height:250px">
         <canvas class="chart" height="250" id="client_graph_by_status"></canvas>
       </div>
     </div>
   </div>
 </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel_s">
            <div class="panel-body padding-10">
                <h4 class="pull-left padding-5">
                    <?= _l('Recently Joined Staff'); ?>
                </h4>
                <span class="pull-right"><a href="<?= admin_url('employee'); ?>">View All</a></span>
                <div class="clearfix"></div>
                <hr class="hr-panel-heading-dashboard" />
                <ul class="list-unstyled todo unfinished-todos todos-sortable sortable ui-sortable">
                    <?php
                        $agentList = $this->db->select('email,userid,firstname,lastname')->limit(5)->order_by('id', 'desc')->get_where(db_prefix().'contacts', array('role' => 1, 'active' => 1))->result();
                        if($agentList)
                        {
                            foreach($agentList as $rrr)
                            {
                                ?>
                                    <li class="media event">
                                        <div class="media-body">
                                            <a class="title" href="<?= admin_url('employee/add/'.$rrr->userid); ?>">
                                                <strong><?= $rrr->firstname.' '.@$rrr->lastname;?></strong>
                                                <span class="pull-right">More info <i class="fa fa-arrow-circle-right"></i></span>
                                            </a>
                                            <p><?= $rrr->email; ?></p>
                                        </div>
                                    </li>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                                <li class="media event"><p valign="top" colspan="7" class="dataTables_empty">No entries found</p></li>
                            <?php
                        }
                        ?><?php
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
