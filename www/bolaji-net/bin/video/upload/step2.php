<div class="ContentDiv">
	<?php if(!empty($AppContext->Message['VideoUploadForm_Msg'])) { ?><div class="PaddedBox4"><big class="Message"><strong><?=$AppContext->Message['VideoUploadForm_Msg']?></strong></big></div><?php } ?>
</div>
<?php
	require_once(dirname(__FILE__)."/../ads/topbanner.php");
	require_once(dirname(__FILE__)."/../browsevids.php"); 
?>