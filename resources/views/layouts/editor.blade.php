<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="/favicon.png">
        <title>{{ isset($title) ? $title . ' – ' . config('app.name') : config('app.name', 'Medium') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
        <style>
            * { box-sizing: border-box; }
            body { margin: 0; background: #fff; font-family: 'Figtree', sans-serif; }
        </style>
    </head>
    <body>
        {{ $slot }}
        @stack('scripts')
    </body>
</html>
