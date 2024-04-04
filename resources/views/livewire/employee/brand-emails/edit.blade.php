<?php

use App\Models\BrandEmail;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component {
    public BrandEmail $brandEmail;

    #[Validate('string|required')]
    public string $title = '';
    #[Validate('email:frc,filter,spoof,dns|required')]
    public string $email = '';

    public function mount(): void
    {
        $this->title = $this->brandEmail->title;
        $this->email = $this->brandEmail->email;
    }

    public function updateEmail()
    {
        $this->authorize('brandemails.edit');

        $validated = $this->validate();

        if ($this->brandEmail->update($validated)) {
            $this->dispatch('brand-email-updated');

            $this->title = '';
            $this->email = '';
        }
    }

    public function cancel(): void
    {
        $this->dispatch('brand-email-edit-canceled');
    }
}; ?>

<div class="card">
    <form wire:submit="updateEmail" novalidate autocomplete="off">
        <div class="card-header">
            Update email
        </div>
        <div class="card-body">
            <div class="row g-2">
                <x-input cols="col-lg-3" id="title" model="title" label="Title" />

                <x-input cols="col-lg-3" type="email" id="email" model="email" label="Email" />
            </div>
        </div>
        <div class="card-footer">
            <x-submit-cancel />
        </div>
    </form>
</div>
