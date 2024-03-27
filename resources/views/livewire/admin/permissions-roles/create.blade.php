<?php

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Illuminate\Support\Collection;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

new class extends Component {
    public $roles;
    public $permissions;

    public Collection $models;

    public string $model = '';
    public string $action = '';
    public string $search = '%';

    #[Validate('required|int')]
    public ?int $role;
    #[Validate('required|int')]
    public ?int $permission;

    public function mount(): void
    {
        $this->getRoles();
        $this->getPermissions();
        $this->models = $this->getModels();
    }

    public function createRolePermission(): void
    {
        $validated = $this->validate();

        $role = Role::findById($this->role);

        $permission = Permission::findById($this->permission);

        $permission->assignRole($role);

        if ($role->hasPermissionTo($permission)) {
            $this->permission = null;

            $this->dispatch('roles-permission-created');
        }
    }

    #[On('role-created')]
    public function getRoles(): void
    {
        $this->roles = Role::orderBy('name')
            ->get();
    }

    #[On('permission-created')]
    public function getPermissions(): void
    {
        $this->permissions = Permission::orderBy('name')
            ->get();
    }

    function getModels(): Collection
    {
        $models = collect(File::allFiles(app_path()))
            ->map(function ($item) {
                $path = $item->getRelativePathName();
                $class = sprintf('\%s%s',
                    Container::getInstance()->getNamespace(),
                    strtr(substr($path, 0, strrpos($path, '.')), '/', '\\'));
                return $class;
            })
            ->filter(function ($class) {
                $valid = false;

                if (class_exists($class)) {
                    $reflection = new \ReflectionClass($class);
                    $valid = $reflection->isSubclassOf(Model::class) &&
                        !$reflection->isAbstract();
                }

                return $valid;
            });

        foreach ($models as $k => $v) {
            $models[$k] = substr($v, strrpos($v, '\\') + 1);
        }

        return $models->values();
    }

    public function makeSearchString()
    {
        $this->search = $this->makePattern([Str::plural($this->model), $this->action]);
        $this->dispatch('filter-changed');
    }

    private function makePattern($patterns = [])
    {
        $pattern = "";
        foreach($patterns as $value){
            $pattern .= (!empty($value) ? $value : '%') . '.';
        }
        return substr($pattern, 0, -1);
    }

    #[On('filter-changed')]
    public function filterPermissions(): void
    {
        $this->permissions = Permission::where('name', 'like', $this->search)
            ->orderBy('name')
            ->get();
    }
};

?>
<div class="tw-shadow-md tw-rounded-lg tw-p-4">
    <form wire:submit="createRolePermission" class="needs-validation" novalidate autocomplete="off">
        <div class="row g-2">
            <dl>
                <dt class="tw-text-lg">Manage Role Permissions:</dt>

                <dt>Role</dt>
                <dd>Select the role to which you are looking to attach specific permissions.</dd>

                <dt>User Type, Model and Action</dt>
                <dd>Select the user type, model, and the action to filter the permission list, thereby making the permission search more streamlined and faster.</dd>

                <dt>Permission</dt>
                <dd>Select the permission that you would like to tie to the chosen role.</dd>
            </dl>
            <x-select id="role" model="role" label="Role">
                <option></option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </x-select>

            <x-select id="model" model="model" label="Model" x-on:change="$wire.makeSearchString;">
                <option></option>
                @foreach ($models as $model)
                    <option value="{{ strtolower($model) }}">{{ $model }}</option>
                @endforeach
            </x-select>

            <x-select id="action" model="action" label="Action" x-on:change="$wire.makeSearchString;">
                <option></option>
                <option value="*">*</option>
                <option value="create">Create</option>
                <option value="delete">Delete</option>
                <option value="edit">Edit</option>
                <option value="viewany">View Any</option>
                <option value="viewone">View One</option>
                <option value="report">Report</option>
            </x-select>

            <x-select cols="col-lg-3" id="permission" model="permission" label="Permission">
                <option></option>
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                @endforeach
            </x-select>
        </div>
        <x-submit id="role-permission-create" />
    </form>
</div>
