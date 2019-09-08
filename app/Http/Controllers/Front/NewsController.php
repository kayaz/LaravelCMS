<?php

namespace App\Http\Controllers\Front;

use App\News;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('data', 'desc')->where('status', '=', 1)->paginate(2);
        return view('news.front', ['news' => $news]);
    }

    public function show($slug)
    {
        $newsEntry = News::where('slug', $slug)->first();
        return view('news.show', ['wpis' => $newsEntry]);
    }
}
