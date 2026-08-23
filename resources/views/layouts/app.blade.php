<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#15803d">
        <meta name="mobile-web-app-capable" content="yes">

        <title>KadPoly Transcript System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Kill the browser-page overscroll bounce so it feels like an app, not a webpage */
            html, body {
                overscroll-behavior-y: contain;
                -webkit-tap-highlight-color: transparent;
            }
            /* Global tap feedback on interactive elements */
            button, a.btn, .tap-scale {
                transition: transform 0.1s ease;
            }
            button:active, a.btn:active, .tap-scale:active {
                transform: scale(0.96);
            }
            /* Reserve space at the bottom on mobile so content isn't hidden behind the bottom nav */
            @media (max-width: 767px) {
                .app-main-content {
                    padding-bottom: calc(4.5rem + env(safe-area-inset-bottom));
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="app-main-content">
                {{ $slot }}
            </main>
        </div>

        @include('layouts.bottom-nav')
        @include('layouts.toast')
        @include('layouts.loading')
    </body>
</html>