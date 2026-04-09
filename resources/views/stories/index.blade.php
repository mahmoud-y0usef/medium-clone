<x-app-layout>
    <x-slot name="title">Stories</x-slot>

    <div style="max-width:900px; margin:0 auto; padding:3rem 1.5rem;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:2rem;">
            <h1 style="font-family:Georgia,serif; font-size:2.25rem; font-weight:700; color:#111827; margin:0;">Stories</h1>
            <a href="{{ route('posts.create') }}"
               style="padding:0.5rem 1.25rem; border:1px solid #d1d5db; border-radius:9999px; font-size:0.875rem; color:#374151; text-decoration:none;"
               onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background=''">
                Import a story
            </a>
        </div>

        <!-- Tabs -->
        <div style="display:flex; gap:0; border-bottom:1px solid #e5e7eb; margin-bottom:2rem;">
            <a href="{{ route('stories.index', ['tab' => 'drafts']) }}"
               style="padding:0.75rem 1rem; font-size:0.9rem; text-decoration:none; border-bottom:2px solid {{ $tab === 'drafts' ? '#111827' : 'transparent' }}; color:{{ $tab === 'drafts' ? '#111827' : '#6b7280' }}; font-weight:{{ $tab === 'drafts' ? '600' : '400' }}; margin-bottom:-1px;">
                Drafts @if($draftCount > 0)<span style="font-size:0.75rem; background:#e5e7eb; border-radius:4px; padding:0.1rem 0.4rem; margin-left:0.35rem;">{{ $draftCount }}</span>@endif
            </a>
            <a href="{{ route('stories.index', ['tab' => 'published']) }}"
               style="padding:0.75rem 1rem; font-size:0.9rem; text-decoration:none; border-bottom:2px solid {{ $tab === 'published' ? '#111827' : 'transparent' }}; color:{{ $tab === 'published' ? '#111827' : '#6b7280' }}; font-weight:{{ $tab === 'published' ? '600' : '400' }}; margin-bottom:-1px;">
                Published @if($publishedCount > 0)<span style="font-size:0.75rem; background:#e5e7eb; border-radius:4px; padding:0.1rem 0.4rem; margin-left:0.35rem;">{{ $publishedCount }}</span>@endif
            </a>
        </div>

        <!-- Stories list -->
        @forelse($posts as $post)
        <div style="padding:1.5rem 0; border-bottom:1px solid #e5e7eb; display:flex; align-items:flex-start; justify-content:space-between; gap:1.5rem;">
            <div style="flex:1; min-width:0;">
                <a href="{{ route('posts.show', $post->slug) }}"
                   style="font-size:1.1rem; font-weight:700; color:#111827; text-decoration:none; display:block; margin-bottom:0.35rem; font-family:Georgia,serif; line-height:1.4;"
                   onmouseover="this.style.color='#374151'" onmouseout="this.style.color='#111827'">
                    {{ $post->title }}
                </a>
                <p style="font-size:0.875rem; color:#6b7280; margin:0 0 0.75rem; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                    {{ strip_tags($post->content) }}
                </p>
                <div style="display:flex; align-items:center; gap:1rem; font-size:0.8rem; color:#9ca3af;">
                    @if($post->published_at)
                        <span>{{ $post->published_at->format('M j') }}</span>
                    @else
                        <span style="color:#f59e0b; font-weight:500;">Draft</span>
                    @endif
                    <span>{{ $post->reading_time }} min read</span>
                    @if($post->likes_count ?? $post->likes->count())
                    <span>{{ $post->likes->count() }} claps</span>
                    @endif
                </div>
            </div>
            @if($post->image_url)
            <img src="{{ $post->image_url }}" alt="" style="width:90px; height:64px; border-radius:4px; object-fit:cover; flex-shrink:0;">
            @endif
            <div style="display:flex; flex-direction:column; gap:0.5rem; flex-shrink:0;" x-data="{ open: false }">
                <button @click="open = !open" style="background:none; border:none; cursor:pointer; padding:0.25rem; color:#9ca3af;" title="More options">
                    <svg style="width:1.25rem; height:1.25rem;" fill="currentColor" viewBox="0 0 24 24">
                        <circle cx="5" cy="12" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="19" cy="12" r="1.5"/>
                    </svg>
                </button>
                <div x-show="open" @click.away="open=false"
                     style="position:absolute; z-index:10; background:#fff; border:1px solid #e5e7eb; border-radius:0.5rem; box-shadow:0 4px 12px rgba(0,0,0,0.1); min-width:160px; overflow:hidden;">
                    <a href="{{ route('posts.edit', $post->slug) }}" style="display:block; padding:0.65rem 1rem; font-size:0.875rem; color:#374151; text-decoration:none;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background=''">Edit story</a>
                    <form method="POST" action="{{ route('posts.destroy', $post->slug) }}">
                        @csrf @method('DELETE')
                        <button type="submit" style="width:100%; text-align:left; padding:0.65rem 1rem; font-size:0.875rem; color:#dc2626; background:none; border:none; cursor:pointer;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background=''">Delete story</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div style="text-align:center; padding:5rem 0;">
            <p style="color:#9ca3af; font-size:1rem; margin-bottom:1.25rem;">
                @if($tab === 'drafts') No stories in draft. @else No published stories yet. @endif
            </p>
            <a href="{{ route('posts.create') }}" style="font-size:0.9rem; color:#1a8917; text-decoration:underline;">
                @if($tab === 'drafts') Why not start writing one? @else Start writing @endif
            </a>
        </div>
        @endforelse

        <div style="margin-top:2rem;">{{ $posts->appends(request()->query())->links() }}</div>
    </div>
</x-app-layout>
