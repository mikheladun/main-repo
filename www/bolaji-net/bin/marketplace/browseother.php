<?php

 require_once(dirname(__FILE__)."/ads.php");

 if((isset($_REQUEST['cn']) && !empty($_REQUEST['cn'])) && (!isset($Count) || $Count <= 10 ))
 {
	 $Params->Category = $_REQUEST['cc'];
	 $Params->Page = 1;
	 $Response = $Service->Execute(&$AppContext, "GetMarketplaceItemsList", $Params);
	 if($Response->Success && $Response->CountRows >= 1 )
	 {
?>
<div class="ContentDiv">
	<p class="PaddedBox4" align="center">Other items found in <strong><?=ucwords(str_replace("-"," ",$_REQUEST['cc']))?></strong></p>
<?php
	 	$Count = $Response->CountRows;
		$MarketplaceInfos = $Response->Object;
		foreach ($MarketplaceInfos as $MarketplaceInfo)
		{
			$Link = empty($MarketplaceInfo->ParentCategoryNameID)?"":$MarketplaceInfo->ParentCategoryNameID."/";
			$Link .= empty($MarketplaceInfo->CategoryNameID)?"":$MarketplaceInfo->CategoryNameID."/";
?>
	<dl class="Mktplc">
<?php
			if(!empty($MarketplaceInfo->ImageUrl))
			{
?>
		<dd style="height:90px;"><a href="/marketplace/view/<?=$Link?><?=$MarketplaceInfo->ItemID?>"><img border="0" src="/Assets/marketplace/listing/<?=$MarketplaceInfo->ImageUrl?>" alt="" height="75" align="left" /></a></dd>
<?php 		} ?>
		<dd style="<?= !empty($MarketplaceInfo->ImageUrl)?'width:71%;height:90px;':'width:97%;' ?>overflow:hidden;">
			<h3><a href="/marketplace/view/<?=$Link?><?=$MarketplaceInfo->ItemID?>"><?=$MarketplaceInfo->Title?></a></h3>
			<p class="Caption"><?=nl2br(substr($MarketplaceInfo->Description,0,200))?><?=strlen($MarketplaceInfo->Description) > 200 ? "..." : ""?></p>
		</dd>
	</dl>
	<div class="Spacer"></div>
<?php } ?>
	<div class="Spacer"></div>
	<p class="PaddedBox4" align="center"><a href="/marketplace/<?=$_REQUEST['cc']?>/">See more items in <strong><?=ucwords(str_replace("-"," ",$_REQUEST['cc']))?></strong></a></p>
</div>
<?php 
	}
}
?>