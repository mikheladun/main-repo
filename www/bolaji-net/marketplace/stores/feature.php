<div class="ContentDiv">
<?php
 require_once(dirname(__FILE__)."/../../Library/Framework/Core/Framework.Class.ApplicationContext.php");
 require_once(dirname(__FILE__)."/../../Library/Framework/Core/Framework.Utils.php");
 $Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.MKTPLC"]);
 $Params = new stdClass();
 $Params->Rank = 1;
 $Params->Page = 1;
 $Params->Offset = 20;
 $Response = $Service->Execute($AppContext, "GetFeatureStoreList", $Params);
 if($Response->Success)
 {
 	if($Response->Object != NULL)
	{
?>
	<ul class="HorizList PaddedBox">
<?php
	 foreach ($Response->Object as $StoreInfo)
	 {
?>
		<li><a href="<?=$StoreInfo->Url?>"><img border="0" src="<?=$StoreInfo->Pic?>" alt="<?=$StoreInfo->Name?>" hspace="5" vspace="5" /></a></li>
<?php
	 }
?>
	</ul>
	<div class="Spacer"></div>
<?php
	}
 }
?>
</div>
