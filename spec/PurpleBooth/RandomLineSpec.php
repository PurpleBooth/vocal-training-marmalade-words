<?php

namespace spec\PurpleBooth;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RandomLineSpec extends ObjectBehavior
{
    private $testFilename = "/tmp/testing";

    function let()
    {
        file_put_contents($this->testFilename, "moon\nmatch\nmarch\nmonday\n\n");
        $this->beConstructedWith($this->testFilename);
    }

    function letgo()
    {
        unlink($this->testFilename);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('PurpleBooth\RandomLine');
    }

    function it_is_able_to_grab_a_random_line()
    {
        $this->getRandomLine()->shouldHaveOneOfTheValues(array("moon", "match", "march", "monday"));
    }

    public function getMatchers()
    {
        return [
            'haveOneOfTheValues' => function ($subject, $value) {
                return in_array($subject, $value);
            },
        ];
    }

}
