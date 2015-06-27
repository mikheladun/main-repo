<div align="center">
<?php
 if(isset($_REQUEST['vid']) && !empty($_REQUEST['vid']))
 {
	require_once(dirname(__FILE__)."/player/video.php");
	$Player = true;
 }
 elseif(isset($_REQUEST['sid']) && !empty($_REQUEST['sid']))
 {
	require_once(dirname(__FILE__)."/player/music.php");
	$Player = true;
 }
?>
<?php if($Player) { ?>
<div class="Playlist">
	<dl class="NowPlaying">
		<dd style="padding:.5em 0;padding-top:2em;width:18%;font-size:80%;" id="MPlayer_Id">LOADING...</dd>
		<dd class="End" id="MPlayer_Info" style="padding-right:0;width:80%"><br/>&nbsp;</dd>
		<div class="Spacer"></div>
	</dl>
</div>
<div class="Spacer"></div>
<?php } ?>
</div>

