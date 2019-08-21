<?php

namespace App\Http\Controllers;

use App\News;
use App\Slider;
use App\Boksy;

class IndexController extends Controller
{
    public function index()
    {
        $slider = Slider::all()->sortBy("sort");
        $news = News::all()->sortBy("sort");
        $boksy = Boksy::all()->sortBy("sort");

        return view('layouts.main', compact('slider', 'news', 'boksy'));
    }
}
