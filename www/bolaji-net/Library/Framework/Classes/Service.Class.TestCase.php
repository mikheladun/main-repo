<?php
require_once(dirname(__FILE__)."/../Core/Framework.Class.BaseService.php");
require_once(dirname(__FILE__)."/../Core/Framework.Class.Query.php");

class TestCase extends BaseService
{
 function TestCase()
 {
  $this->_constructor();
 }

 function &HelloWorld(&$AppContext, $Params)
 {
	$Connection = $AppContext->Datasource->Connect("Local");
	$Query = new Query("SELECT COUNT(2+2) AS COUNT", $Connection);
	$Result = $Query->Execute();
 	$this->Response->Object = $Result->Object['COUNT'];
	$AppContext->Datasource->Disconnect("Local");

	return $this->Response;
 }

}
?>