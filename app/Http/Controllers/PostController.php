<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        // Visualiza los posts del usuario solicitado y pagina 5 post por pagina
        $posts = Post::where('user_id', $user->id)
        ->orderBy('created_at','desc')
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
        $this->validate($request,
        ['titulo'=> 'required|max:30',
        'descripcion'=>'required|max:200',
        'imagen'=> 'required'
    ]);

    // Primera forma de crear registros, mas sencilla
    // Post::create([
    //     'titulo'=>$request->titulo,
    //     'descripcion'=>$request->descripcion,
    //     'imagen'=>$request->imagen,
    //     'user_id'=> auth()->user()->id,
        

    // ]);

    // Otra forma de crear registros
    // $post = new Post;
    // $post->titulo = $request->titulo;
    // $post->descripcion = $request->descripcion;
    // $post->imagen = $request->imagen;
    // $post->user_id = auth()->user()->id;
    // $post->save();

    // Una tercera forma de crear registros con relaciones
    // Al tener un usuario auth podemos acceder a la misma
    $request->user()->posts()->create([
        'titulo'=>$request->titulo,
        'descripcion'=>$request->descripcion,
        'imagen'=>$request->imagen,
        'user_id'=> auth()->user()->id,
    ]);

    return redirect()->route('post.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {

        return view('posts.show', [
            'post' => $post,
            'username' => $user->username,
            'created_date' => $post-> created_at
        ]);
    }

} 