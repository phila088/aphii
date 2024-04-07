<?php

use App\Models\ContactTitle;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component {
    public ContactTitle $contactTitle;

    #[Validate('required|string|min:2|max:50')]
    public string $name = '';

    public function mount(): void
    {
        $this->name = $this->contactTitle->name;
    }

    public function update(): void
    {
        $this->authorize('contact-titles.edit');

        $validated = $this->validate();

        if ($this->contactTitle->update($validated)) {

            $this->dispatch('contact-title-updated');
        }
    }

    public function cancel(): void
    {
        $this->dispatch('contact-title-edit-canceled');
    }
}; ?>

<div>
    <form wire:submit="update" novalidate autocomplete="off">
        <div class="card">
            <div class="card-header">
                <h2>Edit contact title</h2>
            </div>
            <div class="card-body">
                <x-input cols="col-12" id="name" model="name" label="Name" />
            </div>
            <div class="card-footer">
                <x-submit-cancel id="contact-title-update" />
            </div>
        </div>
    </form>
</div>
