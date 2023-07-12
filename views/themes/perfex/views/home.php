<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .wrapper{
  position:absolute;
  top:50%;
  left:50%;
  transform:translate(-50%, -50%); 
}
.circle{
  display: inline-block;
  width: 15px;
  height: 15px;
  background-color: #fcdc29;
  border-radius: 50%;
  animation: loading 1.5s cubic-bezier(.8, .5, .2, 1.4) infinite;
  transform-origin: bottom center;
  position: relative;
}
@keyframes loading{
  0%{
    transform: translateY(0px);
    background-color: #fcdc29;
  }
  50%{
    transform: translateY(50px);
    background-color: #ef584a;
  }
  100%{
    transform: translateY(0px);
    background-color: #fcdc29;
  }
}
.circle-1{
  animation-delay: 0.1s;
}
.circle-2{
  animation-delay: 0.2s;
}
.circle-3{
  animation-delay: 0.3s;
}
.circle-4{
  animation-delay: 0.4s;
}
.circle-5{
  animation-delay: 0.5s;
}
.circle-6{
  animation-delay: 0.6s;
}
.circle-7{
  animation-delay: 0.7s;
}
.circle-8{
  animation-delay: 0.8s;
}
.border-right {
    border-right: 1px solid #f0f0f0;
}
</style>    
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css"/>
<!-- <script href="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script href="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
 -->
	<div class="hero-banner creative-banner" id="home">
        <div id="particles-js"></div>
        <div class="hero-text ">
            <div class="container">
 

                <div class="row ">
                    <div class="home-user">
                        <div class="student-img" style="background: <?php printf( "#%06X\n", mt_rand( 0, 0xFFFFFF )); ?>;" >
                            <?php
                            $clodata = $this->db->get_where(db_prefix().'contacts', array('userid' => get_client_user_id()))->row();
                            // print_r(get_client_user_id()); die;
                                    if(get_client_user_id())
                                    {
                                        $filename = $this->db->order_by('id','DESC')->get_where(db_prefix().'files', array('rel_id' => get_client_user_id(), 'rel_type' => 'profile_image'))->row('file_name');

                                        
                                        if($filename!=''){
                                        ?>
                                        <a href="javascript:void(0)">
                                          <img src="<?= base_url('uploads/profile_image/'.get_client_user_id().'/'.$filename); ?>"  onerror="this.onerror=null;this.src='<?php echo base_url(); ?>assets/images/user.png';">
                                          </a>
                                        <?php 
                                    }else{
                                        ?>
                                          <a  href="javascript:void(0)" class="text-white"><?= ucfirst(substr($clodata->firstname,0,1)).''.ucfirst(substr($clodata->lastname, 0, 1))?></a>
                                        <?php 

                                    }
                                    }
                               ?>

                        </div>


                        <h1 class="hero-title text-center no-mtop text-uppercase" id="greeting">GOOD MORNING <span class="text-uppercase">Account</span> !</h1>

                    <div class="text-center text-white" data-widget="dateTime">
                        <div class="widget-body font-14">
                            <time data-time="date"><?php echo date("l"); ?>, <?php echo date('M d, Y'); ?></time>
                            <time data-time="time" class="hdclock">12:57:39 PM</time>
                            
                    </div>
                </div>

                <div class="main-banner-icon text-white text-center">
                    <div class="row d-flex justify-content-center flex-wrap">
                        <div class="col-md-3">
                            <div class="banner-icons">
                                <a href="javascript:void(0)" data-toggle="modal" onClick="getCLOClients()" data-target="#studentlistmodel">
                                    <div class="img-icon">
                                        <img src="assets/images/clients.svg" alt="">
                                    </div>
                                    <h4 class="text-white uppercase fz-18">Clients </h4>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="banner-icons">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#stafflistmodel">
                                    <div class="img-icon">
                                        <img src="assets/images/staff.svg" alt="">
                                    </div>
                                    <h4 class="text-white uppercase fz-18">Staff </h4>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="banner-icons">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#reportlistmodel">
                                    <div class="img-icon">
                                        <img src="assets/images/report.svg" alt="">
                                    </div>
                                    <h4 class="text-white uppercase fz-18">Report </h4>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="banner-icons">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#supportlistmodel" >
                                    <div class="img-icon">
                                        <img src="assets/images/support.svg" alt="">
                                    </div>
                                    <h4 class="text-white uppercase fz-18">Support </h4>
                                </a>
                            </div>
                        </div>

                        <!-- <div class="col-md-3">
                            <div class="banner-icons">
                                <a href="<?php //echo site_url('clients/tickets'); ?>" >
                                    <div class="img-icon">
                                        <img src="assets/images/support.svg" alt="">
                                    </div>
                                    <h4>Support </h4>
                                </a>
                            </div>
                        </div> -->



                    </div>
                    <!-- row end -->

                    <div class="row d-flex justify-content-center">
                        <div class="col-md-3">
                            <div class="banner-icons">
                                <a href="javascript:void(0)" data-toggle="modal" data-toggle="modal" data-target="#newslistmodel">
                                    <div class="img-icon">
                                        <img src="assets/images/news.svg" alt="">
                                    </div>
                                    <h4 class="text-white uppercase fz-18">Health News</h4>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="banner-icons">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#tipslistmodel">
                                    <div class="img-icon">
                                        <img src="assets/images/tips.svg" alt="">
                                    </div>
                                    <h4 class="text-white uppercase fz-18">Tips </h4>
                                </a>
                            </div>
                        </div>
                        <?php
                          if(get_user_id_role()==4)
                          {
                        ?>
                        <div class="col-md-3">
                            <div class="banner-icons">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#traninglistmodel"  onclick="getTraning();" >
                                    <div class="img-icon">
                                        <img src="assets/images/tips.svg" alt="">
                                    </div>
                                    <h4 class="text-white uppercase fz-18">Upcoming Training </h4>
                                </a>
                            </div>
                        </div>

                        <?php
                          }
                        ?>
                        <!-- <div class="col-md-3">
                            <div class="banner-icons">
                                <a href="<?php echo site_url('incident'); ?>" >
                                    <div class="img-icon">
                                        <img src="assets/images/tips.svg" alt="">
                                    </div>
                                    <h4>Incident </h4>
                                </a>
                            </div>
                        </div> -->
                        
                        <div class="col-md-3">
                            <div class="banner-icons">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#Incidentlistmodel"">
                                    <div class="img-icon">
                                        <img src="assets/images/tips.svg" alt="">
                                    </div>
                                    <h4 class="text-white uppercase fz-18">Incident </h4>
                                </a>
                            </div>
                        </div>
                        <?php
                        if(get_user_id_role()==3)
                        {
                        ?>
                        <div class="col-md-3">
                            <div class="banner-icons">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#policylistmodel" onclick="getPolicy();">
                                    <div class="img-icon">
                                        <img src="assets/images/tips.svg" alt="">
                                    </div>
                                    <h4 class="text-white uppercase fz-18">Policy</h4>
                                </a>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                        if(get_user_id_role()==4)
                        {
                    ?>
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-3">
                                <div class="banner-icons">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#policylistmodel" onclick="getPolicy();">
                                        <div class="img-icon">
                                            <img src="assets/images/tips.svg" alt="">
                                        </div>
                                        <h4 class="text-white uppercase fz-18">Policy</h4>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="banner-icons">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#quotelistmodel" onclick="getQuote();">
                                        <div class="img-icon">
                                            <img src="assets/images/tips.svg" alt="">
                                        </div>
                                        <h4 class="text-white uppercase fz-18">Motivational Quote</h4>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="banner-icons">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#noticelistmodel" onclick="getNotice();">
                                        <div class="img-icon">
                                            <img src="assets/images/tips.svg" alt="">
                                        </div>
                                        <h4 class="text-white uppercase fz-18">Notice Board</h4>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="banner-icons">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#leavelistmodel"  onclick="getLeave();">
                                        <div class="img-icon">
                                            <img src="assets/images/tips.svg" alt="">
                                        </div>
                                        <h4 class="text-white uppercase fz-18">Leave</h4>
                                    </a>
                                </div>
                            </div>

                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <!-- <div class="hero-footer"></div> -->

        <!-- 
			<div class="banner-bottom-shape">
<img src="https://templates.envytheme.com/esit/default/assets/img/agency/banner/banner-bottom-shape.png" alt="Image"> -->
    </div>


</div>
<!-- banner end -->

</div>



<!-- Report Modal -->
<div class="modal fade" id="reportlistmodel" tabindex="-1" aria-labelledby="reportlistLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog full-modal">
		<div class="modal-content">
			<div class="modal-header-2">
				<h5 class="modal-title" id="reportlistLabel">Reports</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body font-14">
                <div class="row d-flex justify-content-center flex-wrap">
                        <div class="col-md-2">
                            <div class="banner-icons banner-report">
                                <a href="javascript:void(0)" data-toggle="modal" onClick="getAllCloClients()" data-target="#rosterclientlistmodel">
                                    <div class="img-icon">
                                        <img src="assets/images/clients.svg" alt="">
                                    </div>
                                    <h4>Roster </h4>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="banner-icons banner-report">
                                <a href="javascript:void(0)" data-toggle="modal" onClick="getAllCloClientsService()" data-target="#serviceagreementclientlistmodel">
                                    <div class="img-icon">
                                        <img src="assets/images/staff.svg" alt="">
                                    </div>
                                    <h4>Service Aggrement </h4>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="banner-icons banner-report">
                                <a href="javascript:void(0)" onClick="getAllCloClientsInvoice()" data-toggle="modal" data-target="#invoiceclientlistmodel">
                                    <div class="img-icon">
                                        <img src="assets/images/report.svg" alt="">
                                    </div>
                                    <h4>Invoice </h4>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="banner-icons banner-report">
                                <a href="javascript:void(0)" onClick="getAllCloClientsAppointment()" data-toggle="modal" data-target="#appointmentclientlistmodel" >
                                    <div class="img-icon">
                                        <img src="assets/images/support.svg" alt="">
                                    </div>
                                    <h4>Appointment </h4>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="banner-icons banner-report">
                                <a href="javascript:void(0)" onClick="getAllCloClientsRequestAmendment()" data-toggle="modal" data-target="#requestamendmentclientlistmodel" >
                                    <div class="img-icon">
                                        <img src="assets/images/tips.svg" alt="">
                                    </div>
                                    <h4> Request Amendment </h4>
                                </a>
                            </div>
                        </div>

                    </div>
			</div>
		
		</div>
	</div>
</div>


<!-- Add new clients -->
<?php include 'modal/appointmentClientModal.php';?>

<?php include 'modal/invoiceClientModal.php';?>

<!-- Add new clients -->
<?php include 'modal/rosterClientModal.php';?>

<!-- Add new clients -->
<?php include 'modal/serviceAgreementClientsModal.php';?>

<!-- Add new clients -->
<?php include 'modal/requestAmendmentClientsModal.php';?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#profilecountry').trigger('change');  
    });
    function getStatelistProfile(Id)
    {
        $('#profilestate').html('<option value="">Please wait...</option>');
        $('#profilecity').html('<option value=""></option>');
        var str = "country="+Id+"&"+csrfData['token_name']+"="+csrfData['hash'];
        $.ajax({
            url: '<?php echo base_url('clients/getStatelist')?>',
            type: 'POST',
            data: str,
            datatype: 'json',
            cache: false,
            success: function(resp_){
                
                if(resp_)
                {
                    var resp = JSON.parse(resp_);
                    var res = '<option value=""></option>';
                    for(var i=0; i<resp.length; i++)
                    {
                       res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                    }
                    $('#profilestate').html(res);
                     $('.profilestate').selectpicker('refresh');

                }
                else
                {
                    $('#profilestate').html('<option value=""></option>');
                     $('.profilestate').selectpicker('refresh');
                }
            }
        });
    }
    
    function getCitylistProfile(Id)
    {
        $('#profilecity').html('<option value="">Please wait...</option>');
        var str = "state="+Id+"&"+csrfData['token_name']+"="+csrfData['hash'];
        // console.log('str',str);
        $.ajax({
            url: '<?php echo base_url('clients/getCitylist')?>',
            type: 'POST',
            data: str,
            datatype: 'json',
            cache: false,
            success: function(resp_){
                // console.log('data',resp_)
                if(resp_)
                {
                    var resp = JSON.parse(resp_);
                    var res = '<option value=""></option>';
                    for(var i=0; i<resp.length; i++)
                    {
                       res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
                    }
                    $('#profilecity').html(res);
                     $('.profilecity').selectpicker('refresh');
                }
                else
                {
                    $('#profilecity').html('<option value=""></option>');
                     $('.profilecity').selectpicker('refresh');
                }
            }
        });
    }
</script>

<script>
    (function() {

        var hdclock = document.querySelector('.hdclock');

        // But there is a little problem
        // we need to pad 0-9 with an extra
        // 0 on the left for hours, seconds, minutes

        var pad = function(x) {
            return x < 10 ? '0' + x : x;
        };

        var ticktock = function() {
            var d = new Date();
            current_time = new Intl.DateTimeFormat('default', {
                hour12: true,
                hour: 'numeric',
                minute: 'numeric'
            }).format(d);


            hdclock.innerHTML = current_time;

        };

        ticktock();

        // Calling ticktock() every 1 second
        setInterval(ticktock, 1000);

    }());


    var greetDate = new Date();
    var hrsGreet = greetDate.getHours();

    var greet;
    if (hrsGreet < 12)
        greet = "<?php echo _l('good_morning'); ?>";
    else if (hrsGreet >= 12 && hrsGreet <= 17)
        greet = "<?php echo _l('good_afternoon'); ?>";
    else if (hrsGreet >= 17 && hrsGreet <= 24)
        greet = "<?php echo _l('good_evening'); ?>";

    if (greet) {
        document.getElementById('greeting').innerHTML =
            '<b>' + greet + ' <?php echo $contact->firstname; ?> <?php echo $contact->lastname; ?>!</b>';
    }

   
</script>