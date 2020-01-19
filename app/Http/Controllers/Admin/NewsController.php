<?php

namespace App\Http\Controllers\Admin;

use App\News;
use App\Http\Requests\StoreNews;

use App\Http\Controllers\Controller;

class NewsController extends Controller
{

    protected $redirectTo = 'admin/news';

    public function index()
    {
        return view('admin.news.index', ['list' => News::orderBy('date', 'desc')->get()]);
    }

    public function create()
    {
        return view('admin.news.form', [
                'cardtitle' => 'Dodaj wpis',
                'thumbwidth' => News::THUMB_WIDTH,
                'thumbheight' => News::THUMB_HEIGHT
            ])
            ->with('entry', News::make());
    }

    public function store(StoreNews $request)
    {
        $news = News::create($request->only(
            [
                'title',
                'slug',
                'status',
                'meta_title',
                'meta_description',
                'date',
                'content_entry',
                'content'
            ]
        ));

        if ($request->hasFile('file')) {
            $news->makeThumb($request->title, $request->file('file'));
        }

        return redirect($this->redirectTo)->with('success', 'Nowy wpis dodany');
    }

    public function edit($id)
    {
        $news = News::where('id', $id)->first();
        return view('admin.news.form', [
                'entry' => $news,
                'cardtitle' => 'Edytuj wpis',
                'thumbwidth' => News::THUMB_WIDTH,
                'thumbheight' => News::THUMB_HEIGHT
            ]);
    }

    public function update(StoreNews $request, News $news)
    {
        $news->update($request->only(
            [
                'title',
                'slug',
                'status',
                'meta_title',
                'meta_description',
                'date',
                'content_entry',
                'content'
            ]
        ));

        if ($request->hasFile('file')) {
            $news->makeThumb($request->title, $request->file('file'));
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
