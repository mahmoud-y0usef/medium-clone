<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q', '');

        $posts = collect();
        $users = collect();

        if ($query) {
            $posts = Post::with(['user', 'category', 'likes'])
                ->whereNotNull('published_at')
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('content', 'like', "%{$query}%");
                })
                ->orderBy('published_at', 'DESC')
                ->paginate(10)
                ->withQueryString();

            $users = User::where('name', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->limit(10)
                ->get();
        }

        return view('search.index', compact('posts', 'users', 'query'));
    }
}
