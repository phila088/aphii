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

<div class="tw-pt-4">
    <form wire:submit="updateRole" class="needs-validation" novalidate autocomplete="off">
        <div class="card">
            <div class="card-header">
                <div class="tw-flex tw-justify-between tw-items-center tw-w-full">
                    <h2>Edit permission</h2>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#permission-status-modal">
                        <i class="bi bi-question-circle"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <x-input cols="col-lg-6" id="name" model="name" placeholder="Name" label="Name" />
            </div>
            <div class="card-footer">
                <x-submit-cancel id="role-update" />
            </div>
        </div>
    </form>
</div>
