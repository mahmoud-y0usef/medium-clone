<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function show(User $user)
    {
        $posts = $user->posts()
            ->with(['category', 'likes'])
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'DESC')
            ->paginate(10);

        $isFollowing = auth()->check() ? auth()->user()->isFollowing($user) : false;

        return view('users.show', compact('user', 'posts', 'isFollowing'));
    }
}
