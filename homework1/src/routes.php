<?php

use Routing\model\Game;
use Routing\repository\GameRepository;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();
    $gameRepository = new GameRepository($container->get('db'));

    $app->get('/api/games', function (Request $request, Response $response) use ($gameRepository) {
        $response = $response->withHeader('Content-Type', 'application/json');
        try {
            $games = $gameRepository->findAll();
            $response->getBody()->write(json_encode($games));
        } catch (PDOException $exception) {
            echo '{"error": {"text": ' . $exception->getMessage() . '}';
        }
        return $response;
    });


    //Get Game by id
    $app->get('/api/games/{id}', function (Request $request, Response $response) use ($gameRepository) {
        $id = $request->getAttribute('id');
        $response = $response->withHeader('Content-Type', 'application/json');
        try {
            $game = $gameRepository->find($id);
            $response->getBody()->write(json_encode($game));
        } catch (PDOException $exception) {
            echo '{"error": {"text": ' . $exception->getMessage() . '}';
        }
        return $response;
    });


    //Update Game by id
    //JSON example: {"name":"Assassin's Creed Unity","description":"another Ubisoft game...","release_date":"1941-06-22"}
    $app->post('/api/games/update/{id}', function (Request $request, Response $response) use ($gameRepository) {
        $data = $request->getParsedBody();

        $name = $data['name'];
        $description = $data['description'];
        $release = $data['release_date'];

        $updated_game = new Game([
            'id' => $request->getAttribute('id'),
            'name' => $name,
            'description' => $description,
            'release' => $release
        ]);

        $response = $response->withHeader('Content-Type', 'application/json');
        try {
            $gameRepository->update($updated_game);
            $json_string = '{"notice": {"text": "Game has been updated"}}';
            $response->getBody()->write($json_string);
        } catch (PDOException $exception) {
            echo '{"error": {"text": ' . $exception->getMessage() . '}}';
        }
        return $response;
    });


    //Add Game
    //JSON example: {"name":"Assassin's Creed Unity","description":"another Ubisoft game...","release_date":"1941-06-22"}
    $app->post('/api/games/add', function (Request $request, Response $response) use ($gameRepository) {
        $data = $request->getParsedBody();

        $name = $data['name'];
        $description = $data['description'];
        $release = $data['release_date'];

        $response = $response->withHeader('Content-Type', 'application/json');
        try {
            $gameRepository->save(new Game([
                "name" => $name,
                "description" => $description,
                "release" => $release
            ]));
            $json_string = '{"notice": {"text": "Game has been added"}}';
            $response->getBody()->write($json_string);
        } catch (PDOException $exception) {
            echo '{"error": {"text": ' . $exception->getMessage() . '}}';
        }
        return $response;
    });
};