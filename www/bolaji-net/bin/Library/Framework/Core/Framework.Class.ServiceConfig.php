<?php

class ServiceConfig
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
  function AddProvider($Name, &$Provider)
  {
  	$this->Providers[] = &$Provider;
  }
  function GetAllProviders()
  {
  	return $this->Providers;
  }
  function GetProvider($Name)
  {
  	return $this->Providers[$Name];
  }
 }
?>