<p class="SectionHeader"><span class="FloatRight"><a style="text-transform:lowercase;" href="/music/videos/">more &raquo;</a></span><a href="/music/videos/">Music Videos</a>&nbsp;</p>
<table class="Playlist" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
<?php
	$Params->Rank = 1;
	$Params->Offset = 9;
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
			$Counter++;
?>
			<td valign="top" width="33%" style="padding-right:0em;">
				<a href="/music/play/videos/<?=$VideoInfo->VideoID?>"><img src="<?=$VideoInfo->ThumbUrl?>" border="0" width="110" height="75" /><img class="BtnPlay" border="0" src="/images/ico_play.gif" alt="" align="left" vspace="1" /></a>
				<h3><a href="/music/play/videos/<?=$VideoInfo->VideoID?>"><?=ucwords($VideoInfo->ArtistName)?></a><br/><a href="/music/play/videos/<?=$VideoInfo->VideoID?>"><small class="BluTxt"><?=ucwords($VideoInfo->Title)?></small></a></h3>
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
