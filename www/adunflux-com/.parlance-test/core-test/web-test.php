<?php

	class ParlanceWebTest extends PHPUnit_Framework_TestCase
	{
		public function testConfig()
		{
			print_r(PARLANCE_WEB_CONFIG_FILE);
		}
		public function testHost()
		{
			print_r(PARLANCE_HOST);
		}
		public function testInstance()
		{
			$web = ParlanceWeb::instance();
		}
		public function testGetRoutes()
		{
			$routes = ParlanceWeb::instance()->getRoutes();
			print_r($routes);
		}
		public function testGetContext()
		{
			$context = ParlanceWeb::instance()->getContext();
			print_r($context);
		}
		public function testService()
		{
			$request = array();
			$request['route'] = 'home';
			ParlanceWeb::instance()->service($request);
		}
	}
?>