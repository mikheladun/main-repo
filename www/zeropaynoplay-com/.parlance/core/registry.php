<?php

class ServiceLocator
{
	private $registry;
	private static $instance;

	function __construct()
	{
		//load definitions from external services file, if necessary
		$xml = new XmlParser;
		$xml->Parse(PARLANCE_PATH . "/config/app-services.xml");
		$services = $xml->GetNodeByPath("APP/SERVICES");

		$this->registry = array();
		if(isset($services) && !empty($services['child'])) :
		foreach($services['child'] as $service) :
		$this->registry[($service['attrs']['ID'])] = $service;
		endforeach;
		endif;
	}
	static function instance()
	{
		if(self::$instance === NULL)
			self::$instance = new ServiceLocator;

		return self::$instance;
	}
	function get($service)
	{
		return $this->Lookup($service);
	}
	function &Lookup($service)
	{
		require_once("services.php");
		$service = new BaseService($this->registry[strtolower($service)]);

		return $service;
	}
}

?>