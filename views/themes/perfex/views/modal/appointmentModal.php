<?php
    $timeslot = $this->db->select('*')->get_where('tbltimeslot')->result();
    $service_res = $this->db->get_where('tblservice_type', array('active' => '1'))->result();
?>
<?php echo form_open('clients/createAppointment/'.$id,array('id'=>'createAppointmentUpdate', 'class' => 'form-horizontal')); ?>
    
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
           <input type="text" class="form-control"  required  placeholder="Enter Title"  name="title" id="title" value="<?= $careplan->title; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="service" class="col-sm-2 control-label">Type of service</label>
        <div class="col-sm-10">
            <select class="form-control selectpicker" name="service_id" id="service_id_edit" data-live-search="true">
                <?php
                    if($service_res)
                    {
                        foreach($service_res as $st_val)
                        {
                            ?>
                                <option <?php if($careplan->service_id == $st_val->id){ echo "selected"; } ?> value="<?= $st_val->id ; ?>"><?= $st_val->name; ?></option>
                            <?php
                        }
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="inputTitle" class="col-sm-2 control-label">Start Date</label>
        <div class="col-sm-10">
            <input type="text" autocomplete="off" name="start_date" readonly required class="form-control" id="start_date_update" value="<?= getDateDMYOnly($careplan->start_date); ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label for="appointment" class="col-sm-2 control-label">End Date</label>
        <div class="col-sm-10">
            <input type="text" autocomplete="off" name="end_date" readonly required class="form-control" id="end_date_update" value="<?= getDateDMYOnly($careplan->end_date); ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label for="Date" class="col-sm-2 control-label">Start Time</label>
        <div class="col-sm-10">
            <select class="form-control selectpicker" name="start_time" id="start_time_edit"  onchange="getEndTime(this.value);">
                <option value=""></option>
                <?php
                    $time_slot = explode('-', $careplan->start_time);
                    if($timeslot)
                    {
                        foreach($timeslot as $rrr)
                        {
                            ?>
                                <option <?php if($careplan->start_time == $rrr->time_from){ echo "selected"; }?> value="<?= $rrr->time_from; ?>"><?= $rrr->time_from; ?></option>
                            <?php
                        }
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="clearfix">
        <label for="Date" class="col-sm-2 control-label">End Time</label>
        <div class="col-sm-10 endlists form-group" id="endlists">
             <input type="text" autocomplete="off" name="end_time" value="<?= $careplan->end_time; ?>" required readonly  class="form-control" id="end_time" />
        </div>
    </div>
    <div class="form-group">
        <label for="frequency" class="col-sm-2 control-label">Frequency</label>
        <div class="col-sm-10">
            <select class="form-control" name="frequency" id="frequency" required >
                <option value="Once a week" <?php if($careplan->frequency == "Once a week"){ echo "selected"; }?>  >Once a week</option>
                <option value="Fortnight" <?php if($careplan->frequency == "Fortnight"){ echo "selected"; }?>  >Fortnight</option>
                <option value="Monthly" <?php if($careplan->frequency == "Monthly"){ echo "selected"; }?>  >Monthly</option>
            </select> 
        </div>
    </div>
    <div class="form-group">
        <label for="Total_Amount" class="col-sm-2 control-label">Description</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="3" name="description"><?= $careplan->description; ?></textarea>
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