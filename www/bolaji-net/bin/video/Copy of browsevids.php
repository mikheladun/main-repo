<?php
 require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Class.ApplicationContext.php");
 $ServiceName = $AppContext->Configuration["SERVICE.NAME.VIDEO"];
 $Service = $AppContext->ServiceRegistry->Lookup($ServiceName);

 $Params->Category = isset($_REQUEST['cn']) && !empty($_REQUEST['cn']) ? $_REQUEST['cn'] : $_REQUEST['cc'];
 $Params->Page = isset($_REQUEST['pp']) && !empty($_REQUEST['pp']) ? $_REQUEST['pp'] : 1;

 $ContextPath = "/video/browse/";
 $Response = $Service->Execute(&$AppContext, "GetVideosListCount", $Params);
 $itemsTotalCount = $Response->Object->Count;
 $AppContext->Configuration["PAGING_OFFSET"] = 15;
?>
	<p class="SectionHeader">Browse Videos</p>
	<div class="PaddedBox1">
<?php $ContextPath = "/video/browse/"; include(dirname(__FILE__)."/../includes/breadcrumbs.php"); ?>
		<div class="Spacer"></div>
	</div>
<div class="ContentDiv">
	<table class="Playlist" border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
<?php
	$Response = $Service->Execute(&$AppContext, "GetVideosList", $Params);
	if($Response->Success)
	{
		$Counter = 0;
		foreach($Response->Object as $VideoInfo)
		{
			if($Counter % 3 == 0)
			{
				echo "<tr>";
			}
			$Counter++;
			$VideoInfo->ThumbUrl = "/Assets/video/" . (isset($VideoInfo->VideoCollID) && !empty($VideoInfo->VideoCollID) ? $VideoInfo->VideoCollID : $VideoInfo->VideoID) . "/" . $VideoInfo->ThumbUrl;
			$Description = $VideoInfo->Description;
			$VideoInfo->Description = substr($Description, 0, 40) . (strlen($Description) > 40 ? " ..." : "");
?>
			<td valign="top" width="33%"<?=(isset($VideoInfo->VideoID) && $_REQUEST['vid']==$VideoInfo->VideoID)?" class=\"Current\"":""?> id="<?=$VideoInfo->VideoID?>">
				<p><a href="/video/play<?=isset($VideoInfo->VideoCollID) && !empty($VideoInfo->VideoCollID) ? "/$VideoInfo->VideoCollID" : ""?>/<?=$VideoInfo->VideoID?>"><img src="<?=$VideoInfo->ThumbUrl?>" border="0" vspace="5" hspace="5" /></a></p>
				<h3><a href="/video/play<?=isset($VideoInfo->VideoCollID) && !empty($VideoInfo->VideoCollID) ? "/$VideoInfo->VideoCollID" : ""?>/<?=$VideoInfo->VideoID?>"><?=$VideoInfo->Title?></a></h3>
				<p class="Caption BluTxt"><?=$VideoInfo->Description?></p>
				<p>&nbsp;</p>
			</td>
<?php
			if($Counter % 3 == 0)
			{
				echo "</tr>";
			}
		}
	}
?>
		</tbody>
	</table>
</div>
	<div class="PaddedBox1">
<?php include(dirname(__FILE__)."/../includes/breadcrumbs.php"); ?>
		<div class="Spacer"></div>
	</div>