<?php

class Mailer 
{
 var $Registry;

 function _constructor($xml) 
 {
	$mailers = $xml->GetNodeByPath("APP/MAILERS");
	if(!empty($mailers)) 
	{
		foreach($mailers['child'] as $mailer)
		{
			//print($validator['attrs']['NAME']);
			$this->Registry[ucfirst($mailer['attrs']['NAME'])] = $mailer['attrs']['CLASS'];
			//print $this->Registry[ucfirst($validator['attrs']['NAME'])];
		}
	}
 }
 function Mailer($xml)
 {
 	$this->_constructor($xml);
 }

 function &Invoke($Mailer, $AppContext, $Provider, $Params)
 {
 	if($this->Registry[$Mailer])
	{
		$Class = $this->Registry[$Mailer];

		if(empty($Class) || !isset($Class))
		{
			$this->Send(&$AppContext, &$Params);
		}
		else
		{
			require_once(dirname(__FILE__)."/../Classes/$Class.php");
			$MailerClass = substr($Class, strrpos($Class,'.') + 1, strlen($Class));
			$Mailer = new $MailerClass;
			$Mailer->Send(&$AppContext, &$Params);
			//call_user_func(array(&$Validator, "Validate$Provider"), &$AppContext, &$Params);
		}
	}
	else
	{
		echo "Mailer [$name] not registered";
		$AppContext->AddErrorMessage('Mailer_Err','Mailer [$name] not registered');
	}
 }

 function &Send(&$AppContext, &$Params)
 {
	  $from = $Params->From;
	  $to = $Params->To;
	  $headers = "MIME-Version: 1.0\r\n";
	  $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	  $headers .= "From: $from <$from>\r\n";
	  $headers .= "Reply-To:$to\r\n";
	  $subject = $Params->Subject;
	  $message .= $Params->Body;

	  $success = mail($to,$subject,$message,$headers);
  
	  if($success != 1) 
	  {
	  	$AppContext->AddErrorMessage('Mailer_Err', 'Unable to deliver message.');
	  }
	  else if($success == 1)
	  {
	  	$AppContext->AddMessage('Mailer_Msg', 'Message delivered.');
	  }
 }

}

?>