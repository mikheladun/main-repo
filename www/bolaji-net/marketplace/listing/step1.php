<?php
 require_once(dirname(__FILE__)."/../../Library/Framework/Core/Framework.Utils.php");
 $Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.MKTPLC"]);
 $Response = $Service->Execute($AppContext, "GetTopCategoryList", $Params);
?>
				<p class="PaddedBox4" align="center"><strong>Step 1 of 2:&nbsp;Describe Your Ad</strong></p>
		 <form id="MktplcForm" name="MktplcForm" action="/marketplace/listing/" method="post" enctype="multipart/form-data">
				<p>All fields are required.</p>
				<div class="InputRow"><?=FormLabel($AppContext, 'Name')?><?=FormLabel($AppContext, 'Email', 'Email', 'margin-left:14em;')?>
					<br/><input id="Form_Name" class="<?=isset($AppContext->ErrorMessage['Name'])?'Error':'Input'?>" type="text" name="name" size="20" style="width:200px;" onfocus="Csw('Form_Name','Input','Focus');" onblur="Csw('Form_Name','Focus','Input');"  value="<?=isset($Params->Name) && isset($Params->Name)?$Params->Name:''?>" tabindex="1" maxlength="100"/>&nbsp;
					<input id="Form_Email" class="<?=isset($AppContext->ErrorMessage['Email'])?'Error':'Input'?>" type="text" name="email" size="20" style="width:205px;" onfocus="Csw('Form_Email','Input','Focus');" onblur="Csw('Form_Email','Focus','Input');"  value="<?=isset($Params->Email) && isset($Params->Name)?$Params->Email:''?>" tabindex="2" maxlength="100"/>
				</div>

				<div class="InputRow">
					<?=FormLabel($AppContext, 'Title', 'Title')?>
					<br/><input id="Form_Title" class="<?=isset($AppContext->ErrorMessage['Title'])?'Error':'Input'?>" type="text" name="title" size="40" style="width:420px;" onfocus="Csw('Form_Title','Input','Focus');" onblur="Csw('Form_Title','Focus','Input');"  value="<?=isset($Params->Title) && isset($Params->Title)?$Params->Title:''?>" tabindex="3" maxlength="100"/>
					<br/><br/><?=FormLabel($AppContext, 'Category', 'Category')?>
					<br/><ul>
					<?php $TabIndex=4; foreach($Response->Object as $Category) { ?>
						<li style="width:210px;float:left;"><input id="Form_Category<?=$Category->NameID?>" class="<?=isset($AppContext->ErrorMessage['Category'])?'Error':'Input'?>" onfocus="Csw('Form_Category','Input','Focus');" onblur="Csw('Form_Category','Focus','Input');" name="category" type="checkbox" value="<?=$Category->CategoryID?>" <?=isset($Params->Category)&&($Params->Category==$Category->CategoryID)?' checked':''?> tabindex="<?=$TabIndex?>" />&nbsp;<?=$Category->Name?></li>
					<?php $TabIndex++; } ?>		</ul>
					<div class="Spacer"></div>
		
					<br/><?=FormLabel($AppContext, 'Description', 'Description')?>
					<br/><textarea id="Form_Description" class="<?=isset($AppContext->ErrorMessage['Description'])?'Error':'TextArea'?>" name="description" rows="10" cols="5" wrap="soft" style="width:420px;" onfocus="Csw('Form_Description','TextArea','Focus');" onblur="Csw('Form_Description','Focus','TextArea');" tabindex="<?=$TabIndex?>"><?=isset($Params->Description)?$Params->Description:''?></textarea>
					<br/>Limit is 1000 characters
				</div>

				<div class="InputRow"><?=FormLabel($AppContext, 'Pictures', 'Pictures')?><?=FormError($AppContext, 'Pictures')?>
					<br/><input tabindex="<?=TabIndex?>" class="Input" type="file" name="uploadfile" onfocus="Csw('Form_Picture','Input','Focus');" onblur="Csw('Form_Picture','Focus','Input');" size="45" style="width:420px;"/>
					<br clear="all"/>Your picture need to be less than 2MB, in GIF, JPG format.
				</div>

				<div class="InputRow">
					<!--  img src="/marketplace/captcha2.jpg" alt="" id="Captcha" />
					<br/><a href="#" onclick="captcha_refresh()">Get new code</a>
					<br/><span class="Label">Enter the code shown above</span><?=$AppContext->ErrorMessage['Verification'] ? "<br/>" : ""?><?=FormError($AppContext, 'Verification')?><br/>
					<input id="Form_Verification" class="<?=isset($AppContext->ErrorMessage['Verification'])?'Error':'Input'?>" type="text" name="verification" size="20" maxlength="5" onfocus="Csw('Form_Verification','Input','Focus');" onblur="Csw('Form_Verification','Focus','Input');" tabindex="<?=$TabIndex?>"/>
					<script type="text/javascript">
						  function captcha_refresh() {
						  e=document.getElementById('Captcha');
						  dv=new Date();
						  e.src="/marketplace/captcha2.jpg?dummy=" + dv.getTime();
						  return false;
						}
					</script>				
				<br/><?=FormError($AppContext, 'Terms')?>
				<br/  --><input id="Form_Terms" type="checkbox" name="terms" tabindex="<?=$TabIndex?>" <?=isset($Params->AccepTerms) && isset($Params->AccepTerms)?" checked=\"true\"":''?>/>&nbsp;I have read and agree to the <a href="/tos/"><strong>Terms and Conditions</strong></a></div>

			<input type="hidden" name="step" value="1" />
			<div class="PaddedBox4 Spacer">
				<div class="ButtonRow"><span class="ButtonRowRight"><input type="submit" class="Button" name="submit" value="Next" /></span><input type="Submit" class="Button" name="submit" value="Cancel" /></div>
				<div class="Spacer"></div>
			</div>
		 </form>
