   <?php
       /**
       * Basic file uploader
       *
       * @example
       *        $ul = new AP_File_Uploader();
       *        $upload_location = $ul->save_file($_FILES['myfile'],$destination,'my_new_file.jpg');
       *        if(!upload_location)
       *        {
      *            ... handle error ...
      *            $error = $ul->get_error();
      *        }
      *
      * @uses AP_File_MimeTypes
      *
      */
      class AP_File_Upload
      {
          /**
          * list of acceptable file types
          *
          * @var array
          */
          var $accept = array();
  
          /**
          * file destination
          *
          * @var string - server path
          */
          var $destination;
  
          /**
          * Error string
          * If anything goes wrong this will give the reason
          *
          * @var string
          */
          var $_error;

          /**
          * constuct
          *
          * @param string $destination
          * @param array $accept
          */
          function _constructor($acc=false)
          {
              if(is_array($acc)) { $this->accept = $acc; }
              else
              {
                  if(class_exists('AP_File_MimeTypes'))
                  {
                      $mt = new AP_File_MimeTypes();
                      $this->accept = $mt->getTypes();
                      unset($mt);
                  }
                  //else { throw new Exception('Mime type class not defined'); }
				  else { die('Mime type class not defined'); }
              }
          }

	   	  function AP_File_Upload()
		  {
			$this->_constructor();
		  }

          /**
          * Check file type
          *
          * @param string $file
          * @return bool
          */
          function check_type($file)
          {
              // get file type
              //$ext = pathinfo($file['name']);
			  $ext = substr(strrchr($file['name'],"."),1);
			  $ext = strtolower($ext);

              // make sure the image is a valid file type and that they type matches the extention
              if(!array_key_exists($ext,$this->accept))
              {
                  $this->_error = '<strong><em>'.$file['name'].'</em></strong> is an invalid file type';
                  return false;
              }
              elseif(($this->accept[$ext] != strtolower($file['type'])) && ($file['type'] != 'image/pjpeg'))
              {
                  $this->_error = '<strong><em>'.$file['name'].'</em></strong> file type does not match file extention';
                  return false;
              }
              else { return true; }
          }

          /**
          * Make sure uploaded file exists
          *
          * @param string $path
          * @return bool
          */
          function check_temp($path)
          {
              if(is_file($path) && is_uploaded_file($path)) { return true; }
              else
              {
                  $this->_error = 'could not find uploaded file';
                  return false;
             }
         }

         /**
         * Return the error string
         *
         * @return string
         */
         function get_error()
         {
             return $this->_error;
         }

		 /**
		 *
		 *
		 *
		 */
		 function process(&$files, $destination, $url)
		 {
		 	$images = array();

			// loop through uploaded files and save each one
			$wscale = 400;
			$hscale = 300;
			$twscale = 75;
			$thscale = 56;

			for($i=0; $i < count($files['uploadfile']['name']); $i++)
			{
				//echo "<br/>Processing ", $files['uploadfile']['type'][$i], "<br/>";
				$file = array();
				$file['error'] = $files['uploadfile']['error'][$i];
				$file['name'] = $files['uploadfile']['name'][$i];
				$file['tmp_name'] = $files['uploadfile']['tmp_name'][$i];
				$file['type'] = $files['uploadfile']['type'][$i];

				//This is the temporary file created by PHP
				//$uploadedfile = $files['uploadfile']['tmp_name'];
				//$destination = dirname(__FILE__).'/../../Assets/marketplace/listing/upload/';
				//$uploadedfile = $destination . $file['name'];
				//$uploadedfile = $destination . szRand;
				$uploadedfile = $file['tmp_name'];

				// Create an Image from it so we can do the resize
				switch($file['type'])
				{
					case "image/jpeg" :
						$src = imagecreatefromjpeg($uploadedfile);
						break;
					case "image/gif" :
						$src = imagecreatefromgif($uploadedfile);
						break;
					case "image/png" :
						$src = imagecreatefrompng($uploadedfile);
						break;
				}

				// Capture the original size of the uploaded image
				list($width,$height)=getimagesize($uploadedfile);

				// For our purposes, I have resized the image to be 600 pixels wide, and maintain the original aspect
				// ratio. This prevents the image from being "stretched" or "squashed". If you prefer some max width other than
				// 600, simply change the $newwidth variable
				if($width > $wscale)
				{
					$newwidth=$wscale;
					$newheight=($height/$width)*$wscale;
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

				//Capture thumbnail sizes
				if($width  > $twscale)
				{
					//thumbnails
					$tnewwidth=$twscale;
					$tnewheight=($height/$width)*$twscale;
				}
				if($height > $thscale)
				{
					$tnewheight = $thscale;
					$tnewwidth = ($width/$height)*$thscale;
				}
				else
				{
					$tnewwidth = $width;
					$tnewheight = $height;
				}

				$tmp=imagecreatetruecolor($newwidth,$newheight);
				$ttmp=imagecreatetruecolor($tnewwidth,$tnewheight);

				//this line actually does the image resizing, copying from the original image into the $tmp image
				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
				imagecopyresampled($ttmp,$src,0,0,0,0,$tnewwidth,$tnewheight,$width,$height);

				// now write the resized image to disk. I have assumed that you want the
				// resized, uploaded image file to reside in the ./images subdirectory.
				$szRand = md5(mktime() . rand(0, 25));
				$filename = $szRand . "_00". ($i + 1) . ".jpg";
				$tfilename = $szRand . "_00". ($i + 1) . "_t.jpg";
				$tmpfile = $destination . $filename;
				$ttmpfile = $destination . $tfilename;
				imagejpeg($tmp,$tmpfile,100);
				imagejpeg($ttmp,$ttmpfile,100);

				chmod($tmpfile, 0666);
				chmod($ttmpfile, 0666);

				imagedestroy($src);
				imagedestroy($tmp); // NOTE: PHP will clean up the temp file it created when the request has completed.
				imagedestroy($ttmp); // NOTE: PHP will clean up the temp file it created when the request has completed.

				$images[] = $file['name']. "|" .$filename . "|" . $tmpfile . "|" . $ttmpfile;

				//echo "<br/>".$file['name']."$filename | $tmpfile | $ttmpfile";	
			}

			return $images;
		 }

         /**
         * Save uploaded file
         *
         * $file = $_FILE['upload_name'];
         *
         * @param array $file - POST $_FILES array for file
         * @param string $destination - where to save the file
         * @param bool/string $new_name - false or what to rename the file
         * @return bool/string - false or location of uploaded file
         */
		 function save($file, $destination, $new_name=false)
		 {
			 // process destination
			 if(is_dir($destination))
			 {
				 if(is_writable($destination)) { $this->destination = $destination; }
				 //else { throw new Exception('Destination is not writable - check directory permissions.'); }
				 else { $this->error = 'Destination is not writeable - check directory permissions.'; return false; }
			 }
			 //else { throw new Exception('Provided directory for file upload is not valid'); }
			 else { $this->error = 'Provided directory for file upload is not valid'; return false; }

			 // make sure a file was uploaded
			 if($this->check_temp($file['tmp_name']) && $this->check_type($file))
			 {
				 // use original file name if a new one is not supplied, replace spaces with underscores
				 if(!$new_name) { $new_name = str_replace(' ','_',$file['name']); }

				 // build full file path for move
				 $uploadfile = $destination.$new_name;

				 // if we're looking at an uploaded file and the file
				 // can be moved then we're OK
				 if(!move_uploaded_file($file['tmp_name'], $uploadfile))
				 {
					 $this->_error = 'Could not move uploaded file - flog the webmaster';
					 return false;
				 }
				 else
				 {
					 // change permissions on the file
					 if(chmod($uploadfile,0755)) { return $uploadfile; }
					 else
					 {
						 $this->_error = 'Could not change permissions on uploaded file. Please contact the system administrator';
						 return false;
					 }
				 }
			 }
		 }

         /**
         * Validate uploaded file
         *
         * $file = $_FILE['upload_name'];
         *
         * @param array $file - POST $_FILES array for file
         * @param string $destination - where to save the file
         * @param bool/string $new_name - false or what to rename the file
         * @return bool/string - false or location of uploaded file
         */
         function validate($file)
         {
             switch($file['error'])
             {
                 case 0:
                     // make sure a file was uploaded
                     if(!($this->check_temp($file['tmp_name']) && $this->check_type($file)))
                     {
					 	//$this->_error = 'File upload incomplete - Please retry your upload';
					 	return false;
                     }
					 return true;
                 case 1:
                 case 2:
                     $this->_error = 'The '.$file['name'].' image was too large. Please edit the image or upload a different image.';
                     return false;
                 case 3:
                     $this->_error = 'File upload incomplete - Please retry your upload';
                     return false;
                 case 4:
                     $this->_error = 'No file uploaded. Please select a file to upload';
                     return false;
                 case 6:
                     $this->_error = 'No temp folder on server - whack the server admin';
                     return false;
                 case 7:
                     $this->_error = 'Failed to write to disk';
                     return false;
                 default:
                     $this->_error = 'Unknown error occured';
                     return false;
             } // switch
         }

     }
 ?>
