<x-app-layout>
    <x-slot name="title">تعديل: {{ $post->title }}</x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-2xl font-bold text-gray-900 mb-8">تعديل المقال</h1>

        <form action="{{ route('posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <x-input-label for="title" value="العنوان" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                    value="{{ old('title', $post->title) }}" autofocus />
                <x-input-error :messages="$errors->get('title')" class="mt-1" />
            </div>

            {{-- Category --}}
            <div>
                <x-input-label for="category_id" value="التصنيف" />
                <select id="category_id" name="category_id"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">-- اختر تصنيفاً --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-1" />
            </div>

            {{-- Cover Image --}}
            <div>
                @if($post->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($post->image) }}" alt="Current cover"
                             class="h-32 w-auto rounded-md object-cover">
                        <p class="text-xs text-gray-500 mt-1">الصورة الحالية – ارفع صورة جديدة لاستبدالها</p>
                    </div>
                @endif
                <x-input-label for="image" value="صورة الغلاف (اختياري)" />
                <input id="image" name="image" type="file" accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer" />
                <x-input-error :messages="$errors->get('image')" class="mt-1" />
            </div>

            {{-- Tags --}}
            <div>
                <x-input-label for="tags" value="الوسوم (افصل بينها بفاصلة)" />
                <x-text-input id="tags" name="tags" type="text" class="mt-1 block w-full"
                    value="{{ old('tags', $currentTags) }}" placeholder="تقنية, برمجة, Laravel" />
                <x-input-error :messages="$errors->get('tags')" class="mt-1" />
            </div>

            {{-- Content --}}
            <div>
                <x-input-label for="content" value="المحتوى" />
                <textarea id="content" name="content" rows="18"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-base leading-relaxed">{{ old('content', $post->content) }}</textarea>
                <x-input-error :messages="$errors->get('content')" class="mt-1" />
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-4 pt-2">
                <button type="submit" name="publish" value="1"
                    class="px-6 py-2.5 bg-gray-900 text-white rounded-full font-medium hover:bg-gray-700 transition">
                    {{ $post->published_at ? 'حفظ التعديلات' : 'نشر الآن' }}
                </button>
                @if($post->published_at)
                    <button type="submit"
                        class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-full font-medium hover:bg-gray-50 transition">
                        رفع النشر (مسودة)
                    </button>
                @else
                    <button type="submit"
                        class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-full font-medium hover:bg-gray-50 transition">
                        حفظ كمسودة
                    </button>
                @endif
                <a href="{{ route('posts.show', $post->slug) }}" class="text-sm text-gray-500 hover:text-gray-700 transition">
                    إلغاء
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
