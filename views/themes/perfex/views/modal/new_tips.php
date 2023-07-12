<div class="modal fade" id="newTipsModal" tabindex="-1" role="dialog" aria-labelledby="newTipsModalLabel">
    <div class="modal-dialog full-modal" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="newTipsModalLabel">Add Tips</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('clients/addarticle',array('id'=>'addtipsForm', 'autocomplete' => 'off')); ?>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label>Subject<span class="text-danger">*</span></label>
                            <input type="text" id="subject" name="subject" value="<?php echo $article->subject; ?>" class="form-control" required />
                            <input type="hidden" id="articlegroup" name="articlegroup" value="2" class="form-control" required />
                           
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Upload</label>
                        <div class="clearfix">
                            <input type="file" extension="png,jpg,jpeg" accept=".png,.jpg,.jpeg" name="knowledge_base"  class="form-control" id="knowledge_base" placeholder="Upload" />
                        </div>
                    </div>
                    <div class="form-group">
                            <label>Description<span class="text-danger">*</span></label>
                            <?php echo render_textarea('description_tips','','',array(),array(),'','tinymce tinymce-manual required'); ?>
                     
                    </div>
                    <div class="form-group">
                        <div class="modal-footer">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editTipsModal" tabindex="-1" role="dialog" aria-labelledby="tipsModalLabel">
    <div class="modal-dialog full-modal" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="tipsModalLabel">Tips Update </h4>
            </div>
            <div class="modal-body tipsSectione_">
                
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script type="text/javascript" id="moment-js" src="<?php echo base_url('assets/builds/moment.min.js?v=2.4.2'); ?>"></script>
<script type="text/javascript" id="bootstrap-select-js" src="<?php echo base_url('assets/builds/bootstrap-select.min.js?v=2.4.2'); ?>"></script>
<script type="text/javascript" id="tinymce-js" src="<?php echo base_url('assets/plugins/tinymce/tinymce.min.js?v=2.4.2'); ?>"></script>
<script type="text/javascript" id="jquery-validation-js" src="<?php echo base_url('assets/plugins/jquery-validation/jquery.validate.min.js?v=2.4.2'); ?>"></script>
<script type="text/javascript" id="app-js" src="<?php echo base_url('assets/js/main.min.js?v=2.4.2'); ?>"></script>
<script type="text/javascript" id="tinymce-stickytoolbar" src="<?php echo base_url('assets/plugins/tinymce-stickytoolbar/stickytoolbar.js'); ?>"></script>

<script type='text/javascript'>
    var islogin = '<?= $client_data->userid; ?>';
    var get_client_user_id = '<?= get_client_user_id(); ?>';
    $(document).ready(function() {
        if(get_client_user_id!=''){
            tips_table = $('#tipsdata_list').DataTable({ 
                "processing": true, //Feature control the processing indicator.
                "serverSide": false, //Feature control DataTables' servermside processing mode.
                "order": [[0,'desc']], //Initial no order.
                "ordering": true,
                "searching": true,
                "oLanguage": {
                    "sEmptyTable": "No Tips Added Yet!!"
                },
                "ajax": {
                    "url": "<?php echo base_url('clients/loadTipsData')?>",
                    "type": "POST",
                    "dataType": "json",
                    "data":{},
                    "data": function ( data ) {
                    data.filter_by = {};
                    },
                    "dataSrc": function (jsonData) {
                    return jsonData.data;
                    }
                },
            });
            }
        });
    $(document).ready(function() {
        
     init_editorcloNew('#description_tips', {append_plugins: 'stickytoolbar',toolbar : false});
     init_editorcloNew('#description_edit_tips', {append_plugins: 'stickytoolbar',toolbar : false});
     });
function init_editorcloNew(selector, settings) {



    selector = typeof(selector) == 'undefined' ? '.tinymce' : selector;

    var _editor_selector_check = $(selector);



    if (_editor_selector_check.length === 0) { return; }



    $.each(_editor_selector_check, function() {

        if ($(this).hasClass('tinymce-manual')) {

            $(this).removeClass('tinymce');

        }

    });



    // Original settings

    var _settings = {

        branding: false,

        selector: selector,

        browser_spellcheck: true,

        height: 400,

        theme: 'modern',

        skin: 'perfex',

        language: app.tinymce_lang,

        relative_urls: false,

        inline_styles: true,

        verify_html: false,

        cleanup: false,

        autoresize_bottom_margin: 25,

        valid_elements: '+*[*]',

        valid_children: "+body[style], +style[type]",

        apply_source_formatting: false,

        remove_script_host: false,

        removed_menuitems: 'newdocument restoredraft',

        forced_root_block: false,

        autosave_restore_when_empty: false,

        fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',

        setup: function(ed) {

            // Default fontsize is 12

            ed.on('init', function() {

                this.getDoc().body.style.fontSize = '12pt';

            });

        },

        table_default_styles: {

            // Default all tables width 100%

            width: '100%',

        },

        plugins: [

            'advlist autoresize autosave lists link image print hr codesample',

            'visualblocks code fullscreen',

            'media save table contextmenu',

            'paste textcolor colorpicker'

        ],

        toolbar1: 'fontselect fontsizeselect | forecolor backcolor | bold italic | alignleft aligncenter alignright alignjustify | image link | bullist numlist | restoredraft',

        file_browser_callback: elFinderBrowserCloNew,

    };



    // Add the rtl to the settings if is true

    isRTL == 'true' ? _settings.directionality = 'rtl' : '';

    isRTL == 'true' ? _settings.plugins[0] += ' directionality' : '';



    // Possible settings passed to be overwrited or added

    if (typeof(settings) != 'undefined') {

        for (var key in settings) {

            if (key != 'append_plugins') {

                _settings[key] = settings[key];

            } else {

                _settings['plugins'].push(settings[key]);

            }

        }

    }



    // Init the editor

    var editor = tinymce.init(_settings);

    $(document).trigger('app.editor.initialized');



    return editor;

}



function elFinderBrowserCloNew(field_name, url, type, win) {

    tinymce.activeEditor.windowManager.open({

        file:   "<?php echo base_url('clients/tinymce_file_browser')?>",

        title: app.lang.media_files,

        width: 900,

        height: 450,

        resizable: 'yes'

    }, {

        setUrl: function(url) {

            win.document.getElementById(field_name).value = url;

        }

    });

    return false;

}

    window.addEventListener('load',function(){
           appValidateForm($('#addtipsForm'), {
            subject: 'required',
            description_tips: 'required',
            knowledge_base: {
                //required: true,
                extension: 'png,jpg,jpeg'
            }
        }, tipsadd_form);
    });

    function tipsadd_form(form) {
        var formURL = form.action;
        var formData = new FormData($(form)[0]);
        jQuery('#addtipsForm').find('button[type="submit"]').prop("disabled",true);
        $.ajax({
            type: $(form).attr('method'),
            data: formData,
            mimeType: $(form).attr('enctype'),
            contentType: false,
            cache: false,
            processData: false,
            url: formURL
        }).done(function(response) {
            response = JSON.parse(response);
            if (response.success == true) {
                $("#addtipsForm")[0].reset();
                successmsg(response.message);
                $('.close').click();
                tips_table.ajax.reload();  
                $('#addtipsForm').validate().resetForm();
                $('#tipslistmodel').modal('show');
            }
            else
            {
                errormsg(response.message);
            }
            jQuery('#addtipsForm').find('button[type="submit"]').prop("disabled",false);
        });
        return false;
    }


    function tipsUpdate_form(form) {
        var formURL = form.action;
        var formData = new FormData($(form)[0]);
    
        $.ajax({
            type: $(form).attr('method'),
            data: formData,
            mimeType: $(form).attr('enctype'),
            contentType: false,
            cache: false,
            processData: false,
            url: formURL
        }).done(function(response) {
            response = JSON.parse(response);
            if (response.success == true) {
                successmsg(response.message);
                $('.close').click();
                $('#addtipsForm').validate().resetForm();
                tips_table.ajax.reload();  
            }
        });
        return false;
    }

    $('#newTipsModal').on('hidden.bs.modal', function (e) {       

        $('#addtipsForm')[0].reset();  
        $('#addtipsForm').validate().resetForm();             
    });



    $('#newTipsModal').on('shown.bs.modal', function (e) {
         $('#addtipsForm')[0].reset();  
        $('#addtipsForm').validate().resetForm();   

        tinymce.remove();
        init_editorcloNew('#description_tips', {append_plugins: 'stickytoolbar',toolbar : false});

           appValidateForm($('#addtipsForm'), {
            subject: 'required',
            description_tips: 'required',
            knowledge_base: {
               // required: true,
                extension: 'png,jpg,jpeg'
            }
        }, tipsadd_form);
    });



    function removetipsSection(id)
    {
        var r = confirm("Are you sure want to delete?");
        if (r == true) {
            $.ajax({
                url: '<?=base_url()?>clients/removetipsSection/'+id,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    $('#careid'+id).empty();
                    successmsg('Remove successfully');
                    tips_table.ajax.reload();
                }
           });
        }
    }

    function edittipsSection(careid)
    {
        $.ajax({
            url: '<?=base_url()?>clients/edittipsSection/'+careid,
            type: 'get',
            success: function(response){
              $('.tipsSectione_').html(response); 
              tinymce.remove();
              init_editorcloNew('#description_edit_tips', {append_plugins: 'stickytoolbar',toolbar : false});
              appValidateForm($('#updateTips'), {
                  subject: 'required',
              }, tipsUpdate_form);
            }
       });
    }




</script>