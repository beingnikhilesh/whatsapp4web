<?php

namespace beingnikhilesh\whatsapp4web\traits;

trait ProvidesMessageObjects
{
    /**
     * Proxy any MessageObject to the right api call
     * @param $name
     * @return mixed
     */
    public function createMessageObject($name, $arguments)
    {
        if (in_array($name, $this->getAvailableMessageObjectKeys())) {
            $class =  $this->availableMessageObjects[$name];
            $newClass = new $class(...$arguments);      # Initialise Object
            $newClass->config($this->config);           # Set Config File
            $newClass->recipients($this->recipients);   # Set Recipients
            return $newClass;
        }
    }

    /**
     * Get the list of available Message Objects
     * @return array
     */
    public function getAvailableMessageObjects()
    {
        return $this->availableMessageObjects;
    }

    /**
     * Get the list of available Message Object keys
     * @return array
     */
    public function getAvailableMessageObjectKeys()
    {
        return array_keys($this->getAvailableMessageObjects());
    }
}
