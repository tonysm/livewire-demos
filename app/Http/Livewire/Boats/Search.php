<?php

namespace App\Http\Livewire\Boats;

use App\Boat;
use Livewire\Component;

class Search extends Component
{
    public string $type = '';
    public array $prices = [];

    public array $allTypes = [];
    public array $allPrices = ['$', '$$', '$$$'];

    public function mount()
    {
        $this->allTypes = Boat::query()
            ->groupBy('type')
            ->distinct()
            ->pluck('type')
            ->all();
    }

    public function render()
    {
        return view('livewire.boats.search', [
            'boats' => Boat::query()
                ->when($this->type, fn ($query, $type) => $query->where('type', $type))
                ->when($this->prices, fn ($query, $prices) => $query->whereIn('price', $prices))
                ->latest()
                ->get(),
        ]);
    }
}
