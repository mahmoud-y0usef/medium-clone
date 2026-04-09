<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        $posts = Post::with(['user', 'category', 'likes'])
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'DESC')
            ->paginate(12);

        return view('home', compact('posts'));
    }
}
