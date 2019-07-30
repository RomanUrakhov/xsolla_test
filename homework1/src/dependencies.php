<?php

$settings = require 'settings.php';
$container = new \Slim\Container($settings);


$container['db'] = function ($container) {
    $cfg = $container->get('settings')['db'];
    $pdo = new PDO('mysql: host=' . $cfg['host'] . ';dbname=' . $cfg['dbname'],
        $cfg['user'], $cfg['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

return $container;