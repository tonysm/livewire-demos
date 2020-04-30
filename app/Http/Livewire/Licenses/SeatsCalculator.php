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

    public function purchase()
    {
        sleep(4);
        return redirect()->to('/');
    }

    public function render()
    {
        return <<<'blade'
        <div class="w-25 mx-auto">
            <h1 class="text-center">Team License</h1>
            
            <form wire:submit.prevent="purchase">
                <div class="card">
                    <div class="card-body">
                        <p class="text-center">You license is currently for {{ trans_choice('{0} no seats|{1} one seat|[2,*] :count seats', $seats) }}</p>
                        <div class="form-group">
                            <label for="formControlRange" class="sr-only">Licenses</label>
                            <input
                                type="range"
                                name="seats"
                                max="10"
                                min="0"
                                class="form-control-range"
                                id="formControlRange"
                                wire:model="seats"
                            />
                        </div>
                        <h2 class="font-bold text-center">${{ number_format($amount, 2) }}</h2>
                        <div class="form-group">
                            <button
                                class="btn btn-lg btn-block btn-primary"
                                wire:loading.attr="disabled"
                                wire:target="purchase"
                            >
                                Buy licenses!
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        blade;
    }
}
