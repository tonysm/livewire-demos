<?php

namespace App\Http\Livewire\Boats;

use App\Boat;
use Livewire\Component;

class Search extends Component
{
    public string $type = '';
    public array $prices = [];

    protected $updatesQueryString = ['type', 'prices'];

    public array $allTypes = [];
    public array $allPrices = ['$', '$$', '$$$'];

    public function mount()
    {
        $this->allTypes = Boat::query()
            ->groupBy('type')
            ->distinct()
            ->pluck('type')
            ->all();

        $this->prices = collect(request('prices', []))->filter(fn ($price) => in_array($price, $this->allPrices))->values()->all();
        $this->type = in_array(request('type'), $this->allTypes) ? request('type') : '';
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

    public function togglePrice(string $priceOption)
    {
        if (in_array($priceOption, $this->prices)) {
            $this->prices = collect($this->prices)->filter(fn (string $price) => $price !== $priceOption)->all();
        } else {
            $this->prices[] = $priceOption;
        }
    }
}
