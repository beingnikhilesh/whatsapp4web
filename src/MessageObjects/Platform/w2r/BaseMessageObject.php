<?php

namespace beingnikhilesh\whatsapp4web\MessageObjects\Platform\w2r;

use beingnikhilesh\whatsapp4web\Config;
use beingnikhilesh\whatsapp4web\Error\Error;
use beingnikhilesh\whatsapp4web\Formats\InterfaceMessageObject;

abstract class BaseMessageObject implements InterfaceMessageObject
{
    /** Protected Variable to hold the Config Object */
    protected Config $config;

    /** Public Construct Function */
    public function __construct(protected InterfaceMessageObject $messageObject)
    {
    }

    /** Public Function to get the Contents of the Message */
    abstract protected function _getContents();

    /** Public function to receive the Config Object */
    public function config(Config $config)
    {
        $this->config = $config;
        return $this;
    }

    /** 
     *  Public Function to Add More Recipients LaterOn 
     *      We're adding on to the Original InterfaceMessageObject that was passed i.e. beingnikhilesh\whatsapp4web\MessageObjects\BaseMessageObject
     */
    function to($recipients)
    {
        $this->messageObject->to($recipients);
        return $this;
    }

    /** Public Function to Send the Message via w2r Library */
    public function send()
    {
        # Get the Message Contents
        $messageContents = array_merge(
            $this->_getContents(),
            [
                'instance_id' => @$this->config->getPlatformSettings()['instanceID'],
                'access_token' => @$this->config->getPlatformSettings()['accessToken'],
            ]
        );

        return $this->_send($messageContents);
    }

    /** Private function to Actually Send the Message */
    private function _send(array $messageContents = [])
    {
        # Declare the Variables, Libraries, etc
        $client = new \GuzzleHttp\Client();
        $response = [];
        $returnResponse = [];
        $multiple = FALSE;

        # Verify if there's anything to Send
        if (empty($messageContents) or empty($this->messageObject->getRecipients()))
            return Error::set_error('Invalid Message Contents Provided to Send the Whatsapp Message - Platform: w2r');

        $url = @$this->config->getPlatformSettings()['baseURL'] . 'api/send.php?';
        # Check if Multiple Numbers
        $multiple = count($this->messageObject->getRecipients()) > 1 ? TRUE : FALSE;
        foreach ($this->messageObject->getRecipients() as $key => $val) {
            $callURL = $url . http_build_query(array_merge($messageContents, ['number' => $val]), 'flags_');
            $response = $client->post($callURL);

            # Create the Response
            $returnResponse[] = [
                'request_url' => $callURL,
                'number' => $val,
                'time' => time(),
                'response' => $response->getStatusCode() != 200
                    ? json_encode(['error' => (string) $response->getBody()]) : (string) $response->getBody()
            ];

            # Pause if there's another Number to Send
            if ($multiple AND count($this->messageObject->getRecipients()) != (count($returnResponse)))
                sleep(rand($this->messageObject->getMinDelay(), $this->messageObject->getMaxDelay()));
        }

        # Return a Singular response if Only One Number, else Array
        if ($multiple)
            return $returnResponse;
        else
            return $returnResponse[0];
    }
}
