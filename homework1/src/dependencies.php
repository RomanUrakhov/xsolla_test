<?php

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    //database
    $container['db'] = function ($c) {
        $cfg = $c->get('settings')['db'];
        $pdo = new PDO('mysql: host=' . $cfg['host'] . ';dbname=' . $cfg['dbname'],
            $cfg['user'], $cfg['pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    };
};