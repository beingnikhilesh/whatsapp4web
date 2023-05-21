<?php

namespace beingnikhilesh\whatsapp4web;

use beingnikhilesh\whatsapp4web\Error\Error;

/**
 *  Common Configuration File Class for Whatsapp Platform API Access
 *      The Config File May contain the Configurations / Credentials for Various Companies at One Place
 *      The User may connect to Any Whatsapp Platform API, at any Instance
 *  \beingnikhilesh\error Composer Class is Required for this Module to Work
 * 
 *  V0.0.1
 * 
 *  By: @beingnikhilesh Team
 */

class Config
{
    ##############################################################
    #   API User Details Configuration for various Whatsapp Platforms
    ##############################################################

    private $config = [
        /*
          |--------------------------------------------------------------------------
          | Is API Enabled
          |--------------------------------------------------------------------------
          |
          | This value determines whether the Accounting Platform API Library is Enabled
          |
         */
        'enabled' => TRUE,
        /*
          |--------------------------------------------------------------------------
          | Default User
          |--------------------------------------------------------------------------
          |
          | Default Platform to Connect to via the API
          |
         */
        'default' => 'w2r',
        /*
          |--------------------------------------------------------------------------
          | Platform Settings
          |--------------------------------------------------------------------------
          |
          | This Variable Contains the Various Settings required for Accessing the API's of Various Platforms
          |
         */
        'platforms' => [
            'w2r' => [
                'accessToken' => '', # Optional - Default User to Use for API Access, Leave NULL for Default Values
                'instanceID' => '',
                'baseURL' => 'https://whatsapp.w2r.in/'
            ], 'gupshup' => []
        ]
    ];

    # Constant to Identify the Error Globally
    const CLASSNAME = 'beingnikhilesh\whatsapp4web\Config';
    # Default User
    protected $default = '';

    /*
     * Construct Function
     */

    function __construct(string $platform = '')
    {
        # Set the User or the Default
        $this->setPlatform((empty($platform)) ? $this->config['default'] : $platform);
    }

    ##############################################################
    #   SET FUNCTIONS
    ##############################################################

    /**
     * Function to set the ZohoBooks User Explicitly
     *  Chaining Function
     */

    public function setPlatform(string $platform = ''): static
    {
        if (empty($platform)) {
            if (empty($this->config['default']))
                Error::set_error('Invalid or No Whatsapp API Platform Set', self::CLASSNAME);
            else
                $this->default = $this->config['default'];
        } else {
            if (in_array($platform, array_keys($this->config['platforms']))) {
                $this->default = $this->config['default'] = $platform;
            } else
                Error::set_error('Invalid Whatsapp API Platform Set', self::CLASSNAME);
        }

        return $this;
    }

    ##############################################################
    #   GET FUNCTIONS
    ##############################################################

    /** Function to set the Platform Settings from the Database */
    public function getPlatformSettings(string $platformName = ''): array|NULL
    {
        if (empty($platformName))
            return $this->config['platforms'][$this->default];
        else
            return $this->config['platforms'][$this->config['default']];
    }

    /** Get the Platform Name set in the Settings */
    function getPlatform(): string
    {
        return $this->config['default'];
    }
}
