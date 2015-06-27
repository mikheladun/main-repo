		 <form id="PhotoUploadForm" name="PhotoUploadForm" action="/photos/upload/" method="post" enctype="multipart/form-data">
			<p><strong>All fields are required.<br/></strong> If you have any problems while uploading your video, check out our <a href="#">ask for help</a></p>
				<?php if(!empty($AppContext->ErrorMessage['PhotoUploadForm_Error'])) { ?><p class="Error"><big>Correct all the errors and resubmit again.</big></p><p>&nbsp;</p><?php } ?>
				<?php if(!empty($AppContext->Message['PhotoUploadForm_Msg'])) { ?><p class="Message"><big><?=$AppContext->Message['PhotoUploadForm_Msg']?></big></p><p>&nbsp;</p><?php } ?>

				<div class="InputRow"><?=FormLabel($AppContext, 'Name','Name','font-weight:normal;')?><?=FormLabel($AppContext, 'Email', 'Email', 'font-weight:normal;margin-left:14em;')?>
					<br/><input id="Form_Name" class="<?=isset($AppContext->ErrorMessage['Name'])?'Error':'Input'?>" type="text" name="name" size="20" style="width:200px;" onfocus="Csw('Form_Name','Input','Focus');" onblur="Csw('Form_Name','Focus','Input');"  value="<?=isset($Params->Name) && isset($Params->Name)?$Params->Name:''?>" tabindex="1" maxlength="100"/>&nbsp;
					<input id="Form_Email" class="<?=isset($AppContext->ErrorMessage['Email'])?'Error':'Input'?>" type="text" name="email" size="20" style="width:205px;" onfocus="Csw('Form_Email','Input','Focus');" onblur="Csw('Form_Email','Focus','Input');"  value="<?=isset($Params->Email) && isset($Params->Name)?$Params->Email:''?>" tabindex="2" maxlength="100"/>
				</div>

				<h3>Step 1: Choose Photos</h3>
				<p>You may choose up to 10 photos. Each photo needs to be less than 2MB, in GIF or JPG format.
					<span class="Error">No copyright infringing or adult material is permitted.</span></p>

				<div class="InputRow">
					<input tabindex="<?=$TabIndex?>" id="Form_Photos" class="Input" type="file" name="uploadfile" value="" onfocus="Csw('Form_Photos','Input','Focus');" onblur="Csw('Form_Photos','Focus','Input');" size="45" style="width:420px;"/>
					<br clear="all"/>
					<?=FormError($AppContext, 'Photos')?>
					<p></p>
					<?=FormError($AppContext, 'Terms')?><br/>
					<input id="Form_Terms" type="checkbox" name="terms" tabindex="7" <?=isset($Params->AccepTerms) && isset($Params->AccepTerms)?" checked=\"true\"":''?>/>&nbsp;I have read and agree to the <a href="/legal/terms/"><strong>Terms and Conditions</strong></a>
				</div>

			<input type="hidden" name="step" value="1" />
			<div class="Spacer"></div>
			<div class="ButtonRow"><span class="ButtonRowRight"><input type="submit" class="Button" name="submit" value="Upload" /></span><input type="Submit" class="Button" name="submit" value="Cancel" /></div>
			<div class="Divider"></div>
		 </form>