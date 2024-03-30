<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Collection;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

new class extends Component {
    public $models;
    public $actions;

    #[Validate('required|string')]
    public string $name;
    public string $model = '';
    public string $action = '';
    public string $permission;

    public function mount(): void
    {
        $this->models = $this->getModels();

        $this->actions = [
            '*',
            'create',
            'view',
            'viewAny',
            'edit',
            'delete',
            'destroy',
            'generateReport'
        ];
    }

    public function createPermission(): void
    {

        $validated = $this->validate();

        if (Permission::updateOrCreate($validated)) {
            $this->dispatch('permission-created');

            $this->name = '';
            $this->model = '';
            $this->action = '';
        }
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

    public function makePermission()
    {
        $this->name = $this->makePattern([Str::plural($this->model), $this->action]);
        $this->dispatch('filter-changed');
    }

    private function makePattern($patterns = [])
    {
        $pattern = "";
        foreach($patterns as $value){
            $pattern .= (!empty($value) ? $value : '') . '.';
        }
        return substr($pattern, 0, -1);
    }
}; ?>

<div>
    <form wire:submit="createPermission" class="needs-validation" novalidate autocomplete="off">
        <div class="card custom-card">
            <div class="card-header">
                <h1>Create permissions</h1>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <x-select id="model" model="model" label="Model" x-on:change="$wire.makePermission;">
                        <option></option>
                        @foreach ($models as $model)
                            <option value="{{ strtolower($model) }}">{{ $model }}</option>
                        @endforeach
                    </x-select>

                    <x-select id="action" model="action" label="Action" x-on:change="$wire.makePermission;">
                        <option></option>
                        <option value="*">*</option>
                        <option value="create">Create</option>
                        <option value="delete">Delete</option>
                        <option value="edit">Edit</option>
                        <option value="viewany">View Any</option>
                        <option value="viewone">View One</option>
                        <option value="report">Report</option>
                    </x-select>

                    <x-input cols="col-lg-3" id="name" model="name" placeholder="Name" label="Name" readonly />
                </div>
            </div>
        </div>

        <div class="card custom-card">
            <div class="card-body">
                <x-submit id="permission-create" />
            </div>
        </div>
    </form>
</div>
