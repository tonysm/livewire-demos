<?php

namespace App\Http\Livewire\Sales;

use Facades\App\Services\Sales\Stats;
use Livewire\Component;

class Dashboard extends Component
{
    public ?int $newOrders = null;
    public ?int $salesAmount = null;
    public ?int $satisfaction = null;

    public function tick()
    {
        $this->refreshStats();
    }

    public function refresh()
    {
        $this->refreshStats();
    }

    private function refreshStats()
    {
        $this->newOrders = Stats::newOrdersCount();
        $this->salesAmount = Stats::salesAmount();
        $this->satisfaction = Stats::satisfactionPercentage();
    }

    public function render()
    {
        return <<<'blade'
        <div class="container">
            <div class="card" wire:poll="tick">
                <div class="d-flex flex-col justify-content-between text-center">
                    <div class="m-4">
                        @if(is_null($newOrders))
                            <x-growing-spinner />
                        @else
                            <h3>{{ $newOrders }}</h3>
                        @endif
                        <p>New Orders</p>
                    </div>
                    <div class="m-4">
                        @if(is_null($salesAmount))
                            <x-growing-spinner />
                        @else
                            <h3>${{ number_format($salesAmount, 0) }}</h3>
                        @endif
                        <p>Sales Amount</p>
                    </div>
                    <div class="m-4">
                        @if(is_null($satisfaction))
                            <x-growing-spinner />
                        @else
                            <h3>{{ $satisfaction }}%</h3>
                        @endif
                        <p>Satisfaction</p>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button wire:click="refresh" class="mt-2 btn btn-primary">Refresh</button>
            </div>
        </div>
        blade;
    }
}
