	<p class="SectionHeader">&nbsp;</p>
	<table class="Playlist" border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
<?php
 	require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Class.ApplicationContext.php");
	$ServiceName = $AppContext->Configuration["SERVICE.NAME.MEDIA"];
	$Service = $AppContext->ServiceRegistry->Lookup($ServiceName);
	$Params = new stdClass();
        $Params->Rank = 2;
	$Params->Offset = 3;
	$Response = $Service->Execute($AppContext, "GetTopVideosList", $Params);
	if($Response->Success)
	{
		$Counter = 0;
		foreach($Response->Object as $VideoInfo)
		{
			$Counter++;
?>
		<tr<?=(isset($VideoInfo->VideoID) && $_REQUEST['sid']==$VideoInfo->VideoID)?" class=\"Current\"":""?> id="<?=$VideoInfo->ArtistID,$VideoInfo->VideoID?>">
			<td class="Id" valign="top"><?=$Counter?></td>
			<td valign="top"<?=(isset($VideoInfo->VideoID) && $_REQUEST['vid']==$VideoInfo->VideoID)?" class=\"Current\"":""?> id="<?=$VideoInfo->ArtistID,$VideoInfo->VideoID?>">
				<p><a href="/music/play/videos/<?=$VideoInfo->VideoID?><?=$Bpage?"-$Bpage":""?>"><img src="<?=$VideoInfo->ThumbUrl?>" border="0" vspace="" width="100" height="75" /><img class="BtnPlay" border="0" src="/images/ico_play.gif" alt="" align="left" vspace="2" /></a></p>
				<h3><a href="/music/play/videos/<?=$VideoInfo->VideoID?><?=$Bpage?"-$Bpage":""?>"><?=ucwords($VideoInfo->ArtistName)?></a><br/><a href="/music/play/videos/<?=$VideoInfo->VideoID?><?=$Bpage?"-$Bpage":""?>"><small class="BluTxt"><?=ucwords($VideoInfo->Title)?></small></a><br/>&nbsp;</h3>
			</td>
		</tr>
<?php
		}
	}
?>
		</tbody>
	</table>
