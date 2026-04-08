<x-app-layout>
    <x-slot name="title">Edit: {{ $post->title }}</x-slot>

    {{-- Top action bar --}}
    <div style="position:sticky; top:0; z-index:40; border-bottom:1px solid #e5e7eb; background:#fff; padding:0.7rem 1.5rem; display:flex; align-items:center; justify-content:space-between; gap:1rem;">
        <span style="font-size:0.9rem; color:#9ca3af; font-style:italic;">Edit Story</span>
        <div style="display:flex; align-items:center; gap:0.75rem;">
            <button type="submit" form="edit-form" name="publish" value="1"
                style="padding:0.45rem 1.25rem; background:#1a8917; color:#fff; border-radius:9999px; font-size:0.85rem; font-weight:600; border:none; cursor:pointer;">
                {{ $post->published_at ? 'Save changes' : 'Publish' }}
            </button>
            @unless($post->published_at)
            <button type="submit" form="edit-form"
                style="padding:0.45rem 1rem; color:#6b7280; font-size:0.85rem; background:transparent; border:none; cursor:pointer; font-weight:500;">
                Save draft
            </button>
            @endunless
            <a href="{{ route('posts.show', $post->slug) }}" style="font-size:1rem; color:#9ca3af; text-decoration:none; line-height:1;">&times;</a>
        </div>
    </div>

    <div style="max-width:52rem; margin:0 auto; padding:3rem 1.5rem 6rem;">
        <form id="edit-form" action="{{ route('posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:1.5rem;">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <input id="title" name="title" type="text"
                    value="{{ old('title', $post->title) }}"
                    placeholder="Title"
                    autofocus
                    style="display:block; width:100%; border:none; border-bottom:1px solid #e5e7eb; outline:none; font-size:2.5rem; font-weight:700; color:#111827; padding:0.5rem 0; background:transparent; font-family:Georgia,serif;"
                    onfocus="this.style.borderBottomColor='#111827'"
                    onblur="this.style.borderBottomColor='#e5e7eb'">
                <x-input-error :messages="$errors->get('title')" class="mt-1" />
            </div>

            {{-- Category + Tags --}}
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.25rem;">
                <div>
                    <label for="category_id" style="display:block; font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:#6b7280; margin-bottom:0.4rem;">Category</label>
                    <select id="category_id" name="category_id"
                        style="width:100%; border:1px solid #d1d5db; border-radius:0.5rem; padding:0.5rem 0.75rem; font-size:0.875rem; color:#374151; background:#fff; outline:none;">
                        <option value="">— Select —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-1" />
                </div>
                <div>
                    <label for="tags" style="display:block; font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:#6b7280; margin-bottom:0.4rem;">Tags <span style="color:#9ca3af; font-weight:400; text-transform:none; letter-spacing:0;">(comma-separated)</span></label>
                    <input id="tags" name="tags" type="text"
                        value="{{ old('tags', $currentTags) }}"
                        placeholder="technology, design, life…"
                        style="display:block; width:100%; border:1px solid #d1d5db; border-radius:0.5rem; padding:0.5rem 0.75rem; font-size:0.875rem; color:#374151; background:#fff; outline:none;">
                    <x-input-error :messages="$errors->get('tags')" class="mt-1" />
                </div>
            </div>

            {{-- Cover Image --}}
            <div>
                @if($post->image)
                    <div style="margin-bottom:0.75rem;">
                        <img src="{{ $post->image_url }}" alt="Current cover"
                             style="height:8rem; width:auto; border-radius:0.5rem; object-fit:cover;">
                        <p style="font-size:0.75rem; color:#9ca3af; margin-top:0.25rem;">Current image — upload a new one to replace it</p>
                    </div>
                @endif
                <label for="image" style="display:block; font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:#6b7280; margin-bottom:0.4rem;">Cover Image <span style="color:#9ca3af; font-weight:400; text-transform:none; letter-spacing:0;">(optional)</span></label>
                <input id="image" name="image" type="file" accept="image/*"
                    style="display:block; width:100%; font-size:0.875rem; color:#6b7280; cursor:pointer;" />
                <x-input-error :messages="$errors->get('image')" class="mt-1" />
            </div>

            {{-- Content --}}
            <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:#6b7280; margin-bottom:0.4rem;">Content</label>
                <div id="quill-editor" style="border-radius:0 0 0.5rem 0.5rem;"></div>
                <textarea id="content" name="content" style="display:none;">{{ old('content', $post->content) }}</textarea>
                <x-input-error :messages="$errors->get('content')" class="mt-1" />
            </div>
        </form>
    </div>
</x-app-layout>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css" rel="stylesheet">
<style>
    #quill-editor .ql-editor { min-height: 420px; font-family: Georgia, 'Times New Roman', serif; font-size: 1.05rem; line-height: 1.9; color: #1f2937; }
    #quill-editor .ql-editor.ql-blank::before { font-style: italic; color: #9ca3af; font-family: Georgia, serif; }
    #quill-editor .ql-toolbar { border: 1px solid #e5e7eb; border-radius: 0.5rem 0.5rem 0 0; background: #fafafa; }
    #quill-editor .ql-container { border: 1px solid #e5e7eb; border-top: none; border-radius: 0 0 0.5rem 0.5rem; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>
<script>
    const quill = new Quill('#quill-editor', {
        theme: 'snow',
        placeholder: 'Tell your story…',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ list: 'ordered' }, { list: 'bullet' }],
                [{ indent: '-1' }, { indent: '+1' }],
                [{ align: [] }],
                ['blockquote', 'code-block'],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    // Pre-fill editor with existing content
    const existingContent = document.getElementById('content').value;
    if (existingContent) quill.clipboard.dangerouslyPasteHTML(existingContent);

    // Copy Quill HTML into hidden textarea on form submit
    document.getElementById('edit-form').addEventListener('submit', function () {
        document.getElementById('content').value = quill.getSemanticHTML();
    });
</script>
@endpush
