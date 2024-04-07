<?php

use App\Models\ContactTitle;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component {

    #[Validate('required|string|min:2|max:50')]
    public string $name = '';

    public function mount(): void
    {

    }

    public function store(): void
    {
        $this->authorize('contact-title.create');

        $validated = $this->validate();

        if (auth()->user()->contactTitle()->create($validated)) {
            $this->dispatch('contact-title-created');

            $this->name = '';
        }
    }
}; ?>

<div>
    <form wire:submit="store" novalidate autocomplete="off">
        <div class="card custom-card">
            <div class="card-header">
                <h2>Create contact title</h2>
            </div>
            <div class="card-body">
                <x-input cols="col-12" id="name" model="name" label="Name" />
            </div>
            <div class="card-footer">
                <x-submit id="contact-title-create" />
            </div>
        </div>
    </form>
</div>
