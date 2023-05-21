<?php

namespace beingnikhilesh\whatsapp4web\MessageObjects;

use beingnikhilesh\whatsapp4web\Config;

class MessageText extends BaseMessageObject
{
    const CLASSNAME = 'beingnikhilesh\whatsapp4web\MessageObjects\MessageSticker';
    
    function __construct(?string $message = ''){
        $this->message($message);
    }

    
}
