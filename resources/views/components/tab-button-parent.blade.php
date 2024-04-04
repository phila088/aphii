@props(['id' => 'pills-tab'])

<ul class="nav nav-pills nav-style-3" id="{{ $id }}" role="tablist">
    {{ $slot }}
</ul>
