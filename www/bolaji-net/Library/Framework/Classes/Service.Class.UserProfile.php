<?php
require_once(dirname(__FILE__)."/../Core/Framework.Utils.php");
require_once(dirname(__FILE__)."/../Core/Framework.Class.BaseService.php");
require_once(dirname(__FILE__)."/../Core/Framework.Class.Query.php");
require_once(dirname(__FILE__)."/../Classes/Object.Class.User.php");

class UserProfile extends BaseService
{
 var $Validators;

 function UserProfile()
 {
  $this->_constructor();
 }
 function &Authenticate(&$AppContext, &$Params)
 {
	$Connection = $AppContext->Datasource->Connect("Local");
	$Query = new Query("SELECT LUM_USER.NAME FROM LUM_USER WHERE LUM_USER.NAME = ? AND LUM_USER.PASSWORD = MD5(?)", &$Connection);
	$Query->Param($Query->STRING, 1, $Params->Username);
	$Query->Param($Query->STRING, 2, $Params->Password);
	$Result = $Query->Execute();
	if($Result->Success && $Result->CountRows > 0)
	{
		$this->Response->Success = true;
		if(isset($Result->Object))
		{
			$this->Response->Object = $Result->Object['NAME'];
		}
		else
		{
			//TODO: MORE THAN ONE PERSON WAS FOUND. THIS USER IS NOT VALID!!!
			$User = $Query->LoopResult();
			$this->Response->Object = $User['NAME'];
		}
	}

	$AppContext->Datasource->Disconnect("Local");
  	return $this->Response;
 }
 function &UserDetails(&$AppContext, &$Params)
 {
	$Connection = $AppContext->Datasource->Connect("Local");
	$Query = new Query("SELECT LUM_USER.NAME, LUM_USER.FIRSTNAME, LUM_USER.LASTNAME, LUM_USER.EMAIL, LUM_USER.DATEFIRSTVISIT, LUM_USER.DATELASTACTIVE, LUM_USER.LOCATION, LUM_USER.BIRTHDAY, LUM_USER.ABOUTME, LUM_USER.INSTANTMESSENGERCLIENT, LUM_USER.INSTANTMESSENGERSCREENNAME, LUM_USER.WEBSITE, LUM_USER.SHOWNAME FROM LUM_USER WHERE LUM_USER.NAME = ?", &$Connection);
	$Query->Param($Query->STRING, 1, $Params->Name);
	$Result = $Query->Execute();
	if($Result->Success)
	{
		$this->Response->Success = true;
		$User = new User();
		if(isset($Result->Object))
		{
			$User->GetPropertiesFromDataSet($Result->Object);
		}
		else
		{
			//TODO: MORE THAN ONE PERSON WAS FOUND. THIS USER IS NOT VALID!!!
			$User->GetPropertiesFromDataSet($Query->LoopResult());
		}
		$this->Response->Object = $User;
	}

	$AppContext->Datasource->Disconnect("Local");
  	return $this->Response;
 }
 function &UpdateProfile(&$AppContext, &$Params)
 {
 	$name = split(' ',$Params->FullName,2);
	$Params->Firstname = count($name) > 0 ? $name[0] : '';
	$Params->Lastname = count($name) > 0 ? $name[1] : '';
	$Params->BirthDate = FormatDate("Y-m-d", strtotime("$Params->BirthYear-$Params->BirthMonth-$Params->BirthDay"));
	$Connection = $AppContext->Datasource->Connect("Local");
	$Query = new Query("UPDATE LUM_USER SET FIRSTNAME = ?, LASTNAME = ?, EMAIL = ?, LOCATION = ?, BIRTHDAY = ?, INSTANTMESSENGERCLIENT = ?, INSTANTMESSENGERSCREENNAME = ?, WEBSITE = ?, ABOUTME = ?, DATELASTACTIVE = ?, SHOWNAME = ? WHERE NAME = ?", &$Connection);
	$Query->Param($Query->STRING, 1, $Params->Firstname);
	$Query->Param($Query->STRING, 2, $Params->Lastname);
	$Query->Param($Query->STRING, 3, $Params->Email);
	$Query->Param($Query->STRING, 4, $Params->Location);
	$Query->Param($Query->STRING, 5, $Params->BirthDate);
	$Query->Param($Query->STRING, 6, $Params->InstantMessengerClient);
	$Query->Param($Query->STRING, 7, $Params->InstantMessengerScreenName);
	$Query->Param($Query->STRING, 8, $Params->Website);
	$Query->Param($Query->STRING, 9, $Params->AboutMe);
	$Query->Param($Query->MYSQL, 10, 'NOW()');
	$Query->Param($Query->NUMBER, 11, $Params->ShowName ? 1 : 0);
	$Query->Param($Query->STRING, 12, $Params->Name);
	$Result = $Query->Execute();
	$this->Response->Success = $Result->Success;

	$AppContext->Datasource->Disconnect("Local");
  	return $this->Response;
 }
 function &ChangePassword(&$AppContext, &$Params)
 {
	$Connection = $AppContext->Datasource->Connect("Local");
	$Query = new Query("UPDATE LUM_USER SET LUM_USER.PASSWORD = MD5(?) WHERE LUM_USER.NAME = ?", &$Connection);
	$Query->Param($Query->STRING, 1, $Params->Password);
	$Query->Param($Query->STRING, 2, $Params->Name);
	$Result = $Query->Execute();
	$this->Response->Success = $Result->Success;

	$AppContext->Datasource->Disconnect("Local");
  	return $this->Response;
 }
 function &RegisterUser(&$AppContext, &$Params)
 {
 	$name = split(' ',$Params->RealName,2);
	$Params->Firstname = count($name) > 0 ? $name[0] : '';
	$Params->Lastname = count($name) > 1 ? $name[1] : '';
	$Connection = $AppContext->Datasource->Connect("Local");
	$Params->VerificationKey = DefineVerificationKey();
	$Query = new Query("INSERT INTO LUM_USER (ROLEID, STYLEID, FIRSTNAME, LASTNAME, NAME, PASSWORD, VERIFICATIONKEY, EMAIL, UTILIZEEMAIL, SHOWNAME, COUNTVISIT, COUNTDISCUSSIONS, COUNTCOMMENTS, DATEFIRSTVISIT, DATELASTACTIVE, REMOTEIP, DISCUSSIONSPAMCHECK, USERBLOCKSCATEGORIES, SENDNEWAPPLICANTNOTIFICATIONS) VALUES (?,?,?,?,?,MD5(?),?,?,?,?,?,?,?,?,?,?,?,?,?)", &$Connection);
	$Query->Param($Query->NUMBER, 1, 1);
	$Query->Param($Query->NUMBER, 2, 1);
	$Query->Param($Query->STRING, 3, $Params->Firstname);
	$Query->Param($Query->STRING, 4, $Params->Lastname);
	$Query->Param($Query->STRING, 5, $Params->Name);
	$Query->Param($Query->STRING, 6, $Params->Password);
	$Query->Param($Query->STRING, 7, $Params->VerificationKey);
	$Query->Param($Query->STRING, 8, $Params->EmailAddress);
	$Query->Param($Query->NUMBER, 9, 1);
	$Query->Param($Query->NUMBER, 10, $Params->ShowRealName);
	$Query->Param($Query->NUMBER, 11, 0);
	$Query->Param($Query->NUMBER, 12, 0);
	$Query->Param($Query->NUMBER, 13, 0);
	$Query->Param($Query->MYSQL, 14, 'NOW()');
	$Query->Param($Query->MYSQL, 15, 'NOW()');
	$Query->Param($Query->STRING, 16, GetRemoteIp(true));
	$Query->Param($Query->NUMBER, 17, 1);
	$Query->Param($Query->NUMBER, 18, 0);
	$Query->Param($Query->NUMBER, 19, 0);
	$Result = $Query->Execute();
	if($Result->Success)
	{
		$this->Response->Success = true;
		$this->Response->Object = $Params->Name;
	}

	$AppContext->Datasource->Disconnect("Local");
	return $this->Response;
 }
 function &UserID(&$AppContext, &$Params)
 {
	$Connection = $AppContext->Datasource->Connect("Local");
	$Query = new Query("SELECT LUM_USER.USERID FROM LUM_USER WHERE LUM_USER.NAME = ?", &$Connection);
	$Query->Param($Query->STRING, 1, $Params->Name);
	$Result = $Query->Execute();
	if($Result->Success && $Result->CountRows > 0)
	{
		$this->Response->Success = true;
		if(isset($Result->Object))
		{
			$this->Response->Object = $Result->Object['USERID'];
		}
		else
		{
			//TODO: MORE THAN ONE PERSON WAS FOUND. THIS USER IS NOT VALID!!!
			$User = $Query->LoopResult();
			$this->Response->Object = $User['USERID'];
		}
	}

	$AppContext->Datasource->Disconnect("Local");
  	return $this->Response;
 }
}
?>