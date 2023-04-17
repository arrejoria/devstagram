@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="md:w-1/2 shadow bg-white p-6">
            <form action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input id="username" name="username" type="text" placeholder="Nombre de Usuario"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 
                @enderror"
                        value="{{ auth()->user()->username }}" />

                    @error('username')
                        <p class="bg-red-500 text-white p-2 my-2 rounded-lg text-sm text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Modificar Email
                    </label>
                    <input
                        class="border p-3 w-full rounded-lg  @error('name') border-red-500 
                    @enderror"
                        value="{{ auth()->user()->email }}"" id="email" name="email"
                        placeholder="Nuevo correo electronico" type="email" />

                    @error('email')
                        <p class="bg-red-500 text-white p-2 my-2 rounded-lg text-sm text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña Actual 
                    </label>
                    <input
                        class="border p-3 w-full rounded-lg  @error('name') border-red-500 
                @enderror"
                        id="password" name="password" placeholder="Ingresar contraseña actual" type="password" />

                    @error('password')
                        <p class="bg-red-500 text-white p-2 my-2 rounded-lg text-sm text-center">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-5 flex gap-10">
                    <div class="w-1/2">
                        <label for="new_password" class="mb-2 block uppercase text-gray-500 font-bold">
                            Contraseña Nueva
                        </label>
                        <input
                            class="border p-3 w-full rounded-lg  @error('name') border-red-500 
                    @enderror"
                            id="new_password" name="new_password" placeholder="Ingresar contraseña nueva" type="password" />

                        @error('new_password')
                            <p class="bg-red-500 text-white p-2 my-2 rounded-lg text-sm text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-1/2">
                        <label for="new_password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                            Repetir Contraseña
                        </label>
                        <input
                            class="border p-3 w-full rounded-lg  @error('name') border-red-500 
                    @enderror"
                            id="new_password_confirmation" name="new_password_confirmation" placeholder="Repetir contraseña nueva"
                            type="password" />

                        @error('new_password_confirmation')
                            <p class="bg-red-500 text-white p-2 my-2 rounded-lg text-sm text-center">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen
                    </label>
                    <input id="imagen" name="imagen" type="file" placeholder="Imagen de perfil"
                        class="border p-3 w-full rounded-lg" accept=".jpg, .jpeg, .png" />

                    @error('imagen')
                        <p class="bg-red-500 text-white p-2 my-2 rounded-lg text-sm text-center">{{ $message }}</p>
                    @enderror
                </div>
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white p-2 my-2 rounded-lg text-sm text-center">
                        {{ session('mensaje') }}
                    </p>
                @endif
                <input type="submit" value="Actualizar Perfil"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg mt-10" />
            </form>
        </div>
    </div>
@endsection
