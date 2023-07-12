<?php
    $tbltimeslot = $this->db->select('*')->get_where('tbltimeslot')->result();
    $staff_res = $this->db->get_where('tblcontacts', array('role' => '1','active'=>'1'))->result();
    $service_res = $this->db->get_where('tblservice_type', array('active' => '1'))->result();
?>
<?php echo form_open('clients/createRoster/'.$id,array('id'=>'createRosterUpdate', 'class' => 'form-horizontal')); ?>
    
    <div class="form-group">
        <label for="Date" class="col-sm-2 control-label">Staff</label>
        <div class="col-sm-10">
            <select class="form-control selectpicker" name="staff_id" id="staff_id_edit" data-live-search="true">
                <?php
                    if($staff_res)
                    {
                        foreach($staff_res as $st_val)
                        {
                            ?>
                                <option <?php if($careplan->staff_id == $st_val->userid){ echo "selected"; } ?> value="<?= $st_val->userid ; ?>"><?= $st_val->firstname.' '.$st_val->lastname; ?></option>
                            <?php
                        }
                    }
                ?>
            </select>
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
        <label for="roster" class="col-sm-2 control-label">End Date</label>
        <div class="col-sm-10">
            <input type="text" autocomplete="off" name="end_date" readonly required class="form-control" id="end_date_update" value="<?= getDateDMYOnly($careplan->end_date); ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label for="Date" class="col-sm-2 control-label">Start Time</label>
        <div class="col-sm-10">
            <select class="form-control selectpicker" name="start_time" id="start_time_edit" data-live-search="true"  onchange="getEndTimeRoaster(this.value);">
                <option value=""></option>
                <?php
                    $time_slot = explode('-', $careplan->time_slot);
                    if($tbltimeslot)
                    {
                        foreach($tbltimeslot as $rrr)
                        {
                            ?>
                                <option <?php if($careplan->time_from == $rrr->time_from){ echo "selected"; }?> value="<?= $rrr->time_from; ?>"><?= $rrr->time_from; ?></option>
                            <?php
                        }
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="Date" class="col-sm-2 control-label">End Time</label>
        <div class="col-sm-10 endlistsroaster" id="endlistsroaster">
            <input type="text" autocomplete="off" name="end_time" required readonly  value="<?= $careplan->time_to; ?>" class="form-control" id="end_time" />
        </div>
    </div>
    <div class="form-group">
        <label for="Total_Amount" class="col-sm-2 control-label">Description</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="3" name="description"><?= $careplan->description; ?></textarea>
        </div>
    </div>
    <div class="moreroster"></div>
    <hr class="hr-panel-heading" />
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </div>
</form>