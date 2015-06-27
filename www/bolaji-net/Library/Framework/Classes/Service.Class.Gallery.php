<?php
require_once(dirname(__FILE__)."/../Core/Framework.Class.BaseService.php");

class Gallery extends BaseService
{
 function Media()
 {
  $this->_constructor();
 }
 function &HelloWorld(&$AppContext, $Params)
 {
	$Connection = $AppContext->Datasource->Connect("Local");
	$Query = new Query("SELECT COUNT(*) AS COUNT FROM LUM_DISCUSSION", $Connection);
	$Result = $Query->Execute();
 	$this->Response->Object = $Result->Object['COUNT'];
	$AppContext->Datasource->Disconnect("Local");

	return $this->Response;
 }
}
?>