<?php

namespace beingnikhilesh\whatsapp4web\MessageObjects;

use beingnikhilesh\whatsapp4web\Config;
use beingnikhilesh\whatsapp4web\traits\URLAndTypeTrait;
use beingnikhilesh\whatsapp4web\traits\ConstructTrait;

class MessageAudio extends BaseMessageObject
{
    use URLAndTypeTrait;
    use ConstructTrait;

    const CLASSNAME = 'beingnikhilesh\whatsapp4web\MessageObjects\MessageVideo';
    # Allowed Image Types
    private array $fileTypes = [
        # Audio
        'aac', 'amr', 'flac', 'm4a', 'm4r', 'mp3', 'ogg', 'wav',
    ];
}
