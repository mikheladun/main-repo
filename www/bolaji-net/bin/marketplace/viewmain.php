<div class="ContentDiv">
<?php
 require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Class.ApplicationContext.php");
 require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Utils.php");
 $Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.MKTPLC"]);
 $Params->Itemid = $_REQUEST['mid'];
 $Response = $Service->Execute(&$AppContext, "GetMarketplaceItem", $Params);
 if($Response->Success)
 {
	$MarketplaceInfo = $Response->Object[0];
	$Count = $Response->CountRows;
	if(isset($MarketplaceInfo->ImageUrl) && !empty($MarketplaceInfo->ImageUrl))
	{
		$Images = array();
		for($i=0; $i < $Count; $i++)
		{
			$Object = $Response->Object[$i];
			$Images[] = $Object->ImageUrl;
		}
		
		$MarketplaceInfo->Images = $Images;
	}
?>
	<dl class="Mktplc">
		<dd style="width:97%;">
			<h3><?=$MarketplaceInfo->Title?><br/>&nbsp;</h3>
			<p class="Caption"><?=nl2br($MarketplaceInfo->Description)?><br/>&nbsp;</p>
			<?php if(isset($MarketplaceInfo->Images) && !empty($MarketplaceInfo->Images) ) { ?>
			<div id="PicViewer" class="PicViewer">
				 <div class="Images">
			<?php foreach($MarketplaceInfo->Images as $Image) { ?>
				<img src="/Assets/marketplace/listing/<?=$Image?>" alt="" hspace="5" vspace="5" />
			<?php } ?>
				</div>
			</div>
			<?php } ?>
			<?php if(count($MarketplaceInfo->Images) > 1) { ?>
			<!--  div class="Cntrl" align="center"><img id="PicViewL" src="/images/ico_left.gif" align="left" alt="prev image" /><span><a id="PicViewerC">1</a>&nbsp;/&nbsp;<?=count($MarketplaceInfo->Images)?></span><img id="PicViewR" src="/images/ico_right.gif" alt="next image" /><input id="PicViewerT" type="hidden" value="<?=count($MarketplaceInfo->Images)?>" /></div -->
			<?php } ?>
		</dd>
	</dl>
	<div class="Divider"></div>
		<?php } ?>
			<p class="PaddedBox4 BlkTxt" align="center">
		<?php
			list($Host,$Url) = explode("/", $_SERVER['HTTP_REFERER'], 2);

			if(isset($_REQUEST['cid']) && !empty($_REQUEST['cid'])) { ?>
					<a href="/<?=$Url?>">Back to <strong><?=ucwords(str_replace("-"," ",$_REQUEST['cn']))?>&nbsp;&gt;&nbsp;<?=ucwords(str_replace("-"," ",$_REQUEST['cid']))?></strong></a>
		<?php } else { ?>
					<a href="/<?=$Url?>">Back to <strong><?=ucwords(str_replace("-"," ",$_REQUEST['cn']))?></strong></a>
		<?php } ?>
		</p>
</div>