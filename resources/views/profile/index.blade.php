@extends('layouts.app')

@section('title')
    Perfil
@endsection

@section('content')
    <section class='w-full lg:w-6/12 flex flex-col lg:flex-row justify-center items-center mx-auto gap-5'>
        <div class='flex flex-col '>
            <div class='w-40 h-40 rounded-[50%]'>
                <img src="{{ asset('profiles_images/' . auth()->user()->image) }}" alt="Imagen Usuario"
                    class='rounded-[50%]' />

            </div>
            @if (session('error'))
                <p class='p-2 text-center bg-red-500 text-white font-medium'>{{ session('error') }}</p>
            @endif
        </div>
        <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data"
            class='p-5 border-[1px] border-slate-200 rounded bg-white w-3/4'>
            @csrf
            <div class='flex flex-col w-full gap-1'>
                <label for="username" class='font-medium'>Nombre de usuario</label>
                <input type="text" name='username' id='username' placeholder="Nombre de usuario"
                    class='border-slate-200 border-[1px] p-2 rounded' value={{ auth()->user()->username }}>

                @error('username')
                    <p class='mt-2 p-1 text-center bg-gradient-to-br from-red-600 to-red-500 text-white font-medium rounded'>
                        {{ $message }}</p>
                @enderror
            </div>
            <div class='flex w-full mt-5 '>
                <label for="image"
                    class='font-medium cursor-pointer border-[1px] border-slate-300 border-dotted p-2 py-5 rounded hover:cursor-pointer w-full text-center'>Seleccionar
                    una imagen</label>
                <input type="file" name='image' id='image' class='hidden' accept=".jpg,.jpeg,.png,.gif">

            </div>
            @error('type_image')
                <p class='mt-2 p-1 text-center bg-gradient-to-br from-red-600 to-red-500 text-white font-medium rounded'>El
                    formato de la imagen no es correcto</p>
            @enderror

            <input type="submit" value="Guardar cambios"
                class='font-medium text-white mt-5 bg-gradient-to-tr from-indigo-600 to-sky-600 w-full rounded p-2 cursor-pointer' />
        </form>
    </section>
@endsection
