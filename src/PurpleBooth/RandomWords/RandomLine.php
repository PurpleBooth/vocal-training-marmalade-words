<?php

namespace PurpleBooth\RandomWords;

/**
 * Pick a random line from a file
 *
 * @package PurpleBooth
 */
class RandomLine
{

    /**
     * Path to data file
     *
     * @var string
     */
    private $path;

    /**
     * Init class
     *
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Get a random line from a file
     */
    public function getRandomLine()
    {
        $contents = file_get_contents($this->path);
        $trimmed = trim($contents, "\n\r");
        $values = explode("\n", $trimmed);
        $value = $values[array_rand($values)];

        return $value;
    }
}
