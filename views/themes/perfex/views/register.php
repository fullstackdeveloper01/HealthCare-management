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
<div class="col-md-4 col-md-offset-4 text-center" style="margin-top: 10px;">
    <div class="text-center">
       <?php
            if($settingRes->logo_image != '')
            {
                ?>
                    <img src="<?= base_url() ?>uploads/loginPage/<?= $settingRes->logo_image; ?>" height="100px" alt="">
                <?php
            }
        ?>
        <h1 class="text-uppercase register-heading"><?php echo _l('clients_register_heading'); ?></h1>
   </div>
</div>
<!--<div class="col-md-10 col-md-offset-1">-->
<div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
    <?php echo form_open('authentication/register', ['id'=>'register-form']); ?>
    <div class="panel_s">
        <div class="panel-body">
            <div class="form-group register-firstname-group">
                <label class="control-label" for="firstname"><?php echo _l('clients_firstname'); ?></label>
                <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo set_value('firstname'); ?>">
                <?php echo form_error('firstname'); ?>
            </div>
            <div class="form-group register-lastname-group">
                <label class="control-label" for="lastname"><?php echo _l('clients_lastname'); ?></label>
                <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo set_value('lastname'); ?>">
                <?php echo form_error('lastname'); ?>
            </div>
            <div class="form-group register-brokerage-group">
                <label class="control-label" for="brokerage"><?php echo _l('Brokerage'); ?></label>
                <input type="text" class="form-control" name="brokerage" id="brokerage" value="<?php echo set_value('brokerage'); ?>">
                <?php echo form_error('brokerage'); ?>
            </div>
            <div class="form-group register-agent_city-group">
                <label class="control-label" for="agent_city"><?php echo _l('City'); ?></label>
                <input type="text" class="form-control" name="agent_city" id="agent_city" value="<?php echo set_value('agent_city'); ?>">
                <?php echo form_error('agent_city'); ?>
            </div>
            <div class="form-group register-agent_state-group">
                <label class="control-label" for="agent_state"><?php echo _l('State'); ?></label>
                <input type="text" class="form-control" name="agent_state" id="agent_state" value="<?php echo set_value('agent_state'); ?>">
                <?php echo form_error('agent_state'); ?>
            </div>
            <div class="form-group register-license-group">
                <label class="control-label" for="license"><?php echo _l('License'); ?></label>
                <input type="text" class="form-control" name="license" id="license" value="<?php echo set_value('license'); ?>">
                <?php echo form_error('license'); ?>
            </div>
            <div class="form-group register-email-group">
                <label class="control-label" for="email"><?php echo _l('clients_email'); ?></label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo set_value('email'); ?>">
                <?php echo form_error('email'); ?>
            </div>
            <div class="form-group register-contact-phone-group">
                <label class="control-label" for="contact_phonenumber"><?php echo _l('clients_phone'); ?></label>
                <input type="text" class="form-control" name="contact_phonenumber" id="contact_phonenumber" value="<?php echo set_value('contact_phonenumber'); ?>">
            </div>
            <div class="form-group register-timezone">
                <label>TimeZone</label>
                <select name="user_timezone" required class="form-control" data-live-search="true" id="timeZoneList">
                    <option value="Etc/GMT+12">(GMT -12:0) GMT-12:00 (Etc/GMT+12)</option>
                    <option value="Etc/GMT+11">(GMT -11:0) GMT-11:00 (Etc/GMT+11)</option>
                    <option value="Pacific/Midway">(GMT -11:0) Samoa Standard Time (Pacific/Midway)</option>
                    <option value="Pacific/Niue">(GMT -11:0) Niue Time (Pacific/Niue)</option>
                    <option value="Pacific/Pago_Pago">(GMT -11:0) Samoa Standard Time (Pacific/Pago_Pago)</option>
                    <option value="Pacific/Samoa">(GMT -11:0) Samoa Standard Time (Pacific/Samoa)</option>
                    <option value="US/Samoa">(GMT -11:0) Samoa Standard Time (US/Samoa)</option>
                    <option value="America/Adak">(GMT -9:0) Hawaii Daylight Time (America/Adak)</option>
                    <option value="America/Atka">(GMT -9:0) Hawaii Daylight Time (America/Atka)</option>
                    <option value="Etc/GMT+10">(GMT -10:0) GMT-10:00 (Etc/GMT+10)</option>
                    <option value="HST">(GMT -10:0) Hawaii Standard Time (HST)</option>
                    <option value="Pacific/Honolulu">(GMT -10:0) Hawaii Standard Time (Pacific/Honolulu)</option>
                    <option value="Pacific/Johnston">(GMT -10:0) Hawaii Standard Time (Pacific/Johnston)</option>
                    <option value="Pacific/Rarotonga">(GMT -10:0) Cook Is. Time (Pacific/Rarotonga)</option>
                    <option value="Pacific/Tahiti">(GMT -10:0) Tahiti Time (Pacific/Tahiti)</option>
                    <option value="SystemV/HST10">(GMT -10:0) Hawaii Standard Time (SystemV/HST10)</option>
                    <option value="US/Aleutian">(GMT -9:0) Hawaii Daylight Time (US/Aleutian)</option>
                    <option value="US/Hawaii">(GMT -10:0) Hawaii Standard Time (US/Hawaii)</option>
                    <option value="Pacific/Marquesas">(GMT -9:30) Marquesas Time (Pacific/Marquesas)</option>
                    <option value="AST">(GMT -8:0) Alaska Daylight Time (AST)</option>
                    <option value="America/Anchorage">(GMT -8:0) Alaska Daylight Time (America/Anchorage)</option>
                    <option value="America/Juneau">(GMT -8:0) Alaska Daylight Time (America/Juneau)</option>
                    <option value="America/Metlakatla">(GMT -8:0) Alaska Daylight Time (America/Metlakatla)</option>
                    <option value="America/Nome">(GMT -8:0) Alaska Daylight Time (America/Nome)</option>
                    <option value="America/Sitka">(GMT -8:0) Alaska Daylight Time (America/Sitka)</option>
                    <option value="America/Yakutat">(GMT -8:0) Alaska Daylight Time (America/Yakutat)</option>
                    <option value="Etc/GMT+9">(GMT -9:0) GMT-09:00 (Etc/GMT+9)</option>
                    <option value="Pacific/Gambier">(GMT -9:0) Gambier Time (Pacific/Gambier)</option>
                    <option value="SystemV/YST9">(GMT -9:0) Alaska Standard Time (SystemV/YST9)</option>
                    <option value="SystemV/YST9YDT">(GMT -8:0) Alaska Daylight Time (SystemV/YST9YDT)</option>
                    <option value="US/Alaska">(GMT -8:0) Alaska Daylight Time (US/Alaska)</option>
                    <option value="America/Dawson">(GMT -7:0) Pacific Daylight Time (America/Dawson)</option>
                    <option value="America/Ensenada">(GMT -7:0) Pacific Daylight Time (America/Ensenada)</option>
                    <option value="America/Los_Angeles">(GMT -7:0) Pacific Daylight Time (America/Los_Angeles)</option>
                    <option value="America/Santa_Isabel">(GMT -7:0) Pacific Daylight Time (America/Santa_Isabel)</option>
                    <option value="America/Tijuana">(GMT -7:0) Pacific Daylight Time (America/Tijuana)</option>
                    <option value="America/Vancouver">(GMT -7:0) Pacific Daylight Time (America/Vancouver)</option>
                    <option value="America/Whitehorse">(GMT -7:0) Pacific Daylight Time (America/Whitehorse)</option>
                    <option value="Canada/Pacific">(GMT -7:0) Pacific Daylight Time (Canada/Pacific)</option>
                    <option value="Canada/Yukon">(GMT -7:0) Pacific Daylight Time (Canada/Yukon)</option>
                    <option value="Etc/GMT+8">(GMT -8:0) GMT-08:00 (Etc/GMT+8)</option>
                    <option value="Mexico/BajaNorte">(GMT -7:0) Pacific Daylight Time (Mexico/BajaNorte)</option>
                    <option value="PST">(GMT -7:0) Pacific Daylight Time (PST)</option>
                    <option value="PST8PDT">(GMT -7:0) Pacific Daylight Time (PST8PDT)</option>
                    <option value="Pacific/Pitcairn">(GMT -8:0) Pitcairn Standard Time (Pacific/Pitcairn)</option>
                    <option value="SystemV/PST8">(GMT -8:0) Pacific Standard Time (SystemV/PST8)</option>
                    <option value="SystemV/PST8PDT">(GMT -7:0) Pacific Daylight Time (SystemV/PST8PDT)</option>
                    <option value="US/Pacific">(GMT -7:0) Pacific Daylight Time (US/Pacific)</option>
                    <option value="US/Pacific-New">(GMT -7:0) Pacific Daylight Time (US/Pacific-New)</option>
                    <option value="America/Boise">(GMT -6:0) Mountain Daylight Time (America/Boise)</option>
                    <option value="America/Cambridge_Bay">(GMT -6:0) Mountain Daylight Time (America/Cambridge_Bay)</option>
                    <option value="America/Chihuahua">(GMT -6:0) Mountain Daylight Time (America/Chihuahua)</option>
                    <option value="America/Creston">(GMT -7:0) Mountain Standard Time (America/Creston)</option>
                    <option value="America/Dawson_Creek">(GMT -7:0) Mountain Standard Time (America/Dawson_Creek)</option>
                    <option value="America/Denver">(GMT -6:0) Mountain Daylight Time (America/Denver)</option>
                    <option value="America/Edmonton">(GMT -6:0) Mountain Daylight Time (America/Edmonton)</option>
                    <option value="America/Fort_Nelson">(GMT -7:0) Mountain Standard Time (America/Fort_Nelson)</option>
                    <option value="America/Hermosillo">(GMT -7:0) Mountain Standard Time (America/Hermosillo)</option>
                    <option value="America/Inuvik">(GMT -6:0) Mountain Daylight Time (America/Inuvik)</option>
                    <option value="America/Mazatlan">(GMT -6:0) Mountain Daylight Time (America/Mazatlan)</option>
                    <option value="America/Ojinaga">(GMT -6:0) Mountain Daylight Time (America/Ojinaga)</option>
                    <option value="America/Phoenix">(GMT -7:0) Mountain Standard Time (America/Phoenix)</option>
                    <option value="America/Shiprock">(GMT -6:0) Mountain Daylight Time (America/Shiprock)</option>
                    <option value="America/Yellowknife">(GMT -6:0) Mountain Daylight Time (America/Yellowknife)</option>
                    <option value="Canada/Mountain">(GMT -6:0) Mountain Daylight Time (Canada/Mountain)</option>
                    <option value="Etc/GMT+7">(GMT -7:0) GMT-07:00 (Etc/GMT+7)</option>
                    <option value="MST">(GMT -7:0) Mountain Standard Time (MST)</option>
                    <option value="MST7MDT">(GMT -6:0) Mountain Daylight Time (MST7MDT)</option>
                    <option value="Mexico/BajaSur">(GMT -6:0) Mountain Daylight Time (Mexico/BajaSur)</option>
                    <option value="Navajo">(GMT -6:0) Mountain Daylight Time (Navajo)</option>
                    <option value="PNT">(GMT -7:0) Mountain Standard Time (PNT)</option>
                    <option value="SystemV/MST7">(GMT -7:0) Mountain Standard Time (SystemV/MST7)</option>
                    <option value="SystemV/MST7MDT">(GMT -6:0) Mountain Daylight Time (SystemV/MST7MDT)</option>
                    <option value="US/Arizona">(GMT -7:0) Mountain Standard Time (US/Arizona)</option>
                    <option value="US/Mountain">(GMT -6:0) Mountain Daylight Time (US/Mountain)</option>
                    <option value="America/Bahia_Banderas">(GMT -5:0) Central Daylight Time (America/Bahia_Banderas)</option>
                    <option value="America/Belize">(GMT -6:0) Central Standard Time (America/Belize)</option>
                    <option value="America/Chicago">(GMT -5:0) Central Daylight Time (America/Chicago)</option>
                    <option value="America/Costa_Rica">(GMT -6:0) Central Standard Time (America/Costa_Rica)</option>
                    <option value="America/El_Salvador">(GMT -6:0) Central Standard Time (America/El_Salvador)</option>
                    <option value="America/Guatemala">(GMT -6:0) Central Standard Time (America/Guatemala)</option>
                    <option value="America/Indiana/Knox">(GMT -5:0) Central Daylight Time (America/Indiana/Knox)</option>
                    <option value="America/Indiana/Tell_City">(GMT -5:0) Central Daylight Time (America/Indiana/Tell_City)</option>
                    <option value="America/Knox_IN">(GMT -5:0) Central Daylight Time (America/Knox_IN)</option>
                    <option value="America/Managua">(GMT -6:0) Central Standard Time (America/Managua)</option>
                    <option value="America/Matamoros">(GMT -5:0) Central Daylight Time (America/Matamoros)</option>
                    <option value="America/Menominee">(GMT -5:0) Central Daylight Time (America/Menominee)</option>
                    <option value="America/Merida">(GMT -5:0) Central Daylight Time (America/Merida)</option>
                    <option value="America/Mexico_City">(GMT -5:0) Central Daylight Time (America/Mexico_City)</option>
                    <option value="America/Monterrey">(GMT -5:0) Central Daylight Time (America/Monterrey)</option>
                    <option value="America/North_Dakota/Beulah">(GMT -5:0) Central Daylight Time (America/North_Dakota/Beulah)</option>
                    <option value="America/North_Dakota/Center">(GMT -5:0) Central Daylight Time (America/North_Dakota/Center)</option>
                    <option value="America/North_Dakota/New_Salem">(GMT -5:0) Central Daylight Time (America/North_Dakota/New_Salem)</option>
                    <option value="America/Rainy_River">(GMT -5:0) Central Daylight Time (America/Rainy_River)</option>
                    <option value="America/Rankin_Inlet">(GMT -5:0) Central Daylight Time (America/Rankin_Inlet)</option>
                    <option value="America/Regina">(GMT -6:0) Central Standard Time (America/Regina)</option>
                    <option value="America/Resolute">(GMT -5:0) Central Daylight Time (America/Resolute)</option>
                    <option value="America/Swift_Current">(GMT -6:0) Central Standard Time (America/Swift_Current)</option>
                    <option value="America/Tegucigalpa">(GMT -6:0) Central Standard Time (America/Tegucigalpa)</option>
                    <option value="America/Winnipeg">(GMT -5:0) Central Daylight Time (America/Winnipeg)</option>
                    <option value="CST">(GMT -5:0) Central Daylight Time (CST)</option>
                    <option value="CST6CDT">(GMT -5:0) Central Daylight Time (CST6CDT)</option>
                    <option value="Canada/Central">(GMT -5:0) Central Daylight Time (Canada/Central)</option>
                    <option value="Canada/Saskatchewan">(GMT -6:0) Central Standard Time (Canada/Saskatchewan)</option>
                    <option value="Chile/EasterIsland">(GMT -6:0) Easter Is. Time (Chile/EasterIsland)</option>
                    <option value="Etc/GMT+6">(GMT -6:0) GMT-06:00 (Etc/GMT+6)</option>
                    <option value="Mexico/General">(GMT -5:0) Central Daylight Time (Mexico/General)</option>
                    <option value="Pacific/Easter">(GMT -6:0) Easter Is. Time (Pacific/Easter)</option>
                    <option value="Pacific/Galapagos">(GMT -6:0) Galapagos Time (Pacific/Galapagos)</option>
                    <option value="SystemV/CST6">(GMT -6:0) Central Standard Time (SystemV/CST6)</option>
                    <option value="SystemV/CST6CDT">(GMT -5:0) Central Daylight Time (SystemV/CST6CDT)</option>
                    <option value="US/Central">(GMT -5:0) Central Daylight Time (US/Central)</option>
                    <option value="US/Indiana-Starke">(GMT -5:0) Central Daylight Time (US/Indiana-Starke)</option>
                    <option value="America/Atikokan">(GMT -5:0) Eastern Standard Time (America/Atikokan)</option>
                    <option value="America/Bogota">(GMT -5:0) Colombia Time (America/Bogota)</option>
                    <option value="America/Cancun">(GMT -5:0) Eastern Standard Time (America/Cancun)</option>
                    <option value="America/Cayman">(GMT -5:0) Eastern Standard Time (America/Cayman)</option>
                    <option value="America/Coral_Harbour">(GMT -5:0) Eastern Standard Time (America/Coral_Harbour)</option>
                    <option value="America/Detroit">(GMT -4:0) Eastern Daylight Time (America/Detroit)</option>
                    <option value="America/Eirunepe">(GMT -5:0) Acre Time (America/Eirunepe)</option>
                    <option value="America/Fort_Wayne">(GMT -4:0) Eastern Daylight Time (America/Fort_Wayne)</option>
                    <option value="America/Grand_Turk">(GMT -4:0) Eastern Daylight Time (America/Grand_Turk)</option>
                    <option value="America/Guayaquil">(GMT -5:0) Ecuador Time (America/Guayaquil)</option>
                    <option value="America/Havana">(GMT -4:0) Cuba Daylight Time (America/Havana)</option>
                    <option value="America/Indiana/Indianapolis">(GMT -4:0) Eastern Daylight Time (America/Indiana/Indianapolis)</option>
                    <option value="America/Indiana/Marengo">(GMT -4:0) Eastern Daylight Time (America/Indiana/Marengo)</option>
                    <option value="America/Indiana/Petersburg">(GMT -4:0) Eastern Daylight Time (America/Indiana/Petersburg)</option>
                    <option value="America/Indiana/Vevay">(GMT -4:0) Eastern Daylight Time (America/Indiana/Vevay)</option>
                    <option value="America/Indiana/Vincennes">(GMT -4:0) Eastern Daylight Time (America/Indiana/Vincennes)</option>
                    <option value="America/Indiana/Winamac">(GMT -4:0) Eastern Daylight Time (America/Indiana/Winamac)</option>
                    <option value="America/Indianapolis">(GMT -4:0) Eastern Daylight Time (America/Indianapolis)</option>
                    <option value="America/Iqaluit">(GMT -4:0) Eastern Daylight Time (America/Iqaluit)</option>
                    <option value="America/Jamaica">(GMT -5:0) Eastern Standard Time (America/Jamaica)</option>
                    <option value="America/Kentucky/Louisville">(GMT -4:0) Eastern Daylight Time (America/Kentucky/Louisville)</option>
                    <option value="America/Kentucky/Monticello">(GMT -4:0) Eastern Daylight Time (America/Kentucky/Monticello)</option>
                    <option value="America/Lima">(GMT -5:0) Peru Time (America/Lima)</option>
                    <option value="America/Louisville">(GMT -4:0) Eastern Daylight Time (America/Louisville)</option>
                    <option value="America/Montreal">(GMT -4:0) Eastern Daylight Time (America/Montreal)</option>
                    <option value="America/Nassau">(GMT -4:0) Eastern Daylight Time (America/Nassau)</option>
                    <option value="America/New_York">(GMT -4:0) Eastern Daylight Time (America/New_York)</option>
                    <option value="America/Nipigon">(GMT -4:0) Eastern Daylight Time (America/Nipigon)</option>
                    <option value="America/Panama">(GMT -5:0) Eastern Standard Time (America/Panama)</option>
                    <option value="America/Pangnirtung">(GMT -4:0) Eastern Daylight Time (America/Pangnirtung)</option>
                    <option value="America/Port-au-Prince">(GMT -4:0) Eastern Daylight Time (America/Port-au-Prince)</option>
                    <option value="America/Porto_Acre">(GMT -5:0) Acre Time (America/Porto_Acre)</option>
                    <option value="America/Rio_Branco">(GMT -5:0) Acre Time (America/Rio_Branco)</option>
                    <option value="America/Thunder_Bay">(GMT -4:0) Eastern Daylight Time (America/Thunder_Bay)</option>
                    <option value="America/Toronto">(GMT -4:0) Eastern Daylight Time (America/Toronto)</option>
                    <option value="Brazil/Acre">(GMT -5:0) Acre Time (Brazil/Acre)</option>
                    <option value="Canada/Eastern">(GMT -4:0) Eastern Daylight Time (Canada/Eastern)</option>
                    <option value="Cuba">(GMT -4:0) Cuba Daylight Time (Cuba)</option>
                    <option value="EST">(GMT -5:0) Eastern Standard Time (EST)</option>
                    <option value="EST5EDT">(GMT -4:0) Eastern Daylight Time (EST5EDT)</option>
                    <option value="Etc/GMT+5">(GMT -5:0) GMT-05:00 (Etc/GMT+5)</option>
                    <option value="IET">(GMT -4:0) Eastern Daylight Time (IET)</option>
                    <option value="Jamaica">(GMT -5:0) Eastern Standard Time (Jamaica)</option>
                    <option value="SystemV/EST5">(GMT -5:0) Eastern Standard Time (SystemV/EST5)</option>
                    <option value="SystemV/EST5EDT">(GMT -4:0) Eastern Daylight Time (SystemV/EST5EDT)</option>
                    <option value="US/East-Indiana">(GMT -4:0) Eastern Daylight Time (US/East-Indiana)</option>
                    <option value="US/Eastern">(GMT -4:0) Eastern Daylight Time (US/Eastern)</option>
                    <option value="US/Michigan">(GMT -4:0) Eastern Daylight Time (US/Michigan)</option>
                    <option value="America/Anguilla">(GMT -4:0) Atlantic Standard Time (America/Anguilla)</option>
                    <option value="America/Antigua">(GMT -4:0) Atlantic Standard Time (America/Antigua)</option>
                    <option value="America/Aruba">(GMT -4:0) Atlantic Standard Time (America/Aruba)</option>
                    <option value="America/Asuncion">(GMT -4:0) Paraguay Time (America/Asuncion)</option>
                    <option value="America/Barbados">(GMT -4:0) Atlantic Standard Time (America/Barbados)</option>
                    <option value="America/Blanc-Sablon">(GMT -4:0) Atlantic Standard Time (America/Blanc-Sablon)</option>
                    <option value="America/Boa_Vista">(GMT -4:0) Amazon Time (America/Boa_Vista)</option>
                    <option value="America/Campo_Grande">(GMT -4:0) Amazon Time (America/Campo_Grande)</option>
                    <option value="America/Caracas">(GMT -4:0) Venezuela Time (America/Caracas)</option>
                    <option value="America/Cuiaba">(GMT -4:0) Amazon Time (America/Cuiaba)</option>
                    <option value="America/Curacao">(GMT -4:0) Atlantic Standard Time (America/Curacao)</option>
                    <option value="America/Dominica">(GMT -4:0) Atlantic Standard Time (America/Dominica)</option>
                    <option value="America/Glace_Bay">(GMT -3:0) Atlantic Daylight Time (America/Glace_Bay)</option>
                    <option value="America/Goose_Bay">(GMT -3:0) Atlantic Daylight Time (America/Goose_Bay)</option>
                    <option value="America/Grenada">(GMT -4:0) Atlantic Standard Time (America/Grenada)</option>
                    <option value="America/Guadeloupe">(GMT -4:0) Atlantic Standard Time (America/Guadeloupe)</option>
                    <option value="America/Guyana">(GMT -4:0) Guyana Time (America/Guyana)</option>
                    <option value="America/Halifax">(GMT -3:0) Atlantic Daylight Time (America/Halifax)</option>
                    <option value="America/Kralendijk">(GMT -4:0) Atlantic Standard Time (America/Kralendijk)</option>
                    <option value="America/La_Paz">(GMT -4:0) Bolivia Time (America/La_Paz)</option>
                    <option value="America/Lower_Princes">(GMT -4:0) Atlantic Standard Time (America/Lower_Princes)</option>
                    <option value="America/Manaus">(GMT -4:0) Amazon Time (America/Manaus)</option>
                    <option value="America/Marigot">(GMT -4:0) Atlantic Standard Time (America/Marigot)</option>
                    <option value="America/Martinique">(GMT -4:0) Atlantic Standard Time (America/Martinique)</option>
                    <option value="America/Moncton">(GMT -3:0) Atlantic Daylight Time (America/Moncton)</option>
                    <option value="America/Montserrat">(GMT -4:0) Atlantic Standard Time (America/Montserrat)</option>
                    <option value="America/Port_of_Spain">(GMT -4:0) Atlantic Standard Time (America/Port_of_Spain)</option>
                    <option value="America/Porto_Velho">(GMT -4:0) Amazon Time (America/Porto_Velho)</option>
                    <option value="America/Puerto_Rico">(GMT -4:0) Atlantic Standard Time (America/Puerto_Rico)</option>
                    <option value="America/Santiago">(GMT -4:0) Chile Time (America/Santiago)</option>
                    <option value="America/Santo_Domingo">(GMT -4:0) Atlantic Standard Time (America/Santo_Domingo)</option>
                    <option value="America/St_Barthelemy">(GMT -4:0) Atlantic Standard Time (America/St_Barthelemy)</option>
                    <option value="America/St_Kitts">(GMT -4:0) Atlantic Standard Time (America/St_Kitts)</option>
                    <option value="America/St_Lucia">(GMT -4:0) Atlantic Standard Time (America/St_Lucia)</option>
                    <option value="America/St_Thomas">(GMT -4:0) Atlantic Standard Time (America/St_Thomas)</option>
                    <option value="America/St_Vincent">(GMT -4:0) Atlantic Standard Time (America/St_Vincent)</option>
                    <option value="America/Thule">(GMT -3:0) Atlantic Daylight Time (America/Thule)</option>
                    <option value="America/Tortola">(GMT -4:0) Atlantic Standard Time (America/Tortola)</option>
                    <option value="America/Virgin">(GMT -4:0) Atlantic Standard Time (America/Virgin)</option>
                    <option value="Atlantic/Bermuda">(GMT -3:0) Atlantic Daylight Time (Atlantic/Bermuda)</option>
                    <option value="Brazil/West">(GMT -4:0) Amazon Time (Brazil/West)</option>
                    <option value="Canada/Atlantic">(GMT -3:0) Atlantic Daylight Time (Canada/Atlantic)</option>
                    <option value="Chile/Continental">(GMT -4:0) Chile Time (Chile/Continental)</option>
                    <option value="Etc/GMT+4">(GMT -4:0) GMT-04:00 (Etc/GMT+4)</option>
                    <option value="PRT">(GMT -4:0) Atlantic Standard Time (PRT)</option>
                    <option value="SystemV/AST4">(GMT -4:0) Atlantic Standard Time (SystemV/AST4)</option>
                    <option value="SystemV/AST4ADT">(GMT -3:0) Atlantic Daylight Time (SystemV/AST4ADT)</option>
                    <option value="America/St_Johns">(GMT -2:30) Newfoundland Daylight Time (America/St_Johns)</option>
                    <option value="CNT">(GMT -2:30) Newfoundland Daylight Time (CNT)</option>
                    <option value="Canada/Newfoundland">(GMT -2:30) Newfoundland Daylight Time (Canada/Newfoundland)</option>
                    <option value="AGT">(GMT -3:0) Argentine Time (AGT)</option>
                    <option value="America/Araguaina">(GMT -3:0) Brasilia Time (America/Araguaina)</option>
                    <option value="America/Argentina/Buenos_Aires">(GMT -3:0) Argentine Time (America/Argentina/Buenos_Aires)</option>
                    <option value="America/Argentina/Catamarca">(GMT -3:0) Argentine Time (America/Argentina/Catamarca)</option>
                    <option value="America/Argentina/ComodRivadavia">(GMT -3:0) Argentine Time (America/Argentina/ComodRivadavia)</option>
                    <option value="America/Argentina/Cordoba">(GMT -3:0) Argentine Time (America/Argentina/Cordoba)</option>
                    <option value="America/Argentina/Jujuy">(GMT -3:0) Argentine Time (America/Argentina/Jujuy)</option>
                    <option value="America/Argentina/La_Rioja">(GMT -3:0) Argentine Time (America/Argentina/La_Rioja)</option>
                    <option value="America/Argentina/Mendoza">(GMT -3:0) Argentine Time (America/Argentina/Mendoza)</option>
                    <option value="America/Argentina/Rio_Gallegos">(GMT -3:0) Argentine Time (America/Argentina/Rio_Gallegos)</option>
                    <option value="America/Argentina/Salta">(GMT -3:0) Argentine Time (America/Argentina/Salta)</option>
                    <option value="America/Argentina/San_Juan">(GMT -3:0) Argentine Time (America/Argentina/San_Juan)</option>
                    <option value="America/Argentina/San_Luis">(GMT -3:0) Argentine Time (America/Argentina/San_Luis)</option>
                    <option value="America/Argentina/Tucuman">(GMT -3:0) Argentine Time (America/Argentina/Tucuman)</option>
                    <option value="America/Argentina/Ushuaia">(GMT -3:0) Argentine Time (America/Argentina/Ushuaia)</option>
                    <option value="America/Bahia">(GMT -3:0) Brasilia Time (America/Bahia)</option>
                    <option value="America/Belem">(GMT -3:0) Brasilia Time (America/Belem)</option>
                    <option value="America/Buenos_Aires">(GMT -3:0) Argentine Time (America/Buenos_Aires)</option>
                    <option value="America/Catamarca">(GMT -3:0) Argentine Time (America/Catamarca)</option>
                    <option value="America/Cayenne">(GMT -3:0) French Guiana Time (America/Cayenne)</option>
                    <option value="America/Cordoba">(GMT -3:0) Argentine Time (America/Cordoba)</option>
                    <option value="America/Fortaleza">(GMT -3:0) Brasilia Time (America/Fortaleza)</option>
                    <option value="America/Godthab">(GMT -2:0) Western Greenland Summer Time (America/Godthab)</option>
                    <option value="America/Jujuy">(GMT -3:0) Argentine Time (America/Jujuy)</option>
                    <option value="America/Maceio">(GMT -3:0) Brasilia Time (America/Maceio)</option>
                    <option value="America/Mendoza">(GMT -3:0) Argentine Time (America/Mendoza)</option>
                    <option value="America/Miquelon">(GMT -2:0) Pierre &amp; Miquelon Daylight Time (America/Miquelon)</option>
                    <option value="America/Montevideo">(GMT -3:0) Uruguay Time (America/Montevideo)</option>
                    <option value="America/Paramaribo">(GMT -3:0) Suriname Time (America/Paramaribo)</option>
                    <option value="America/Punta_Arenas">(GMT -3:0) GMT-03:00 (America/Punta_Arenas)</option>
                    <option value="America/Recife">(GMT -3:0) Brasilia Time (America/Recife)</option>
                    <option value="America/Rosario">(GMT -3:0) Argentine Time (America/Rosario)</option>
                    <option value="America/Santarem">(GMT -3:0) Brasilia Time (America/Santarem)</option>
                    <option value="America/Sao_Paulo">(GMT -3:0) Brasilia Time (America/Sao_Paulo)</option>
                    <option value="Antarctica/Palmer">(GMT -3:0) Chile Time (Antarctica/Palmer)</option>
                    <option value="Antarctica/Rothera">(GMT -3:0) Rothera Time (Antarctica/Rothera)</option>
                    <option value="Atlantic/Stanley">(GMT -3:0) Falkland Is. Time (Atlantic/Stanley)</option>
                    <option value="BET">(GMT -3:0) Brasilia Time (BET)</option>
                    <option value="Brazil/East">(GMT -3:0) Brasilia Time (Brazil/East)</option>
                    <option value="Etc/GMT+3">(GMT -3:0) GMT-03:00 (Etc/GMT+3)</option>
                    <option value="America/Noronha">(GMT -2:0) Fernando de Noronha Time (America/Noronha)</option>
                    <option value="Atlantic/South_Georgia">(GMT -2:0) South Georgia Standard Time (Atlantic/South_Georgia)</option>
                    <option value="Brazil/DeNoronha">(GMT -2:0) Fernando de Noronha Time (Brazil/DeNoronha)</option>
                    <option value="Etc/GMT+2">(GMT -2:0) GMT-02:00 (Etc/GMT+2)</option>
                    <option value="America/Scoresbysund">(GMT 0:0) Eastern Greenland Summer Time (America/Scoresbysund)</option>
                    <option value="Atlantic/Azores">(GMT 0:0) Azores Summer Time (Atlantic/Azores)</option>
                    <option value="Atlantic/Cape_Verde">(GMT -1:0) Cape Verde Time (Atlantic/Cape_Verde)</option>
                    <option value="Etc/GMT+1">(GMT -1:0) GMT-01:00 (Etc/GMT+1)</option>
                    <option value="Africa/Abidjan">(GMT 0:0) Greenwich Mean Time (Africa/Abidjan)</option>
                    <option value="Africa/Accra">(GMT 0:0) Ghana Mean Time (Africa/Accra)</option>
                    <option value="Africa/Bamako">(GMT 0:0) Greenwich Mean Time (Africa/Bamako)</option>
                    <option value="Africa/Banjul">(GMT 0:0) Greenwich Mean Time (Africa/Banjul)</option>
                    <option value="Africa/Bissau">(GMT 0:0) Greenwich Mean Time (Africa/Bissau)</option>
                    <option value="Africa/Casablanca">(GMT 0:0) Western European Summer Time (Africa/Casablanca)</option>
                    <option value="Africa/Conakry">(GMT 0:0) Greenwich Mean Time (Africa/Conakry)</option>
                    <option value="Africa/Dakar">(GMT 0:0) Greenwich Mean Time (Africa/Dakar)</option>
                    <option value="Africa/El_Aaiun">(GMT 0:0) Western European Summer Time (Africa/El_Aaiun)</option>
                    <option value="Africa/Freetown">(GMT 0:0) Greenwich Mean Time (Africa/Freetown)</option>
                    <option value="Africa/Lome">(GMT 0:0) Greenwich Mean Time (Africa/Lome)</option>
                    <option value="Africa/Monrovia">(GMT 0:0) Greenwich Mean Time (Africa/Monrovia)</option>
                    <option value="Africa/Nouakchott">(GMT 0:0) Greenwich Mean Time (Africa/Nouakchott)</option>
                    <option value="Africa/Ouagadougou">(GMT 0:0) Greenwich Mean Time (Africa/Ouagadougou)</option>
                    <option value="Africa/Sao_Tome">(GMT 0:0) Greenwich Mean Time (Africa/Sao_Tome)</option>
                    <option value="Africa/Timbuktu">(GMT 0:0) Greenwich Mean Time (Africa/Timbuktu)</option>
                    <option value="America/Danmarkshavn">(GMT 0:0) Greenwich Mean Time (America/Danmarkshavn)</option>
                    <option value="Antarctica/Troll">(GMT 2:0) Central European Summer Time (Antarctica/Troll)</option>
                    <option value="Atlantic/Canary">(GMT 1:0) Western European Summer Time (Atlantic/Canary)</option>
                    <option value="Atlantic/Faeroe">(GMT 1:0) Western European Summer Time (Atlantic/Faeroe)</option>
                    <option value="Atlantic/Faroe">(GMT 1:0) Western European Summer Time (Atlantic/Faroe)</option>
                    <option value="Atlantic/Madeira">(GMT 1:0) Western European Summer Time (Atlantic/Madeira)</option>
                    <option value="Atlantic/Reykjavik">(GMT 0:0) Greenwich Mean Time (Atlantic/Reykjavik)</option>
                    <option value="Atlantic/St_Helena">(GMT 0:0) Greenwich Mean Time (Atlantic/St_Helena)</option>
                    <option value="Eire">(GMT 1:0) Irish Summer Time (Eire)</option>
                    <option value="Etc/GMT">(GMT 0:0) Greenwich Mean Time (Etc/GMT)</option>
                    <option value="Etc/GMT+0">(GMT 0:0) Greenwich Mean Time (Etc/GMT+0)</option>
                    <option value="Etc/GMT-0">(GMT 0:0) Greenwich Mean Time (Etc/GMT-0)</option>
                    <option value="Etc/GMT0">(GMT 0:0) Greenwich Mean Time (Etc/GMT0)</option>
                    <option value="Etc/Greenwich">(GMT 0:0) Greenwich Mean Time (Etc/Greenwich)</option>
                    <option value="Etc/UCT">(GMT 0:0) Coordinated Universal Time (Etc/UCT)</option>
                    <option value="Etc/UTC">(GMT 0:0) Coordinated Universal Time (Etc/UTC)</option>
                    <option value="Etc/Universal">(GMT 0:0) Coordinated Universal Time (Etc/Universal)</option>
                    <option value="Etc/Zulu">(GMT 0:0) Coordinated Universal Time (Etc/Zulu)</option>
                    <option value="Europe/Belfast">(GMT 1:0) British Summer Time (Europe/Belfast)</option>
                    <option value="Europe/Dublin">(GMT 1:0) Irish Summer Time (Europe/Dublin)</option>
                    <option value="Europe/Guernsey">(GMT 1:0) British Summer Time (Europe/Guernsey)</option>
                    <option value="Europe/Isle_of_Man">(GMT 1:0) British Summer Time (Europe/Isle_of_Man)</option>
                    <option value="Europe/Jersey">(GMT 1:0) British Summer Time (Europe/Jersey)</option>
                    <option value="Europe/Lisbon">(GMT 1:0) Western European Summer Time (Europe/Lisbon)</option>
                    <option value="Europe/London">(GMT 1:0) British Summer Time (Europe/London)</option>
                    <option value="GB">(GMT 1:0) British Summer Time (GB)</option>
                    <option value="GB-Eire">(GMT 1:0) British Summer Time (GB-Eire)</option>
                    <option value="GMT">(GMT 0:0) Greenwich Mean Time (GMT)</option>
                    <option value="GMT0">(GMT 0:0) Greenwich Mean Time (GMT0)</option>
                    <option value="Greenwich">(GMT 0:0) Greenwich Mean Time (Greenwich)</option>
                    <option value="Iceland">(GMT 0:0) Greenwich Mean Time (Iceland)</option>
                    <option value="Portugal">(GMT 1:0) Western European Summer Time (Portugal)</option>
                    <option value="UCT">(GMT 0:0) Coordinated Universal Time (UCT)</option>
                    <option value="UTC">(GMT 0:0) Coordinated Universal Time (UTC)</option>
                    <option value="Universal">(GMT 0:0) Coordinated Universal Time (Universal)</option>
                    <option value="WET">(GMT 1:0) Western European Summer Time (WET)</option>
                    <option value="Zulu">(GMT 0:0) Coordinated Universal Time (Zulu)</option>
                    <option value="Africa/Algiers">(GMT 1:0) Central European Time (Africa/Algiers)</option>
                    <option value="Africa/Bangui">(GMT 1:0) Western African Time (Africa/Bangui)</option>
                    <option value="Africa/Brazzaville">(GMT 1:0) Western African Time (Africa/Brazzaville)</option>
                    <option value="Africa/Ceuta">(GMT 2:0) Central European Summer Time (Africa/Ceuta)</option>
                    <option value="Africa/Douala">(GMT 1:0) Western African Time (Africa/Douala)</option>
                    <option value="Africa/Kinshasa">(GMT 1:0) Western African Time (Africa/Kinshasa)</option>
                    <option value="Africa/Lagos">(GMT 1:0) Western African Time (Africa/Lagos)</option>
                    <option value="Africa/Libreville">(GMT 1:0) Western African Time (Africa/Libreville)</option>
                    <option value="Africa/Luanda">(GMT 1:0) Western African Time (Africa/Luanda)</option>
                    <option value="Africa/Malabo">(GMT 1:0) Western African Time (Africa/Malabo)</option>
                    <option value="Africa/Ndjamena">(GMT 1:0) Western African Time (Africa/Ndjamena)</option>
                    <option value="Africa/Niamey">(GMT 1:0) Western African Time (Africa/Niamey)</option>
                    <option value="Africa/Porto-Novo">(GMT 1:0) Western African Time (Africa/Porto-Novo)</option>
                    <option value="Africa/Tunis">(GMT 1:0) Central European Time (Africa/Tunis)</option>
                    <option value="Arctic/Longyearbyen">(GMT 2:0) Central European Summer Time (Arctic/Longyearbyen)</option>
                    <option value="Atlantic/Jan_Mayen">(GMT 2:0) Central European Summer Time (Atlantic/Jan_Mayen)</option>
                    <option value="CET">(GMT 2:0) Central European Summer Time (CET)</option>
                    <option value="ECT">(GMT 2:0) Central European Summer Time (ECT)</option>
                    <option value="Etc/GMT-1">(GMT 1:0) GMT+01:00 (Etc/GMT-1)</option>
                    <option value="Europe/Amsterdam">(GMT 2:0) Central European Summer Time (Europe/Amsterdam)</option>
                    <option value="Europe/Andorra">(GMT 2:0) Central European Summer Time (Europe/Andorra)</option>
                    <option value="Europe/Belgrade">(GMT 2:0) Central European Summer Time (Europe/Belgrade)</option>
                    <option value="Europe/Berlin">(GMT 2:0) Central European Summer Time (Europe/Berlin)</option>
                    <option value="Europe/Bratislava">(GMT 2:0) Central European Summer Time (Europe/Bratislava)</option>
                    <option value="Europe/Brussels">(GMT 2:0) Central European Summer Time (Europe/Brussels)</option>
                    <option value="Europe/Budapest">(GMT 2:0) Central European Summer Time (Europe/Budapest)</option>
                    <option value="Europe/Busingen">(GMT 2:0) Central European Summer Time (Europe/Busingen)</option>
                    <option value="Europe/Copenhagen">(GMT 2:0) Central European Summer Time (Europe/Copenhagen)</option>
                    <option value="Europe/Gibraltar">(GMT 2:0) Central European Summer Time (Europe/Gibraltar)</option>
                    <option value="Europe/Ljubljana">(GMT 2:0) Central European Summer Time (Europe/Ljubljana)</option>
                    <option value="Europe/Luxembourg">(GMT 2:0) Central European Summer Time (Europe/Luxembourg)</option>
                    <option value="Europe/Madrid">(GMT 2:0) Central European Summer Time (Europe/Madrid)</option>
                    <option value="Europe/Malta">(GMT 2:0) Central European Summer Time (Europe/Malta)</option>
                    <option value="Europe/Monaco">(GMT 2:0) Central European Summer Time (Europe/Monaco)</option>
                    <option value="Europe/Oslo">(GMT 2:0) Central European Summer Time (Europe/Oslo)</option>
                    <option value="Europe/Paris">(GMT 2:0) Central European Summer Time (Europe/Paris)</option>
                    <option value="Europe/Podgorica">(GMT 2:0) Central European Summer Time (Europe/Podgorica)</option>
                    <option value="Europe/Prague">(GMT 2:0) Central European Summer Time (Europe/Prague)</option>
                    <option value="Europe/Rome">(GMT 2:0) Central European Summer Time (Europe/Rome)</option>
                    <option value="Europe/San_Marino">(GMT 2:0) Central European Summer Time (Europe/San_Marino)</option>
                    <option value="Europe/Sarajevo">(GMT 2:0) Central European Summer Time (Europe/Sarajevo)</option>
                    <option value="Europe/Skopje">(GMT 2:0) Central European Summer Time (Europe/Skopje)</option>
                    <option value="Europe/Stockholm">(GMT 2:0) Central European Summer Time (Europe/Stockholm)</option>
                    <option value="Europe/Tirane">(GMT 2:0) Central European Summer Time (Europe/Tirane)</option>
                    <option value="Europe/Vaduz">(GMT 2:0) Central European Summer Time (Europe/Vaduz)</option>
                    <option value="Europe/Vatican">(GMT 2:0) Central European Summer Time (Europe/Vatican)</option>
                    <option value="Europe/Vienna">(GMT 2:0) Central European Summer Time (Europe/Vienna)</option>
                    <option value="Europe/Warsaw">(GMT 2:0) Central European Summer Time (Europe/Warsaw)</option>
                    <option value="Europe/Zagreb">(GMT 2:0) Central European Summer Time (Europe/Zagreb)</option>
                    <option value="Europe/Zurich">(GMT 2:0) Central European Summer Time (Europe/Zurich)</option>
                    <option value="MET">(GMT 2:0) Middle Europe Summer Time (MET)</option>
                    <option value="Poland">(GMT 2:0) Central European Summer Time (Poland)</option>
                    <option value="ART">(GMT 2:0) Eastern European Time (ART)</option>
                    <option value="Africa/Blantyre">(GMT 2:0) Central African Time (Africa/Blantyre)</option>
                    <option value="Africa/Bujumbura">(GMT 2:0) Central African Time (Africa/Bujumbura)</option>
                    <option value="Africa/Cairo">(GMT 2:0) Eastern European Time (Africa/Cairo)</option>
                    <option value="Africa/Gaborone">(GMT 2:0) Central African Time (Africa/Gaborone)</option>
                    <option value="Africa/Harare">(GMT 2:0) Central African Time (Africa/Harare)</option>
                    <option value="Africa/Johannesburg">(GMT 2:0) South Africa Standard Time (Africa/Johannesburg)</option>
                    <option value="Africa/Khartoum">(GMT 2:0) Central African Time (Africa/Khartoum)</option>
                    <option value="Africa/Kigali">(GMT 2:0) Central African Time (Africa/Kigali)</option>
                    <option value="Africa/Lubumbashi">(GMT 2:0) Central African Time (Africa/Lubumbashi)</option>
                    <option value="Africa/Lusaka">(GMT 2:0) Central African Time (Africa/Lusaka)</option>
                    <option value="Africa/Maputo">(GMT 2:0) Central African Time (Africa/Maputo)</option>
                    <option value="Africa/Maseru">(GMT 2:0) South Africa Standard Time (Africa/Maseru)</option>
                    <option value="Africa/Mbabane">(GMT 2:0) South Africa Standard Time (Africa/Mbabane)</option>
                    <option value="Africa/Tripoli">(GMT 2:0) Eastern European Time (Africa/Tripoli)</option>
                    <option value="Africa/Windhoek">(GMT 2:0) Central African Time (Africa/Windhoek)</option>
                    <option value="Asia/Amman">(GMT 3:0) Eastern European Summer Time (Asia/Amman)</option>
                    <option value="Asia/Beirut">(GMT 3:0) Eastern European Summer Time (Asia/Beirut)</option>
                    <option value="Asia/Damascus">(GMT 3:0) Eastern European Summer Time (Asia/Damascus)</option>
                    <option value="Asia/Famagusta">(GMT 3:0) GMT+03:00 (Asia/Famagusta)</option>
                    <option value="Asia/Gaza">(GMT 3:0) Eastern European Summer Time (Asia/Gaza)</option>
                    <option value="Asia/Hebron">(GMT 3:0) Eastern European Summer Time (Asia/Hebron)</option>
                    <option value="Asia/Jerusalem">(GMT 3:0) Israel Daylight Time (Asia/Jerusalem)</option>
                    <option value="Asia/Nicosia">(GMT 3:0) Eastern European Summer Time (Asia/Nicosia)</option>
                    <option value="Asia/Tel_Aviv">(GMT 3:0) Israel Daylight Time (Asia/Tel_Aviv)</option>
                    <option value="CAT">(GMT 2:0) Central African Time (CAT)</option>
                    <option value="EET">(GMT 3:0) Eastern European Summer Time (EET)</option>
                    <option value="Egypt">(GMT 2:0) Eastern European Time (Egypt)</option>
                    <option value="Etc/GMT-2">(GMT 2:0) GMT+02:00 (Etc/GMT-2)</option>
                    <option value="Europe/Athens">(GMT 3:0) Eastern European Summer Time (Europe/Athens)</option>
                    <option value="Europe/Bucharest">(GMT 3:0) Eastern European Summer Time (Europe/Bucharest)</option>
                    <option value="Europe/Chisinau">(GMT 3:0) Eastern European Summer Time (Europe/Chisinau)</option>
                    <option value="Europe/Helsinki">(GMT 3:0) Eastern European Summer Time (Europe/Helsinki)</option>
                    <option value="Europe/Kaliningrad">(GMT 2:0) Eastern European Time (Europe/Kaliningrad)</option>
                    <option value="Europe/Kiev">(GMT 3:0) Eastern European Summer Time (Europe/Kiev)</option>
                    <option value="Europe/Mariehamn">(GMT 3:0) Eastern European Summer Time (Europe/Mariehamn)</option>
                    <option value="Europe/Nicosia">(GMT 3:0) Eastern European Summer Time (Europe/Nicosia)</option>
                    <option value="Europe/Riga">(GMT 3:0) Eastern European Summer Time (Europe/Riga)</option>
                    <option value="Europe/Sofia">(GMT 3:0) Eastern European Summer Time (Europe/Sofia)</option>
                    <option value="Europe/Tallinn">(GMT 3:0) Eastern European Summer Time (Europe/Tallinn)</option>
                    <option value="Europe/Tiraspol">(GMT 3:0) Eastern European Summer Time (Europe/Tiraspol)</option>
                    <option value="Europe/Uzhgorod">(GMT 3:0) Eastern European Summer Time (Europe/Uzhgorod)</option>
                    <option value="Europe/Vilnius">(GMT 3:0) Eastern European Summer Time (Europe/Vilnius)</option>
                    <option value="Europe/Zaporozhye">(GMT 3:0) Eastern European Summer Time (Europe/Zaporozhye)</option>
                    <option value="Israel">(GMT 3:0) Israel Daylight Time (Israel)</option>
                    <option value="Libya">(GMT 2:0) Eastern European Time (Libya)</option>
                    <option value="Africa/Addis_Ababa">(GMT 3:0) Eastern African Time (Africa/Addis_Ababa)</option>
                    <option value="Africa/Asmara">(GMT 3:0) Eastern African Time (Africa/Asmara)</option>
                    <option value="Africa/Asmera">(GMT 3:0) Eastern African Time (Africa/Asmera)</option>
                    <option value="Africa/Dar_es_Salaam">(GMT 3:0) Eastern African Time (Africa/Dar_es_Salaam)</option>
                    <option value="Africa/Djibouti">(GMT 3:0) Eastern African Time (Africa/Djibouti)</option>
                    <option value="Africa/Juba">(GMT 3:0) Eastern African Time (Africa/Juba)</option>
                    <option value="Africa/Kampala">(GMT 3:0) Eastern African Time (Africa/Kampala)</option>
                    <option value="Africa/Mogadishu">(GMT 3:0) Eastern African Time (Africa/Mogadishu)</option>
                    <option value="Africa/Nairobi">(GMT 3:0) Eastern African Time (Africa/Nairobi)</option>
                    <option value="Antarctica/Syowa">(GMT 3:0) Syowa Time (Antarctica/Syowa)</option>
                    <option value="Asia/Aden">(GMT 3:0) Arabia Standard Time (Asia/Aden)</option>
                    <option value="Asia/Baghdad">(GMT 3:0) Arabia Standard Time (Asia/Baghdad)</option>
                    <option value="Asia/Bahrain">(GMT 3:0) Arabia Standard Time (Asia/Bahrain)</option>
                    <option value="Asia/Istanbul">(GMT 3:0) Turkey Time (Asia/Istanbul)</option>
                    <option value="Asia/Kuwait">(GMT 3:0) Arabia Standard Time (Asia/Kuwait)</option>
                    <option value="Asia/Qatar">(GMT 3:0) Arabia Standard Time (Asia/Qatar)</option>
                    <option value="Asia/Riyadh">(GMT 3:0) Arabia Standard Time (Asia/Riyadh)</option>
                    <option value="EAT">(GMT 3:0) Eastern African Time (EAT)</option>
                    <option value="Etc/GMT-3">(GMT 3:0) GMT+03:00 (Etc/GMT-3)</option>
                    <option value="Europe/Istanbul">(GMT 3:0) Turkey Time (Europe/Istanbul)</option>
                    <option value="Europe/Kirov">(GMT 3:0) GMT+03:00 (Europe/Kirov)</option>
                    <option value="Europe/Minsk">(GMT 3:0) Moscow Standard Time (Europe/Minsk)</option>
                    <option value="Europe/Moscow">(GMT 3:0) Moscow Standard Time (Europe/Moscow)</option>
                    <option value="Europe/Simferopol">(GMT 3:0) Moscow Standard Time (Europe/Simferopol)</option>
                    <option value="Indian/Antananarivo">(GMT 3:0) Eastern African Time (Indian/Antananarivo)</option>
                    <option value="Indian/Comoro">(GMT 3:0) Eastern African Time (Indian/Comoro)</option>
                    <option value="Indian/Mayotte">(GMT 3:0) Eastern African Time (Indian/Mayotte)</option>
                    <option value="Turkey">(GMT 3:0) Turkey Time (Turkey)</option>
                    <option value="W-SU">(GMT 3:0) Moscow Standard Time (W-SU)</option>
                    <option value="Asia/Tehran">(GMT 4:30) Iran Daylight Time (Asia/Tehran)</option>
                    <option value="Iran">(GMT 4:30) Iran Daylight Time (Iran)</option>
                    <option value="Asia/Baku">(GMT 4:0) Azerbaijan Time (Asia/Baku)</option>
                    <option value="Asia/Dubai">(GMT 4:0) Gulf Standard Time (Asia/Dubai)</option>
                    <option value="Asia/Muscat">(GMT 4:0) Gulf Standard Time (Asia/Muscat)</option>
                    <option value="Asia/Tbilisi">(GMT 4:0) Georgia Time (Asia/Tbilisi)</option>
                    <option value="Asia/Yerevan">(GMT 4:0) Armenia Time (Asia/Yerevan)</option>
                    <option value="Etc/GMT-4">(GMT 4:0) GMT+04:00 (Etc/GMT-4)</option>
                    <option value="Europe/Astrakhan">(GMT 4:0) GMT+04:00 (Europe/Astrakhan)</option>
                    <option value="Europe/Samara">(GMT 4:0) Samara Time (Europe/Samara)</option>
                    <option value="Europe/Saratov">(GMT 4:0) GMT+04:00 (Europe/Saratov)</option>
                    <option value="Europe/Ulyanovsk">(GMT 4:0) GMT+04:00 (Europe/Ulyanovsk)</option>
                    <option value="Europe/Volgograd">(GMT 4:0) Moscow Standard Time (Europe/Volgograd)</option>
                    <option value="Indian/Mahe">(GMT 4:0) Seychelles Time (Indian/Mahe)</option>
                    <option value="Indian/Mauritius">(GMT 4:0) Mauritius Time (Indian/Mauritius)</option>
                    <option value="Indian/Reunion">(GMT 4:0) Reunion Time (Indian/Reunion)</option>
                    <option value="NET">(GMT 4:0) Armenia Time (NET)</option>
                    <option value="Asia/Kabul">(GMT 4:30) Afghanistan Time (Asia/Kabul)</option>
                    <option value="Antarctica/Mawson">(GMT 5:0) Mawson Time (Antarctica/Mawson)</option>
                    <option value="Asia/Aqtau">(GMT 5:0) Aqtau Time (Asia/Aqtau)</option>
                    <option value="Asia/Aqtobe">(GMT 5:0) Aqtobe Time (Asia/Aqtobe)</option>
                    <option value="Asia/Ashgabat">(GMT 5:0) Turkmenistan Time (Asia/Ashgabat)</option>
                    <option value="Asia/Ashkhabad">(GMT 5:0) Turkmenistan Time (Asia/Ashkhabad)</option>
                    <option value="Asia/Atyrau">(GMT 5:0) GMT+05:00 (Asia/Atyrau)</option>
                    <option value="Asia/Dushanbe">(GMT 5:0) Tajikistan Time (Asia/Dushanbe)</option>
                    <option value="Asia/Karachi">(GMT 5:0) Pakistan Time (Asia/Karachi)</option>
                    <option value="Asia/Oral">(GMT 5:0) Oral Time (Asia/Oral)</option>
                    <option value="Asia/Qyzylorda">(GMT 5:0) Qyzylorda Time (Asia/Qyzylorda)</option>
                    <option value="Asia/Samarkand">(GMT 5:0) Uzbekistan Time (Asia/Samarkand)</option>
                    <option value="Asia/Tashkent">(GMT 5:0) Uzbekistan Time (Asia/Tashkent)</option>
                    <option value="Asia/Yekaterinburg">(GMT 5:0) Yekaterinburg Time (Asia/Yekaterinburg)</option>
                    <option value="Etc/GMT-5">(GMT 5:0) GMT+05:00 (Etc/GMT-5)</option>
                    <option value="Indian/Kerguelen">(GMT 5:0) French Southern &amp; Antarctic Lands Time (Indian/Kerguelen)</option>
                    <option value="Indian/Maldives">(GMT 5:0) Maldives Time (Indian/Maldives)</option>
                    <option value="PLT">(GMT 5:0) Pakistan Time (PLT)</option>
                    <option class="selectedZone" value="Asia/Calcutta">(GMT 5:30) India Standard Time (Asia/Calcutta)</option>
                    <option value="Asia/Colombo">(GMT 5:30) India Standard Time (Asia/Colombo)</option>
                    <option value="Asia/Kolkata">(GMT 5:30) India Standard Time (Asia/Kolkata)</option>
                    <option value="IST">(GMT 5:30) India Standard Time (IST)</option>
                    <option value="Asia/Kathmandu">(GMT 5:45) Nepal Time (Asia/Kathmandu)</option>
                    <option value="Asia/Katmandu">(GMT 5:45) Nepal Time (Asia/Katmandu)</option>
                    <option value="Antarctica/Vostok">(GMT 6:0) Vostok Time (Antarctica/Vostok)</option>
                    <option value="Asia/Almaty">(GMT 6:0) Alma-Ata Time (Asia/Almaty)</option>
                    <option value="Asia/Bishkek">(GMT 6:0) Kirgizstan Time (Asia/Bishkek)</option>
                    <option value="Asia/Dacca">(GMT 6:0) Bangladesh Time (Asia/Dacca)</option>
                    <option value="Asia/Dhaka">(GMT 6:0) Bangladesh Time (Asia/Dhaka)</option>
                    <option value="Asia/Kashgar">(GMT 6:0) Xinjiang Standard Time (Asia/Kashgar)</option>
                    <option value="Asia/Omsk">(GMT 6:0) Omsk Time (Asia/Omsk)</option>
                    <option value="Asia/Qostanay">(GMT 6:0) Kostanay Standard Time (Asia/Qostanay)</option>
                    <option value="Asia/Thimbu">(GMT 6:0) Bhutan Time (Asia/Thimbu)</option>
                    <option value="Asia/Thimphu">(GMT 6:0) Bhutan Time (Asia/Thimphu)</option>
                    <option value="Asia/Urumqi">(GMT 6:0) Xinjiang Standard Time (Asia/Urumqi)</option>
                    <option value="BST">(GMT 6:0) Bangladesh Time (BST)</option>
                    <option value="Etc/GMT-6">(GMT 6:0) GMT+06:00 (Etc/GMT-6)</option>
                    <option value="Indian/Chagos">(GMT 6:0) Indian Ocean Territory Time (Indian/Chagos)</option>
                    <option value="Asia/Rangoon">(GMT 6:30) Myanmar Time (Asia/Rangoon)</option>
                    <option value="Asia/Yangon">(GMT 6:30) Myanmar Time (Asia/Yangon)</option>
                    <option value="Indian/Cocos">(GMT 6:30) Cocos Islands Time (Indian/Cocos)</option>
                    <option value="Antarctica/Davis">(GMT 7:0) Davis Time (Antarctica/Davis)</option>
                    <option value="Asia/Bangkok">(GMT 7:0) Indochina Time (Asia/Bangkok)</option>
                    <option value="Asia/Barnaul">(GMT 7:0) GMT+07:00 (Asia/Barnaul)</option>
                    <option value="Asia/Ho_Chi_Minh">(GMT 7:0) Indochina Time (Asia/Ho_Chi_Minh)</option>
                    <option value="Asia/Hovd">(GMT 7:0) Hovd Time (Asia/Hovd)</option>
                    <option value="Asia/Jakarta">(GMT 7:0) West Indonesia Time (Asia/Jakarta)</option>
                    <option value="Asia/Krasnoyarsk">(GMT 7:0) Krasnoyarsk Time (Asia/Krasnoyarsk)</option>
                    <option value="Asia/Novokuznetsk">(GMT 7:0) Krasnoyarsk Time (Asia/Novokuznetsk)</option>
                    <option value="Asia/Novosibirsk">(GMT 7:0) Novosibirsk Time (Asia/Novosibirsk)</option>
                    <option value="Asia/Phnom_Penh">(GMT 7:0) Indochina Time (Asia/Phnom_Penh)</option>
                    <option value="Asia/Pontianak">(GMT 7:0) West Indonesia Time (Asia/Pontianak)</option>
                    <option value="Asia/Saigon">(GMT 7:0) Indochina Time (Asia/Saigon)</option>
                    <option value="Asia/Tomsk">(GMT 7:0) GMT+07:00 (Asia/Tomsk)</option>
                    <option value="Asia/Vientiane">(GMT 7:0) Indochina Time (Asia/Vientiane)</option>
                    <option value="Etc/GMT-7">(GMT 7:0) GMT+07:00 (Etc/GMT-7)</option>
                    <option value="Indian/Christmas">(GMT 7:0) Christmas Island Time (Indian/Christmas)</option>
                    <option value="VST">(GMT 7:0) Indochina Time (VST)</option>
                    <option value="Antarctica/Casey">(GMT 8:0) Australian Western Standard Time (Antarctica/Casey)</option>
                    <option value="Asia/Brunei">(GMT 8:0) Brunei Time (Asia/Brunei)</option>
                    <option value="Asia/Choibalsan">(GMT 8:0) Choibalsan Time (Asia/Choibalsan)</option>
                    <option value="Asia/Chongqing">(GMT 8:0) China Standard Time (Asia/Chongqing)</option>
                    <option value="Asia/Chungking">(GMT 8:0) China Standard Time (Asia/Chungking)</option>
                    <option value="Asia/Harbin">(GMT 8:0) China Standard Time (Asia/Harbin)</option>
                    <option value="Asia/Hong_Kong">(GMT 8:0) Hong Kong Time (Asia/Hong_Kong)</option>
                    <option value="Asia/Irkutsk">(GMT 8:0) Irkutsk Time (Asia/Irkutsk)</option>
                    <option value="Asia/Kuala_Lumpur">(GMT 8:0) Malaysia Time (Asia/Kuala_Lumpur)</option>
                    <option value="Asia/Kuching">(GMT 8:0) Malaysia Time (Asia/Kuching)</option>
                    <option value="Asia/Macao">(GMT 8:0) China Standard Time (Asia/Macao)</option>
                    <option value="Asia/Macau">(GMT 8:0) China Standard Time (Asia/Macau)</option>
                    <option value="Asia/Makassar">(GMT 8:0) Central Indonesia Time (Asia/Makassar)</option>
                    <option value="Asia/Manila">(GMT 8:0) Philippines Standard Time (Asia/Manila)</option>
                    <option value="Asia/Shanghai">(GMT 8:0) China Standard Time (Asia/Shanghai)</option>
                    <option value="Asia/Singapore">(GMT 8:0) Singapore Time (Asia/Singapore)</option>
                    <option value="Asia/Taipei">(GMT 8:0) China Standard Time (Asia/Taipei)</option>
                    <option value="Asia/Ujung_Pandang">(GMT 8:0) Central Indonesia Time (Asia/Ujung_Pandang)</option>
                    <option value="Asia/Ulaanbaatar">(GMT 8:0) Ulaanbaatar Time (Asia/Ulaanbaatar)</option>
                    <option value="Asia/Ulan_Bator">(GMT 8:0) Ulaanbaatar Time (Asia/Ulan_Bator)</option>
                    <option value="Australia/Perth">(GMT 8:0) Australian Western Standard Time (Australia/Perth)</option>
                    <option value="Australia/West">(GMT 8:0) Australian Western Standard Time (Australia/West)</option>
                    <option value="CTT">(GMT 8:0) China Standard Time (CTT)</option>
                    <option value="Etc/GMT-8">(GMT 8:0) GMT+08:00 (Etc/GMT-8)</option>
                    <option value="Hongkong">(GMT 8:0) Hong Kong Time (Hongkong)</option>
                    <option value="PRC">(GMT 8:0) China Standard Time (PRC)</option>
                    <option value="Singapore">(GMT 8:0) Singapore Time (Singapore)</option>
                    <option value="Australia/Eucla">(GMT 8:45) Australian Central Western Standard Time (Australia/Eucla)</option>
                    <option value="Asia/Chita">(GMT 9:0) Yakutsk Time (Asia/Chita)</option>
                    <option value="Asia/Dili">(GMT 9:0) Timor-Leste Time (Asia/Dili)</option>
                    <option value="Asia/Jayapura">(GMT 9:0) East Indonesia Time (Asia/Jayapura)</option>
                    <option value="Asia/Khandyga">(GMT 9:0) Yakutsk Time (Asia/Khandyga)</option>
                    <option value="Asia/Pyongyang">(GMT 9:0) Korea Standard Time (Asia/Pyongyang)</option>
                    <option value="Asia/Seoul">(GMT 9:0) Korea Standard Time (Asia/Seoul)</option>
                    <option value="Asia/Tokyo">(GMT 9:0) Japan Standard Time (Asia/Tokyo)</option>
                    <option value="Asia/Yakutsk">(GMT 9:0) Yakutsk Time (Asia/Yakutsk)</option>
                    <option value="Etc/GMT-9">(GMT 9:0) GMT+09:00 (Etc/GMT-9)</option>
                    <option value="JST">(GMT 9:0) Japan Standard Time (JST)</option>
                    <option value="Japan">(GMT 9:0) Japan Standard Time (Japan)</option>
                    <option value="Pacific/Palau">(GMT 9:0) Palau Time (Pacific/Palau)</option>
                    <option value="ROK">(GMT 9:0) Korea Standard Time (ROK)</option>
                    <option value="ACT">(GMT 9:30) Australian Central Standard Time (Northern Territory) (ACT)</option>
                    <option value="Australia/Adelaide">(GMT 9:30) Australian Central Standard Time (South Australia) (Australia/Adelaide)</option>
                    <option value="Australia/Broken_Hill">(GMT 9:30) Australian Central Standard Time (South Australia/New South Wales) (Australia/Broken_Hill)</option>
                    <option value="Australia/Darwin">(GMT 9:30) Australian Central Standard Time (Northern Territory) (Australia/Darwin)</option>
                    <option value="Australia/North">(GMT 9:30) Australian Central Standard Time (Northern Territory) (Australia/North)</option>
                    <option value="Australia/South">(GMT 9:30) Australian Central Standard Time (South Australia) (Australia/South)</option>
                    <option value="Australia/Yancowinna">(GMT 9:30) Australian Central Standard Time (South Australia/New South Wales) (Australia/Yancowinna)</option>
                    <option value="AET">(GMT 10:0) Australian Eastern Standard Time (New South Wales) (AET)</option>
                    <option value="Antarctica/DumontDUrville">(GMT 10:0) Dumont-d'Urville Time (Antarctica/DumontDUrville)</option>
                    <option value="Asia/Ust-Nera">(GMT 10:0) Ust-Nera Time (Asia/Ust-Nera)</option>
                    <option value="Asia/Vladivostok">(GMT 10:0) Vladivostok Time (Asia/Vladivostok)</option>
                    <option value="Australia/ACT">(GMT 10:0) Australian Eastern Standard Time (New South Wales) (Australia/ACT)</option>
                    <option value="Australia/Brisbane">(GMT 10:0) Australian Eastern Standard Time (Queensland) (Australia/Brisbane)</option>
                    <option value="Australia/Canberra">(GMT 10:0) Australian Eastern Standard Time (New South Wales) (Australia/Canberra)</option>
                    <option value="Australia/Currie">(GMT 10:0) Australian Eastern Standard Time (New South Wales) (Australia/Currie)</option>
                    <option value="Australia/Hobart">(GMT 10:0) Australian Eastern Standard Time (Tasmania) (Australia/Hobart)</option>
                    <option value="Australia/Lindeman">(GMT 10:0) Australian Eastern Standard Time (Queensland) (Australia/Lindeman)</option>
                    <option value="Australia/Melbourne">(GMT 10:0) Australian Eastern Standard Time (Victoria) (Australia/Melbourne)</option>
                    <option value="Australia/NSW">(GMT 10:0) Australian Eastern Standard Time (New South Wales) (Australia/NSW)</option>
                    <option value="Australia/Queensland">(GMT 10:0) Australian Eastern Standard Time (Queensland) (Australia/Queensland)</option>
                    <option value="Australia/Sydney">(GMT 10:0) Australian Eastern Standard Time (New South Wales) (Australia/Sydney)</option>
                    <option value="Australia/Tasmania">(GMT 10:0) Australian Eastern Standard Time (Tasmania) (Australia/Tasmania)</option>
                    <option value="Australia/Victoria">(GMT 10:0) Australian Eastern Standard Time (Victoria) (Australia/Victoria)</option>
                    <option value="Etc/GMT-10">(GMT 10:0) GMT+10:00 (Etc/GMT-10)</option>
                    <option value="Pacific/Chuuk">(GMT 10:0) Chuuk Time (Pacific/Chuuk)</option>
                    <option value="Pacific/Guam">(GMT 10:0) Chamorro Standard Time (Pacific/Guam)</option>
                    <option value="Pacific/Port_Moresby">(GMT 10:0) Papua New Guinea Time (Pacific/Port_Moresby)</option>
                    <option value="Pacific/Saipan">(GMT 10:0) Chamorro Standard Time (Pacific/Saipan)</option>
                    <option value="Pacific/Truk">(GMT 10:0) Chuuk Time (Pacific/Truk)</option>
                    <option value="Pacific/Yap">(GMT 10:0) Chuuk Time (Pacific/Yap)</option>
                    <option value="Australia/LHI">(GMT 10:30) Lord Howe Standard Time (Australia/LHI)</option>
                    <option value="Australia/Lord_Howe">(GMT 10:30) Lord Howe Standard Time (Australia/Lord_Howe)</option>
                    <option value="Antarctica/Macquarie">(GMT 11:0) Macquarie Island Standard Time (Antarctica/Macquarie)</option>
                    <option value="Asia/Magadan">(GMT 11:0) Magadan Time (Asia/Magadan)</option>
                    <option value="Asia/Sakhalin">(GMT 11:0) Sakhalin Time (Asia/Sakhalin)</option>
                    <option value="Asia/Srednekolymsk">(GMT 11:0) Srednekolymsk Time (Asia/Srednekolymsk)</option>
                    <option value="Etc/GMT-11">(GMT 11:0) GMT+11:00 (Etc/GMT-11)</option>
                    <option value="Pacific/Bougainville">(GMT 11:0) Bougainville Standard Time (Pacific/Bougainville)</option>
                    <option value="Pacific/Efate">(GMT 11:0) Vanuatu Time (Pacific/Efate)</option>
                    <option value="Pacific/Guadalcanal">(GMT 11:0) Solomon Is. Time (Pacific/Guadalcanal)</option>
                    <option value="Pacific/Kosrae">(GMT 11:0) Kosrae Time (Pacific/Kosrae)</option>
                    <option value="Pacific/Norfolk">(GMT 11:0) Norfolk Time (Pacific/Norfolk)</option>
                    <option value="Pacific/Noumea">(GMT 11:0) New Caledonia Time (Pacific/Noumea)</option>
                    <option value="Pacific/Pohnpei">(GMT 11:0) Pohnpei Time (Pacific/Pohnpei)</option>
                    <option value="Pacific/Ponape">(GMT 11:0) Pohnpei Time (Pacific/Ponape)</option>
                    <option value="SST">(GMT 11:0) Solomon Is. Time (SST)</option>
                    <option value="Antarctica/McMurdo">(GMT 12:0) New Zealand Standard Time (Antarctica/McMurdo)</option>
                    <option value="Antarctica/South_Pole">(GMT 12:0) New Zealand Standard Time (Antarctica/South_Pole)</option>
                    <option value="Asia/Anadyr">(GMT 12:0) Anadyr Time (Asia/Anadyr)</option>
                    <option value="Asia/Kamchatka">(GMT 12:0) Petropavlovsk-Kamchatski Time (Asia/Kamchatka)</option>
                    <option value="Etc/GMT-12">(GMT 12:0) GMT+12:00 (Etc/GMT-12)</option>
                    <option value="Kwajalein">(GMT 12:0) Marshall Islands Time (Kwajalein)</option>
                    <option value="NST">(GMT 12:0) New Zealand Standard Time (NST)</option>
                    <option value="NZ">(GMT 12:0) New Zealand Standard Time (NZ)</option>
                    <option value="Pacific/Auckland">(GMT 12:0) New Zealand Standard Time (Pacific/Auckland)</option>
                    <option value="Pacific/Fiji">(GMT 12:0) Fiji Time (Pacific/Fiji)</option>
                    <option value="Pacific/Funafuti">(GMT 12:0) Tuvalu Time (Pacific/Funafuti)</option>
                    <option value="Pacific/Kwajalein">(GMT 12:0) Marshall Islands Time (Pacific/Kwajalein)</option>
                    <option value="Pacific/Majuro">(GMT 12:0) Marshall Islands Time (Pacific/Majuro)</option>
                    <option value="Pacific/Nauru">(GMT 12:0) Nauru Time (Pacific/Nauru)</option>
                    <option value="Pacific/Tarawa">(GMT 12:0) Gilbert Is. Time (Pacific/Tarawa)</option>
                    <option value="Pacific/Wake">(GMT 12:0) Wake Time (Pacific/Wake)</option>
                    <option value="Pacific/Wallis">(GMT 12:0) Wallis &amp; Futuna Time (Pacific/Wallis)</option>
                    <option value="NZ-CHAT">(GMT 12:45) Chatham Standard Time (NZ-CHAT)</option>
                    <option value="Pacific/Chatham">(GMT 12:45) Chatham Standard Time (Pacific/Chatham)</option>
                    <option value="Etc/GMT-13">(GMT 13:0) GMT+13:00 (Etc/GMT-13)</option>
                    <option value="MIT">(GMT 13:0) West Samoa Standard Time (MIT)</option>
                    <option value="Pacific/Apia">(GMT 13:0) West Samoa Standard Time (Pacific/Apia)</option>
                    <option value="Pacific/Enderbury">(GMT 13:0) Phoenix Is. Time (Pacific/Enderbury)</option>
                    <option value="Pacific/Fakaofo">(GMT 13:0) Tokelau Time (Pacific/Fakaofo)</option>
                    <option value="Pacific/Tongatapu">(GMT 13:0) Tonga Time (Pacific/Tongatapu)</option>
                    <option value="Etc/GMT-14">(GMT 14:0) GMT+14:00 (Etc/GMT-14)</option>
                    <option value="Pacific/Kiritimati">(GMT 14:0) Line Is. Time (Pacific/Kiritimati)</option>
                </select>
            </div>
            <div class="form-group register-password-group">
                <label class="control-label" for="password"><?php echo _l('clients_register_password'); ?></label>
                <input type="password" class="form-control" name="password" id="password">
                <?php echo form_error('password'); ?>
            </div>
            <div class="form-group register-password-repeat-group">
                <label class="control-label" for="passwordr"><?php echo _l('clients_register_password_repeat'); ?></label>
                <input type="password" class="form-control" name="passwordr" id="passwordr">
                <?php echo form_error('passwordr'); ?>
            </div>
            <!--
                <div class="col-md-6">
                    <h4 class="bold register-contact-info-heading"><?php echo _l('client_register_contact_info'); ?></h4>
                    <div class="form-group mtop15 register-firstname-group">
                        <label class="control-label" for="firstname"><?php echo _l('clients_firstname'); ?></label>
                        <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo set_value('firstname'); ?>">
                        <?php echo form_error('firstname'); ?>
                    </div>
                    <div class="form-group register-lastname-group">
                        <label class="control-label" for="lastname"><?php echo _l('clients_lastname'); ?></label>
                        <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo set_value('lastname'); ?>">
                        <?php echo form_error('lastname'); ?>
                    </div>
                    <div class="form-group register-email-group">
                        <label class="control-label" for="email"><?php echo _l('clients_email'); ?></label>
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo set_value('email'); ?>">
                        <?php echo form_error('email'); ?>
                    </div>
                    <div class="form-group register-contact-phone-group">
                        <label class="control-label" for="contact_phonenumber"><?php echo _l('clients_phone'); ?></label>
                        <input type="text" class="form-control" name="contact_phonenumber" id="contact_phonenumber" value="<?php echo set_value('contact_phonenumber'); ?>">
                    </div>
                    <div class="form-group register-website-group">
                        <label class="control-label" for="website"><?php echo _l('client_website'); ?></label>
                        <input type="text" class="form-control" name="website" id="website" value="<?php echo set_value('website'); ?>">
                    </div>
                    <div class="form-group register-position-group">
                        <label class="control-label" for="title"><?php echo _l('contact_position'); ?></label>
                        <input type="text" class="form-control" name="title" id="title" value="<?php echo set_value('title'); ?>">
                    </div>
                    <div class="form-group register-password-group">
                        <label class="control-label" for="password"><?php echo _l('clients_register_password'); ?></label>
                        <input type="password" class="form-control" name="password" id="password">
                        <?php echo form_error('password'); ?>
                    </div>
                    <div class="form-group register-password-repeat-group">
                        <label class="control-label" for="passwordr"><?php echo _l('clients_register_password_repeat'); ?></label>
                        <input type="password" class="form-control" name="passwordr" id="passwordr">
                        <?php echo form_error('passwordr'); ?>
                    </div>
                    <div class="register-contact-custom-fields">
                        <?php echo render_custom_fields( 'contacts','',array('show_on_client_portal'=>1)); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="bold register-company-info-heading"><?php echo _l('client_register_company_info'); ?></h4>
                    <div class="form-group mtop15 register-company-group">
                        <label class="control-label" for="company"><?php echo _l('clients_company'); ?></label>
                        <input type="text" class="form-control" name="company" id="company" value="<?php echo set_value('company'); ?>">
                        <?php echo form_error('company'); ?>
                    </div>
                    <?php if(get_option('company_requires_vat_number_field') == 1){ ?>
                    <div class="form-group register-vat-group">
                        <label class="control-label" for="vat"><?php echo _l('clients_vat'); ?></label>
                        <input type="text" class="form-control" name="vat" id="vat" value="<?php echo set_value('vat'); ?>">
                    </div>
                    <?php } ?>
                    <div class="form-group register-company-phone-group">
                        <label class="control-label" for="phonenumber"><?php echo _l('clients_phone'); ?></label>
                        <input type="text" class="form-control" name="phonenumber" id="phonenumber" value="<?php echo set_value('phonenumber'); ?>">
                    </div>
                    <div class="form-group register-country-group">
                        <label class="control-label" for="lastname"><?php echo _l('clients_country'); ?></label>
                        <select data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>" data-live-search="true" name="country" class="form-control" id="country">
                            <option value=""></option>
                            <?php foreach(get_all_countries() as $country){ ?>
                            <option value="<?php echo $country['country_id']; ?>"<?php if(get_option('customer_default_country') == $country['country_id']){echo ' selected';} ?> <?php echo set_select('country', $country['country_id']); ?>><?php echo $country['short_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group register-city-group">
                        <label class="control-label" for="city"><?php echo _l('clients_city'); ?></label>
                        <input type="text" class="form-control" name="city" id="city" value="<?php echo set_value('city'); ?>">
                    </div>
                    <div class="form-group register-address-group">
                        <label class="control-label" for="address"><?php echo _l('clients_address'); ?></label>
                        <input type="text" class="form-control" name="address" id="address" value="<?php echo set_value('address'); ?>">
                    </div>
                    <div class="form-group register-zip-group">
                        <label class="control-label" for="zip"><?php echo _l('clients_zip'); ?></label>
                        <input type="text" class="form-control" name="zip" id="zip" value="<?php echo set_value('zip'); ?>">
                    </div>
                    <div class="form-group register-state-group">
                        <label class="control-label" for="state"><?php echo _l('clients_state'); ?></label>
                        <input type="text" class="form-control" name="state" id="state" value="<?php echo set_value('state'); ?>">
                    </div>
                    <div class="register-company-custom-fields">
                        <?php echo render_custom_fields( 'customers','',array('show_on_client_portal'=>1)); ?>
                    </div>
                </div>
                -->
            <div class="row">
                <div class="col-md-12 register-terms-and-conditions-wrapper">
                    <div class="text-center">
                       <div class="checkbox">
                        <input type="checkbox" required name="accept_terms_and_conditions" id="accept_terms_and_conditions" <?php echo set_checkbox('accept_terms_and_conditions', 'on'); ?>>
                        <label for="accept_terms_and_conditions">
                            <?php echo _l('gdpr_terms_agree', terms_url()); ?>
                        </label>
                    </div>
                    <?php echo form_error('accept_terms_and_conditions'); ?>
                </div>
            </div>
                <?php if (is_gdpr() && get_option('gdpr_enable_terms_and_conditions') == 1) { ?>
                <div class="col-md-12 register-terms-and-conditions-wrapper">
                    <div class="text-center">
                       <div class="checkbox">
                        <input type="checkbox" name="accept_terms_and_conditions" id="accept_terms_and_conditions" <?php echo set_checkbox('accept_terms_and_conditions', 'on'); ?>>
                        <label for="accept_terms_and_conditions">
                            <?php echo _l('gdpr_terms_agree', terms_url()); ?>
                        </label>
                    </div>
                    <?php echo form_error('accept_terms_and_conditions'); ?>
                </div>
            </div>
            <?php } ?>
            <?php if(get_option('use_recaptcha_customers_area') == 1 && get_option('recaptcha_secret_key') != '' && get_option('recaptcha_site_key') != ''){ ?>
            <div class="col-md-12 register-recaptcha">
               <div class="g-recaptcha" data-sitekey="<?php echo get_option('recaptcha_site_key'); ?>"></div>
               <?php echo form_error('g-recaptcha-response'); ?>
           </div>
           <?php } ?>
        </div>
        <div class="form-group text-center">
            <button type="submit" autocomplete="off" data-loading-text="<?php echo _l('wait_text'); ?>" class="btn btn-info"><?php echo _l('clients_register_string'); ?></button>
        </div>
        <div class="form-group text-center">
            <a href="<?= base_url('authentication/login'); ?>">Back to login</a>
        </div>
   </div>
</div>
<div class="row hide">
    <div class="col-md-12 text-center">
        <div class="form-group">
            <button type="submit" autocomplete="off" data-loading-text="<?php echo _l('wait_text'); ?>" class="btn btn-info"><?php echo _l('clients_register_string'); ?></button>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
</div>
