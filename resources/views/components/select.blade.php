@props(['cols' => 'col-lg-2', 'margin' => 'mb-2', 'id', 'model', 'live' => 'live', 'label'])

@if ($model !== "false")
    @if ($live === 'live')
        <div class="{{ $cols }} {{ $margin }}">
            <div class="form-group">
                <label for="{{$id}}">{{ $label }}</label>
                <select id="{{ $id }}" wire:model.live="{{ $model }}" {{ $attributes->merge(['class' => 'form-select']) }}>
                    {{ $slot }}
                </select>
            </div>
            <x-input-error :messages="$errors->get($model)" class="tw-text-xs tw-text-red-500 mt-2"/>
        </div>
    @elseif ($live === 'blur')
        <div class="{{ $cols }} {{ $margin }}">
            <div class="form-group">
                <label for="{{$id}}">{{ $label }}</label>
                <select id="{{ $id }}" wire:model.blur="{{ $model }}" {{ $attributes->merge(['class' => 'form-select']) }}>
                    {{ $slot }}
                </select>
            </div>
            <x-input-error :messages="$errors->get($model)" class="tw-text-xs tw-text-red-500 mt-2"/>
        </div>
    @else
        <div class="{{ $cols }} {{ $margin }}">
            <div class="form-group">
                <label for="{{$id}}">{{ $label }}</label>
                <select id="{{ $id }}" wire:model="{{ $model }}" {{ $attributes->merge(['class' => 'form-select']) }}>
                    {{ $slot }}
                </select>
            </div>
            <x-input-error :messages="$errors->get($model)" class="tw-text-xs tw-text-red-500 mt-2"/>
        </div>
    @endif
@else
    <div class="{{ $cols }} {{ $margin }}">
        <div class="form-group">
            <label for="{{$id}}">{{ $label }}</label>
            <select id="{{ $id }}" {{ $attributes->merge(['class' => 'form-select']) }}>
                {{ $slot }}
            </select>
        </div>
        <x-input-error :messages="$errors->get($model)" class="tw-text-xs tw-text-red-500 mt-2"/>
    </div>
@endif
