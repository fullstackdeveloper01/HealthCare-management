
                <?php echo form_open_multipart('clients/createNoticeSection',array('id'=>'updateNotice', 'class' => 'form-horizontal', 'autocomplete' => 'off')); ?>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label>Title<span class="text-danger">*</span></label>
                            <input type="text" id="title" name="title"   maxlength="60" minlength="3"   value="<?php echo $article->title; ?>" class="form-control" required />
                            <input type="hidden" id="id" name="id" value="<?php echo $article->id; ?>" class="form-control" required />
                        </div>
                    </div>
                     <div class="row form-group">
                        <div class="col-md-12">
                         <label>Description<span class="text-danger">*</span></label>
                         <textarea name="description" id="description" rows="10" class="form-control" required><?php echo $article->description; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="modal-footer">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>