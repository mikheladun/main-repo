<p><big class="GrnTxt"><big>&nbsp;Featured</big></big></p>
<div class="BorderBox1">
	<table class="Playlist" border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
<?php
require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Class.ApplicationContext.php");
$ServiceName = $AppContext->Configuration["SERVICE.NAME.MEDIA"];
$Service = $AppContext->ServiceRegistry->Lookup($ServiceName);
$Params->Rank = 1;
$Params->Offset = 9;
$Response = $Service->Execute(&$AppContext, "GetTopVideosList", $Params);
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
			<td valign="top" width="33%" style="padding-left:.7em;">
				<a href="/music/play/videos/<?=$VideoInfo->VideoID?>"><img src="<?=$VideoInfo->ThumbUrl?>" border="0" vspace="5" width="100" height="68" /><img class="BtnPlay" border="0" src="/images/ico_play.gif" alt="" align="left" vspace="2" /></a>
				<h3><a href="/music/play/videos/<?=$VideoInfo->VideoID?>"><?=ucwords($VideoInfo->ArtistName)?></a><br/><a href="/music/play/videos/<?=$VideoInfo->VideoID?>"><small class="BluTxt"><?=ucwords($VideoInfo->Title)?></small></a></h3>
				<p class="Caption">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean pulvinar.</p>
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