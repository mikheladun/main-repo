<?php
    /**
     * This represents just the file portion of the form processing
     */
    require_once('Upload.class.php');
    require_once('MimeTypes.class.php');

    // set destination folder
    $destination = '/path/to/destination/';

    // start new upload object
    $m = new AP_File_MimeTypes();
    $types = $m->getTypes('image');
    unset($m);
    
    $ul = new AP_File_Upload($types);
    //$ul = new AP_File_Upload();

    // loop through uploaded files and save each one
    foreach($_FILES as $file)
    {
        if(!empty($file['name']) && $ul->save_file($file,$destination) == false)
        {
            // you'll want to handle error in some way 
            // more elegant than dying
            die($ul->get_error());
        }
    }
    
    // continue processing files as needed

?>
