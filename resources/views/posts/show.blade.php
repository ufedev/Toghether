@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <section class='container mx-auto flex flex-col md:flex-row w-full md:w-8/12'>
        <div class='md:w-7/12'>

            <img src='{{ asset('uploads') . '/' . $post->image }}' alt='' class='h-full w-full object-cover' />

        </div>
        <div class='md:w-5/12 flex flex-col justify-between'>
            <div class='border-b-[1px] border-slate-500 '>
                <div class='px-2 flex justify-between items-center gap-10 pb-2'>
                    <h4 class='font-bold'><a href={{ route('posts.index', ['user' => $user]) }}>{{ $user->username }}</a>
                    </h4>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <form action="{{ route('posts.destroy', ['post' => $post]) }}" method='POST'>
                                @csrf
                                @method('delete')
                                <button type='submit' class='text-3xl'>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>

            </div>
            <div class='flex-1 p-2'>
                <p class=''>
                    <a href='{{ route('posts.index', ['user' => $user]) }}' class='font-bold'>{{ $user->username }}</a>
                    {{ $post->description }}
                </p>
                <span class='font-medium text-sm text-slate-800'>{{ $post->created_at->diffForHumans() }}</span>

            </div>
            <div class=''>
                <div class='p-2 flex-1 max-h-96 overflow-auto'>
                    @foreach ($post->comments as $comment)
                        <div class='mb-1 p-1 '>
                            <p><a href='{{ route('posts.index', ['user' => $comment->user]) }}'
                                    class='font-medium'>{{ $comment->user->username }}</a>
                                {{ $comment->comment }}</p>
                            <span class='text-xs font-medium'>{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                    @endforeach
                </div>
                <div class=' flex gap-2 px-3 items-center py-1 justify-start'>
                    <livewire:like-post :post="$post" />
                    <label for='comment' class="cursor-pointer flex items-center">
                        {{ $post->comments->count() }}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                        </svg>
                    </label>
                </div>
                @auth

                    <form action="{{ route('comment.store', ['user' => $user, 'post' => $post]) }}" class='flex bg-white'
                        method="POST">
                        @csrf
                        <textarea id='comment' name='comment' placeholder="Comentar" class='bg-transparent flex-1 p-2 max-h-12'>{{ old('comment') }}</textarea>

                        <input type="submit" value="comentar"
                            class='bg-gradient-to-tr from-sky-600 to-indigo-600 p-2 font-medium text-white cursor-pointer'>

                    </form>

                @endauth

            </div>
        </div>
    </section>
@endsection
