<?php
 require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Class.ApplicationContext.php");
 $ServiceName = $AppContext->Configuration["SERVICE.NAME.VIDEO"];
 $Service = $AppContext->ServiceRegistry->Lookup($ServiceName);

 $Params->Category = isset($_REQUEST['cn']) && !empty($_REQUEST['cn']) ? $_REQUEST['cn'] : $_REQUEST['cc'];
 $Params->Page = isset($_REQUEST['pp']) && !empty($_REQUEST['pp']) ? $_REQUEST['pp'] : 1;

 $ContextPath = "/video/browse/";
 $Response = $Service->Execute(&$AppContext, "GetVideosListCount", $Params);
 $itemsTotalCount = $Response->Object->Count;
 $AppContext->Configuration["PAGING_OFFSET"] = 16;
?>
<p><big><big class="GrnTxt">&nbsp;Browse Videos</big></big></p>
<div class="BorderBox1">
	<table class="Playlist" border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
<?php
	$Params->Offset = 16;
	$Response = $Service->Execute(&$AppContext, "GetVideosList", $Params);
	if($Response->Success)
	{
		$Counter = 0;
		foreach($Response->Object as $VideoInfo)
		{
			if($Counter % 4 == 0)
			{
				echo "<tr>";
			}
			$VideoInfo->ThumbUrl = "/Assets/video/" . (isset($VideoInfo->VideoCollID) && !empty($VideoInfo->VideoCollID) ? $VideoInfo->VideoCollID : $VideoInfo->VideoID) . "/" . $VideoInfo->ThumbUrl;
			$Description = $VideoInfo->Description;
			$VideoInfo->Description = substr($Description, 0, 18) . (strlen($Description) > 18 ? " ..." : "");
			$Link = "/video/play".(isset($VideoInfo->VideoCollID) && !empty($VideoInfo->VideoCollID) ? "/$VideoInfo->VideoCollID" : "")."/$VideoInfo->VideoID";
			$Counter++;
?>
			<td valign="top" width="100%"<?=(isset($VideoInfo->VideoID) && $_REQUEST['vid']==$VideoInfo->VideoID)?" class=\"Current\"":""?> id="<?=$VideoInfo->VideoID?>" style="padding-left:.7em;">
				<a href="<?=$Link?>"><img src="<?=$VideoInfo->ThumbUrl?>" border="0" vspace="5" width="125" height="100" /><img class="BtnPlay" border="0" src="/images/ico_play.gif" alt="" align="left" vspace="2" /></a>
				<h3 class="BluTxt"><a class="BluTxt" href="<?=$Link?>"><?=ucwords($VideoInfo->Title)?></a></h3>
				<p class="Caption"><?=$VideoInfo->Description?></p>
			</td>
<?php
			if($Counter % 4 == 0)
			{
				echo "</tr>";
			}
		}
	}
?>
		</tbody>
	</table>
</div>