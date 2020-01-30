<?php

namespace App\Http\Controllers\Front;

use App\Menu;
use App\News;
use App\Http\Controllers\Controller;

use MetaTag;

class NewsController extends Controller
{
    public function index()
    {
        // SEO
        $page = Menu::where('slug', 'aktualnosci')->firstOrFail(['title','meta_title', 'meta_description']);
        MetaTag::set('title', $page->title);
        MetaTag::set('meta_title', $page->meta_title);

        $news = News::orderBy('date', 'desc')->where('status', '=', 1)->paginate(2);
        return view('front.news.index', ['news' => $news]);
    }

    public function show($slug)
    {
        $newsEntry = News::where('slug', $slug)->firstOrFail();

        // SEO
        MetaTag::set('title', $newsEntry->title);
        MetaTag::set('meta_title', $newsEntry->meta_title);

        return view('front.news.show', ['wpis' => $newsEntry]);
    }
}
