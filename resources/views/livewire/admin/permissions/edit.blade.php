<?php

use Spatie\Permission\Models\Permission;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Collection;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

new class extends Component {
    public Permission $permission;

    public $models;

    public string $model;
    public string $action;
    #[Validate('required|string')]
    public string $name = '';

    public function mount(): void
    {
        $this->models = $this->getModels();
        $parts = $this->extractParts($this->permission->name);
        $this->model = $parts['model'];
        $this->action = $parts['action'];
        $this->name = $this->permission->name;
    }

    public function updatePermission(): void
    {
        $validated = $this->validate();

        if ($this->permission->update($validated)) {
            $this->dispatch('permission-updated');
        }
    }

    public function cancel(): void
    {
        $this->dispatch('permission-edit-canceled');
    }

    public function extractParts($name)
    {
        $res = [];
        $explode = explode('.', $name);
        $res['model'] = Str::singular($explode[0]);
        $res['action'] = $explode[1];

        return $res;
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
    <form wire:submit="updatePermission" class="needs-validation" novalidate autocomplete="off">
        <div class="row g-2">
            <dl>
                <dt class="tw-text-lg">Permission</dt>
                <dt>Name</dt>
                <dl>
                    This is the name of the permission. Keep it short and simple
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
                <option value="create">Create</option>
                <option value="delete">Delete</option>
                <option value="edit">Edit</option>
                <option value="viewany">View Any</option>
                <option value="viewone">View One</option>
                <option value="report">Report</option>
            </x-select>

            <x-input id="name" model="name" placeholder="Name" label="Name" />
        </div>

        <x-submit-cancel id="permission-update" />
    </form>
</div>
