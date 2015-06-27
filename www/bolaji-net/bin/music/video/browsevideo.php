<div class="ContentDiv">
<?php
 require_once(dirname(__FILE__)."/../../Library/Framework/Core/Framework.Class.ApplicationContext.php");

 $ServiceName = $AppContext->Configuration["SERVICE.NAME.MEDIA"];
 $Service = $AppContext->ServiceRegistry->Lookup($ServiceName);

 $Response = $Service->Execute(&$AppContext, "GetMusicVideosListCount", $Params);
 $itemsTotalCount = $Response->Object->Count;
 $AppContext->Configuration["PAGING_OFFSET"] = 15;
 //$AppContext->Configuration["PAGING_DISPLAY_MAX"] = 15;
?>
<div id="TabDiv2" class="ThreeTabPortalDiv">
	<div class="PaddedBox Spacer">
<?php $ContextPath = "/music/browse/videos/"; include(dirname(__FILE__)."/../../includes/breadcrumbs.php"); ?>
	<div class="Spacer"></div>
	</div>
		<div id="Tab1Div" class="PaddedBox1 Current" style="padding:0 .2em;">
<?php
 $Params->Page = !isset($_REQUEST['pp']) || empty($_REQUEST['pp']) ? 1 : $_REQUEST['pp'];
 $Params->Offset = 15;
 $Response = $Service->Execute(&$AppContext, "GetMusicVideosList", $Params);
 if(!$Bpage)
 { 
 	$Bpage = $Params->Page;
 }
?>
	<table class="Playlist" border="0" cellpadding="0" cellspacing="3" width="100%">
		<tbody>
<?php
if($Response->Success)
{
	$Counter = 0;
	include("view.php");
}
?>
		</tbody>
	</table>
</div>
	<div class="PaddedBox">
<?php $ContextPath = "/music/browse/videos/"; include(dirname(__FILE__)."/../../includes/breadcrumbs.php"); ?>
		<div class="Spacer"></div>
	</div>
</div>
<p>&nbsp;</p>
</div>