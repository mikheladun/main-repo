<?php
$filePath = dirname(__FILE__);
require_once("$filePath/Framework.Class.Datasource.php");
require_once("$filePath/Framework.Class.ServiceRegistry.php");
require_once("$filePath/Framework.Class.Session.php");
require_once("$filePath/Framework.Class.Validation.php");
require_once("$filePath/Framework.Class.StringManipulator.php");
require_once("$filePath/Framework.Utils.php");

class ApplicationContext
{
 var $Configuration;
 var $Datasource;
 var $ServiceRegistry;
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
	$xml->Parse(dirname(__FILE__)."/../Config/app-config.xml");

	$this->InitConfig();
	$this->Configuration['/Configuration'] = $xml->GetNodeByPath("APP");
	$this->Datasource = new Datasource($xml);
	$this->ServiceRegistry = new ServiceRegistry($xml);
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
 function FormatString($String, $Object, $Format, $FormatPurpose) {
	$sReturn = $this->StringManipulator->Parse($String, $Object, $Format, $FormatPurpose);
	// Now pass the string through global formatters
    $sReturn = $this->StringManipulator->GlobalParse($sReturn, $Object, $FormatPurpose);
	return str_replace('?','\%s',$sReturn);
 }
 function InitConfig()
 {
 	$this->Configuration = array();
	$this->Configuration["SERVICE.NAME.TEST"] = "TestCase";
	$this->Configuration["SERVICE.NAME.MEDIA"] = "Media";
	$this->Configuration["SERVICE.NAME.GALLERY"] = "Gallery";
	$this->Configuration["SERVICE.NAME.MKTPLC"] = "Marketplace";
	$this->Configuration["SERVICE.NAME.VIDEO"] = "Video";
	$this->Configuration["SERVICE.NAME.USER"] = "User";
 	$this->Configuration["PAGING_OFFSET"] = 10;
 	$this->Configuration["PAGING_DISPLAY_MAX"] = 10;
 	$this->Configuration["PAGING_DISPLAY"] = 10;
 }
}

class XmlParser{

   var $XmlObj = null;
   var $Output = array();
 
   function XmlParser(){
    
       $this->XmlObj = xml_parser_create();
       xml_set_object($this->XmlObj,$this);
       xml_set_character_data_handler($this->XmlObj, 'DataHandler'); 
       xml_set_element_handler($this->XmlObj, "StartHandler", "EndHandler");
 
   }
 
   function Parse($path){
    
       if (!($fp = fopen($path, "r"))) {
           die("Cannot open XML data file: $path");
           return false;
       }
    
       while ($data = fread($fp, 4096)) {
           if (!xml_parse($this->XmlObj, $data, feof($fp))) {
               die(sprintf("XML error: %s at line %d",
               xml_error_string(xml_get_error_code($this->XmlObj)),
               xml_get_current_line_number($this->XmlObj)));
               xml_parser_free($this->XmlObj);
           }
       }
    
       return true;
   }

   function StartHandler($parser, $name, $attribs){
       $_content = array('name' => $name);
       if(!empty($attribs))
         $_content['attrs'] = $attribs;
       array_push($this->Output, $_content);
   }

   function DataHandler($parser, $data){
       if(!empty($data)) {
           $_output_idx = count($this->Output) - 1;
           $this->Output[$_output_idx]['content'] = $data;
       }
   }

   function EndHandler($parser, $name){
       if(count($this->Output) > 1) {
           $_data = array_pop($this->Output);
           $_output_idx = count($this->Output) - 1;
           $this->Output[$_output_idx]['child'][] = $_data;
       }     
   }

	function GetNodeByPath($path,$tree = false) {
	 if ($tree) {
	  $tree_to_search = $tree;
	 }
	 else {
	  $tree_to_search = $this->Output;
	 }
	
	 if ($path == "") {
	  return null; 
	 }
	
	 $arrPath = explode('/',$path);
	
	 foreach($tree_to_search as $key => $val) {
	  if (gettype($val) == "array") {
	   $nodename = $val['name'];
	
	   if ($nodename == $arrPath[0]) { 
	 
	   if (count($arrPath) == 1)  { 
		 return $val;
	   }
	
	   array_shift($arrPath);
	
	   $new_path = implode($arrPath,"/");
	
	   return $this->GetNodeByPath($new_path,$val['child']);
	   }
	  }
	 }
	}
}

$AppContext = new ApplicationContext();

?>