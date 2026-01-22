<?php

namespace App\Services;

class EventService
{

    /**
     * Is the event a recurring one.
     *
     * @var boolean
     */
    protected bool $recurring = false;

    /**
     * Constructor
     */
    public function __construct()
    {
        throw new \Exception('Not implemented');
    }

    /**
     * Make the event recurring.
     *
     * @param boolean $isRecurring
     * @return self
     */
    public function recurring($isRecurring = false): self
    {
        $this->recurring = $isRecurring;
        return $this;
    }

    /**
     * Check if the event is recurring.
     *
     * @return boolean
     */
    public function isRecurring(): bool
    {
        return $this->recurring ?? false;
    }
}