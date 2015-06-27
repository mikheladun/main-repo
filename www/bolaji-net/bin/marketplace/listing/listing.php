<?php
    $Step = isset($_REQUEST['step']) && !empty($_REQUEST['step']) ? $_REQUEST['step'] : 1;
	$Submit = isset($_REQUEST['submit']) && !empty($_REQUEST['submit']) ? strtolower($_REQUEST['submit']) : '';

	if($Submit == 'cancel')
	{
		$AppContext->Session->MarketplaceListing = NULL;
		$AppContext->Session->Remove("MarketplaceListing");
		require_once(dirname(__FILE__)."/../category.php");
	}
	else
	{
		require_once(dirname(__FILE__)."/../../Library/Framework/Core/Framework.Utils.php");

		switch($Step)
		{
			case '1' :  
						$Params = new stdClass();
                                                $Params->Step = $Step;
						if($Submit == "next")
						{
							require_once(dirname(__FILE__).'/../../Library/fileupload/Upload.class.php');
							require_once(dirname(__FILE__).'/../../Library/fileupload/MimeTypes.class.php');

							// start new upload object
							$m = new AP_File_MimeTypes();
							$types = $m->getTypes('image');
							unset($m);

							$ul = new AP_File_Upload($types);

							// loop through uploaded files and save each one
							for($i=0; $i < count($_FILES['uploadfile']['name']); $i++)
							{
								$file = array();
								$file['error'] = $_FILES['uploadfile']['error'][$i];
								$file['name'] = $_FILES['uploadfile']['name'][$i];
								$file['tmp_name'] = $_FILES['uploadfile']['tmp_name'][$i];
								$file['type'] = $_FILES['uploadfile']['type'][$i];

								if(!empty($file['name']) && $ul->validate($file) == false)
								{
									// you'll want to handle error in some way more elegant than dying
									$AppContext->AddErrorMessage('Pictures','<br/>'.$ul->get_error());
								}
							}

							$Params->Name = $_REQUEST['name'];
							$Params->Email = $_REQUEST['email'];
							$Params->VerificationKey = $_REQUEST['verification'];
							$Params->AcceptTerms = $_REQUEST['terms'];
							$Params->Title = $_REQUEST['title'];
							$Params->Category = $_REQUEST['category'];
							$Params->Tags = $_REQUEST['tags'];
							$Params->Description = $_REQUEST['description'];

							if(empty($AppContext->ErrorMessage))
							{
								//$AppContext->Session->Captcha = $_SESSION['captcha_string'];

								$Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.MKTPLC"]);
								$Response = $Service->Execute($AppContext, "ValidateMarketplaceListing", $Params);
								if($Response->Success)
								{
									$Params->Images = array();
									//TODO: handle image resize better, include not sufficient resize images
									// set destination folder
									$destination = dirname(__FILE__).'/../../Assets/marketplace/listing/upload/';
									$szRand = md5(mktime() . rand(0, 25));

									require_once(dirname(__FILE__)."/upload.php");

									$AppContext->Session->MarketplaceListing = $Params;
									$AppContext->Session->SetAttribute("MarketplaceListing", $AppContext->Session->MarketplaceListing);

									$MarketplaceInfo = $Params;
									$Step = 2;
								}
							}
						}

						break;

			case '2' :  
						$Params = $AppContext->Session->GetAttribute("MarketplaceListing");
						if(isset($Params) && $Params != NULL)
						{
							$Params->Step = $Step;
							if($Submit == "save")
							{
								$Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.USER"]);
								list($Params->Firstname, $Params->Lastname) = explode(" ",$Params->Name);
								$Response = $Service->Execute($AppContext, "SaveIfNotExistsUserInfo", $Params);
								if($Response->Success)
								{
									$ObjectID = !isset($Response->Object[0]) ? $Response->Object : $Response->Object[0];
									$Params->Ownerid = $ObjectID->ID;
								}
								$Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.MKTPLC"]);
								$Response = $Service->Execute($AppContext, "SaveMarketplaceItem", $Params);
								if($Response->Success)
								{
									$ObjectID = !isset($Response->Object[0]) ? $Response->Object : $Response->Object[0];
									$Params->Itemid = $ObjectID->ID;

									$Destination = dirname(__FILE__).'/../../Assets/marketplace/listing/'.$Params->Itemid;
									mkdir($Destination);

									$Counter = 1;
									//print_r($Params->Images);
									foreach($Params->Images as $Images)
									{
										$File = substr($Images,strpos($Images,'|') + 1,strlen($Images));
										rename($File, $Destination."/".$Params->Itemid."_00$Counter.jpg");
										$Params->Url = $Params->Itemid."/".$Params->Itemid."_00$Counter.jpg";
										$Response = $Service->Execute($AppContext, "SaveMarketplaceImage", $Params);
										//TODO: handle error when saving images
										$Counter++;
									}

									$AppContext->Message['MktplcForm_Msg'] = "Your listing has been posted.";
									$AppContext->Session->Remove("MarketplaceListing");
									$AppContext->Session->MarketplaceListing = NULL;
									//TODO: send email
									$Step = 3;
								}
							}
							elseif($Submit == "edit")
							{
								$Params = $AppContext->Session->GetAttribute("MarketplaceListing");
								$Step = 1;
							}
						}
						else
						{
							$Step = 1;
						}

						break;

			default : $Step = '1';
		}

		$AppContext->Session->Captcha = NULL;
		$AppContext->Session->Remove('captcha-string');

		require_once("step$Step.php");
	}
?>
