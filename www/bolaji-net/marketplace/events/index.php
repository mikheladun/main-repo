<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/title.php") ?>
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/meta.php") ?>
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/script.php") ?>
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/style.php") ?>
</head>
<body>
<div id="Wrapper">
  <?php require(dirname(__FILE__)."/../../skeleton/layout/top.php") ?>
  <div id="Container">
    <div id="MainContent">
      <div class="MainContentDiv">
	  	<?php require_once(dirname(__FILE__)."/../subheader.php") ?>
	  </div>
    </div>
    <div id="Content">
      <div class="RightContentDiv">
	 </div>
    </div>
    <div id="BaseContent">
		<div class="MainContentDiv">
			<div class="Divider"></div>
			 <?php require(dirname(__FILE__)."/events.php") ?>
			<div class="BaseContentDiv">
			 <?php require(dirname(__FILE__)."/../ads.php") ?>
			 </div>
		</div>
		<div class="RightContentDiv">
		</div>
		<div class="Spacer"></div>
    </div>
  </div>
  <?php require_once(dirname(__FILE__)."/../../skeleton/layout/footer.php") ?>
  <div class="Spacer" />
</div>
</body>
</html>