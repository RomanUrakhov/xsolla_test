<?php

require_once 'Database.php';

$db = new Database();
$games = $db->getGames();

$not_played_games = array_diff($games, $db->getGamesInReview());

$result = null;
foreach ($not_played_games as $key => $value) {
    $result[] = [
        "title" => $value->getTitle(),
        "release" => $value->getReleaseDate()
    ];
}

print_r($result);
return $result;


