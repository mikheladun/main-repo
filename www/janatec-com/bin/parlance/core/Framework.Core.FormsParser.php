<?php
class FormsParser{

   var $XmlObj = null;
   var $Output = array();

   function FormsParser(){

       $this->XmlObj = xml_parser_create();

       xml_set_object($this->XmlObj,$this);
	   xml_parser_set_option($this->XmlObj, XML_OPTION_CASE_FOLDING, 0);
	   xml_parser_set_option($this->XmlObj, XML_OPTION_TARGET_ENCODING, 'ISO-8859-1');
       xml_set_character_data_handler($this->XmlObj, 'DataHandler'); 
       xml_set_element_handler($this->XmlObj, "StartHandler", "EndHandler");
   }
 
   function Parse($path){

       if (!($fp = fopen($path, "r"))) {
           die("Cannot open XML data file: $path");
           return false;
       }

	   $filesize = filesize($path);
	   //$filesize = 4096;
	   //echo "filesize: ", filesize($path);

       while ($data = fread($fp, $filesize)) {
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
?>