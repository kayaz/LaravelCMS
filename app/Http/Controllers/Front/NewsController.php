<?php

namespace App\Http\Controllers\Front;

use App\News;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('date', 'desc')->where('status', '=', 1)->paginate(2);
        return view('front.news.index', ['news' => $news]);
    }

    public function show($slug)
    {
        $newsEntry = News::where('slug', $slug)->firstOrFail();
        return view('front.news.show', ['wpis' => $newsEntry]);
    }
}
