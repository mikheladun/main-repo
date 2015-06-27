<?php

class Controller
{

 function __construct()
 {
 }

 function loadview($request)
 {
   // Buffering on
   ob_start();

   try
   {
     $page = $request["page"];
     $pageid = $page->id;
     $context = $request['context'];
     $content = $page->uri;

     if(function_exists("virtual"))
     {
        virtual("$page->template.html");
     }
     else
     {
        require_once($context->www . "$page->template.php");
     }
   }
   catch(Exception $e)
   {
       ob_end_clean();
       throw $e;
   }
   // Fetch the output and close the buffer
   $output = ob_get_clean();

   echo $output;
 }
}
?>