<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <?php echo form_open($this->uri->uri_string(),array('id'=>'article-form')); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <h4 class="no-margin">
                                <?php echo $title; ?>
                            </h4>
                            <hr class="hr-panel-heading" />
                            <div class="clearfix"></div>
                            <table class="table table-garages dataTable no-footer dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                    <tr role="row">
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Email</th>
                                        <th>SMS</th>
                                    </tr>
                                    <tr>
                                        <td valign="top" colspan="4" class="dataTables_empty">No entries found</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
<?php init_tail(); ?>
</body>
</html>
