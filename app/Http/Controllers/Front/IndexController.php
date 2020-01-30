<?php

namespace App\Http\Controllers\Front;

use App\Menu;
use App\News;
use App\Slider;
use App\Box;

use App\Http\Controllers\Controller;

use MetaTag;

class IndexController extends Controller
{
    public function index()
    {
        $slider = Slider::all()->sortBy("sort");
        $news = News::all()->sortBy("sort");
        $boxes = Box::all()->sortBy("sort");

        return view('layouts.main', compact('slider', 'news', 'boxes'));
    }

    public function getPage($uri = null)
    {
        $page = Menu::where('uri', $uri)->firstOrFail();

        // SEO
        MetaTag::set('title', $page->title);
        MetaTag::set('meta_title', $page->meta_title);

        return view('front.index.menupage')->with('page', $page);
    }
}
