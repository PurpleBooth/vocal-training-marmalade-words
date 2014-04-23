<?php

use PurpleBooth\RandomLine;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$phrasesPath = __DIR__ . "/../data/phrases";
$wordsPath = __DIR__ . "/../data/words";

$app->get('/', function () use ($app) {

    ob_start();
    require __DIR__ . "/../views/index.phtml";

    $output = ob_get_contents();
    ob_end_clean();
    return $output;
});

$app->get('/words', function () use ($app, $wordsPath) {
    $randomLine = new RandomLine($wordsPath);
    $type = "words";
    $interval = 4000;

    ob_start();
    require __DIR__ . "/../views/random.phtml";

    $output = ob_get_contents();
    ob_end_clean();
    return $output;
});

$app->get('/phrases', function () use ($app, $phrasesPath) {
    $randomLine = new RandomLine($phrasesPath);
    $type = "phrases";
    $interval = 8000;

    ob_start();
    require __DIR__ . "/../views/random.phtml";

    $output = ob_get_contents();
    ob_end_clean();
    return $output;
});

$app->run(); 