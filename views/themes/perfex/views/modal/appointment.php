<div role="tabpanel" class="tab-pane" id="Appointment">
    <div class="text-right">
        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#appointmentModal">Add Appointment</a>
    </div>
    <div class="table-responsive mt-2">
        <table class="table table-custom appointment-table-custom" data-order-col="0" data-order-type="asc" id='appointment_List' style="width:100%">
            <thead>
                <th>Title</th>
                <!-- <th>Type of service</th> -->
                <th>Start Date</th>
                <th>End Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Frequency</th>
                <th>Description</th>
                <th class="th-ticket-subject text-right">Action</th>
            </thead>
            <tbody>
            </tbody>
        </table>
        <!-- Paginate -->
        <div id='pasinationappointment'></div>
    </div>
</div>

<!--Add update -->
<!-- Modal -->
<div class="modal fade" id="appointmentModal" tabindex="-1" role="dialog" aria-labelledby="appointmentModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="appointmentModalLabel">Appointment - <span class="clients_name"></span></h4>
                <!-- <span class="btn btn-info pull-right" style="cursor:pointer;" onClick="addMoreappointment()"><i class="fa fa-plus"></i> Add More</span> -->
            </div>
            <div class="modal-body">
                <?php
                $timeslot = $this->db->select('*')->get_where('tbltimeslot')->result();
                $service_res = $this->db->get_where('tblservice_type', array('active' => '1'))->result();
                ?>
                <?php echo form_open_multipart('clients/createAppointment', array('id' => 'createAppointment', 'class' => 'form-horizontal')); ?>
                <div class="clearfix">
                    <label for="Date" class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="text" class="form-control" required placeholder="Enter Title" name="title" id="title">
                            <input type="text" name="client_id" id="client_id" value="<?php echo $client_data->userid; ?>" required class="form-control clientid hide" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Date" class="col-sm-3 control-label">Type of service</label>
                    <div class="col-sm-9">

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
                <div class="clearfix">
                    <label for="inputTitle" class="col-sm-3 control-label">Start Date</label>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="text" autocomplete="off" name="start_date" readonly required class="form-control" id="start_datee" />
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                    <label for="appointment" class="col-sm-3 control-label">End Date</label>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="text" autocomplete="off" name="end_date" readonly required class="form-control" id="end_datee" />
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                    <label for="Date" class="col-sm-3 control-label">Start Time</label>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <select class="form-control selectpicker" name="start_time" id="start_time" onchange="getEndTime(this.value);">
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
                <div class="clearfix">
                    <label for="Date" class="col-sm-3 control-label">End Time</label>
                    <div class="col-sm-9">
                        <div class="endlists form-group" id="endlists">
                            <input type="text" autocomplete="off" name="end_time" required disabled placeholder="Please Select Start Time" class="form-control" id="end_time" />
                        </div>
                    </div>

                </div>
                <div class="clearfix">
                    <label for="Total_Amount" class="col-sm-3 control-label">Frequency</label>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <select class="form-control" name="frequency" id="frequency" required>
                                <option value="Once a week">Once a week</option>
                                <option value="Fortnight">Fortnight</option>
                                <option value="Monthly">Monthly</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                    <label for="Total_Amount" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" required name="description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="moreappointment"></div>
                <hr class="hr-panel-heading" />
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
<div class="modal fade" id="editappointmentModal" tabindex="-1" role="dialog" aria-labelledby="appointmentModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="AppointmentModalLabel">Appointment Update - <span class="clients_name"></span></h4>
            </div>
            <div class="modal-body Appointmente_">

            </div>
        </div>
    </div>
</div>


<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script type='text/javascript'>
    $(document).ready(function() {
        appointment_table = $('#appointment_List').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' servermside processing mode.
            "order": [], //Initial no order.
            "ordering": false,
            "searching": false,
            "oLanguage": {
                "sEmptyTable": "No appointment added yet!!"
            },
            "ajax": {
                "url": "<?php echo base_url('clients/loadAppointmentData') ?>",
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


    $(document).ready(function() {
        // $("#start_datee").datetimepicker({
        //     minDate: 0,       
        //     timepicker:false,
        //     format: 'd-m-Y',
        //     onSelect: function(selected) {
        //         $("#end_datee").datetimepicker("option", "minDate", selected)
        //     }
        // });
        // $("#end_datee").datetimepicker({
        //     minDate: 0,
        //     timepicker:false,
        //     format: 'd-m-Y',
        //     onSelect: function(selected) {
        //         $("#start_datee").datetimepicker("option", "maxDate", selected)
        //     }
        // });


        $("#start_datee").datepicker({
                minDate:0,
                dateFormat: 'yy-mm-dd',
                onSelect: function(selected) {
                  $("#end_datee").datepicker("option","minDate", selected)
                }
            });
            $("#end_datee").datepicker({ 
                minDate:0,
                dateFormat: 'yy-mm-dd',
                onSelect: function(selected) {
                   $("#start_datee").datepicker("option","maxDate", selected)
                }
            });  

    });


    function getAppointment() {
        $('#createAppointment').validate().resetForm();
        $('#endlists').html('<input type="text" autocomplete="off" name="end_time" required disabled placeholder="Please Select Start Time" class="form-control" id="end_time" />');
        appointment_table.ajax.reload();
    }

    window.addEventListener('load', function() {
        appValidateForm($('#createAppointment'), {
            title: 'required',
            start_date: 'required',
            end_date: 'required',
            end_time: 'required',
            start_time: 'required'
        }, createAppointment_form);
    });

    function createAppointment_form(form) {
        var formURL = form.action;
        var formData = new FormData($(form)[0]);
        console.log('aliakbar');
        $.ajax({
            type: $(form).attr('method'),
            data: formData,
            mimeType: $(form).attr('enctype'),
            contentType: false,
            cache: false,
            processData: false,
            url: formURL
        }).done(function(response) {
            console.log(response);
            response = JSON.parse(response);
            if (response.success == true) {
                successmsg(response.message);
                $('.close').click();
                $('#createAppointment').validate().resetForm();
                $('#endlists').html('<input type="text" autocomplete="off" name="end_time" required disabled placeholder="Please Select Start Time" class="form-control" id="end_time" />');
                // loadpasinationAppointment(0);
                appointment_table.ajax.reload();
            }
        });
        return false;
    }

    function updateAppointment_form(form) {
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
            console.log(response);
            response = JSON.parse(response);
            if (response.success == true) {
                successmsg(response.message);
                $('.close').click();
                $('#createAppointment').validate().resetForm();
                $('#endlists').html('<input type="text" autocomplete="off" name="end_time" required disabled placeholder="Please Select Start Time" class="form-control" id="end_time" />');
                // loadpasinationAppointment(0);
                appointment_table.ajax.reload();
            }
        });
        return false;
    }

    $('#appointmentModal').on('hidden.bs.modal', function(e) {
        $('#createAppointment')[0].reset();
        $('#createAppointment').validate().resetForm();
        $('#endlists').html('<input type="text" autocomplete="off" name="end_time" required disabled placeholder="Please Select Start Time" class="form-control" id="end_time" />');
        // var client_id = '<?= $client_data->userid; ?>';
        // $('.client_id').val(client_id);  
        $('.selectpicker').selectpicker('refresh');
    })

    function removeAppointment(id) {
        var r = confirm("Are you sure want to delete?");
        if (r == true) {
            $.ajax({
                url: '<?= base_url() ?>clients/removeAppointment/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#careid' + id).empty();
                    successmsg('Remove successfully');
                    appointment_table.ajax.reload();
                }
            });
        }
    }

    function editAppointment(careid) {
        $.ajax({
            url: '<?= base_url() ?>clients/editAppointment/' + careid,
            type: 'get',
            success: function(response) {
                $('.Appointmente_').html(response);
                $('#service_id_edit').selectpicker('refresh');
                $('#start_time_edit').selectpicker('refresh');
                $('#end_time_edit').selectpicker('refresh');
                $('#createAppointment').validate().resetForm();
                $('#endlists').html('<input type="text" autocomplete="off" name="end_time" required disabled placeholder="Please Select Start Time" class="form-control" id="end_time" />');
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
                //    format: 'd-m-Y',
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


                appValidateForm($('#createAppointmentUpdate'), {
                    start_date: 'required',
                    end_date: 'required'
                }, updateAppointment_form);
            }
        });
    }


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

    function getEndTime(time_from) {
        // console.log(time_from);

        // $('.endlists').html('<option value="">Please wait...</option>');
        var str = "time_from=" + time_from + "&" + csrfData['token_name'] + "=" + csrfData['hash'];
        $.ajax({
            url: '<?= base_url() ?>clients/getEndTime',
            type: 'POST',
            data: str,
            datatype: 'json',
            cache: false,
            success: function(resp_) {
                if (resp_) {
                    var resp = JSON.parse(resp_);
                    // console.log(resp.length);
                    if (resp.length != 0) {
                        var res = '<select class="form-control selectpicker end_timesadas " name="end_time" required id="end_timesadas" >';
                        for (var i = 0; i < resp.length; i++) {
                            res += '<option data-value="' + resp[i].id + '" value="' + resp[i].time_from + '">' + resp[i].time_from + '</option>';
                        }
                        res += '</select>';
                        $('.endlists').html(res);
                        $('.end_timesadas').selectpicker('refresh');

                    } else {
                        $('.endlists').html('<input type="text" autocomplete="off" name="end_time" required disabled placeholder="There Is No End Time Found" class="form-control" id="end_time" />');

                    }


                } else {
                    $('.endlists').html('<input type="text" autocomplete="off" name="end_time" required disabled placeholder="There Is No End Time Found" class="form-control" id="end_time" />');
                    // $('#staten').selectpicker('refresh');
                }
            }
        });
    }
</script>