<?php

$page = array(
    '/words' => array(
        'data-path' => __DIR__ . "/../data/words",
        'type' => "words",
        'interval' => 3500,
        'reminder' => 4,
        'lines-per-api-call' => 345,
    ),
    '/phrases' => array(
        'data-path' => __DIR__ . "/../data/phrases",
        'type' => "phrases",
        'interval' => 7000,
        'lines-per-api-call' => 175,
    ),
);