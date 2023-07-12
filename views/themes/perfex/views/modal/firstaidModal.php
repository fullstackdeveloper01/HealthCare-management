
<?php echo form_open('clients/createFirstaid/'.$id,array('id'=>'createFirstaidUpdate', 'class' => 'form-horizontal')); ?>
    
    
    <div class="form-group">
        <label for="inputTitle" class="col-sm-2 control-label">Start Date</label>
        <div class="col-sm-10">
            <input type="text" autocomplete="off" name="firstaid_start_date" readonly required class="form-control" id="firstaid_start_date" value="<?= ($careplan->firstaid_start_date!='')?getDateDMYOnly($careplan->firstaid_start_date):''; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label for="roster" class="col-sm-2 control-label">End Date</label>
        <div class="col-sm-10">
            <input type="text" autocomplete="off" name="firstaid_end_date" readonly required class="form-control" id="firstaid_end_date" value="<?= ($careplan->firstaid_end_date!='')?getDateDMYOnly($careplan->firstaid_end_date):''; ?>"/>
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