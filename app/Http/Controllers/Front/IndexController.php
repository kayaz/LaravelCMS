<?php

namespace App\Http\Controllers\Front;

use App\News;
use App\Slider;
use App\Boxes;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $slider = Slider::all()->sortBy("sort");
        $news = News::all()->sortBy("sort");
        $boksy = Boxes::all()->sortBy("sort");

        return view('layouts.main', compact('slider', 'news', 'boksy'));
    }
}
