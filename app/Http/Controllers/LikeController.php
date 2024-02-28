<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class LikeController extends Controller
{
    //

    public function store(Request $req, Post $post): RedirectResponse
    {

        if ($post->checkLikes($req->user())) {
            $post->likes()->where('user_id', $req->user()->id)->delete();
        } else {
            $post->likes()->create([
                'user_id' => $req->user()->id,
            ]);
        }
        return back();
    }
}
