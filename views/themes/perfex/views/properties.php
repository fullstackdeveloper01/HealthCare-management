<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
   .appointment-wrap {
      border-radius: 3px;
      background-color: #ffffff;
      margin: 20px 20px 0 20px;
      border: 1px solid #eee;
   }
   .appointment-wrap .border-box {
      
      padding: 15px;
      border-radius: 8px;
   }
   .appointment-wrap h2{
      background-color:#314e73;
      color: #fff;
      margin-top: 0px;
      padding: 15px;
      text-transform: capitalize;
      font-size: 16px;
      letter-spacing: 1px;
      border-top-left-radius: 4px;
      border-top-right-radius: 4px;
   }
   .appointment-wrap .form-cf .radio-btn {
      display: flex;
      flex-flow: row wrap;
      margin-bottom: 25px;
   }
   .appointment-wrap .form-cf input[type="radio"] {
      display: none;
   }
   .appointment-wrap .form-cf .sellfield {
      position: relative;
      color: #000;
      background-color: #ffffff;
      font-size: 14px;
      text-align: center;
      display: block;
      cursor: pointer;
      border: 1px solid #c0cbda;
      border-radius: 0px;
      margin-right: 0px;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      box-shadow: 0 2px 8px 0 rgba(0,0,0,.1), inset 0 1px 4px 0 rgba(0,0,0,.1);
      padding: 12px 18px;
      margin-bottom: 0px;
      padding: 12px 18px;
   }
   .appointment-wrap .form-cf input:checked + label:after {
      content: "\f00c";
      width: 20px;
      height: 20px;
      line-height: 20px;
      border-radius: 100%;
      z-index: 1;
      position: absolute;
      top: 0px;
      right: 0px;
      font: normal normal normal 14px/1 FontAwesome;
      font-size: 14px;
      padding: 3px;
      color: #3379b7;
   }
   .appointment-wrap .form-cf .title{
      font-weight:600;
      text-transform:uppercase;
      text-align:left!important;
   }
</style>
<div class="panel_s section-heading section-announcements">
    <div class="panel-body">
        <h4 class="no-margin section-text"><?php echo _l($title); ?></h4>
    </div>
</div>
<div class="panel_s">
   <div class="panel-body">
      <div class="row">
         <div class="col-md-12">
            <div class="header-wrap p-10 bg-white">
               <div class="d-flex align-items-center">
                  <div>
                     <h4 class="fw-700 mt-0">Property Details</h4>
                  </div>
                  <div class="ml-auto align-items-center">
                     <div class="dl">
                     <a href="<?= site_url('clients/property')?>" class="back">Back</a> 
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <hr class="mt-0 mb-0">
      <div class="row">
         <div class="col-md-12">
            <div class="detail-wrapper info">
                <div id="owl-demo" class="owl-carousel property-carousel">
                   <?php
                        if($propertyRes->defaultimage != 7)
                        {
                            $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $propertyRes->id, 'rel_type' => "propertyimg"))->row(); 
                            if($imageArray)
                            {
                                ?>
                                    <div class="item">
                                        <div class="photo br-8">
                                            <img src="<?= site_url('download/file/taskattachment/'. $imageArray->attachment_key); ?>" alt="<?= $imageArray->attachment_key; ?>" class="br-8">
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                        if($propertyRes->defaultimage != 7)
                        {
                            $imageArray = '';
                            $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $propertyRes->id, 'rel_type' => "property1"))->row(); 
                            if($imageArray)
                            {
                                ?>
                                    <div class="item">
                                        <div class="photo br-8">
                                            <img src="<?= site_url('download/file/taskattachment/'. $imageArray->attachment_key); ?>" alt="<?= $imageArray->attachment_key; ?>" class="br-8">
                                        </div>
                                    </div>
                                <?php
                            }
                                
                        }
                        if($propertyRes->defaultimage != 7)
                        {
                            $imageArray = '';
                            $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $propertyRes->id, 'rel_type' => "property2"))->row(); 
                            if($imageArray->attachment_key)
                            {
                                ?>
                                    <div class="item">
                                        <div class="photo br-8">
                                            <img src="<?= site_url('download/file/taskattachment/'. $imageArray->attachment_key); ?>" alt="<?= $imageArray->attachment_key; ?>" class="br-8">
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                        if($propertyRes->defaultimage != 7)
                        {
                            $imageArray = '';
                            $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $propertyRes->id, 'rel_type' => "property3"))->row(); 
                            if($imageArray->attachment_key)
                            {
                                ?>
                                    <div class="item">
                                        <div class="photo br-8">
                                            <img src="<?= site_url('download/file/taskattachment/'. $imageArray->attachment_key); ?>" alt="<?= $imageArray->attachment_key; ?>" class="br-8">
                                        </div>
                                    </div>
                                <?php
                            }
                                
                        }
                        if($propertyRes->defaultimage != 7)
                        {
                            $imageArray = '';
                            $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $propertyRes->id, 'rel_type' => "property4"))->row(); 
                            if($imageArray->attachment_key)
                            {
                                ?>
                                    <div class="item">
                                        <div class="photo br-8">
                                            <img src="<?= site_url('download/file/taskattachment/'. $imageArray->attachment_key); ?>" alt="<?= $imageArray->attachment_key; ?>" class="br-8">
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                        if($propertyRes->defaultimage != 7)
                        {
                            $imageArray = '';
                            $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $propertyRes->id, 'rel_type' => "property5"))->row(); 
                            if($imageArray->attachment_key)
                            {
                                ?>
                                    <div class="item">
                                        <div class="photo br-8">
                                            <img src="<?= site_url('download/file/taskattachment/'. $imageArray->attachment_key); ?>" alt="<?= $imageArray->attachment_key; ?>" class="br-8">
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                   ?>
                  <!--
                  <div class="item">
                     <div class="photo br-8">
                        <img src="<?php echo base_url(); ?>assets/images/slider/slider-2.png" alt="Owl Image" class="br-8">
                     </div>
                  </div>
                  <div class="item">
                     <div class="photo br-8">
                        <img src="<?php echo base_url(); ?>assets/images/slider/slider-1.png" alt="Owl Image" class="br-8">
                     </div>
                  </div>
                  <div class="item">
                     <div class="photo br-8">
                        <img src="<?php echo base_url(); ?>assets/images/slider/slider-3.png" alt="Owl Image" class="br-8">
                     </div>
                  </div>
                  -->
               </div>
               <br>
               <div class="d-flex align-items-center">
                  <div>
                     <h4 class="fw-700 mt-0"><?= $propertyRes->name; ?></h4>
                     <p><?= $propertyRes->address?></p>
                     <span class="view">0 Request send</span>
                     <span class="view">0 Request confirmed</span>
                  </div>
                  <div class="ml-auto align-items-center">
                     <div class="dl">
                        <!--<a class="btn cbtn-btn" href="javascript:void(0);" data-toggle="modal" data-target="#shareModal">Share property</a>-->
                        <a class="btn cbtn-btn btn-info" href="javascript:void(0);" data-toggle="modal" data-target="#sharelinkModal">Share Appointment Link</a>
                     </div>
                  </div>   
               </div>
            </div>
         </div>
         <div class="col-md-4 hide">
            <div class="agent-wrap text-center">
               <div class="border-box">
                  <div class="profile-wrap">
                     <img src="<?php echo contact_profile_image_url(get_contact_user_id(),'thumb'); ?>" class="img-responsive">
                  </div>
                  <h5>Agent</h5>
                  <h4><b><?= $this->db->get_where(db_prefix().'contacts', array('userid' => get_contact_user_id()))->row('firstname'); ?></b></h4>
                  <p>Agent id: #<?= get_contact_user_id(); ?></p>
                  <hr>
                  <button class="btn btn-success btn-block btn-contact" type="button"><i class="fa fa-envelope" aria-hidden="true"></i> Contact Agent</button>
               </div>
            </div>
            <div class="appointment-wrap">
               <h2 class="text-center">Book an appointment</h2>
               <div class="border-box">
                  <form class="form-cf">
                     <div class="form-group">
                        <label class="title" for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name here">
                     </div>

                     <div class="form-group">
                        <label class="title" for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email here">
                     </div>

                     <div class="form-group">
                        <label class="title" for="date">Select Appointment Date</label>
                        <div id="filterDate2">
                           <!-- Datepicker as text field -->         
                           <div class="input-group date" data-date-format="dd.mm.yyyy">
                              <input  type="text" class="form-control" placeholder="dd.mm.yyyy">
                              <div class="input-group-addon" >
                                 <span class="glyphicon glyphicon-th"></span>
                              </div>
                           </div>
                        </div>   
                     </div>
               
                     <div class="form-group">
                        <label class="title" for="date">Select Available Time</label>
                        <div class="radio-btn">
                           <input type="radio" name="radio2" id="one" value="one" checked=""><label class="one-label four col sellfield hover active" for="one">09:10am</label>
                           <input type="radio" name="radio2" id="two" value="two"><label class="two-label four col sellfield hover active" for="two">10:00am</label>
                           <input type="radio" name="radio2" id="three" value="three"><label class="three-label four col sellfield hover active" for="three">11:30am</label>
                           <input type="radio" name="radio2" id="four" value="four"><label class="four-label four col sellfield hover active" for="four">12:10pm</label>
                           <input type="radio" name="radio2" id="five" value="five"><label class="five-label four col sellfield hover active" for="five">01:00pm</label>
                           <input type="radio" name="radio2" id="six" value="six"><label class="six-label four col sellfield hover active" for="six">02:30pm</label>
                           <input type="radio" name="radio2" id="seven" value="seven"><label class="seven-label four col sellfield hover active" for="seven">05:00pm</label>
                           <input type="radio" name="radio2" id="eight" value="eight"><label class="eight-label four col sellfield hover active" for="eight">06:00pm</label>
                           <input type="radio" name="radio2" id="nine" value="nine"><label class="nine-label four col sellfield hover active" for="nine">07:30pm</label>
                        </div>
                     </div>


                     <button class="btn btn-success btn-block btn-contact" type="button"> Book Appointment </button>
                  </form>
               </div>
            </div>
         </div>
         <hr>
         <div class="col-md-12">
            <div class="stats-wrap p-10 bg-white">
                <ul class="nav nav-tabs mb-5">
                  <li class="active"><a data-toggle="tab" href="#home">DETAILS</a></li>
                  <li><a data-toggle="tab" href="#menu1">DOCS</a></li>
                  <!--<li><a data-toggle="tab" href="#distances">DISTANCES</a></li>-->
                  <li><a data-toggle="tab" href="#menu2">APPOINTMENTS SCHEDULED</a></li>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                     <div class="amenities-wrap">
                        <div class="icons-list" data-type="list">
                            <div class="">
                              <div class="outside-container">
                                 <div class="txt">DESCRIPTION</div>
                                 <div class="txt-specs"><?= $propertyRes->description; ?></div>
                              </div>
                           </div><hr>
                           <div class="listitem">
                              <div class="outside-container">
                                 <div class="txt">ASKING PRICE</div>
                                 <div class="txt-specs"><?= DEFAULT_CURRENCY; ?><?= $propertyRes->price; ?></div>
                              </div>
                           </div>
                           <div class="listitem">
                              <div class="outside-container">
                                 <div class="txt">BEDROOMS</div>
                                 <div class="txt-specs"><?= $propertyRes->bedroom; ?></div>
                              </div>
                           </div>
                           <div class="listitem">
                              <div class="outside-container">
                                 <div class="txt">Sq. Ft.</div>
                                 <div class="txt-specs"><?= $propertyRes->sqfit; ?></div>
                              </div>
                           </div>
                           <div class="listitem">
                              <div class="outside-container">
                                 <div class="txt">LOT SIZE</div>
                                 <div class="txt-specs"><?= $propertyRes->plot_sqfit?> SqFit</div>
                              </div>
                           </div>
                           <div class="listitem">
                              <div class="outside-container">
                                 <div class="txt">PROPERTY TYPE</div>
                                 <div class="txt-specs"><?= $propertyRes->type; ?></div>
                              </div>
                           </div>
                           <div class="listitem">
                              <div class="outside-container">
                                 <div class="txt">BATHROOMS</div>
                                 <div class="txt-specs"><?= $propertyRes->bathroom?></div>
                              </div>
                           </div>
                           <div class="listitem">
                              <div class="outside-container">
                                 <div class="txt"><?= DEFAULT_CURRENCY; ?>/SQ. FT.</div>
                                 <div class="txt-specs"><?= $propertyRes->sqfit_price; ?></div>
                              </div>
                           </div>
                           <div class="listitem">
                              <div class="outside-container">
                                 <div class="txt">YEAR BUILT</div>
                                 <div class="txt-specs"><?= $propertyRes->year; ?></div>
                              </div>
                           </div>
                           <!--
                           <div class="listitem">
                              <div class="outside-container">
                                 <div class="txt">Brokerage</div>
                                 <div class="txt-specs"><?= $userdata->brokerage; ?></div>
                              </div>
                           </div>
                           <div class="listitem">
                              <div class="outside-container">
                                 <div class="txt">License</div>
                                 <div class="txt-specs"><?= $userdata->license; ?></div>
                              </div>
                           </div>
                           <div class="listitem">
                              <div class="outside-container">
                                 <div class="txt">Phone Number</div>
                                 <div class="txt-specs"><?= $userdata->phonenumber; ?></div>
                              </div>
                           </div>
                           -->
                        </div>
                     </div>
                  </div>
                    <div id="menu1" class="tab-pane fade">
                     <div class="menu1 text-center">
                        <div class="home-wrap">
                           <div class="d-flex align-items-center">
                              <div>
                                 <h5 class="text-large text-bold text-underline"><?= count($propertyDocRes); ?> Documents</h5>
                              </div>
                              <div class="ml-auto align-items-center">
                                 <div class="dl">
                                    <!--<button class="btn btn-info btn-block" type="button" data-toggle="modal" data-target="#uploadModal"><i class="fa fa-cloud" aria-hidden="true"></i> Upload Docs</button>-->
                                    <div class="form-group mb-0">
                                       <input type="text" class="form-control" placeholder="Search">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="doc-list">
                            <?php /*
                                if($propertyDocRes)
                                {
                                    foreach($propertyDocRes as $res)
                                    {
                                        $imageArray = '';
                                        $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $res->id, 'rel_type' => "propertydoc"))->row(); 
                                        $fullPath = TASKS_ATTACHMENTS_FOLDER.$res->id.'/'.$imageArray->file_name;
                                        ?>
                                            <div class="d-flex align-items-center mt-20">
                                                <div class="img-holder">
                                                    <img src="<?php echo base_url();?>assets/images/property/doc1.png" class="img-fluid">
                                                </div>
                                                <div class="content ml-20">
                                                    <h3 class="mt-0"><b><?= $res->title; ?></b></h3>
                                                    <div class="card-subtitle text-gray mb-2">
                                                        <span><?= bytesToSize($fullPath); ?></span>
                                                        <span> | </span>
                                                        <span>Updated <?= date('F d, Y h:i:s a', strtotime($res->createddate)); ?></span>
                                                    </div>
                                                </div>
                                                <div class="ml-auto align-items-center">
                                                    <div class="dl">
                                                        <a class="btn cbtn-btn btn-info" href="<?= site_url('download/file/taskattachment/'. $imageArray->attachment_key); ?>" download style="color:#fff;">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                } */
                            ?>
                            <div class="col-md-12">
    				            <table class="table dt-table table-doc" data-order-col="1" data-order-type="desc">
                                    <thead>
                                        <tr>
                                            <th class="th-doc-title"><?php echo _l('Title'); ?></th>
                                            <th class="th-doc-size"><?php echo _l('Required'); ?></th>
                                            <th class="th-doc-size"><?php echo _l('Description'); ?></th>
                                            <th class="th-doc-date"><?php echo _l('Created Deate'); ?></th>
                                            <!--<th class="th-doc-date"><?php echo _l('Action'); ?></th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($propertyDocRes as $res){ ?>
                                        <tr id="remove_<?= $res->id; ?>">
                                            <td>
                                                <?= $res->title; ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($res->required == 1)
                                                    echo 'Yes';
                                                    else
                                                    echo 'No';
                                                ?>
                                            </td>
                                            <td>
                                                <?= $res->description; ?>
                                            </td>
                                            <td data-order="<?php echo $res->createddate; ?>"><?php echo _d($res->createddate); ?></td>
                                            <!--<td onclick="removeDoc(<?= $res->id ?>);" style="cursor:pointer;"><i class="fa fa-trash fa-2x"></i></td>-->
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
    				        </div>
                           <!--
                           <div class="d-flex align-items-center mt-20">
                              <div class="img-holder">
                                 <img src="<?php echo base_url();?>assets/images/property/doc1.png" class="img-fluid">
                              </div>
                              <div class="content ml-20">
                                 <h3 class="mt-0"><b>Graebel Rider to Buyer Offer</b></h3>
                                 <div class="card-subtitle text-gray mb-2">
                                    <span>15 pages</span>
                                    <span> | </span>
                                    <span>269.64 kB</span>
                                    <span> | </span>
                                    <span>Updated Jun 8, 2020 03:06AM</span>
                                 </div>
                              </div>
                              <div class="ml-auto align-items-center">
                                 <div class="dl">
                                    <a class="btn cbtn-btn btn-info" href="javascript:void(0);" style="color:#fff;">Download</a>
                                 </div>
                              </div>
                           </div>
                           -->
                        </div>
                     </div>
                  </div>
                    <div id="menu2" class="tab-pane fade">
                     <div class="menu2">
                        <ul class="responsive-table">
                            <li class="table-header">
                                <div class="col col-1">Client Name</div>
                                <div class="col col-3">Date/ Time</div>
                                <div class="col col-4">Time</div>
                                <div class="col col-5">Address</div>
                                <div class="col col-6">Status</div>
                            </li>
                            <?php
                                if($appointment_result)
                                {
                                    foreach($appointment_result as $rr)
                                    {
                                        ?>
                                            <li class="table-row">
                                                <div class="col col-1"><?= $rr->name; ?></div>
                                                <div class="col col-3"><?= date('d M Y', strtotime($rr->appointment_date));?></div>
                                                <div class="col col-4"><?= $rr->available_time; ?></div>
                                                <div class="col col-5"><?= $pradd = $this->db->get_where(db_prefix().'property', array('id' => $rr->property_id))->row('address');?></div>
                                                <div class="col col-6">
                                                    <?php
                                                        if($rr->status == 1)
                                                        {
                                                           ?>
                                                                <span class="badge badge-active">Scheduled</span>
                                                            <?php 
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                                <span class="badge badge-expired">Scheduled</span>
                                                            <?php
                                                        }
                                                    ?>
                                                    
                                                </div>
                                            </li>
                                        <?php
                                    }
                                }
                            ?>
                            <!--
                            <li class="table-row">
                                <div class="col col-1">Aman padhye</div>
                                <div class="col col-3">13 May 2020</div>
                                <div class="col col-4">12.55pm</div>
                                <div class="col col-5">137, silver springs, tx</div>
                                <div class="col col-6">
                                    <span class="badge badge-active">Scheduled</span>
                                </div>
                            </li>
                            <li class="table-row">
                                <div class="col col-1"> Mahesh Jha</div>
                                <div class="col col-3">13 May 2020</div>
                                <div class="col col-4">12.55pm</div>
                                <div class="col col-5">137, silver springs, tx</div>
                                <div class="col col-6">
                                    <span class="badge badge-active">Scheduled</span>
                                </div>
                            </li>
                            <li class="table-row">
                                <div class="col col-1">Aman padhye</div>
                                <div class="col col-3">01 June 2020</div>
                                <div class="col col-4">04.20pm</div>
                                <div class="col col-5">1234, downtown, CA</div>
                                <div class="col col-6">
                                    <span class="badge badge-expired">Cancelled</span>
                                </div>
                            </li>
                            <li class="table-row">
                                <div class="col col-1"> Sameer Dighe</div>
                                <div class="col col-3">09 May 2020</div>
                                <div class="col col-4">10.00am</div>
                                <div class="col col-5">137, silver springs, tx</div>
                                <div class="col col-6">
                                    <span class="badge badge-expired">Cancelled</span>
                                </div>
                            </li>
                            <li class="table-row">
                                <div class="col col-1"> Katan Sisodiya</div>
                                <div class="col col-3">13 May 2020</div>
                                <div class="col col-4">12.55pm</div>
                                <div class="col col-5">09-d, Sydney Harbour, Sydney</div>
                                <div class="col col-6">
                                    <span class="badge badge-active">Scheduled</span>
                                </div>
                            </li>
                            <li class="table-row">
                                <div class="col col-1">  Mahesh Maheshwari</div>
                                <div class="col col-3">01 June 2020</div>
                                <div class="col col-4">04.20pm</div>
                                <div class="col col-5">137, silver springs, tx</div>
                                <div class="col col-6">
                                    <span class="badge badge-expired">Cancelled</span>
                                </div>
                            </li>
                            -->
                        </ul>
                     </div>
                  </div>
                    <div id="distances" class="tab-pane fade">
                        <div class="amenities-wrap">
                            <div class="icons-list" data-type="list">
                                <div class="listitem">
                                    <div class="outside-container">
                                        <div class="txt">Beach</div>
                                        <div class="txt-specs"><?= $propertyRes->Beach; ?><sup>m</sup></div>
                                    </div>
                                </div>
                                <div class="listitem">
                                    <div class="outside-container">
                                        <div class="txt">Train</div>
                                        <div class="txt-specs"><?= $propertyRes->Train; ?><sup>m</sup></div>
                                    </div>
                                </div>
                                <div class="listitem">
                                    <div class="outside-container">
                                        <div class="txt">Metro</div>
                                        <div class="txt-specs"><?= $propertyRes->Metro; ?><sup>m</sup></div>
                                    </div>
                                </div>
                                <div class="listitem">
                                    <div class="outside-container">
                                        <div class="txt">Bus</div>
                                        <div class="txt-specs"><?= $propertyRes->Bus; ?><sup>m</sup></div>
                                    </div>
                                </div>
                                <div class="listitem">
                                    <div class="outside-container">
                                        <div class="txt">Pharmacies</div>
                                        <div class="txt-specs"><?= $propertyRes->Pharmacies; ?><sup>m</sup></div>
                                    </div>
                                </div>
                                <div class="listitem">
                                    <div class="outside-container">
                                        <div class="txt">Bakery</div>
                                        <div class="txt-specs"><?= $propertyRes->Bakery; ?><sup>m</sup></div>
                                    </div>
                                </div>
                                <div class="listitem">
                                    <div class="outside-container">
                                        <div class="txt">Restourant</div>
                                        <div class="txt-specs"><?= $propertyRes->Restourant; ?><sup>m</sup></div>
                                    </div>
                                </div>
                                <div class="listitem">
                                    <div class="outside-container">
                                        <div class="txt">Coffee shop</div>
                                        <div class="txt-specs"><?= $propertyRes->Coffee_shop; ?><sup>m</sup></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
      </div>

      <!--<div class="row mbot15">
         <div class="col-md-12">
            <h3 class="text-success projects-summary-heading no-mtop mbot15"><?php echo _l('projects_summary'); ?></h3>
         </div>
         <?php get_template_part('projects/project_summary'); ?>
      </div>
      <hr />
         <table class="table dt-table table-projects" data-order-col="2" data-order-type="desc">
            <thead>
               <tr>
                  <th class="th-project-name"><?php echo _l('project_name'); ?></th>
                  <th class="th-project-start-date"><?php echo _l('project_start_date'); ?></th>
                  <th class="th-project-deadline"><?php echo _l('project_deadline'); ?></th>
                  <th class="th-project-billing-type"><?php echo _l('project_billing_type'); ?></th>
                  <?php
                     $custom_fields = get_custom_fields('projects',array('show_on_client_portal'=>1));
                     foreach($custom_fields as $field){ ?>
                  <th><?php echo $field['name']; ?></th>
                  <?php } ?>
                  <th><?php echo _l('project_status'); ?></th>
               </tr>
            </thead>
            <tbody>
               <?php foreach($projects as $project){ ?>
               <tr>
                  <td><a href="<?php echo site_url('clients/project/'.$project['id']); ?>"><?php echo $project['name']; ?></a></td>
                  <td data-order="<?php echo $project['start_date']; ?>"><?php echo _d($project['start_date']); ?></td>
                  <td data-order="<?php echo $project['deadline']; ?>"><?php echo _d($project['deadline']); ?></td>
                  <td>
                     <?php
                        if($project['billing_type'] == 1){
                          $type_name = 'project_billing_type_fixed_cost';
                        } else if($project['billing_type'] == 2){
                          $type_name = 'project_billing_type_project_hours';
                        } else {
                          $type_name = 'project_billing_type_project_task_hours';
                        }
                        echo _l($type_name);
                        ?>
                  </td>
                  <?php foreach($custom_fields as $field){ ?>
                  <td><?php echo get_custom_field_value($project['id'],$field['id'],'projects'); ?></td>
                  <?php } ?>
                  <td>
                     <?php
                        $status = get_project_status_by_id($project['status']);
                        echo '<span class="label inline-block" style="color:'.$status['color'].';border:1px solid '.$status['color'].'">'.$status['name'].'</span>';
                        ?>
                  </td>
               </tr>
               <?php } ?>
            </tbody>
         </table>-->
   </div>
</div>


<!-- Edit Modal -->
<div class="modal" id="editModal">
  	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Edit Property</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form>
					<div class="row">
						<div class="col-md-4">
							
						</div>
						<div class="col-md-8">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="title">Title</label>
										<input type="text" class="form-control" placeholder="Enter title" id="title">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="price">Price</label>
										<input type="text" class="form-control" placeholder="Enter price" id="price">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="price">Address</label>
								<textarea class="form-control" placeholder="Enter address" id="address" rows="2"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="price">Builder name</label>
								<input type="text" class="form-control" placeholder="Enter builder name" id="builder name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="price">Status</label>
								<select class="form-control">
									<option>Select status</option>
									<option>Active</option>
									<option>Expired</option>
									<option>On hold</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Discard</button>
			</div>
		</div>
	</div>
</div>

<!-- Delete Modal -->
<div class="modal" id="deleteModal">
  	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Delete Confirmation</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				Are you sue, want to delete this property?
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Confirm</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<!-- Add Property Modal -->
<div class="modal" id="addpropertyModal">
  	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Add New Property</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form>
					<div class="row">
						<div class="col-md-4">
							
						</div>
						<div class="col-md-8">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="title">Title</label>
										<input type="text" class="form-control" placeholder="Enter title" id="title">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="details">Details</label>
										<textarea class="form-control" placeholder="Enter details" id="details" rows="3"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="price">property type</label>
								<select class="form-control">
									<option>Select type</option>
									<option>Home</option>
									<option>Appartment</option>
									<option>Duplex</option>
									<option>Bunglow</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="amount">Amount</label>
								<input type="text" class="form-control" placeholder="Enter amount" id="amount">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="age">Poperty age</label>
								<input type="text" class="form-control" placeholder="Enter age" id="age">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="land">Land</label>
								<input type="text" class="form-control" placeholder="Enter land" id="land">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="size">Size</label>
								<input type="text" class="form-control" placeholder="Enter size" id="size">
							</div>
						</div>
					</div>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Discard</button>
			</div>
		</div>
	</div>
</div>

<!-- Share Property Modal -->
<div class="modal" id="shareModal">
  	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Share property</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
            <form>
               <div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="price">Role </label>
								<select class="form-control">
									<option>Select role</option>
									<option>Buyer</option>
									<option>Team member</option>
								</select>
							</div>
						</div>
               </div>
               <div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" class="form-control" placeholder="Enter name" id="name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="text" class="form-control" placeholder="Enter email" id="email">
							</div>
						</div>
					</div>
               <div class="row">
						<div class="col-md-12">
							<div class="form-group">
                        <label for="msg">Custom Message</label>
								<textareea class="form-control" placeholder="Enter custom message" id="msg" rows="3"></textarea>
							</div>
						</div>
               </div>
            </form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Share property</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<!-- Sharelink Modal -->
<div class="modal" id="sharelinkModal">
  	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Share & copy property link</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
            <form action="/action_page.php">
               <div class="input-group">
                  <div class="input-group-btn" style="border: 1px solid #bfcbd9;border-right: 0;">
                     <button class="btn btn-default" type="submit"><i class="fa fa-link" aria-hidden="true"></i></button>
                  </div>
                  <input type="text" class="form-control" id="sharetext" value="<?php echo base_url();?>share?e=<?= $propertyRes->id; ?>">
               </div>
            </form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onClick="textCopy()">Copy</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<!-- Edit Modal -->
<div class="modal" id="uploadModal">
  	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Upload Docs</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body d-inline">
            <form>
               <div class="col-md-6 form-group">
                  <label for="file">Upload Doc</label>
                  <input type="file" id="file" class="border-0">
               </div>
               <div class="col-md-6 form-group">
                  <label for="title">Title</label>
                  <input type="text" id="title" class="form-control"> 
               </div>
               <div class="col-md-6 form-group">
                  <label for="date">Update date</label>
                  <input type="text" id="date" class="form-control"> 
               </div>
               <div class="col-md-6 form-group">
                  <label for="time">Update time</label>
                  <input type="text" id="time" class="form-control"> 
               </div>
               <div class="col-md-12 form-group">
                  <button type="button" class="btn btn-success">Upload</button>
                  <button type="button" class="btn btn-danger">Cancel</button>
               </div>
            </form>
			</div>
      </div>
	</div>
</div>

<script>
// item carousel (uses the Owl Carousel library)
$(".property-carousel").owlCarousel({
	autoplay: true,
	loop:true,
	margin:10,
	responsiveClass:true,
	responsive:{
		0:{
			items:1,
			dots: true,
			nav:false
			
		},
		600:{
			items:2,
			dots: true,
			nav:false
			
		},
		1000:{
			items:1,
			dots: true,
			nav:false,
			loop:true
			
		}
	}
});
$(".time-carousel").owlCarousel({
	autoplay: true,
	loop:true,
	margin:10,
	responsiveClass:true,
	responsive:{
		0:{
			items:3,
			dots: false,
			nav:true
			
		},
		600:{
			items:3,
			dots: false,
			nav: true
			
		},
		1000:{
			items:3,
			dots: false,
			nav: true,
			loop:true
			
		}
	}
});
</script>
<script type="text/javascript">
    $('.input-group.date').datepicker({format: "dd.mm.yyyy"}); 
</script> 