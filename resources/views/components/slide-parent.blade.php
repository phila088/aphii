@props(['icon' => 'bi bi-question-diamond', 'label'])

<li class="slide has-sub">
    <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="{{ $icon }}"></i>
                            </span>
        <span class="side-menu__label tw-mt-[0.4rem]">{{ $label }}</span>
        <i class="fe fe-chevron-right side-menu__angle tw-mt-[0.3rem]"></i>
    </a>

    <ul class="slide-menu child1">
        {{ $slot }}
    </ul>
</li>
