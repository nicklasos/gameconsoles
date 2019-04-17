<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="{{ asset('css/app.css', env('USE_HTTPS')) }}?v={{ assets_v() }}" rel="stylesheet">

        <title>Games</title>
    </head>
    <body>

    @include('img', [
        'src' => '/img/bowser-2.png',
        'alt' => 'bowser',
        'w' => 538,
        'h' => 538,
    ])

    <div style="margin-top: 1000px">
        @include('img', [
            'src' => '/bowser-1.jpg',
            'alt' => 'bowser',
            'w' => 538,
            'h' => 538,
        ])
    </div>

    <script src="{{ asset('js/app.js', env('USE_HTTPS')) }}?v={{ assets_v() }}"></script>
    <script src="{{ asset('js/lazysizes.min.js', env('USE_HTTPS')) }}" async=""></script>
    </body>
    <style>
        img.lazyloaded {
            opacity: 1;
            filter: blur(0px);
            transition: opacity 200ms ease;
        }

        img {
            opacity: 0;
        }
    </style>
</html>
