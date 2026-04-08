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
                    <div style="background:#f9fafb; border-radius:0.75rem; padding:1.25rem;">
                        <p style="font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.25rem;">Writing on Medium</p>
                        <p style="font-size:0.75rem; color:#6b7280; margin-bottom:0.9rem;">New to writing? Start your first story today.</p>
                        <a href="{{ route('posts.create') }}"
                           style="display:inline-block; padding:0.45rem 1rem; background:#111827; color:#fff; border-radius:9999px; font-size:0.75rem; font-weight:600; text-decoration:none;">
                            Start writing
                        </a>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</x-app-layout>
