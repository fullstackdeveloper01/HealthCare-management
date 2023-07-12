<!DOCTYPE html>

<head>

<?php 
$facebook_url = 'javascript:void(0);';
$twitter_url = 'javascript:void(0);';
$instagram_url = 'javascript:void(0);';

 ?>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Emailer</title>
<style type="text/css">
body {
	margin: 0;
	padding: 0;
	background-color:#EDEDED;
	font-size:13px;
	color:#444;
	font-family:Arial, Helvetica, sans-serif;
	padding-top:75px;
}
table, tr, td, th {
	margin: 0;
	padding: 0;
}
img {
	border: none;
}
a {
	text-decoration: none; cursor:pointer !important;	
}
table[class="outer-tbl"] {
	width:768px !important;
	margin:0px auto !important;
	
}
p {

	padding:0;
}
img[class="main-image"] {width:100% !important; }
div[class="foot-items"]{padding:0 190px;}
table[class="full-wid"] {width:100%;}
a[class="hide"]{display:inline;}

 @media only screen and (max-width:767px) {
body {padding:0; }
a[class="hide"]{display:none !important;}
table[class="outer-tbl"] {width:320px !important; margin-top:0 !important; margin-bottom:0 !important;}
div[class="foot-items"]{max-width:290px}
td[class="logo"] {padding:20px 0  !important;}
td[class="text"] {padding:5px 0 2px 0 !important;}
td[class="footer"] {padding:15px 0 !important;}
td[class="botm"] {padding:0 0 15px 0 !important;}
td[class="less-wid"]{ font-family:Arial, Helvetica, sans-serif; font-size:13px;padding:10px !important;}
td[class="pad-top"] {padding-top:10px !important;}
p {margin-top:10px !important;}
p[class="rdlinht"] {line-height:15px !important;}
p[class="cnteimg"] {margin:20px 0 0 0!important; }
img[class="main-image"] {width:100% !important; margin:0; padding:0; }
p[class="pre"]{padding:0 10px !important;}
td[class="pad-l-r-b"]{padding:0 15px 30px !important;}
td[class="pad-l-r"]{padding:0 !important;}
td[class="content"]{padding:20px 20px !important;}
div[class="foot-items"]{padding:0 10px;}
}
</style>
</head>

<body style="margin: 0;	padding: 0; background-color:#EDEDED; font-size:13px; color:#444; font-family:Arial, Helvetica, sans-serif;	padding-top:70px; padding-bottom:70px;">
<table  cellspacing="0" cellpadding="0" align="center" width="768" class="outer-tbl" style="margin:0 auto;">
  <tr>
    <td class="pad-l-r-b" style="background-color:#312E2D; padding:0 70px 40px;">
		  <table cellpadding="0" cellspacing="0" class="full-wid">
              <tr>
           <td style="padding:20px 0; text-align:right; font-family:Arial, Helvetica, sans-serif;" align="right"></td>
        </tr> 
      </table>
			<table cellpadding="0" cellspacing="0"  style="width:100%; background-color:#FFFFFF; border-radius:4px;">
        <tr>
          <td>
					  <table border="0" style="margin:0; width:100%" cellpadding="0" cellspacing="0">
              <tr>
                <td class="logo" style="padding:40px 0 30px 0; text-align:center; border-bottom:1px solid #E1E1E1">
								 <img src="<?php echo base_url(); ?>uploads/loginPage/logo_1600079504.png" height="50px"  alt="<?php echo SYSTEM_NAME; ?>" title="<?php echo SYSTEM_NAME; ?>"/>
								 <h2 style="font-family:Arial, Helvetica, sans-serif; font-size:25px; color:#333333; margin-top:10px;letter-spacing:1px;">Welcome To <?php echo SYSTEM_NAME; ?></h2>
								</td>
              </tr>
							<tr>
                <td class="content" style="padding:40px 40px;">
								  <p style="font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#333333; margin-top:10px;">Hello</p>
								  
									<p style="font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#333333; margin-top:0">Welcome to <?php echo SYSTEM_NAME; ?>! </p>
									<?= $msg; ?>
									
									<p style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#333333; margin-top:30px">Thanks for your time,</p>
									
									<p style="font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#333333; margin-top:40px; margin-bottom:0;">Best Regards</p>
									<p style="font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#333333; font-weight:600; margin-top:5px"><?php echo SYSTEM_NAME; ?> Team</p>
								</td>
              </tr>
            </table>
					</td>
        </tr>        
      </table>
		</td>
  </tr>  
   <tr>  
    <td  style="background-color:#453F3C; padding-bottom:60px;">
       <table border="0" cellspacing="0" cellpadding="0" class="full-wid" align="center" style="margin:0 auto; text-align:center;">
       
			 <tr>
				<td>				  
					 <div style="margin:0 auto; text-align:center;" class="foot-items">
					   <p style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#FFFFFF; margin-top:40px; line-height:20px;">
						  &#169; <?php echo date('Y')?> <?php echo SYSTEM_NAME; ?>  |  All right Reserved
						 </p>
					 </div>
				</td>
			 </tr>
     </table>
	 </td>
  </tr>
</table>
</body>
</html>
</body>
</html>