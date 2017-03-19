<?php

namespace spec\PurpleBooth\Settings;

use PhpSpec\ObjectBehavior;

class PageSettingsSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('PurpleBooth\Settings\PageSettings');
    }

    public function it_can_store_type()
    {
        $this->setType('words');
        $this->getType()->shouldReturn('words');
    }

    public function it_can_store_interval()
    {
        $this->setInterval(3500);
        $this->getInterval()->shouldReturn(3500);
    }

    public function it_can_store_reminder()
    {
        $this->setReminder(4);
        $this->getReminder()->shouldReturn(4);
    }

    public function it_can_have_a_default_reminder_of_zero()
    {
        $this->getReminder()->shouldReturn(0);
    }

    public function it_can_store_default_lines_per_api_call()
    {
        $this->setLinesPerApiCall(4);
        $this->getLinesPerApiCall()->shouldReturn(4);
    }
}
