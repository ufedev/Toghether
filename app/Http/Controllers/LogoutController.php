<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LogoutController extends Controller
{
    //

    public function store(): RedirectResponse
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
