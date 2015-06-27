<?php
	//default gateway
	require_once("Library/amfphp/amf-core/app/Gateway.php");
    $gateway = new Gateway();
    //Set where the services classes are loaded from, *with trailing slash*
    $gateway->setBaseClassPath("./Library/Framework/Classes/");
    //Loose mode means echo\'ing or whitespace in your file won\'t make AMFPHP choke
    $gateway->setLooseMode(true);    
    //charset handling
    $gateway->setCharsetHandler("utf8_decode", "ISO-8859-1", "ISO-8859-1");   
    //Error types that will be rooted to the NetConnection debugger
    $gateway->setErrorHandling(E_ALL ^ E_NOTICE);

	//This is new to AMFPHP 1.2: 
	//Set custom class mappings (kept in a second config file for convenience)
	include_once("Library/amfphp/advancedsettings.php");

    //Service now
    $gateway->service();
?>