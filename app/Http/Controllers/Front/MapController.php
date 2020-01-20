<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Map;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.map.index', ['list' => Map::orderBy('id', 'desc')->get()]);
    }
}
