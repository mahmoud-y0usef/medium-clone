<x-public-layout>
    <div style="min-height:100vh; background:#fff; display:flex; flex-direction:column; align-items:center; justify-content:center; padding:3rem 1.5rem;">

        <!-- Logo -->
        <a href="{{ route('home') }}" style="font-family:'Playfair Display',Georgia,serif; font-size:1.5rem; font-weight:700; color:#111827; text-decoration:none; margin-bottom:2.5rem; display:block; text-align:center;">
            Medium
        </a>

        <!-- Atom-ish icon -->
        <div style="width:80px; height:80px; margin-bottom:1.5rem;">
            <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%; height:100%;">
                <ellipse cx="40" cy="40" rx="36" ry="15" stroke="#111827" stroke-width="2" fill="none"/>
                <ellipse cx="40" cy="40" rx="36" ry="15" stroke="#111827" stroke-width="2" fill="none" transform="rotate(60 40 40)"/>
                <ellipse cx="40" cy="40" rx="36" ry="15" stroke="#111827" stroke-width="2" fill="none" transform="rotate(120 40 40)"/>
                <circle cx="40" cy="40" r="4" fill="#111827"/>
                <circle cx="76" cy="40" r="3" fill="#111827"/>
                <path d="M57 28 L60 24" stroke="#111827" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </div>

        <h1 style="font-family:Georgia,serif; font-size:1.75rem; font-weight:700; color:#111827; margin:0 0 0.75rem; text-align:center;">What would you like to read?</h1>
        <p style="font-size:0.95rem; color:#6b7280; margin:0 0 2.5rem; text-align:center;">Choose 3 topics or more to continue.</p>

        <form method="POST" action="{{ route('onboarding.store') }}" id="onboarding-form" style="width:100%; max-width:680px;">
            @csrf

            @php
            $topicGroups = [
                'Technology' => ['Technology','AI','Artificial Intelligence','Cybersecurity','AWS','ChatGPT','UX Design','Android','iOS','Machine Learning'],
                'Programming' => ['Programming','Python','JavaScript','Software Engineering','Web Development','Data Science','DevOps','Laravel','Flutter','React'],
                'Business' => ['Entrepreneurship','Startup','Marketing','Finance','Productivity','Leadership','Management','Investing'],
                'Writing' => ['Writing','Creativity','Storytelling','Poetry','Fiction','Journalism','Self Improvement'],
                'Science' => ['Science','Health','Wellness','Psychology','Biology','Physics','Environment','Medicine'],
                'Culture' => ['Culture','Travel','Food','Design','Art','Music','Film','Philosophy','History'],
            ];
            @endphp

            @foreach($topicGroups as $group => $topics)
            <div style="margin-bottom:2rem;">
                <p style="font-weight:700; font-size:1rem; color:#111827; margin-bottom:0.75rem;">{{ $group }}</p>
                <div style="display:flex; flex-wrap:wrap; gap:0.5rem;">
                    @foreach($topics as $topic)
                    <label style="cursor:pointer;">
                        <input type="checkbox" name="topics[]" value="{{ $topic }}" style="display:none;" onchange="updateTopic(this)">
                        <span class="topic-pill" data-topic="{{ $topic }}"
                              style="display:inline-block; padding:0.45rem 1rem; border:1px solid #d1d5db; border-radius:9999px; font-size:0.85rem; color:#374151; background:#fff; user-select:none; transition:all 0.15s;"
                              onclick="togglePill(this)">
                            {{ $topic }}
                        </span>
                    </label>
                    @endforeach
                </div>
            </div>
            @endforeach

            <div style="position:sticky; bottom:0; background:#fff; padding:1.25rem 0; border-top:1px solid #e5e7eb; margin-top:1rem; display:flex; align-items:center; justify-content:space-between;">
                <span id="count-label" style="font-size:0.875rem; color:#9ca3af;">0 topics selected</span>
                <button type="submit" id="continue-btn" disabled
                    style="padding:0.65rem 1.75rem; background:#d1fae5; color:#059669; border:none; border-radius:9999px; font-size:0.9rem; font-weight:600; cursor:not-allowed; transition:all 0.15s;">
                    Continue
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        let selected = new Set();

        function togglePill(span) {
            const topic = span.dataset.topic;
            const checkbox = span.previousElementSibling;
            if (selected.has(topic)) {
                selected.delete(topic);
                checkbox.checked = false;
                span.style.background = '#fff';
                span.style.color = '#374151';
                span.style.borderColor = '#d1d5db';
            } else {
                selected.add(topic);
                checkbox.checked = true;
                span.style.background = '#111827';
                span.style.color = '#fff';
                span.style.borderColor = '#111827';
            }
            updateCount();
        }

        function updateCount() {
            const n = selected.size;
            document.getElementById('count-label').textContent = n + ' topic' + (n !== 1 ? 's' : '') + ' selected';
            const btn = document.getElementById('continue-btn');
            if (n >= 3) {
                btn.disabled = false;
                btn.style.background = '#111827';
                btn.style.color = '#fff';
                btn.style.cursor = 'pointer';
            } else {
                btn.disabled = true;
                btn.style.background = '#d1fae5';
                btn.style.color = '#6b7280';
                btn.style.cursor = 'not-allowed';
            }
        }
    </script>
    @endpush
</x-public-layout>
