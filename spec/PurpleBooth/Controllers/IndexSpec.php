<?php

namespace spec\PurpleBooth\Controllers;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IndexSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('PurpleBooth\Controllers\Index');
    }

    function it_has_index_action_that_returns_the_page()
    {
        $this->indexAction()->shouldBeString();
    }
}
