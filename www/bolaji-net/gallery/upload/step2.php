		 <form name="PhotoUploadForm" action="/photos/upload/" method="post">
			<?php if(!empty($AppContext->ErrorMessage['PhotoUploadForm_Error'])) { ?><p class="Error"><big>Correct all the errors and resubmit again.</big></p><p>&nbsp;</p><?php } ?>
			<?php if(!empty($AppContext->Message['PhotoUploadForm_Msg'])) { ?><p class="Message"><big><?=$AppContext->Message['PhotoUploadForm_Msg']?></big></p><p>&nbsp;</p><?php } ?>

			<h3><strong>Step 2: Describe your photos</strong></h3>

			<div class="Divider" onclick="$('S').toggleClass('Invisible');var src=$('Ico').getProperty('src')=='/images/ico_plus.gif'?'/images/ico_minus.gif':'/images/ico_plus.gif';$('Ico').setProperty('src',src);" style="cursor:pointer;padding:.5em;border:1px solid #eee;border-bottom:none;background:#fff url('/images/bg_list_item2.png') bottom repeat-x;">
				<span class="FloatRight"><img id="Ico" src="/images/ico_plus.gif" alt="" /></span>
				<strong><u>Create a new Set</u></strong>
			</div>
			<div id="S" class="InputRow<?=(!isset($Params->SetTitle) && !isset($Params->SetDescription)) || (!isset($AppContext->ErrorMessage['STitle']) && !isset($AppContext->ErrorMessage['SDescription'])) ? ' Invisible' : ''?>" style="border-top:none;">
				<p><?=FormLabel($AppContext,'STitle','Title','font-weight:normal;')?><br/><input id="Form_STitle" class="<?=isset($AppContext->ErrorMessage['STitle'])?'Error':'Input'?>" type="text" name="stitle" size="40" style="width:450px;" onfocus="Csw('Form_STitle','Input','Focus');" onblur="Csw('Form_STitle','Focus','Input');"  value="<?=isset($GalleryInfo->SetTitle) ? $GalleryInfo->SetTitle : ''?>" tabindex="1"/></p>
				<p><?=FormLabel($AppContext, 'SDescription','Description','font-weight:normal;')?><br/><textarea id="Form_SDescription" class="<?=isset($AppContext->ErrorMessage['SDescription'])?'Error':'TextArea'?>" name="sdescription<?=$Counter?>" rows="7" cols="10" wrap="soft" style="width:450px;" onfocus="Csw('Form_SDescription','TextArea','Focus');" onblur="Csw('Form_SDescription','Focus','TextArea');" tabindex="2"><?=isset($GalleryInfo->SetDescription) ? $GalleryInfo->SetDescription : ''?></textarea></p>
			</div>

			<p></p>

			<div class="InputRow">
				<div class="Divider"><strong>Add titles and descriptions</strong></div>
			<?php 
				if(isset($GalleryInfo->Images) && !empty($GalleryInfo->Images) ) 
				{
					$Counter = 1;
					$Index  = 0;
					$TabIndex = 2;

					foreach($GalleryInfo->Images as $Image) 
					{
						list($ImageOldName, $ImageNewName, $ImageFile, $ImageThumb) = explode("|",$Image);
						$Title = !isset($Params->Title[$Index]) ? substr($ImageOldName, 0, strrpos($ImageOldName,".")) : $Params->Title[$Index];
						$Title = FormatStringForDisplay($Title, true, true);
						$Title = str_replace('\\','',$Title);
						$Description = isset($Params->Description[$Index]) ? $Params->Description[$Index] : '';
			?>
					<div class="<?=$Counter%2==0?'FloatRight':'FloatLeft'?>" style="width:44%;height:280px;padding-right:1.5em;">
						<p><img style="padding:.3em;border:1px solid #eee;" src="/Assets/photos/upload<?=substr($ImageThumb,strrpos($ImageThumb,"/"),strlen($ImageThumb))?>" alt="" /></p>
						<div class="Divider"></div>
						<p><?=FormLabel($AppContext,'Title'.$Counter,'Title','font-weight:normal;')?><br/><input id="Form_Title<?=$Counter?>" class="<?=isset($AppContext->ErrorMessage['Title'.$Counter])?'Error':'Input'?>" type="text" name="title<?=$Counter?>" size="20" style="width:200px;" onfocus="Csw('Form_Title<?=$Counter?>','Input','Focus');" onblur="Csw('Form_Title<?=$Counter?>','Focus','Input');"  value="<?=$Title?>" tabindex="<?=++$TabIndex?>"/></p>
						<p><?=FormLabel($AppContext, 'Description'.$Counter,'Description','font-weight:normal;')?><br/><textarea id="Form_Description<?=$Counter?>" class="<?=isset($AppContext->ErrorMessage['Description'.$Counter])?'Error':'TextArea'?>" name="description<?=$Counter?>" rows="5" cols="5" wrap="soft" style="width:200px;" onfocus="Csw('Form_Description<?=$Counter?>','TextArea','Focus');" onblur="Csw('Form_Description<?=$Counter?>','Focus','TextArea');" tabindex="<?=++$TabIndex?>"><?=$Description?></textarea></p>
						<div class="Divider"></div>
					</div>
			<?php
						$Counter++; $Index++;
					}
				}
			?>
				<div class="Spacer"></div>
			</div>
			<input type="hidden" name="step" value="2" />
			<div class="Spacer"></div>
			<div class="ButtonRow"><span class="ButtonRowRight"><input type="Submit" class="Button" name="submit" value="Save" /></span><input type="Submit" class="Button" name="submit" value="Cancel" /></div>
			<div class="Divider"></div>
		 </form>