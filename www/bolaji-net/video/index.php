<?php require_once(dirname(__FILE__)."/../includes/session.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/title.php") ?>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/meta.php") ?>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/script.php") ?>
<link rel="stylesheet" type="text/css" href="/style/player.css" title="dark" media="screen" />
<?php require_once(dirname(__FILE__)."/../skeleton/layout/style.php") ?>
<script type="text/javascript">
 var _cc = '<?=$_REQUEST['cid']?>';
 var _sid = '<?=$_REQUEST['vid']?>';
 var _cid = '<?=$_REQUEST['cid']?>';
</script>
<?php if( (isset($_REQUEST['vid']) && !empty($_REQUEST['vid'])) ) { ?>
<script type="text/javascript" src="/script/vidplayer.js"></script>
<script type="text/javascript">
 soundManager.debugMode = false;
 soundManager.onload = function() {
 }
</script>
<?php } ?>
</head>
<body>
<div id="Wrapper">
  <?php require_once(dirname(__FILE__)."/../skeleton/layout/top.php") ?>
  <div id="Container">
    <div id="BaseContent">
      <div class="MainContentDiv">
	  	<?php require_once("subheader.php") ?>
        <?php
			require_once(isset($_REQUEST['cc']) && !empty($_REQUEST['cc']) && strtolower($_REQUEST['cc']) != "browse" ? "view.php" : "videotop.php" );
		?>
		<?php require_once(dirname(__FILE__)."/video.php") ?>
      </div>
      <div class="RightContentDiv">
        <?php require_once("nowplaying.php") ?>
		<?php include(dirname(__FILE__)."/../includes/ads/txtimg_250x250.php") ?>
		<div style="height:400px;">&nbsp;</div>
      </div>
      <div class="Spacer"></div>
    </div>
  </div>
  <?php require_once(dirname(__FILE__)."/../skeleton/layout/footer.php") ?>
  <div class="Spacer" />
</div>
</body>
</html>
