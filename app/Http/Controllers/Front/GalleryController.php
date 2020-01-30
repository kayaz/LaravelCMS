<?php

namespace App\Http\Controllers\Front;

use App\Gallery;
use App\Menu;
use App\Photo;
use App\Http\Controllers\Controller;

use MetaTag;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $page = Menu::where('slug', 'galeria')->firstOrFail(['title','meta_title', 'meta_description']);

        // SEO
        MetaTag::set('title', $page->title);
        MetaTag::set('meta_title', $page->meta_title);

        return view('front.gallery.index', ['list' => Gallery::all('id', 'name')->sortBy("name")]);
    }

    /**
     * Display the specified resource.
     *
     * @param Gallery $gallery
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show(Gallery $gallery)
    {
        // SEO
        MetaTag::set('title', $gallery->name);

        $photos = Photo::all()->sortBy("sort")->where('gallery_id', $gallery->id);
        return view('front.gallery.show', ['name' => $gallery->name, 'list' => $photos]);
    }
}
