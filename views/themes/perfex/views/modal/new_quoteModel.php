
                <?php echo form_open_multipart('clients/createQuoteSection',array('id'=>'updateQuote', 'class' => 'form-horizontal', 'autocomplete' => 'off')); ?>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label>Quote By<span class="text-danger">*</span></label>
                            <input type="text" id="quote_by" name="quote_by" maxlength="30" minlength="3"  value="<?php echo $article->quote_by; ?>" class="form-control" required />
                            <input type="hidden" id="id" name="id"   value="<?php echo $article->id; ?>" class="form-control" required />
                        </div>
                    </div>
                     <div class="row form-group">
                        <div class="col-md-12">
                         <label>Quote<span class="text-danger">*</span></label>
                        
                           <input type="text" id="title" name="title" value="<?php echo $article->title; ?>" class="form-control" required />
                        
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