@if ($message = Session::get('success'))
    <div id="toast-element" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div id="toast-header" class="toast-header bg-success-subtle">
            <img src="{{ asset('build/assets/images/brand-logos/favicon.svg') }}" class="rounded me-2" alt="...">
            <strong class="me-auto">Bootstrap</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toast-body"></div>
    </div>
@endif

@if ($message = Session::get('error'))
    <div id="toast-element" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div id="toast-header" class="toast-header bg-danger-subtle">
            <img src="{{ asset('build/assets/images/brand-logos/favicon.svg') }}" class="rounded me-2" alt="...">
            <strong class="me-auto">Bootstrap</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toast-body"></div>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div id="toast-element" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div id="toast-header" class="toast-header bg-warning-subtle">
            <img src="{{ asset('build/assets/images/brand-logos/favicon.svg') }}" class="rounded me-2" alt="...">
            <strong class="me-auto">Bootstrap</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toast-body"></div>
    </div>
@endif

@if ($message = Session::get('info'))
    <div id="toast-element" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div id="toast-header" class="toast-header bg-info-subtle">
            <img src="{{ asset('build/assets/images/brand-logos/favicon.svg') }}" class="rounded me-2" alt="...">
            <strong class="me-auto">Bootstrap</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toast-body"></div>
    </div>
@endif
