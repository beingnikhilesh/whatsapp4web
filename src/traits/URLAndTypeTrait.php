<?php

namespace beingnikhilesh\whatsapp4web\traits;

use beingnikhilesh\whatsapp4web\Error\Error;

trait URLAndTypeTrait
{
    /** Private function to validate an URL */
    private function _validate(string $url,string $fileName, string $fileType = '')
    {   
        # Validate the URL of the File
        if (!filter_var($url, FILTER_VALIDATE_URL))
            Error::set_error("Invalid " . $fileType . " URL Set for Whatsapp to Send", self::CLASSNAME);

        # Validate FileType and Extension
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($ext, $this->fileTypes))
            Error::set_error("Invalid " . $fileType . " File Type Set to Send for Whatsapp. Only " . implode(", ", $this->fileTypes) . ' Types are allowed', self::CLASSNAME);
        
        if(!Error::check_error())
            return;
        
        # Validate if both File Extension Types match
        if($ext !== strtolower(pathinfo($url, PATHINFO_EXTENSION)))
            return Error::set_error("The " . $fileType ." URL extension and " . $fileType . " filename Extension do not Match");
    }
}
