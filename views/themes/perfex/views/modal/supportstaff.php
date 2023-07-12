<div role="tabpanel" class="tab-pane" id="Supportstaff">
    <div class="row" id="Supportstafflist">

    </div>
</div>




<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script type='text/javascript'>
    var base_url = '<?php echo base_url();?>';


    function getSupportstaff()
    {

      $.ajax({
           "url": "<?php echo base_url('clients/loadClientSupportStaffData')?>",
            type: 'POST',
            data: {client_id:<?php echo $this->uri->segment(3); ?>},
            datatype: 'json',
            cache: false,
            success: function(resp_){
                var respcheck = JSON.parse(resp_);
                if(respcheck!=false)
                {
                    // console.log(resp_);
                    var resp = JSON.parse(resp_);
                    var res = '';
                    for(var i=0; i<resp.length; i++)
                    {
                        res += '<div class="col-lg-3 col-md-4 col-sm-6"><div class="profile-box text-center">';
                        if(resp[i].imgexist==1)
                        {
                            res += '<div class="review-photo">';
                            res += resp[i].img;
                        }
                        if(resp[i].imgexist==0)
                        {
                            var style = '<?php echo mt_rand( 0, 0xFFFFFF ); ?>';
                             res += '<div class="review-photo stafimginidiv"  >';
                            res += '<a class="user-profile-text media-object stafimgini"  style="background: <?php printf( '#%06X\n', mt_rand( 0, 0xFFFFFF )); ?>"> '+resp[i].fn+' '+resp[i].ln+'</a>';
                           

                        }
                        res += '</div><div class="profile-box-text">';
                        res += '<h4>'+resp[i].name+'</h4>';

                        if(resp[i].favorite_food!='' && resp[i].favorite_food.length > 30)
                        {
                            
                            res += '<p><strong class="text-blue">Favorite Food:</strong> '+resp[i].favorite_food_short+'<a href="#" data-toggle="tooltip" data-placement="top" title="'+resp[i].favorite_food+'"> Show More</a></p>';

                        }else if(resp[i].favorite_food!=''){

                            res += '<p><strong class="text-blue">Favorite Food:</strong> '+resp[i].favorite_food+'</p>';

                        }
                        else{

                            

                        }
                        if(resp[i].favorite_sport!='' && resp[i].favorite_sport.length > 30)
                        {
                            res += '<p><strong class="text-blue">Favorite Sport:</strong> '+resp[i].favorite_sport_short+'<a href="#" data-toggle="tooltip" data-placement="top" title="'+resp[i].favorite_sport+'"> Show More</a></p>';

                        }
                        else if(resp[i].favorite_sport!='')
                        {
                            res += '<p><strong class="text-blue">Favorite Sport:</strong> '+resp[i].favorite_sport+'</p>';
                        }
                        else{

                            

                        }
                        if(resp[i].favorite_destination!='' && resp[i].favorite_destination.length > 30)
                        {
                             res += '<p><strong class="text-blue">Travel Destination:</strong> '+resp[i].favorite_destination_short+'<a href="#" data-toggle="tooltip" data-placement="top" title="'+resp[i].favorite_destination+'"> Show More</a></p>';

                        }else if(resp[i].favorite_destination!=''){

                            res += '<p><strong class="text-blue">Travel Destination:</strong> '+resp[i].favorite_destination+'</p>';

                        }
                        else{

                            

                        }
                        
                        
                        res += '</div> </div> </div>';
                    }

                    $('#Supportstafflist').html(res);
                }
                else
                {
                    $('#Supportstafflist').html('<div class="clearfix text-center"><img src="'+base_url+'assets/images/nodata.jpg" class="img-responsive m-auto" ></div>');
                
                }
            }
        });
    }


</script>
