<?php
require_once("database.php");
require_once("registry.php");
require_once("utils.php");
require_once("parser.php");

class ApplicationContext
{
 function __construct()
 {
 }
 static function instance()
 {
    $context = new ApplicationContext;
    $context->www = PARLANCE_PATH . "/../";
    $context->pages = PARLANCE_PATH . "/../pages";

    //TODO: user php5 xmlparser
	$xml = & new XmlParser();
	//$xml->Parse("parlance/config/app-config.xml");
	$xml->Parse(PARLANCE_PATH . "/config/app-config.xml");

	return $context;
 }
}
?>