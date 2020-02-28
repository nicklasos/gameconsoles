@php
/**
 * @var \App\Console $console
 */
@endphp

@extends('layouts.app')

@section('content')

    <h1 class="font-semibold text-gray-800">
        <a href="/">CONSOLE <span class="text-teal-600 mr-3">LORE</span></a>
        <br class="lg:hidden">
        <span class="font-thin">All information about gaming consoles</span>
    </h1>

    <hr class="mt-8">

    <div class="mt-8">
    @foreach ($consoles as $console)
        <div class="max-w-xs bg-white border rounded-lg overflow-hidden">
            @include('img', [
                'src' => $console->getFirstMediaUrl('logo'),
                'alt' => $console->name,
                'class' => 'w-full object-cover'
            ])
            <div class="p-6">
                <h3>{{ $console->company->name }} {{ $console->name }} - {{ optional($console->released_at)->format('Y') }}</h3>
            </div>
        </div>
        <br>
    @endforeach
    </div>
@endsection
