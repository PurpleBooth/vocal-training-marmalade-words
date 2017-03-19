<?php

namespace spec\PurpleBooth\Controllers;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RandomLinesSpec extends ObjectBehavior
{
    private $multipleLinesMock;
    private $configMock;

    public function let($config, $multipleRandomLines, $app)
    {
        $app->beADoubleOf('Silex\Application');
        $app->escape(Argument::type('string'))->willReturn('Escaped Value');
        $app->escape(Argument::type('int'))->willReturn('Escaped Value');

        $config->beADoubleOf('PurpleBooth\Settings\PageSettings');
        $config->getType()->willReturn('phrase');
        $config->getInterval()->willReturn(1000);
        $config->getReminder()->willReturn(4);
        $this->configMock = $config;

        $multipleRandomLines->beADoubleOf('PurpleBooth\RandomWords\MultipleRandomLines');
        $this->multipleLinesMock = $multipleRandomLines;

        $this->beConstructedWith($app, $config, $multipleRandomLines);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('PurpleBooth\Controllers\RandomLines');
    }

    public function it_has_index_action_that_returns_the_page()
    {
        $this->multipleLinesMock->getLine()->willReturn('Marmite');

        $this->indexAction()->shouldBeString();
    }

    public function it_has_api_action_that_returns_json()
    {
        $this->configMock->getLinesPerApiCall()->willReturn(2);
        $this->multipleLinesMock->getLines(2)->willReturn(['Marmite', 'Marmalade']);

        $this->apiAction()->shouldReturnAnInstanceOf('Symfony\Component\HttpFoundation\JsonResponse');
    }
}
