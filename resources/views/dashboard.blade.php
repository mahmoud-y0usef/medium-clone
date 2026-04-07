<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Category tabs -->
            <div class="bg-white shadow-sm rounded-lg mb-6 overflow-x-auto">
                <div class="flex text-sm font-medium text-gray-500 px-4 py-3 gap-1">
                    <a href="{{ route('dashboard') }}"
                       class="px-3 py-1.5 rounded-full whitespace-nowrap transition
                              {{ !request('category') ? 'bg-gray-900 text-white' : 'hover:bg-gray-100 text-gray-600' }}">
                        الكل
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('dashboard', ['category' => $category->id]) }}"
                           class="px-3 py-1.5 rounded-full whitespace-nowrap transition
                                  {{ request('category') == $category->id ? 'bg-gray-900 text-white' : 'hover:bg-gray-100 text-gray-600' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Posts -->
            <div class="bg-white shadow-sm rounded-lg px-6">
                @forelse($posts as $post)
                    @include('components.post-card', ['post' => $post])
                @empty
                    <p class="text-center text-gray-400 py-16">لا توجد مقالات في هذه الفئة.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $posts->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
