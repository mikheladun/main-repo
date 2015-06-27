<?php
	//move below to .htaccess file
	require_once $_SERVER["DOCUMENT_ROOT"] . "/.parlance/bootstrap.php";
	define(PARLANCE_WEB_CONFIG_FILE, dirname(__FILE__) . '/../web.xml');
	define(PARLANCE_HOST, 'zeropaynoplay-com'); //retrieve value from request params
	//move above to .htaccess file

	ParlanceWeb::instance()->service($_REQUEST);
?>