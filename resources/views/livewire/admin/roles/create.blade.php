<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Spatie\Permission\Models\Role;

new class extends Component {
    #[Validate('required|string')]
    public string $name;

    public function createRole()
    {
        $validated = $this->validate();

        if (Role::create($validated)) {
            $this->dispatch('role-created');

            $this->name = '';
        }
    }
}; ?>

<div class="col-lg-4">
    <form wire:submit="createRole" class="needs-validation" novalidate autocomplete="off">
        <div class="card custom-card">
            <div class="card-header">
                <div class="tw-flex tw-justify-between tw-items-center tw-w-full">
                    <h2>Create a role</h2>
                </div>
            </div>
            <div class="card-body">
                <x-input cols="col-lg-12" id="name" model="name" placeholder="Name" label="Name" />
            </div>
            <div class="card-footer">
                <x-submit id="role-create" />
            </div>
        </div>
    </form>
</div>
