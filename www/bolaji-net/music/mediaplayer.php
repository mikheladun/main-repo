<div align="center">
<?php
 if(isset($_REQUEST['vid']) && !empty($_REQUEST['vid']))
 {
	require_once(dirname(__FILE__)."/player/video.php");
 }
 elseif(isset($_REQUEST['sid']) && !empty($_REQUEST['sid']))
 {
	require_once(dirname(__FILE__)."/nowplaying.php");
 }
?>
</div>