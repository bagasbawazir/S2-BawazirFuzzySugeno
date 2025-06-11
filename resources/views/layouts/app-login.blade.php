<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ config('app.name') }} | @yield('title', '')</title>

        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('assets/login/fonts/icomoon/style.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/login/css/owl.carousel.min.css') }}">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('assets/login/css/bootstrap.min.css') }}">

        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

        <!-- Style -->
        <link rel="stylesheet" href="{{ asset('assets/login/css/style.css') }}">

        @livewireStyles
    </head>

    <body>
        <div class="d-lg-flex half">
            <div class="bg order-1 order-md-2" style="background-image: url({{ asset('assets/login/images/bg_2.jpg') }});"></div>
            <div class="contents order-2 order-md-1">

                <div class="container">

                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-7">
                            <h3>Login to <strong>{{ config('app.name') }} (Bawazir)</strong></h3>
                            <p class="mb-4">Decision Support System for Procurement of Raw Materials<br><strong class="text-dark">UMKM Pembawa Kopi.</strong></p>

                            @yield('form-login')

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script src="{{ asset('assets/login/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('assets/login/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/login/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
        <script src="{{ asset('assets/login/js/main.js') }}"></script>

        @livewireScripts

        <x-livewire-alert::scripts />
        <x-livewire-alert::flash />
    </body>
