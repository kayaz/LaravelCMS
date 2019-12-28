<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use App\GalleryPhotos;

use App\Http\Requests\StoreGallery;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{

    protected $redirectTo = 'admin/galeria';

    public function index()
    {
        $gallery = Gallery::all('id', 'nazwa', 'updated_at')->sortBy("nazwa");
        return view('admin.gallery.index', ['list' => $gallery]);
    }

    public function create()
    {
        return view('admin.gallery.form', ['cardtitle' => 'Dodaj katalog'])->with('entry', Gallery::make());
    }

    public function store(StoreGallery $request)
    {
        Gallery::create($request->only(['nazwa']));
        return redirect($this->redirectTo)->with('success', 'Nowa galeria dodana');
    }

    public function show(Gallery $gallery)
    {
        $photos = GalleryPhotos::all()->sortBy("sort")->where('id_gal', $gallery->id);
        return view('admin.gallery.show', ['nazwa' => $gallery->nazwa, 'id' => $gallery->id, 'list' => $photos]);
    }

    public function edit($id)
    {
        $gallery = Gallery::where('id', $id)->first();
        return view('admin.gallery.form', ['entry' => $gallery, 'cardtitle' => 'Edytuj galerię']);
    }

    public function update(StoreGallery $request, Gallery $gallery)
    {
        $gallery->update($request->only(['nazwa']));
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
