<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<style>
	table.table {
    margin-top: 25px;
    table-layout: fixed;
	}
	</style>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
						<h4 class="customer-profile-group-heading"><?= _l($title); ?></h4>
						<hr class="hr-panel-heading" />
						<?php render_datatable(array(
							_l('Name'),
							_l('Email'),
							_l('Phone Number'),
                            _l('Feedback'),
							),'feedback'); 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div></div>
<?php init_tail(); ?>
<script>
	initDataTable('.table-feedback', window.location.href, [1], [1], undefined, [0, 'DESC']);
</script>
	<!-- <script>
		initDataTable('.table-feedback', window.location.href, [1], [1], undefined, [0, 'DESC']);
		
		/* createNewFolder */
		function createNewFolder()
		{
		    var name = $('#foldername').val();
		    if(name)
		    {
		        var str = "name="+name+"&"+csrfData['token_name']+"="+csrfData['hash'];
    		    $.ajax({
    		        url: '<?= admin_url()?>gallery/createNewFolder',
    		        type: 'POST',
    		        data: str,
    		        datatype: 'json',
    		        cache: false,
    		        success: function(resp_){
    		            if(resp_ == 1)
    		            {
    		                $('.close').click();
    		                getFolderList();
    		                $("#folderform")[0].reset();
    		            }
    		            else if(resp_ == 2)
    		            {
    		                $('.foldername').text('Folder name is already exist!');
    		                return false;
    		            }
    		        }
    		    });
		    }
		    else
		    {
		        $('.foldername').text('Folder name is required!');
    		    return false;
		    }
		}	
		/* createNewFolder */
		function createNewEvent()
		{
		    var name = $('#eventname').val();
		    if(name)
		    {
		        var str = "name="+name+"&"+csrfData['token_name']+"="+csrfData['hash'];
    		    $.ajax({
    		        url: '<?= admin_url()?>gallery/createNewEvent',
    		        type: 'POST',
    		        data: str,
    		        datatype: 'json',
    		        cache: false,
    		        success: function(resp_){
    		            if(resp_ == 1)
    		            {
    		                $('.close').click();
    		                getEventList();
    		                $("#eventform")[0].reset();
    		            }
    		            else if(resp_ == 2)
    		            {
    		                $('.eventname').text('Event name is already exist!');
    		                return false;
    		            }
    		        }
    		    });
		    }
		    else
		    {
		        $('.eventname').text('Event name is required!');
    		    return false;
		    }
		}
		
		function removeError(name)
		{
		    $('.'+name).text('');
		}
		
		function getFolderList()
        {
            var str = csrfData['token_name']+"="+csrfData['hash'];
		    $.ajax({
		        url: '<?= admin_url()?>gallery/getFolderList',
		        type: 'POST',
		        data: str,
		        datatype: 'json',
		        cache: false,
		        success: function(resp_){
		            if(resp_)
		            {
		                var resp = JSON.parse(resp_);
		                var res = '<option value=""></option>';
		                for(var i=0; i<resp.length; i++)
		                {
		                   res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
		                }
		                $('#folderid').html(res);
		            }
		            else
		            {
		                $('#folderid').html('<option value=""></option>');
		            }
		        }
		    });
        }
		function getEventList()
        {
            var str = csrfData['token_name']+"="+csrfData['hash'];
		    $.ajax({
		        url: '<?= admin_url()?>gallery/getEventList',
		        type: 'POST',
		        data: str,
		        datatype: 'json',
		        cache: false,
		        success: function(resp_){
		            if(resp_)
		            {
		                var resp = JSON.parse(resp_);
		                var res = '<option value=""></option>';
		                for(var i=0; i<resp.length; i++)
		                {
		                   res += '<option value="'+resp[i].id+'">'+resp[i].name+'</option>';
		                }
		                $('#eventid').html(res);
		            }
		            else
		            {
		                $('#eventid').html('<option value=""></option>');
		            }
		        }
		    });
        }
        //setInterval(function(){ getFolderList(); }, 2000);
        getFolderList();
        getEventList();
	</script> -->
</body>
</html>

            