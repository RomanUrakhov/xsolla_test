<?php
require_once 'Database.php';

$db = new Database();

$games = [];
foreach ($db->getGames() as $game) {
    $games[] = [
        "game" => $game->getTitle(),
        "developer" => $game->getDeveloper()->getName()
    ];
}

//Заданный издатель
$developer = $argv[1];

//Массив игр по заданному издателю
$games_by_developer = array_filter($games, function ($v, $k) use ($developer) {
    if (strcasecmp($v['developer'], $developer) == 0)
        return true;
    return false;
}, ARRAY_FILTER_USE_BOTH);

$exploded_games_titles = [];
foreach ($games_by_developer as $game) {

    $res_game = str_replace(".", "", $game['game']);
    $res_game = str_replace(",", "", $res_game);
    $res_game = str_replace("/", "", $res_game);
    $res_game = str_replace(";", "", $res_game);
    $res_game = str_replace(":", "", $res_game);
    $res_game = str_replace("!", "", $res_game);
    $res_game = str_replace("?", "", $res_game);
    $res_game = trim($res_game);

    $exploded_games_titles[] = explode(" ", $res_game);
}

$series = [];
$checked = [];
for($i = 0; $i < count($exploded_games_titles) - 1; $i++) {
    if (array_search($i, $checked) !== false)
        continue;

    for ($j = $i + 1; $j < count($exploded_games_titles); $j++) {
        $intersection = array_intersect($exploded_games_titles[$i], $exploded_games_titles[$j]);
        if (!empty($intersection)) {
            $checked[] = $j;
            $key = implode(" ", $intersection);
            if (array_key_exists($key, $series)) {
                $series[$key]++;
            } else{
                $series[$key] = 2;
            }
        }
    }
}

$result = [];
foreach ($series as $key=>$value)
    $result[] = [
        "series" => $key,
        "count" => $value
    ];

print_r($result);
return $result;
