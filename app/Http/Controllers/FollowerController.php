<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Follower;

class FollowerController extends Controller
{
    //


    public function store(Request $req, User $user): RedirectResponse
    {
        // dd($user->checkFollowers());
        $user->followers()->attach(auth()->user()->id);

        return back();
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->followers()->detach(auth()->user()->id);
        return back();
    }
}
