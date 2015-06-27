<?php
 require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Class.ApplicationContext.php");
 require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Utils.php");
 $Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.MKTPLC"]);

 $Params->Category = isset($_REQUEST['cn']) && !empty($_REQUEST['cn']) ? $_REQUEST['cn'] : $_REQUEST['cc'];
 $Params->Page = isset($_REQUEST['pp']) && !empty($_REQUEST['pp']) ? $_REQUEST['pp'] : 1;

 $Response = $Service->Execute(&$AppContext, "GetMarketplaceItemsListCount", $Params);
 $itemsTotalCount = $Response->Object->Count;

 $Response = $Service->Execute(&$AppContext, "GetMarketplaceItemsList", $Params);
 if($Response->Success && $Response->CountRows > 0 )
 {
 	require_once("browseheader.php");

 	$Count = $Response->CountRows;
	$Counter = 0;
	$MarketplaceInfos = $Response->Object;
	foreach ($MarketplaceInfos as $MarketplaceInfo)
	{
		$Link = empty($MarketplaceInfo->ParentCategoryNameID)?"":$MarketplaceInfo->ParentCategoryNameID."/";
		$Link .= empty($MarketplaceInfo->CategoryNameID)?"":$MarketplaceInfo->CategoryNameID."/";

		if($Counter == 0 || itemsTotalCount > 1)
		{
			echo "<div class=\"Spacer PaddedBox\">";
			require(dirname(__FILE__)."/../includes/breadcrumbs.php");
			echo "<div class=\"Spacer\"></div></div>";
		}
		++$Counter;

		if($Counter == 5)
		{
			include(dirname(__FILE__)."/../includes/ads/txtimg_468x60.php"); 
		}
		
		echo "<p>&nbsp;</p>";
		require("browseitem.php");
	}

	echo "<div class=\"Spacer PaddedBox\">";
	require(dirname(__FILE__)."/../includes/breadcrumbs.php");
	echo "<div class=\"Spacer\"></div></div>";
 }
 else 
 { 
  	require_once("browsenone.php");
 } 

 require_once("browseother.php");
?>