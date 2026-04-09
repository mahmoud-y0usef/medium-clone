<x-app-layout>
    <x-slot name="title">Following</x-slot>

    <div style="max-width:740px; margin:0 auto; padding:3rem 1.5rem;">
        <h1 style="font-family:Georgia,serif; font-size:2rem; font-weight:700; color:#111827; margin:0 0 2rem;">Following</h1>

        @forelse($posts as $post)
            @include('components.post-card', ['post' => $post])
        @empty
        <div style="text-align:center; padding:5rem 0;">
            <p style="font-weight:600; font-size:1.05rem; color:#111827; margin-bottom:0.5rem;">No followed writers</p>
            <p style="color:#9ca3af; font-size:0.9rem; margin-bottom:1.5rem;">Stories from writers you follow will be shown here.</p>
            <a href="{{ route('search') }}" style="font-size:0.9rem; color:#111827; text-decoration:underline;">Find writers to follow</a>
        </div>
        @endforelse

        <div style="margin-top:2rem;">{{ $posts->links() }}</div>
    </div>
</x-app-layout>
