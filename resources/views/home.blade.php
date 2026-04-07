<x-app-layout>
    <x-slot name="title">اكتشف أفضل المقالات</x-slot>

    <!-- Hero -->
    <div class="bg-yellow-400 border-b border-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 flex flex-col sm:flex-row items-center justify-between gap-8">
            <div>
                <h1 class="text-5xl font-bold text-gray-900 leading-tight">Human<br>stories & ideas</h1>
                <p class="mt-3 text-lg text-gray-800">اقرأ وشارك أفضل المقالات من كتّاب مميزين.</p>
                @guest
                <a href="{{ route('register') }}" class="mt-6 inline-block px-6 py-3 bg-gray-900 text-white rounded-full font-medium hover:bg-gray-700 transition">
                    ابدأ القراءة
                </a>
                @endguest
            </div>
            <svg class="w-48 h-48 text-gray-900 opacity-20 hidden sm:block" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @forelse($posts as $post)
            @include('components.post-card', ['post' => $post])
        @empty
            <p class="text-center text-gray-500 py-20 text-lg">لا توجد مقالات بعد. كن أول من يكتب!</p>
        @endforelse

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
