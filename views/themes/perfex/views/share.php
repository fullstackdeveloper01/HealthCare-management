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
        <?php
            if($propertyRes)
            {
                ?>
                    <div class="row">
                     <div class="col-md-12">
                        <div class="header-wrap p-10 bg-white">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="fw-700 mt-0">Property Details</h4>
                                </div>
                            </div>
                        </div>
                     </div>
                  </div>
                    <hr class="mt-0 mb-0">
                    <div class="row">
                     <div class="col-md-8">
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
                                                        <img src="<?= site_url('uploads/tasks/'.$propertyRes->id.'/'. $imageArray->file_name); ?>" alt="<?= $imageArray->file_name; ?>" class="br-8">
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
                                                        <img src="<?= site_url('uploads/tasks/'.$propertyRes->id.'/'. $imageArray->file_name); ?>" alt="<?= $imageArray->file_name; ?>" class="br-8">
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    }
                                    if($propertyRes->defaultimage != 7)
                                    {
                                        $imageArray = '';
                                        $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $propertyRes->id, 'rel_type' => "property2"))->row(); 
                                        if($imageArray->file_name)
                                        {
                                            ?>
                                                <div class="item">
                                                    <div class="photo br-8">
                                                        <img src="<?= site_url('uploads/tasks/'.$propertyRes->id.'/'. $imageArray->file_name); ?>" alt="<?= $imageArray->file_name; ?>" class="br-8">
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    }
                                    if($propertyRes->defaultimage != 7)
                                    {
                                        $imageArray = '';
                                        $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $propertyRes->id, 'rel_type' => "property3"))->row(); 
                                        if($imageArray->file_name)
                                        {
                                            ?>
                                                <div class="item">
                                                    <div class="photo br-8">
                                                        <img src="<?= site_url('uploads/tasks/'.$propertyRes->id.'/'. $imageArray->file_name); ?>" alt="<?= $imageArray->file_name; ?>" class="br-8">
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    }
                                    if($propertyRes->defaultimage != 7)
                                    {
                                        $imageArray = '';
                                        $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $propertyRes->id, 'rel_type' => "property4"))->row(); 
                                        if($imageArray->file_name)
                                        {
                                            ?>
                                                <div class="item">
                                                    <div class="photo br-8">
                                                        <img src="<?= site_url('uploads/tasks/'.$propertyRes->id.'/'. $imageArray->file_name); ?>" alt="<?= $imageArray->file_name; ?>" class="br-8">
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    }
                                    if($propertyRes->defaultimage != 7)
                                    {
                                        $imageArray = '';
                                        $imageArray = $this->db->get_where(db_prefix().'files', array('rel_id' => $propertyRes->id, 'rel_type' => "property5"))->row(); 
                                        if($imageArray->file_name)
                                        {
                                            ?>
                                                <div class="item">
                                                    <div class="photo br-8">
                                                        <img src="<?= site_url('uploads/tasks/'.$propertyRes->id.'/'. $imageArray->file_name); ?>" alt="<?= $imageArray->file_name; ?>" class="br-8">
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
                              </div>  
                           </div>
                        </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="stats-wrap p-10 bg-white">
                                    <ul class="nav nav-tabs mb-5">
                                    <li class="active"><a data-toggle="tab" href="#home">DETAILS</a></li>
                                    <li><a data-toggle="tab" href="#menu1">DOCS</a></li>
                                    <!--<li><a data-toggle="tab" href="#distances">DISTANCES</a></li>-->
                                    <!--<li><a data-toggle="tab" href="#menu2">APPOINTMENTS SCHEDULED</a></li>-->
                                    </ul>
                                    <?php
                                        $userdata = $this->db->select('brokerage,license,phonenumber')->get_where(db_prefix().'contacts', array('userid' => $propertyRes->agent_id))->row();
                                    ?>
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
                                                        <div class="txt">PRICE</div>
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
                                                        <div class="txt">SQ. FT.</div>
                                                        <div class="txt-specs"><?= $propertyRes->sqfit; ?></div>
                                                    </div>
                                                </div>
                                                <div class="listitem">
                                                    <div class="outside-container">
                                                        <div class="txt">LOT SIZE</div>
                                                        <div class="txt-specs"><?= $propertyRes->plot_sqfit?> Sq. Ft</div>
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
                                                <div class="col-md-12">
                        				            <table class="table dt-table table-doc" data-order-col="1" data-order-type="desc">
                                                        <thead>
                                                            <tr>
                                                                <th class="th-doc-title"><?php echo _l('Title'); ?></th>
                                                                <th class="th-doc-size"><?php echo _l('Required'); ?></th>
                                                                <th class="th-doc-size"><?php echo _l('Description'); ?></th>
                                                                <!--<th class="th-doc-date"><?php echo _l('Created Deate'); ?></th>-->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach($propertyDocRes as $res){ ?>
                                                            <tr>
                                                                <td>
                                                                    <?= $res->title; ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                        if($res->required == 1)
                                                                        echo 'Yes';
                                                                        else
                                                                        echo 'Optional';
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?= $res->description; ?>
                                                                </td>
                                                                <!--<td data-order="<?php echo $res->createddate; ?>"><?php echo _d($res->createddate); ?></td>-->
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                        				        </div>
                                                <?php
                                                   /* if($propertyDocRes)
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
                                                                            <a class="btn cbtn-btn btn-info" href="<?= site_url('uploads/tasks/'.$propertyRes->id.'/'. $imageArray->file_name); ?>" download style="color:#fff;">Download</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                        }
                                                    } */
                                                ?>
                                            
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
                                        <div id="menu2" class="tab-pane fade hide">
                                        <div class="menu2">
                                            <ul class="responsive-table">
                                                <li class="table-header">
                                                    <div class="col col-1">Client Name</div>
                                                    <div class="col col-3">Date/ Time</div>
                                                    <div class="col col-4">Time</div>
                                                    <div class="col col-5">Address</div>
                                                    <div class="col col-6">Status</div>
                                                </li>
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
                                            </ul>
                                        </div>
                                    </div>
                                        <div id="distances" class="tab-pane fade">
                                            <div class="amenities-wrap">
                                                <div class="icons-list" data-type="list">
                                                    <div class="listitem">
                                                        <div class="outside-container">
                                                            <div class="txt">Beach</div>
                                                            <div class="txt-specs"><?= $propertyRes->Beach; ?> <sup>m</sup></div>
                                                        </div>
                                                    </div>
                                                    <div class="listitem">
                                                        <div class="outside-container">
                                                            <div class="txt">Train</div>
                                                            <div class="txt-specs"><?= $propertyRes->Train; ?> <sup>m</sup></div>
                                                        </div>
                                                    </div>
                                                    <div class="listitem">
                                                        <div class="outside-container">
                                                            <div class="txt">Metro</div>
                                                            <div class="txt-specs"><?= $propertyRes->Metro; ?> <sup>m</sup></div>
                                                        </div>
                                                    </div>
                                                    <div class="listitem">
                                                        <div class="outside-container">
                                                            <div class="txt">Bus</div>
                                                            <div class="txt-specs"><?= $propertyRes->Bus; ?> <sup>m</sup></div>
                                                        </div>
                                                    </div>
                                                    <div class="listitem">
                                                        <div class="outside-container">
                                                            <div class="txt">Pharmacies</div>
                                                            <div class="txt-specs"><?= $propertyRes->Pharmacies; ?> <sup>m</sup></div>
                                                        </div>
                                                    </div>
                                                    <div class="listitem">
                                                        <div class="outside-container">
                                                            <div class="txt">Bakery</div>
                                                            <div class="txt-specs"><?= $propertyRes->Bakery; ?> <sup>m</sup></div>
                                                        </div>
                                                    </div>
                                                    <div class="listitem">
                                                        <div class="outside-container">
                                                            <div class="txt">Restourant</div>
                                                            <div class="txt-specs"><?= $propertyRes->Restourant; ?> <sup>m</sup></div>
                                                        </div>
                                                    </div>
                                                    <div class="listitem">
                                                        <div class="outside-container">
                                                            <div class="txt">Coffee shop</div>
                                                            <div class="txt-specs"><?= $propertyRes->Coffee_shop; ?> <sup>m</sup></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="appointment-wrap">
                            <h2 class="text-center">Book an appointment</h2>
                            <div class="border-box">
                                <?php echo form_open_multipart($this->uri->uri_string(),['class'=>'form-cf']); ?>
                                <?php echo validation_errors('<div class="alert alert-danger text-center">', '</div>'); ?>
                                    <div class="form-group">
                                        <label class="title" for="name">Name</label>
                                        <input type="text" class="form-control" name="name" required id="name" autocomplete="off" placeholder="Name here">
                                        <input type="text" class="form-control hide" name="property_id" required id="property_id" value="<?= $propertyRes->id; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="title" for="email">Email</label>
                                        <input type="email" class="form-control" name="email" required id="email" autocomplete="off" placeholder="Email here">
                                    </div>
                                    <div class="form-group">
                                        <label class="title">Brokerage</label>
                                        <input type="text" class="form-control" name="brokerage" required id="brokerage" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label class="title">License</label>
                                        <input type="text" class="form-control" name="license" required id="license" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label class="title">Phone Number</label>
                                        <input type="number" class="form-control" name="phone" required id="phone" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label class="title" for="date">Select Appointment Date</label>
                                        <div id="filterDate2">
                                            <!-- Datepicker as text field -->         
                                            <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                <input  type="text" name="appointment_date" id="appointment_date" autocomplete="off" class="form-control" onChange="selectDate();" required placeholder="dd.mm.yyyy">
                                                <div class="input-group-addon" >
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                            </div>
                                        </div>   
                                    </div>
                                    <?php
                                        if($propertyDocRes)
                                        {
                                            foreach($propertyDocRes as $rr)
                                            {
                                                ?>
                                                    <div class="form-group">
                                                        <label class="title" for="email"><?= $rr->title; ?><span class="text-danger"><?= ($rr->required == 1)?"*":""; ?></span></label>
                                                        <input type="file" name="doc<?= $rr->id; ?>" <?= ($rr->required == 1)?"required":""; ?> >
                                                        <!--<input type="text" class="hide" value="<?= $rr->id; ?>" name="docId<?= $rr->id; ?>">-->
                                                    </div>              
                                                <?php
                                            }
                                        }
                                    ?>
                                    <div class="form-group">
                                        <label class="title" for="date">Select Available Days</label>
                                        <?php
                                            $calstatus = $this->db->get_where(db_prefix().'property_calender', array('property_id' => $propertyRes->id))->row('setDay');
                                            $todayDay = explode(',',$calstatus);
                                            $leaveday = [];
                                            $leavedaystr = '';
                                            if($todayDay)
                                            {
                                                if(!in_array('Sunday', $todayDay))
                                                {
                                                    array_push($leaveday, 0);
                                                }
                                                if(!in_array('Monday', $todayDay))
                                                {
                                                    array_push($leaveday, 1);
                                                }
                                                if(!in_array('Tuesday', $todayDay))
                                                {
                                                    array_push($leaveday, 2);
                                                }
                                                if(!in_array('Wednesday', $todayDay))
                                                {
                                                    array_push($leaveday, 3);
                                                }
                                                if(!in_array('Thursday', $todayDay))
                                                {
                                                    array_push($leaveday, 4);
                                                }
                                                if(!in_array('Friday', $todayDay))
                                                {
                                                    array_push($leaveday, 5);
                                                }
                                                if(!in_array('Saturday', $todayDay))
                                                {
                                                    array_push($leaveday, 6);
                                                }
                                                $leavedaystr = implode(',',$leaveday);
                                                foreach($todayDay as $re)
                                                {
                                                    ?>
                                                        <label class="label four col sellfield hover active text-danger" for="day-<?= $re; ?>"><?= $re; ?></label>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                echo '<label class="label four col sellfield hover active text-danger" for="day-na">No Available</label>';
                                            }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="title" for="date">Select Available Time</label>
                                        <div class="radio-btn bookdate">
                                            <?php
                                                if($setTime)
                                                {
                                                    $sn = 1;
                                                    $setTimearr = explode(',', $setTime);
                                                    foreach($setTimearr as $r)
                                                    {
                                                        ?>
                                                            <input type="radio" name="available_time" required id="one<?= $sn; ?>" value="<?= $r; ?>"><label class="label four col sellfield hover active text-danger" for="one<?= $sn; ?>"><?= $r; ?></label>
                                                        <?php
                                                        $sn++;
                                                    }
                                                }
                                                else
                                                {
                                                    ?>
                                                        <input type="radio" name="available_time" required id="one" value="09:10am" checked=""><label class="label four col sellfield hover active" for="one">09:10am</label>
                                                        <input type="radio" name="available_time" required id="two" value="10:10am"><label class="two-label four col sellfield hover active" for="two">10:00am</label>
                                                        <input type="radio" name="available_time" required id="three" value="11:30am"><label class="three-label four col sellfield hover active" for="three">11:30am</label>
                                                        <input type="radio" name="available_time" required id="four" value="12:10pm"><label class="four-label four col sellfield hover active" for="four">12:10pm</label>
                                                        <input type="radio" name="available_time" required id="five" value="01:00pm"><label class="five-label four col sellfield hover active" for="five">01:00pm</label>
                                                        <input type="radio" name="available_time" required id="six" value="02:30pm"><label class="six-label four col sellfield hover active" for="six">02:30pm</label>
                                                        <input type="radio" name="available_time" required id="seven" value="05:00pm"><label class="seven-label four col sellfield hover active" for="seven">05:00pm</label>
                                                        <input type="radio" name="available_time" required id="eight" value="06:00pm"><label class="eight-label four col sellfield hover active" for="eight">06:00pm</label>
                                                        <input type="radio" name="available_time" required id="nine" value="07:30pm"><label class="nine-label four col sellfield hover active" for="nine">07:30pm</label>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <button class="btn btn-success btn-block btn-contact" type="submit"> Book Appointment </button>
                                </form>
                            </div>
                        </div>
                        <div class="agent-wrap text-center">
                            <div class="border-box">
                                <div class="profile-wrap">
                                    <img src="<?php echo contact_profile_image_url($this->db->get_where(db_prefix().'contacts', array('userid' => $propertyRes->agent_id))->row('id'),'thumb'); ?>" class="img-responsive">
                                </div>
                                <h5>Agent</h5>
                                <!--<h4><b><?= get_company_name($this->db->get_where(db_prefix().'contacts', array('userid' => $propertyRes->agent_id))->row('id')); ?></b></h4>-->
                                <h4><b><?= $this->db->get_where(db_prefix().'contacts', array('userid' => $propertyRes->agent_id))->row('firstname'); ?></b></h4>
                                <p>Agent id: #<?= $this->db->get_where(db_prefix().'contacts', array('userid' => $propertyRes->agent_id))->row('id'); ?></p>
                                <hr>
                                <button class="btn btn-success btn-block btn-contact" type="button"><i class="fa fa-envelope" aria-hidden="true"></i> Contact Agent</button>
                            </div>
                        </div>
                    </div> <hr>
                  </div>
                <?php
            }
            else
            {
                ?>
                    <p class="no-margin dataTables_empty"><?php echo _l('No property found'); ?></p>
                <?php
            }
        ?>
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
    
    /* selectDate */
    function selectDate()
    {
        var appointment_date = $('#appointment_date').val();
        var ID = '<?= $propertyRes->id ?>';
        var str = "ID="+ID+"&appointment_date="+appointment_date+"&"+csrfData['token_name']+"="+csrfData['hash'];
	    $.ajax({
	        url: '<?= site_url()?>share/searchDate',
	        type: 'POST',
	        data: str,
	        cache: false,
	        success: function(resp){
	            $('.bookdate').html(resp);
	        }
	    });
    }
</script>
<script type="text/javascript">
    $('.input-group.date').datepicker({
        daysOfWeekDisabled: "<?= $leavedaystr ?>",
        format: "dd.mm.yyyy",
        autoclose: true,
        startDate: '+1d'  
    }); 
</script> 