<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Game consoles museum</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#3490DC"/>
    <meta name="Description" content="All information about upcoming games">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <link href="{{ asset('css/app.css', env('USE_HTTPS')) }}?v={{ assets_v() }}" rel="stylesheet">
    <link rel="manifest" href="/manifest.json">
</head>
<body class="font-sans font-normal leading-normal">

<div class="container mx-auto">
    @yield('content')
</div>

<script src="{{ asset('js/app.js', env('USE_HTTPS')) }}?v={{ assets_v() }}"></script>
<script src="{{ asset('js/lazysizes.min.js', env('USE_HTTPS')) }}" async=""></script>

@include('config')
@include('scripts')

</body>
</html>
