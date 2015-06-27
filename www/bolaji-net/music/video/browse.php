<?php require_once("includes/session.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once("skeleton/layout/title.php") ?>
<?php require_once("skeleton/layout/meta.php") ?>
<?php require_once("skeleton/layout/script.php") ?>
<?php require_once("skeleton/layout/style.php") ?>
</head>
<style type="text/css">
.Playlist .BtnPlay{position:relative;margin-top:-2.5em;}
.Playlist A>.BtnPlay{margin-top:-1.8em;}
</style>
<body>
<div id="Wrapper">
  <?php require_once("skeleton/layout/top.php") ?>
  <div id="Container">
    <div id="MainContent">
      <?php require_once("skeleton/layout/nav.php") ?>
      <div class="MainContentDiv">
        <?php require_once("music/subheader.php") ?>
		<p>&nbsp;<big><big class="GrnTxt">Browse Music Videos</big></big></p>
      </div>
      <div class="Spacer"></div>
    </div>
    <div id="BaseContent">
	<div class="Divider"></div>
	<?php require_once("music/video/browsevideo.php") ?>
    </div>
  </div>
  <?php require_once("skeleton/layout/footer.php") ?>
</div>
</body>
</html>
