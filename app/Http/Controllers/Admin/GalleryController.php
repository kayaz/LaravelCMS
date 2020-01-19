<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use App\Photo;

use App\Http\Requests\StoreGallery;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{

    protected $redirectTo = 'admin/galeria';

    public function index()
    {
        $gallery = Gallery::all('id', 'name', 'updated_at')->sortBy("name");
        return view('admin.gallery.index', ['list' => $gallery]);
    }

    public function create()
    {
        return view('admin.gallery.form', ['cardtitle' => 'Dodaj katalog'])->with('entry', Gallery::make());
    }

    public function store(StoreGallery $request)
    {
        Gallery::create($request->only(['name']));
        return redirect($this->redirectTo)->with('success', 'Nowa galeria dodana');
    }

    public function show(Gallery $gallery)
    {
        $photos = Photo::all()->sortBy("sort")->where('gallery_id', $gallery->id);
        return view('admin.gallery.show', [
            'name' => $gallery->name,
            'id' => $gallery->id,
            'list' => $photos
        ]);
    }

    public function edit($id)
    {
        return view('admin.gallery.form', [
            'entry' => Gallery::where('id', $id)->first(),
            'cardtitle' => 'Edytuj galerię'
        ]);
    }

    public function update(StoreGallery $request, Gallery $gallery)
    {
        $gallery->update($request->only(['name']));
        return redirect($this->redirectTo)->with('success', 'Galeria zaktualizowana');
    }

    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        $gallery->delete();
        Gallery::deleteCatalog($id);
        return response()->json(['success' => 'Galeria usnięta']);
    }
}
