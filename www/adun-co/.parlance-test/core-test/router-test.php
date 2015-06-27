<?php

	class RouterTest extends PHPUnit_Framework_TestCase
	{
		public function testInstance()
		{
			$context = ParlanceContext::instance();
			Router::instance();
		}
		public function testDispatch()
		{
			$context = ParlanceContext::instance();
			$request = array();
			$request['route'] = 'home';
			Router::instance()->dispatch($request);
		}
	}
?>