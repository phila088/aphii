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

    public $values = [];
    public $actions = [];
    public bool $no_permissions = false;

    public function mount(): void
    {
        $this->getRoles();
        $this->getPermissions();
        $this->models = $this->getModels();

        $this->actions = (__('selects.actions'));

        $this->getRolePermissions();
    }

    public function createRolePermission(): void
    {
        $this->authorize('rolepermission.create');

        foreach ($this->values as $kp => $vp) {
            $role = $kp;
            $obj = Role::select('id')->where('name', '=', $kp)->limit(1)->get();
            $roleId = $obj[0]->id;

            foreach ($vp as $kc => $vc) {
                $model = $kc;

                foreach ($vc as $kgc => $vgc) {
                    $action = $kgc;

                    $objGc = Permission::select('id')->where('name', '=', Str::camel($model) . '.' . $action)->limit(1)->get();
                    $permId = $objGc[0]->id;

                    if ($vgc) {
                        DB::table('role_has_permissions')->insertOrIgnore(['permission_id' => $permId, 'role_id' => $roleId]);
                    } else {
                        if (DB::table('role_has_permissions')->where('role_id', $roleId)->where('permission_id', $permId)->exists()) {
                            DB::table('role_has_permissions')->where('role_id', $roleId)->where('permission_id', $permId)->delete();
                        }
                    }
                }
            }
        }

        $this->dispatch('roles-permission-created');
    }

    #[On('roles-permission-created')]
    #[On('permission-created')]
    #[On('role-created')]
    public function getRolePermissions(): void
    {
        foreach ($this->roles as $role) {
            $roleName = $role->name;

            $roleId = $role->id;

            foreach ($this->models as $model) {
                $modelName = $model;

                $modelAsPermission = Str::camel($model);

                foreach ($this->actions as $action) {
                    $permission = $modelAsPermission . '.' . $action;

                    $obj = Permission::select('id')->where('name', '=', $permission)->limit(1)->get();
                    if (!empty($obj[0])) {
                        $permissionId = $obj[0]->id;

                        $rolePermission = DB::table('role_has_permissions')->where('role_id', '=', $roleId)->where('permission_id', '=', $permissionId)->limit(1)->get();

                        if (!empty($rolePermission[0])) {
                            $this->values[$roleName][$modelName][$action] = true;
                        } else {
                            $this->values[$roleName][$modelName][$action] = false;
                        }
                    }
                }
            }
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
            $model = substr($v, strrpos($v, '\\') + 1);
            $modelName = Str::plural(Str::camel($model));
            $models[$k] = $modelName;
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
        foreach ($patterns as $value) {
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
<div>
    <form wire:submit="createRolePermission" class="needs-validation" novalidate autocomplete="off">
        <div class="card custom-card">
            <div class="card-header">
                <div class="tw-flex tw-justify-between tw-items-center tw-w-full">
                    <h2>Role permissions</h2>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#role-permissions-modal">
                        <i class="bi bi-question-circle"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if($no_permissions)
                    <x-no-data />
                @else
                    @foreach($roles as $role)
                        @if ($role->name !== 'Super Admin')
                            <div class="card" :key="$role->id">
                                <div class="card-header">
                                    <h1>
                                        {{ $role->name }}
                                    </h1>
                                </div>
                                <div class="card-body">
                                    <table
                                        id="admin-role-permissions-create-{{ $role->name }}-table"
                                        data-classes="text-center table table-bordered table-sm"
                                        data-mobile-responsive="true"
                                        data-sticky-header="true"
                                        data-sticky-header-offset-y="64"
                                    >
                                        <thead>
                                        <tr>
                                            <th scope="col" class="col-2">Model</th>
                                            @foreach($actions as $action)
                                                @if($action === '*')
                                                    <th scope="col" class="col-1" :key="$action">Any</th>
                                                @else
                                                    <th scope="col"
                                                        class="col-1" :key="header-{{ $action }}">{{ ucfirst(preg_replace('/(?<!\ )[A-Z]/', ' $0', $action)) }}</th>
                                                @endif
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($models as $model)
                                            <tr>
                                                <th scope="row" :key="$model">{{ Str::headline($model) }}</th>
                                                @foreach($actions as $action)
                                                    <td :key="body-{{ $action }}">
                                                        <input type="checkbox"
                                                               id="values-{{ $role->name }}-{{ $model }}-{{ $action }}"
                                                               wire:model="values.{{ $role->name }}.{{ $model }}.{{ $action }}"
                                                               class="form-check-input"
                                                        />
                                                        <label
                                                            for="values-{{ $role->name }}-{{ $model }}-{{ $action }}"
                                                            class="tw-sr-only">
                                                            testing-{{ $role->name }}-{{ $model }}-{{ $action }}
                                                        </label>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="card-footer">
                <x-submit id="role-permission-create"/>
            </div>
        </div>
    </form>
    <div id="role-permissions-modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Additional details help</h1>
                </div>
                <div class="modal-body">
                    <dl>
                        <dt>Model</dt>
                        <dd>
                            Models, or objects stored in the database, represent different areas essentially in the
                            application. For instance, Brands, is all brands stored.
                        </dd>
                        <dt>
                            Action
                        </dt>
                        <dd>
                            The action is what the user can do with said model. Looking at Brands again, if you check
                            the Any checkbox, the user will be able to preform all actions on the Brands model.
                        </dd>
                        <dt>Any</dt>
                        <dd>
                            Any action on the model listed below.
                        </dd>
                        <dt>Create</dt>
                        <dd>
                            Create any and all records for the model.
                        </dd>
                        <dt>
                            Edit
                        </dt>
                        <dd>
                            Update all parts of the model.
                        </dd>
                        <dt>View</dt>
                        <dd>
                            View a specific record, and all related parts (so long as they have access to those as well).
                        </dd>
                        <dt>View Any</dt>
                        <dd>
                            View all records in a model.
                        </dd>
                        <dt>
                            Delete
                        </dt>
                        <dd>
                            All records are "soft deleted", meaning they remain in the database, but are mostly
                            inaccessible through the application. These records are kept for record keeping purposes.
                        </dd>
                        <dt>
                            Destroy
                        </dt>
                        <dd>
                            This gives the user to remove the record from the database entirely. Keep this permission
                            reserved for those who must have it.
                        </dd>
                        <dt>Purpose</dt>
                        <dd>
                            To limit user interactions, and viewability of certain  areas within the application. We do
                            not want a standard employee user being able to destroy a record.
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bst/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('js/bst/extensions/sticky-header/bootstrap-table-sticky-header.min.js') }}"></script>
    <script src="{{ asset('js/bst/extensions/mobile/bootstrap-table-mobile.min.js') }}"></script>
    <script>
        let $table = $('[id^=admin-role-permissions-create-]')

        $table.bootstrapTable({})
    </script>
</div>
