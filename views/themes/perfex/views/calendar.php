<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="panel_s">
    <div class="panel-body">
        <div id="calendar"></div>
    </div>
</div>
<script>
	function hidetext()
	{
		$('.fc-right').addClass('hide');
		$('.fc-right').remove();
	}
	
	setTimeout(function(){ hidetext(); }, 1000);
</script>
