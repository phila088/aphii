@props(['id' => 'pills-tab'])

<ul class="nav nav-pills" id="{{ $id }}" role="tablist">
    {{ $slot }}
</ul>
