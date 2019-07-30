<?php
require_once 'DbHandler.php';

$db = new DbHandler();

$top_three_games = $db->query("SELECT game.title, review.assessment FROM varietyOfGenres 
INNER JOIN game ON varietyOfGenres.id_game = game.id 
INNER JOIN review ON game.id = review.id_game
INNER JOIN genre ON varietyOfGenres.id_genre = genre.id
WHERE genre.name = '".$argv[1]."' ORDER BY review.assessment DESC LIMIT 3");

return $top_three_games;