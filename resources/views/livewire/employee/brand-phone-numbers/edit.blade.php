<?php

use App\Models\BrandPhoneNumber;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component {
    public BrandPhoneNumber $brandPhoneNumber;

    #[Validate('string|required')]
    public string $title = '';
    #[Validate('string|required')]
    public string $number = '';

    public function mount(): void
    {
        $this->title = $this->brandPhoneNumber->title;
        $this->number = $this->brandPhoneNumber->number;
    }

    public function update()
    {
        $this->authorize('brand-phone-numbers.edit');

        $validated = $this->validate();

        if ($this->brandPhoneNumber->update($validated)) {
            $this->dispatch('brand-phone-number-updated');

            $this->title = '';
            $this->number = '';
        }
    }

    public function cancel(): void
    {
        $this->dispatch('brand-phone-number-edit-canceled');
    }
}; ?>

<div class="card">
    <form wire:submit="update" novalidate autocomplete="off">
        <div class="card-header">
            Update phone number
        </div>
        <div class="card-body">
            <div class="row g-2">
                <x-input id="title" model="title" label="Title" />

                <x-input type="tel" id="number" model="number" label="Phone number" />
            </div>
        </div>
        <div class="card-footer">
            <x-submit-cancel />
        </div>
    </form>
</div>
