<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComentarioController extends Controller
{
    public function store(Request $request,User $user, Post $post)
    {
        // dd($request->comentario);
        Comentario::create([
            'post_id' => $post->id,
            'user_id' => $request->user()->id,
            'comentario' => $request->comentario
        ]);
    }
}
