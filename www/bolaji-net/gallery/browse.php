<?php
 require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Class.ApplicationContext.php");
 $ServiceName = $AppContext->Configuration["SERVICE.NAME.GALLERY"];
 $Service = $AppContext->ServiceRegistry->Lookup($ServiceName);

 $Params->Category = isset($_REQUEST['cn']) && !empty($_REQUEST['cn']) ? $_REQUEST['cn'] : $_REQUEST['cc'];
 $Params->Page = isset($_REQUEST['pp']) && !empty($_REQUEST['pp']) ? $_REQUEST['pp'] : 1;

 $Response = $Service->Execute(&$AppContext, "GetPhotosListCount", $Params);
 $itemsTotalCount = $Response->Object->Count;
?>
<div id="TabDiv2" class="ThreeTabPortalDiv">
	<ul class="MPlayerTabs">
		<li id="Tab1" class="Current" style="background:#f1f1f1;">Browse Photos</li>
	</ul>
	<div class="Spacer"></div>
			<div class="PaddedBox1 Spacer">
<?php $ContextPath = "/photos/browse/"; include(dirname(__FILE__)."/../includes/breadcrumbs.php"); ?>
			</div>
		<div id="Tab1Div" class="PaddedBox1 Current" style="padding:0 .2em;">
<?php
	$Response = $Service->Execute(&$AppContext, "GetPhotoGalleryList", $Params);
	if($Response->Success)
	{
		$Counter = 0;
		if($Response->Object != NULL)
		{
			foreach($Response->Object as $MediaInfo)
			{
				$Counter++;
?>
		<div class="Playlist">
		  <dl>
		  	<dd style="width:99%;">
				<a href="/photos/view/<?=$MediaInfo->GalleryID?>/<?=$MediaInfo->PhotoID?>"><img src="/Assets/photos/<?=$MediaInfo->ThumbURL?>" border="0" align="left" /></a>
				<h3 style="margin-left:90px;"><a href="/photos/view/<?=$MediaInfo->GalleryID?>/<?=$MediaInfo->PhotoID?>"><?=$MediaInfo->Title?></a></h3>
				<p class="Caption" style="margin-left:90px;"><a href="/photos/view/<?=$MediaInfo->GalleryID?>/<?=$MediaInfo->PhotoID?>"><?=$MediaInfo->Description?></a></p>
			  </dd>
		  </dl>
		</div>
<?php
			}
		}
	}
?>
		<div class="Divider"></div>
<?php include(dirname(__FILE__)."/../includes/breadcrumbs.php"); ?>
		<div class="Divider"></div>	
	</div>
</div>
