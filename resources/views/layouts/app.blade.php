<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Blinker:wght@800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">

    <div id="contain-loader"
        class="fixed  z-50 flex h-screen w-screen backdrop-blur-2xl justify-center items-center bg-black/25">
        <div id="loader" class="h-18  mx-auto mt-12"></div>
    </div>

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation')

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        @livewire('banner')
        @livewire('footer')
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
