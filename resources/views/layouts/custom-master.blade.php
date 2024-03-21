<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">

    <head>

        <!-- Meta Data -->
		<meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="Description" content="Velvet - Laravel Bootstrap Admin Dashboard Template">
        <meta name="Author" content="Spruko Technologies Private Limited">
        <meta name="keywords" content="laravel dashboard, laravel vite, laravel template, template dashboard, admin template, admin, dashboard admin, laravel admin panel, template admin, admin panel for laravel, laravel admin, alaravel, laravel framework, dashboard, laravel template admin">

        <!-- TITLE -->
		<title>{{ config('app.name', 'Laravel') }}</title>

        <!-- FAVICON -->
        <link rel="icon" href="{{asset('build/assets/images/brand-logos/favicon.ico')}}" type="image/x-icon">

        <!-- BOOTSTRAP CSS -->
	    <link  id="style" href="{{asset('build/assets/libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- ICONS CSS -->
        <link href="{{asset('build/assets/icon-fonts/icons.css')}}" rel="stylesheet">

        <!-- APP SCSS -->
        @vite(['resources/sass/app.scss','resources/js/app.js',])

        @livewireStyles


        <!-- MAIN JS -->
        <script src="{{ asset('build/assets/authentication-main.js') }}"></script>

        @yield('styles')

	</head>
    <body>
        {{ $slot }}

        <!-- SCRIPTS -->

        <!-- BOOTSTRAP JS -->
        <script src="{{ asset('build/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <script>
            function DisableBackButton(){
                window.history.forward()
            }
            DisableBackButton();
            window.onload = DisableBackButton;
            window.onpageshow = function(evt) { if (evt.persisted) DisableBackButton() }
            window.onload = function() {void(0)}
        </script>

        @yield('scripts')

        <!-- END SCRIPTS -->

	</body>
</html>

