<?php

namespace PurpleBooth;

/**
 * Entity class to maintain the interface with the view
 *
 * @package PurpleBooth
 */
class PageSettings
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $interval;

    /**
     * @var int
     */
    private $reminder = 0;

    /**
     * Interval to wait before loading a new random word/phrase (ms)
     *
     * @return int
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * Set the interval
     *
     * @param int $interval
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;
    }

    /**
     * When to display a reminder. 0 for don't display a reminder
     *
     * @return int
     */
    public function getReminder()
    {
        return $this->reminder;
    }

    /**
     * Set the reminder
     *
     * @param int $reminder
     */
    public function setReminder($reminder)
    {
        $this->reminder = $reminder;
    }

    /**
     * Page type, phrases, or words
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the page type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}
