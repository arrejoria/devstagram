@extends('layouts.app')

@section('titulo')
    Inicia Sesión en Devstagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen login de usuarios">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                @if (session('mensaje'))
                    <p class="bg-red-500 text-white p-2 my-2 rounded-lg text-sm text-center">
                        {{ session('mensaje') }}
                    </p>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input
                        class="border p-3 w-full rounded-lg  @error('name') border-red-500 
                    @enderror"
                        value="{{ old('email') }}"" id="email" name="email" placeholder="Tu Email de Registro"
                        type="email" />

                    @error('email')
                        <p class="bg-red-500 text-white p-2 my-2 rounded-lg text-sm text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input
                        class="border p-3 w-full rounded-lg  @error('name') border-red-500 
                    @enderror"
                        id="password" name="password" placeholder="Password de Registro" type="password" />

                    @error('password')
                        <p class="bg-red-500 text-white p-2 my-2 rounded-lg text-sm text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" class="text-gray-500 text-sm ">Mantener mi sesión abierta</label>
                </div>
                <input type="submit" value="Iniciar Sesión"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg mt-10" />
            </form>
        </div>
    </div>
@endsection
