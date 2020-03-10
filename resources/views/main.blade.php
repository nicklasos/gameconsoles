@php
    /**
     * @var \App\Console $console
     */
@endphp

@extends('layouts.app')

@section('content')
    <h1 class="font-semibold text-gray-800">
        <span class="tracking-tighter">
            <a href="/">CONSOLE <span class="border-l border-red-600 pl-1 text-red-600 mr-3">LORE</span></a>
        </span>
        <br class="lg:hidden">
        <span class="font-thin text-2xl">All information about gaming consoles</span>
    </h1>

    <hr class="mt-8">

    <div class="mt-8 mb-10">
        @foreach ($consoles as $console)
            <div class="flex mt-10">
                <div class="max-w-xs rounded-lg overflow-hidden shadow-lg">
                    @include('img', [
                        'src' => $console->getFirstMediaUrl('logo'),
                        'alt' => $console->name,
                        'class' => 'w-full object-cover'
                    ])
                    <div class="p-6 bg-white border-t">
                        <h3>
                            {{ $console->company->name }}
                            {{ $console->name }} -
                            {{ optional($console->released_at)->format('Y') }}
                        </h3>
                    </div>
                </div>
                <div class="ml-10">
                    <div class="flex">
                        @foreach($console->children as $children)
                            @include('img', [
                                'src' => $children->getFirstMediaUrl('logo', 'thumb'),
                                'alt' => $children->name,
                                'class' => 'mr-4 shadow-lg rounded-md'
                            ])
                        @endforeach
                    </div>

                    @foreach ($console->games as $game)
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
