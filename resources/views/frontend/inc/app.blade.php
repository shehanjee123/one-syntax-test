<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta_tags')

    <title>@yield('title', config('app.name'))</title>
    {{-- <link rel="icon" href="{{ asset('favicon.jpg') }}" /> --}}

    {{-- Jquery --}}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    </script>


    @section('meta_tags')

    @endsection

    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-5.2.2/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/aos-master/dist/aos.css') }}">

    <!-- Styles and Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    @vite('resources/css/app.css')
    @yield('plugin')
    @yield('css')
</head>
<body class="@yield('classes_body')" @yield('body_data')>
    {{-- header --}}
    @include('frontend.inc.header')

    {{-- content --}}
    @yield('content')

    {{-- footer --}}
    @include('frontend.inc.footer')

    @yield('js')
</body>

    <script src="{{ asset('vendor/bootstrap-5.2.2/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-5.2.2/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/aos-master/dist/aos.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>