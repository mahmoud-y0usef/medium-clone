<article class="group py-8 border-b border-gray-200 last:border-0">
    <div class="flex gap-6 items-start">
        <div class="flex-1 min-w-0">
            <!-- Author row -->
            <div class="flex items-center gap-2 mb-3">
                <a href="{{ route('users.show', $post->user) }}" class="flex items-center gap-2 hover:opacity-80 transition">
                    <div class="w-6 h-6 rounded-full bg-emerald-600 text-white flex items-center justify-center text-xs font-bold">
                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                    </div>
                    <span class="text-sm font-medium text-gray-700">{{ $post->user->name }}</span>
                </a>
                <span class="text-gray-300 text-sm">·</span>
                <span class="text-sm text-gray-400">{{ $post->published_at?->format('M d, Y') }}</span>
            </div>

            <!-- Title + excerpt -->
            <a href="{{ route('posts.show', $post->slug) }}" class="block">
                <h2 class="text-lg font-bold text-gray-900 group-hover:text-gray-600 transition line-clamp-2 leading-tight mb-1">
                    {{ $post->title }}
                </h2>
                <p class="text-gray-500 text-sm line-clamp-2 leading-relaxed">
                    {{ $post->excerpt }}
                </p>
            </a>

            <!-- Footer -->
            <div class="mt-4 flex items-center gap-3 flex-wrap">
                @if($post->category)
                    <a href="{{ route('dashboard', ['category' => $post->category_id]) }}"
                       class="px-2.5 py-0.5 bg-gray-100 text-gray-600 rounded-full text-xs font-medium hover:bg-gray-200 transition">
                        {{ $post->category->name }}
                    </a>
                @endif
                <span class="text-xs text-gray-400">{{ $post->reading_time }} min read</span>
                <span class="flex items-center gap-1 text-xs text-gray-400 ml-auto">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    {{ $post->likes->count() }}
                </span>
            </div>
        </div>

        @if($post->image)
            <a href="{{ route('posts.show', $post->slug) }}" class="shrink-0 mt-1">
                <img src="{{ $post->image_url }}" alt="{{ $post->title }}"
                     class="w-28 h-20 object-cover rounded-lg group-hover:opacity-90 transition">
            </a>
        @endif
    </div>
</article>
