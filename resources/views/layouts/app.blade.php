<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DevStagram - @yield('titulo')</title>


    @stack('styles')

    @vite('resources/css/app.css')

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ mix('/css/app.css') }}"> --}}

</head>

<body class="bg-gray-100  ">
    <header class="border-b p-5 bg-white fixed-nav z-10 header-shadow" id="headerBar">
        
        <div class="container mx-auto flex flex-row xs:flex-col justify-between" >
            <h1 class="text-3xl text-violet-600 font-bold">
                <a href="/">Devstagram</a>
            </h1>

            @auth
                <button id="menu-toggle" class="md:hidden flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <div id="menu" class="md:flex md:items-center justify-between">
                    <nav class="flex gap-2 relative">
                        <a class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded border-violet-600 text-sm uppercase font-bold cursor-pointer"
                            href="{{ route('posts.create') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="rgba(124, 58, 237)" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                            </svg>
                            Crear
                        </a>
                        <div class="flex flex-col md:flex-row md:gap-4 items-center p-4 border border-violet-600 ">
                            <a class="font-bold text-gray-600" href="{{ route('post.index', auth()->user()->username) }}">
                                Hola: <span class="font-normal">{{ auth()->user()->username }}</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="font-bold uppercase text-gray-600">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </nav>
                </div>
            @endauth

            @guest
                <nav class="flex gap-2 items-center">
                    <a class="font-bold uppercase text-gray-600" href="{{ route('login') }}">Login</a>
                    <a class="font-bold uppercase text-gray-600" href="{{ route('register') }}">Register</a>
                </nav>
            @endguest


        </div>
    </header>

    <main class="container mx-auto pt-32">
        <h2 class="font-black text-center text-3xl mb-10">
            @yield('titulo')
        </h2>
        @yield('contenido')
    </main>

    <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
        DevStagram - Todos los derechos reservados
        {{ now()->year }}
    </footer>

    {{-- <script src="{{ mix('/js/app.js') }}"></script> --}}
    @vite('resources/js/app.js')

</body>

</html>
