<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Routing\DbHandler;
use Slim\App;

require __DIR__ . '/../vendor/autoload.php';

$settings = require __DIR__ . '/../src/settings.php';
$app = new App($settings);

$dependencies = require __DIR__ . '/../src/dependencies.php';
$dependencies($app);

$routes = require __DIR__ . '/../src/routes.php';
$routes($app);

$app->run();