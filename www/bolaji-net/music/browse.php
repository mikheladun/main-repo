<?php require_once("includes/session.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once("skeleton/layout/title.php") ?>
<?php require_once("skeleton/layout/meta.php") ?>
<?php require_once("skeleton/layout/script.php") ?>
<?php require_once("skeleton/layout/style.php") ?>
</head>
<body>
<div id="Wrapper">
  <?php require_once("skeleton/layout/top.php") ?>
  <div id="Container">
    <div id="MainContent">
      <?php require_once("skeleton/layout/nav.php") ?>
      <div class="MainContentDiv">
        <?php require_once("subheader.php") ?>
      </div>
    </div>
    <div id="BaseContent">
      <div class="MainContentDiv">
        <?php include("browselinks.php") ?>
        <?php require_once("browsemusic.php") ?>
        <div class="AdContentDiv"><a class="Dflt" href="http://click.linksynergy.com/fs-bin/stat?id=l2XL*U3Ihf0&offerid=129987.10000013&type=4&subid=0" target="_parent"><img border=0 alt="I Use - Girl 468x60" src="http://marketing.beatport.com/banners/linkshare/ads/iuse_girl_bannerad_468x60.gif "></a><img border=0 width=1 height=1 alt=banner src="http://ad.linksynergy.com/fs-bin/show?id=l2XL*U3Ihf0&bids=129987.10000013&type=4&subid=0"></div>
        <?php include(dirname(__FILE__)."/../includes/ads/txtimg_468x60.php"); ?>
      </div>
      <div class="RightContentDiv">
        <?php include(dirname(__FILE__)."/../includes/ads/txtimg_250x250.php"); ?>
      </div>
    </div>
  </div>
  <?php require_once("skeleton/layout/footer.php") ?>
  <div class="Spacer" />
</div>
</body>
</html>
