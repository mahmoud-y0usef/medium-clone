<x-app-layout>
    <x-slot name="title">Discover great stories</x-slot>

    <!-- Hero -->
    <div class="bg-yellow-300 border-b-2 border-gray-900">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 flex flex-col sm:flex-row items-center justify-between gap-10">
            <div>
                <h1 class="text-6xl font-bold text-gray-900 leading-none tracking-tight">Human<br>stories &amp;<br>ideas</h1>
                <p class="mt-4 text-lg text-gray-700 max-w-sm">Read and share great ideas from remarkable writers.</p>
                @guest
                <a href="{{ route('register') }}" class="mt-6 inline-block px-7 py-3 bg-gray-900 text-white rounded-full font-medium hover:bg-gray-700 transition text-sm">
                    Start reading
                </a>
                @endguest
            </div>
            <div class="hidden sm:block text-gray-900 opacity-10">
                <svg width="200" height="200" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex gap-8">
        {{-- Main feed --}}
        <div class="flex-1 min-w-0">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @forelse($posts as $post)
                @include('components.post-card', ['post' => $post])
            @empty
                <p class="text-center text-gray-500 py-20 text-lg">No posts yet. Be the first to write!</p>
            @endforelse

            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </div>

        {{-- Sidebar --}}
        <aside class="hidden lg:block w-72 shrink-0">
            <div class="sticky top-8">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-4">Trending on Medium</h3>
                <div class="space-y-5">
                    @foreach($posts->take(5) as $i => $trending)
                        <div class="flex gap-4 items-start">
                            <span class="text-2xl font-bold text-gray-200 leading-none shrink-0 w-6">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <div>
                                <div class="flex items-center gap-1.5 mb-0.5">
                                    <div class="w-5 h-5 rounded-full bg-emerald-600 text-white flex items-center justify-center text-[10px] font-bold">
                                        {{ strtoupper(substr($trending->user->name, 0, 1)) }}
                                    </div>
                                    <span class="text-xs font-medium text-gray-600">{{ $trending->user->name }}</span>
                                </div>
                                <a href="{{ route('posts.show', $trending->slug) }}" class="text-sm font-bold text-gray-900 hover:text-gray-600 transition leading-tight line-clamp-2 block">
                                    {{ $trending->title }}
                                </a>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $trending->reading_time }} min read</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                @guest
                    <div class="mt-8 p-5 border border-gray-200 rounded-xl">
                        <p class="text-sm font-semibold text-gray-900 mb-1">Get unlimited access</p>
                        <p class="text-xs text-gray-500 mb-3">Read the best stories from remarkable writers.</p>
                        <a href="{{ route('register') }}" class="block text-center px-4 py-2 bg-gray-900 text-white text-xs font-semibold rounded-full hover:bg-gray-700 transition">
                            Sign up — it's free
                        </a>
                    </div>
                @endguest
            </div>
        </aside>
    </div>
</x-app-layout>
