<x-app-layout>
    <x-slot name="title">نتائج البحث{{ $query ? ' عن: ' . $query : '' }}</x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        {{-- Search form --}}
        <form action="{{ route('search') }}" method="GET" class="mb-8">
            <div class="flex gap-3">
                <x-text-input type="text" name="q" value="{{ $query }}"
                    placeholder="ابحث عن مقالات أو كتّاب..."
                    class="flex-1" autofocus />
                <button type="submit"
                    class="px-5 py-2 bg-gray-900 text-white rounded-full font-medium hover:bg-gray-700 transition">
                    بحث
                </button>
            </div>
        </form>

        @if($query)
            {{-- Users results --}}
            @if($users->isNotEmpty())
                <div class="mb-8">
                    <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">كتّاب</h2>
                    <div class="bg-white rounded-lg shadow-sm divide-y divide-gray-100">
                        @foreach($users as $user)
                            <a href="{{ route('users.show', $user) }}"
                               class="flex items-center gap-4 px-4 py-3 hover:bg-gray-50 transition">
                                <div class="w-9 h-9 rounded-full bg-green-600 text-white flex items-center justify-center font-semibold shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900 text-sm">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $user->posts()->whereNotNull('published_at')->count() }} مقال</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Posts results --}}
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">
                مقالات
                @if($posts instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    ({{ $posts->total() }})
                @endif
            </h2>

            @forelse($posts as $post)
                @include('components.post-card', ['post' => $post])
            @empty
                <div class="text-center py-16 text-gray-400">
                    <p>لا توجد نتائج تطابق "<strong class="text-gray-600">{{ $query }}</strong>"</p>
                </div>
            @endforelse

            @if($posts instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="mt-6">{{ $posts->links() }}</div>
            @endif
        @else
            <p class="text-center text-gray-400 py-16">أدخل كلمة للبحث.</p>
        @endif
    </div>
</x-app-layout>
