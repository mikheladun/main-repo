<?php require_once(dirname(__FILE__)."/../includes/session.php"); ?>
<!DOCTYPE html>
<head>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/title.php") ?>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/meta.php") ?>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/script.php") ?>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/style.php") ?>
<script type="text/javascript">
 var _cc = '<?=$_REQUEST['cc']?>';
 var _sid = '<?=$_REQUEST['sid']?>';
 var _aid = '<?=$_REQUEST['aid']?>';
</script>
<!--  script type="text/javascript" src="/script/soundmanager2-jsmin.js"></script  -->
<?php
	if(isset($_REQUEST['sid']) && !empty($_REQUEST['sid']))
	{
?>
<script src="/script/swfobject.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript">
 var flashvars = {};
 flashvars.cc = '<?=$_REQUEST['cc']?>';
 flashvars.sid = '<?=$_REQUEST['sid']?>';
 flashvars.aid = '<?=$_REQUEST['aid']?>';
 flashvars.debug = true;
 swfobject.embedSWF("/music/musicplayer.swf", "MusicPlayer", "490", "150", "8","expressinstall.swf",flashvars,false,false);

 function nowplaying(aid, sid, nameid, title, subtitle) {
	$('NowPlayn_Info').setHTML(title.toUpperCase() + ' - <span style=\"text-transform:capitalize;\">' + subtitle + '</span>');
	$('NowPlayn_Url').setHTML("<a class=\"BluTxt\" href=\"/music/artist/" + nameid + "\">Go to artist's page</a>&nbsp;&raquo;");
	//Highlight selection in .Playlist
	if(!$(aid+sid).hasClass('Current'))
	{
		$$('.Playlist .Current').each(function(elem){elem.removeClass('Current')});
		$$('#'+aid+sid).each(function(elem){elem.addClass('Current')});	
	}
 }
</script>

<!-- script type="text/javascript" src="/script/soundmanager2.js"></script>
<script type="text/javascript">
 soundManager.debugMode = true;
 soundManager.onload = function() {
 }
</script  -->
<?php } ?>
<link rel="stylesheet" type="text/css" href="/style/player.css" title="dark" media="screen" />
<style type="text/css">
.Playlist .BtnPlay{position:relative;margin-top:-2.5em;}
.Playlist A>.BtnPlay{margin-top:-1.85em;}
</style>
</head>
<body>
<div id="Wrapper">
  <?php require_once(dirname(__FILE__)."/../skeleton/layout/top.php") ?>
  <div id="Container">
    <div id="BaseContent">
      <div class="MainContentDiv">
	  	<?php require_once("nowplaying.php") ?>
	  	<div align="center">
			<?php require((!isset($_REQUEST['cc']) || empty($_REQUEST['cc']) ? "feature/feature.php" : "mediaplayer.php") );?>
		</div>
        <?php require("browselinks.php") ?>
        <?php require_once("playlist.php") ?>
        <?php include(dirname(__FILE__)."/../includes/ads/txtimg_468x60.php") ?>
      </div>
      <div class="RightContentDiv">
		<?php require_once("videolinks.php") ?>
		<p>&nbsp;</p>
		<?php include(dirname(__FILE__)."/../includes/ads/txtimg_250x250.php") ?>
      </div>
      <div class="Spacer"></div>
    </div>
  </div>
  <?php require_once(dirname(__FILE__)."/../skeleton/layout/footer.php") ?>
  <div class="Spacer" />
</div>
</body>
</html>
