<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<ul class="nav navbar-pills navbar-pills-flat nav-tabs nav-stacked customer-tabs" role="tablist">
  <?php
    foreach(filter_client_visible_tabs($customer_tabs) as $key => $tab){
      if($tab['name'] == 'Invoices' || $tab['name'] == 'Payments' || $tab['name'] == 'Files' || $tab['name'] == 'Map' || $tab['name'] == 'Notes' || $tab['name'] == 'Contacts' || $tab['name'] == 'Proposals' || $tab['name'] == 'Credit Notes' || $tab['name'] == 'Estimates' || $tab['name'] == 'Expenses' || $tab['name'] == 'Contracts' || $tab['name'] == 'Projects' || $tab['name'] == 'Projects' || $tab['name'] == 'Tasks' || $tab['name'] == 'Tickets' || $tab['name'] == 'Vault' || $tab['name'] == 'subscription')
      {}
      else
      {
          if($tab['name'] =='Reminders')
          {
              ?>
                <li class="<?php if($key == 'profile'){echo 'active ';} ?>customer_tab_<?php echo $key; ?>">
                  <a data-group="<?php echo $key; ?>" href="<?php echo admin_url('clients/client/'.$client->userid.'?group='.$key); ?>">
                    <?php if(!empty($tab['icon'])){ ?>
                        <i class="<?php echo $tab['icon']; ?> menu-icon" aria-hidden="true"></i>
                    <?php } ?>
                    <?php echo _l('Login Details'); ?>
                  </a>
                </li>
             <?php
          }
          elseif($tab['name'] =='Statement')
          {
              ?>
                <!-- <li class="<?php if($key == 'profile'){echo 'active ';} ?>customer_tab_<?php echo $key; ?>">
                  <a data-group="<?php echo $key; ?>" href="<?php echo admin_url('clients/client/'.$client->userid.'?group='.$key); ?>">
                    <?php if(!empty($tab['icon'])){ ?>
                        <i class="<?php echo $tab['icon']; ?> menu-icon" aria-hidden="true"></i>
                    <?php } ?>
                    <?php echo _l('Property'); ?>
                  </a>
                </li> -->
             <?php
          }
          else
          {
            if($key =='profile'){
              ?>
                <li class="<?php if($key == 'profile'){echo 'active ';} ?>customer_tab_<?php echo $key; ?>">
                  <a data-group="<?php echo $key; ?>" href="<?php echo admin_url('clients/client/'.$client->userid.'?group='.$key); ?>">
                    <?php if(!empty($tab['icon'])){ ?>
                        <i class="<?php echo $tab['icon']; ?> menu-icon" aria-hidden="true"></i>
                    <?php } ?>
                    <?php echo $tab['name']; ?>
                  </a>
                </li>
             <?php
            }
          }
      }
    }
    ?>
</ul>
