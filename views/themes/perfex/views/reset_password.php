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
<div class="clearfix">
    <div class="login-main">

    <?php
                if($settingRes->logo_image != '')
                {
                    ?>
                        <img src="<?= base_url() ?>uploads/loginPage/<?= $settingRes->logo_image; ?>" width="200" class="logo img-responsive mb-3" alt="">
                    <?php
                }
            ?>

        <div class="inner-login">
            <div class="clearfix">
                <h1 class="mbot20 login-heading"><?php echo _l('customer_reset_password_heading'); ?></h1>
            </div>
            
            <div class="clearfix text-left">
                <div class="clearfix">
                    <?php echo form_open($this->uri->uri_string()); ?>
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
                    <?php echo render_input('password','customer_reset_password','','password'); ?>
                    <?php echo render_input('passwordr','customer_reset_password_repeat','','password'); ?>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-block"><?php echo _l('customer_reset_action'); ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
