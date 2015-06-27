<?php
require_once("file:///E|/Projects/BolajiDotNet/www/framework/framework/BaseAction.inc");
require_once("file:///E|/Projects/BolajiDotNet/www/framework/framework/ResponseObject.inc");
require_once("file:///E|/Projects/BolajiDotNet/www/framework/framework/RequestObject.inc");
require_once("file:///E|/Projects/BolajiDotNet/www/framework/framework/RequestObject.inc");

class Campaign extends BaseAction
{
 function &execute()
 {
  $req = $this->getRequestObject();
  $from = $req->getRequestValue("from");
  $to = $req->getRequestValue("to");
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
  $headers .= "From: $from <$from>\r\n";
  $headers .= "Reply-To:$to\r\n";
  $subject = "Check out this really really awesome website: Wazobi";
  $message = "<br/>";
  $message .= "Hey, check out this really really awesome website: <a href='http://www.bolaji.net'>www.bolaji.net</a>";
  $message .= "<br/><br/><br/>";
  $message .= "<a href=\"http://www.bolaji.net\" target=\"_blank\"><img src=\"http://www.bolaji.net/images/campaign/banner_580x200.gif\" border=\"0\"></a>";
  $message .= "<br/><br/>";
  $message .= "-----------------------------------------<br/>";
  $message .= "Visit: www.bolaji.net";

  $res = new ResponseObject();
  $success = mail($to,$subject,$message,$headers);

  return $res;
 }
 function &transformRequestParams($REQUEST)
 {
  $requestObject = new RequestObject();
  $requestObject->setRequestValue("from", strip_tags($_REQUEST["f"]));
  $requestObject->setRequestValue("to", strip_tags($_REQUEST["t"]));
  $requestObject->setRequestValue("type",1);
  return $requestObject;
 }
}
?>