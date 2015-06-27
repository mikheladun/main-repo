<?php

class ParlanceWeb
{
	private $routes;
	private $context;
	public static $instance;

	function __construct()
	{
		$this->context = ParlanceContext::instance();
		$host = $this->context->hosts[PARLANCE_HOST];

		$xml = & new XmlParser;
		$xml->Parse(PARLANCE_WEB_CONFIG_FILE);
		$template = $xml->GetNodeByPath("PARLANCE/PARLANCE:WEB/WEB:TEMPLATE")['content'];
		$nodes = $xml->GetNodeByPath("PARLANCE/PARLANCE:WEB/WEB:ROUTES");

		if(isset($nodes) && ! empty($nodes['child'])) :

			$this->routes = array();

			foreach($nodes['child'] as $node) : 
				if($node['name'] == 'WEB:TEMPLATE') : 
					if(empty($node['child'])) :
						 
					endif;
				endif;

				if($node['name'] == 'WEB:ROUTE') : 
					$route = new stdClass;

					foreach($node['child'] as $key=>$value) :  
						if($value['name'] == 'WEB:ROUTE:ID') : 
							$route->id = $value['content'];
						endif;
						if($value['name'] == 'WEB:ROUTE:VIEW') : 
							$route->view = $host->root . 'www/' . $value['content'];
						endif;
						if($value['name'] == 'WEB:ROUTE:DATA') : 
							$route->data = $host->root . 'www-data/' . $value['content'];
						endif;
						if($value['name'] == 'WEB:ROUTE:PROPS') : 
							$props = explode(';',$value['content']);
							foreach($props as $prop) :
								$value = explode(':',$prop);
								$route->props[$value[0]] = $value[1];
							endforeach;
						endif;
					endforeach;

					$route->template = $host->root . 'www/' . $template; 
					$this->routes[$route->id] = $route;
				endif;

			endforeach;
		endif;
	}

	static function instance()
	{
		if(self::$instance === NULL)
			self::$instance = new ParlanceWeb;

		return self::$instance;
	}

	function getRoutes()
	{
		return $this->routes;
	}

	function getContext()
	{
		return $this->context;
	}

	function service(&$request)
	{
		$route = $this->routes[$request['route']];
		$route->context = $this->context;

		$router = new Router($request);
		$router->dispatch($route);
	}
}
?>