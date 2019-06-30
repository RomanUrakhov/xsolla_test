<?php
//Вычисление индекса водящего
function counting($n, $m): int {
	if ($n == 1)
		return 1;
	return 1 + (counting($n-1, $m) + $m -1) % $n;
}

//На вход также JSON
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str);

header('Content-type: application/json');

$children = $json_obj->children;
$countOfWords = $json_obj->count;

//Имя водящего
$seeker = $children[counting(count($children), $countOfWords) - 1];

$result = array("name" => $seeker);

echo json_encode($result, JSON_UNESCAPED_UNICODE);
return json_encode($result, JSON_UNESCAPED_UNICODE);
