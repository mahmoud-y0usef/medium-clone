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
            .sidebar-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.6rem 1rem; border-radius: 0.5rem; color: #374151; text-decoration: none; font-size: 0.95rem; transition: background 0.15s; }
            .sidebar-link:hover { background: #f3f4f6; }
            .sidebar-link.active { font-weight: 600; color: #111827; }
        </style>
    </head>
    <body>
        <div style="display:flex; min-height:100vh;">

            <!-- ===== LEFT SIDEBAR ===== -->
            <aside style="width:240px; flex-shrink:0; position:fixed; top:0; left:0; height:100vh; border-right:1px solid #e5e7eb; background:#fff; display:flex; flex-direction:column; z-index:40; overflow-y:auto;">

                <!-- Logo -->
                <div style="padding:1.25rem 1.25rem 1rem; border-bottom:1px solid #e5e7eb;">
                    <a href="{{ route('dashboard') }}" style="font-family:'Playfair Display',Georgia,serif; font-size:1.6rem; font-weight:700; color:#111827; text-decoration:none; letter-spacing:-0.02em;">
                        Medium
                    </a>
                </div>

                <!-- Search -->
                <div style="padding:0.75rem 1rem; border-bottom:1px solid #e5e7eb;">
                    <form action="{{ route('search') }}" method="GET">
                        <div style="position:relative;">
                            <svg style="position:absolute; left:0.75rem; top:50%; transform:translateY(-50%); width:1rem; height:1rem; color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search"
                                style="width:100%; padding:0.5rem 0.75rem 0.5rem 2.25rem; background:#f9fafb; border:1px solid #e5e7eb; border-radius:9999px; font-size:0.875rem; color:#374151; outline:none;">
                        </div>
                    </form>
                </div>

                <!-- Nav -->
                <nav style="padding:0.75rem 0.5rem; flex:1; display:flex; flex-direction:column; gap:2px;">

                    <a href="{{ route('dashboard') }}"
                       class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg style="width:1.25rem; height:1.25rem; flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Home
                    </a>

                    <a href="{{ route('bookmarks.index') }}"
                       class="sidebar-link {{ request()->routeIs('bookmarks.*') ? 'active' : '' }}">
                        <svg style="width:1.25rem; height:1.25rem; flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                        </svg>
                        Library
                    </a>

                    @auth
                    <a href="{{ route('users.show', Auth::user()) }}"
                       class="sidebar-link {{ request()->routeIs('users.show') && request()->route('user')?->is(Auth::user()) ? 'active' : '' }}">
                        <svg style="width:1.25rem; height:1.25rem; flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Profile
                    </a>

                    <a href="{{ route('stories.index') }}"
                       class="sidebar-link {{ request()->routeIs('stories.*') ? 'active' : '' }}">
                        <svg style="width:1.25rem; height:1.25rem; flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Stories
                    </a>

                    <a href="{{ route('stats.index') }}"
                       class="sidebar-link {{ request()->routeIs('stats.*') ? 'active' : '' }}">
                        <svg style="width:1.25rem; height:1.25rem; flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Stats
                    </a>
                    @endauth

                    <hr style="border:none; border-top:1px solid #e5e7eb; margin:0.5rem 0.5rem;">

                    @auth
                    <a href="{{ route('following.index') }}"
                       class="sidebar-link {{ request()->routeIs('following.*') ? 'active' : '' }}">
                        <svg style="width:1.25rem; height:1.25rem; flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Following
                    </a>

                    <a href="#" style="display:flex; align-items:center; gap:0.6rem; padding:0.6rem 1rem; color:#6b7280; text-decoration:none; font-size:0.85rem; border-radius:0.5rem;" class="sidebar-link">
                        <svg style="width:1.125rem; height:1.125rem; flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 4v16m8-8H4"/>
                        </svg>
                        Find writers to follow
                    </a>
                    @endauth
                </nav>
            </aside>

            <!-- ===== MAIN CONTENT + TOP-RIGHT BAR ===== -->
            <div style="margin-left:240px; flex:1; min-width:0;">

                <!-- Top-right floating bar -->
                <div style="position:fixed; top:0; right:0; z-index:35; padding:0.75rem 1.5rem; display:flex; align-items:center; gap:1rem; background:#fff; border-bottom:1px solid #e5e7eb; border-left:1px solid #e5e7eb;">
                    @auth
                    <a href="{{ route('posts.create') }}" style="display:flex; align-items:center; gap:0.4rem; font-size:0.85rem; color:#6b7280; text-decoration:none;">
                        <svg style="width:1.1rem; height:1.1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Write
                    </a>

                    <!-- Avatar dropdown -->
                    <div x-data="{ open: false }" style="position:relative;">
                        <button @click="open = !open" style="background:none; border:none; cursor:pointer; padding:0; display:flex; align-items:center; gap:0.5rem;">
                            <div style="width:2.25rem; height:2.25rem; border-radius:9999px; background:#1a8917; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:600; font-size:0.9rem;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition
                             style="position:absolute; right:0; top:calc(100% + 0.5rem); width:240px; background:#fff; border:1px solid #e5e7eb; border-radius:0.75rem; box-shadow:0 8px 24px rgba(0,0,0,0.1); overflow:hidden; z-index:50;">
                            <div style="padding:1rem; border-bottom:1px solid #e5e7eb;">
                                <p style="font-weight:600; font-size:0.9rem; color:#111827; margin:0;">{{ Auth::user()->name }}</p>
                                <p style="font-size:0.75rem; color:#9ca3af; margin:0.2rem 0 0;">{{ Auth::user()->email }}</p>
                            </div>
                            <div style="padding:0.5rem 0;">
                                <a href="{{ route('users.show', Auth::user()) }}" style="display:block; padding:0.6rem 1rem; font-size:0.875rem; color:#374151; text-decoration:none;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background=''">View profile</a>
                                <a href="{{ route('profile.edit') }}" style="display:block; padding:0.6rem 1rem; font-size:0.875rem; color:#374151; text-decoration:none;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background=''">Settings</a>
                                <hr style="border:none; border-top:1px solid #e5e7eb; margin:0.25rem 0;">
                                <a href="{{ route('stories.index') }}" style="display:block; padding:0.6rem 1rem; font-size:0.875rem; color:#374151; text-decoration:none;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background=''">Stories</a>
                                <a href="{{ route('stats.index') }}" style="display:block; padding:0.6rem 1rem; font-size:0.875rem; color:#374151; text-decoration:none;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background=''">Stats</a>
                                <hr style="border:none; border-top:1px solid #e5e7eb; margin:0.25rem 0;">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" style="width:100%; text-align:left; padding:0.6rem 1rem; font-size:0.875rem; color:#374151; background:none; border:none; cursor:pointer;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background=''">
                                        Sign out
                                        <span style="display:block; font-size:0.7rem; color:#9ca3af;">{{ Auth::user()->email }}</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>

                <!-- Page content (with top padding to clear fixed bar) -->
                <main style="padding-top:57px;">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
