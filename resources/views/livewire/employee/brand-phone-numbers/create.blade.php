<?php

use App\Models\Brand;
use App\Models\BrandEmail;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

new class extends Component {
    public $brand;

    #[Validate('string|required|min:2|max:50')]
    public string $title = '';
    #[Validate('string|required')]
    public string $number = '';
    #[Validate('int|required')]
    public int $brand_id;

    public function mount(): void
    {
        $this->brand_id = $this->brand->id;
    }

    public function store(): void
    {
        $this->authorize('brand-phone-numbers.create');

        $validated = $this->validate();

        if (auth()->user()->brandPhoneNumber()->create($validated)) {
            $this->title = '';
            $this->number = '';

            $this->dispatch('brand-phone-number-created');
        }
    }
}; ?>

<div>
    <form wire:submit="store" class="needs-validate" novalidate autocomplete="off">
        <div class="card custom-card">
            <div class="card-header">
                <h1>Create phone number</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <x-input id="title" model="title" label="Title" />

                    <x-input type="tel" id="number" model="number" label="Phone number" x-mask="999-999-9999" />
                </div>
            </div>
            <div class="card-footer">
                <x-submit id="brand-phone-number-create" />
            </div>
        </div>
    </form>
</div>
