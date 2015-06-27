<?php

class Session
{
 var $Configuration;
 var $User;

 function _constructor()
 {
 	//$this->Configuration = $Config;
	$this->User = $this->GetAttribute("User");
 }
 function Session()
 {
 	$this->_constructor();
 }
 function Check()
 {
 	$User = $this->GetAttribute("User");
 	return (isset($_COOKIE["WazobiUser"]) && !empty($_COOKIE["WazobiUser"])) || isset($User) || session_is_registered('User');
 }
 function &SetAttribute($key, &$data)
 {
 	$_SESSION[$key] = $data;
 }
 function &GetAttribute($key)
 {
 	return isset($_SESSION[$key]) ? $_SESSION[$key] : NULL;
 }
 function Remove($key)
 {
 	unset($_SESSION[$key]);
	//session_unregister($key);
        unset($key);
	$_SESSION[$key] = NULL;
 }
 function Destroy()
 {
 	session_destroy();
	setcookie('WazobiUser',' ',time()-3600,'/',false);
	unset($_COOKIE['WazobiUser']);
	session_unset();
	$this->Remove("User");
 }
}

?>
