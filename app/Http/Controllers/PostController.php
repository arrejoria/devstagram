<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }

    public function index(User $user)
    {
        // Visualiza los posts del usuario solicitado y pagina 5 post por pagina
        $posts = Post::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'titulo' => 'required|max:30',
                'descripcion' => 'required|max:200',
                'imagen' => 'required'
            ]
        );

        // Una tercera forma de crear registros con relaciones
        // Al tener un usuario auth podemos acceder a la misma
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('post.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user,
            'username' => $user->username,
            'created_date' => $post->created_at
        ]);
    }


    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();


        // Eliminar la imagen
        $imagen__path = public_path('uploads/') . '/' . $post->imagen;
        if (File::exists($imagen__path)) {
            unlink($imagen__path);
        }
        return redirect()->route('post.index', auth()->user()->username);


    }
}
