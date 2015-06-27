<?php require_once(dirname(__FILE__)."/../includes/session.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
<script type="text/javascript" src="/script/soundmanager2.js"></script>
<script type="text/javascript">
 soundManager.debugMode = true;
 soundManager.onload = function() {
 }
</script>
<?php } ?>
<link rel="stylesheet" type="text/css" href="/style/player.css" title="dark" media="screen" />
</head>
<body>
<div id="Wrapper">
  <?php require_once(dirname(__FILE__)."/../skeleton/layout/top.php") ?>
  <div id="Container">
    <div id="MainContent">
      <div class="MainContentDiv" align="center">
        <?php require((!isset($_REQUEST['cc']) || empty($_REQUEST['cc']) ? "feature/feature.php" : "mediaplayer.php") );?>
      </div>
      <div class="ContentDiv">
	  	<?php require_once("nowplaying.php") ?>
	  </div>
    </div>
    <div id="BaseContent">
      <div class="MainContentDiv">
        <?php require("browselinks.php") ?>
        <?php require_once("playlist.php") ?>
        <?php require_once("ads/topbanner.php") ?>
        <?php include(dirname(__FILE__)."/../includes/ads/txtimg_468x60.php") ?>
      </div>
      <div class="RightContentDiv">
        <?php require_once("videolinks.php") ?>
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
