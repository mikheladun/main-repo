<?php
	$Service = $AppContext->ServiceRegistry->Lookup($ServiceName);
	$Params->Artistid = $Artist->ArtistID;
	$Response = $Service->Execute(&$AppContext, "GetArtistSongs", $Params);
	if($Response->Success)
	{
		if($Response->Object != NULL)
		{
			$HasMusic = true;
			$Counter = 0;
?>
	<table class="Playlist" border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
<?php
			$ShowScroller = count($Response->Object) > 9 ? true : false;
			foreach($Response->Object as $SongInfo)
			{
				$Counter++;
?>
		<tr<?=(isset($SongInfo->SongID) && $_REQUEST['sid']==$SongInfo->SongID)?" class=\"Current\"":""?> id="<?=$SongInfo->ArtistID,$SongInfo->SongID?>"><td class="Id" valign="top"><?=$Counter?></td><td class="Track" style="width:93%;"><a href="/music/play/artist/<?=$SongInfo->ArtistID?>/<?=$SongInfo->SongID?>" title="<?=$Artist->Name?> - <?=ucwords($SongInfo->Title)?>"><?=ucwords($SongInfo->Title)?></a></td></tr>
<?php
			}
?>
		</tbody>
	</table>
<?php
		}
		else
		{
?>
<table class="Playlist" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
		<tr><td colspan="3">No music found</td></tr> 
	</tbody>
</table>
<?php
		}
	}
?>