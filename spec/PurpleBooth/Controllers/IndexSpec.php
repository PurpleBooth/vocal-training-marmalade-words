<?php

namespace spec\PurpleBooth\Controllers;

use PhpSpec\ObjectBehavior;

class IndexSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('PurpleBooth\Controllers\Index');
    }

    public function it_has_index_action_that_returns_the_page()
    {
        $this->indexAction()->shouldBeString();
    }
}
