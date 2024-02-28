<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;


class CommentController extends Controller
{
    //



    public function store(Request $req, User $user, Post $post): RedirectResponse
    {


        $req->validate(
            [
                'comment' => 'required'
            ]
        );

        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comment' => $req->comment
        ]);

        return redirect()->route('posts.show', ['user' => $user, 'post' => $post]);
    }
}
