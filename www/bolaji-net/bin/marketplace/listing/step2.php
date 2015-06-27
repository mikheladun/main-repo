			<p align="center" class="PaddedBox4"><strong>Step 2 of 2:&nbsp;Preview Your Listing</strong></p>
		 <form name="MktplcForm" action="/marketplace/listing/" method="post">
			<?php if(!empty($AppContext->ErrorMessage['MktplcForm_Error'])) { ?><p class="Error"><big>Correct all the errors and resubmit again.</big></p><p>&nbsp;</p><?php } ?>
			<?php if(!empty($AppContext->Message['MktplcForm_Msg'])) { ?><p class="Message"><big><?=$AppContext->Message['MktplcForm_Msg']?></big></p><p>&nbsp;</p><?php } ?>

			<div class="ContentDiv">
				<dl class="Mktplc">
					<dd>
						<h3><?=$MarketplaceInfo->Title?></h3>
						<p class="Caption"><?=nl2br($MarketplaceInfo->Description)?></p>
						<p>&nbsp;</p>

						<?php if(isset($MarketplaceInfo->Images) && !empty($MarketplaceInfo->Images) ) { ?>
						<div id="PicViewer" class="PicViewer">
							 <div class="Images">
						<?php foreach($MarketplaceInfo->Images as $Image) { ?>
							<img src="/Assets/marketplace/listing/upload/<?=substr($Image,0,strpos($Image,'|'))?>" alt="" hspace="5" vspace="5" />
						<?php } ?>
							</div>
						</div>
						<?php } ?>
			
					</dd>
				</dl>
				<div class="Divider">&nbsp;</div>
			</div>
			<input type="hidden" name="step" value="2" />
			<div class="PaddedBox4 Spacer">
				<div class="ButtonRow"><span class="ButtonRowRight"><input type="Submit" class="Button" name="submit" value="Edit" /><input type="Submit" class="Button" name="submit" value="Save" /></span><input type="Submit" class="Button" name="submit" value="Cancel" /></div>
				<div class="Spacer"></div>
			</div>
		 </form>