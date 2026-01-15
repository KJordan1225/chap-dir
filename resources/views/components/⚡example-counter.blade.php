<?php

namespace App\Livewire;

use Livewire\Component;

class ExampleCounter extends Component
{
    public int $count = 0;

    public function increment(): void
    {
        $this->count++;
    }

    public function render()
    {
        return view('livewire.example-counter');
    }
};
?>


<div class="card">
    <div class="card-body text-center">
        <h5 class="card-title mb-3">Livewire Counter</h5>
        <p class="display-6 mb-3">{{ $count }}</p>
        <button wire:click="increment" class="btn btn-primary">
            Increment
        </button>
    </div>
</div>