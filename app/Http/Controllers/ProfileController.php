<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Laravel\Facades\Image;

class ProfileController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {

        // dd('hola mundo');
        return view('profile.index');
    }

    public function store(Request $req): RedirectResponse
    {
        try {
            $req->request->add(['username' => Str::slug($req->username)]);

            $req->validate([
                'username' => ['required', 'min:6', 'max:28', 'unique:users,username,' . auth()->user()->id, 'not_in:profile,youtube,instagram,facebook,twitter,x,google']
            ]);


            $user = User::find(auth()->user()->id);
            $user->username = $req->username;
            if ($req->image) {

                $req->request->add(['type_image' => $req->file('image')->extension()]);

                $old_img = auth()->user()->image;

                if ($old_img !== 'usuario.svg') {
                    unlink(public_path('profiles_images/' . $old_img));
                }

                $image_name = Str::uuid() . '.webp';
                $image_create = Image::read($req->file('image'));
                $image_create->cover(800, 800)->toWebp(80);
                $image_create->save(public_path('profiles_images/') . $image_name);


                $user->image = $image_name;
            }

            $user->save();

            // dd($user->id);
            // dd($user->username);

            return redirect()->route('profile.index');
        } catch (PostTooLargeException $e) {
            return back()->with('error', 'Imagen Grande');
        }
    }
}
