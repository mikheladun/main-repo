<?php

class Datasource
{

 private $Configuration;
 private $Resource;

 function __construct()
 {
 	//USE $AppContext->Datasource->Connect("Local");
	$this->Configuration = array();
	$this->Resource = array();
	//$datasources = $xml->GetNodeByPath("APP/DATASOURCES");

	//load definitions from external datasources file, if necessary
	$xml = new XmlParser;
	$xml->Parse(PARLANCE_PATH . "/config/app-datasources.xml");
    $datasources = $xml->GetNodeByPath("APP/DATASOURCES");

	if(isset($datasources['child']))
	{
	  foreach($datasources['child'] as $datasource)
	  {
	  	$datasourceid = $datasource['attrs']['ID'];
	  	$datasourceid = strtolower($datasourceid);
		$this->Configuration[$datasourceid] = $datasource['attrs'];
	  }
	}
 }
 function connect($name)
 {
 	//xpath xml data for dsConfig info
 	$name = strtolower($name);

	if($this->Configuration[$name])
	{
		$Connection = mysql_pconnect($this->Configuration[$name]['HOST'], $this->Configuration[$name]['USERNAME'], $this->Configuration[$name]['PASSWORD']);

		if($Connection)
		{
			$Link = mysql_select_db($this->Configuration[$name]['SCHEMA'], $Connection) or mysql_error($Connection);
			if(!$Link)
			{
				mysql_error(); //Access denied for user
				mysql_close($Connection);
				$this->Resource[$name] = NULL;
			}
			else
			{
				$this->Resource[$name] = $Connection;
			}
		}
		else
		{
			mysql_error(); //Unknown database server host
		}
	}
	else
	{
		echo ("Datasource [$name] not valid");
	}

  	return $Connection;
 }
 function disconnect($name)
 {
 	$name = strtolower($name);

 	if($this->Resource[$name])
	{
		
		mysql_close($this->Resource[$name]);
	}
	else
	{
		echo ("Datasource [$name] not valid");
	}
 }
}
?>