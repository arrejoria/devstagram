<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function store(Request $request, Post $post)
    {
        $post->likes()->create([
            'user_id' => $request->user()->id,
            'post_id' => $post-> id
        ]);
        
        if ($request->wantsJson()) {
            $response = [
                'likes' => $post->likes()->count(),
                'liked' => true
            ];

            return response()->json($response);
        } 
        
    }

    public function destroy(Request $request, Post $post)
    {
        $post->likes()->where('user_id', $request->user()->id)->delete();

        if ($request->wantsJson()) {
            $response = [
                'likes' => $post->likes()->count(),
                'liked' => false
            ];

            return response()->json($response);

        } 
    }
}
