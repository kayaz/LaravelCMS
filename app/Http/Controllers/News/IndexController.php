<?php

namespace App\Http\Controllers\News;

use App\News;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $news = News::all()->sortBy("sort");

        return view('news.front',
            array('news' => $news)
        );
    }

    public function show($slug)
    {
        $newsEntry = News::where('slug', $slug)->first();

        return view('news.show',
            array('wpis' => $newsEntry)
        );
    }
}
