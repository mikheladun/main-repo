<?php require_once(dirname(__FILE__)."/../includes/session.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/title.php") ?>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/meta.php") ?>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/script.php") ?>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/style.php") ?>
</head>
<body>
<div id="Wrapper">
  <?php require_once(dirname(__FILE__)."/../skeleton/layout/top.php") ?>
  <div id="Container">
    <div id="MainContent">
      <div class="MainContentDiv">
		 <?php require_once("subheader.php") ?>
		 <?php require_once("playlist.php") ?>
	  </div>
    </div>
    <div id="Content">
      <div class="RightContentDiv">
	  	<?php require("ads/rightcontent.php") ?>
		<div class="ContentDiv" style="border:1px solid #fff;width:250px;overflow:hidden;"><img src="http://www.bolaji.net/images/flag_coat_of_arms_2.jpg" alt="" /></div>
	 </div>
    </div>
    <div id="BaseContent">
		<div class="FloatLeft" style="width:66%;">
		 <?php require_once("ads/topbanner.php") ?>
		 <?php require_once(dirname(__FILE__)."/../main/news.php") ?>
	  	 <?php include(dirname(__FILE__)."/../includes/ads/txtimg_468x60.php") ?>
		 <?php require_once(dirname(__FILE__)."/../main/marketplace.php") ?>
		</div>
		<div class="FloatLeft" style="width:34%;">
			<div>
				<?php require_once(dirname(__FILE__)."/../includes/feedback.php") ?>
			</div>
		</div>
		<div class="Spacer"></div>
    </div>
  </div>
  <?php require_once(dirname(__FILE__)."/../skeleton/layout/footer.php") ?>
  <div class="Spacer" /></div>
</div>
</body>
</html>