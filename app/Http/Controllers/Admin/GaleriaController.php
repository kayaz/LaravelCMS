<?php

namespace App\Http\Controllers\Admin;

use App\Galeria;
use App\GaleriaZdjecia;

use App\Http\Requests\StoreGallery;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class GaleriaController extends Controller
{

    protected $redirectTo = 'admin/galeria';

    public function index()
    {
        $gallery = Galeria::all('id', 'nazwa', 'updated_at')->sortBy("nazwa");
        return view('galeria.index',
            array('galeria' => $gallery)
        );
    }

    public function create()
    {
        return view('galeria.form',
            array('cardtitle' => 'Dodaj katalog'))->with('wpis', Galeria::make());
    }

    public function store(StoreGallery $request)
    {
        Galeria::create($request->only(['nazwa']));
        return redirect($this->redirectTo)->with('success', 'Nowa galeria dodana');
    }

    public function show($id)
    {
        $gallery = Galeria::where('id', $id)->first(['id', 'nazwa']);
        $galleryphotos = GaleriaZdjecia::all()->sortBy("sort")->where('id_gal', $id);

        return view('galeria.show',
            array(
                'nazwa' => $gallery->nazwa,
                'id' => $gallery->id,
                'zdjecia' => $galleryphotos
            )
        );
    }

    public function edit($id)
    {
        $gallery = Galeria::where('id', $id)->first();
        return view('galeria.form',
            array('wpis' => $gallery, 'cardtitle' => 'Edytuj galerię')
        );
    }

    public function update(StoreGallery $request, Galeria $galeria)
    {
        $galeria->update($request->only(['nazwa']));
        return redirect($this->redirectTo)->with('success', 'Galeria zaktualizowana');
    }

    public function destroy($id)
    {
        $gallery = Galeria::find($id);
        $gallery->delete();
        Galeria::deleteCatalog($id);

        return response()->json([
            'success' => 'Galeria usnięta'
        ]);
    }

// Zdjęcia
    public function sort(Request $request, GaleriaZdjecia $galeriaZdjecia)
    {
        $galeriaZdjecia->sort($request);
    }

    public function upload(Request $request, $id)
    {
        if ($request->hasFile('qqfile')) {
            GaleriaZdjecia::uploadPhoto($request->file('qqfile'), $id);
        }

        return response()->json(['success' => true]);
    }

    public function destroyphoto(GaleriaZdjecia $galeriaZdjecia)
    {
        $galeriaZdjecia->deletePhoto();
        $galeriaZdjecia->delete();

        return response()->json([
            'success' => 'Zdjęcie usunięte'
        ]);
    }
}
