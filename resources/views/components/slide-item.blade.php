@props(['route', 'label', 'permission' => ''])
@php
    $res = [];
    preg_match('/url:(.*)/', $route, $res);

    $can = null;

    /**
     * Multi-permission handling from the menu
     * You can pass a comma seperated list of permissions in the menu item as the permission attribute. This will
     * explode the results into an array, search the auth results for each until it reaches a false, and break. If not
     * false, $can is set to true. Then we simply use an if to see if $can is true or false.
     */
    if (!empty($permission)) {
        if (str_contains($permission, ',')) {
            $permissions = explode(',', $permission);

            foreach ($permissions as $v) {
                $can = auth()->user()->can(trim($v));
                if (!$can) {
                    $can = false;
                    break;
                }
            }
        } else {
            $can = auth()->user()->can($permission);
        }
    }
@endphp


@if (!empty($permission))
    @if ($can)
        @if (empty($res))
            <li class="slide"><a href="{{ route($route) }}" class="side-menu__item">{{ $label }}</a></li>
        @else
            <li class="slide"><a href="{{ $res[1] }}" class="side-menu__item">{{ $label }}</a></li>
        @endif
    @endcan
@else
    @if (empty($res))
        <li class="slide"><a href="{{ route($route) }}" class="side-menu__item">{{ $label }}</a></li>
    @else
        <li class="slide"><a href="{{ $res[1] }}" class="side-menu__item">{{ $label }}</a></li>
    @endif
@endif
