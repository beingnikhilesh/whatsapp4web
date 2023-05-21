<?php

namespace beingnikhilesh\whatsapp4web\MessageObjects;

use beingnikhilesh\whatsapp4web\Config;
use beingnikhilesh\whatsapp4web\traits\URLAndTypeTrait;
use beingnikhilesh\whatsapp4web\traits\ConstructTrait;

class MessageFile extends BaseMessageObject
{
    use URLAndTypeTrait;
    use ConstructTrait;

    const CLASSNAME = 'beingnikhilesh\whatsapp4web\MessageObjects\MessageFile';
    # Allowed Image Types
    private array $fileTypes = [
        # Image
        'gif', 'jpg', 'jpeg', 'png', 'svg',
        # File Type 
        'pdf', 'cdr', 'xls', 'xlsx', 'zip', 'ppt', 'pptx', 'csv', 'doc', 'docx', 'rtf', 'txt', 'psd', 'ai', 'eps', 'html', 'epub',
        # Video
        'mp4', 'm4v', 'webm', '3gp', '3g2', 'mkv', 'flv', 'avi', 'wmv', 'mov',
        # Audio
        'aac', 'amr', 'flac', 'm4a', 'm4r', 'mp3', 'ogg', 'wav',
        # Others
    ];
}
