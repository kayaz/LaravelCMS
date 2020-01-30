<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Map;
use App\Menu;

use MetaTag;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        // SEO
        $page = Menu::where('slug', 'mapa')->firstOrFail(['title','meta_title', 'meta_description']);
        MetaTag::set('title', $page->title);
        MetaTag::set('meta_title', $page->meta_title);

        return view('front.map.index', ['list' => Map::orderBy('id', 'desc')->get()]);
    }
}
