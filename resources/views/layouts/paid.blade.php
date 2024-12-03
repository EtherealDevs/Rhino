<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Rino Indumentaria') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body>
    {{-- <header>
        <div class="sticky top-0 min-h-full z-50">
            <nav class="bg-white z-10 h-18 drop-shadow-xl">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-12 lg:h-16 justify-center items-center">
                        <div class="flex-shrink-0 bg-white lg:py-6 lg:rounded-full">
                            <a href="/">
                                <img class="lg:px-8 xl:w-48 mt-10 2xl:w-48 lg:w-48 w-24" src="/img/rino-black.png"
                                    alt="Rino Logo">
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header> --}}
    <main>
        <div class="font-sans text-gray-900 antialiased">
            @yield('content')
        </div>
        @livewireScripts
    </main>
</body>

</html>
