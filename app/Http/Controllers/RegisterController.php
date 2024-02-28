<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    //
    public function index(): View
    {
        return view("auth.register");
    }
    public function store(Request $req): RedirectResponse
    {

        //Modificar el req para crear una URL con el username

        $req->request->add(['username' => Str::slug($req->get('username'))]);

        $req->validate([
            "name" => "required",
            "username" => "required|unique:users|min:3|max:30",
            "email" => "required|email|unique:users|",
            "password" => 'required|min:6|confirmed',


        ]);

        User::create([
            "name" => $req->get('name'),
            'username' => $req->get('username'),
            'email' => $req->get('email'),
            'password' => Hash::make($req->get('password'))
        ]);

        //Autenticar el usuario


        auth()->attempt($req->only('email', 'password'));

        return redirect()->route("posts.index", ['user' => auth()->user()]);
    }
}
