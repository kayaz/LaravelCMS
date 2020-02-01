<?php

namespace App\Http\Controllers\Front;

use App\Menu;
use App\News;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        // SEO
        $page = Menu::where('slug', 'aktualnosci')->firstOrFail(['title','meta_title', 'meta_description']);

        $news = News::orderBy('date', 'desc')->where('status', '=', 1)->paginate(2);
        return view('front.news.index', [
            'news' => $news,
            'page' => $page
        ]);
    }

    public function show($slug)
    {
        $newsEntry = News::where('slug', $slug)->firstOrFail();
        return view('front.news.show', [
            'wpis' => $newsEntry
        ]);
    }
}
