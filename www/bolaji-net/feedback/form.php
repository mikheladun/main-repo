<div class="ContentDiv">
	<p><big><big class="GrnTxt">&nbsp;We appreciate your feedback</big></big></p>
	<?php if(!empty($AppContext->ErrorMessage['FeedbackForm_Error'])) { ?><p class="Error"><big>Correct all the errors and resubmit again.</big></p><p>&nbsp;</p><?php } ?>
	<?php if(!empty($AppContext->Message['FeedbackForm_Msg'])) { ?><div class="PaddedBox4"><big class="Message"><strong><?=$AppContext->Message['FeedbackForm_Msg']?></strong></big></div><?php } ?><p></p>
	 <form id="FeedbackForm" name="FeedbackForm" action="/feedback/index.php" method="post">

		<p>Your feedback helps us improve the quality of Bolaji.net. We do review all submissions, though our response time may be slowed due to volume.</p>
		<p>&nbsp;</p>
		<div class="InputRow"><?=FormLabel($AppContext, 'Name','Name','font-weight:normal;')?><?=FormLabel($AppContext, 'Email', 'Email', 'font-weight:normal;margin-left:14em;')?>
			<br/><input id="Form_Name" class="<?=isset($AppContext->ErrorMessage['Name'])?'Error':'Input'?>" type="text" name="name" size="20" style="width:200px;" onfocus="Csw('Form_Name','Input','Focus');" onblur="Csw('Form_Name','Focus','Input');"  value="<?=isset($Params->Name) && isset($Params->Name)?$Params->Name:''?>" tabindex="1" maxlength="100"/>&nbsp;
			<input id="Form_Email" class="<?=isset($AppContext->ErrorMessage['Email'])?'Error':'Input'?>" type="text" name="email" size="20" style="width:205px;" onfocus="Csw('Form_Email','Input','Focus');" onblur="Csw('Form_Email','Focus','Input');"  value="<?=isset($Params->Email) && isset($Params->Name)?$Params->Email:''?>" tabindex="2" maxlength="100"/>
		</div>
		<div class="InputRow">
			<?=FormLabel($AppContext, 'Comment','Comment','font-weight:normal;')?>
			<br/><textarea id="Form_Comment" class="<?=isset($AppContext->ErrorMessage['Comment'])?'Error':'TextArea'?>" name="comment" rows="12" cols="28" wrap="soft" style="width:410px;" onfocus="Csw('Form_Comment','TextArea','Focus');" onblur="Csw('Form_Comment','Focus','TextArea');" tabindex="3"><?=isset($Params->Comment)?$Params->Comment:''?></textarea>
		</div>

		<p><strong>Notice:&nbsp;</strong>We collect personal information on this page. Bolaji.net shall own and may use, without attribution or compensation, any feedback provided here. To learn more about how we use the information and feedback you provide to us, see our <a href="#">Privacy Policy</a> and <a href="#">Terms of Service</a>.</p>
		<p>&nbsp;</p>
		<div class="Divider"></div>
		<div class="ButtonRow"><span class="ButtonRowRight"><input type="submit" class="Button" name="submit" value="Send" /></span><input type="Button" class="Button" name="cancel" value="Cancel" onclick="self.location='<?=$_SERVER['HTTP_REFERER']?>'" /></div>
		<div class="Divider"></div>
	 </form>
</div>