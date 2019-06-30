<?php
require_once 'DbHandler.php';

$db = new DbHandler();

$not_played_games = $db->query("SELECT title, releaseDate FROM game WHERE id NOT IN (SELECT id_game FROM review)");

return $not_played_games;

