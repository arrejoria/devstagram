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
                'comentario' => 'required|max:200',
            ]
        );

        // Almacenar en la base de datos
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario
        ]);




        // Retornar vista
        return back()->with('mensaje', 'Comentario Realizado Correctamente');
    }


    // Eliminar comentario del post
    public function destroy($user, $post, $comentario)
    {
        // Obtener el comentario a eliminar
        $comentario = Comentario::find($comentario);

        // Verificar si el usuario tiene permiso para eliminar el comentario
        $this->authorize('delete', $comentario);

        // Eliminar el comentario
        $comentario->delete();

        // Redirigir a la página del post
        return redirect()->route('posts.show', ['user' => $user, 'post' => $post]);
    }
}
