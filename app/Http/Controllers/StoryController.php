<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'drafts');

        $query = Post::with(['category', 'likes', 'comments'])
            ->where('user_id', Auth::id())
            ->orderBy('updated_at', 'DESC');

        if ($tab === 'published') {
            $query->whereNotNull('published_at');
        } else {
            $query->whereNull('published_at');
        }

        $posts = $query->paginate(10);
        $draftCount = Post::where('user_id', Auth::id())->whereNull('published_at')->count();
        $publishedCount = Post::where('user_id', Auth::id())->whereNotNull('published_at')->count();

        return view('stories.index', compact('posts', 'tab', 'draftCount', 'publishedCount'));
    }
}
