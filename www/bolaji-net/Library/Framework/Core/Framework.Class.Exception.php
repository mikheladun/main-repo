<?php
class Exception
{
 var $message;
 var $exception;
 function Exception()
 {
  $this->_constructor();
 }
 function _constructor()
 {
 }
 function getMessage()
 {
  return $this->message;
 }
 function setMessage($message)
 {
  $this->message = $message;
 }
}
?>