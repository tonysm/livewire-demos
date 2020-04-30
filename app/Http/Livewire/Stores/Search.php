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
    }

    public function render()
    {
        return <<<'blade'
        <div class="container">
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

            <x-growing-spinner
                class="d-none"
                wire:loading.class.remove="d-none"
                wire:target="search"
            />

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
