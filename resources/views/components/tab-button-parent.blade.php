@props(['id' => 'pills-tab'])

<ul class="nav nav-pills mb-3" id="{{ $id }}" role="tablist">
    {{ $slot }}
</ul>
