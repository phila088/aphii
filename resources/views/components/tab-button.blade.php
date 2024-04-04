@props(['id', 'target', 'selected', 'label'])

@if ($selected === 'true')
    <li class="nav-item" role="presentation">
        <button class="nav-link active btn-sm btn-wave waves-effect" id="{{ $id }}" data-bs-toggle="pill" data-bs-target="#{{ $target }}" type="button" role="tab" aria-controls="{{ $target }}" aria-selected="{{ $selected }}">{{ $label }}</button>
    </li>
@else
    <li class="nav-item" role="presentation">
        <button class="nav-link btn-sm btn-wave waves-effect" id="{{ $id }}" data-bs-toggle="pill" data-bs-target="#{{ $target }}" type="button" role="tab" aria-controls="{{ $target }}" aria-selected="{{ $selected }}">{{ $label }}</button>
    </li>
@endif

