<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {

        $ids = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->orderBy('created_at', 'desc')->paginate(20);
        $users = User::find($ids);
        dd($users);
        return view('home', [
            'posts' => $posts,
            'username' => $ids->username
        ]);
    }
}
