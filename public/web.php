<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PurpleBooth\PageSettings;
use PurpleBooth\RandomLine;
use Symfony\Component\Debug\ErrorHandler;

/*
 * Settings
 */
require __DIR__ . "/../config/pages.php";

/*
 * Turn on exception based errors
 */
ErrorHandler::register();

/*
 * Init app
 */
$app = new Silex\Application();

/*
 * Index
 */
$app->get('/', function () use ($app) {

    ob_start();
    require __DIR__ . "/../views/index.phtml";

    $output = ob_get_contents();
    ob_end_clean();
    return $output;
});

foreach($page as $route => $rawConfig) {
    $app->get($route, function () use ($app, $rawConfig) {
        $randomLine = new RandomLine($rawConfig['data-path']);
        $config = new PageSettings();
        $config->setType($rawConfig['type']);
        $config->setInterval($rawConfig['interval']);

        if(isset($rawConfig['reminder'])) {
            $config->setReminder($rawConfig['reminder']);
        }


        ob_start();
        require __DIR__ . "/../views/random.phtml";

        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    });
}

$app->run(); 