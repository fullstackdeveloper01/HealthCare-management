<div role="tabpanel" class="tab-pane" id="Review">
    <div class="row" id="Reviewlist">

    </div>
</div>




<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script type='text/javascript'>
    var base_url = '<?php echo base_url();?>';
    $(document).ready(function() {
        $.ajax({
           "url": "<?php echo base_url('clients/loadClientReviewData')?>",
            type: 'POST',
            data: {client_id:<?php echo $this->uri->segment(3); ?>},
            datatype: 'json',
            cache: false,
            success: function(resp_){
                var respcheck1 = JSON.parse(resp_);
                if(respcheck1!=false)
                {
                    // console.log(resp_);
                    var resp = JSON.parse(resp_);
                    var res = '';
                    for(var i=0; i<resp.length; i++)
                    {
                        res += '<div class="review">';
                        if(resp[i].imgexist==1)
                        {
                            res += '<div class="review-photo">';
                            res += resp[i].img;
                            res += '</>';
                        }
                        if(resp[i].imgexist==0)
                        {
                            var style = '<?php echo mt_rand( 0, 0xFFFFFF ); ?>';
                             res += '<div class="review-photo stafimginidiv">';
                            res += '<a class="stafimgini"  style="background: #'+style+'" > '+resp[i].fn+' '+resp[i].ln+' </a>';
                           
                        }
                        res += '</div><div class="review-box"><div class="review-author">';
                        res += '<p><strong>'+resp[i].name+'</strong>-';
                        for ($i=1; $i <=5 ; $i++)
                        { 
                            if($i<=resp[i].star)
                            { 
                                res += '<i class="fa fa-star text-warning"></i>';
                            }
                            else
                            {
                                res += '<i class="fa fa-star"></i>';
                            }
                        }
                        res += '</p></div><div class="review-comment"><h4 class="text-black">'+resp[i].title+'</h4>';
                        res += '<p>'+resp[i].review+'</p></div><div class="review-date">';
                        res += '<time>'+resp[i].created_date+'</time></div>';
                        res += '</div> </div> </div>';
                    }

                    $('#Reviewlist').html(res);
                }
                else
                {
                    $('#Reviewlist').html('<div class="clearfix text-center"><img src="'+base_url+'assets/images/nodata.jpg" class="img-responsive m-auto" ></div>');
                }
            }
        });


    });


    function getReview()
    {
      $.ajax({
           "url": "<?php echo base_url('clients/loadClientReviewData')?>",
            type: 'POST',
            data: {client_id:<?php echo $this->uri->segment(3); ?>},
            datatype: 'json',
            cache: false,
            success: function(resp_){
                var respcheck1 = JSON.parse(resp_);
                if(respcheck1!=false)
                {
                    // console.log(resp_);
                    var resp = JSON.parse(resp_);
                    var res = '';
                    for(var i=0; i<resp.length; i++)
                    {
                        res += '<div class="review">';
                        if(resp[i].imgexist==1)
                        {
                            res += '<div class="review-photo">';
                            res += resp[i].img;
                            res += '</>';
                        }
                        if(resp[i].imgexist==0)
                        {
                            var style = '<?php echo mt_rand( 0, 0xFFFFFF ); ?>';
                             res += '<div class="review-photo stafimginidiv" style="background: #'+style+'" >';
                            res += '<a class="stafimgini"> '+resp[i].fn+' '+resp[i].ln+' </a>';
                           
                        }
                        res += '</div><div class="review-box"><div class="review-author">';
                        res += '<p><strong>'+resp[i].name+'</strong>-';
                        for ($i=1; $i <=5 ; $i++)
                        { 
                            if($i<=resp[i].star)
                            { 
                                res += '<i class="fa fa-star text-warning"></i>';
                            }
                            else
                            {
                                res += '<i class="fa fa-star"></i>';
                            }
                        }
                        res += '</p></div><div class="review-comment"><h4 class="text-black">'+resp[i].title+'</h4>';
                        res += '<p>'+resp[i].review+'</p></div><div class="review-date">';
                        res += '<time>'+resp[i].created_date+'</time></div>';
                        res += '</div> </div> </div>';
                    }

                    $('#Reviewlist').html(res);
                }
                else
                {
                    
                    $('#Reviewlist').html('<div class="clearfix text-center"><img src="'+base_url+'assets/images/nodata.jpg" class="img-responsive m-auto" ></div>');
                }
            }
        });
    }


</script>
