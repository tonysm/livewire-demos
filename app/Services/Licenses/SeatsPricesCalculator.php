<?php

namespace App\Services\Licenses;

class SeatsPricesCalculator
{
    public function calculate(int $seats): int
    {
        if ($seats <= 5) {
            return $seats * 20;
        }

        return 100 + ($seats - 5) * 15;
    }
}
