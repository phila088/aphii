<?php

use Livewire\Volt\Component;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

new class extends Component {
    public ?Collection $models = null;

    public string $for_model = '';
    public string $code = '';
    public string $title = '';
    public string $default_reason = '';

    public function mount(): void
    {
        $this->models = $this->getModels();
    }

    public function getModels(): Collection
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
}; ?>

<div>
    <x-custom.select id="models" model="false" label="Models">
        <option></option>
        @foreach ($models as $model)
            <option value="{{ $model }}">{{ $model }}</option>
        @endforeach
    </x-custom.select>

    @script
    <script>

    </script>
    @endscript
</div>
