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

    <div class="mt-8">
        @foreach ($consoles as $console)
            <div class="mb-16">
                <div class="pl-1 pb-2 text-gray-600 text-sm tracking-wide font-semibold uppercase">{{ $console->company->name }}</div>
                <div class="flex">
                    <div class="max-w-md self-start rounded-lg overflow-hidden shadow-lg">
                        <div>
                            @include('img', [
                                'src' => $console->getFirstMediaUrl('logo'),
                                'alt' => $console->name,
                                'class' => 'w-full object-cover'
                            ])
                        </div>
                        <div class="bg-white border-t px-3 py-3">
                            <div class="flex justify-between justify-center content-center">
                                <div class="font-semibold text-lg">{{ $console->name }}</div>
                                <div
                                    class="font-light text-xs pt-1">{{ optional($console->released_at)->format('Y') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="ml-10">
                        @foreach ($console->games as $game)
                            <div>
                                <div class="pl-1 text-sm text-gray-700">{{ $game->name }}</div>
                                @include('img', [
                                    'src' => $game->getFirstMediaUrl('logo', 'thumb'),
                                    'alt' => $game->name,
                                    'class' => 'rounded-md mt-2 shadow-md h-24'
                                ])
                                <div class="pl-1 text-xs text-gray-500 mt-1">{{ optional($game->released_at)->format('Y') }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex mt-6">
                    @foreach($console->children as $children)
                        <div class="mr-4">
                            <div class="pl-1 text-sm text-gray-700">{{ $children->name }}</div>
                            @include('img', [
                                'src' => $children->getFirstMediaUrl('logo', 'thumb'),
                                'alt' => $children->name,
                                'class' => 'rounded-md mt-2 shadow-md h-20'
                            ])
                            <div
                                class="pl-1 text-xs text-gray-500 mt-1">{{ optional($children->released_at)->format('Y') }}</div>
                        </div>
                    @endforeach
                </div>

            </div>
        @endforeach
    </div>
@endsection
