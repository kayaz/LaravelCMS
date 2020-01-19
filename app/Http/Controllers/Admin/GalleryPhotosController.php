<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use App\Photo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryPhotosController extends Controller
{
    public function update(Request $request, Gallery $gallery, Photo $photos)
    {
        if ($request->hasFile('qqfile')) {
            $photos->uploadPhoto($request->file('qqfile'), $gallery->id);
        }
        return response()->json(['success' => true]);
    }

    public function destroy(Photo $photo)
    {
        $photo->deletePhoto();
        $photo->delete();
        return response()->json(['success' => 'Zdjęcie usunięte']);
    }

    public function sort(Request $request, Photo $photos)
    {
        $photos->sort($request);
    }
}
