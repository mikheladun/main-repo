<?php

    $Step = isset($_REQUEST['step']) && !empty($_REQUEST['step']) ? $_REQUEST['step'] : 1;
	$Submit = isset($_REQUEST['submit']) && !empty($_REQUEST['submit']) ? strtolower($_REQUEST['submit']) : '';

	if($Submit == 'cancel')
	{
		require_once(dirname(__FILE__)."/../video.php");
	}
	else
	{
		require_once(dirname(__FILE__)."/../../Library/Framework/Core/Framework.Utils.php");
 		$Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.VIDEO"]);

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
							$types = $m->getTypes('video');
							unset($m);

							$ul = new AP_File_Upload($types);

							$Params->Video = $_FILES['uploadfile'];

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
									$AppContext->AddErrorMessage('Video','<br/>'.$ul->get_error());
								}
							}

							$Params->Name = $_REQUEST['name'];
							$Params->Email = $_REQUEST['email'];
							$Params->Title = $_REQUEST['title'];
							$Params->Description = $_REQUEST['description'];
							$Params->AcceptTerms = $_REQUEST['terms'];

							if(empty($AppContext->ErrorMessage))
							{
								$Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.VIDEO"]);
								$Response = $Service->Execute(&$AppContext, "ValidateVideoUpload", &$Params);
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
	
									//$Params->Images = $ul->save($_FILES, $Destination.$_FILES['uploadfile']['name'][0], false);
									//TODO: handle image resize better, include not sufficient resize images set destination folder
									$URL = "/Assets/video/";
									$Destination = dirname(__FILE__)."/../..".$URL;
									$Filename = $_FILES['uploadfile']['name'][0];
									$Filename = str_replace(" ", "_", $Filename);
									//$Filename = substr($Filename, 0, strlen($Filename) - 4);
									$Videoname = substr($Filename, 0, strlen($Filename) - 4);

									//echo "<br/>Filename: $Filename   Videoname: $Videoname";

									$Params->Url = $Videoname.".flv";
									$Params->Thumburl = $Videoname."_t.jpg";
									$Params->External = '0';
									$Params->Sourceid = 0;
									$Params->Categoryid = 0;
									$Params->Typeid = 0;
									$Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.VIDEO"]);
									$Response = $Service->Execute(&$AppContext, "SaveVideoInfo", $Params);
									if($Response->Success)
									{
										$ObjectID = $Response->Object;
										$Params->Videoid = $ObjectID->ID;

										$Destination = $Destination . $Params->Videoid . "/";

										if(!file_exists($Destination))
										{
											mkdir($Destination);
										}

										move_uploaded_file($_FILES['uploadfile']['tmp_name'][0], $Destination . $Filename);

										$mov = new ffmpeg_movie($Destination . $Filename);
										$frame = $mov->getFrame($mov->getFrameCount() * .10);
										$wscale = 100;
										$hscale = 75;
										$width = $frame->getWidth();
										$height = $frame->getHeight();
										if($width > $wscale)
										{
											$newwidth = $wscale;
											$newheight = ($height/$width)*$wscale;
										}
										if($height > $hscale)
										{
											$newheight = $hscale;
											$newwidth = ($width/$height)*$hscale;
										}
										else
										{
											$newwidth = $width;
											$newheight = $height;
										}

										$image = $frame->toGDImage();
										$tmp=imagecreatetruecolor($newwidth,$newheight);
										imagecopyresampled($tmp,$image,0,0,0,0,$newwidth,$newheight,$width,$height);
										imagejpeg($tmp, $Destination.$Params->Thumburl, 100);
										imagedestroy($tmp);
										imagedestroy($image);

										$upl = "/usr/local/bin/ffmpeg -i $Destination$Filename -ar 44100 -ab 128k -f flv -b 700k -s 480x360 -y $Destination$Params->Url";
										//echo "<br/>$upl<br/><br/>";
										exec($upl, $output);
										//print_r($output);
										
										$AppContext->Message['VideoUploadForm_Msg'] = "Upload completed.";

										$VideoInfo = $Params;
										$Step = 2;
									}
								}
							}
						}

						break;

			default : $Step = '1';
		}

		require_once("step$Step.php");
	}
?>