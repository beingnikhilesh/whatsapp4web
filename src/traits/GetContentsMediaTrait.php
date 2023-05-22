<?php

namespace beingnikhilesh\whatsapp4web\traits;

trait GetContentsMediaTrait
{
    private $messageType = 'media';

    /** Function to send the Contents for the Media Type */
    protected function _getContents()
    {
        return [
            'type' => $this->messageType,
            'media_url' => $this->messageObject->getURL(),
            'filename' => $this->messageObject->getName(),
            'message' => $this->messageObject->getText(),
        ];
    }
}
