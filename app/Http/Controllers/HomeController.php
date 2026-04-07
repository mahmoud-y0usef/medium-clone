<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['user', 'category', 'likes'])
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'DESC');

        $posts = $query->paginate(12);

        return view('home', compact('posts'));
    }
}
