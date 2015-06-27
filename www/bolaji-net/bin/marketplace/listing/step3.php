<div class="ContentDiv">
	<?php if(!empty($AppContext->ErrorMessage['MktplcForm_Error'])) { ?><p class="Error">Correct all the errors and resubmit again.</p><?php } ?>
	<?php if(!empty($AppContext->Message['MktplcForm_Msg'])) { ?><div class="PaddedBox4"><p class="Message"><strong><?=$AppContext->Message['MktplcForm_Msg']?></strong></p></div><?php } ?>
</div>
<?php require_once(dirname(__FILE__)."/../category.php"); ?>