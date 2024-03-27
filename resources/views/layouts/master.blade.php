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
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- FAVICON -->
    <link rel="icon" href="{{asset('build/assets/images/brand-logos/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('build/assets/images/brand-logos/favicon.svg')}}" type="image/svg">

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
    <script src="{{asset('build/assets/main.js')}}" data-navigate-track></script>
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous" data-navigate-track></script>

    @yield('styles')

    <style>
        .tab-content,
        .tab-pane {
            border: 0 !important;
            padding: 0 !important;
        }
    </style>

</head>

<body {{ Session::has('toast') ? 'data-notification data-notification-type="'. Session::get('toast_typ') .'" data-notification-message="'. Session::get('toast') .'"' : '' }}>

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
<!-- END PAGE-->

<!-- SCRIPTS -->

@include('layouts.components.scripts')

@yield('scripts')

<!-- STICKY JS -->
<script src="{{asset('build/assets/sticky.js')}}" data-navigate-track></script>

<!-- APP JS -->
@vite('resources/js/app.js')

@vite('resources/assets/js/Toasts.js')


<!-- CUSTOM-SWITCHER JS -->
@vite('resources/assets/js/custom-switcher.js')

<!-- END SCRIPTS -->
@livewireScriptConfig

<script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js" data-navigate-track></script>

<script src="{{ asset('js/toastr.js') }}" data-navigate-track></script>
<link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
<script>
    document.addEventListener("livewire:navigated", function() {
        if (document.body.hasAttribute('data-notification')) {
            let types = ['success', 'info', 'warning', 'error']
            let type = '{{ Session::get('toast_type') }}'
            let message = "{{ Session::get('toast') }}"

            if (!types.includes(type)) {
                type = 'info'
            }

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "10000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            toastr[type](message)
        }
    });

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



</script>
</body>
</html>
