<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Intervention\Image\Laravel\Facades\Image;




class ImageController extends Controller
{
    //

    public function store(Request $req): JsonResponse
    {
        $image = $req->file('file');
        $imageName = Str::uuid() . "." . $image->extension();
        $imageServer = public_path('uploads') . "/" . $imageName;

        $imageMake = Image::read($image);
        $imageMake->cover(800, 800);
        $encodedImage = $imageMake->toJpeg(90);
        $encodedImage->save($imageServer);



        return response()->json($imageName);
    }
}
