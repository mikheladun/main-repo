<?php

class Datasource
{

 var $Configuration;
 var $Resource;

 function _constructor($xml)
 {
 	//USE $AppContext->Datasource->Connect("Local");
	$this->Configuration = array();
	$this->Resource = array();
	$datasources = $xml->GetNodeByPath("APP/DATASOURCES");
	//print_r($datasources);
	foreach($datasources['child'] as $datasource)
	{
		$this->Configuration[ucfirst(($datasource['attrs']['NAME']))] = $datasource['attrs'];
	}
 }
 function Datasource($xml)
 {
 	$this->_constructor($xml);
 }
 function Connect($name)
 {
 	//xpath xml data for dsConfig info
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
 function Disconnect($name)
 {
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