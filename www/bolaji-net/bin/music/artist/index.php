<?php require_once(dirname(__FILE__)."/../../includes/session.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/title.php") ?>
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/meta.php") ?>
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/script.php") ?>
<script src="/script/swfobject.js" language="JavaScript" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/style/player.css" title="dark" media="screen" />
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/style.php") ?>
<?php if(isset($_REQUEST['sid']) || isset($_REQUEST['vid'])) { ?>
<script type="text/javascript">
 var _cc = '<?=$_REQUEST['cc']?>';
 var _sid = '<?=isset($_REQUEST['vid']) ? $_REQUEST['vid'] : $_REQUEST['sid']?>';
 var _aid = '<?=$_REQUEST['aid']?>';
</script>
<?php }  if(isset($_REQUEST['vid'])) { ?>
 <script type="text/javascript" src="/script/flvplayer.js"></script>
<?php } else { ?>
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
<?php } ?>
</head>
<body>
<div id="Wrapper">
  <?php require_once(dirname(__FILE__)."/../../skeleton/layout/top.php") ?>
  <div id="Container">
	  <div id="BaseContent">
	  	<div class="MainContentDiv">
			<?php require_once("artistmain.php"); ?>
			<?php require_once("artistprofile.php"); ?>
			<?php include(dirname(__FILE__)."/../../includes/ads/txtimg_468x60.php"); ?>
		</div>
		<div class="RightContentDiv">
			<?php require_once("artistrelated.php"); ?>
			<?php require_once("music/ads/topright.php"); ?>
		</div>
		<div class="Spacer"></div>
	  </div>
	</div>
	<?php require_once(dirname(__FILE__)."/../../skeleton/layout/footer.php") ?>
  <div class="Spacer" />
</div>
</body>
</html>