<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex gap-8">

            {{-- Main feed --}}
            <div class="flex-1 min-w-0">

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Category tabs -->
                <div class="border-b border-gray-200 mb-6 overflow-x-auto">
                    <div class="flex text-sm font-medium gap-0.5 pb-0">
                        <a href="{{ route('dashboard') }}"
                           class="px-4 py-2.5 whitespace-nowrap border-b-2 transition
                                  {{ !request('category') ? 'border-gray-900 text-gray-900 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                            For you
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ route('dashboard', ['category' => $category->id]) }}"
                               class="px-4 py-2.5 whitespace-nowrap border-b-2 transition
                                      {{ request('category') == $category->id ? 'border-gray-900 text-gray-900 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Posts -->
                @forelse($posts as $post)
                    @include('components.post-card', ['post' => $post])
                @empty
                    <p class="text-center text-gray-400 py-16">No posts in this category.</p>
                @endforelse

                <div class="mt-6">
                    {{ $posts->appends(request()->query())->links() }}
                </div>
            </div>

            {{-- Sidebar --}}
            <aside class="hidden lg:block w-72 shrink-0">
                <div class="sticky top-8 space-y-8">
                    {{-- Staff picks / recommended authors --}}
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 mb-4">Staff Picks</h3>
                        <div class="space-y-4">
                            @foreach($posts->take(3) as $pick)
                                <div class="flex gap-3">
                                    <div class="w-7 h-7 rounded-full bg-emerald-600 text-white flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">
                                        {{ strtoupper(substr($pick->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-gray-700">{{ $pick->user->name }}</p>
                                        <a href="{{ route('posts.show', $pick->slug) }}" class="text-sm font-semibold text-gray-900 hover:text-gray-600 transition line-clamp-2 leading-tight mt-0.5 block">
                                            {{ $pick->title }}
                                        </a>
                                        <p class="text-xs text-gray-400 mt-0.5">{{ $pick->reading_time }} min read</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    {{-- Write CTA --}}
                    <div class="bg-gray-50 rounded-xl p-5">
                        <p class="text-sm text-gray-700 font-medium mb-1">Writing on Medium</p>
                        <p class="text-xs text-gray-500 mb-3">New to writing? Start your first story today.</p>
                        <a href="{{ route('posts.create') }}"
                           class="inline-block px-4 py-2 bg-gray-900 text-white text-xs font-semibold rounded-full hover:bg-gray-700 transition">
                            Start writing
                        </a>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</x-app-layout>
