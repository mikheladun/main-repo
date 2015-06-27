<?php
require_once(dirname(__FILE__)."/../Core/Framework.Class.Query.php");

class BaseService
{
 var $Name;
 var $Response;
 var $Validators;
 var $Providers;
 function _constructor()
 {
 	$this->Providers = array(); 	
 }
 function BaseService()
 {
  	$this->_constructor();
 }
 function Init($Configuration)
 {
 	$this->Name = $Configuration['attrs']['NAME'];
	//echo "<div id=\"ServiceDebug\">";
	//echo "<h2>Service: ", $this->Name, "</h2>";
 	foreach($Configuration['child'] as $Provider)
	{
		//print_r($Provider);
		$this->Providers[$Provider['attrs']['NAME']] = $Provider;
		$Elems = isset($Provider['child']) ? $Provider['child'] : array();
		foreach($Elems as $node)
		{
			//print ucfirst(strtolower($node['name']));
			$this->Providers[$Provider['attrs']['NAME']."/".ucfirst(strtolower($node['name']))] = $node;
		}
	}
	//print_r($this->Providers);
 }
 function &Execute(&$AppContext, $Provider, &$Data)
 {
	//echo "<div id=\"ServiceDebug\">";
 	//echo "<h3>Executing [$Provider]</h3>";
	$this->Response = NULL;
	if($this->Providers[$Provider] == NULL)
	{
		//echo "<h3 style=\"color:red\">[$Provider] not available</h3>";
	}
	else
	{
		$this->Response = new stdClass();
                $this->Response->Success = true;

		if($this->ExecuteValidator($AppContext, $Provider, $Data))
		{
			if($this->ExecutePreconditions($AppContext, $Provider, $Data))
			{
				if($this->ExecuteConditions($AppContext, $Provider, $Data))
				{
					$this->ExecuteQuery($AppContext, $Provider, $Data);
				}
			}
		}
	}

	//echo "</div>";
	//echo "</div>";

	return $this->Response;
 }

 function ExecuteValidator(&$AppContext, $Provider, &$Data)
 {
 	//print_r($this->Providers[$Provider."/Validator"]['attrs']['NAME']);
 	if(isset($this->Providers[$Provider."/Validator"]))
	{
		$Validator = $this->Providers[$Provider."/Validator"]['attrs']['NAME'];
		$AppContext->Validation->Invoke($Validator, $AppContext, $Provider, $Data);
		if(!empty($AppContext->ErrorMessage))
		{
			$this->Response->Success = false;
		}
	}

	return $this->Response->Success;
 }

 function ExecutePreconditions($AppContext, $Provider, $Data)
 {
	if(isset($this->Providers[$Provider."/Preconditions"]))
	{
		//print_r($this->Providers[$Provider."/Preconditions"]);
		foreach($this->Providers[$Provider."/Preconditions"]["child"] as $Precondition)
		{
			$Name = $Precondition["attrs"]['NAME'];
			//echo "<h5>Precondition: $Name</h5>";
			$Service = $AppContext->ServiceRegistry->Lookup($this->Name);
			$Response = $Service->Execute($AppContext, $Name, $Data);
			//echo "<br/>Precondition: Response[", $Response->Object,"]";
			if(!$Response->Success)
			{
				$this->Response->Success = false;
				$AppContext->AddErrorMessage("Precondition_$Name","Precondition $Name not satisfied.");
			}
		}
	}

	return $this->Response->Success;
 }

 function ExecuteConditions($AppContext, $Provider, $Data)
 {
	if(isset($this->Providers[$Provider."/Conditions"]))
	{
		//print_r($this->Providers[$Provider."/Conditions"]);
		$If = $this->Providers[$Provider."/Conditions"]["child"][0]['content'];
		$Iftype = $this->Providers[$Provider."/Conditions"]["child"][0]['name'];
		$Then = $this->Providers[$Provider."/Conditions"]["child"][1]['content'];
		//echo "<h4>Condition: $Iftype $If then $Then</h4>";

		$Service = $AppContext->ServiceRegistry->Lookup($this->Name);
		$Response = $Service->Execute($AppContext, $If, $Data);
		if($Response->Success)
		{
			$Eval = false;
			switch(strtolower($Iftype))
			{
				case "iff" :
					if(!isset($Response->Object) || empty($Response->Object))
					{
						$Eval = true;
					}
					break;
				case "if":
					if(isset($Response->Object) && !empty($Response->Object)) 
					{ 
						$Eval = true; 
					}
					break;
				default:
			}

			if($Eval == true)
			{
				$Service = $AppContext->ServiceRegistry->Lookup($this->Name);
				$Response = $Service->Execute($AppContext, $Then, $Data);

				$this->Response->Success = $Response->Success;
				$this->Response->Object = $Response->Object;
			}
			else
			{
				$this->Response->Success = $Response->Success;
				$this->Response->Object = $Response->Object;
			}
		}
		else
		{
			$this->Response->Success = false;
		}
	}

	return $this->Response->Success;
 }

 function ExecuteQuery($AppContext, $Provider, $Data)
 {
 	if(isset($this->Providers[$Provider."/Query"]))
	{
		//echo "<br/>";print_r($this->Providers);
		//echo "<br/><br/>";print_r($this->Providers[$Provider."/Query"]);
		//echo "<br/><br/> <font color=\"blue\">Query: ".$this->Providers[$Provider."/Query"]['content']."</font>";
		$Sql = $this->Providers[$Provider."/Query"]['content'];
		//echo "<br/><br/>";print_r($this->Providers[$Provider."/Params"]);
		//echo "<br/><br/> <font color=\"blue\">Params: ";print_r($this->Providers[$Provider."/Params"]['child']);echo "</font>";
		$Params =  $this->Providers[$Provider."/Params"]['child'];

		$Connection = $AppContext->Datasource->Connect("Local");
		$Query = new Query($Sql, $Connection);
		if(isset($Params))
		{
			foreach($Params as $Param)
			{
				$attrs = $Param['attrs'];
				//echo "<br/><font color=\"blue\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;=>Param: id[".$attrs['ID']."] type[".$attrs['TYPE']."] name[".$attrs['NAME']."] value[".$attrs['VALUE']."]</font>";
				$Type = strtoupper($attrs['TYPE']);
				$Name = ucfirst($attrs['NAME']);
				$Value = $attrs['VALUE'];
				$Valuetype = $attrs['VALUETYPE'];
				$AllowOverride = strtolower($attrs['ALLOWOVERRIDE']);
				if($Name == "Page" && eregi("select .+ limit \?", $Sql))
				{
					if(!isset($Data->Page) || $Data->Page <= 1)
					{
						$Value = 0;
					}
					else
					{
						$Offset = isset($Data->Offset) ? $Data->Offset : 10;
						$Value = ($Data->Page * $Offset) - $Offset + 1;
					}
				}
				elseif($AllowOverride == "true" || !isset($Value) || empty($Value))
				{
					eval("\$Value = \$Data->$Name;");
				}
				else if(isset($Valuetype) && !empty($Valuetype))
				{
					//$Value = preg_replace(array("/\[/","/\]/"), array("[\"","\"]"), $Value, 1);
					eval("\$Value = \$Valuetype[$Value];");
					//eval("\$Value = \$AppContext->$Value;");
				}
				eval("\$Type = \$Query->$Type;");
				//echo "<br/><font color=\"blue\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;=>Param: type[$Type] value[$Value]</font>";
				$Query->Param($Type, $attrs['ID'] + 1, $Value);
				//echo "<br/></font>";
			}
		}

		//echo "<br/>BuildQuery: ".$Query->BuildQuery()."<br/>";
		$Result = $Query->Execute();
		//echo "Success[".$Result->Success."]";
		if($Result->Success)
		{
			$ReturnObject = $this->Providers[$Provider]['attrs']['RETURNS'];
			//echo "<br/><font color=\"blue\">Return Object: $ReturnObject</font>";
			$ObjectClass = "Object.Class.$ReturnObject";
			require_once(dirname(__FILE__)."/../Classes/$ObjectClass.php");

			$this->Response->CountRows = $Result->CountRows;
			if($Result->CountRows > 1)
			{
					$Items = array();
					while($Object = $Query->LoopResult())
					{
						$ObjectInstance= new $ReturnObject;
						//echo "<br/>Result: $ObjectInstance";
						call_user_func(array($ObjectInstance, "GetPropertiesFromDataSet"), $Object);
						//return call_user_func(array($this, $Provider), $AppContext, $Params);
						$Items[] = $ObjectInstance;
					}
					$this->Response->Object = $Items;
			}
			else if($Result->CountRows == 1)
			{
				if($ReturnObject === "Counter")
				{
					$ObjectInstance= new $ReturnObject;
					//echo "<br/>Result: ". $Result->Object['count'];
					call_user_func(array(&$ObjectInstance, "GetPropertiesFromDataSet"), $Result->Object);
					$this->Response->Object = $ObjectInstance;
				}
				else
				{
					$ObjectInstance= new $ReturnObject;
					//echo "<br/>Result: ". $Result->Object['name'];
					call_user_func(array(&$ObjectInstance, "GetPropertiesFromDataSet"), $Result->Object);
					$this->Response->Object = array($ObjectInstance);
				}
			}
			else if($ReturnObject === "ObjectID")
			{
				$ObjectInstance = new $ReturnObject;
				$Id = $Query->LastInsertID($Connection);
				$Object = array();
				$Object["ID"] = $Id;
				call_user_func(array($ObjectInstance, "GetPropertiesFromDataSet"), $Object);
				$this->Response->Object = $ObjectInstance;
			}
		}
		else
		{
			$this->Response->Success = false;
			//echo "<h5 style=\"color:red\">Failed to execute query</h5>";
		}

		$AppContext->Datasource->Disconnect("Local");
		//return call_user_func(array(&$this, $Provider), &$AppContext, &$Params);
	}

	return $this->Response->Success;
  }
}
?>
