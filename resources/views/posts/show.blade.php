<x-app-layout>
    <x-slot name="title">{{ $post->title }}</x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        {{-- Cover Image --}}
        @if($post->image)
            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}"
                 class="w-full h-64 object-cover rounded-xl mb-8">
        @endif

        {{-- Category + Tags --}}
        <div class="flex flex-wrap items-center gap-2 mb-4">
            @if($post->category)
                <a href="{{ route('dashboard', ['category' => $post->category_id]) }}"
                   class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium hover:bg-gray-200 transition">
                    {{ $post->category->name }}
                </a>
            @endif
            @foreach($post->tags as $tag)
                <span class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-medium">
                    {{ $tag->name }}
                </span>
            @endforeach
        </div>

        {{-- Title --}}
        <h1 class="text-4xl font-bold text-gray-900 leading-tight mb-4">{{ $post->title }}</h1>

        {{-- Author row --}}
        <div class="flex items-center gap-4 mb-8 pb-6 border-b border-gray-200">
            <a href="{{ route('users.show', $post->user) }}" class="flex items-center gap-3 hover:opacity-80 transition">
                <div class="w-10 h-10 rounded-full bg-green-600 text-white flex items-center justify-center font-bold text-lg">
                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-semibold text-gray-900 text-sm">{{ $post->user->name }}</p>
                    <p class="text-xs text-gray-400">
                        {{ $post->published_at?->format('M d, Y') }} · {{ $post->reading_time }} دقيقة للقراءة
                    </p>
                </div>
            </a>

            @auth
                @if(auth()->id() !== $post->user_id)
                    <form action="{{ route('users.follow', $post->user) }}" method="POST" class="ms-auto">
                        @csrf
                        <button type="submit"
                            class="px-4 py-1.5 rounded-full text-sm font-medium border transition
                                   {{ auth()->user()->isFollowing($post->user)
                                      ? 'border-gray-300 text-gray-600 hover:bg-gray-50'
                                      : 'bg-gray-900 text-white border-gray-900 hover:bg-gray-700' }}">
                            {{ auth()->user()->isFollowing($post->user) ? 'إلغاء المتابعة' : 'متابعة' }}
                        </button>
                    </form>
                @else
                    <div class="ms-auto flex gap-2">
                        <a href="{{ route('posts.edit', $post->slug) }}"
                           class="px-4 py-1.5 rounded-full text-sm font-medium border border-gray-300 text-gray-600 hover:bg-gray-50 transition">
                            تعديل
                        </a>
                        <form action="{{ route('posts.destroy', $post->slug) }}" method="POST"
                              onsubmit="return confirm('هل أنت متأكد من حذف هذا المقال؟')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="px-4 py-1.5 rounded-full text-sm font-medium border border-red-300 text-red-600 hover:bg-red-50 transition">
                                حذف
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>

        {{-- Content --}}
        <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
            {!! nl2br(e($post->content)) !!}
        </div>

        {{-- Like & Bookmark actions --}}
        <div class="mt-10 pt-6 border-t border-gray-200 flex items-center gap-4">
            @auth
                {{-- Like --}}
                <form action="{{ route('posts.like', $post) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-2 px-4 py-2 rounded-full border transition
                               {{ $isLiked ? 'bg-red-50 border-red-300 text-red-600' : 'border-gray-200 text-gray-500 hover:border-gray-400' }}">
                        <svg class="w-5 h-5" fill="{{ $isLiked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span class="font-medium text-sm">{{ $post->likes->count() }}</span>
                    </button>
                </form>

                {{-- Bookmark --}}
                <form action="{{ route('posts.bookmark', $post) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-2 px-4 py-2 rounded-full border transition
                               {{ $isBookmarked ? 'bg-yellow-50 border-yellow-300 text-yellow-600' : 'border-gray-200 text-gray-500 hover:border-gray-400' }}">
                        <svg class="w-5 h-5" fill="{{ $isBookmarked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                        </svg>
                        <span class="font-medium text-sm">{{ $isBookmarked ? 'محفوظ' : 'حفظ' }}</span>
                    </button>
                </form>
            @else
                <div class="flex items-center gap-2 text-gray-500 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    {{ $post->likes->count() }} إعجاب
                </div>
            @endauth
        </div>

        {{-- Comments Section --}}
        <div class="mt-12 pt-8 border-t border-gray-200">
            <h2 class="text-xl font-bold text-gray-900 mb-6">
                التعليقات ({{ $post->comments->count() }})
            </h2>

            @auth
                <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-8">
                    @csrf
                    <div>
                        <textarea name="body" rows="3" placeholder="اكتب تعليقاً..."
                            class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm resize-none">{{ old('body') }}</textarea>
                        @error('body') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div class="mt-2 flex justify-end">
                        <button type="submit"
                            class="px-5 py-2 bg-gray-900 text-white rounded-full text-sm font-medium hover:bg-gray-700 transition">
                            نشر التعليق
                        </button>
                    </div>
                </form>
            @else
                <div class="mb-8 p-4 bg-gray-50 rounded-lg text-sm text-gray-500 text-center">
                    <a href="{{ route('login') }}" class="text-gray-900 font-medium hover:underline">سجّل دخولك</a>
                    للمشاركة في النقاش.
                </div>
            @endauth

            {{-- Comments list --}}
            @forelse($post->comments as $comment)
                <div class="flex gap-4 py-5 border-b border-gray-100 last:border-0">
                    <div class="shrink-0 w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center text-xs font-semibold">
                        {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-baseline gap-2 mb-1">
                            <span class="font-semibold text-sm text-gray-900">{{ $comment->user->name }}</span>
                            <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-700 text-sm leading-relaxed">{{ $comment->body }}</p>
                    </div>
                    @auth
                        @if(auth()->id() === $comment->user_id)
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-gray-300 hover:text-red-500 transition" title="حذف">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            @empty
                <p class="text-gray-400 text-sm text-center py-8">لا توجد تعليقات بعد. كن أول من يعلّق!</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
