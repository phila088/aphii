<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Collection as StdCollection;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

new class extends Component {
    public StdCollection $models;
    public array $actions;
    public bool $status;
    public array $permissions;

    public function mount(): void
    {
        $this->models = $this->getModels();

        $this->actions = (__('selects.actions'));

        $this->buildPermissionsArray();

        $this->getStatus();
    }

    public function buildPermissionsArray(): void
    {
        foreach ($this->models as $model) {
            foreach ($this->actions as $action) {
                $this->permissions[] = Str::plural(Str::camel($model)) . '.' . $action;
            }
        }
    }

    #[On('permissions-rebuilt')]
    public function getStatus(): void
    {
        $status = null;

        foreach ($this->permissions as $permission) {
            $status = Permission::where('name', '=', $permission)->exists();

            if (!$status) break;
        }

        $this->status = $status;
    }

    public function fixPermissions(): void
    {
        DB::table('permissions')->delete();

        foreach($this->permissions as $permission) {
            $this->authorize('permissions.create');

            Permission::updateOrCreate(['name' => $permission]);
        }

        $this->dispatch('permissions-rebuilt');
    }

    function getModels(): StdCollection
    {
        $models = collect(File::allFiles(app_path()))
            ->map(function ($item) {
                $path = $item->getRelativePathName();
                return sprintf('\%s%s',
                    Container::getInstance()->getNamespace(),
                    strtr(substr($path, 0, strrpos($path, '.')), '/', '\\'));
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
}; ?>

<div class="col-lg-4">
    <div class="card custom-card">
        <div class="card-header">
            <div class="tw-flex tw-justify-between tw-items-center tw-w-full">
                <h2>Permissions status</h2>
                <button type="button" data-bs-toggle="modal" data-bs-target="#permission-status-modal">
                    <i class="bi bi-question-circle"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @can ('permissions.edit')
                <div class="tw-w-full">
                    <div class="tw-flex tw-justify-between">
                        <p class="tw-font-bold">Status: </p>
                        @if($status)
                            <p class="tw-text-green-500 tw-font-bold">Ok!</p>
                        @else
                            <p class="tw-text-red-500 tw-font-bold">Error!</p>
                        @endif
                    </div>
                    <div class="tw-flex tw-justify-between">
                        <p class="tw-font-bold">Records: </p>
                        <p class="tw-font-bold">{{ Permission::count() }} / {{ count($permissions) }}</p>
                    </div>
                </div>
            @else
                <x-not-auth />
            @endcan
        </div>
        <div class="card-footer tw-flex tw-justify-end">
            <button type="button" wire:click.prevent="fixPermissions" class="btn btn-danger btn-sm" @if(Permission::count() === count($permissions)) disabled @endif>Fix permissions</button>
        </div>
    </div>
    <div id="permission-status-modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Additional details help</h1>
                </div>
                <div class="modal-body">
                    <dl>
                        <dt>Status</dt>
                        <dd>
                            This just shows that all standard statuses required for the application are present and in
                            the database.
                        </dd>
                        <dt>Records</dt>
                        <dd>
                            A simple count of records in the database for permissions.
                        </dd>
                        <dt>Fix permissions</dt>
                        <dd>
                            This will delete all permission records, and will rebuild the table. Please note that this
                            will also remove all role permissions, and user assigned roles as well. This should only be
                            completed in an emergency.
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
