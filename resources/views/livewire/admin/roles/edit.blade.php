<?php

use Spatie\Permission\Models\Role;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component {
    public Role $role;

    #[Validate('required|string')]
    public string $name = '';

    public function mount(): void
    {
        $this->name = $this->role->name;
    }

    public function updateRole(): void
    {
        $validated = $this->validate();

        if ($this->role->update($validated)) {
            $this->dispatch('role-updated');
        }
    }

    public function cancel(): void
    {
        $this->dispatch('role-edit-canceled');
    }
}; ?>

<div>
    <form wire:submit="updateRole" class="needs-validation" novalidate autocomplete="off">
        <div class="row g-2">
            <dl>
                <dt class="tw-text-lg">Role</dt>
                <dt>Name</dt>
                <dl>
                    This is the name of the permission. Keep it short and simple
                </dl>
            </dl>


            <x-input id="name" model="name" placeholder="Name" label="Name" />
        </div>

        <x-submit-cancel id="role-update" />
    </form>
</div>
