<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
   <div class="content">
      <?php echo form_open_multipart($this->uri->uri_string(),array('id'=>'article-form')); ?>
      <div class="row">
         <div class="col-md-8 col-md-offset-2">
            <div class="panel_s">
               <div class="panel-body">
                  <h4 class="no-margin">
                     <?php echo $title; ?>
                     <?php if(isset($article)){ ?>
                     <br />
                     <small>
                     <?php if($article->staff_article == 1){ ?>
                     <a href="<?php echo admin_url('knowledge_base/view/'.$article->slug); ?>" target="_blank"><?php echo admin_url('knowledge_base/view/'.$article->slug); ?></a>
                     <?php } else { ?>
                     <a href="<?php echo site_url('knowledge-base/article/'.$article->slug); ?>" target="_blank"><?php echo site_url('knowledge-base/article/'.$article->slug); ?></a>
                     <?php } ?>
                     </small>
                     <?php } ?>
                  </h4>
                  <?php if(isset($article)){ ?>
                  <p>
                     <small>
                     <?php echo _l('article_total_views'); ?>: <?php echo total_rows(db_prefix().'views_tracking',array('rel_type'=>'kb_article','rel_id'=>$article->articleid)); ?>
                     </small>
                     <?php if(has_permission('knowledge_base','','create')){ ?>
                     <a href="<?php echo admin_url('knowledge_base/article'); ?>" class="btn btn-success pull-right"><?php echo _l($_text.' new article'); ?></a>
                     <?php } ?>
                     <?php if(has_permission('knowledge_base','','delete')){ ?>
                     <a href="<?php echo admin_url('knowledge_base/delete_article/'.$article->articleid); ?>" class="btn btn-danger _delete pull-right mright5"><?php echo _l('delete'); ?></a>
                     <?php } ?>
                  <div class="clearfix"></div>
                  </p>
                  <?php } ?>
                  <hr class="hr-panel-heading" />
                  <div class="clearfix"></div>
                  <?php $value = (isset($article) ? $article->subject : ''); ?>
                  <?php $attrs = (isset($article) ? array() : array('autofocus'=>true)); ?>
                  <?php echo render_input('subject','kb_article_add_edit_subject',$value,'text',$attrs); ?>
                  <?php if(isset($article)){
                     echo render_input('slug','kb_article_slug',$article->slug,'text');
                     } ?>
                  <?php $value = (isset($article) ? $article->articlegroup : ''); ?>
                  <?php if(has_permission('knowledge_base','','create')){
                     echo render_select_with_input_group('articlegroup',get_kb_groups(),array('groupid','name'),'kb_article_add_edit_group',$value);
                     } else {
                     echo render_select('articlegroup',get_kb_groups(),array('groupid','name'),'kb_article_add_edit_group',$value);
                     }
                     ?>
                 <!--  <?php if(has_permission('knowledge_base','','create')){
                     echo render_select_with_input_group('articlegroup',get_kb_groups(),array('groupid','name'),'kb_article_add_edit_group',$value,'<a href="#" onclick="new_kb_group();return false;"><i class="fa fa-plus"></i></a>');
                     } else {
                     echo render_select('articlegroup',get_kb_groups(),array('groupid','name'),'kb_article_add_edit_group',$value);
                     }
                     ?> -->
                  
                  <div class="form-group">
                  <?php if(isset($article)){ 
                     //echo "<pre>";print_r($article);die;
                          $filename = $this->db->order_by('id')->get_where('tblfiles', array('rel_id' => $article->articleid, 'rel_type' => 'knowledge_base'))->row('file_name');
                          $filenamelink = base_url().'uploads/knowledge_base/'.$article->articleid.'/'.$filename;
                             
                  ?>   
                  <label class="col-md-12"><a href="<?= $filenamelink; ?>" target="_blank"><?= $filename; ?></a></label>
                  <div class="clearfix">
                        <input type="file" extension="png,jpg,jpeg" accept=".png,.jpg,.jpeg" name="knowledge_base" class="form-control" id="knowledge_base" placeholder="Upload" />
                  </div>
                  <?php }else{  ?>
                  <label>Upload</label>
                  
                    <div class="clearfix">
                        <input type="file" extension="png,jpg,jpeg" accept=".png,.jpg,.jpeg" name="knowledge_base" required class="form-control" id="knowledge_base" placeholder="Upload" />
                    </div>
                    <?php } ?>
                  </div>
                  
                  <p class="bold"><?php echo _l($_text.' description'); ?></p>
                  <?php $contents = ''; if(isset($article)){$contents = $article->description;} ?>
                  <?php echo render_textarea('description','',$contents,array(),array(),'','tinymce tinymce-manual'); ?>
               </div>
            </div>
         </div>
         <?php if((has_permission('knowledge_base','','create') && !isset($article)) || has_permission('knowledge_base','','edit') && isset($article)){ ?>
         <div class="btn-bottom-toolbar btn-toolbar-container-out text-right">
            <button type="submit" class="btn btn-info pull-right"><?php echo _l('submit'); ?></button>
         </div>
         <?php } ?>
      </div>
      <?php echo form_close(); ?>
   </div>
</div>
<?php $this->load->view('admin/knowledge_base/group'); ?>
<?php init_tail(); ?>
<script>
   $(function(){
     init_editor('#description', {append_plugins: 'stickytoolbar',toolbar: false});
     appValidateForm($('#article-form'),{subject:'required',articlegroup:'required'});
   });
</script>
</body>
</html>
