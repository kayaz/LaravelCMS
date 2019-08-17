<?php

namespace App\Http\Controllers\AdminNews;

use App\Http\Requests\StoreNews;
use App\News;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Image;
use File;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    protected $redirectTo = 'admin/news';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all()->sortBy("sort");
        return view('news.index',
            array('lista' => $news)
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.form',
            array('cardtitle' => 'Dodaj wpis'))
            ->with('wpis', News::make());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNews $request)
    {
        $news = new News();

        // Upload files?
        if ($request->hasFile('plik')) {

            // Save new file
            $file = request()->file('plik');
            $name = Str::slug($request->nazwa, '-') . '.' . $file->getClientOriginalExtension();
            $request->plik->storeAs('news', $name, 'public_uploads');

            // Make thumbs
            $filepath = public_path('uploads/news/' . $name);
            $thumbnailpath = public_path('uploads/news/thumbs/' . $name);
            $thumbnailadminpath = public_path('uploads/news/adminthumbs/' . $name);
            $image = Image::make($filepath)->fit(920, 520)->save($filepath);
            $image = Image::make($filepath)->resize(350, 200, function ($constraint) {$constraint->aspectRatio();})->save($thumbnailpath);
            $image = Image::make($filepath)->resize(175, 100, function ($constraint) {$constraint->aspectRatio();})->save($thumbnailadminpath);

            // Name for SQL
            $news->plik = $name;
        }

        $this->persist($news, $request);
        return redirect($this->redirectTo)->with('success', 'Nowy wpis dodany');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::where('id', $id)->first();
        return view('news.form',
            array('wpis' => $news, 'cardtitle' => 'Edytuj wpis')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(StoreNews $request, $id)
    {
        $news = News::find($id);
        // Upload file?
        if ($request->hasFile('plik')) {

            // Delete old files
            File::delete(public_path('uploads/news/' . $news->plik));
            File::delete(public_path('uploads/news/thumbs/' . $news->plik));
            File::delete(public_path('uploads/news/adminthumbs/' . $news->plik));

            // Save new file
            $file = request()->file('plik');
            $name = Str::slug($request->nazwa, '-') . '.' . $file->getClientOriginalExtension();
            $request->plik->storeAs('news', $name, 'public_uploads');

            // Make thumbs
            $filepath = public_path('uploads/news/' . $name);
            $thumbnailpath = public_path('uploads/news/thumbs/' . $name);
            $thumbnailadminpath = public_path('uploads/news/adminthumbs/' . $name);
            $image = Image::make($filepath)->fit(920, 520)->save($filepath);
            $image = Image::make($filepath)->resize(350, 200, function ($constraint) {$constraint->aspectRatio();})->save($thumbnailpath);
            $image = Image::make($filepath)->resize(175, 100, function ($constraint) {$constraint->aspectRatio();})->save($thumbnailadminpath);

            // Name for SQL
            $news->plik = $name;
        }

        $this->persist($news, $request);
        return redirect($this->redirectTo)->with('success', 'Wpis zaktualizowany');
    }

    protected function persist($menu, $request)
    {
        $menu->fill($request->only([
            'nazwa',
            'slug' => Str::slug($request->get('nazwa'), '-'),
            'status',
            'meta_tytul',
            'meta_opis',
            'data',
            'wprowadzenie',
            'tekst',
        ]));
        $menu->slug = Str::slug($request->get('nazwa'), '-');
        $menu->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Usuwamy pliki
        $news = News::find($id);
        File::delete(public_path('uploads/news/' . $news->plik));
        File::delete(public_path('uploads/news/thumbs/' . $news->plik));
        File::delete(public_path('uploads/news/adminthumbs/' . $news->plik));

        $news->delete();
        return response()->json([
            'success' => 'Wpis usniety'
        ]);
    }
}
