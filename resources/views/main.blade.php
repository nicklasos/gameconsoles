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
                <div class="max-w-xs self-start rounded-lg overflow-hidden shadow-lg">
                    @include('img', [
                        'src' => $console->getFirstMediaUrl('logo'),
                        'alt' => $console->name,
                        'class' => 'w-full object-cover'
                    ])
                    <div class="bg-white border-t px-3 py-3">
                        <div class="flex justify-between justify-center">
                            <div class="text-gray-600 text-xs tracking-wide font-semibold uppercase">{{ $console->company->name }}</div>
                            <div class="font-light text-xs">{{ optional($console->released_at)->format('Y') }}</div>
                        </div>
                        <div class="font-semibold text-lg my-2">{{ $console->name }}</div>
                    </div>
                </div>
                <div class="ml-10">
                    <div class="flex">
                        @foreach($console->children as $children)
                            <div class="mr-4">
                                <div class="pl-1 text-sm text-gray-700">{{ $children->name }}</div>
                                @include('img', [
                                    'src' => $children->getFirstMediaUrl('logo', 'thumb'),
                                    'alt' => $children->name,
                                    'class' => 'rounded-md mt-2 shadow-md'
                                ])
                                <div class="pl-1 text-xs text-gray-500 mt-1">{{ optional($children->released_at)->format('Y') }}</div>
                            </div>
                        @endforeach
                    </div>

                    <div>
                        @foreach ($console->games as $game)
                            <div>
                                <div class="pl-1 text-sm text-gray-700">{{ $game->name }}</div>
                                @include('img', [
                                    'src' => $game->getFirstMediaUrl('logo', 'thumb'),
                                    'alt' => $game->name,
                                    'class' => 'rounded-md mt-2 shadow-md'
                                ])
                                <div class="pl-1 text-xs text-gray-500 mt-1">{{ optional($game->released_at)->format('Y') }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
