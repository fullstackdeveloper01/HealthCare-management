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
  <div class="text-center">
    <?php
      if($settingRes->logo_image != '')
      {
          ?>
              <img class="logo mb-3" src="<?= base_url() ?>assets/images/logo.svg" width="200" class="img-responsive" alt="">
          <?php
      }
    ?>
  </div>
  <div class="inner-login">

  <div class="clearfix">
       
    <h1 class="text-capitalize mbot20 login-heading mt-1"><?php echo _l('customer_forgot_password_heading'); ?></h1>
  </div>
  <div class="clearfix">
    <div class="clearfix">
      <div class="clearfix">
        <?php echo form_open($this->uri->uri_string(),['id'=>'forgot-password-form']); ?>
        <?php echo validation_errors('<div class="alert alert-danger text-center">', '</div>'); ?>
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
        <?php echo render_input('email','customer_forgot_password_email','','email'); ?>
        <div class="form-group">
          <button type="submit" class="btn btn-info btn-block"><?php echo _l('customer_forgot_password_submit'); ?></button>
        </div>
        <a href="<?php echo site_url('authentication/login'); ?>" class="bold d-flex"><i class="fa fa-angle-left mr-1 font-20 bold middle"></i> Back to login</a>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
</div>