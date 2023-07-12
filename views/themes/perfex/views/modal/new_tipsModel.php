
                <?php echo form_open_multipart('clients/addarticle',array('id'=>'updateTips', 'class' => 'form-horizontal', 'autocomplete' => 'off')); ?>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label>Subject<span class="text-danger">*</span></label>
                            <input type="text" id="subject" name="subject" value="<?php echo $article->subject; ?>" class="form-control" required />
                            <input type="hidden" id="articleid" name="articleid" value="<?php echo $article->articleid; ?>" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-12"><a href="<?= $filenamelink; ?>" target="_blank"><?= $filename; ?></a></label>
                        <div class="col-sm-12">
                            <input type="file" extension="png,jpg,jpeg" accept=".png,.jpg,.jpeg" name="knowledge_base" class="form-control" id="knowledge_base" placeholder="Upload" />
                        </div>
                    </div>
             <!--        <?php if(isset($article)){ ?>
                        <div class="row form-group">
                        <div class="col-md-12">
                            <label>Slug<span class="text-danger">*</span></label>
                            <input type="text" id="slug" name="slug" value="<?php echo $article->slug; ?>" class="form-control" required />
                            <input type="hidden" id="articleid" name="articleid" value="<?php echo $article->articleid; ?>" class="form-control" required />
                        </div>
                    </div>
                    <?php } ?> -->
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label>Description<span class="text-danger">*</span></label>
                            <?php $contents = ''; if(isset($article)){$contents = $article->description;} ?>
                            <?php echo render_textarea('description_edit_tips','',$contents,array(),array(),'','tinymce tinymce-manual required'); ?>
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