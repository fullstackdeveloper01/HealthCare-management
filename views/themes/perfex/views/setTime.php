<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>
<style>
	.property-list .dataTables_empty{
		text-align:center!important;
		margin-top: 100px;
	}
</style>
<div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <?php echo form_open('clients/setTime',array('autocomplete'=>'off')); ?>
            <div class="form-group">
                <label>Set time for book appointment</label>
                <select name="setTime[]" required multiple class="form-control" data-live-search="true">
                    <option value="07:00am">07:00 am</option>
                    <option value="08:00am">08:00 am</option>
                    <option value="09:00am">09:00 am</option>
                    <option value="10:00am">10:00 am</option>
                    <option value="11:00am">11:00 am</option>
                    <option value="12:00pm">12:00 pm</option>
                    <option value="01:00pm">01:00 pm</option>
                    <option value="02:00pm">02:00 pm</option>
                    <option value="03:00pm">03:00 pm</option>
                    <option value="04:00pm">04:00 pm</option>
                    <option value="05:00pm">05:00 pm</option>
                    <option value="06:00pm">06:00 pm</option>
                    <option value="07:00pm">07:00 pm</option>
                    <option value="08:00pm">08:00 pm</option>
                    <option value="09:00pm">09:00 pm</option>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-info" type="submit" >Set time</button>
            </div>
        </form>
    </div>
</div>
