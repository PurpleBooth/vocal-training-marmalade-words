<?php

namespace spec\PurpleBooth\RandomWords;

use PhpSpec\ObjectBehavior;

class RandomLineSpec extends ObjectBehavior
{
    private $testFilename = '/tmp/testing';

    public function let()
    {
        file_put_contents($this->testFilename, "moon\nmatch\nmarch\nmonday\n\n");
        $this->beConstructedWith($this->testFilename);
    }

    public function letgo()
    {
        unlink($this->testFilename);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('PurpleBooth\RandomWords\RandomLine');
    }

    public function it_is_able_to_grab_a_random_line()
    {
        $this->getRandomLine()->shouldHaveOneOfTheValues(['moon', 'match', 'march', 'monday']);
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
