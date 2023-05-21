<?php

namespace beingnikhilesh\whatsapp4web\traits;

trait ConstructTrait
{
    /** Construct Function to Accept the URL and the Name */
    function __construct(protected ?string $url, protected string $name = '')
    {
        # Validate the URL, Image Name against Allowed Types
        $this->_validate($url, $name, 'Document');
    }

    ##################################################################
    # GET Functions
    ##################################################################

    /** Public Function to get the URL */
    function getURL() : string
    {
        return $this->url;
    }

    /** Public Function to get the Document Name */
    function getName(): string
    {
        return $this->name;
    }
}
