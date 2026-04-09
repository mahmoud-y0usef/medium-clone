<x-editor-layout>
<x-slot name="title">New Story – Medium</x-slot>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.bubble.css" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; }
  body { background: #fff; }

  /* ── Top bar ── */
  #editor-topbar {
    position: fixed; top: 0; left: 0; right: 0; z-index: 100;
    height: 57px; background: #fff; border-bottom: 1px solid #f0eeeb;
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 1.75rem;
  }
  .topbar-logo { font-family:'Playfair Display',Georgia,serif; font-size:1.4rem; font-weight:700; color:#111827; text-decoration:none; }
  .topbar-right { display:flex; align-items:center; gap:0.75rem; }
  .btn-publish-top {
    padding:.45rem 1.2rem; background:#1a8917; color:#fff;
    border-radius:9999px; font-size:.85rem; font-weight:600;
    border:none; cursor:pointer; font-family:inherit; transition:background .15s;
  }
  .btn-publish-top:hover { background:#157013; }
  .btn-draft-top {
    padding:.45rem 1rem; background:transparent; border:none;
    color:#6b7280; font-size:.85rem; cursor:pointer; font-weight:500; font-family:inherit;
  }
  .btn-draft-top:hover { color:#111827; }

  /* ── Write area ── */
  #write-area {
    max-width: 740px; margin: 0 auto;
    padding: 80px 1.5rem 200px;
    position: relative;
  }
  #story-title {
    width:100%; border:none; outline:none; resize:none; overflow:hidden;
    font-family:'Playfair Display',Georgia,serif;
    font-size:2.6rem; font-weight:700; line-height:1.22; color:#111827;
    background:transparent; padding:0; margin-bottom:.25rem; display:block;
  }
  #story-title::placeholder { color:#d1d5db; }
  #title-divider { border:none; border-top:1px solid #e8e4de; margin:1rem 0 1.5rem; }

  /* Quill bubble */
  #quill-editor .ql-editor {
    padding:0; min-height:420px;
    font-family:Georgia,'Times New Roman',serif;
    font-size:1.15rem; line-height:1.85; color:#242424;
  }
  #quill-editor .ql-editor.ql-blank::before {
    font-style:italic; color:#b0aaa0; left:0;
    font-family:Georgia,serif; font-size:1.15rem;
  }
  .ql-bubble .ql-tooltip { border-radius:6px; font-family:'Figtree',sans-serif; }

  /* Inline images in editor */
  #quill-editor .ql-editor img {
    max-width:100%; height:auto; display:block;
    margin:1.5rem auto; border-radius:.4rem;
  }

  /* ── Floating + button ── */
  #plus-btn {
    position:absolute; left:-52px;
    width:32px; height:32px; border-radius:50%;
    border:1.5px solid #b2b0ad; background:#fff;
    display:flex; align-items:center; justify-content:center;
    cursor:pointer; transition:border-color .15s, transform .15s;
    font-size:1.3rem; color:#b2b0ad; line-height:1;
    user-select:none; visibility:hidden; opacity:0; top:120px;
  }
  #plus-btn.visible { visibility:visible; opacity:1; }
  #plus-btn.open { transform:rotate(45deg); border-color:#111827; color:#111827; }

  /* ── Plus menu ── */
  #plus-menu {
    position:absolute; left:-155px;
    display:flex; align-items:center; gap:.4rem;
    background:#fff; border:1px solid #e5e7eb;
    border-radius:9999px; padding:.25rem .5rem;
    box-shadow:0 2px 10px rgba(0,0,0,.09);
    opacity:0; visibility:hidden; transition:opacity .15s; top:120px;
  }
  #plus-menu.open { opacity:1; visibility:visible; }
  #plus-menu button {
    width:32px; height:32px; border-radius:50%;
    border:1.5px solid #b2b0ad; background:#fff; cursor:pointer;
    display:flex; align-items:center; justify-content:center;
    transition:border-color .15s;
  }
  #plus-menu button:hover { border-color:#111827; }

  /* ── Publish panel ── */
  #publish-backdrop { display:none; position:fixed; inset:0; background:rgba(0,0,0,.42); z-index:200; }
  #publish-panel {
    position:fixed; top:0; right:-500px; width:min(440px,100vw);
    height:100vh; background:#fff; z-index:201; overflow-y:auto;
    box-shadow:-4px 0 24px rgba(0,0,0,.12);
    transition:right .25s ease; padding:2rem 2rem 3rem;
  }
  #publish-panel.open { right:0; }
  #panel-close { position:absolute; top:1.25rem; right:1.25rem; background:none; border:none; font-size:1.4rem; color:#9ca3af; cursor:pointer; }
  #panel-close:hover { color:#111827; }
  #publish-panel h2 { font-family:Georgia,serif; font-size:1.25rem; font-weight:600; margin:0 0 .25rem; color:#111827; }
  .panel-sub { font-size:.82rem; color:#6b7280; margin:0 0 2rem; }
  .panel-label { font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:.07em; color:#6b7280; margin-bottom:.4rem; display:block; }
  .panel-input {
    width:100%; border:1px solid #e5e7eb; border-radius:.5rem;
    padding:.6rem .85rem; font-size:.9rem; color:#111827;
    outline:none; font-family:inherit; background:#fff; margin-bottom:1.25rem;
  }
  .panel-input:focus { border-color:#111827; }
  .panel-select { appearance:none; -webkit-appearance:none; cursor:pointer;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7280' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat:no-repeat; background-position:right .85rem center; padding-right:2.5rem; }
  #cover-preview { display:none; width:100%; height:175px; object-fit:cover; border-radius:.5rem; margin-bottom:1rem; }
  #cover-preview.show { display:block; }
  .btn-publish-now {
    width:100%; padding:.8rem; background:#111827; color:#fff;
    border-radius:9999px; font-size:.95rem; font-weight:600;
    border:none; cursor:pointer; font-family:inherit; margin-bottom:.75rem;
  }
  .btn-publish-now:hover { background:#1a8917; }
  .btn-save-panel {
    width:100%; padding:.8rem; background:transparent; color:#6b7280;
    border:1px solid #e5e7eb; border-radius:9999px; font-size:.95rem;
    font-weight:500; cursor:pointer; font-family:inherit;
  }
  .btn-save-panel:hover { border-color:#111827; color:#111827; }
</style>
@endpush

{{-- Hidden form (submitted programmatically) --}}
<form id="story-form" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="title"       id="f-title">
  <input type="hidden" name="content"     id="f-content">
  <input type="hidden" name="category_id" id="f-category">
  <input type="hidden" name="tags"        id="f-tags">
  <input type="hidden" name="publish"     id="f-publish" value="">
</form>

{{-- Top bar --}}
<div id="editor-topbar">
  <a href="{{ route('dashboard') }}" class="topbar-logo">Medium</a>
  <div class="topbar-right">
    <button class="btn-publish-top" onclick="openPublishPanel()">Publish</button>
    <button class="btn-draft-top"   onclick="saveDraft()">Save draft</button>
    <a href="{{ route('dashboard') }}" style="font-size:1.2rem; color:#9ca3af; text-decoration:none; line-height:1;">&times;</a>
  </div>
</div>

{{-- Write area --}}
<div id="write-area">
  {{-- Floating + button --}}
  <div id="plus-btn" onclick="togglePlusMenu()" title="Add media">+</div>
  <div id="plus-menu">
    <button title="Insert image" onclick="triggerImageUpload()">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/>
        <polyline points="21,15 16,10 5,21"/>
      </svg>
    </button>
    <button title="Insert divider" onclick="insertDivider()">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round">
        <line x1="3" y1="12" x2="21" y2="12"/>
      </svg>
    </button>
  </div>
  <input type="file" id="inline-image-input" accept="image/*" style="display:none" onchange="handleInlineImage(this)">

  {{-- Title --}}
  <textarea id="story-title" rows="1" placeholder="Title" autofocus oninput="autoResizeTitle(this)"></textarea>
  <hr id="title-divider">

  {{-- Quill body --}}
  <div id="quill-editor"></div>
</div>

{{-- Publish panel --}}
<div id="publish-backdrop" onclick="closePublishPanel()"></div>
<div id="publish-panel">
  <button id="panel-close" onclick="closePublishPanel()">&times;</button>
  <h2>Publish your story</h2>
  <p class="panel-sub">Review your settings, then publish.</p>

  <span class="panel-label">Cover image (optional)</span>
  <img id="cover-preview" src="" alt="">
  <label style="display:block; margin-bottom:1.25rem;">
    <span style="display:inline-flex; align-items:center; gap:.5rem; padding:.5rem .9rem; border:1px solid #e5e7eb; border-radius:.5rem; cursor:pointer; font-size:.85rem; color:#374151; transition:border-color .15s;"
          onmouseover="this.style.borderColor='#111827'" onmouseout="this.style.borderColor='#e5e7eb'">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
      Choose cover image
    </span>
    <input type="file" name="image" id="panel-image-input" accept="image/*"
           style="display:none" form="story-form" onchange="previewCover(this)">
  </label>

  <span class="panel-label">Category</span>
  <select id="panel-category" class="panel-input panel-select">
    <option value="">— Select category —</option>
    @foreach($categories as $cat)
      <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
    @endforeach
  </select>

  <span class="panel-label">Tags <span style="font-weight:400;text-transform:none;letter-spacing:0;color:#9ca3af;">(comma-separated)</span></span>
  <input type="text" id="panel-tags" class="panel-input" placeholder="e.g. technology, design, life">

  @if($errors->any())
  <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:.5rem;padding:.6rem .85rem;font-size:.8rem;color:#dc2626;margin-bottom:1rem;">
    @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
  </div>
  @endif

  <button class="btn-publish-now" onclick="submitStory(true)">Publish now</button>
  <button class="btn-save-panel"  onclick="submitStory(false)">Save as draft</button>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>
<script>
// ── Register divider blot BEFORE Quill init ──
const BlockEmbed = Quill.import('blots/block/embed');
class DividerBlot extends BlockEmbed {}
DividerBlot.blotName = 'divider';
DividerBlot.tagName  = 'hr';
Quill.register(DividerBlot);

// ── Quill init ──
const quill = new Quill('#quill-editor', {
  theme: 'bubble',
  placeholder: 'Tell your story…',
  modules: {
    toolbar: [
      [{ header: [1, 2, 3, false] }],
      ['bold', 'italic', 'underline'],
      ['blockquote', 'code-block'],
      [{ list: 'ordered' }, { list: 'bullet' }],
      ['link', 'image'],
      ['clean']
    ]
  }
});
quill.getModule('toolbar').addHandler('image', () => triggerImageUpload());

// Pre-fill on validation failure
@if(old('title'))
document.getElementById('story-title').value = @json(old('title'));
autoResizeTitle(document.getElementById('story-title'));
@endif
@if(old('content'))
quill.clipboard.dangerouslyPasteHTML(@json(old('content')));
@endif
@if(old('category_id'))
document.getElementById('panel-category').value = @json(old('category_id'));
@endif
@if(old('tags'))
document.getElementById('panel-tags').value = @json(old('tags'));
@endif

// ── Title auto-resize ──
function autoResizeTitle(el) {
  el.style.height = 'auto';
  el.style.height = el.scrollHeight + 'px';
}

// ── Floating + button ──
const plusBtn  = document.getElementById('plus-btn');
const plusMenu = document.getElementById('plus-menu');

quill.on('editor-change', () => {
  const sel = quill.getSelection();
  if (!sel) return;
  const [line] = quill.getLine(sel.index);
  const text = line ? line.domNode.textContent : '';
  if (text.trim() === '') {
    const b        = quill.getBounds(sel.index);
    const editorEl = document.getElementById('quill-editor');
    const areaEl   = document.getElementById('write-area');
    const offset   = editorEl.getBoundingClientRect().top - areaEl.getBoundingClientRect().top;
    const top = Math.round(offset + b.top + b.height / 2 - 16) + 'px';
    plusBtn.style.top  = top;
    plusMenu.style.top = top;
    plusBtn.classList.add('visible');
  } else {
    plusBtn.classList.remove('visible');
    closePlusMenu();
  }
});

function togglePlusMenu() {
  plusBtn.classList.toggle('open');
  plusMenu.classList.toggle('open');
}
function closePlusMenu() {
  plusBtn.classList.remove('open');
  plusMenu.classList.remove('open');
}

// ── Inline image (base64) ──
function triggerImageUpload() {
  closePlusMenu();
  document.getElementById('inline-image-input').click();
}
function handleInlineImage(input) {
  if (!input.files || !input.files[0]) return;
  const reader = new FileReader();
  reader.onload = e => {
    const range = quill.getSelection(true);
    quill.insertEmbed(range.index, 'image', e.target.result, Quill.sources.USER);
    quill.setSelection(range.index + 1, Quill.sources.SILENT);
  };
  reader.readAsDataURL(input.files[0]);
  input.value = '';
}

// ── Divider ──
function insertDivider() {
  closePlusMenu();
  const range = quill.getSelection(true);
  quill.insertEmbed(range.index, 'divider', true, Quill.sources.USER);
  quill.setSelection(range.index + 1, Quill.sources.SILENT);
}

// ── Cover preview ──
function previewCover(input) {
  if (!input.files || !input.files[0]) return;
  const prev = document.getElementById('cover-preview');
  prev.src = URL.createObjectURL(input.files[0]);
  prev.classList.add('show');
}

// ── Publish panel ──
function openPublishPanel() {
  document.getElementById('publish-backdrop').style.display = 'block';
  document.getElementById('publish-panel').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closePublishPanel() {
  document.getElementById('publish-backdrop').style.display = 'none';
  document.getElementById('publish-panel').classList.remove('open');
  document.body.style.overflow = '';
}

// ── Submit ──
function submitStory(publish) {
  const title = document.getElementById('story-title').value.trim();
  document.getElementById('f-title').value    = title || 'Untitled';
  document.getElementById('f-content').value  = quill.getSemanticHTML();
  document.getElementById('f-category').value = document.getElementById('panel-category').value;
  document.getElementById('f-tags').value     = document.getElementById('panel-tags').value;
  document.getElementById('f-publish').value  = publish ? '1' : '';

  // Move real file input into the form
  const fi = document.getElementById('panel-image-input');
  document.getElementById('story-form').appendChild(fi);

  document.getElementById('story-form').submit();
}
function saveDraft() {
  document.getElementById('f-title').value    = document.getElementById('story-title').value.trim() || 'Untitled';
  document.getElementById('f-content').value  = quill.getSemanticHTML();
  document.getElementById('f-category').value = '';
  document.getElementById('f-tags').value     = '';
  document.getElementById('f-publish').value  = '';
  document.getElementById('story-form').submit();
}

@if($errors->any())
document.addEventListener('DOMContentLoaded', () => openPublishPanel());
@endif
</script>
@endpush

</x-editor-layout>
