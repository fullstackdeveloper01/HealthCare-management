<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
  if($settingRes)
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
<div class="login-main">
<?php
            if($settingRes->logo_image != '')
            {
                ?>
                    <img src="<?= base_url() ?>assets/images/logo.svg" width="200" class="logo img-responsive mb-3" alt="">
                <?php
            }
        ?>
   <div class="inner-login">
   <div class="clearfix">
       
     <!--  <h1 class=" mbot20 login-heading">
         <?php
            echo _l(get_option('allow_registration') == 1 ? 'Client Liaison Office': 'clients_login_heading_no_register');
         ?>
      </h1> -->
      
   </div>
   <div class="clearfix">
      <?php echo form_open($this->uri->uri_string(),array('class'=>'login-form')); ?>
     <?php if($this->session->flashdata('message-danger')){ ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('message-danger'); ?>
                    </div>
                    <?php } ?>
                    <?php if($this->session->flashdata('message-success')){ ?>
                    <div class="alert alert-success">
                        <?php echo $this->session->flashdata('message-success'); ?>
                    </div>
                    <?php } ?>
      <?php hooks()->do_action('clients_login_form_start'); ?>
      <div class="panel_s">
         <div class="clearfix">
            <div class="form-group">
               <label for="email"><?php echo _l('Login ID'); ?></label>
               <input type="text" autofocus="true" required="" class="form-control" name="email" id="email">
               <?php echo form_error('email'); ?>
            </div>
            <div class="form-group">
               <label for="password"><?php echo _l('clients_login_password'); ?></label>
               <input type="password" class="form-control" required name="password" id="password">
               <?php echo form_error('password'); ?>
            </div>
            <?php if(get_option('use_recaptcha_customers_area') == 1
                     && get_option('recaptcha_secret_key') != ''
                     && get_option('recaptcha_site_key') != ''){ ?>
            <div class="g-recaptcha mbot15" data-sitekey="<?php echo get_option('recaptcha_site_key'); ?>"></div>
            <?php echo form_error('g-recaptcha-response'); ?>
            <?php } ?>
            <div class="form-group">
                <?php
                    $siteKey = $this->db->select('site_key,re_captcha_option')->get_where('tbllogin_setting')->row();
                    if($siteKey->re_captcha_option == 'yes')
                    {
                        ?>
                            <div class="g-recaptcha" data-sitekey="<?= $siteKey->site_key; ?>" data-callback="verifyCaptcha"></div>
                            <div id="g-recaptcha-error"></div>
                        <?php
                    }
                ?>
            </div>
            <!-- <div class="checkbox">
               <input type="checkbox" class="ml-0" name="remember" id="remember">
               <label for="remember">
               <?php echo _l('clients_login_remember'); ?>
               </label>
            </div> -->

            <div class="form-group">
               <button type="submit" class="btn btn-info btn-block"><?php echo _l('clients_login_login_string'); ?></button>
               <!-- <?php if(get_option('allow_registration') == 1) { ?>
               <a href="<?php echo site_url('authentication/register'); ?>" class="btn btn-success btn-block"><?php echo _l('clients_register_string'); ?>
               </a>
               <?php } ?> -->
            </div>
            <a href="<?php echo site_url('authentication/forgot_password'); ?>"><?php echo _l('customer_forgot_password'); ?></a>
            <?php hooks()->do_action('clients_login_form_end'); ?>
            <?php echo form_close(); ?>
         </div>
      </div>
   </div>
   </div>
</div>
<script src='https://www.google.com/recaptcha/api.js'></script>