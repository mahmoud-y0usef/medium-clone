<?php

namespace App\Http\Controllers;

use App\Models\Post;

class BookmarkController extends Controller
{
    public function toggle(Post $post)
    {
        $user = auth()->user();
        $bookmark = $post->bookmarks()->where('user_id', $user->id)->first();

        if ($bookmark) {
            $bookmark->delete();
        } else {
            $post->bookmarks()->create(['user_id' => $user->id]);
        }

        return back();
    }

    public function index()
    {
        $posts = auth()->user()->bookmarks()
            ->with(['post.user', 'post.category', 'post.likes'])
            ->latest()
            ->paginate(10);

        return view('bookmarks.index', compact('posts'));
    }
}
