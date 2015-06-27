<?php
//$filePath = dirname(__FILE__);
$filePath = 'parlance/core';
require_once("$filePath/Framework.Core.PagesRegistry.php");
require_once("$filePath/Framework.Core.Datasource.php");
require_once("$filePath/Framework.Core.ServiceRegistry.php");
require_once("$filePath/Framework.Core.Session.php");
require_once("$filePath/Framework.Core.Validation.php");
require_once("$filePath/Framework.Core.StringManipulator.php");
require_once("$filePath/Framework.Utils.php");
require_once("$filePath/Framework.Core.Mailer.php");
require_once("$filePath/Framework.Core.XmlParser.php");

class ApplicationContext
{
 var $Configuration;
 var $PagesRegistry;
 var $Datasource;
 var $ServiceRegistry;
  var $Mailer;
 var $ObjectClass;
 var $Session;
 var $Validation;
 var $ErrorMessage;
 var $StringManipulator;

 function _constructor()
 {
 	$this->Init();
 }
 function ApplicationContext()
 {
 	$this->_constructor();
 }
 function Init()
 {
	$xml = & new XmlParser();
	$xml->Parse("parlance/config/app-config.xml");

	$this->InitConfig();
	$this->Configuration['/Configuration'] = $xml->GetNodeByPath("APP");
	$this->PagesRegistry = new PagesRegistry($xml);
	$this->Datasource = new Datasource($xml);
	$this->ServiceRegistry = new ServiceRegistry($xml);
	$this->Mailer = new Mailer($xml);
	$this->Session = new Session();
	$this->Validation = new Validation($xml);
	$this->ErrorMessage = array();
	$this->Message = array();
	// Instantiate the string manipulation object
  	$this->StringManipulator = new StringManipulator($this->Configuration);
	// Add the plain text manipulator
  	$TextFormatter = new TextFormatter();
	$this->StringManipulator->AddManipulator("Text", $TextFormatter);
 }
 function AddErrorMessage($Key, $Message)
 {
 	$this->ErrorMessage[$Key] = $Message;
 }
 function AddMessage($Key, $Message)
 {
 	$this->Message[$Key] = $Message;
 }
 function FormatString($String, $Object, $Format, $FormatPurpose) {
	$sReturn = $this->StringManipulator->Parse($String, $Object, $Format, $FormatPurpose);
	// Now pass the string through global formatters
    $sReturn = $this->StringManipulator->GlobalParse($sReturn, $Object, $FormatPurpose);
	return str_replace('?','\%s',$sReturn);
 }
 function InitConfig()
 {
 	$this->Configuration = array();
	$this->Configuration["SERVICE.NAME.DEFAULT"] = "Services";
	$this->Configuration["INCLUDE_PATH"] = '/Projects/janatec/www/2009website';
 }
}

$AppContext = new ApplicationContext();
?>