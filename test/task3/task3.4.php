<?php
require_once 'Database.php';

//РАБОТАЕТ ПРИ УСЛОВИИ, ЧТО НАЗВАНИЕ ИГРЫ НАЧИНАЕТСЯ НЕ С ЧИСЛА, А ТАКЖЕ
//КАКАЯ-ТО ЕЕ ЧАСТЬ ОТДЕЛЕНА ЛИБО ЦИФРОЙ, ЛИБО ДВОЕТОЧИЕМ:
// "Far Cry 3" или "Far Cry: Primal" -- норм
// "2048 some_game_part" или "Far Cry Primal -- не норм :`(
//што я тут написал..........

$db = new Database();

//Заданный издатель
$developer = $argv[1];

$games = [];
foreach ($db->getGames() as $game) {
    if (strcmp($developer, $game->getDeveloper()->getName()) == 0) {
        $games[] = $game->getTitle();
    }
}

array_multisort(array_map('strlen', $games), $games);

foreach ($games as $key => $game) {
    preg_match('/^[^\d+:]*/', $game, $matches);
    $series = trim($matches[0]);
    $games[$key] = $series;
}

print_r($games);

$series = array_count_values($games);

$result = [];
foreach ($series as $key => $value) {
    $result[] = [
        "series" => $key,
        "count" => $value
    ];
}

print_r($result);
return $result;






