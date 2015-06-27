<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/title.php") ?>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/meta.php") ?>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/script.php") ?>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/style.php") ?>
<style type="text/css">
.Playlist Tr.Current A {color:#153E7E;}
.Playlist Tr.Current .Caption{margin:0 .5em;padding-top:.2em;font-size:95%;color:#121212;font-weight:normal;}
</style>
</head>
<body>
<div id="Wrapper">
  <?php require_once(dirname(__FILE__)."/../skeleton/layout/top.php") ?>
  <div id="Container">
	  <div id="BaseContent">
	  	<div class="MainContentDiv">
			 <?php require(dirname(__FILE__)."/feedback.php") ?>
		</div>
		<div class="RightContentDiv">
			<?php include(dirname(__FILE__)."/../includes/ads/txt_250x250.php") ?>
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