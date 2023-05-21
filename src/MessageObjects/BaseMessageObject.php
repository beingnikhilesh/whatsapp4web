<?php

namespace beingnikhilesh\whatsapp4web\MessageObjects;

use beingnikhilesh\whatsapp4web\Config;
use beingnikhilesh\whatsapp4web\Formats\InterfaceMessageObject;
use beingnikhilesh\whatsapp4web\Utils\Recipients;

abstract class BaseMessageObject implements InterfaceMessageObject
{
    /** Protected Function to Hold the Message */
    protected string $message = '';
    /** Protected Variable to hold the Config Object */
    protected Config $config;
    /** Protected Variable to hold the Config Object */
    protected Recipients $recipients;
    /** Protected Variable to hold the Message Type Object */
    protected $messageObject;
    /** Protected Function to Set the Delay between Two Messages */
    protected int $minDelay = 5;
    protected int $maxDelay = 10;

    /**
     * Public Function to Set the Message
     *  Chaining Function
     */
    public function message(?string $message = ''): self
    {
        if (is_string($message) and !empty($message))
            $this->message = $message;

        return $this;
    }

    /** Public Function to Accept the Config */
    public function config(Config $config)
    {
        $this->config = $config;
    }

    /** Public Function to Accept the Recipients */
    public function recipients(Recipients $recipients)
    {
        $this->recipients = $recipients;
    }

    /** Public Function to Add More Recipients LaterOn */
    function to($recipients)
    {
        if (!is_array($recipients))
            $recipients = [$recipients];
        $this->recipients->set_recipients($recipients);
        return $this;
    }

    /** Public Function to set the Delay Parameters */
    public function delay(int $minDelay, int $maxDelay)
    {
        if (empty($minDelay) or empty($maxDelay))
            return;
        # Validate the Numbers
        if ($maxDelay <= $minDelay)
            return;
        # Set the Parameters
        $this->minDelay = $minDelay;
        $this->maxDelay = $maxDelay;
        return;
    }

    /** 
     * Public Function to Initiate the Send 
     * @return  String  Response
     */
    public function send()
    {
        # Define the Variables
        $response = '';

        $platformObject = $this->_getPlatformObject();
        if (is_object($platformObject))
            $response = $platformObject->config($this->config)->send($this);

        return $response;
    }

    #############################################################################
    #   GET Functions
    #############################################################################

    /** Public Function to get the URL */
    function getText(): string
    {
        return $this->message;
    }

    /** Public Function to get the Recipients to whom the Whatsapp is to be Sent */
    function getRecipients()
    {
        return $this->recipients->get_recipients();
    }

    /** Function to get the Min Delay Time */
    function getMinDelay(): int
    {
        return $this->minDelay;
    }

    /** Function to get the Max Delay Time */
    function getMaxDelay(): int
    {
        return $this->maxDelay;
    }

    #############################################################################
    #   Miscellaneous Functions
    #############################################################################

    /** Private function to get the Plaform Object */
    private function _getPlatformObject()
    {
        $platformClientBasePath = '\\beingnikhilesh\\whatsapp4web\\MessageObjects\\Platform\\' . strtolower($this->config->getPlatform()) . '\\' . (new \ReflectionClass($this))->getShortName();
        return new $platformClientBasePath($this);
    }
}
