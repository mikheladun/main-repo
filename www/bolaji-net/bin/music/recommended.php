	<p class="SectionHeader">Recommended</p>
	<table class="Playlist" border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
<?php
 	require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Class.ApplicationContext.php");
	$ServiceName = $AppContext->Configuration["SERVICE.NAME.MEDIA"];
	$Service = $AppContext->ServiceRegistry->Lookup($ServiceName);
	$Params = new stdClass();
        $Params->Rank = 2;
	$Params->Offset = 10;
	$Response = $Service->Execute($AppContext, "GetTopSongsList", $Params);
	if($Response->Success)
	{
		$Counter = 0;
		foreach($Response->Object as $SongInfo)
		{
			$Counter++;
?>
		<tr<?=(isset($SongInfo->SongID) && $_REQUEST['sid']==$SongInfo->SongID)?" class=\"Current\"":""?> id="<?=$SongInfo->ArtistID,$SongInfo->SongID?>">
			<td class="Id" valign="top"><?=$Counter?></td>
			<td valign="top"><h3><a href="/music/play/rec/<?=$SongInfo->ArtistID?>/<?=$SongInfo->SongID?>"><?=ucwords($SongInfo->ArtistName)?></a><br/><a href="/music/play/rec/<?=$SongInfo->ArtistID?>/<?=$SongInfo->SongID?>"><small class="BluTxt"><?=ucwords($SongInfo->Title)?></small></a></h3></td>
		</tr>
<?php
		}
	}
?>
		</tbody>
	</table>
