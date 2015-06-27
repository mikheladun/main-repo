<?php require_once(dirname(__FILE__)."/../includes/session.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/title.php") ?>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/meta.php") ?>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/style.php") ?>
<script src="/script/swfobject.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript">
   swfobject.embedSWF("/main/feature/carousel.swf", "Carousel", "585", "248", "8","expressinstall.swf");
</script>
</head>
<body>
<div id="Wrapper">
  <?php require_once(dirname(__FILE__)."/../skeleton/layout/top.php") ?>
  <div id="Container">
    <div id="MainContent">
    </div>
    <div id="BaseContent">
		<div class="MainContentDiv">
		 <?php require_once("feature/feature.php") ?>
		 <?php require_once("playlist.php") ?>
		 <div class="Divider"></div>
	  	 <?php include(dirname(__FILE__)."/../includes/ads/txtimg_468x60.php") ?>
		</div>
		<div class="RightContentDiv">
			 <?php require_once(dirname(__FILE__)."/../main/news.php") ?>
			<p>&nbsp;</p>
			<?php include(dirname(__FILE__)."/../main/ads/rightcontent.php") ?>
		</div>
		<div class="Spacer"></div>
    </div>
  </div>
  <?php require_once(dirname(__FILE__)."/../skeleton/layout/footer.php") ?>
  <div class="Spacer" /></div>
</div>
</body>
</html>