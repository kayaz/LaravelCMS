<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use App\GalleryPhotos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryPhotosController extends Controller
{
    public function update(Request $request, Gallery $gallery, GalleryPhotos $photos)
    {
        if ($request->hasFile('qqfile')) {
            $photos->uploadPhoto($request->file('qqfile'), $gallery->id);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(GalleryPhotos $photo)
    {
        $photo->deletePhoto();
        $photo->delete();
        return response()->json(['success' => 'Zdjęcie usunięte']);
    }

    public function sort(Request $request, GalleryPhotos $photos)
    {
        $photos->sort($request);
    }
}
