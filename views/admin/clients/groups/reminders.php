<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if(isset($client)){ ?>
<h4 class="customer-profile-group-heading"><?php echo _l('Login Details'); ?></h4>
<div class="col-md-12">
<div class="clearfix"></div>
<div class="clearfix"></div>
<div class="row">
    <hr class="hr-panel-heading" />
</div>
<div class="form-group">
    <?php
        $edit_company = $this->db->get_where(db_prefix() . 'contacts', array('userid' => $client->userid))->row();
    ?>
    <div class="row hide">
        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleInputEmail1">
                    <a href="<?php echo admin_url('garages/login_as_client/'.$client->userid); ?>" target="_blank">
                       <span class="btn btn-info"><i class="fa fa-share-square-o"></i> <?= _l('Login as agent'); ?>  </span>
                    </a>
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <table class="table table-tasks dataTable no-footer dtr-inline">
            <thead>
                <tr role="row">
                    <th width="20%">Login ID </th>  
                    <td><?= $edit_company->email; ?></td>          
                </tr>
                <tr role="row">
                    <th width="20%">Created Date </th>  
                    <td><?= _d($edit_company->datecreated); ?></td>          
                </tr>
                <tr role="row">
                    <th width="20%">Last Login</th>  
                    <td><?= _d($edit_company->last_login); ?></td>          
                </tr>
            </thead>
        </table>

    </div>
<div class="clearfix"></div>
<?php } ?>
