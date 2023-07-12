<?php echo form_open_multipart('clients/createDocument/'.$id,array('id'=>'createdocument2', 'class' => 'form-horizontal')); ?>
    <div class="form-group">
        <label for="inputTitle" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
            <input type="text" name="title" value="<?= $document->title; ?>" required class="form-control" id="inputTitle" />
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Upload</label>
        <div class="col-sm-10">
            <label><?= $filename; ?></label>
            <input type="file" extension="pdf" accept=".pdf" name="document" class="form-control" id="inputUpload3" placeholder="Upload" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </div>
</form>