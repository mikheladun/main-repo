<?php

class Router
{
 private $registry;
 public static $instance;
 
 function __construct()
 {
   //load definitions from external services file, if necessary
   $xml = new XmlParser;
   $xml->Parse(PARLANCE_PATH . "/config/app-pages.xml");
   $pages = $xml->GetNodeByPath("APP/PAGES");

   $this->registry = array();
   if(isset($pages) && !empty($pages['child'])) :
      foreach($pages['child'] as $page) :
          $this->registry[($page['attrs']['ID'])] = $page;
      endforeach;
   endif;
 }

 static function instance()
 {
   if(self::$instance === NULL)
     self::$instance = new Router;

   return self::$instance;
 }

 function dispatch($request)
 {
   $route = $this->registry[$request['route']];
   $page = new stdClass();
   $page->id = $route['attrs']['ID'];
   $page->baseurl = "";
   if(isset($route['attrs']['BASEURL']))
     $page->baseurl = $route['attrs']['BASEURL'] . "/";

   $page->uri = $page->baseurl . $route['attrs']['URL'];
   if(eregi("^redesign", $page->id))
    $page->template = "/themes/default/layout/staging";
   else
    $page->template = "/themes/default/layout/template";

   $request["page"] = $page;
   //echo "<pre>"; print_r($request); echo "</pre>";

   require_once("controller.php");
   $controller = new Controller;
   $controller->loadview($request);
 }
}
?>
