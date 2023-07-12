<div role="tabpanel" class="tab-pane" id="Roster">
    <?php
        if(get_user_id_role()==3)
        {
    ?>
    <div class="text-right">
        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#rosterModal">Add Roster</a>
    </div>
    <?php
        }
    ?>
    <div class="table-responsive mt-2">
        <table class="table table-custom" data-order-col="0" data-order-type="asc" id='roster_List' style="width:100%">
            <thead>
                <?php
                    if(get_user_id_role()==3)
                    {
                ?>
                <th class="not">Staff</th>
                <?php
                    }
                ?>
                <th>Type Of Service</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Time Slot</th>
                <th>Description</th>
                <?php
                    if(get_user_id_role()==3)
                    {
                ?>
                <th>Action</th>
                <?php
                    }
                ?>
            </thead>
            <tbody>
            </tbody>
        </table>
        <!-- Paginate -->
        <div id='pagination'></div>
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
                <!-- <span class="btn btn-info pull-right" style="cursor:pointer;" onClick="addMoreRoster()"><i class="fa fa-plus"></i> Add More</span> -->
            </div>
            <div class="modal-body">
                <?php
                $tbltimeslot = $this->db->select('*')->get_where('tbltimeslot')->result();
                $staff_res = $this->db->get_where('tblcontacts', array('role' => '1', 'active' => '1'))->result();
                 $service_res = $this->db->get_where('tblservice_type', array('active' => '1'))->result();

                ?>
                <?php echo form_open_multipart('clients/createRoster', array('id' => 'createRoster', 'class' => 'form-horizontal')); ?>
                <div class="row">
                    <div class="col-md-12">
                        <label for="Date" class="col-sm-3 control-label">Staff</label>
                        <div class="col-sm-9 form-group">
                            <select class="form-control selectpicker" required name="staff_id[]" id="staff_id" data-live-search="true" multiple>
                                <?php
                                if ($staff_res) {
                                    foreach ($staff_res as $st_val) {
                                ?>
                                        <option value="<?= $st_val->userid; ?>"><?= $st_val->firstname . ' ' . $st_val->lastname; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="Date" class="col-sm-3 control-label">Type of service</label>
                          <div class="col-sm-9 form-group">

                            <select class="form-control" required name="service_id" id="service_id">
                                <?php
                                if ($service_res) {
                                    foreach ($service_res as $rrr) {
                                ?>
                                        <option data-value="<?= $rrr->id; ?>" value="<?= $rrr->id; ?>"><?= $rrr->name; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="inputTitle" class="col-sm-3 control-label">Start Date</label>
                        <div class="col-sm-9  form-group">
                            <input type="text" autocomplete="off" readonly name="start_date" required class="form-control" id="start_date" />
                            <input type="text" name="clientid" value="<?php echo $client_data->userid; ?>" required class="form-control clientid hide" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="roster" class="col-sm-3 control-label">End Date</label>
                        <div class="col-sm-9 form-group">
                            <input type="text" autocomplete="off" readonly name="end_date" required class="form-control" id="end_date" />
                        </div>
                    </div>
                </div>

                    <div class="clearfix">
                        <label for="Date" class="col-sm-3 control-label">Start Time</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <select class="form-control selectpicker" name="start_time" id="start_time" data-live-search="true" onchange="getEndTimeRoaster(this.value);">
                                        <option value=""></option>
                                        <?php
                                        if ($tbltimeslot) {
                                            foreach ($tbltimeslot as $rrr) {
                                        ?>
                                                <option data-value="<?= $rrr->id; ?>" value="<?= $rrr->time_from; ?>"><?= $rrr->time_from; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                <div class="row">
                    <div class="col-md-12">
                        <label for="Date" class="col-sm-3 control-label">End Time</label>
                        <div class="col-sm-9 form-group endlistsroaster" id="endlistsroaster">
                            <input type="text" autocomplete="off" name="end_time" required disabled placeholder="Please Select Start Time" class="form-control" id="end_time" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="Total_Amount" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9 form-group">
                            <textarea class="form-control" rows="3" required name="description"></textarea>
                        </div>
                    </div>
                </div>


                <div class="moreroster"></div>
                <hr class="hr-panel-heading" />
                <div class="row">
                    <div class="col-md-12 form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
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
                <h4 class="modal-title" id="rosterModalLabel">Roster Update - <span class="clients_name"></span></h4>
            </div>
            <div class="modal-body Rostere_">

            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script type='text/javascript'>
    $(document).ready(function() {
        roster_table = $('#roster_List').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' servermside processing mode.
            "order": [], //Initial no order.
            "ordering": false,
            "searching": false,
            "oLanguage": {
                "sEmptyTable": "No Roaster added yet!!"
            },
            "ajax": {
                "url": "<?php echo base_url('clients/loadRosterData') ?>",
                "type": "POST",
                "dataType": "json",
                "data": {},
                "data": function(data) {
                    data.filter_by = {
                        'client_id': <?php echo $this->uri->segment(3); ?>
                    };
                },
                "dataSrc": function(jsonData) {
                    return jsonData.data;
                }
            },
        });
    });

    function getRoaster() {
        $('#createRoster').validate().resetForm();
        $('#endlistsroaster').html('<input type="text" autocomplete="off" name="end_time" required disabled placeholder="Please Select Start Time" class="form-control" id="end_time" />');

        roster_table.ajax.reload();
    }
    window.addEventListener('load', function() {
        appValidateForm($('#createRoster'), {
            start_date: 'required',
            end_date: 'required',
            end_time: 'required',
            start_time: 'required',
            staff_id: 'required'
        }, createRoster_form);
    });

    function createRoster_form(form) {
        // console.log('ali')
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
            // console.log(response);
            response = JSON.parse(response);
            if (response.success == true) {
                successmsg(response.message);
                $('.close').click();
                $('#createRoster').validate().resetForm();
                $('#endlistsroaster').html('<input type="text" autocomplete="off" name="end_time" required disabled placeholder="Please Select Start Time" class="form-control" id="end_time" />');
                // loadpasinationroster(0);
                roster_table.ajax.reload();
            }
        });
        return false;
    }

    function updateRoster_form(form) {
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

                $('#createRoster').validate().resetForm();
                $('#endlistsroaster').html('<input type="text" autocomplete="off" name="end_time" required disabled placeholder="Please Select Start Time" class="form-control" id="end_time" />');
                // loadpasinationroster(0);
                roster_table.ajax.reload();
            }
        });
        return false;
    }

    $('#rosterModal').on('hidden.bs.modal', function(e) {
        $('#createRoster')[0].reset();
        $('#createRoster').validate().resetForm();
        $('#endlistsroaster').html('<input type="text" autocomplete="off" name="end_time" required disabled placeholder="Please Select Start Time" class="form-control" id="end_time" />');
        // var clientid = '<?= $client_data->userid; ?>';
        // $('.clientid').val(clientid);  
        $('.selectpicker').selectpicker('refresh');
    })

    function removeRoster(id) {
        var r = confirm("Are you sure want to delete?");
        if (r == true) {
            $.ajax({
                url: '<?= base_url() ?>clients/removeRoster/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#careid' + id).empty();
                    successmsg('Remove successfully');
                    roster_table.ajax.reload();
                }
            });
        }
    }

    function editRoster(careid) {
        $.ajax({
            url: '<?= base_url() ?>clients/editRoster/' + careid,
            type: 'get',
            success: function(response) {
                $('.Rostere_').html(response);

                $('#endlistsroaster').html('<input type="text" autocomplete="off" name="end_time" required disabled placeholder="Please Select Start Time" class="form-control" id="end_time" />');
                $('#staff_id_edit').selectpicker('refresh');
                
                $('#service_id_edit').selectpicker('refresh');
                $('#start_time_edit').selectpicker('refresh');
                $('#end_time_edit').selectpicker('refresh');
                $('#createRoster').validate().resetForm();
                $('#endlistsroaster').html('<input type="text" autocomplete="off" name="end_time" required disabled placeholder="Please Select Start Time" class="form-control" id="end_time" />');
                // $("#start_date_update").datetimepicker({
                //     minDate: 0,
                //     timepicker:false,
                //     format: 'd-m-Y',
                //     onSelect: function(selected) {
                //         $("#end_date_update").datetimepicker("option", "minDate", selected)
                //     }
                // });
                // $("#end_date_update").datetimepicker({
                //     minDate: 0,
                //     timepicker:false,
                //     format: 'd-m-Y',
                //     onSelect: function(selected) {
                //         $("#start_date_update").datetimepicker("option", "maxDate", selected)
                //     }
                // });
                $("#start_date_update").datepicker({
                minDate:0,
                dateFormat: 'yy-mm-dd',
                onSelect: function(selected) {
                  $("#end_date_update").datepicker("option","minDate", selected)
                }
            });
            $("#end_date_update").datepicker({ 
                minDate:0,
                dateFormat: 'yy-mm-dd',
                onSelect: function(selected) {
                   $("#start_date_update").datepicker("option","maxDate", selected)
                }
            });  

                appValidateForm($('#createRosterUpdate'), {
                    start_date: 'required',
                    end_date: 'required'
                }, updateRoster_form);
            }
        });
    }

    $(document).ready(function() {
        // $("#start_date").datetimepicker({
        //     minDate: 0,
        //             timepicker:false,
        //             format: 'd-m-Y',
        //     onSelect: function(selected) {
        //         $("#end_date").datetimepicker("option", "minDate", selected)
        //     }
        // });
        // $("#end_date").datetimepicker({
        //     minDate: 0,
        //             timepicker:false,
        //             format: 'd-m-Y',
        //     onSelect: function(selected) {
        //         $("#start_date").datetimepicker("option", "maxDate", selected)
        //     }
        // });
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

    function Compare() {
        var strStartTime = document.getElementById("txtStartTime").value;
        var strEndTime = document.getElementById("txtEndTime").value;

        var startTime = new Date().setHours(GetHours(strStartTime), GetMinutes(strStartTime), 0);
        var endTime = new Date(startTime)
        endTime = endTime.setHours(GetHours(strEndTime), GetMinutes(strEndTime), 0);
        if (startTime > endTime) {
            alert("Start Time is greater than end time");
        }
        if (startTime == endTime) {
            alert("Start Time equals end time");
        }
        if (startTime < endTime) {
            alert("Start Time is less than end time");
        }
    }


    function Comparetimelsot() {
        var start_time = $("#start_time").val();
        //end time
        var end_time = $("#end_time").val();

        //convert both time into timestamp
        var stt = new Date("November 13, 2013 " + start_time);
        stt = stt.getTime();

        var endt = new Date("November 13, 2013 " + end_time);
        endt = endt.getTime();

        //by this you can see time stamp value in console via firebug
        console.log("Time1: " + stt + " Time2: " + endt);

        if (stt > endt) {
            $("#start_time").after('<span class="error"><br>Start-time must be smaller then End-time.</span>');
            $("#end_time").after('<span class="error"><br>End-time must be bigger then Start-time.</span>');
            return false;
        }
    }




    function getEndTimeRoaster(time_from) {
        // console.log(time_from);

        // $('.endlists').html('<option value="">Please wait...</option>');
        var str = "time_from=" + time_from + "&" + csrfData['token_name'] + "=" + csrfData['hash'];
        $.ajax({
            url: '<?= base_url() ?>clients/getEndTimeRoaster',
            type: 'POST',
            data: str,
            datatype: 'json',
            cache: false,
            success: function(resp_) {
                if (resp_) {
                    var resp = JSON.parse(resp_);
                    // console.log(resp.length);
                    if (resp.length != 0) {
                        // $('#end_timesadassada').selectpicker('refresh');
                        var res = '<select class="form-control selectpicker end_timesadassada" name="end_time" required id="end_timesadassada" >';

                        for (var i = 0; i < resp.length; i++) {
                            res += '<option data-value="' + resp[i].id + '" value="' + resp[i].time_from + '">' + resp[i].time_from + '</option>';
                        }
                        res += '</select>';
                        $('.endlistsroaster').html(res);
                         $('.end_timesadassada').selectpicker('refresh');

                    } else {
                        $('.endlistsroaster').html('<input type="text" autocomplete="off" name="end_time" required disabled placeholder="There Is No End Time Found" class="form-control" id="end_time" />');

                    }

                    // $('#staten').selectpicker('refresh');
                } else {
                    $('.endlistsroaster').html('<input type="text" autocomplete="off" name="end_time" required disabled placeholder="There Is No End Time Found" class="form-control" id="end_time" />');
                    // $('#staten').selectpicker('refresh');
                }
            }
        });
    }
</script>