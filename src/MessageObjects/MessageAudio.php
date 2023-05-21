<?php

namespace beingnikhilesh\whatsapp4web\MessageObjects;

use beingnikhilesh\whatsapp4web\Config;
use beingnikhilesh\whatsapp4web\traits\URLAndTypeTrait;
use beingnikhilesh\whatsapp4web\traits\ConstructTrait;

class MessageAudio extends BaseMessageObject
{
    use URLAndTypeTrait;
    use ConstructTrait;

    const CLASSNAME = 'beingnikhilesh\whatsapp4web\MessageObjects\MessageAudio';
    # Allowed Image Types
    private array $fileTypes = [
        # Video
        'mp4', 'm4v', 'webm', '3gp', '3g2', 'mkv', 'flv', 'avi', 'wmv', 'mov',
    ];
}
