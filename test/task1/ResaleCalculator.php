<?php

class ResaleCalculator
{
    public function calculateLowestLoss(array $prices): int
    {
        $minLoss = max($prices);
        for ($i = 0; $i < count($prices) - 1; $i++) {
            for ($j = $i + 1; $j < count($prices); $j++) {
                if ($prices[$i] - $prices[$j] > 0 and $prices[$i] - $prices[$j] < $minLoss)
                    $minLoss = $prices[$i] - $prices[$j];
            }
        }
        return $minLoss;
    }
}