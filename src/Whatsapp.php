<?php

namespace beingnikhilesh\whatsapp4web;

use beingnikhilesh\whatsapp4web\Traits\ProvidesMessageObjects;
use beingnikhilesh\whatsapp4web\Utils\Recipients;

class Whatsapp
{
    use ProvidesMessageObjects;

    /** Client Object to deal with Configuration files */
    protected $config;
    /** Object to Store the Recipients Object */
    protected Recipients $recipients;

    protected $availableMessageObjects = [
        'text'      => MessageObjects\MessageText::class,
        'image'     => MessageObjects\MessageImage::class,
        'audio'     => MessageObjects\MessageAudio::class,
        'video'     => MessageObjects\MessageVideo::class,
        'file'      => MessageObjects\MessageFile::class,
        'location'  => MessageObjects\MessageLocation::class,
        'contact'   => MessageObjects\MessageContact::class,
        'sticker'   => MessageObjects\MessageSticker::class,
    ];

    /**
     *  Construct Function
     *  Pass Optional Parameter Platform to select Manually
     */
    function __construct(private string $platform = '')
    {
        $this->config = new Config($platform);
        $this->recipients = new Recipients();   # Initialise Recipients
    }

    /** Function to Accept the Numbers to which the Whatsapp is to be Sent */
    function to($recipients)
    {
        if (!is_array($recipients))
            $recipients = [$recipients];
        $this->recipients->set_recipients($recipients);
        return $this;
    }

    /*
    *   Function to receive anonymous Calls for Actionable Classes and return an instance of the Actionable Classes  
    */
    public function __call(string $name, $arguments)
    {
        return $this->createMessageObject($name, $arguments);
    }

    /**
     * Function to Accept the names of Gateways or additional Settings Set
     *  E.g. w2r, gupshup - Gateways or Modes (Promotional, Transactional) and settings  
     */
    function __get($name)
    {
    }
}
