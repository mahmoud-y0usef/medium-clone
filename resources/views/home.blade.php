<x-public-layout>
    <!-- Hero -->
    <section style="border-bottom: 1px solid #d9d5cc; padding: 4rem 1.5rem 0; overflow: hidden;">
        <div style="max-width: 1280px; margin: 0 auto; display: flex; align-items: flex-end; justify-content: space-between; gap: 2rem;">
            <!-- Left text -->
            <div style="max-width: 580px; padding-bottom: 5rem;">
                <h1 style="font-family: 'Playfair Display', Georgia, serif; font-size: clamp(3.5rem, 8vw, 6.5rem); font-weight: 700; line-height: 1.05; color: #111827; margin: 0 0 1.5rem; letter-spacing: -0.02em;">
                    Human<br>stories &amp; ideas
                </h1>
                <p style="font-size: 1.15rem; color: #374151; margin: 0 0 2rem; max-width: 380px; line-height: 1.65;">
                    A place to read, write, and deepen your understanding of the world.
                </p>
                <a href="{{ route('register') }}" style="display: inline-block; background: #111827; color: #fff; padding: 0.85rem 2rem; border-radius: 9999px; font-size: 1rem; font-weight: 500; text-decoration: none;">
                    Start reading
                </a>
            </div>

            <!-- Right illustration -->
            <div style="flex-shrink: 0; width: min(460px, 44vw); align-self: flex-end;">
                <svg viewBox="0 0 460 400" xmlns="http://www.w3.org/2000/svg" style="width:100%; display:block;">
                    <!-- Green flower petals -->
                    <ellipse cx="310" cy="130" rx="90" ry="90" fill="#1a8917"/>
                    <ellipse cx="230" cy="90"  rx="75" ry="75" fill="#1a8917"/>
                    <ellipse cx="322" cy="60"  rx="68" ry="68" fill="#1a8917"/>
                    <ellipse cx="385" cy="95"  rx="62" ry="62" fill="#1a8917"/>
                    <circle  cx="305" cy="118" r="30" fill="#f7f4ed"/>
                    <!-- Green rectangle / writing panel -->
                    <rect x="215" y="245" width="195" height="140" rx="4" fill="#1a8917"/>
                    <!-- White writing hand simplified -->
                    <path d="M240 320 L370 265" stroke="white" stroke-width="13" stroke-linecap="round"/>
                    <path d="M240 345 L370 290" stroke="white" stroke-width="9" stroke-linecap="round" opacity="0.6"/>
                    <ellipse cx="235" cy="348" rx="20" ry="9" fill="white" transform="rotate(-25 235 348)"/>
                    <!-- Geometric frame lines (right side) -->
                    <line x1="430" y1="195" x2="295" y2="400" stroke="#111827" stroke-width="1.2" opacity="0.25"/>
                    <line x1="450" y1="165" x2="365" y2="400" stroke="#111827" stroke-width="1.2" opacity="0.25"/>
                    <line x1="440" y1="180" x2="275" y2="380" stroke="#111827" stroke-width="0.8" opacity="0.15"/>
                    <!-- Decorative dots / stars (left of panel) -->
                    <circle cx="175" cy="300" r="4"   fill="#111827"/>
                    <circle cx="152" cy="320" r="3"   fill="#111827"/>
                    <circle cx="185" cy="336" r="3"   fill="#111827"/>
                    <circle cx="130" cy="308" r="2.5" fill="#111827"/>
                    <circle cx="162" cy="355" r="2"   fill="#111827"/>
                    <circle cx="195" cy="310" r="2"   fill="#111827" opacity="0.5"/>
                </svg>
            </div>
        </div>
    </section>

    <!-- Post feed area -->
    <section style="max-width: 1280px; margin: 0 auto; padding: 2.5rem 1.5rem 4rem; display: flex; gap: 2.5rem;">
        <!-- Posts -->
        <div style="flex: 1; min-width: 0;">
            @forelse($posts as $post)
                @include('components.post-card', ['post' => $post])
            @empty
                <p style="color:#9ca3af; text-align:center; padding:4rem 0;">No stories yet — be the first to write!</p>
            @endforelse
            <div style="margin-top:2rem;">{{ $posts->links() }}</div>
        </div>

        <!-- Sidebar -->
        <aside style="width:280px; flex-shrink:0; display:none;" class="lg:block">
            <div style="position:sticky; top:90px;">
                <p style="font-size:0.8rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#6b7280; margin-bottom:1rem;">Recommended topics</p>
                <div style="display:flex; flex-wrap:wrap; gap:0.5rem; margin-bottom:2rem;">
                    @php $tags = ['Technology','Design','Programming','Science','Health','Business','Writing','Travel','Food','Culture','AI','Productivity']; @endphp
                    @foreach($tags as $tag)
                    <a href="{{ route('search', ['q' => $tag]) }}"
                       style="display:inline-block; padding:0.4rem 0.9rem; border:1px solid #d9d5cc; border-radius:9999px; font-size:0.8rem; color:#374151; text-decoration:none; background:#fff;"
                       onmouseover="this.style.background='#111827';this.style.color='#fff'"
                       onmouseout="this.style.background='#fff';this.style.color='#374151'">{{ $tag }}</a>
                    @endforeach
                </div>
                <hr style="border:none; border-top:1px solid #e5e7eb; margin-bottom:1.5rem;">
                <p style="font-size:0.8rem; color:#6b7280; line-height:2;">
                    <a href="{{ route('login') }}" style="color:#111827; font-weight:600; text-decoration:none;">Sign in</a> ·
                    <a href="{{ route('register') }}" style="color:#111827; font-weight:600; text-decoration:none;">Sign up</a><br>
                    <a href="#" style="color:#9ca3af; text-decoration:none;">Help</a> ·
                    <a href="#" style="color:#9ca3af; text-decoration:none;">Status</a> ·
                    <a href="#" style="color:#9ca3af; text-decoration:none;">About</a> ·
                    <a href="#" style="color:#9ca3af; text-decoration:none;">Privacy</a> ·
                    <a href="#" style="color:#9ca3af; text-decoration:none;">Terms</a>
                </p>
            </div>
        </aside>
    </section>
</x-public-layout>
