<?php
    $Step = isset($_REQUEST['step']) && !empty($_REQUEST['step']) ? $_REQUEST['step'] : 1;
	$Submit = isset($_REQUEST['submit']) && !empty($_REQUEST['submit']) ? strtolower($_REQUEST['submit']) : '';

	if($Submit == 'cancel')
	{
		$AppContext->Session->PhotoUpload = NULL;
		$AppContext->Session->Remove("PhotoUpload");
		require_once(dirname(__FILE__)."/../browse.php");
	}
	else
	{
		require_once(dirname(__FILE__)."/../../Library/Framework/Core/Framework.Class.ApplicationContext.php");
		require_once(dirname(__FILE__)."/../../Library/Framework/Core/Framework.Utils.php");

		switch($Step)
		{
			case '1' :  
						$Params->Step = $Step;
						if($Submit == "upload")
						{
							require_once(dirname(__FILE__).'/../../Library/fileupload/Upload.class.php');
							require_once(dirname(__FILE__).'/../../Library/fileupload/MimeTypes.class.php');

							// start new upload object
							$m = new AP_File_MimeTypes();
							$types = $m->getTypes('image');
							unset($m);

							$ul = new AP_File_Upload($types);

							$Params->Photos = $_FILES['uploadfile'];

							// loop through uploaded files and save each one
							for($i=0; $i < count($_FILES['uploadfile']['name']); $i++)
							{
								$file = array();
								$file['error'] = $_FILES['uploadfile']['error'][$i];
								$file['name'] = $_FILES['uploadfile']['name'][$i];
								$file['tmp_name'] = $_FILES['uploadfile']['tmp_name'][$i];
								$file['type'] = $_FILES['uploadfile']['type'][$i];

								if($ul->validate($file) == false)
								{
									// you'll want to handle error in some way more elegant than dying
									$AppContext->AddErrorMessage('Photos','<br/>'.$ul->get_error());
								}
							}

							$Params->Name = $_REQUEST['name'];
							$Params->Email = $_REQUEST['email'];
							$Params->AcceptTerms = $_REQUEST['terms'];

							if(empty($AppContext->ErrorMessage))
							{
								$Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.GALLERY"]);
								$Response = $Service->Execute(&$AppContext, "ValidateGalleryUpload", &$Params);
								if($Response->Success)
								{
									//TODO: handle image resize better, include not sufficient resize images
									// set destination folder
									$URL = "/Assets/photos/upload/";
									$Destination = dirname(__FILE__)."/../..".$URL;

									$Params->Images = $ul->process($_FILES, $Destination, $URL);

									$AppContext->Session->PhotoUpload = $Params;
									$AppContext->Session->SetAttribute("PhotoUpload", $AppContext->Session->PhotoUpload);

									$GalleryInfo = $Params;
									$Step = 2;
								}
							}
						}

						break;

			case '2' :  
						$Params = $AppContext->Session->GetAttribute("PhotoUpload");	

						if(isset($Params) && $Params != NULL)
						{
							$Params->Step = $Step;
							$Params->SetTitle = $_REQUEST['stitle'];
							$Params->SetDescription = $_REQUEST['sdescription'];
							$Params->Title = array();
							$Params->Description = array();

							for($count=1; $count <= count($Params->Images); $count++)
							{
								$Params->Title[$count - 1] = $_REQUEST['title' . $count ];
								$Params->Description[$count  - 1] = $_REQUEST['description' . $count ];
							}

							$Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.GALLERY"]);
							$Response = $Service->Execute(&$AppContext, "ValidateGalleryUpload", &$Params);
							if($Response->Success)
							{
								$Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.USER"]);
								list($Params->Firstname, $Params->Lastname) = explode(" ",$Params->Name);

								$Response = $Service->Execute(&$AppContext, "SaveIfNotExistsUserInfo", $Params);
								if($Response->Success)
								{
									$ObjectID = !isset($Response->Object[0]) ? $Response->Object : $Response->Object[0];
									$Params->Ownerid = $ObjectID->ID;
								}

								$Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.GALLERY"]);
								//save gallery set info
								$Params->Collid = 0;
								if(isset($Params->SetTitle) && !empty($Params->SetTitle))
								{
									//preserve title and description values
									$Title = $Params->Title;
									$Description = $Params->Description;

									$Params->Title = $Params->SetTitle;
									$Params->Description = $Params->SetDescription;
									$Params->Numofphotos = count($Params->Images);
									$Params->Categoryid = 0;
									$Response = $Service->Execute(&$AppContext, "SaveGalleryInfo", &$Params);
									if($Response->Success)
									{
										$ObjectID = !isset($Response->Object[0]) ? $Response->Object : $Response->Object[0];
										$Params->Collid = $ObjectID->ID;
									}

									//reset title and description values
									$Params->Title = $Title;
									$Params->Description = $Description;

									//save each photo info
									$Destination = dirname(__FILE__).'/../../Assets/photos/'.$Params->Collid;
									if(!file_exists($Destination))
									{
										mkdir($Destination);
									}
								}
								else
								{
									$Destination = dirname(__FILE__).'/../../Assets/photos/';
								}

								$Counter = 1;
								$Params->Photonum = 1;
								$ImageTitles = array();
								foreach($Params->Images as $Images)
								{
									//preserve title and description values
									$Title = $Params->Title;
									$Description = $Params->Description;
									$Collid = $Params->Collid;

									$Params->Categoryid = 0;
									$Params->Sourceid = 0;
									$Params->Title = $Title[($Counter - 1)];
									$Params->Description = $Description[($Counter - 1)];

									list($ImageOldName, $ImageNewName, $ImageFile, $ImageThumb) = explode("|",$Images);

									if(!isset($Params->Collid) || empty($Params->Collid))
									{
										$Params->Numofphotos = 1;
										$Response = $Service->Execute(&$AppContext, "SaveGalleryInfo", &$Params);
										if($Response->Success)
										{
											$ObjectID = !isset($Response->Object[0]) ? $Response->Object : $Response->Object[0];
											$Params->Collid = $ObjectID->ID;

											$ImageName = $Params->Collid."_".str_replace(" ","_",$Params->Title);
											if(!array_key_exists($ImageName, $ImageTitles))
											{
												$ImageTitles[$ImageName] = $ImageName;
											}
											else
											{
												$ImageName .= "-".($Counter - 1);
											}

											$Params->Url = "$ImageName.jpg";
											$Params->Thumburl = $ImageName."_t.jpg";
										}
									}
									else
									{
										$Params->Photonum++;
										$ImageName = $Params->Collid."_".str_replace(" ","_",$Params->Title);
										if(!array_key_exists($ImageName, $ImageTitles))
										{
											$ImageTitles[$ImageName] = $ImageName;
										}
										else
										{
											$ImageName .= "-".($Counter - 1);
										}

										$Params->Url = $Params->Collid."/$ImageName.jpg";
										$Params->Thumburl = $Params->Collid."/".$ImageName."_t.jpg";
									}

									if(! rename($ImageFile, $Destination."/$ImageName.jpg") )
									{
										echo "<p>unable to rename image</p>";
									}
									if(! rename($ImageThumb, $Destination."/".$ImageName."_t.jpg") )
									{
										echo "<p>unable to rename thumb</p>";
									}

									$Params->Title = $Title[($Counter - 1)];
									$Params->Description = $Description[($Counter - 1)];
 
									$Response = $Service->Execute(&$AppContext, "SavePhotoInfo", &$Params);

									//reset title and description values
									$Params->Title = $Title;
									$Params->Description = $Description;
									$Params->Collid = $Collid;
									//TODO: handle error when saving images
									$Counter++;
								}

								$AppContext->Message['PhotoUploadForm_Msg'] = "Upload completed.";
								$AppContext->Session->Remove("PhotoUpload");
								$AppContext->Session->PhotoUpload = NULL;
								//TODO: send email
								$Step = 3;
							}

							$GalleryInfo = $Params;
						}
						else
						{
							$Step = 1;
						}

						break;

			default : $Step = '1';
		}

		require_once("step$Step.php");
	}
?>