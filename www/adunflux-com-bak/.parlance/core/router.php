<?php

class Router
{
	private $request;

	function __construct(&$request)
	{
		$this->request = $request;
	}

	function dispatch(&$route)
	{
		if(isset($route->data)) :
			require_once $route->data;
			//check http status code before proceeding 
		endif;

		$page = new Page;
		$page->view($route);
	}
}
?>
