<?php

namespace beingnikhilesh\whatsapp4web\MessageObjects\Platform\w2r;

use beingnikhilesh\whatsapp4web\MessageObjects\Platform\w2r\BaseMessageObject;
use beingnikhilesh\whatsapp4web\traits\GetContentsMediaTrait;

class MessageImage extends BaseMessageObject
{
    use GetContentsMediaTrait;

    private $messageType = 'media';
}
