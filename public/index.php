<?php

use App\Application;
use App\Repository\FlightRepository;
use App\Transformer\DecisionStringTransformer;

require __DIR__ . '/../vendor/autoload.php';

$app = new Application(
    new DecisionStringTransformer(),
    new FlightRepository('./assets/flights.csv')
);

$app->run();