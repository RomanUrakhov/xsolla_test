<?php
require_once 'Database.php';

$db = new Database();

//Жанр, по которому ведется поиск
$searched_genre = $argv[1];

$games_in_genre = null;
foreach ($db->getReviews() as $key => $value) {
    if (array_search($searched_genre, $value->getGame()->getGenres()) !== false) {
        $games_in_genre[] = [
            "game" => $value->getGame()->getTitle(),
            "rating" => $value->getAssessment()
        ];
    }
}

//Сортировка по столбцу с ключем rating
$rating = array_column($games_in_genre, 'rating');
array_multisort($rating, SORT_DESC, $games_in_genre);

//Получаем три самые высокооцененные игры
$result = array_splice($games_in_genre, 0 , 3);

print_r(array_column($result, 'game'));
return array_column($result, 'game');

