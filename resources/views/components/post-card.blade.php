<article class="py-8 border-b border-gray-200 last:border-0">
    <div class="flex gap-6">
        <div class="flex-1 min-w-0">
            <!-- Author row -->
            <div class="flex items-center gap-2 mb-3">
                <a href="{{ route('users.show', $post->user) }}" class="flex items-center gap-2 hover:opacity-80 transition">
                    <div class="w-6 h-6 rounded-full bg-green-600 text-white flex items-center justify-center text-xs font-semibold">
                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                    </div>
                    <span class="text-sm font-medium text-gray-700">{{ $post->user->name }}</span>
                </a>
                <span class="text-gray-400 text-sm">·</span>
                <span class="text-sm text-gray-500">{{ $post->published_at?->format('M d, Y') }}</span>
            </div>

            <!-- Title + excerpt -->
            <a href="{{ route('posts.show', $post->slug) }}">
                <h2 class="text-xl font-bold text-gray-900 hover:text-gray-600 transition line-clamp-2 leading-snug">
                    {{ $post->title }}
                </h2>
                <p class="mt-1.5 text-gray-500 text-sm line-clamp-2 leading-relaxed">
                    {{ $post->excerpt }}
                </p>
            </a>

            <!-- Footer -->
            <div class="mt-4 flex items-center gap-4 text-sm text-gray-400">
                @if($post->category)
                    <a href="{{ route('dashboard', ['category' => $post->category_id]) }}"
                       class="px-2.5 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium hover:bg-gray-200 transition">
                        {{ $post->category->name }}
                    </a>
                @endif
                <span>{{ $post->reading_time }} دقيقة للقراءة</span>
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    {{ $post->likes->count() }}
                </span>
            </div>
        </div>

        @if($post->image)
            <a href="{{ route('posts.show', $post->slug) }}" class="shrink-0">
                <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}"
                     class="w-28 h-28 object-cover rounded-md">
            </a>
        @endif
    </div>
</article>
