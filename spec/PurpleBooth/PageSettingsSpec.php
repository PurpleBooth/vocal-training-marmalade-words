<?php

namespace spec\PurpleBooth;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PageSettingsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('PurpleBooth\PageSettings');
    }

    function it_can_store_type()
    {
        $this->setType("words");
        $this->getType()->shouldReturn("words");
    }

    function it_can_store_interval()
    {
        $this->setInterval(3500);
        $this->getInterval()->shouldReturn(3500);
    }

    function it_can_store_reminder()
    {
        $this->setReminder(4);
        $this->getReminder()->shouldReturn(4);
    }

    function it_can_have_a_default_reminder_of_zero()
    {
        $this->getReminder()->shouldReturn(0);
    }
}
