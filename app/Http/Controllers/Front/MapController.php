<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Map;
use App\Menu;

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
        $page = Menu::where('slug', 'mapa')->firstOrFail(['title','meta_title', 'meta_description']);
        return view('front.map.index', ['list' => Map::orderBy('id', 'desc')->get(), 'page' => $page]);
    }
}
