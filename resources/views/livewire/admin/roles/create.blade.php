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

<div>
    <form wire:submit="createRole" class="needs-validation" novalidate autocomplete="off">
        <div class="row g-2">
            <dl>
                <dt class="tw-text-lg">Role</dt>
                <dt>Name</dt>
                <dl>
                    This is the name of the role. Keep it short and simple
                </dl>
            </dl>

            <x-input id="name" model="name" placeholder="Name" label="Name" />
        </div>

        <x-submit id="role-create" />
    </form>


    <script>

    </script>
</div>
