<?php

namespace App\Http\Controllers\Front;

use App\Gallery;
use App\Photo;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.gallery.index', ['list' => Gallery::all('id', 'name')->sortBy("name")]);
    }

    /**
     * Display the specified resource.
     *
     * @param Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        $photos = Photo::all()->sortBy("sort")->where('gallery_id', $gallery->id);
        return view('front.gallery.show', ['name' => $gallery->name, 'list' => $photos]);
    }
}
