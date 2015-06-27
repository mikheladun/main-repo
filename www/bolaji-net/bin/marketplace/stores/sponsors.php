<div>
<?php
 require_once(dirname(__FILE__)."/../../Library/Framework/Core/Framework.Class.ApplicationContext.php");
 require_once(dirname(__FILE__)."/../../Library/Framework/Core/Framework.Utils.php");
 $Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.MKTPLC"]);
 $Params->Rank = 2;
 $Params->Page = 1;
 $Params->Offset = 4;
 $Response = $Service->Execute(&$AppContext, "GetFeatureStoreList", $Params);
 if($Response->Success)
 {
 	if($Response->Object != NULL)
	{
?>
	<p><br/><img src="/images/ico_advertisement.gif" border="0" alt="" /></p>
<?php
	 foreach ($Response->Object as $StoreInfo)
	 {
?>
		<a href="<?=$StoreInfo->Url?>" target="_blank"><img vspace="5" border="0" src="/Assets/<?=$StoreInfo->Pic?>" alt="<?=$StoreInfo->Name?>" /></a>
<?php
	 }
	}
 }
?>
</div>