<?php

namespace App\Http\Livewire\Boats;

use App\Boat;
use Livewire\Component;

class Search extends Component
{
    public function render()
    {
        return view('livewire.boats.search', [
            'boats' => Boat::query()
                ->latest()
                ->get(),
        ]);
    }
}
