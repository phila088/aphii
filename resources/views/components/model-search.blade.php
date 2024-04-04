@props(['id', 'model'])

<div>
    <label for="{{ $id }}" class="sr-only">Search</label>
    <input type="text" id="{{ $id }}" wire:model.live="{{ $model }}" class="form-control form-control-sm rounded-pill" placeholder="Search" x-on:input="$wire.searchResults($el.value)" />
</div>
