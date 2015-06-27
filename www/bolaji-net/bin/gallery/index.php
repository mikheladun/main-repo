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
 var _sid = '<?=$_REQUEST['vid']?>';
 var _aid = '<?=$_REQUEST['aid']?>';
</script>
</head>User-agent: *
Disallow:
<body>
<div id="Wrapper">
  <?php require_once(dirname(__FILE__)."/../skeleton/layout/top.php") ?>
  <div id="Container">
    <div id="MainContent">
      <div class="MainContentDiv">
		 <?php require_once("subheader.php") ?>
	  </div>
	 <div class="Spacer"></div>
    </div>
	  <div id="BaseContent">
	  	<div class="MainContentDiv">
		 <?php require_once(dirname(__FILE__)."/home.php") ?>
			<div class="Divider"></div>
			<p>&nbsp;</p>
	     <?php include(dirname(__FILE__)."/../includes/ads/txtimg_468x60.php") ?>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
		</div>
		<div class="RightContentDiv">
	  		<?php include("ads/topright.php") ?>
		</div>
		<div class="Spacer"></div>
	  </div>
    </div>
	<?php require_once(dirname(__FILE__)."/../skeleton/layout/footer.php") ?>
  <div class="Spacer" />
</div>
</body>
</html>