<style>
    .invoice_status{
    position: relative;
}
.invoice_status p{
    position: absolute;
    bottom: -23px;
    left: 28%;
}
.mt-40{margin-top:40px;}
</style>
<div role="tabpanel" class="tab-pane" id="Invoices">
    <div class="text-right">
        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#invoiceModal">Add Invoice</a>
    </div>
    <div class="table-responsive mt-2">
        <table class="table table-custom" data-order-col="0" data-order-type="asc" id='invoice_list' style="width:100%">
            <thead>
                <th class="th-ticket-number">Title</th>
                <th class="th-ticket-subject">Invoice Number</th>
                <th class="th-ticket-subject">Date</th>
                <th class="th-ticket-subject">Total Amount</th>
                <th class="th-ticket-subject">Invoice</th>
                <th class="th-ticket-subject">By</th>
                <th class="th-ticket-subject">Status</th>
                <th class="th-ticket-subject">Action</th>
            </thead>
            <tbody>
            </tbody>
        </table>
        <!-- Paginate -->
        <div id='pasinationInvoice'></div>
    </div>
</div>

<!--Add update -->
<!-- Modal -->
<div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="invoiceModalLabel">Invoice - <span class="clients_name"></span></h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('clients/createinvoicesSection',array('id'=>'createinvoicesSection', 'class' => 'form-horizontal')); ?>
                    <div class="form-group">
                        <label for="inputTitle" class="col-sm-3 control-label">Title</label>
                        <div class="col-sm-9">
                            <input type="text" name="title" required class="form-control" id="inputTitle" />
                            <input type="text" name="client_id" id="client_id" value ="<?php echo $client_data->userid; ?>" required class="form-control clientid hide" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Upload</label>
                        <div class="col-sm-9">
                            <input type="file" extension="pdf" accept=".pdf" name="invoice" required class="form-control" id="inputUpload3" placeholder="Upload" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Invoice" class="col-sm-3 control-label">Invoice Number</label>
                        <div class="col-sm-9">
                            <input type="text" name="invoice_no" required class="form-control" id="invoice_no" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Date" class="col-sm-3 control-label">Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" readonly name="invoice_date"  id="invoice_date" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Total_Amount" class="col-sm-3 control-label">Total Amount</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="total_amount" required>
                        </div>
                    </div>
                    <div class="form-group invoice_status">
                        <label for="Status" class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-9">
                            <select class="form-control selectpicker" data-live-search="true" name="status" id="status">
                              <option value=""></option>
                              <option value="UNPAID">UNPAID</option>
                              <option value="PAID">PAID</option>                                                 
                           </select>
                        </div>
                    </div>
                    <div class="form-group mt-40">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editinvoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="invoiceModalLabel">Invoice Update - <span class="clients_name"></span></h4>
            </div>
            <div class="modal-body invoicesSectione_">
                
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
   /*$(document).ready(function(){

     // Detect pasinationInvoice click
     $('#pasinationInvoice').on('click','a',function(e){
       e.preventDefault(); 
       var pageno = $(this).attr('data-ci-pasinationInvoice-page');
       loadpasinationInvoice(pageno);
     });

     loadpasinationInvoice(0);

     // Load pasinationInvoice
     function loadpasinationInvoice(pagno){
       $.ajax({
         url: '<?=base_url()?>clients/loadRecordInvoice/'+pagno,
         type: 'get',
         dataType: 'json',
         success: function(response){
            $('#pasinationInvoice').html(response.pasinationInvoice);
            createTableInvoice(response.result,response.row);
         }
       });
     }

     // Create table list
     function createTableInvoice(result,sno){
       sno = Number(sno);
       $('#invoiceList tbody').empty();
       for(index in result){
          var id = result[index].id;
          var title = result[index].title;
          var content = result[index].created_date;
          var link = '<?= base_url()?>uploads/invoice/'+id+'/'+result[index].file_name;
          sno+=1;

          var tr = "<tr id='careid"+id+"'>";
          tr += '<td>'+result[index].title+'</td>';
          tr += '<td>'+result[index].invoice_no+'</td>';
          tr += '<td>'+result[index].invoice_date+'</td>';
          tr += '<td>'+result[index].total_amount+'</td>';
          tr += "<td class='care-plan'><img src='http://html.manageprojects.in/caring-approach/assets/images/pdf.svg' alt='Avatar' class='rounded mr-1' /><a href='"+ link +"' target='_blank' >"+ title +"</a></td>";
          tr += '<td>'+result[index].status+'</td>';
          tr += "<td><button type='button' data-toggle='modal' data-target='#editinvoiceModal' onClick='editinvoicesSection("+id+")' title='Edit' ><i class='fa fa-edit text-success'></i></button>&nbsp;&nbsp;<button type='button' onClick='removeinvoicesSection("+id+")' title='Remove' ><i class='fa fa-trash text-danger'></i></button></td>";
          tr += "</tr>";
          $('#invoiceList tbody').append(tr);
 
        }
      }
    });
    */
    $(document).ready(function() {
        invoice_table = $('#invoice_list').DataTable({ 
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' servermside processing mode.
            "order": [], //Initial no order.
            "ordering": false,
            "searching": false,
            "ajax": {
                "url": "<?php echo base_url('clients/loadInvoiceData')?>",
                "type": "POST",
                "dataType": "json",
                "data":{},
                "data": function ( data ) {
                  data.filter_by = {'client_id':<?php echo $this->uri->segment(3); ?>};
                },
                "dataSrc": function (jsonData) {
                  return jsonData.data;
                }
            },
        });
    });

    $(document).ready(function() {
        $("#invoice_date").datetimepicker({
            // minDate: 0,
                    timepicker:false,
                    format: 'd-m-Y',
            onSelect: function(selected) {
                $("#invoice_date").datetimepicker("option", "minDate", selected)
            }
        });
    });



    window.addEventListener('load',function(){
           appValidateForm($('#createinvoicesSection'), {
            title: 'required',
            status: 'required',
            invoice_no: 'required',
            invoice_date: 'required',
            total_amount: 'required',
            invoice:{required:true,extension: 'pdf'}
        }, createinvoicesSection_form);
    });

    function getInvoice()
    {
      $('#createinvoicesSection').validate().resetForm();
      invoice_table.ajax.reload(); 

    }

    function createinvoicesSection_form(form) {
        var formURL = form.action;
        var formData = new FormData($(form)[0]);
     jQuery('#createinvoicesSection').find('button[type="submit"]').prop("disabled",true);
        $.ajax({
            type: $(form).attr('method'),
            data: formData,
            mimeType: $(form).attr('enctype'),
            contentType: false,
            cache: false,
            processData: false,
            url: formURL
        }).done(function(response) {
            response = JSON.parse(response);
            if (response.success == true) {
                successmsg(response.message);
                $('.close').click();
                $('#createinvoicesSection').validate().resetForm();
                invoice_table.ajax.reload();  
            }else{
            //   errormsg(response.message);
               jQuery('#createinvoicesSection').find('button[type="submit"]').prop("disabled",false);
            }
        });
        return false;
    }

    function invoicesUpdate_form(form) {
        var formURL = form.action;
        var formData = new FormData($(form)[0]);
    
        $.ajax({
            type: $(form).attr('method'),
            data: formData,
            mimeType: $(form).attr('enctype'),
            contentType: false,
            cache: false,
            processData: false,
            url: formURL
        }).done(function(response) {
            response = JSON.parse(response);
            if (response.success == true) {
                successmsg(response.message);
                $('.close').click();
                $('#createinvoicesSection').validate().resetForm();
                invoice_table.ajax.reload();  
            }else{
               errormsg(response.message);
            }
        });
        return false;
    }

    $('#invoiceModal').on('hidden.bs.modal', function (e) {        
        $('#createinvoicesSection')[0].reset();  
        $('#createinvoicesSection').validate().resetForm();
        // var client_id = '<?= $client_data->userid; ?>';
        // $('.client_id').val(client_id);     
        // $('#client_id').val(client_id);     
    })

    function removeinvoicesSection(id)
    {
        var r = confirm("Are you sure want to delete?");
        if (r == true) {
            $.ajax({
                url: '<?=base_url()?>clients/removeinvoicesSection/'+id,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    $('#careid'+id).empty();
                    successmsg('Remove successfully');
                    invoice_table.ajax.reload();
                }
           });
        }
    }

    function editinvoicesSection(careid)
    {
        $.ajax({
            url: '<?=base_url()?>clients/editinvoicesSection/'+careid,
            type: 'get',
            success: function(response){
              $('.invoicesSectione_').html(response);
              $("#invoice_date_update").datetimepicker({
                    
                    timepicker:false,
                    format: 'd-m-Y',
                    onSelect: function(selected) {
                        $("#invoice_date_update").datetimepicker("option", "minDate", selected)
                    }
                });
              appValidateForm($('#updateInvoices'), {
                  title: 'required',
                  status: 'required',
                  invoice:{extension: 'pdf'}
              }, invoicesUpdate_form);
            }
       });
    }

    function changeInvoiceStatus(id, status)
    {
      var r = confirm("Are you sure want to change this?");
      if (r == true) {
          $.ajax({
              url: '<?=base_url()?>clients/changeInvoiceStatus/'+id+'/'+status,
              type: 'get',
              dataType: 'json',
              success: function(response){
                successmsg('Status change successfully');
                invoice_table.ajax.reload();
              }
         });
      }
    }
</script>