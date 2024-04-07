<?php

use Livewire\Volt\Component;
use Illuminate\Support\Collection as StdCollection;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

new class extends Component {
    public $models;

    public string $code = '';
    public string $title = '';

    public function mount(): void
    {
        $this->models = $this->getModels();
    }

    public function store(): void
    {
        $this->authorize('statusCodes.create');


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

    public function codeToUpper(string $code): void
    {
        $this->code = strtoupper($code);
    }
}; ?>

<div>
    <form wire:submit="store">
        <div class="card custom-card">
            <div class="card-header">
                <h2>Create status code</h2>
            </div>
            <div class="card-body">
                @can ('statusCodes.create')
                    <div class="row">
                        <x-select id="for-model" model="for_model" label="Model">
                            <option></option>
                            @foreach ($models as $model)
                                <option value="{{ $model }}">{{ Str::title(implode(' ', Str::ucsplit($model))) }}</option>
                            @endforeach
                        </x-select>

                        <x-input id="code" model="code" label="Code" x-mask="******" x-on:blur="$wire.codeToUpper($el.value)" />

                        <x-input id="title" model="title" label="Name" />
                    </div>
                    <div class="row">
                        <x-input cols="col-12" id="default-reason" model="default_reason" label="Default reason" />
                    </div>
                @else
                    <x-not-auth />
                @endcan
            </div>
        </div>
    </form>
</div>
