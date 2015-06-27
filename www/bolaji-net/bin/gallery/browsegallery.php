<?php
 require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Class.ApplicationContext.php");
 $ServiceName = $AppContext->Configuration["SERVICE.NAME.GALLERY"];
 $Service = $AppContext->ServiceRegistry->Lookup($ServiceName);

 $Params->Category = isset($_REQUEST['cn']) && !empty($_REQUEST['cn']) ? $_REQUEST['cn'] : $_REQUEST['cc'];
 $Params->Page = isset($_REQUEST['pp']) && !empty($_REQUEST['pp']) ? $_REQUEST['pp'] : 1;

 $Response = $Service->Execute(&$AppContext, "GetPhotosListCount", $Params);
 $itemsTotalCount = $Response->Object->Count;
?>
	<p class="SectionHeader">Browse Photos</p>
	<div class="PaddedBox">
<?php $ContextPath = "/photos/browse/"; include(dirname(__FILE__)."/../includes/breadcrumbs.php"); ?>
		<div class="Spacer"></div>
	</div>
<?php
	$Response = $Service->Execute(&$AppContext, "GetPhotoGalleryList", $Params);
	if($Response->Success)
	{
		$Counter = 0;
		foreach($Response->Object as $MediaInfo)
		{
			$Counter++;
?>
		<div class="Playlist">
		  <dl>
		  	<dd style="width:98%;">
				<a href="/photos/view/<?=$MediaInfo->GalleryID?>/<?=$MediaInfo->PhotoID?>"><img src="/Assets/photos/<?=$MediaInfo->ThumbURL?>" border="0" align="left" /></a>
				<h3 style="margin-left:90px;"><a href="/photos/view/<?=$MediaInfo->GalleryID?>/<?=$MediaInfo->PhotoID?>"><?=$MediaInfo->Title?></a></h3>
				<p class="Caption" style="margin-left:90px;"><a href="/photos/view/<?=$MediaInfo->GalleryID?>/<?=$MediaInfo->PhotoID?>"><?=$MediaInfo->Description?></a></p>
			  </dd>
		  </dl>
		</div>
<?php
		}
	}
?>
	<div class="Spacer"></div>
	<div class="PaddedBox">
<?php include(dirname(__FILE__)."/../includes/breadcrumbs.php"); ?>
	<div class="Spacer"></div>
	</div>
