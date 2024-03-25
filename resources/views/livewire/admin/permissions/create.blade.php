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

    #[Validate('required|string')]
    public string $name;
    public string $model = '';
    public string $action = '';
    public string $permission;

    public function mount(): void
    {
        $this->models = $this->getModels();
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

<div class="tw-shadow-md tw-rounded-lg tw-p-6 tw-mb-6">
    <form wire:submit="createPermission" class="needs-validation" novalidate autocomplete="off">
        <div class="row g-2">
            <dl>
                <dt class="tw-text-lg">Permission</dt>
                <dl>
                    Use the below filters to generate the permission name, and save it.
                </dl>
                <dt>Model</dt>
                <dl>
                    The model the permission is for.
                </dl>
                <dt>Action</dt>
                <dl>
                    Which specific action this permission is for.
                </dl>
            </dl>

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
            </x-select>

            <x-input cols="col-lg-3" id="name" model="name" placeholder="Name" label="Name" readonly />
        </div>

        <x-submit id="permission-create" />
    </form>

    <script>

    </script>
</div>
