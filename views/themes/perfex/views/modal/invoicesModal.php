 <?php echo form_open_multipart('clients/createinvoicesSection/'.$id,array('id'=>'updateInvoices', 'class' => 'form-horizontal')); ?>
    <div class="form-group">
        <label for="inputTitle" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
            <input type="text" name="title" value="<?= $invoice_res->title; ?>" required class="form-control" id="inputTitle" />
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Upload</label>
        <div class="col-sm-10">
            <label><?= $filename; ?></label>
            <input type="file" extension="pdf" accept=".pdf" name="invoice" class="form-control" id="inputUpload3" placeholder="Upload" />
        </div>
    </div>
    <div class="form-group">
        <label for="Invoice" class="col-sm-2 control-label">Invoice Number</label>
        <div class="col-sm-10">
            <input type="text" name="invoice_no" value="<?= $invoice_res->invoice_no; ?>" required class="form-control" id="invoice_no" />
        </div>
    </div>
    <div class="form-group">
        <label for="Date" class="col-sm-2 control-label">Date</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" readonly value="<?= getDateDMYOnly($invoice_res->invoice_date); ?>" name="invoice_date"  id="invoice_date_update" required>
        </div>
    </div>
    <div class="form-group">
        <label for="Total_Amount" class="col-sm-2 control-label">Total Amount</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="<?= $invoice_res->total_amount; ?>" name="total_amount" required>
        </div>
    </div>
    <div class="form-group">
        <label for="Status" class="col-sm-2 control-label">Status</label>
        <div class="col-sm-10">
            <select class="form-control" data-live-search="true" name="status">
                <option value=""></option>
                <option value="UNPAID" <?= ($invoice_res->status == "UNPAID")?"selected":""; ?>>UNPAID</option>
                <option value="PAID" <?= ($invoice_res->status == "PAID")?"selected":""; ?>>PAID</option>
           </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </div>
</form>