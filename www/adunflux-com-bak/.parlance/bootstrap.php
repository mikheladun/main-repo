<?php

	require_once 'core/parser.php';
	require_once 'core/context.php';
	require_once 'core/web.php';
	require_once 'core/router.php';
	require_once 'core/page.php';

	define(PARLANCE_CONFIG_FILE, dirname(__FILE__) . '/parlance.xml');
	define(PARLANCE_WEB_CONFIG_FILE, dirname(__FILE__) . '/../www-data/web.xml');
	define(PARLANCE_HOST, 'adunflux-com');

	function println($string) {
		printf($string . "\r\n");
	}

?>