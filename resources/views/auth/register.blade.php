@extends('layouts.app')

@section('title')
    Crea tu cuenta
@endsection


@section('content')
    <div class=" flex flex-col md:flex-row mt-10 mx-auto md:justify-center gap-2">
        <div class="md:w-6/12">
            <img class='h-full w-full object-cover' src="{{ asset('img/registrar.jpg') }}" alt="">
        </div>
        <div class='md:w-4/12'>
            <form action="{{ route('register') }}" method='POST' class='flex flex-col gap-1 bg-white p-5 rounded shadow'>
                @csrf
                <div class=' flex flex-col gap-1 mb-5'>
                    <label for="name" class='font-bold min-w-40 uppercase text-slate-800'>
                        Nombre
                    </label>
                    <input
                        class='bg-white flex-1 p-2 shadow rounded border-[1px] border-slate-300 @error('name') border-red-500 @enderror'
                        type="text" name='name' id='name' placeholder="Nombre" value='{{ old('name') }}' />
                    @error('name')
                        <p class='p-1 rounded bg-red-500 text-white font-bold text-center'>{{ $message }}</p>
                    @enderror
                </div>
                <div class=' flex flex-col gap-1 mb-5'>
                    <label for="username" class='font-bold min-w-40 uppercase text-slate-800'>
                        Usuario
                    </label>
                    <input
                        class='bg-white flex-1 p-2 shadow rounded border-[1px] border-slate-300 @error('username') border-red-500 @enderror'
                        type="text" name='username' id='username' placeholder="Nombre de usuario"
                        value='{{ old('username') }}' />
                    @error('username')
                        <p class='p-1 rounded bg-red-500 text-white font-bold text-center'>{{ $message }}</p>
                    @enderror
                </div>
                <div class=' flex flex-col gap-1 mb-5'>
                    <label for="email" class='font-bold min-w-40 uppercase text-slate-800'>
                        Email
                    </label>
                    <input
                        class='bg-white flex-1 p-2 shadow rounded border-[1px] border-slate-300 @error('email') border-red-500 @enderror'
                        type="email" name='email' id='email' placeholder="Correo electronico"
                        value='{{ old('email') }}' />
                    @error('email')
                        <p class='p-1 rounded bg-red-500 text-white font-bold text-center'>{{ $message }}</p>
                    @enderror
                </div>

                <div class=' flex flex-col gap-1 mb-5'>
                    <label for="password" class='font-bold min-w-40 uppercase text-slate-800'>
                        Contraseña
                    </label>
                    <input
                        class='bg-white flex-1 p-2 shadow rounded border-[1px] border-slate-300 @error('password') border-red-500 @enderror'
                        type="password" name='password' id='password' placeholder="Contraseña"
                        value='{{ old('password') }}' />
                    @error('password')
                        <p class='p-1 rounded bg-red-500 text-white font-bold text-center'>{{ $message }}</p>
                    @enderror
                </div>

                <div class=' flex flex-col gap-1 mb-5'>
                    <label for="password_confirmation" class='font-bold min-w-40 uppercase text-slate-800'>
                        Repetir Contraseña
                    </label>
                    <input
                        class='bg-white flex-1 p-2 shadow rounded border-[1px] border-slate-300 @error('password_confirmation') border-red-500 @enderror'
                        type="password" name='password_confirmation' id='password_confirmation'
                        placeholder="Repetir contraseña" />
                    @error('password_confirmation')
                        <p class='p-1 rounded bg-red-500 text-white font-bold text-center'>{{ $message }}</p>
                    @enderror
                </div>

                <input type="submit" value="Crear"
                    class='w-full p-2 bg-orange-600 font-bold uppercase hover:bg-orange-500 cursor-pointer transition-colors rounded shadow text-white' />
            </form>
        </div>
    </div>
@endsection
