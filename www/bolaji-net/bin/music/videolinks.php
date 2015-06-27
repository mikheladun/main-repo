<p class="SectionHeader" style="padding:0 .5em .2em .5em;background:none;">
	<span class="FloatRight" style="text-transform:lowercase;"><a class="GrnTxt" href="/music/videos/">more &raquo;&nbsp;&nbsp;</a></span>
	<span class="GrnTxt"><big><strong><a class="GrnTxt" href="/music/videos/">Music Videos</a></strong></big></span>
</p>
<div class="ContentDiv BorderBox1">
	<table class="Playlist" border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
<?php
	$Params->Rank = 1;
	$Params->Offset = 10;
	$Response = $Service->Execute(&$AppContext, "GetTopVideosList", $Params);
	if($Response->Success)
	{
		$Counter = 0;
		foreach($Response->Object as $VideoInfo)
		{
			if($Counter % 2 == 0)
			{
				echo "<tr>";
			}
			$Counter++;
?>
			<td valign="top" width="50%" style="padding-left:.7em;">
				<a href="/music/play/videos/<?=$VideoInfo->VideoID?>"><img src="<?=$VideoInfo->ThumbUrl?>" border="0" vspace="5" /><img class="BtnPlay" border="0" src="/images/ico_play.gif" alt="" align="left" vspace="2" /></a>
				<h3><a href="/music/play/videos/<?=$VideoInfo->VideoID?>"><?=ucwords($VideoInfo->ArtistName)?></a><br/><a href="/music/play/videos/<?=$VideoInfo->VideoID?>"><small class="BluTxt"><?=ucwords($VideoInfo->Title)?></small></a></h3>
			</td>
<?php
			if($Counter % 2 == 0)
			{
				echo "</tr>";
			}
		}
	}
?>
		</tbody>
	</table>
</div>
