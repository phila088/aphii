<?php

use App\Models\PotentialClient;
use Livewire\Volt\Component;

new class extends Component {
    public $potentialClient;

    public function mount(): void
    {
    }
}; ?>

<div>
    <div class="row g-2">
        <x-custom.input id="test" model="test" label="test" />
        <x-custom.select id="test2" model="test2" label="test2"></x-custom.select>
    </div>
</div>
