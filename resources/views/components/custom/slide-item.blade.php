@props(['route', 'label'])
@php
    $res = [];
    preg_match('/url:(.*)/', $route, $res);
@endphp

@if (empty($res))
    <li class="slide"><a href="{{ route($route) }}" class="side-menu__item">{{ $label }}</a></li>
@else
    <li class="slide"><a href="{{ $res[1] }}" class="side-menu__item">{{ $label }}</a></li>
@endif
