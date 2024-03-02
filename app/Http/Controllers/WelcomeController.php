<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;


class WelcomeController extends Controller
{
    //

    public function __invoke()
    {
        if (auth()->user()) {
            $ids = auth()->user()->following->pluck('id')->toArray();
            $posts = Post::whereIn('user_id', $ids)->inRandomOrder()->paginate(15);
            array_push($ids, auth()->user()->id);

            $posts_all = Post::whereNotIn('user_id', $ids)->inRandomOrder()->paginate(10);
        } else {
            $posts = Post::inRandomOrder()->paginate(20);
        }


        return view('welcome', ['posts' => $posts, 'posts_all' => $posts_all ?? []]);
    }
}
