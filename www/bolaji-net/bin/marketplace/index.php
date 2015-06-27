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
.Mktplc Ol,.Mktplc Ul{margin:0;padding:0;margin-left:1.5em;}
.Mktplc Dd Li{padding:0;margin:0;background:none;font-size:95%;font-weight:normal;}
</style>
</head>
<body>
<div id="Wrapper">
  <?php require_once(dirname(__FILE__)."/../skeleton/layout/top.php") ?>
  <div id="Container">
	  <div id="BaseContent">
	  	<div class="MainContentDiv">
			<div class="ContentDiv">
<script type="text/javascript"><!--
google_ad_client = "pub-7323832766254981";
/* 468x60, created 3/2/08 */
google_ad_slot = "0644787219";
google_ad_width = 468;
google_ad_height = 60;
google_cpa_choice = ""; // on file
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

		 <?php require(dirname(__FILE__). ( !isset($_REQUEST['cc']) || empty($_REQUEST['cc']) ? "/category.php" : "/browsetop.php" ) ) ?>
			<div class="Divider"></div>
			 <?php require(dirname(__FILE__)."/marketplace.php") ?>
			 </div>
		</div>
		<div class="RightContentDiv">
			<div class="ContentDiv"><p class="PaddedBox3 SmallBold WhtTxt"><strong><img border="0" src="/images/ico_add.gif" align="left" width="14" height="14"/>&nbsp;&nbsp;<a class="WhtTxt" href="/marketplace/listing/">ADD A LISTING</a></strong></p></div>
	  		<?php include("ads/topright.php") ?>
			<?php include(dirname(__FILE__)."/../includes/ads/txt_250x250.php") ?>
		</div>
		<div class="Spacer"></div>
	  </div>
    </div>
	<?php require_once(dirname(__FILE__)."/../skeleton/layout/footer.php") ?>
  <div class="Spacer" />
</div>
</body>
</html>