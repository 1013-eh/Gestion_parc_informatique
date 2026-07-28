<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Gestion Parc') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <main>
                @yield('content')
                {{ $slot ?? '' }}
            </main>
        </div>
        @if(session('success') || session('warning') || session('error'))
            <div x-data="{ open: true }" x-show="open" class="fixed inset-0 z-50 flex items-center justify-center p-4">
                {{-- backdrop --}}
                <div x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-black/50" @click="open = false">
                </div>
                {{-- modal panel --}}
                <div x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="relative bg-white rounded-xl shadow-2xl w-full max-w-lg max-h-[80vh] flex flex-col z-10">

                    {{-- header --}}
                    <div class="flex items-center justify-between px-6 py-4 border-b rounded-t-xl
                        @if(session('error')) bg-red-50
                        @elseif(session('warning')) bg-yellow-50
                        @else bg-green-50 @endif">
                        <h3 class="text-lg font-semibold
                            @if(session('error')) text-red-800
                            @elseif(session('warning')) text-yellow-800
                            @else text-green-800 @endif">
                            @if(session('error')) Erreur
                            @elseif(session('warning')) Avertissement
                            @else Succès @endif
                        </h3>
                        <button @click="open = false" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">×</button>
                    </div>

                    {{-- body --}}
                    <div class="px-6 py-4 overflow-y-auto text-sm text-gray-700">
                        @if(session('error'))
                            {!! session('error') !!}
                        @elseif(session('warning'))
                            {!! session('warning') !!}
                        @else
                            {{ session('success') }}
                        @endif
                    </div>

                    {{-- footer --}}
                    <div class="px-6 py-3 border-t flex justify-end">
                        <button @click="open = false"
                            class="px-4 py-2 rounded-lg text-white text-sm font-medium
                                @if(session('error')) bg-red-500 hover:bg-red-600
                                @elseif(session('warning')) bg-yellow-500 hover:bg-yellow-600
                                @else bg-green-500 hover:bg-green-600 @endif">
                            OK
                        </button>
                    </div>
                </div>
            </div>
        @endif
        @stack('scripts')
    </body>
</html>
