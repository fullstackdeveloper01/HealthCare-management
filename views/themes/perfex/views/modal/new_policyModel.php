
                <?php echo form_open_multipart('clients/createPolicySection',array('id'=>'updatePolicy', 'class' => 'form-horizontal', 'autocomplete' => 'off')); ?>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label>Subject<span class="text-danger">*</span></label>
                            <input type="text" id="name"   maxlength="60" minlength="3"    name="name" value="<?php echo $article->name; ?>" class="form-control" required />
                            <input type="hidden" id="id" name="id" value="<?php echo $article->id; ?>" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-12"><a href="<?= $filenamelink; ?>" target="_blank"><?= $filename; ?></a></label>
                        <div class="col-sm-12">
                            <input type="file" extension="pdf" accept=".pdf" name="policy" class="form-control" id="policy" placeholder="Upload" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-12">Description</label>
                        <div class="col-sm-12">
                            <textarea name="description" class="form-control" id="description" placeholder="Description"><?php echo $article->description; ?></textarea>
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