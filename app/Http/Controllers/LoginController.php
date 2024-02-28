<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class LoginController extends Controller
{


    public function index(): View
    {
        return view('auth.login');
    }

    public function store(Request $req): RedirectResponse
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($req->only('email', 'password'), $req->remember)) {
            return back()->with('mensaje', "Email o Contraseña incorrectas");
        };

        return redirect()->route('posts.index', ['user' => auth()->user()]);
    }
}
