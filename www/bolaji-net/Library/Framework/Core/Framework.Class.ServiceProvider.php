<?php

class ServiceP
{
 var $Name;
 var $Providers;
  function _constructor()
  {
 	$this->Providers = array(); 	
  }
  function ServiceConfig()
  {
  	$this->_constructor();
  }
  function SetName($Name)
  {
  	$this->Name = $Name;
  }
  function GetName()
  {
  	return $this->Name();
  }
  function AddProvider()
  {
  	$this->Providers[] = $Provider
  }
  function GetProviders()
  {
  	return $this->Providers;
  }
 }
?>