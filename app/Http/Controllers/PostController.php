<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    public function index(User $user): View
    {

        //$posts = $user->posts->all(); // -> No se usa por faltas de funcionalidades.
        //! Otra forma
        $posts = Post::where('user_id', $user->id)->paginate(20);

        // dd($posts2);

        return view('dashboard', [
            "user" => $user,
            'posts' => $posts ?? []
        ]);
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(Request $req): RedirectResponse
    {

        $req->request->add(['url' => Str::slug($req->get('title')) . '-' . Str::uuid()]);
        $req->validate([
            'title' => 'required',
            'description' => 'required|max:255',
            'image' => 'required',


        ]);



        //!! FORMAS DE CREAR UN POST !!//
        // ** Me gusta mas la estatica ** //
        /** Todas son iguales */
        //Estatica
        // Post::create([
        //     'title' => $req->title,
        //     'description' => $req->description,
        //     'image' => $req->image,
        //     'user_id' => auth()->user()->id
        // ]);

        //Con un nuevo objeto Post, este no lo hago. Es como cuando uno crea una clase nueva.



        // Con las relaciones creadas con elocuent
        // Esta forma es la mas común en Laravel y es lo mismo que la forma estatica

        $req->user()->posts()->create([
            'title' => $req->title,
            'description' => $req->description,
            'image' => $req->image,
            'user_id' => auth()->user()->id,
            'url' => $req->url
        ]);

        //!! FIN FORMAS DE CREAR UN POST !!//

        return redirect()->route('posts.index', [
            'user' => auth()->user()
        ]);
    }

    public function show(User $user, Post $post): View
    {


        return view('posts.show', [
            'user' => $user,
            'post' => $post
        ]);
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', [$post]);

        // $image_path = __DIR__ . "/../../../public/uploads/" . $post->image;
        // La forma que se utiliza en laravel es mas facil con la funcion o helper llamado:
        $image_path = public_path('uploads/' . $post->image);

        if (File::exists($image_path)) {
            unlink($image_path);
        }

        $post->delete();

        return redirect()->route('posts.index', [
            'user' => auth()->user()
        ]);
    }
}
