
<?php echo form_open('clients/createWwcc/'.$id,array('id'=>'createWwccUpdate', 'class' => 'form-horizontal')); ?>
    
    
    <div class="form-group">
        <label for="inputTitle" class="col-sm-2 control-label">Start Date</label>
        <div class="col-sm-10">
            <input type="text" autocomplete="off" name="wwcc_start_date" readonly required class="form-control" id="wwcc_start_date" value="<?= ($careplan->wwcc_start_date!='')?getDateDMYOnly($careplan->wwcc_start_date):''; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label for="roster" class="col-sm-2 control-label">End Date</label>
        <div class="col-sm-10">
            <input type="text" autocomplete="off" name="wwcc_end_date" readonly required class="form-control" id="wwcc_end_date" value="<?= ($careplan->wwcc_end_date!='')?getDateDMYOnly($careplan->wwcc_end_date):''; ?>"/>
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