<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title ?? 'Medium – Where good ideas find you.' }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,400;1,700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
        <style>
            * { box-sizing: border-box; }
            body { margin: 0; background: #f7f4ed; font-family: 'Figtree', sans-serif; }
        </style>
    </head>
    <body>
        <!-- Public Navbar -->
        <header style="border-bottom: 1px solid #d9d5cc; background: #f7f4ed; position: sticky; top: 0; z-index: 50;">
            <div style="max-width: 1280px; margin: 0 auto; padding: 0 1.5rem; height: 65px; display: flex; align-items: center; justify-content: space-between; gap: 1rem;">
                <!-- Logo -->
                <a href="{{ route('home') }}" style="font-family: 'Playfair Display', Georgia, serif; font-size: 1.75rem; font-weight: 700; color: #111827; text-decoration: none; letter-spacing: -0.02em; white-space: nowrap;">
                    Medium
                </a>

                <!-- Nav Links + Auth -->
                <nav style="display: flex; align-items: center; gap: 1.25rem;">
                    <a href="#" style="font-size: 0.875rem; color: #374151; text-decoration: none; white-space: nowrap;">Our story</a>
                    <a href="#" style="font-size: 0.875rem; color: #374151; text-decoration: none; white-space: nowrap;">Membership</a>
                    <a href="{{ route('login') }}" style="font-size: 0.875rem; color: #374151; text-decoration: none; white-space: nowrap;">Write</a>
                    <a href="{{ route('login') }}" style="font-size: 0.875rem; color: #374151; text-decoration: none; white-space: nowrap;">Sign in</a>
                    <a href="{{ route('register') }}" style="font-size: 0.875rem; font-weight: 500; color: #fff; background: #111827; padding: 0.5rem 1.25rem; border-radius: 9999px; text-decoration: none; white-space: nowrap;">
                        Get started
                    </a>
                </nav>
            </div>
        </header>

        {{ $slot }}

        @stack('scripts')
    </body>
</html>
