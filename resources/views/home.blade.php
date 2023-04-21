@extends('layouts.app')

@section('titulo')
    Página Principal
@endsection

@section('contenido')
    @if ($posts->count())
        <div class="container w-2/4 mx-auto flex flex-col md:justify-around items-center my-5 gap-2 bg-white">
            @foreach ($posts as $post)
                <div>
                    <p>{{dd($posts)}}</p>
                </div>
                <div class="relative" id="post__container">
                    <a href="#">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                    </a>
                    <div class="flex bg-black bg-opacity-50 justify-center items-center p-2 absolute w-full bottom-0 "
                        id="post__black-bg">
                        <span
                            class="text-white body-font font-poppins font-bold uppercase text-center">{{ $post->titulo }}</span>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="my-10">
            {{-- Paginacion de talwind no disponible sin una variable directa de posts --}}
            {{ $posts->links('pagination::tailwind') }}
        </div>
    @else
        <p class="text-sm font-bold text-center text-gray-400 uppercase my-10">Aun no realizaste una publicación</p>
    @endif
@endsection
