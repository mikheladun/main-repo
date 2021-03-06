		 <form id="VideoUploadForm" name="VideoUploadForm" action="/video/upload/" method="post" enctype="multipart/form-data">
			<p><strong>All fields are required.<br/></strong> If you have any problems while uploading your video, check out our <a href="#">ask for help</a></p>
				<?php if(!empty($AppContext->ErrorMessage['VideoUploadForm_Error'])) { ?><p class="Error"><big>Correct all the errors and resubmit again.</big></p><p>&nbsp;</p><?php } ?>
				<?php if(!empty($AppContext->Message['VideoUploadForm_Msg'])) { ?><p class="Message"><big><?=$AppContext->Message['VideoUploadForm_Msg']?></big></p><p>&nbsp;</p><?php } ?>

				<div class="InputRow"><?=FormLabel($AppContext, 'Name')?><?=FormLabel($AppContext, 'Email', 'Email', 'margin-left:14em;')?>
					<br/><input id="Form_Name" class="<?=isset($AppContext->ErrorMessage['Name'])?'Error':'Input'?>" type="text" name="name" size="20" style="width:200px;" onfocus="Csw('Form_Name','Input','Focus');" onblur="Csw('Form_Name','Focus','Input');"  value="<?=isset($Params->Name) && isset($Params->Name)?$Params->Name:''?>" tabindex="1" maxlength="100"/>&nbsp;
					<input id="Form_Email" class="<?=isset($AppContext->ErrorMessage['Email'])?'Error':'Input'?>" type="text" name="email" size="20" style="width:205px;" onfocus="Csw('Form_Email','Input','Focus');" onblur="Csw('Form_Email','Focus','Input');"  value="<?=isset($Params->Email) && isset($Params->Name)?$Params->Email:''?>" tabindex="2" maxlength="100"/>
				</div>

				<p></p>

				<div class="InputRow"><?=FormLabel($AppContext, 'Video', 'Your Video')?>
					<br/><input tabindex="3" id="Form_Video" class="Input" type="file" name="uploadfile" value="" onfocus="Csw('Form_Video','Input','Focus');" onblur="Csw('Form_Video','Focus','Input');" size="49" style="width:420px;"/>
					<br clear="all"/><p class="Error">No copyright infringing or adult material is permitted.</p>
					Your video needs to be less than 100MB, in WMV, ASF, QT, MOD, MOV, MPG, 3PG, 3GP2, or AVI format, and have audio.
					
					<br/><br/><?=FormLabel($AppContext, 'Title')?>
					<br/><input id="Form_Title" class="<?=isset($AppContext->ErrorMessage['Title'])?'Error':'Input'?>" type="text" name="title" size="40" style="width:420px;" onfocus="Csw('Form_Title','Input','Focus');" onblur="Csw('Form_Title','Focus','Input');"  value="<?=isset($Params->Title) && isset($Params->Title)?$Params->Title:''?>" tabindex="4" maxlength="100"/>
	
					<br/><br/><?=FormLabel($AppContext, 'Description')?>
					<br/><textarea id="Form_Description" class="<?=isset($AppContext->ErrorMessage['Description'])?'Error':'TextArea'?>" name="description" rows="10" cols="5" wrap="soft" style="width:420px;" onfocus="Csw('Form_Description','TextArea','Focus');" onblur="Csw('Form_Description','Focus','TextArea');" tabindex="5"><?=isset($Params->Description)?$Params->Description:''?></textarea>
					<br/>Limit is 1000 characters
				</div>

				<p></p>
				<div class="InputRow">
					<?=FormError($AppContext, 'Terms')?><br/>
					<input id="Form_Terms" type="checkbox" name="terms" tabindex="7" <?=isset($Params->AccepTerms) && isset($Params->AccepTerms)?" checked=\"true\"":''?>/>&nbsp;I have read and agree to the <a href="/legal/terms/"><strong>Terms and Conditions</strong></a>
				</div>

			<input type="hidden" name="step" value="1" />
			<div class="Spacer"></div>
			<div class="ButtonRow"><span class="ButtonRowRight"><input type="submit" class="Button" name="submit" value="Upload" /></span><input type="Submit" class="Button" name="submit" value="Cancel" /></div>
			<div class="Divider"></div>
		 </form>