<?php

namespace App\Http\Controllers;

use App\News;
use App\Slider;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $slider = Slider::all()->sortBy("sort");
        $news = News::all()->sortBy("sort");

        return view('layouts.main', compact('slider', 'news'));
    }
}
