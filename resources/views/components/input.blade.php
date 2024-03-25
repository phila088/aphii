@props(['cols' => 'col-lg-2', 'margin' => 'mb-2', 'type' => 'text', 'id', 'model', 'live' => 'live', 'label'])

@if ($model !== "false")
    @if ($live === 'live')
        <div class="{{ $cols }} {{ $margin }}">
            <div class="form-floating">
                <input type="{{ $type }}" id="{{ $id }}" wire:model.live="{{ $model }}" {{ $attributes->merge(['class' => 'form-control focus-ring']) }} placeholder="{{ $label }}" />
                <label for="{{$id}}">{{ $label }}</label>
            </div>
            <x-input-error :messages="$errors->get($model)" class="tw-text-xs tw-text-red-500 mt-2"/>
        </div>
    @elseif ($live === 'blur')
        <div class="{{ $cols }} {{ $margin }}">
            <div class="form-floating">
                <input type="{{ $type }}" id="{{ $id }}" wire:model.blur="{{ $model }}" {{ $attributes->merge(['class' => 'form-control focus-ring']) }} placeholder="{{ $label }}" />
                <label for="{{$id}}">{{ $label }}</label>
            </div>
            <x-input-error :messages="$errors->get($model)" class="tw-text-xs tw-text-red-500 mt-2"/>
        </div>
    @else
        <div class="{{ $cols }} {{ $margin }}">
            <div class="form-floating">
                <input type="{{ $type }}" id="{{ $id }}" wire:model="{{ $model }}" {{ $attributes->merge(['class' => 'form-control focus-ring']) }} placeholder="{{ $label }}" />
                <label for="{{$id}}">{{ $label }}</label>
            </div>
            <x-input-error :messages="$errors->get($model)" class="tw-text-xs tw-text-red-500 mt-2"/>
        </div>
    @endif
@else
    <div class="{{ $cols }} {{ $margin }}">
        <div class="form-floating">
            <input type="{{ $type }}" id="{{ $id }}" {{ $attributes->merge(['class' => 'form-control focus-ring']) }} placeholder="{{ $label }}" />
            <label for="{{$id}}">{{ $label }}</label>
        </div>
        <x-input-error :messages="$errors->get($model)" class="tw-text-xs tw-text-red-500 mt-2"/>
    </div>
@endif
