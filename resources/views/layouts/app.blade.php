<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <title>Toghether -- @yield('title')</title>
</head>

<body class='bg-slate-100'>
    <header class='p-5 border-b bg-white'>
        <div class=' container mx-auto flex justify-between items-center'>

            <h1 class='text-3xl md:text-4xl font-black'><a
                    href="
              {{ route('welcome') }}
                ">Toghether</a>
            </h1>
            <nav class='flex flex-col md:flex-row gap-2 items-center'>

                @auth
                    <a href='{{ route('posts.index', ['user' => auth()->user()]) }}'
                        class='font-bold '>{{ auth()->user()->username }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class='text-xs p-2 text-orange-600 underline font-bold cursor-pointer'>Cerrar
                            Sesión</button>
                    </form>
                @endauth
                @guest
                    <a class=' font-bold text-slate-100 uppercase text-xs md:text-sm border-[1px] border-slate-100 p-2 bg-orange-600 hover:bg-orange-500 cursor-pointer transition-colors'
                        href="{{ route('login') }}">Inciar Sesión</a>
                    <a class=' font-bold text-slate-800 uppercase text-xs  md:text-sm border-[1px] border-slate-100 p-2 bg-slate-300 hover:bg-slate-400 cursor-pointer transition-colors'
                        href="{{ route('register') }}">Crear Cuenta</a>
                @endguest
            </nav>
        </div>
    </header>
    <main class='container mx-auto py-10'>

        <h2 class='text-center font-bold text-3xl mb-10'>
            @yield('title')
        </h2>
        @yield('content')

    </main>
    <footer class='text-center font-bold text-md text-slate-500 uppercase my-5'>
        Toghether - Todos los derechos reservados {{ now()->year }}

    </footer>
</body>

</html>
