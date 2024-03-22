@props(['label'])

<li class="slide has-sub">
    <a href="javascript:void(0);" class="side-menu__item">{{ $label }}
        <i class="fe fe-chevron-right side-menu__angle"></i></a>
    <ul class="slide-menu child2">
        {{ $slot }}
    </ul>
</li>
