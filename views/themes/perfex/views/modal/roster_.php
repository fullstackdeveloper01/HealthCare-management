<div role="tabpanel" class="tab-pane" id="Roster">
    <div class="text-right">
        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#rosterModal">Add Roster</a>
    </div>
    <div class="table-responsive mt-2">
        <table class="table table-custom" data-order-col="0" data-order-type="asc" id='rosterList'>
            <thead>
                <th class="th-ticket-number nowrap">Start Date</th>
                <th class="th-ticket-subject nowrap">End Date</th>
                <th class="th-ticket-subject nowrap">Time Slot</th>
                <th class="th-ticket-subject nowrap">Status</th>
                <th class="th-ticket-subject nowrap">Action</th>
            </thead>
            <tbody>
            </tbody>
        </table>
        <!-- Paginate -->
        <div id='pasinationroster'></div>
    </div>
</div>

<!--Add update -->
<!-- Modal -->
<div class="modal fade" id="rosterModal" tabindex="-1" role="dialog" aria-labelledby="rosterModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="rosterModalLabel">Roster - <span class="clients_name"></span></h4>
            </div>
            <div class="modal-body">
                <?php
                  $tbltimeslot = $this->db->select('time_text')->get_where('tbltimeslot')->result();
                ?>
                <?php echo form_open_multipart('clients/createRoster',array('id'=>'createRoster', 'class' => 'form-horizontal')); ?>
                    <div class="form-group">
                        <label for="inputTitle" class="col-sm-2 control-label">Start Date</label>
                        <div class="col-sm-10">
                            <input type="text" name="end_date" required class="form-control" id="start_date" />
                            <input type="text" name="clientid" required class="form-control clientid hide" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Upload</label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" autocomplete="off" value="<?= $article->end_date; ?>" name="end_date" id="end_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="roster" class="col-sm-2 control-label">roster Number</label>
                        <div class="col-sm-10">
                            <input type="text" name="roster_no" required class="form-control" id="roster_no" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Date" class="col-sm-2 control-label">Date</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control datepicker" name="roster_date" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Total_Amount" class="col-sm-2 control-label">Total Amount</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="total_amount" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Status" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control selectpicker" data-live-search="true" name="status">
                              <option value=""></option>
                              <option value="UNPAID">UNPAID</option>
                              <option value="PAID">PAID</option>                                                 
                           </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editrosterModal" tabindex="-1" role="dialog" aria-labelledby="rosterModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="rosterModalLabel">roster Update - <span class="clients_name"></span></h4>
            </div>
            <div class="modal-body Rostere_">
                
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
   $(document).ready(function(){

     // Detect pasinationroster click
     $('#pasinationroster').on('click','a',function(e){
       e.preventDefault(); 
       var pageno = $(this).attr('data-ci-pasinationroster-page');
       loadpasinationroster(pageno);
     });

     loadpasinationroster(0);

     // Load pasinationroster
     function loadpasinationroster(pagno){
       $.ajax({
         url: '<?=base_url()?>clients/loadRecordRoster/'+pagno,
         type: 'get',
         dataType: 'json',
         success: function(response){
            $('#pasinationroster').html(response.pasinationroster);
            createTableroster(response.result,response.row);
         }
       });
     }

     // Create table list
     function createTableroster(result,sno){
       sno = Number(sno);
       $('#rosterList tbody').empty();
       for(index in result){
          var tr = "<tr id='careid"+id+"'>";
          tr += '<td>'+result[index].start_date+'</td>';
          tr += '<td>'+result[index].end_date+'</td>';
          tr += '<td>'+result[index].time_slot+'</td>';
          tr += '<td>'+result[index].description+'</td>';  
          tr += "<td><button type='button' data-toggle='modal' data-target='#editrosterModal' onClick='editRoster("+id+")' title='Edit' ><i class='fa fa-edit text-success'></i></button>&nbsp;&nbsp;<button type='button' onClick='removeRoster("+id+")' title='Remove' ><i class='fa fa-trash text-danger'></i></button></td>";
          tr += "</tr>";
          $('#rosterList tbody').append(tr);
 
        }
      }
    });
    
    window.addEventListener('load',function(){
           appValidateForm($('#createRoster'), {
            start_date: 'required',
            end_date: 'required',
            time_slot: 'required'
        }, createRoster_form);
    });
    function createRoster_form(form) {
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
                loadpasinationroster(0);
            }
        });
        return false;
    }

    $('#rosterModal').on('hidden.bs.modal', function (e) {        
        $('#createRoster')[0].reset();  
        var clientid = '<?= $client_data->userid; ?>';
        $('.clientid').val(clientid);     
    })

    function removeRoster(id)
    {
        var r = confirm("Are you sure want to delete?");
        if (r == true) {
            $.ajax({
                url: '<?=base_url()?>clients/removeRoster/'+id,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    $('#careid'+id).empty();
                    successmsg('Remove successfully');
                }
           });
        }
    }

    function editRoster(careid)
    {
        $.ajax({
            url: '<?=base_url()?>clients/editRoster/'+careid,
            type: 'get',
            success: function(response){
                $('.Rostere_').html(response);
            }
       });
    }

    $(document).ready(function(){
        $("#start_date").datepicker({
            minDate:0,
            dateFormat: 'yy-mm-dd',
            onSelect: function(selected) {
              $("#end_date").datepicker("option","minDate", selected)
            }
        });
        $("#end_date").datepicker({ 
            minDate:0,
            dateFormat: 'yy-mm-dd',
            onSelect: function(selected) {
               $("#start_date").datepicker("option","maxDate", selected)
            }
        });  
    });

</script>