@php
/**
 * @var \App\Console $console
 */
@endphp

@extends('layouts.app')

@section('content')

    <h1>All information about video game consoles</h1>

    @foreach ($consoles as $console)
        <h3>{{ $console->company->name }} {{ $console->name }}</h3>
        <div>
            @include('img', [
                'src' => $console->getFirstMediaUrl('logo', 'thumb'),
                'alt' => $console->name,
            ])
        </div>

    @endforeach

@endsection
