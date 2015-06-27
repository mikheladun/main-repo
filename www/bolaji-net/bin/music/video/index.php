<?php require_once(dirname(__FILE__)."/../../includes/session.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/title.php") ?>
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/meta.php") ?>
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/script.php") ?>
<link rel="stylesheet" type="text/css" href="/style/player.css" title="dark" media="screen" />
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/style.php") ?>
<script type="text/javascript">
 var _cc = '<?=$_REQUEST['cc']?>';
 var _sid = '<?=$_REQUEST['vid']?>';
 var _aid = '<?=$_REQUEST['aid']?>';
</script>
<?php if((isset($_REQUEST['vid']) && !empty($_REQUEST['vid'])) || (isset($_REQUEST['sid']) && !empty($_REQUEST['sid']))) { ?>
<script type="text/javascript" src="/script/flvplayer.js"></script>
<script type="text/javascript">
 soundManager.debugMode = true;
 soundManager.onload = function() {
 }
</script>
<?php } ?>
<style type="text/css">
.Playlist .BtnPlay{position:relative;margin-top:-2.5em;}
.Playlist A>.BtnPlay{margin-top:-1.8em;}
</style>
</head>
<body>
<div id="Wrapper">
  <?php require_once(dirname(__FILE__)."/../../skeleton/layout/top.php") ?>
  <div id="Container">
    <div id="BaseContent">
      <div class="MainContentDiv">
        <?php require_once(dirname(__FILE__)."/../subheader.php") ?>
		<?php require_once(dirname(__FILE__)."/../nowplaying.php") ?>
        <?php
			require((!isset($_REQUEST['vid']) || empty($_REQUEST['vid']) ? "feature.php" : "music/mediaplayer.php") );
		?>
      </div>
      <div class="RightContentDiv">
        <?php require_once("relatedvids.php"); ?>
       </div>
      <div class="Spacer"></div>
      <?php require_once("videosmain.php"); ?>
    </div>
  </div>
  <?php require_once(dirname(__FILE__)."/../../skeleton/layout/footer.php") ?>
  <div class="Spacer" />
</div>
</body>
</html>
