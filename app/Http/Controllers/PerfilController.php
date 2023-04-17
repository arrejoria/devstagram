<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Termwind\Components\Raw;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {

        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate(
            $request,
            [
                'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:15', 'not_in:editar-perfil,login,register'],
                'email' => ['required', 'email', 'unique:users,email,' . auth()->user()->id],
            ]
        );


        
        // Agregar Imagen
        if ($request->imagen) {
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000, null, 'center');

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        //Eliminar imagen  existente 
        $usuario = User::find($request->user()->id);

        if ($usuario->imagen !== null && $request->imagen) {
            $imagen__path = public_path('perfiles/') . $usuario->imagen;
            if (File::exists($imagen__path)) {
                // Eliminar el archivo
                unlink($imagen__path);
            }
        }

        // Validar authenticated password y new password
        if ($request->password || $request->new_password || $request->new_password_confirmation) {

            $this->validate(
                $request,
                [
                    'password' => 'current_password|min:6', //Metodo para validar authenticated password en base de datos
                    'new_password' => ['max:30', 'min:6', 'confirmed']
                ],
                [
                    'new_password.confirmed' => 'La nueva contraseña y su confirmación deben ser iguales.',
                ]
            );

            // Otro metodo para validar con Hash::check() authenticated password en base de datos
            // if (!Hash::check($request->password, $usuario->password )) {
            //     return back()->with('mensaje', 'Contraseña actual incorrecta');
            // }
        }

        // Guardar cambios
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->new_password);
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        return redirect()->route('post.index', $usuario->username);
    }
}
