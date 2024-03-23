@props(['active' => 'false', 'id', 'labelledby'])

@if ($active === 'true')
    <div class="tab-pane fade show active" id="{{ $id }}" role="tabpanel" aria-labelledby="{{ $labelledby }}" tabindex="0">
        {{ $slot }}
    </div>
@else
    <div class="tab-pane fade" id="{{ $id }}" role="tabpanel" aria-labelledby="{{ $labelledby }}" tabindex="0">
        {{ $slot }}
    </div>
@endif
