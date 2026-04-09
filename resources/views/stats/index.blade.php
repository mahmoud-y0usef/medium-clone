<x-app-layout>
    <x-slot name="title">Stats</x-slot>

    <div style="max-width:900px; margin:0 auto; padding:3rem 1.5rem;">
        <h1 style="font-family:Georgia,serif; font-size:2.25rem; font-weight:700; color:#111827; margin:0 0 2rem;">Stats</h1>

        <!-- Summary cards -->
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:1.5rem; margin-bottom:3rem;">
            <div style="text-align:center; padding:1.5rem; border:1px solid #e5e7eb; border-radius:0.75rem;">
                <p style="font-size:2rem; font-weight:700; color:#111827; margin:0;">{{ $posts->count() }}</p>
                <p style="font-size:0.8rem; color:#9ca3af; margin:0.25rem 0 0;">Stories</p>
            </div>
            <div style="text-align:center; padding:1.5rem; border:1px solid #e5e7eb; border-radius:0.75rem;">
                <p style="font-size:2rem; font-weight:700; color:#111827; margin:0;">{{ $totalLikes }}</p>
                <p style="font-size:0.8rem; color:#9ca3af; margin:0.25rem 0 0;">Claps</p>
            </div>
            <div style="text-align:center; padding:1.5rem; border:1px solid #e5e7eb; border-radius:0.75rem;">
                <p style="font-size:2rem; font-weight:700; color:#111827; margin:0;">{{ $totalComments }}</p>
                <p style="font-size:0.8rem; color:#9ca3af; margin:0.25rem 0 0;">Responses</p>
            </div>
            <div style="text-align:center; padding:1.5rem; border:1px solid #e5e7eb; border-radius:0.75rem;">
                <p style="font-size:2rem; font-weight:700; color:#111827; margin:0;">{{ $followerCount }}</p>
                <p style="font-size:0.8rem; color:#9ca3af; margin:0.25rem 0 0;">Followers</p>
            </div>
        </div>

        <!-- Per-story stats -->
        @forelse($posts as $post)
        <div style="padding:1.25rem 0; border-bottom:1px solid #e5e7eb; display:flex; align-items:center; gap:1.5rem;">
            <div style="flex:1; min-width:0;">
                <a href="{{ route('posts.show', $post->slug) }}"
                   style="font-size:0.95rem; font-weight:600; color:#111827; text-decoration:none; display:block;"
                   onmouseover="this.style.color='#374151'" onmouseout="this.style.color='#111827'">
                    {{ $post->title }}
                </a>
                <p style="font-size:0.8rem; color:#9ca3af; margin:0.2rem 0 0;">{{ $post->published_at?->format('M j, Y') }}</p>
            </div>
            <div style="display:flex; gap:2rem; flex-shrink:0;">
                <div style="text-align:center;">
                    <p style="font-size:1.1rem; font-weight:600; color:#111827; margin:0;">{{ $post->likes->count() }}</p>
                    <p style="font-size:0.75rem; color:#9ca3af; margin:0;">Claps</p>
                </div>
                <div style="text-align:center;">
                    <p style="font-size:1.1rem; font-weight:600; color:#111827; margin:0;">{{ $post->comments->count() }}</p>
                    <p style="font-size:0.75rem; color:#9ca3af; margin:0;">Responses</p>
                </div>
                <div style="text-align:center;">
                    <p style="font-size:1.1rem; font-weight:600; color:#111827; margin:0;">{{ $post->reading_time }}m</p>
                    <p style="font-size:0.75rem; color:#9ca3af; margin:0;">Read time</p>
                </div>
            </div>
        </div>
        @empty
        <div style="text-align:center; padding:5rem 0;">
            <p style="color:#9ca3af; font-size:1rem;">No published stories yet.</p>
            <a href="{{ route('posts.create') }}" style="font-size:0.9rem; color:#1a8917; text-decoration:underline;">Start writing</a>
        </div>
        @endforelse
    </div>
</x-app-layout>
