<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        // Modificando Request
        $request->request->add(['username' => Str::slug($request->username)]);

        // Validation 
        $this->validate($request, [
            'name' => 'required|max:30|min:3',
            'username' => 'required|unique:users|min:3|max:15',
            'email' => 'required|unique:users|email|max:50',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Autenticar un Usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        // Otra forma de autenticar usuario
        auth()->attempt( $request -> only('email', 'password'));

        //  Redireccionar registro
        return redirect()->route('post.index', auth()->user()->username);
    }
}




