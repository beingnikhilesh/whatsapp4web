<?php

namespace beingnikhilesh\whatsapp4web\MessageObjects;

use beingnikhilesh\whatsapp4web\Config;
use beingnikhilesh\whatsapp4web\traits\URLAndTypeTrait;
use beingnikhilesh\whatsapp4web\traits\ConstructTrait;

class MessageImage extends BaseMessageObject
{
    use URLAndTypeTrait;
    use ConstructTrait;

    const CLASSNAME = 'beingnikhilesh\whatsapp4web\MessageObjects\MessageImage';
    # Allowed Image Types
    private array $fileTypes = ['gif', 'jpg', 'jpeg', 'png'];
}
