<div class="Feedback BorderBox1">
	<p class="SectionHeader">Feedback</p>
	<p></p>
	<p><big>We appreciate your feedback</big></p>
	<p>Your feedback helps us improve the quality of Bolaji.net. We do review all submissions, though we cannot respond due to volume.</p>

	 <form id="FeedbackForm" name="FeedbackForm" action="/feedback/" method="post" enctype="multipart/form-data">
		<?php if(!empty($AppContext->ErrorMessage['FeedbackForm_Error'])) { ?><p class="Error"><big>Correct all the errors and resubmit again.</big></p><p>&nbsp;</p><?php } ?>
		<?php if(!empty($AppContext->Message['FeedbackForm_Msg'])) { ?><p class="Message"><big><?=$AppContext->Message['FeedbackForm_Msg']?></big></p><p>&nbsp;</p><?php } ?>
	
		<?=FormLabel($AppContext, 'Name','Name','font-weight:normal;')?>
		<br/><input id="Form_Name" class="<?=isset($AppContext->ErrorMessage['Name'])?'Error':'Input'?>" type="text" name="name" size="20" style="width:210px;" onfocus="Csw('Form_Name','Input','Focus');" onblur="Csw('Form_Name','Focus','Input');"  value="<?=isset($Params->Name) && isset($Params->Name)?$Params->Name:''?>" tabindex="1" maxlength="100"/>
		<br/><?=FormLabel($AppContext, 'Email', 'Email','font-weight:normal;')?>
		<br/><input id="Form_Email" class="<?=isset($AppContext->ErrorMessage['Email'])?'Error':'Input'?>" type="text" name="email" size="20" style="width:210px;" onfocus="Csw('Form_Email','Input','Focus');" onblur="Csw('Form_Email','Focus','Input');"  value="<?=isset($Params->Email) && isset($Params->Name)?$Params->Email:''?>" tabindex="2" maxlength="100"/>
	
		<br/><br/><?=FormLabel($AppContext, 'Comment','Comment','font-weight:normal;')?>
		<br/><textarea id="Form_Comment" class="<?=isset($AppContext->ErrorMessage['Comment'])?'Error':'TextArea'?>" name="comment" rows="10" cols="28" wrap="soft" style="width:210px;" onfocus="Csw('Form_Comment','TextArea','Focus');" onblur="Csw('Form_Comment','Focus','TextArea');" tabindex="3"><?=isset($Params->Comment)?$Params->Comment:''?></textarea>
 
		 <p>&nbsp;</p>
		 <p><strong>Notice:&nbsp;</strong>We collect personal information on this page. Bolaji.net shall own and may use, without attribution or compensation, any feedback provided here. To learn more about how we use the information and feedback you provide to us, see our <a href="#">Privacy Policy</a> and <a href="#">Terms of Service</a>.</p>
	
		<div class="Divider"></div>
		<div class="ButtonRow"><span class="ButtonRowRight"><input type="submit" class="Button" name="submit" value="Send Feedback" /></span><input type="Submit" class="Button" name="submit" value="Cancel" /></div>
		<div class="Divider"></div>
	 </form>
</div>
