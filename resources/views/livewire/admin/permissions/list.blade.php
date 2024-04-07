<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission;

new class extends Component {
    public $permissions;

    public ?Permission $editing = null;

    public string $search;

    public function mount(): void
    {
        $this->getPermissions();
    }

    #[On('user-created')]
    #[On('user-updated')]
    #[On('permission-created')]
    public function getPermissions(): void
    {
        $this->search = '';

        $this->permissions = Permission::orderBy('name')
            ->get();
    }

    public function edit(Permission $permission): void
    {
        $this->editing = $permission;

        $this->getPermissions();
    }

    #[On('permission-edit-canceled')]
    #[On('permission-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getPermissions();
    }

    public function delete(Permission $permission): void
    {
        $permission->delete();

        $this->getPermissions();
    }

    public function searchResults(string $partial)
    {
        if (!empty($partial)) {
            $this->permissions = Permission::where('name', 'like', '%' . $partial . '%')
                ->get();
        } else {
            $this->getPermissions();
        }
    }
}; ?>

<div class="col-lg-8">
    <div class="card custom-card">
        <div class="card-header">
            <div class="tw-flex tw-justify-between tw-items-center w-100">
                <h1>All permissions</h1>
                <x-model-search id="permissions-search" model="searchTerm" />
            </div>
        </div>
        <div class="card-body">
            @can ('permissions.viewAny')
                <ul class="list-group">
                    @empty($permissions[0])
                        <x-no-data />
                    @else
                        @foreach ($permissions as $permission)
                            <li class="list-group-item">
                                {{ $permission->name }}
                            </li>
                        @endforeach
                    @endempty
                </ul>
            @else
                <x-not-auth />
            @endcan
        </div>
    </div>
</div>
