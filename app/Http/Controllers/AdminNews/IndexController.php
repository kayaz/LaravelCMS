<?php

namespace App\Http\Controllers\AdminNews;

use App\Http\Requests\StoreNews;
use App\News;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    protected $redirectTo = 'admin/news';

    public function index()
    {
        $news = News::orderBy('data', 'desc')->get();
        return view('news.index',
            array('lista' => $news)
        );
    }

    public function create()
    {
        return view('news.form',
            array(
                'cardtitle' => 'Dodaj wpis',
                'thumbwidth' => News::THUMB_WIDTH,
                'thumbheight' => News::THUMB_HEIGHT
            ))
            ->with('wpis', News::make());
    }

    public function store(StoreNews $request)
    {
        $slug = Str::slug($request->nazwa);
        request()->merge([ 'slug' => $slug ]);
        $entryId = News::insertGetId(request(['nazwa', 'slug', 'status', 'meta_tytul', 'meta_opis', 'data', 'wprowadzenie', 'tekst']));
        if ($request->hasFile('plik')) {
            News::addThumb($slug, $request->file('plik'), $entryId);
        }
        return redirect($this->redirectTo)->with('success', 'Nowy wpis dodany');
    }

    public function edit($id)
    {
        $news = News::where('id', $id)->first();
        return view('news.form',
            array(
                'wpis' => $news,
                'cardtitle' => 'Edytuj wpis',
                'thumbwidth' => News::THUMB_WIDTH,
                'thumbheight' => News::THUMB_HEIGHT
            )
        );
    }

    public function update(StoreNews $request, $id)
    {
        $slug = Str::slug($request->nazwa);
        request()->merge([ 'slug' => $slug ]);
        $news = News::find($id);
        $news->update(request(['nazwa', 'slug', 'status', 'meta_tytul', 'meta_opis', 'data', 'wprowadzenie', 'tekst']));

        if ($request->hasFile('plik')) {
            News::deleteThumb($news->plik);
            News::addThumb($slug, $request->file('plik'), $id);
        }

        return redirect($this->redirectTo)->with('success', 'Wpis zaktualizowany');
    }

    public function destroy($id)
    {
        $news = News::find($id);
        News::deleteThumb($news->plik);
        $news->delete();
        return response()->json([
            'success' => 'Wpis usniety'
        ]);
    }
}
