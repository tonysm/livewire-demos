<?php

namespace App\Services\Sales;

class Stats
{
    public function newOrdersCount(): int
    {
        return rand(0, 100);
    }

    public function salesAmount(): float
    {
        return rand(0, 1000);
    }

    public function satisfactionPercentage(): int
    {
        return rand(33, 100);
    }
}
