<div>

    @props(['maybe' => false]) <!-- optional -->
    <!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->

    <section
        class='w-full max-w-[95%] md:w-6/12 lg:w-4/12 mx-auto aspect-[9/16] flex flex-col gap-10 mt-10  pt-10 @if ($maybe) bg-slate-300 border-t-[1px] @endif px-5 py-10'>
        @if ($maybe)
            <h4 class='font-medium text-slate-700 text-center text-xl'>Quizas te interese</h4>
        @endif
        @foreach ($posts as $post)
            <article class='flex flex-col gap-2'>

                <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                    <img src="{{ asset('uploads') . '/' . $post->image }}" alt=''
                        class='h-full w-full aspect-[4/4] object-cover' />
                </a>
                <div class='flex justify-start gap-2 items-center'>
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
                <div class='flex flex-col'>
                    <a href="{{ route('posts.index', ['user' => $post->user]) }}"
                        class='font-medium '>{{ $post->user->username }}</a>
                    <p class='text-sm text-slate-700'>{{ $post->created_at->diffForHumans() }}</p>
                </div>


            </article>
        @endforeach
        {{ $posts->links() }}
    </section>
</div>
