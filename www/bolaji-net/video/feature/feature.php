<div class="BorderBox1">
	<div class="PaddedBox"><big><big class="GrnTxt">Featured Videos</big></big></div>
	<table class="Playlist" border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
<?php
 	require_once(dirname(__FILE__)."/../../Library/Framework/Core/Framework.Class.ApplicationContext.php");
	$ServiceName = $AppContext->Configuration["SERVICE.NAME.VIDEO"];
	$Service = $AppContext->ServiceRegistry->Lookup($ServiceName);
	$Params = new stdClass();
        $Params->Rank = 1;
	$Params->Offset = 3;
	$Response = $Service->Execute($AppContext, "GetTopVideosList", $Params);
	if($Response->Success)
	{
		$Counter = 0;
		foreach($Response->Object as $VideoInfo)
		{
			if($Counter % 3 == 0)
			{
				echo "<tr>";
			}
			//$VideoInfo->ThumbUrl = "/Assets/video/" . (isset($VideoInfo->VideoCollID) && !empty($VideoInfo->VideoCollID) ? $VideoInfo->VideoCollID : $VideoInfo->VideoID) . "/" . $VideoInfo->ThumbUrl;
			$VideoInfo->ThumbUrl = "/Assets/video" . $VideoInfo->ThumbUrl;
			$Description = $VideoInfo->Description;
			$VideoInfo->Description = substr($Description, 0, 100) . (strlen($Description) > 100 ? " ..." : "");
			$Link = "/video/play".(isset($VideoInfo->VideoCollID) && !empty($VideoInfo->VideoCollID) ? "/$VideoInfo->VideoCollID" : "")."/$VideoInfo->VideoID";

			$Counter++;
?>
			<td valign="top" width="33%"<?=(isset($VideoInfo->VideoID) && $_REQUEST['vid']==$VideoInfo->VideoID)?" class=\"Current\"":""?> id="<?=$VideoInfo->VideoID?>">
				<a href="<?=$Link?>"><img src="<?=$VideoInfo->ThumbUrl?>" border="0" vspace="5" width="125" height="100" /><img class="BtnPlay" border="0" src="/images/ico_play.gif" alt="" align="left" vspace="2" /></a>
				<h3 style="margin-right:1em;"><a href="<?=$Link?>"><?=ucwords($VideoInfo->Title)?></a></h3>
				<p class="Caption" style="margin-right:1em;"><?=$VideoInfo->Description?></p>
			</td>
<?php
			if($Counter % 3 == 0)
			{
				echo "<tr>";
			}
		}
	}
?>
		</tbody>
	</table>
</div>
<div class="Divider"></div>
