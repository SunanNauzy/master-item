<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name')?? 'Item' }}</title>
    {{-- <title>Item</title> --}}

    {{-- <link rel="shortcut icon" type="image/png" href="{{asset('images/logo/joblister.png')}}" /> --}}
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')

</head>
<body>
    <div id="app">
        @include('inc.home.navbar')
       @yield('content')
    </div>
    @include('sweetalert::alert')
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('js')
</body>
</html>
