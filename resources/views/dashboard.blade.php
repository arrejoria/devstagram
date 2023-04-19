@extends('layouts.app')

@section('titulo')
    Perfil de: {{ $user->name }}
@endsection

@section('contenido')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row ">
            <div class="w-8/12 lg:w-6/12 px-5 flex shrink">
                <img src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('perfiles/guest/usuario.svg') }}"
                    alt="Imagen usuario" class="rounded-full w-72">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:items-start md:justify-center py-10 md:py-5">
                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2xl"> {{ $user->username }} </p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('perfil.index') }}" class="">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>
                {{-- {{ dd(auth()->user()->seguidores())}} --}}
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->followers->count() }}
                    <span class="font-normal">@choice('seguidor|seguidores', $user->followers->count())</span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->followings->count() }}
                    <span class="font-normal"> Siguiendo</span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $posts->count() }}
                    <span class="font-normal">Publicaciones</span>
                </p>

                @auth
                    @if ($user->username !== auth()->user()->username)
                        @if (!$user->siguiendo(auth()->user()))
                            <form action="{{ route('users.follow', $user) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="text-xs text-white font-semibold uppercase bg-[color:var(--main-color)] px-2 py-1 mt-2  rounded hover:shadow">Follow</button>
                            </form>
                        @else
                            <form action="{{ route('users.unfollow', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-xs text-white font-semibold uppercase bg-gray-400 px-2 py-1 mt-2  rounded hover:shadow">Unfollow</button>
                            </form>
                        @endif
                    @endif
                @endauth

            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        @if ($posts->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div class="relative" id="post__container">
                        <a href="{{ route('posts.show', ['post' => $post, 'user' => $user]) }}">
                            <img src="{{ asset('uploads') . '/' . $post->imagen }}"
                                alt="Imagen del post {{ $post->titulo }}">
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

    </section>
@endsection
