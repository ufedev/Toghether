@extends('layouts.app')

@section('title')

    @if (auth()->user())
        @if ($user->username === auth()->user()->username)
            Tu Cuenta
        @else
            {{ $user->username }}
        @endif
    @else
        {{ $user->username }}
    @endif

@endsection

@section('content')
    <div class='flex justify-center items-center'>
        <div class='w-full md:w-8/12 lg:w-6/12 flex items-center flex-col md:flex-row'>
            <div class='w-6/12 md:w-4/12 lg:w-3/12 xl:w-2/12 px-5 flex justify-center rounded-[50%]'>
                <img class='w-full mx-auto block rounded-[50%]' src="{{ asset('profiles_images/' . $user->image) }}"
                    alt="Imagen de Usuario">
            </div>
            <div class='md:w-8/12 lg:w-6/12 px-5'>
                <div class='flex justify-between items-center'>
                    <p class='font-bold'>{{ $user->name }}</p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('profile.index') }}" title='configuración'>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>

                            </a>
                        @endif
                    @endauth
                </div>
                <div class='flex flex-col md:flex-row gap-1 md:gap-3 mt-5'>
                    <p class='flex gap-1 font-medium text-sm text-slate-700'><span
                            class='font-bold'>{{ $user->followers->count() }}</span>@choice('Seguidor|Seguidores', $user->followers->count())</p>
                    <p class='flex gap-1 font-medium text-sm text-slate-700'><span
                            class='font-bold'>{{ $user->following->count() }}</span>@choice('Seguido|Seguidos', $user->following->count())</p>
                    <p class='flex gap-1 font-medium text-sm text-slate-700'><span
                            class='font-bold'>{{ $user->posts->count() }}</span>@choice('Publicación|Publicaciones', $user->posts->count())
                    </p>
                </div>
            </div>

        </div>

    </div>
    @auth
        @if ($user->username === auth()->user()->username)
            <nav class='w-full max-w-[95%] md:w-8/12 lg:w-6/12 mx-auto mt-10 rounded-lg p-2 bg-slate-300'>

                <a href='{{ route('posts.create') }}'
                    class='flex gap-1 p-2 border-[1px] border-sky-600 w-fit rounded-lg bg-gradient-to-tr from-sky-600 to-indigo-600 text-white font-medium'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>

                    Crear
                </a>
            </nav>
        @else
            <div>
                @if (!$user->checkFollowers())
                    <form class='w-+ull max-w-[95%] md:w-8/12 lg:w-6/12 mx-auto mt-10 flex justify-end' method='POST'
                        action="{{ route('profile.follow', ['user' => $user]) }}">
                        @csrf
                        <input
                            class='border-[1px] border-sky-500 rounded-lg p-2 bg-gradient-to-bl from-sky-500 to-indigo-700 font-medium text-white cursor-pointer'
                            type="submit" value="Seguir" />
                    </form>
                @else
                    <form class='w-+ull max-w-[95%] md:w-8/12 mx-auto lg:w-6/12 mt-10 flex justify-end' method="POST"
                        action={{ route('profile.unfollow', ['user' => $user]) }}>
                        @csrf
                        @method('delete')
                        <input
                            class='border-[1px] border-slate-500 rounded-lg p-2 bg-gradient-to-bl from-slate-500 to-neutral-700 font-medium text-white cursor-pointer'
                            type="submit" value="Dejar de seguir" />
                    </form>
                @endif
            </div>
        @endif
    @endauth
    @if (count($posts) === 0)
        <p class='mt-20 font-medium text-xl text-slate-800 text-center'>Todavía no hay publicaciones</p>
    @else
        <section
            class='mt-10 bg-slate-300 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 container mx-auto w-full md:w-8/12 rounded p-2'>
            @foreach ($posts as $post)
                <a class='cursor-pointer' title="{{ $post->title }}"
                    href={{ route('posts.show', ['user' => $user, 'post' => $post]) }}>
                    <div class='aspect-[4/6] rounded-xl w-full'>
                        <img src="{{ asset('uploads') . '/' . $post->image }}" alt="{{ 'Imagen de ' . $post->title }}"
                            class='h-full w-full object-cover rounded object-center' />
                    </div>
                </a>
            @endforeach
        </section>
        <div class='my-10 container mx-auto w-full md:w-8/12'>
            {{ $posts->links() }}
        </div>
    @endif
@endsection
