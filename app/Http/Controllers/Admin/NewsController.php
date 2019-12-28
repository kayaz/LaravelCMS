<?php

namespace App\Http\Controllers\Admin;

use App\News;
use App\Http\Requests\StoreNews;

use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class NewsController extends Controller
{

    protected $redirectTo = 'admin/news';

    public function index()
    {
        $news = News::orderBy('data', 'desc')->get();
        return view('admin.news.index', ['list' => $news]);
    }

    public function create()
    {
        return view('admin.news.form',
            [
                'cardtitle' => 'Dodaj wpis',
                'thumbwidth' => News::THUMB_WIDTH,
                'thumbheight' => News::THUMB_HEIGHT
            ])
            ->with('entry', News::make());
    }

    public function store(StoreNews $request)
    {
        $news = News::create($request->merge(['slug' => Str::slug($request->nazwa)])->only(
            [
                'nazwa',
                'status',
                'meta_tytul',
                'meta_opis',
                'data',
                'wprowadzenie',
                'tekst'
            ]
        ));

        if ($request->hasFile('plik')) {
            $news->makeThumb($request->nazwa, $request->file('plik'));
        }

        return redirect($this->redirectTo)->with('success', 'Nowy wpis dodany');
    }

    public function edit($id)
    {
        $news = News::where('id', $id)->first();
        return view('admin.news.form',
            [
                'entry' => $news,
                'cardtitle' => 'Edytuj wpis',
                'thumbwidth' => News::THUMB_WIDTH,
                'thumbheight' => News::THUMB_HEIGHT
            ]
        );
    }

    public function update(StoreNews $request, News $news)
    {
        $news->update($request->merge(['slug' => Str::slug($request->nazwa)])->only(
            [
                'nazwa',
                'status',
                'meta_tytul',
                'meta_opis',
                'data',
                'wprowadzenie',
                'tekst'
            ]
        ));

        if ($request->hasFile('plik')) {
            $news->makeThumb($request->nazwa, $request->file('plik'));
        }

        return redirect($this->redirectTo)->with('success', 'Wpis zaktualizowany');
    }

    public function destroy(News $news)
    {
        $news->deleteThumb();
        $news->delete();
        return response()->json(['success' => 'Boks usniety']);
    }
}
