@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div
        class="container mx-auto md:flex md:justify-around items-center my-5 gap-2 bg-white shadow-xl divide-x-2 divide-gray-100">
        <div class="md:w-1/2 p-4">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt=" Imagen {{ $post->titulo }}" class="shadow-xl">
        </div>
        <div class="md:w-1/2 p-4">
            <div class="text-lg text-center text-gray-400 uppercase font-bold">
                <h3>Detalles de la publicación</h3>
            </div>
            <div class="px-4 my-2 border w-full rounded-lg">
                <div class="">
                    <div class="flex justify-between py-4">
                        <div class="flex items-baseline">
                            <a href="{{ route('post.index', $user) }}" class="text-base font-bold mr-1">{{ $username }}:
                            </a>
                            <p class="font-normal text-sm">{{ $post->descripcion }}</p>
                        </div>
                        @auth()
                            @if (auth()->user()->username === $user->username)
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" id="optionForm">
                                    @method('DELETE')
                                    @csrf
                                </form>

                                <div class="relative" id="postDescription">
                                    <span class="text-xl items-end text-gray-500 cursor-pointer">
                                        <i class="ri-delete-bin-2-line" id="postOptions"></i>
                                    </span>
                                    <ul class=" bg-white border border-gray-500 text-sm font-bold p-3 hidden absolute rounded-md cursor-pointer"
                                        id="showOptions">
                                        <li class="text-red-500 hover:border-b">Eliminar</li>
                                    </ul>
                                </div>
                            @endif
                        @endauth
                    </div>
                    <div class="text-xs text-gray-500 mt-4 flex items-center gap-2">
                        @auth
                            @php
                                $svg = '<svg xmlns="http://www.w3.org/2000/svg" fill="%s" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>';
                            @endphp

                            <button id="like-button"
                                class="{{ $post->checkLikes(auth()->user()) ? 'text-red-500' : 'text-gray-500' }}"
                                data-post-id='{{ $post->id }}'>
                                {!! sprintf($svg, 'none') !!}
                            </button>

                        @endauth

                        <p class="font-bold" id="like-count">{{ $post->likes->count() }}</p>
                        <span class="font-normal" id="like-text">
                            {{ $post->likes->count() > 1 ? 'likes' : 'like' }}</span>
                        <p class="font-bold">{{ $post->comentarios->count() }}
                            <span class="font-normal">
                                {{ $post->comentarios->count() == 1 ? 'comentario' : 'comentarios' }}</span>
                        </p>
                    </div>
                    <div class="flex justify-between text-xs mt-4 text-gray-500">
                        <p>Publicación creada {{ $post->created_at->diffForHumans() }}</p>
                        <p>{{ $created_date->format('d-m-y') }}</p>
                    </div>
                </div>
                <div>
                    <h5 class="border-b-2 p-2 border-gray-300 opacity-50 font-semibold text-gray-400">Comentarios</h5>
                </div>
                <div class="max-h-60 overscroll-contain overflow-auto">
                    <div class="">
                        @if ($post->comentarios->count())
                            @foreach ($post->comentarios as $comentario)
                                <div class="mb-2">
                                    <div class="text-sm flex ">
                                        <a href="{{ route('post.index', $comentario->user) }}" class="font-bold"><img
                                                src="#" alt="">{{ $comentario->user->username }}</a>
                                        <p class="ml-2">{{ $comentario->comentario }}</p>
                                    </div>
                                    <div class="flex justify-between items-center gap-2 text-sm text-gray-400">
                                        <p class="">
                                            {{ $comentario->created_at->diffForHumans() }}
                                        </p>
                                        @auth
                                            @if ($comentario->user_id === auth()->user()->id)
                                                <form
                                                    action="{{ route('comentarios.destroy', ['user' => $user->username, 'post' => $post->id, 'comentario' => $comentario->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="cursor-pointer hover:text-red-500 pr-2"
                                                        id="comment-delete">delete</button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>

                                </div>
                            @endforeach
                        @else
                            <p class="p-10 text-center text-gray-400">No hay comentarios aún</p>
                        @endif
                    </div>
                </div>
            </div>

            @auth
                <div>
                    <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                        @csrf
                        {{-- @if (session('mensaje'))
                                <div class="bg-green-500 text-xl my-1 p-3 animate-fadeIn w-full text-white text-center rounded-lg"
                                    id="successComment">
                                    <p class="">{{ session('mensaje') }}</p>
                                </div>
                                <script>
                                    // Oculta el mensaje después de 3 segundos
                                    setTimeout(() => {
                                        document.getElementById('successComment').remove();
                                    }, 3000);
                                </script>
                            @endif --}}
                        <textarea aria-label="Añade un comentario" cols="2" rows="1" id="comentario" name="comentario"
                            placeholder="Añade un comentario..."
                            class="border p-3 w-full rounded-lg  @error('descripcion') border-red-500 
                        @enderror">{{ old('descripcion') }}</textarea>

                        <div>
                            @error('comentario')
                                <p class="bg-red-500 text-white p-2 my-2 rounded-lg text-sm text-center">{{ $message }}
                                </p>
                            @enderror
                            <label for="sendComment" class="cursor-pointer text-2xl text-gray-400 ">
                                {{-- <i class="ri-chat-3-line"></i> --}}
                            </label>
                            <input type="submit" id="sendComment" value="Crear comentario"
                                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg mt-2" />
                        </div>
                </div>
                </form>

            </div>
        @endauth

    </div>
    </div>
@endsection
