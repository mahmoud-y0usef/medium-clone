<x-public-layout>

    <!-- ===== HERO (full-page) ===== -->
    <section style="min-height: calc(100vh - 65px); background: #f7f4ed; display: flex; flex-direction: column;">

        <!-- Main hero row -->
        <div style="flex: 1; max-width: 1280px; margin: 0 auto; width: 100%; padding: 0 3rem; display: flex; align-items: center; justify-content: space-between; gap: 2rem; overflow: hidden;">

            <!-- Left text -->
            <div style="max-width: 560px; padding: 4rem 0;">
                <h1 style="font-family: 'Playfair Display', Georgia, serif; font-size: clamp(3.5rem, 7vw, 6rem); font-weight: 700; line-height: 1.06; color: #111827; margin: 0 0 1.5rem; letter-spacing: -0.015em;">
                    Human<br>stories &amp; ideas
                </h1>
                <p style="font-size: 1.1rem; color: #374151; margin: 0 0 2.25rem; line-height: 1.65; max-width: 360px;">
                    A place to read, write, and deepen your understanding of the world.
                </p>
                <button onclick="openModal('register')"
                    style="display: inline-block; background: #111827; color: #fff; padding: 0.85rem 2rem; border-radius: 9999px; font-size: 1rem; font-weight: 500; text-decoration: none; border: none; cursor: pointer; font-family: inherit;">
                    Start reading
                </button>
            </div>

            <!-- Right illustration — pixel-faithful recreation -->
            <div style="flex-shrink:0; width: min(500px, 46vw); position: relative; align-self: flex-end; overflow: visible;">
                <svg viewBox="0 0 500 480" xmlns="http://www.w3.org/2000/svg" style="width:100%; display:block; overflow:visible;">

                    <!-- ── FLOWER (5 organic petals, hand-stamp style) ── -->
                    <g id="flower">
                        <!-- petal top -->
                        <path d="M245,60 C230,20 200,10 195,40 C190,65 210,80 240,85 Z" fill="#1a8917"/>
                        <!-- petal top-right -->
                        <path d="M270,55 C295,20 320,25 315,55 C310,78 285,88 262,80 Z" fill="#1a8917"/>
                        <!-- petal right -->
                        <path d="M295,95 C330,80 350,100 340,125 C330,148 306,148 282,132 Z" fill="#1a8917"/>
                        <!-- petal bottom -->
                        <path d="M255,125 C265,160 250,180 228,170 C208,160 205,138 220,115 Z" fill="#1a8917"/>
                        <!-- petal left -->
                        <path d="M218,90 C185,85 170,105 182,128 C194,150 218,148 235,130 Z" fill="#1a8917"/>
                        <!-- white centre -->
                        <circle cx="247" cy="108" r="26" fill="#f7f4ed"/>
                        <!-- dark centre detail -->
                        <circle cx="247" cy="108" r="12" fill="#2d5a27" opacity="0.5"/>
                        <circle cx="247" cy="108" r="5" fill="#1a3a14"/>
                    </g>

                    <!-- ── GEOMETRIC DIAGRAM (technical drawing lines) ── -->
                    <g id="diagram" opacity="0.9">
                        <!-- main triangle-like structure -->
                        <line x1="347" y1="100" x2="480" y2="62"  stroke="#111827" stroke-width="1.2"/>
                        <line x1="347" y1="100" x2="490" y2="130" stroke="#111827" stroke-width="1.2"/>
                        <line x1="480" y1="62"  x2="490" y2="130" stroke="#111827" stroke-width="1.2"/>
                        <!-- inner lines -->
                        <line x1="347" y1="100" x2="430" y2="80"  stroke="#111827" stroke-width="0.8"/>
                        <line x1="347" y1="100" x2="460" y2="115" stroke="#111827" stroke-width="0.8"/>
                        <!-- point labels -->
                        <text x="343" y="97"  font-size="8" fill="#111827" font-family="serif">B</text>
                        <text x="474" y="60"  font-size="7" fill="#111827" font-family="serif">δ</text>
                        <text x="492" y="134" font-size="7" fill="#111827" font-family="serif">γ</text>
                        <text x="428" y="72"  font-size="7" fill="#111827" font-family="serif" font-style="italic">a</text>
                        <text x="455" y="82"  font-size="6" fill="#111827" font-family="serif" font-style="italic">a₁</text>
                        <!-- dotted arcs -->
                        <path d="M260,175 Q350,145 395,185" stroke="#111827" stroke-width="0.9" fill="none" stroke-dasharray="3,3" opacity="0.7"/>
                        <!-- point N'' -->
                        <circle cx="395" cy="185" r="2" fill="#111827"/>
                        <text x="398" y="190" font-size="7" fill="#111827" font-family="serif">N″</text>
                        <!-- extended dashed lines down to E -->
                        <line x1="395" y1="185" x2="380" y2="240" stroke="#111827" stroke-width="0.8" stroke-dasharray="3,3" opacity="0.6"/>
                        <text x="375" y="248" font-size="7" fill="#111827" font-family="serif">E</text>
                        <!-- horizontal dashed baseline -->
                        <line x1="200" y1="242" x2="450" y2="242" stroke="#111827" stroke-width="0.8" stroke-dasharray="4,4" opacity="0.5"/>
                        <text x="198" y="250" font-size="6" fill="#111827" font-family="serif">b″</text>
                        <text x="440" y="250" font-size="6" fill="#111827" font-family="serif">a″</text>
                        <!-- arrow from flower pointing to N'' -->
                        <line x1="270" y1="150" x2="370" y2="180" stroke="#111827" stroke-width="0.9" stroke-dasharray="3,3" opacity="0.6"/>
                        <polygon points="370,180 362,175 365,185" fill="#111827" opacity="0.6"/>
                        <text x="250" y="162" font-size="6" fill="#111827" font-family="serif">3</text>
                    </g>

                    <!-- ── GREEN WRITING PANEL ── -->
                    <rect x="218" y="250" width="240" height="195" fill="#1a8917"/>

                    <!-- White hand writing silhouette (simplified but recognisable) -->
                    <g id="hand" fill="white">
                        <!-- arm/wrist coming from lower-right -->
                        <path d="M430,420 C420,410 400,400 375,390 C350,378 320,368 300,360 C275,350 258,342 252,335 C246,328 248,318 258,315 C268,312 278,316 295,322 L345,340 C355,344 365,342 370,335 C375,328 372,320 363,316 L330,302 C320,298 315,290 318,282 C321,274 330,270 340,274 L380,290 C388,294 396,292 400,285 C403,278 400,270 392,266 L370,256 C362,252 358,244 362,236 C366,228 376,225 385,230 L420,248 C435,256 445,270 447,285 L450,320 C452,338 445,358 432,372 L438,445 L418,445 Z"/>
                        <!-- pencil/pen -->
                        <rect x="230" y="308" width="60" height="10" rx="4" transform="rotate(-25 246 313)"/>
                        <polygon points="228,322 222,332 238,326" fill="white"/>
                    </g>

                    <!-- ── ASTERISK / STAR SHAPES scattered around panel ── -->
                    <g id="stars" fill="#111827">
                        <!-- inside panel (black on green) -->
                        <text x="268" y="278" font-size="13" fill="#111827" text-anchor="middle">✦</text>
                        <text x="420" y="295" font-size="11" fill="#111827" text-anchor="middle">✦</text>
                        <text x="385" y="360" font-size="9"  fill="#111827" text-anchor="middle">✦</text>
                        <text x="445" y="390" font-size="11" fill="#111827" text-anchor="middle">✦</text>
                        <text x="310" y="430" font-size="10" fill="#111827" text-anchor="middle">✦</text>
                        <!-- outside left of panel -->
                        <text x="165" y="300" font-size="11" text-anchor="middle">✦</text>
                        <text x="142" y="325" font-size="9"  text-anchor="middle">✦</text>
                        <text x="185" y="350" font-size="7"  text-anchor="middle">✦</text>
                        <text x="120" y="348" font-size="6"  text-anchor="middle">✦</text>
                        <text x="155" y="368" font-size="5"  text-anchor="middle">✦</text>
                    </g>

                    <!-- ── DASHED CONSTELLATION LINE (bottom) ── -->
                    <g>
                        <path d="M35,455 Q120,420 200,435 Q280,450 360,460 Q420,465 478,448"
                              stroke="#111827" stroke-width="1.2" fill="none" stroke-dasharray="5,4" opacity="0.7"/>
                        <!-- stars along the line -->
                        <text x="35"  y="460" font-size="13" fill="#111827" text-anchor="middle">✦</text>
                        <text x="90"  y="445" font-size="10" fill="#111827" text-anchor="middle">✦</text>
                        <text x="155" y="443" font-size="8"  fill="#111827" text-anchor="middle">✦</text>
                        <text x="220" y="447" font-size="10" fill="#111827" text-anchor="middle">✦</text>
                        <text x="290" y="453" font-size="9"  fill="#111827" text-anchor="middle">✦</text>
                        <text x="360" y="458" font-size="12" fill="#111827" text-anchor="middle">✦</text>
                        <text x="420" y="452" font-size="8"  fill="#111827" text-anchor="middle">✦</text>
                        <text x="475" y="447" font-size="11" fill="#111827" text-anchor="middle">✦</text>
                    </g>

                </svg>
            </div>
        </div>

        <!-- Footer -->
        <div style="border-top: 1px solid #d9d5cc; padding: 1.5rem 3rem;">
            <div style="max-width: 1280px; margin: 0 auto; display: flex; flex-wrap: wrap; gap: 1.25rem; justify-content: center;">
                @foreach(['Help','Status','About','Careers','Press','Blog','Privacy','Rules','Terms','Text to speech'] as $link)
                <a href="#" style="font-size: 0.8rem; color: #6b7280; text-decoration: none;"
                   onmouseover="this.style.color='#111827'" onmouseout="this.style.color='#6b7280'">{{ $link }}</a>
                @endforeach
            </div>
        </div>
    </section>


    <!-- ================================================================
         MODAL — Sign up / Sign in
    ================================================================ -->
    <div id="auth-modal" onclick="if(event.target===this)closeModal()"
         style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.55); z-index:1000; align-items:center; justify-content:center;">

        <div style="background:#fff; border-radius:1rem; width:min(560px, 92vw); max-height:90vh; overflow-y:auto; position:relative; padding:2.5rem 3rem;">

            <!-- Close btn -->
            <button onclick="closeModal()"
                style="position:absolute; top:1rem; right:1.25rem; background:none; border:none; font-size:1.5rem; color:#9ca3af; cursor:pointer; line-height:1;">&times;</button>

            <!-- Logo -->
            <div style="text-align:center; margin-bottom:2rem;">
                <a href="{{ route('home') }}" style="font-family:'Playfair Display',Georgia,serif; font-size:1.5rem; font-weight:700; color:#111827; text-decoration:none;">Medium</a>
            </div>

            <!-- Tab switcher -->
            <div id="modal-title" style="font-family:Georgia,serif; font-size:1.35rem; font-weight:600; color:#111827; text-align:center; margin-bottom:1.75rem;"></div>

            <!-- Register panel -->
            <div id="panel-register">
                <form method="POST" action="{{ route('register') }}" style="display:flex; flex-direction:column; gap:0.85rem;">
                    @csrf
                    @if($errors->any())
                    <div style="background:#fef2f2; border:1px solid #fecaca; border-radius:0.5rem; padding:0.75rem 1rem; font-size:0.8rem; color:#dc2626;">
                        @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                    </div>
                    @endif

                    <input name="name" type="text" placeholder="Your name" required value="{{ old('name') }}"
                        style="width:100%; padding:0.75rem 1rem; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.9rem; color:#111827; outline:none; font-family:inherit;"
                        onfocus="this.style.borderColor='#111827'" onblur="this.style.borderColor='#d1d5db'">

                    <input name="email" type="email" placeholder="Your email" required value="{{ old('email') }}"
                        style="width:100%; padding:0.75rem 1rem; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.9rem; color:#111827; outline:none; font-family:inherit;"
                        onfocus="this.style.borderColor='#111827'" onblur="this.style.borderColor='#d1d5db'">

                    <input name="password" type="password" placeholder="Password (min 8 chars)" required
                        style="width:100%; padding:0.75rem 1rem; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.9rem; color:#111827; outline:none; font-family:inherit;"
                        onfocus="this.style.borderColor='#111827'" onblur="this.style.borderColor='#d1d5db'">

                    <input name="password_confirmation" type="password" placeholder="Confirm password" required
                        style="width:100%; padding:0.75rem 1rem; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.9rem; color:#111827; outline:none; font-family:inherit;"
                        onfocus="this.style.borderColor='#111827'" onblur="this.style.borderColor='#d1d5db'">

                    <button type="submit"
                        style="width:100%; padding:0.8rem; background:#1a8917; color:#fff; border:none; border-radius:9999px; font-size:0.95rem; font-weight:600; cursor:pointer; font-family:inherit; margin-top:0.25rem;">
                        Create account
                    </button>
                </form>

                <p style="text-align:center; font-size:0.85rem; color:#6b7280; margin-top:1.5rem;">
                    Already have an account?
                    <button onclick="switchPanel('login')" style="background:none; border:none; color:#111827; font-weight:600; cursor:pointer; text-decoration:underline; font-size:0.85rem; font-family:inherit;">Sign in</button>
                </p>
            </div>

            <!-- Login panel -->
            <div id="panel-login" style="display:none;">
                <form method="POST" action="{{ route('login') }}" style="display:flex; flex-direction:column; gap:0.85rem;">
                    @csrf
                    <x-auth-session-status class="mb-2" :status="session('status')" />

                    <input name="email" type="email" placeholder="Email" required value="{{ old('email') }}"
                        style="width:100%; padding:0.75rem 1rem; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.9rem; color:#111827; outline:none; font-family:inherit;"
                        onfocus="this.style.borderColor='#111827'" onblur="this.style.borderColor='#d1d5db'">

                    <input name="password" type="password" placeholder="Password" required
                        style="width:100%; padding:0.75rem 1rem; border:1px solid #d1d5db; border-radius:0.5rem; font-size:0.9rem; color:#111827; outline:none; font-family:inherit;"
                        onfocus="this.style.borderColor='#111827'" onblur="this.style.borderColor='#d1d5db'">

                    <div style="display:flex; align-items:center; justify-content:space-between;">
                        <label style="display:flex; align-items:center; gap:0.4rem; font-size:0.8rem; color:#6b7280; cursor:pointer;">
                            <input type="checkbox" name="remember"> Remember me
                        </label>
                        @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" style="font-size:0.8rem; color:#6b7280; text-decoration:none;" onmouseover="this.style.color='#111827'" onmouseout="this.style.color='#6b7280'">Forgot password?</a>
                        @endif
                    </div>

                    <button type="submit"
                        style="width:100%; padding:0.8rem; background:#111827; color:#fff; border:none; border-radius:9999px; font-size:0.95rem; font-weight:600; cursor:pointer; font-family:inherit; margin-top:0.25rem;">
                        Sign in
                    </button>
                </form>

                <p style="text-align:center; font-size:0.85rem; color:#6b7280; margin-top:1.5rem;">
                    No account?
                    <button onclick="switchPanel('register')" style="background:none; border:none; color:#111827; font-weight:600; cursor:pointer; text-decoration:underline; font-size:0.85rem; font-family:inherit;">Create one</button>
                </p>
            </div>

            <p style="text-align:center; font-size:0.75rem; color:#9ca3af; margin-top:1.75rem; line-height:1.6;">
                By creating an account you agree to the <a href="#" style="color:#9ca3af; text-decoration:underline;">Terms of Service</a>
                and <a href="#" style="color:#9ca3af; text-decoration:underline;">Privacy Policy</a>.
            </p>
        </div>
    </div>


    @push('scripts')
    <script>
        const modal = document.getElementById('auth-modal');
        const titles = { register: 'Join Medium.', login: 'Welcome back.' };

        function openModal(panel) {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            switchPanel(panel);
        }

        function closeModal() {
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }

        function switchPanel(panel) {
            document.getElementById('modal-title').textContent = titles[panel];
            document.getElementById('panel-register').style.display = panel === 'register' ? 'block' : 'none';
            document.getElementById('panel-login').style.display  = panel === 'login'    ? 'block' : 'none';
        }

        // Auto-open if validation errors (form was submitted)
        @if($errors->any())
            document.addEventListener('DOMContentLoaded', () => openModal('register'));
        @endif

        // Keyboard ESC
        document.addEventListener('keydown', e => { if(e.key === 'Escape') closeModal(); });
    </script>
    @endpush

</x-public-layout>
