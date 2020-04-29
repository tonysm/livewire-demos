<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Lights extends Component
{
    public int $progress = 10;
    public bool $partyMode = true;

    public function changeProgress(int $progress)
    {
        $this->progress = max(min($progress, 100), 0);
    }

    public function toggleParty()
    {
        $this->partyMode = !$this->partyMode;

        if ($this->partyMode) {
            $this->party();
        }
    }

    public function party()
    {
        $this->changeProgress(rand(0, 100));
    }

    public function render()
    {
        return <<<'blade'
        <div class="container text-center">
            <h1>Hello Lights Example</h1>
            <div class="w-100 progress" @if($partyMode) wire:poll="party" @endif>
                <div
                    class="progress-bar"
                    role="progressbar"
                    style="width: {{ $progress }}%"
                    aria-valuenow="{{ $progress}}"
                    aria-valuemin="0"
                    aria-valuemax="100"
                >
                    {{ $progress }}%
                </div>
            </div>
            <div class="mt-2">
                <button wire:click="changeProgress(100)" class="btn btn-primary">On</button>
                <button wire:click="changeProgress({{ $progress + 10}})" class="btn btn-primary">Up</button>
                <button wire:click="changeProgress({{ $progress - 10}})" class="btn btn-primary">Down</button>
                <button wire:click="changeProgress(0)" class="btn btn-primary">Off</button>
                <button wire:click="toggleParty" class="btn btn-primary">Party ({{ $partyMode ? 'On' : 'Off' }})</button>
            </div>
        </div>
        blade;
    }
}
