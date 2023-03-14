<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    
    
    public function store(Request $request, User $user, Post $post)
    {
    // Validar Campo
        $this->validate(
            $request, 
            [
                'comentario'=>'required|max:200',
            ]
        );

    // Almacenar en la base de datos
        Comentario::create([
            'user_id'=> auth()->user()->id,
            'post_id'=> $post->id,
            'comentario' => $request->comentario
        ]);


    // Retornar vista
        return back()->with('mensaje', 'Comentario Realizado Correctamente');
    }

}
