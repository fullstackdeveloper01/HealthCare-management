<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
		    <div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
						<h4 class="customer-profile-group-heading"><?= _l($title); ?></h4>
    				    <?= form_open_multipart(admin_url('invoice/add/'.$article->id), array('id' => 'invoiceForm'));  ?>
        					<div class="row">
    					       <div class="col-md-5 form-group">
        					       <?= _l('Client Name'); ?><span class="text-danger">*</span>
        					       <select class="form-control selectpicker" data-live-search="true" name="client_id">
        					           <option value=""></option>
        					           <?php
        					                if($clients_list)
        					                {
        					                    foreach($clients_list as $r)
        					                    {
        					                        ?>
        					                            <option value="<?= $r->userid; ?>" <?= ($article->client_id == $r->userid)?"selected":""; ?>><?= $r->firstname.' '.$r->lastname; ?></option>
        					                        <?php
        					                    }
        					                }
        					           ?>
        					       </select>
        					   </div>
        					   <?php
        					        if(isset($article))
        					        {
        					            $filename = $this->db->get_where(db_prefix().'files', array('rel_id' => $article->id, 'rel_type' => 'invoice'))->row('file_name');
        					            ?>
        					               <div class="col-md-2 form-group">
                    					       <?= _l('Select Invoice'); ?>
                    					       <a href="<?= base_url('uploads/invoice/'.$article->id.'/'.$filename); ?>" target="_blank"><?= $filename; ?></a>
                    					   </div> 
        					            <?php
        					        }
        					   ?>
    					       <div class="col-md-3 form-group">
        					       <?= _l('Invoice Upload'); ?><span class="text-danger">*</span><sup>[Only 'PDF']</sup>
        					       <input type="file" class="form-control" name="invoice">
        					   </div>
    					    </div>
    					    <div class="row">
    					       <div class="col-md-5 form-group">
        					       <?= _l('Title'); ?><span class="text-danger">*</span>
        					       <input type="text" class="form-control" maxlength="35" name="title" required value="<?= (isset($article)?$article->title:""); ?>">
        					   </div>
    					       <div class="col-md-5 form-group">
        					       <?= _l('Invoice Number'); ?><span class="text-danger">*</span>
        					       <input type="text" class="form-control" name="invoice_no" required value="<?= (isset($article)?$article->invoice_no:""); ?>">
								   <span id="invoice_no-error"></span>
        					   </div>
    					    </div>
    					    <div class="row">
    					       <div class="col-md-5 form-group">
        					       <?= _l('Date'); ?><span class="text-danger">*</span>
        					       <input type="text" class="form-control datepicker" name="invoice_date" required value="<?= (isset($article)?$article->invoice_date:""); ?>">
        					   </div>
    					       <div class="col-md-5 form-group">
        					       <?= _l('Total Amount'); ?><span class="text-danger">*</span>
        					       <input type="text" class="form-control" name="total_amount" required value="<?= (isset($article)?$article->total_amount:""); ?>">
        					   </div>
    					    </div>
                            <div class="row">
                               <div class="col-md-5 form-group">
                                   <?= _l('Status'); ?><span class="text-danger">*</span>
                                   <select class="form-control selectpicker" data-live-search="true" name="status">
                                       <option value=""></option>
                                        <option value="UNPAID" <?= ($article->status == 'UNPAID')?"selected":""; ?>>UNPAID</option>
                                        <option value="PAID" <?= ($article->status == 'PAID')?"selected":""; ?>>PAID</option>
                                                   
                                                
                                   </select>
                               </div>
                               
                            </div>
    					    <hr class="hr-panel-heading" />
    					    <div class="row">
        					   <div class="col-md-6 form-group">
        					       <button type="submit" class="btn btn-success">Save</button>
        					       <a href="<?= admin_url('invoice')?>" class="btn btn-warning">Cancel</a>
        					   </div>
        				    </div>
        				</form>
        			</div>
    			</div>
			</div>
		</div>
	</div>
</div>

<?php init_tail(); ?>
    <script>
		initDataTable('.table-invoice', window.location.href, [1], [1]);
	</script>
	
	<script>
        $(function(){
            <?php
                if(isset($article))
                {
                    ?>
                        appValidateForm($('#invoiceForm'),{invoice:{extension: "pdf,PDF"},client_id:'required',title:'required',invoice_no:'required',invoice_date:'required'});
                    <?php
                }
                else
                {
                    ?>
                        appValidateForm($('#invoiceForm'),{invoice:{required:true,extension: "pdf,PDF"},client_id:'required',title:'required',invoice_no:'required',invoice_date:'required'});
                    <?php
                }
            ?>
        });
	</script>
	<script>
	$(document).ready(function(){
		$('input[name="invoice_no"]').keyup(function(){
			var invoice =($(this).val());
			$.ajax({
            url: '<?= admin_url()?>invoice/checkInvoice',
            type: 'POST',
            data: {'invoice_no':invoice},
            datatype: 'json',
            cache: false,
            success: function(resp_){
				console.log(resp_)
                if(resp_ == 0){
					$('#invoice_no-error').text('Valid Invoice number');
					$('#invoice_no-error').css('color','green')
					$('.btn-success').attr('type','submit')
				}else{
					$('#invoice_no-error').text('Invoice number is already exists.');
					$('#invoice_no-error').css('color','red')
					$('.btn-success').attr('type','button')
				}
            }
        });
		})
	})
</script>
</body>
</html>
