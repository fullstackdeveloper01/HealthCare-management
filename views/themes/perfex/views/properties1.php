<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="panel_s section-heading section-announcements">
    <div class="panel-body">
        <h4 class="no-margin section-text"><?php echo _l($title); ?></h4>
    </div>
</div>
<divc lass="row">
    <div class="panel_s">
        <div class="col-md-12">
            <div class="detail-wrapper info">
                <a href="<?= base_url('clients/property'); ?>" style="margin-bottom: 10px;display: block;">Back to dashboard</a>
                <div id="owl-demo" class="owl-carousel property-carousel">
                    <div class="item">
                        <div class="photo">
                            <img src="<?php echo base_url();?>assets/images/slider/slider-1.png" alt="Owl Image">
                        </div>
                    </div>
                    <div class="item">
                        <div class="photo">
                            <img src="<?php echo base_url(); ?>assets/images/slider/slider-2.png" alt="Owl Image">
                        </div>
                    </div>
                    <div class="item">
                        <div class="photo">
                            <img src="<?php echo base_url(); ?>assets/images/slider/slider-1.png" alt="Owl Image">
                        </div>
                    </div>
                    <div class="item">
                        <div class="photo">
                            <img src="<?php echo base_url(); ?>assets/images/slider/slider-3.png" alt="Owl Image">
                        </div>
                    </div>
                </div>
            </div>

            <section>
                <div class="data-wrap p-20">
                    <div class="type-col" style="position:relative;">
                        <h1 class="type-wrap" title="2067 sq ft 3 BHK 3T East facing Apartment in Queens Terraces by DF Silverline">
                            <span class="type" id="itemNameFor-8900611" itemprop="name">3 BHK Apartment </span> - <span class="size" itemprop="floorSize">2,067 sq ft</span>
                            <div class="loc-wrap">
                                <span class="ib">
                                    <a href="" class="loclink">
                                        <span itemprop="name">DF Silverline Queens Terraces</span>
                                    </a>
                                </span>
                                <span class="ib loc-name">Shivaji Nagar</span>, <span class="ib city-name"><span>Bangalore</span></span>
                            </div>
                        </h1>
                        <a class="btn cbtn-btn" href="javascript:void(0);" style="position: absolute;right: 0px;top: 20px;">request for site visit</a>
                    </div>
                    <div class="i-row clearfix">
                        <div class="i-lcol">
                            <div class="price-wrap">
                                <span class="price">
                                <sup class="rupee currency"></sup>
                                <span class="val" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" itemref="itemUrlFor-8900611">
                                    <meta itemprop="price" content="31000000">
                                    <meta itemprop="priceCurrency" content="INR">
                                    3.1
                                </span>
                                <span class="unit">Cr</span>
                                </span>
                                <span data-goto="homeloancard" data-type="scrollto" class="emilink">EMI</span>
                            </div>
                            <div class="rate-wrap">
                                <span class="currency"></span> 14,997/ sq ft 
                            </div>
                        </div>
                        <div class="i-rcol">
                            <div class="sub-points-row clearfix">
                                <table class="sub-points">
                                <thead>
                                    <tr colspan="2">
                                        <td>Specifications</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="ditem">
                                        <td class="lbl"><label for="Status">Status</label></td>
                                        <td class="val" title="Ready to move" id="Status">Ready to move</td>
                                    </tr>
                                    <tr class="ditem">
                                        <td class="lbl"><label for="Bathrooms">Bathrooms</label></td>
                                        <td class="val" title="3" id="Bathrooms">3</td>
                                    </tr>
                                    <tr class="ditem">
                                        <td class="lbl"><label for="New/Resale">New/Resale</label></td>
                                        <td class="val" title="New" id="New/Resale">New</td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="overview-wrap p-20">
                    <h3 class=mt-0>Description</h3>
                    <div class="desc"><p>3 BHK Apartment available for sale in Queens Road, Shivaji Nagar, Shivaji Nagar, Shivaji Nagar, Bengaluru. Available amenities are: Gym, Lift. Apartment has 3 bedroom, 3 bathroom. It is 1 years old. Building has 4 floors.</p></div>
                    <a href="javascript:void(0);" class="read-more">read more</a>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr class="listitem" data-item="age of property">
                                    <td class="lbl"><label for="Age of Property">Age of Property</label></td>
                                    <td class="val" id="Age of Property">1 - 2 years</td>
                                </tr>
                                <tr class="listitem" data-item="price negotiable">
                                    <td class="lbl"><label for="Price Negotiable">Price Negotiable</label></td>
                                    <td class="val" id="Price Negotiable">No</td>
                                </tr>
                                <tr class="listitem" data-item="security deposit">
                                    <td class="lbl"><label for="Security Deposit">Security Deposit</label></td>
                                    <td class="val" id="Security Deposit">No Deposit</td>
                                </tr>
                                <tr class="listitem" data-item="facing">
                                    <td class="lbl"><label for="Facing">Facing</label></td>
                                    <td class="val" id="Facing">East</td>
                                </tr>
                                <tr class="listitem" data-item="status">
                                    <td class="lbl"><label for="Status">Status</label></td>
                                    <td class="val" id="Status">Unfurnished</td>
                                </tr>
                                <tr class="listitem" data-item="rera id">
                                    <td class="lbl"><label for="RERA ID">RERA ID</label></td>
                                    <td class="val" id="RERA ID">PRM/KA/RERA/1251/446/PR/171014/000618</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!--<section>
                <div class="amenities-wrap p-20">
                    <h3 class="mt-0">Amenities</h3>
                    <div class="icons-list" data-type="list">
                        <div class="listitem">
                            <div class="outside-container">
                                <div class="icon-wrap">
                                    <img src="http://php.manageprojects.in/reppointment_admin/assets/images/amenities/rain-water-harvesting.svg" style="width:25%;">
                                </div>
                                <div class="txt" itemprop="amenityFeature">Rain Water Harvesting</div>
                            </div>
                        </div>
                        <div class="listitem">
                            <div class="outside-container">
                                <div class="icon-wrap">
                                    <img src="http://php.manageprojects.in/reppointment_admin/assets/images/amenities/intercom.svg" style="width:25%;">
                                </div>
                                <div class="txt" itemprop="amenityFeature">Intercom</div>
                            </div>
                        </div>
                        <div class="listitem">
                            <div class="outside-container">
                                <div class="icon-wrap">
                                    <img src="http://php.manageprojects.in/reppointment_admin/assets/images/amenities/indoor-games.svg" style="width:25%;">
                                </div>
                                <div class="txt" itemprop="amenityFeature">Indoor Games</div>
                            </div>
                        </div>
                        <div class="listitem">
                            <div class="outside-container">
                                <div class="icon-wrap">
                                    <img src="http://php.manageprojects.in/reppointment_admin/assets/images/amenities/battery.svg" style="width:25%;">
                                </div>
                                <div class="txt" itemprop="amenityFeature">Power Backup</div>
                            </div>
                        </div>
                        <div class="listitem">
                            <div class="outside-container">
                                <div class="icon-wrap">
                                    <img src="http://php.manageprojects.in/reppointment_admin/assets/images/amenities/gym.svg" style="width:25%;">
                                </div>
                                <div class="txt" itemprop="amenityFeature">Gymnasium</div>
                            </div>
                        </div>
                        <div class="listitem">
                            <div class="outside-container">
                                <div class="icon-wrap">
                                    <img src="http://php.manageprojects.in/reppointment_admin/assets/images/amenities/poker-chip.svg" style="width:25%;">
                                </div>
                                <div class="txt" itemprop="amenityFeature">Club House</div>
                            </div>
                        </div>
                        <div class="listitem">
                            <div class="outside-container">
                                <div class="icon-wrap">
                                    <img src="http://php.manageprojects.in/reppointment_admin/assets/images/amenities/shield.svg" style="width:25%;">
                                </div>
                                <div class="txt" itemprop="amenityFeature">24 X 7 Security</div>
                            </div>
                        </div>
                        <div class="listitem">
                            <div class="outside-container">
                                <div class="icon-wrap">
                                    <img src="http://php.manageprojects.in/reppointment_admin/assets/images/amenities/lift.svg" style="width:25%;">
                                </div>
                                <div class="txt" itemprop="amenityFeature">Lift Available</div>
                            </div>
                        </div>
                        <div class="listitem disabled">
                            <div class="outside-container">
                                <div class="icon-wrap">
                                    <img src="http://php.manageprojects.in/reppointment_admin/assets/images/amenities/baby.svg" style="width:25%;">
                                </div>
                                <div class="txt" itemprop="amenityFeature">Children's play area</div>
                                <div class="overlay"></div>
                            </div>
                            <div class="notPresent">Not Available</div>
                        </div>
                        <div class="listitem disabled">
                            <div class="outside-container">
                                <div class="icon-wrap">
                                    <img src="http://php.manageprojects.in/reppointment_admin/assets/images/amenities/road.svg" style="width:25%;">
                                </div>
                                <div class="txt" itemprop="amenityFeature">Jogging Track</div>
                                <div class="overlay"></div>
                            </div>
                            <div class="notPresent">Not Available</div>
                        </div>
                        <div class="listitem disabled">
                            <div class="outside-container">
                                <div class="icon-wrap">
                                    <img src="http://php.manageprojects.in/reppointment_admin/assets/images/amenities/garden.svg" style="width:25%;">
                                </div>
                                <div class="txt" itemprop="amenityFeature">Landscaped Gardens</div>
                                <div class="overlay"></div>
                            </div>
                            <div class="notPresent">Not Available</div>
                        </div>
                        <div class="listitem disabled">
                            <div class="outside-container">
                                <div class="icon-wrap">
                                    <img src="http://php.manageprojects.in/reppointment_admin/assets/images/amenities/soccer.svg" style="width:25%;">
                                </div>
                                <div class="txt" itemprop="amenityFeature">Sports Facility</div>
                                <div class="overlay"></div>
                            </div>
                            <div class="notPresent">Not Available</div>
                        </div>
                        <div class="listitem disabled">
                            <div class="outside-container">
                                <div class="icon-wrap">
                                    <img src="http://php.manageprojects.in/reppointment_admin/assets/images/amenities/water.svg" style="width:25%;">
                                </div>
                                <div class="txt" itemprop="amenityFeature">Swimming Pool</div>
                                <div class="overlay"></div>
                            </div>
                            <div class="notPresent">Not Available</div>
                        </div>
                    </div>
                    <a class="btn cbtn-btn" href="javascript:void(0);">request for details</a>
                </div>
            </section>-->
        </div>
    
        <!--<div class="col-md-3">
            <form class="review-form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <input type="text" class="form-control" id="contact" placeholder="Enter contact number">
                </div>
                <a class="btn cbtn-btn btn-block" href="javascript:void(0);">Send for review</a>
            </form>
        </div>-->
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
</script>