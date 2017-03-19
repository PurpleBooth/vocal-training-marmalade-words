<?php

require_once __DIR__.'/../vendor/autoload.php';

use PurpleBooth\Controllers\Index as IndexController;
use PurpleBooth\Controllers\RandomLines as RandomLinesController;
use PurpleBooth\RandomWords\MultipleRandomLines;
use PurpleBooth\RandomWords\RandomLine;
use PurpleBooth\Settings\PageSettings;

/*
 * Settings
 */
require __DIR__.'/../config/pages.php';

/*
 * Init app
 */
$app = new Silex\Application();
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.handler' => new Monolog\Handler\SyslogHandler('silex'),
));

/*
 * Index
 */
$app['index.controller'] = $app->share(function () use ($app) {
    return new IndexController();
});
$app->get('/', 'index.controller:indexAction');

foreach ($page as $route => $rawConfig) {
    // Services
    $app["random.{$rawConfig['type']}.config"] = $app->share(function () use ($rawConfig) {
        $config = new PageSettings();
        $config->setType($rawConfig['type']);
        $config->setInterval($rawConfig['interval']);
        $config->setLinesPerApiCall($rawConfig['lines-per-api-call']);

        if (isset($rawConfig['reminder'])) {
            $config->setReminder($rawConfig['reminder']);
        }

        return $config;
    });

    $app["random.{$rawConfig['type']}.single"] = $app->share(function () use ($rawConfig) {
        return new RandomLine($rawConfig['data-path']);
    });

    $app["random.{$rawConfig['type']}.multiple"] = $app->share(function () use ($app, $rawConfig) {
        return new MultipleRandomLines($app["random.{$rawConfig['type']}.single"]);
    });

    $app["random.{$rawConfig['type']}.controller"] = $app->share(function () use ($app, $rawConfig) {
        return new RandomLinesController(
            $app,
            $app["random.{$rawConfig['type']}.config"],
            $app["random.{$rawConfig['type']}.multiple"]
        );
    });

    $app->get($route, "random.{$rawConfig['type']}.controller:indexAction");
    $app->get("$route.json", "random.{$rawConfig['type']}.controller:apiAction");
}

$app->run();
