<div class="ContentDiv">
	<?php if(!empty($AppContext->ErrorMessage['PhotoUploadForm_Error'])) { ?><p class="Error">Correct all the errors and resubmit again.</p><?php } ?>
	<?php if(!empty($AppContext->Message['PhotoUploadForm_Msg'])) { ?><div class="PaddedBox4"><big class="Message"><strong><?=$AppContext->Message['PhotoUploadForm_Msg']?></strong></big></div><?php } ?>
</div>
<?php
	require_once(dirname(__FILE__)."/../ads/topbanner.php");
	require_once(dirname(__FILE__)."/../browsegallery.php"); 
?>