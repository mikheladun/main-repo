<?php 
 require_once(dirname(__FILE__)."/Library/Framework/Core/Framework.Class.ApplicationContext.php");

 $MusicSection = isset($_REQUEST['cc']) && !empty($_REQUEST['cc']) ? $_REQUEST['cc'] : "main";

 require_once("music/artist/index.php");
?>