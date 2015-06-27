<?php

class ServiceRegistry
{
 var $Registry;
 var $Service;

 function _constructor($xml)
 {
 	//USE $AppContext->ServiceRegistry->Lookup("ServiceName");
	$this->Registry = array();
	$services = $xml->GetNodeByPath("APP/SERVICES");
	//print_r($services);
	foreach($services['child'] as $service)
	{
		//print_r($service);
		//print($service['attrs']['NAME']);
		$this->Registry[($service['attrs']['ID'])] = $service;
		foreach($service['child'] as $svc)
		{
			//print_r($svc['attrs']);
		}
	}
 }
 function ServiceRegistry($xml)
 {
 	$this->_constructor($xml);
 }
 function &Lookup($name)
 {
 	if($this->Registry[$name])
	{
		$ServiceClass = "Service.Class.$name";
		//echo $ServiceClass;
		//echo dirname(__FILE__)  . "/../classes/";
		if(file_exists("parlance/classes/$ServiceClass.php"))
		{
			require_once("parlance/class/$ServiceClass.php");
			$this->Service = new $name;
		}
		else
		{
			require_once("parlance/core/Framework.Core.BaseService.php");
			$this->Service = new BaseService;
		}
		//$myInstance = new $myClass;
		call_user_func(array(&$this->Service, "Init"), $this->Registry[$name]);
		//print_r($this->Registry[$name]['child']);

		return $this->Service;
	}
	else
	{
		echo("<font color=\"red\">Service [$name] not registered</font>");
	}
 }
}

?>