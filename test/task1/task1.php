<?php
//Just testing
require_once 'ResaleCalculator.php';
$n = random_int(2, 1000);
$prices = [];
for($i = 0; $i < $n; $i++)
    $prices[] = random_int(1, 500);

$calculator = new ResaleCalculator();
echo $calculator->calculateLowestLoss($prices)."\n";

$prices = [210, 130, 50, 175, 100];
echo $calculator->calculateLowestLoss($prices)."\n";
