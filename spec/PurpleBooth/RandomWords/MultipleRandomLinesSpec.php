<?php

namespace spec\PurpleBooth\RandomWords;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Promise\ReturnPromise;

class MultipleRandomLinesSpec extends ObjectBehavior
{
    function let($randomLines)
    {
        $randomLines->beADoubleOf('PurpleBooth\RandomWords\RandomLine');
        $randomLines->getRandomLine()->will(new ReturnPromise(array(
            "Marmite",
            "Machine",
            "Marmite",
            "Marmite",
            "Marmite",
            "Machine",
            "Marmite",
            "Machine",
            "Machine",
            "Marmite",
            "Marmite",
            "Marmite",
            "Machine",
            "Marmite",
            "Machine",
        )));
        $this->beConstructedWith($randomLines);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('PurpleBooth\RandomWords\MultipleRandomLines');
    }

    function it_returns_number_of_words_given()
    {
        $this->getLines(10)->shouldHaveCount(10);
    }

    function it_returns_no_two_words_repeated_in_sequence()
    {
        $this->getLines(10)->shouldHaveNoTwoWordsRepeatedInSequence();
    }

    function it_has_can_get_a_single_line()
    {
        $this->getLine()->shouldBeString();
    }

    function getMatchers()
    {
        return array(
            'haveNoTwoWordsRepeatedInSequence' => function ($subject) {
                if (!is_array($subject)) {
                    return false;
                }

                $previousWord = null;

                foreach ($subject as $word) {
                    if ($previousWord != null && $previousWord == $word) {
                        return false;
                    }

                    $previousWord = $word;
                }

                return true;
            },
        );
    }
}
