@extends('layouts.app')

@section('content')

    <h1>All information about upcoming game releases</h1>

    <h2>Opening soon</h2>

    <p>
        @include('img', [
            'src' => '/img/bowser-1.jpg',
            'alt' => 'bowser',
            'w' => 538,
            'h' => 538,
        ])
    </p>

    <p>Video games</p>
    <p>Kojima is genius!</p>

    <p>{{ mt_rand() }}</p>


    <p style="margin-top: 300px">
        {{ $company->getFirstMedia('photos') }}
    </p>

@endsection
