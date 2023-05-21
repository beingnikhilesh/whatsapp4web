<?php

namespace beingnikhilesh\whatsapp4web\MessageObjects\Platform\w2r;

use beingnikhilesh\whatsapp4web\MessageObjects\BaseMessageObject;

class MessageText{

    private $messageType = 'text';
    
    /** Function to send the Contents for the Message Type */
    protected function _getContents()
    {
        return [
            'type' => $this->messageType,
            'message' => rawurlencode($this->messageObject->getText()),
        ];
    }
}