<?php

namespace PurpleBooth\Controllers;

use PurpleBooth\RandomWords\MultipleRandomLines;
use PurpleBooth\Settings\PageSettings;
use Silex\Application as SilexApp;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controller that represents different types of random words slide shows
 *
 * @package PurpleBooth\Controllers
 */
class RandomLines
{
    /**
     * @var \PurpleBooth\RandomWords\MultipleRandomLines
     */
    private $randomLines;

    /**
     * @var \PurpleBooth\Settings\PageSettings
     */
    private $config;

    /**
     * @var \Silex\Application
     */
    private $app;

    /**
     * @param SilexApp $app
     * @param PageSettings $config
     * @param MultipleRandomLines $randomLines
     */
    public function __construct(SilexApp $app, PageSettings $config, MultipleRandomLines $randomLines)
    {
        $this->randomLines = $randomLines;
        $this->config = $config;
        $this->app = $app;
    }

    /**
     * Get the index
     *
     * @return string
     */
    public function indexAction()
    {
        ob_start();
        require __DIR__ . "/../../../views/random.phtml";

        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    /**
     * @return JsonResponse
     */
    public function apiAction()
    {
        return new JsonResponse(
            $this->randomLines->getLines(
                $this->config->getLinesPerApiCall()
            )
        );
    }
}
