@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex md:justify-center my-5 gap-6 bg-white shadow-xl divide-x-2 divide-gray-100">
        <div class="md:w-6/12 xl:w-5/12 p-6">
            {{-- <div class="flex md:flex-col mb-2 px-1 rounded-sm ">
                <p class="text-base">Titulo: {{ $post->titulo }}</p>
            </div> --}}
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="" class="shadow-xl">
        </div>
        <div class="md:w-5/12 md:flex md:flex-col p-6 ">
            <div class="text-lg text-center text-gray-400 uppercase font-bold">
                <h3>Detalles de la publicación</h3>
            </div>
            <div class="flex md:flex-col px-4 pt-2 my-2 border-2 border-gray-300 h-auto rounded-md">
                <p class="text-base font-bold">{{ $username }}: <span
                        class="font-normal text-sm">{{ $post->descripcion }}</span></p>
                <p class="text-xs text-right px-2 text-gray-300">{{ $created_date->format('d-m-y') }}</p>
                <div class="divide-y-2">
                    <h4 class="font-semibold text-gray-400">Comentarios</h4>
                    <div class="h-64 overscroll-contain overflow-auto p-2 flex flex-col gap-y-3">
                        <div class="text-sm flex">
                            <a href=""><img src="#" alt="" class="">Usuario</a>
                            <p class="ml-2">Lorem ipsum, dolor sit amet consectetur adipisicing elit. At facere tempora consequatur</p>
                        </div>
                        <div class="text-sm flex">
                            <a href=""><img src="#" alt="" class="">Usuario</a>
                            <p class="ml-2">Lorem ipsum, dolor sit amet consectetur </p>
                        </div>
                        <div class="text-sm flex">
                            <a href=""><img src="#" alt="" class="">Usuario</a>
                            <p class="ml-2">Lorem ipsum, dolor sit amet consectetur adipisicing elit. At facere tempora consequatur</p>
                        </div>
                        <div class="text-sm flex">
                            <a href=""><img src="#" alt="" class="">Usuario</a>
                            <p class="ml-2">Loremr adipisicing elit. At facere tempora consequatur</p>
                        </div>
                        <div class="text-sm flex">
                            <a href=""><img src="#" alt="" class="">Usuario</a>
                            <p class="ml-2">Lorem ipsum, doisicing elit. At facere tempora consequatur</p>
                        </div>
                        <div class="text-sm flex">
                            <a href=""><img src="#" alt="" class="">Usuario</a>
                            <p class="ml-2">Lorem ipsum, doisicing elit. At facere tempora consequatur</p>
                        </div>
                        <div class="text-sm flex">
                            <a href=""><img src="#" alt="" class="">Usuario</a>
                            <p class="ml-2">Lorem ipsum, doisicing elit. At facere tempora consequatur</p>
                        </div>
                        <div class="text-sm flex">
                            <a href=""><img src="#" alt="" class="">Usuario</a>
                            <p class="ml-2">Lorem ipsum, doisicing elit. At facere tempora consequatur</p>
                        </div>
                        <div class="text-sm flex">
                            <a href=""><img src="#" alt="" class="">Usuario</a>
                            <p class="ml-2">Lorem ipsum, doisicing elit. At facere tempora consequatur</p>
                        </div>
                    </div>
                    <div>
                        <form action="">
                            @csrf
                            <textarea name="comentario" id="" cols="" rows="" class="w-full p-2 shadow-sm my-2 border-2 border-gray-300 rounded-md" value='' placeholder="Deja tu comentario" ></textarea>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
