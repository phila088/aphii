<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="gradient"
      data-menu-styles="dark" class="">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Starterkit - Laravel Bootstrap Admin Dashboard Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
          content="php dashboard, php template, admin dashboard bootstrap, bootstrap admin theme, admin, php admin panel, bootstrap admin template, admin dashboard template, admin template bootstrap, php admin dashboard, dashboard template, dashboard template bootstrap, bootstrap admin, admin panel template, dashboard">

    <!-- TITLE -->
    <title> Starterkit - Laravel Bootstrap Admin &amp; Dashboard Template </title>

    <!-- FAVICON -->
    <link rel="icon" href="{{asset('build/assets/images/brand-logos/favicon.ico')}}" type="image/x-icon">

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{asset('build/assets/libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- ICONS CSS -->
    <link href="{{asset('build/assets/icon-fonts/icons.css')}}" rel="stylesheet">

    <!-- APP SCSS -->
    @vite([
        'resources/css/app.css',
        'resources/sass/app.scss',
        'resources/js/app.js',
    ])

    @include('layouts.components.styles')

    @livewireStyles

    <!-- MAIN JS -->
    <script src="{{asset('build/assets/main.js')}}"></script>

    @yield('styles')

</head>

@if(!empty(session()->get('toast')))

    <body onload="makeToast('{{ session()->get('toast')['type'] }}', '{{ session()->get('toast')['message'] }}')">
    @php

    @endphp
@else
    <body>
@endif

<!-- SWITCHER -->

@include('layouts.components.switcher')

<!-- END SWITCHER -->

<!-- LOADER -->
<div id="loader">
    <img src="{{asset('build/assets/images/media/loader.svg')}}" alt="">
</div>
<!-- END LOADER -->

<!-- PAGE -->
<div class="page">

    <!-- HEADER -->

    @include('layouts.components.header')

    <!-- END HEADER -->

    <!-- SIDEBAR -->

    @include('layouts.components.sidebar')

    <!-- END SIDEBAR -->
    <div class="page-header-breadcrumb">

    </div>
    <!-- MAIN-CONTENT -->
    @yield('content')

    <!-- END MAIN-CONTENT -->

    <!-- SEARCH-MODAL -->

    @include('layouts.components.search-modal')

    <!-- END SEARCH-MODAL -->

    <!-- RIGHT-SIDEBAR -->

    @include('layouts.components.right-sidebar')

    <!-- END RIGHT-SIDEBAR -->

    <!-- FOOTER -->



    @include('layouts.components.footer')

    <!-- END FOOTER -->

</div>
<div class="toast-container position-fixed bottom-0 end-0 p-4 tw-z-[9999999]">
    <x-flash />
    <div id="toast-element" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div id="toast-header" class="toast-header bg-success-subtle">
            <img src="{{ asset('build/assets/images/brand-logos/favicon.svg') }}" class="rounded me-2" alt="...">
            <strong class="me-auto">Bootstrap</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toast-body"></div>
    </div>
</div>
<!-- END PAGE-->

<!-- SCRIPTS -->

@include('layouts.components.scripts')

@yield('scripts')

<!-- STICKY JS -->
<script src="{{asset('build/assets/sticky.js')}}"></script>

<!-- APP JS -->
@vite('resources/js/app.js')

@vite('resources/assets/js/Toasts.js')


<!-- CUSTOM-SWITCHER JS -->
@vite('resources/assets/js/custom-switcher.js')

<!-- END SCRIPTS -->
@livewireScriptConfig

<script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>

<script>
    const searchBox = document.getElementById('typehead');

    hotkeys('alt+l,alt+m+p, alt+m+b, alt+a+b, alt+/', function (event, handler){
        switch (handler.key) {
            case 'alt+/':
                searchBox.click();
                searchBox.focus();
                break;
            case 'alt+l':
                document.getElementById('lock-app').click();
                break;
            case 'alt+m+p':
                window.location.href = "/dashboards/personal";
                break;
            case 'alt+m+b':
                window.location.href = "/brands";
                break;
            case 'alt+a+b':
                window.location.href = "/admin/brands";
                break;
            default: alert(event);
        }
    });

    const toastEl = document.getElementById('toast-element');
    const toastHeaderEl = document.getElementById('toast-header')
    const toastMessageEl = document.getElementById('toast-body');
    const options = {
        animation: true,
        autohide: true,
        delay: 10000
    };
    document.addEventListener('livewire:init', () => {
        Livewire.on('toast', (event) => {
            switch(event['type']) {
                case 'success':
                    toastHeaderEl.classList.add('bg-success-subtle');
                    break;
                case 'failure':
                    toastHeaderEl.classList.add('bg-danger-subtle');
                    break;
                case 'warning':
                    toastHeaderEl.classList.add('bg-warning-subtle');
                    break;
                default:
                    toastHeaderEl.classList.add('bg-primary-subtle');
                    break;
            }
            toastMessageEl.innerHTML = event['message'];

            const toast = new bootstrap.Toast(toastEl, options);
            toast.show();
            $('html, body').animate({ scrollTop: 0 }, 'fast');
        });
    });
    function makeToast(type, message)
    {
        console.log(type, message);
    }
</script>
</body>
</html>
