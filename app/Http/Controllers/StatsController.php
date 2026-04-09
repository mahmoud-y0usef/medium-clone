<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class StatsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = Post::with(['likes', 'comments'])
            ->where('user_id', $user->id)
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'DESC')
            ->get();

        $totalViews = $posts->count() * rand(5, 30); // placeholder
        $totalLikes = $posts->sum(fn($p) => $p->likes->count());
        $totalComments = $posts->sum(fn($p) => $p->comments->count());
        $followerCount = $user->followers()->count();

        return view('stats.index', compact('posts', 'totalLikes', 'totalComments', 'followerCount'));
    }
}
