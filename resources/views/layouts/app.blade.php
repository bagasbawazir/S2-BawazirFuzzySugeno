<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head')

    <body class="hold-transition sidebar-mini">

        @yield('wrapper')

        <!-- jQuery -->
        <script src=" {{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src=" {{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src=" {{ asset('assets/dist/js/adminlte.min.js') }}"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- SweetAlert2 -->
        <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>

        @stack('scripts')

        @livewireScripts
        @powerGridScripts
        <x-livewire-alert::scripts />
        <x-livewire-alert::flash />
    </body>

</html>
