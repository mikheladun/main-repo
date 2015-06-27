<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/title.php") ?>
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/meta.php") ?>
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/script.php") ?>
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/style.php") ?>
<link rel="stylesheet" type="text/css" media="screen" href="/style/Stickman.MultiUpload.css" />
<script src="/script/Stickman.MultiUpload.js"></script>
<script type="text/javascript">
	window.addEvent('domready', function(){
		if($('VideoUploadForm'))
		{
			// Use defaults: no limit, use default element name suffix, don't remove path from file name
			//new MultiUpload( $( 'MktplcForm' ).defaults );
			// Max 3 files, use '[{id}]' as element name suffix, remove path from file name, remove extra elemen
			new MultiUpload( $( 'VideoUploadForm' ).uploadfile, 1, '[{id}]', false, true );
		}
	});
</script>
</head>
<body>
<div id="Wrapper">
  <?php require_once(dirname(__FILE__)."/../../skeleton/layout/top.php") ?>
  <div id="Container">
    <div id="MainContent">
      <div class="MainContentDiv">
		 <?php require_once(dirname(__FILE__)."/../../video/subheader.php") ?>
	  </div>
    </div>
    <div id="Content">
      <div class="RightContentDiv">
	 </div>
      </div>
	  <div id="BaseContent">
	  	<div class="MainContentDiv">
		<?php require("upload.php"); ?>
	     <?php include(dirname(__FILE__)."/../../includes/ads/txtimg_468x60.php") ?>
		</div>
		<div class="RightContentDiv">
			<?php include(dirname(__FILE__)."/../../includes/ads/txtimg_250x250.php") ?>
			<?php include(dirname(__FILE__)."/../../includes/ads/txt_250x250.php") ?>
		</div>
		<div class="Spacer"></div>
	  </div>
    </div>
	<?php require_once(dirname(__FILE__)."/../../skeleton/layout/footer.php") ?>
  <div class="Spacer" />
</div>
</body>
</html>