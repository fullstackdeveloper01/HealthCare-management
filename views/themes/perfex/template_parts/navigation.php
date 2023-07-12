<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .nappointment {
      position: absolute;
      top: 21px;
      right: -4px;
      padding: 5px 10px;
      border-radius: 50%;
      background: gray;
      color: white;
    }
</style>
<?php
  if(isset($settingRes))
  {
    if($settingRes->background_type == 'color')
    {
        ?>
          <body style="background-color: <?= $settingRes->background_color; ?>;">
        <?php
    }
    else
    {
        ?>
          <body style="background-image: url('<?= base_url() ?>uploads/loginPage/<?= $settingRes->background_image; ?>');">
        <?php
    }
  }
  else
  {
    ?>
     <body class="login_admin"<?php if(is_rtl()){ echo ' dir="rtl"'; } ?>>
    <?php
  }
?>
<nav class="navi navbar navbar-default header inner-nav <?= ($this->uri->segment(1) == 'authentication' || $this->uri->segment(1) == 'login')?"hide":""; ?>">
   <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#theme-navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
         </button>
         <!-- <?php // get_company_logo('','navbar-brand logo'); ?> -->
          <a href="<?php echo site_url(); ?>">
            <img class="logo" src="<?= base_url() ?>assets/images/logo.svg" width="160" class="img-responsive" alt="">
         </a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="theme-navbar-collapse">
         <ul class="nav navbar-nav navbar-right">
             <?php
                if(is_client_logged_in())
                {
                    ?>
                        <?php hooks()->do_action('customers_navigation_start'); ?>
                       
                       
                       
                        <li class="customers-nav-item-dashboard">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#studentlistmodel">
                               <?php echo _l('Clients'); ?>
                            </a>
                        </li>
                        <li class="customers-nav-item-dashboard">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#stafflistmodel">
                               <?php echo _l('Staff'); ?>
                            </a>
                        </li>
                        <li class="customers-nav-item-dashboard">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#reportlistmodel">
                               <?php echo _l('Reports'); ?>
                            </a>
                        </li>
                        <li class="customers-nav-item-dashboard">
                            <!-- <a href="<?php echo site_url('clients/tickets'); ?>"> -->
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#supportlistmodel" >
                               <?php echo _l('Support'); ?>
                            </a>
                        </li>
                        <li class="customers-nav-item-dashboard"  data-toggle="modal" data-target="#newslistmodel">
                            <a href="javascript:void(0)">
                               <?php echo _l('Health News'); ?>
                            </a>
                        </li>
                        <li class="customers-nav-item-dashboard"  data-toggle="modal" data-target="#tipslistmodel">
                            <a href="javascript:void(0)">
                               <?php echo _l('Tips'); ?>
                            </a>
                        </li>
                        <?php
                          if(get_user_id_role()==4)
                          {
                        ?>
                          <li class="customers-nav-item-dashboard"  data-toggle="modal" data-target="#traninglistmodel"  onclick="getTraning();">
                              <a href="javascript:void(0)">
                                 <?php echo _l('Upcoming Training'); ?>
                              </a>
                          </li>
                          <li class="customers-nav-item-dashboard"  data-toggle="modal" data-target="#policylistmodel"   onclick="getPolicy();">
                              <a href="javascript:void(0)">
                                 <?php echo _l('Policy'); ?>
                              </a>
                          </li>
                          <li class="customers-nav-item-dashboard"  data-toggle="modal" data-target="#quotelistmodel"  onclick="getQuote();">
                              <a href="javascript:void(0)">
                                 <?php echo _l('Motivational Quote'); ?>
                              </a>
                          </li>
                          <li class="customers-nav-item-dashboard"  data-toggle="modal" data-target="#noticelistmodel"   onclick="getNotice();">
                              <a href="javascript:void(0)">
                                 <?php echo _l('Notice Board'); ?>
                              </a>
                          </li>
                          <li class="customers-nav-item-dashboard"  data-toggle="modal" data-target="#leavelistmodel"  onclick="getLeave();">
                              <a href="javascript:void(0)">
                                 <?php echo _l('Leave'); ?>
                              </a>
                          </li>

                        <?php
                          }
                        ?>

                        
                        <?php if(isset($client_data))
                                    {}else{ ?>

                        <li class="customers-nav-item-dashboard">   
                          <!-- <a href="<?php echo site_url('clients/profiles'); ?>"> -->
                          <a href="javascript:void(0)" data-toggle="modal" data-target="#profileviewmodel" >
                            <?php echo _l('Account'); ?>  
                          </a>
                        </li>
                         <!-- <li class="customers-nav-item-logout">
                            <a href="<?php echo site_url('authentication/logout'); ?>">
                               <?php echo _l('clients_nav_logout'); ?>
                            </a>
                         </li> -->
                       <?php  } ?>
                        <?php hooks()->do_action('customers_navigation_end'); ?>
                        <?php if(is_client_logged_in()) { ?>
                           <li class="dropdown customers-nav-item-profile">
                             <?php
                             $clodata = $this->db->get_where(db_prefix().'contacts', array('userid' => get_client_user_id()))->row();

                                        $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => get_client_user_id(), 'rel_type' => 'profile_image'))->row('file_name');
                                        if($filename!=''){
                                        ?>
                                      <a href="javascript:void(0)"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                         <img src="<?= base_url('uploads/profile_image/'.$clodata->userid.'/'.$filename); ?>" data-toggle="tooltip" data-title="<?php echo html_escape($clodata->firstname . ' ' .$clodata->lastname); ?>" data-placement="bottom" class="client-profile-image-small mright5" onerror="this.onerror=null;this.src='<?php echo base_url(); ?>assets/images/user.png';" >
                                         <span class="caret"></span>
                                      </a>

                              <?php 
                                    }else{
                                        ?>
                                          <a  class="dropdown-toggle user-profile-text media-object" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="background: <?php printf( "#%06X\n", mt_rand( 0, 0xFFFFFF )); ?>;" ><?= ucfirst(substr($clodata->firstname,0,1)).''.ucfirst(substr($clodata->lastname, 0, 1))?></a>
                                        <?php 

                                    }
                                    
                               ?>

                              <ul class="dropdown-menu animated fadeIn">
                                <li class="customers-nav-item-edit-profile">
                                    <a href="<?php echo site_url('clients/profiles'); ?>">
                                       <?php echo _l('clients_nav_profile'); ?>
                                    </a>
                                 </li> 
                              
                                 <li class="customers-nav-item-logout">
                                    <a href="<?php echo site_url('authentication/logout'); ?>">
                                       <?php echo _l('clients_nav_logout'); ?>
                                    </a>
                                 </li>
                              </ul>
                           </li>
                        <?php } ?>
                        <?php hooks()->do_action('customers_navigation_after_profile'); ?>
                    <?php
                }
                else
                {
                    if($this->uri->segment(1) != 'share')
                    {
                        ?>
                            <li class="customers-nav-item-upgrad">
                                <a href="<?= base_url('login'); ?>"><button class="btn btn-info">
                                    <?= _l('Login'); ?> </button>     
                                </a>
                            </li>
                        <?php
                    }
                }
             ?>
                        
         </ul>
      </div>
      <!-- /.navbar-collapse -->
   </div>
</nav>

