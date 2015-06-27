<div>
<?php
 //if( (isset($_REQUEST['cc']) && !empty($_REQUEST['cc'])) || (isset($_REQUEST['vid']) && !empty($_REQUEST['vid'])) )
 if(isset($_REQUEST['gid']) && !empty($_REQUEST['gid']))
 {
	require_once(dirname(__FILE__)."/../gallery/viewer/viewer.php");
?>
<div class="Playlist">
	<dl class="NowPlaying">
		<dd style="width:11%;font-size:80%;" id="MPlayer_Id"><br/><br/>LOADING...</dd>
		<dd class="End" id="MPlayer_Info" style="width:86%"><br/>&nbsp;</dd>
		<div class="Spacer"></div>
	</dl>
</div>
<div class="Divider"></div>
<?php } ?>
</div>

