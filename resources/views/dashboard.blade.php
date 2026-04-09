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
                <div style="position:relative; margin-bottom:1.5rem;">
                    <!-- Left fade + arrow -->
                    <div id="tab-left" onclick="scrollTabs(-160)"
                         style="display:none; position:absolute; left:0; top:0; bottom:1px; width:48px; z-index:2; cursor:pointer; align-items:center; justify-content:flex-start;
                                background:linear-gradient(to right, #fff 55%, transparent);">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#374151" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                    </div>
                    <!-- Right fade + arrow -->
                    <div id="tab-right" onclick="scrollTabs(160)"
                         style="display:none; position:absolute; right:0; top:0; bottom:1px; width:48px; z-index:2; cursor:pointer; align-items:center; justify-content:flex-end;
                                background:linear-gradient(to left, #fff 55%, transparent);">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#374151" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                    </div>

                    <!-- Scrollable tab strip (no scrollbar) -->
                    <div id="tab-strip" style="overflow-x:auto; scrollbar-width:none; border-bottom:1px solid #e5e7eb;"
                         onscroll="updateTabArrows()">
                        <style>#tab-strip::-webkit-scrollbar{display:none}</style>
                        <div style="display:flex; font-size:0.875rem; font-weight:500; gap:0; white-space:nowrap;">
                            <a href="{{ route('dashboard') }}"
                               style="padding:0.6rem 1rem; display:inline-block; border-bottom:2px solid {{ !request('category') ? '#111827' : 'transparent' }};
                                      color:{{ !request('category') ? '#111827' : '#6b7280' }}; font-weight:{{ !request('category') ? '600' : '400' }};
                                      text-decoration:none; transition:color .15s;"
                               onmouseover="if(!this.style.borderBottomColor.includes('111'))this.style.color='#374151'"
                               onmouseout="if(!this.style.borderBottomColor.includes('111'))this.style.color='#6b7280'">
                                For you
                            </a>
                            @foreach($categories as $category)
                            <a href="{{ route('dashboard', ['category' => $category->id]) }}"
                               style="padding:0.6rem 1rem; display:inline-block; border-bottom:2px solid {{ request('category') == $category->id ? '#111827' : 'transparent' }};
                                      color:{{ request('category') == $category->id ? '#111827' : '#6b7280' }}; font-weight:{{ request('category') == $category->id ? '600' : '400' }};
                                      text-decoration:none; transition:color .15s;"
                               onmouseover="if(!this.style.borderBottomColor.includes('111'))this.style.color='#374151'"
                               onmouseout="if(!this.style.borderBottomColor.includes('111'))this.style.color='#6b7280'">
                                {{ $category->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <script>
                    const strip = document.getElementById('tab-strip');
                    const btnL  = document.getElementById('tab-left');
                    const btnR  = document.getElementById('tab-right');

                    function updateTabArrows() {
                        const atStart = strip.scrollLeft <= 4;
                        const atEnd   = strip.scrollLeft + strip.clientWidth >= strip.scrollWidth - 4;
                        btnL.style.display = atStart ? 'none'  : 'flex';
                        btnR.style.display = atEnd   ? 'none'  : 'flex';
                    }
                    function scrollTabs(by) {
                        strip.scrollBy({ left: by, behavior: 'smooth' });
                    }

                    // Scroll active tab into view on load
                    document.addEventListener('DOMContentLoaded', () => {
                        updateTabArrows();
                        const active = strip.querySelector('[style*="border-bottom:2px solid #111"]');
                        if (active) active.scrollIntoView({ inline: 'nearest', block: 'nearest' });
                        // Show right arrow if overflowing
                        if (strip.scrollWidth > strip.clientWidth) btnR.style.display = 'flex';
                    });
                </script>

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
