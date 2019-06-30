<?php
require_once 'Database.php';

$db = new Database();

$played_games = null;
foreach ($db->getReviews() as $key => $value) {
    $played_games[] = [
        "game" => $value->getGame()->getTitle(),
        "genres" => $value->getGame()->getGenres(),
        "rating" => $value->getAssessment()
    ];
}

//Жанр, по которому ведется поиск
$searched_genre = $argv[1];

//Массив отфильтрованных по жанру игр
$games_in_genre = array_filter($played_games, function ($v, $k) use ($searched_genre) {
    $genres = array_column($v['genres'], 'title');
    if (array_intersect(array($searched_genre), $genres))
        return true;
    return false;
}, ARRAY_FILTER_USE_BOTH);

//Сортировка по столбцу с ключем rating
$rating = array_column($games_in_genre, 'rating');
array_multisort($rating, SORT_DESC, $games_in_genre);

//Получаем три самые высокооцененные игры
$result = array_splice($games_in_genre, 0 , 3);

print_r(array_column($result, 'game'));
return array_column($result, 'game');

