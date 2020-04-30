<?php

namespace App\Http\Livewire\Stores;

use Facades\App\Services\Stores\Repository as Stores;
use Livewire\Component;

class Search extends Component
{
    public string $zip = '';
    public array $stores = [];

    public function search()
    {
        $this->stores = Stores::searchByZip($this->zip)->all();

        if (empty($this->stores)) {
            $this->emit('addAlertMessage', [
                'detail' => 'We could not find any store in the provided zip',
            ]);
        }
    }

    public function render()
    {
        return <<<'blade'
        <div class="container">
            <h1>Stores Search</h1>
            <form wire:submit.prevent="search">
                <div class="form-group">
                    <input
                        placeholder="Search by zip"
                        type="text"
                        class="form-control"
                        wire:model.lazy="zip"
                    />
                </div>
            </form>

            <div
                class="d-none text-center"
                wire:loading.class.remove="d-none"
                wire:target="search"
            >
                <x-growing-spinner/>
            </div>

            @foreach ($stores as $store)
                <div class="card w-full">
                    <div class="card-body">
                        <h5 class="card-title">{{ $store['name'] }}</h5>
                        <p class="card-text">{{ $store['address'] }} - {{ $store['zip'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        blade;
    }
}
