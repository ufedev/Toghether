@extends('layouts.app')

@section('title')
    Nueva Publicación
@endsection


@section('content')
    <div class='container flex flex-col w-full md:flex-row md:w-10/12 lg:w-8/12 mx-auto gap-2'>
        <div class='w-full md:w-1/2 '>
            <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data" id='dropzone'
                class="dropzone border-dashed h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>
        <div class='w-full md:w-1/2 '>
            <form action="{{ route('posts.store') }}" method='POST' class='flex flex-col gap-1 bg-white p-5 rounded shadow'>
                @csrf
                <div class=' flex flex-col gap-1 mb-5'>
                    <label for="title" class='font-bold min-w-40 uppercase text-slate-800'>
                        Titulo
                    </label>
                    <input
                        class='bg-white flex-1 p-2 shadow rounded border-[1px] border-slate-300 @error('title') border-red-500 @enderror'
                        type="text" name='title' id='title' placeholder="Titulo" value='{{ old('title') }}' />
                    @error('title')
                        <p class='p-1 rounded bg-red-500 text-white font-bold text-center'>{{ $message }}</p>
                    @enderror
                </div>
                <div class=' flex flex-col gap-1 mb-5'>
                    <label for="description" class='font-bold min-w-40 uppercase text-slate-800'>
                        Descripción
                    </label>
                    <textarea
                        class='bg-white flex-1 p-2 shadow rounded border-[1px] border-slate-300 @error('description') border-red-500 @enderror'
                        name='description' id='description' placeholder="Descripción (255Max)">{{ old('description') }}</textarea>
                    @error('description')
                        <p class='p-1 rounded bg-red-500 text-white font-bold text-center'>{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <input id='input_image' type="hidden" name='image' value="{{ old('image') }}" />
                    @error('image')
                        <p class='p-1 rounded bg-red-500 text-white font-bold text-center'>{{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" value="Crear"
                    class='p-2 rounded border-[1px] border-indigo-600 bg-gradient-to-tr from-sky-600 to-indigo-600 font-medium text-white hover:from-sky-500 hover:to-indigo-500 transition-all cursor-pointer' />
            </form>
        </div>
    </div>
@endsection
