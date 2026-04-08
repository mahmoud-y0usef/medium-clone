<x-app-layout>
    <x-slot name="title">{{ $user->name }}</x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        {{-- Profile header --}}
        <div class="flex items-start gap-6 mb-10 pb-8 border-b border-gray-200">
            <div class="w-20 h-20 rounded-full bg-green-600 text-white flex items-center justify-center text-3xl font-bold shrink-0">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                <div class="flex items-center gap-4 mt-2 text-sm text-gray-500">
                    <span>{{ $user->followers()->count() }} followers</span>
                    <span>{{ $user->following()->count() }} following</span>
                    <span>{{ $user->posts()->whereNotNull('published_at')->count() }} stories</span>
                </div>
                @auth
                    @if(auth()->id() !== $user->id)
                        <form action="{{ route('users.follow', $user) }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit"
                                class="px-5 py-2 rounded-full text-sm font-medium border transition
                                       {{ $isFollowing
                                          ? 'border-gray-300 text-gray-600 hover:bg-gray-50'
                                          : 'bg-gray-900 text-white border-gray-900 hover:bg-gray-700' }}">
                                {{ $isFollowing ? 'Unfollow' : 'Follow' }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('posts.create') }}"
                           class="mt-4 inline-block px-5 py-2 bg-gray-900 text-white rounded-full text-sm font-medium hover:bg-gray-700 transition">
                            + New Story
                        </a>
                    @endif
                @endauth
            </div>
        </div>

        {{-- Posts --}}
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Stories by {{ $user->name }}</h2>

        @forelse($posts as $post)
            @include('components.post-card', ['post' => $post])
        @empty
            <p class="text-center text-gray-400 py-16">No published stories yet.</p>
        @endforelse

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
