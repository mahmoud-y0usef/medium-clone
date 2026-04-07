<x-app-layout>
    <x-slot name="title">المقالات المحفوظة</x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-2xl font-bold text-gray-900 mb-8">المقالات المحفوظة</h1>

        @forelse($posts as $bookmark)
            @include('components.post-card', ['post' => $bookmark->post])
        @empty
            <div class="text-center py-20">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                </svg>
                <p class="text-gray-400">لم تحفظ أي مقال بعد.</p>
                <a href="{{ route('home') }}" class="mt-4 inline-block text-sm text-gray-900 font-medium hover:underline">
                    تصفّح المقالات
                </a>
            </div>
        @endforelse

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
