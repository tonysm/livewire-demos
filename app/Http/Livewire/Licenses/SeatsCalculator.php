<?php

namespace App\Http\Livewire\Licenses;

use Facades\App\Services\Licenses\SeatsPricesCalculator;
use Livewire\Component;

class SeatsCalculator extends Component
{
    public int $seats;
    public int $amount;

    public function mount()
    {
        $this->seats = 2;
        $this->amount = SeatsPricesCalculator::calculate($this->seats);
    }

    public function updatedSeats()
    {
        $this->amount = SeatsPricesCalculator::calculate($this->seats);
    }

    public function render()
    {
        return <<<'blade'
        <div class="w-25 mx-auto">
            <h1 class="text-center">Team License</h1>
            
            <div class="card">
                <div class="card-body">
                    <p class="text-center">You license is currently for {{ trans_choice('{0} no seats|{1} one seat|[2,*] :count seats', $seats) }}</p>
                    <div class="form-group">
                        <label for="formControlRange" class="sr-only">Licenses</label>
                        <input
                            type="range"
                            max="100"
                            min="0"
                            class="form-control-range"
                            id="formControlRange"
                            wire:model="seats"
                        />
                    </div>
                    <h2 class="font-bold text-center">${{ number_format($amount, 2) }}</h2>
                </div>
            </div>
        </div>
        blade;
    }
}
