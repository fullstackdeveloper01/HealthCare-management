<?php defined('BASEPATH') or exit('No direct script access allowed');

echo theme_head_view();

get_template_part($navigationEnabled ? 'navigation' : '');

?>
<style>
   .wrapper-loader{
      display:none;  
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    z-index: 11111;
    display: flex;
    align-items: center;
    justify-content: center;
   }
   .wrapper{    
  
   background-color: #216491b8;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    z-index: 11111;
    display: flex;
    align-items: center;
    justify-content: center;}
</style>
<div id="wrapper">

   <div id="content" style="position: relative;">
            <div class="wrapper-loader">
               <div class="wrapper">
                    <span class="circle circle-1"></span>
                    <span class="circle circle-2"></span>
                    <span class="circle circle-3"></span>
                    <span class="circle circle-4"></span>
                    <span class="circle circle-5"></span>
                    <span class="circle circle-6"></span>
                    <span class="circle circle-7"></span>
                    <span class="circle circle-8"></span>
                </div>
            </div>    
      <div class="clearfix">

         <div class="clearfix">

            <?php //get_template_part('alerts'); ?>

         </div>

      </div>

      <?php if(isset($knowledge_base_search)){ ?>

         <?php get_template_part('knowledge_base/search'); ?>

      <?php } ?>

      <div class="main-page">

         <!-- <?php // hooks()->do_action('customers_content_container_start'); ?> -->

         <div class="clearfix">

            <?php

            if(is_client_logged_in() && $subMenuEnabled && !isset($knowledge_base_search)){ ?>

               <!-- <ul class="submenu customer-top-submenu">

                  <?php hooks()->do_action('before_customers_area_sub_menu_start'); ?>

                  <li class="customers-top-submenu-files"><a href="<?php echo site_url('clients/files'); ?>"><i class="fa fa-file" aria-hidden="true"></i> <?php echo _l('customer_profile_files'); ?></a></li>

                  <li class="customers-top-submenu-calendar"><a href="<?php echo site_url('clients/calendar'); ?>"><i class="fa fa-calendar-minus-o" aria-hidden="true"></i> <?php echo _l('calendar'); ?></a></li>

                  <?php hooks()->do_action('after_customers_area_sub_menu_end'); ?>

               </ul> -->

               <div class="clearfix"></div>

            <?php } ?>

            <?php echo theme_template_view(); ?>

         </div>

      </div>

   </div>

   <?php

   echo theme_footer_view();

   ?>

</div>

<?php

/* Always have app_customers_footer() just before the closing </body>  */

app_customers_footer();

   /**

   * Check for any alerts stored in session

   */

   app_js_alerts();

   ?>

</body>

</html>

