<?php

	class ParlanceContextTest extends PHPUnit_Framework_TestCase
	{
		public function testInstance()
		{
			$context = ParlanceContext::instance();

			print_r($context);
		}
	}
?>