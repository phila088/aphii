<?php

use App\Models\Brand;
use App\Models\States;
use App\Models\City;
use App\Models\StatusCode;
use Livewire\WithFileUploads;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

new class extends Component {
    use WithFileUploads;

    public function mount(): void
    {

    }
}; ?>

<div>
    <form wire:submit="store" class="need-validation" novalidate autocomplete="off">
    </form>
</div>
