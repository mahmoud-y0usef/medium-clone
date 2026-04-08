<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        $query = Post::with(['user', 'category', 'likes'])
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'DESC');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $posts = $query->paginate(10);
        return view('dashboard', compact('categories', 'posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('posts.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        // Generate unique slug
        $slug = Str::slug($data['title']);
        $baseSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create([
            'title'       => $data['title'],
            'slug'        => $slug,
            'content'     => $data['content'],
            'category_id' => $data['category_id'],
            'user_id'     => auth()->id(),
            'image'       => $imagePath,
            'published_at' => isset($data['publish']) ? now() : null,
        ]);

        // Handle tags
        if (!empty($data['tags'])) {
            $tagIds = collect(explode(',', $data['tags']))
                ->map(fn($t) => trim($t))
                ->filter()
                ->map(fn($name) => Tag::findOrCreateByName($name)->id);
            $post->tags()->sync($tagIds);
        }

        return redirect()->route('posts.show', $post->slug)
            ->with('success', 'Post published successfully!');
    }

    public function show(Post $post)
    {
        $post->load(['user', 'category', 'comments.user', 'likes', 'bookmarks', 'tags']);
        $isLiked = $post->isLikedBy(auth()->user());
        $isBookmarked = $post->isBookmarkedBy(auth()->user());

        return view('posts.show', compact('post', 'isLiked', 'isBookmarked'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::orderBy('name')->get();
        $currentTags = $post->tags->pluck('name')->implode(', ');
        return view('posts.edit', compact('post', 'categories', 'currentTags'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        } else {
            unset($data['image']);
        }

        // Update slug if title changed
        if ($data['title'] !== $post->title) {
            $slug = Str::slug($data['title']);
            $baseSlug = $slug;
            $count = 1;
            while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }
            $data['slug'] = $slug;
        }

        // Toggle published_at
        if (isset($data['publish']) && !$post->published_at) {
            $data['published_at'] = now();
        } elseif (!isset($data['publish'])) {
            $data['published_at'] = null;
        }
        unset($data['publish'], $data['tags']);

        $post->update($data);

        // Handle tags
        if ($request->filled('tags')) {
            $tagIds = collect(explode(',', $request->tags))
                ->map(fn($t) => trim($t))
                ->filter()
                ->map(fn($name) => Tag::findOrCreateByName($name)->id);
            $post->tags()->sync($tagIds);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('posts.show', $post->slug)
            ->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted.');
    }
}
