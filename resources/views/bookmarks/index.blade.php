<x-app-layout>
    <x-slot name="title">Saved Stories</x-slot>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10" style="display:flex; gap:2.5rem; align-items:flex-start;">
        {{-- Main feed --}}
        <div style="flex:1; min-width:0;">
            <div style="border-bottom:1px solid #e5e7eb; margin-bottom:2rem; padding-bottom:0.75rem;">
                <h1 style="font-size:1.5rem; font-weight:800; color:#111827;">Your saved stories</h1>
            </div>

            @forelse($posts as $bookmark)
                @include('components.post-card', ['post' => $bookmark->post])
            @empty
                <div style="text-align:center; padding:6rem 0;">
                    <svg style="width:2.5rem; height:2.5rem; color:#d1d5db; margin:0 auto 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                    </svg>
                    <p style="color:#9ca3af; margin-bottom:0.75rem;">You haven't saved any stories yet.</p>
                    <a href="{{ route('home') }}" style="font-size:0.875rem; font-weight:600; color:#111827; text-decoration:underline;">Browse stories</a>
                </div>
            @endforelse

            <div class="mt-6">{{ $posts->links() }}</div>
        </div>

        {{-- Sidebar (hidden on small screens) --}}
        <aside class="hidden lg:block" style="width:15rem; flex-shrink:0;">
            <div style="position:sticky; top:2rem;">
                <p style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:#6b7280; margin-bottom:1rem;">Your library</p>
                <div style="border:1px solid #e5e7eb; border-radius:0.75rem; padding:1.25rem; margin-bottom:1.25rem;">
                    <p style="font-size:0.875rem; font-weight:600; color:#111827; margin-bottom:0.25rem;">Reading list</p>
                    <p style="font-size:0.75rem; color:#6b7280; margin-bottom:1rem;">Come back anytime to your saved stories.</p>
                    <a href="{{ route('home') }}" style="font-size:0.75rem; font-weight:600; color:#374151; text-decoration:none;">&larr; Back to feed</a>
                </div>
                @auth
                <a href="{{ route('posts.create') }}" style="display:block; text-align:center; padding:0.65rem 1rem; background:#111827; color:#fff; border-radius:9999px; font-size:0.875rem; font-weight:600; text-decoration:none;">
                    Write a story
                </a>
                @endauth
            </div>
        </aside>
    </div>
</x-app-layout>
