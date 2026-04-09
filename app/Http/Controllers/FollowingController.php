<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class FollowingController extends Controller
{
    public function index()
    {
        $followingIds = Auth::user()->following()->pluck('users.id');

        $posts = Post::with(['user', 'category', 'likes'])
            ->whereIn('user_id', $followingIds)
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'DESC')
            ->paginate(10);

        return view('following.index', compact('posts'));
    }
}
