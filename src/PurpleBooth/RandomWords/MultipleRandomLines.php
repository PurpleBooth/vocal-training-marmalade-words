<?php

namespace PurpleBooth\RandomWords;

/**
 * Class MultipleRandomLines.
 *
 * Get a defined number of random lines
 */
class MultipleRandomLines
{
    /**
     * @var RandomLine
     */
    private $randomLine;

    /**
     * @param RandomLine $randomLine
     */
    public function __construct(RandomLine $randomLine)
    {
        $this->randomLine = $randomLine;
    }

    /**
     * get a single random line.
     *
     * @return string
     */
    public function getLine()
    {
        $lines = $this->getLines(1);

        return array_pop($lines);
    }

    /**
     * Get the number of lines requested.
     *
     * No two lines will be the same in sequence
     *
     * @param int $numberOfLines
     *
     * @return array
     */
    public function getLines($numberOfLines)
    {
        $lines = array();
        $previousLine = null;

        foreach (range(1, $numberOfLines) as $lineNumber) {
            do {
                $potentialLine = $this->randomLine->getRandomLine();
            } while ($previousLine == $potentialLine);

            $lines[] = $potentialLine;
            $previousLine = $potentialLine;
        }

        return $lines;
    }
}
