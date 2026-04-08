<x-app-layout>
    <x-slot name="title">Write a new story</x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-2xl font-bold text-gray-900 mb-8">New Story</h1>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Title --}}
            <div>
                <x-input-label for="title" value="Title" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                    value="{{ old('title') }}" placeholder="Title of your story..." autofocus />
                <x-input-error :messages="$errors->get('title')" class="mt-1" />
            </div>

            {{-- Category --}}
            <div>
                <x-input-label for="category_id" value="Category" />
                <select id="category_id" name="category_id"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">-- Select a category --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-1" />
            </div>

            {{-- Cover Image --}}
            <div>
                <x-input-label for="image" value="Cover Image (optional)" />
                <input id="image" name="image" type="file" accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer" />
                <x-input-error :messages="$errors->get('image')" class="mt-1" />
            </div>

            {{-- Tags --}}
            <div>
                <x-input-label for="tags" value="Tags (comma-separated)" />
                <x-text-input id="tags" name="tags" type="text" class="mt-1 block w-full"
                    value="{{ old('tags') }}" placeholder="technology, programming, Laravel" />
                <x-input-error :messages="$errors->get('tags')" class="mt-1" />
            </div>

            {{-- Content --}}
            <div>
                <x-input-label for="content" value="Content" />
                <textarea id="content" name="content" rows="18"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-base leading-relaxed"
                    placeholder="Write your story here...">{{ old('content') }}</textarea>
                <x-input-error :messages="$errors->get('content')" class="mt-1" />
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-4 pt-2">
                <button type="submit" name="publish" value="1"
                    class="px-6 py-2.5 bg-gray-900 text-white rounded-full font-medium hover:bg-gray-700 transition">
                    Publish now
                </button>
                <button type="submit"
                    class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-full font-medium hover:bg-gray-50 transition">
                    Save as draft
                </button>
                <a href="{{ route('dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
