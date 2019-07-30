<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Routing\DbHandler;

require '../../vendor/autoload.php';

$container = require '../dependencies.php';
$app = new \Slim\App($container);


$app->get('/api/games', function (Request $request, Response $response) {
    $sql = "SELECT * FROM game";

    $response = $response->withHeader('Content-Type', 'application/json');
    try {
        $db = new DbHandler($this->db);
        $games = $db->query($sql);
        $response->getBody()->write(json_encode($games));
    } catch (PDOException $exception) {
        echo '{"error": {"text": ' . $exception->getMessage() . '}';
    }
    return $response;
});


//Get Game by id
$app->get('/api/game/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM game WHERE id=$id";
    $response = $response->withHeader('Content-Type', 'application/json');
    try {
        $db = new DbHandler($this->db);
        $game = $db->query($sql);
        $response->getBody()->write(json_encode($game[0]));
    } catch (PDOException $exception) {
        echo '{"error": {"text": ' . $exception->getMessage() . '}';
    }
    return $response;
});


//Update Game by id
//JSON example: {"name":"Assassin's Creed Unity","description":"another Ubisoft game...","release_date":"1941-06-22"}
$app->post('/api/game/update/{id}', function (Request $request, Response $response) {
    $data = $request->getParsedBody();

    $id = $request->getAttribute('id');
    $name = $data['name'];
    $description = $data['description'];
    $release = $data['release_date'];

    $sql = "UPDATE game SET name='$name',description='$description',release_date='$release' WHERE id=$id";
    $response = $response->withHeader('Content-Type', 'application/json');
    try {
        $db = new DbHandler($this->db);
        $db->execute($sql);
        $json_string = '{"notice": {"text": "Game has been updated"}}';
        $response->getBody()->write($json_string);
    } catch (PDOException $exception) {
        echo '{"error": {"text": ' . $exception->getMessage() . '}}';
    }
    return $response;
});


//Add Game
//JSON example: {"name":"Assassin's Creed Unity","description":"another Ubisoft game...","release_date":"1941-06-22"}
$app->post('/api/game/add', function (Request $request, Response $response) {
    $data = $request->getParsedBody();

    $name = $data['name'];
    $description = $data['description'];
    $release = $data['release_date'];

    $sql = "INSERT INTO game (name,description,release_date) VALUES ('$name','$description','$release')";

    $response = $response->withHeader('Content-Type', 'application/json');
    try {
        $db = new DbHandler($this->db);
        $db->execute($sql);
        $json_string = '{"notice": {"text": "Game has been added"}}';
        $response->getBody()->write($json_string);
    } catch (PDOException $exception) {
        echo '{"error": {"text": ' . $exception->getMessage() . '}}';
    }
    return $response;
});

$app->run();