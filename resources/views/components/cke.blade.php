@props(['cols' => 'col-12', 'margin' => 'mb-2', 'id', 'model', 'label' ])
<div class="row g-2" wire:ignore>
    <div class="{{ $cols }} {{ $margin }}">
        <h4 class="mb-2">{{ $label }}</h4>
        <textarea id="{{ $id }}" wire:model="{{ $model }}">{{ $slot }}</textarea>
        <div autoloader="header">
            <div autoloader="container-{{ $id }}" class="">
                <div autoloader="status-label">Status:</div>
                <div autoloader="status-spinner">
                    <span autoloader="status-spinner-label"></span>
                    <span autoloader="status-spinner-loader"></span>
                </div>
            </div>
        </div>
    </div>
</div>
