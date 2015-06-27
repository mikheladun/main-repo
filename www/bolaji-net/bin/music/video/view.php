<?php
	$Counter = 0;
	foreach($Response->Object as $VideoInfo)
	{
		if($Counter % 5 == 0)
		{
			echo "<tr>";
		}
		$Counter++;
?>
		<td class="Playlist" style="text-align:center;" align="center" valign="top" width="20%"<?=(isset($VideoInfo->VideoID) && $_REQUEST['vid']==$VideoInfo->VideoID)?" class=\"Current\"":""?> id="<?=$VideoInfo->ArtistID,$VideoInfo->VideoID?>">
			<p><a href="/music/play/videos/<?=$VideoInfo->VideoID?><?=$Bpage?"-$Bpage":""?>"><img src="<?=$VideoInfo->ThumbUrl?>" border="0" vspace="0" /><img class="BtnPlay" style="margin:-1.8em 0 0 2em;" border="0" src="/images/ico_play.gif" alt="" align="left" vspace="2" /></a></p>
			<h3><a href="/music/play/videos/<?=$VideoInfo->VideoID?><?=$Bpage?"-$Bpage":""?>"><?=ucwords($VideoInfo->ArtistName)?></a><br/><a href="/music/play/videos/<?=$VideoInfo->VideoID?><?=$Bpage?"-$Bpage":""?>"><small class="BluTxt"><?=ucwords($VideoInfo->Title)?></small></a></h3>
		</td>
<?php
		if($Counter % 5 == 0)
		{
			echo "</tr>";
		}
	}
?>