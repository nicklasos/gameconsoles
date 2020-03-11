<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Game consoles museum</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#3490DC"/>
    <meta name="Description" content="All information about upcoming games">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <link href="/css/app.css?v={{ assets_v() }}" rel="stylesheet">
    <link rel="manifest" href="/manifest.json">
</head>
<body class="font-sans font-normal leading-normal antialiased text-gray-800">

<div class="container mx-auto px-8">
    @yield('content')
</div>

<script src="/js/app.js?v={{ assets_v() }}"></script>
<script src="/js/lazysizes.min.js" async=""></script>

</body>
</html>
