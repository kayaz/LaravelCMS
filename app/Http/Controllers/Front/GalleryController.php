<?php

namespace App\Http\Controllers\Front;

use App\Gallery;
use App\GalleryPhotos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = Gallery::all('id', 'nazwa')->sortBy("nazwa");
        return view('front.gallery.index', ['list' => $gallery]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        $photos = GalleryPhotos::all()->sortBy("sort")->where('id_gal', $gallery->id);
        return view('front.gallery.show', ['nazwa' => $gallery->nazwa, 'list' => $photos]);
    }
}
