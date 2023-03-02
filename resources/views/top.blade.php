<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '芳名帳') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('js/guest-book.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/guest-book.css') }}" rel="stylesheet">
    @yield('head')
</head>

<body>
    <div class="top">
        @if (!empty(Auth::id()))
    <form action="{{ route('home', ['user_hash' => Auth::user()->user_hash]) }}" method="GET">
        <span class="execution-button">
            <div class="log-in"></div>
        </span>
        <input type="submit" class="execute" value="" style="display: none" />
    </form>
    @else
    <form action="/login" method="GET">
        <span class="execution-button">
            <div class="log-in"></div>
        </span>
        <input type="submit" class="execute" value="" style="display: none" />
    </form>
    @endif

    </div>

</body>

</html>