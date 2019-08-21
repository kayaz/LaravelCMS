<?php

namespace App\Http\Controllers\AdminGaleria;

use App\Galeria;
use App\GaleriaZdjecia;

use App\Http\Requests\StoreGallery;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Image;
use File;

use App\Http\Controllers\Controller;

class IndexController extends Controller
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

    public function upload(Request $request, $id)
    {
        $galleryphotos = new GaleriaZdjecia();
        $galleryphotos->id_gal = $id;

        // Upload files?
        if($request->hasFile('qqfile')) {

            // Save new file
            $file = request()->file('qqfile');
            $filename = $file->getClientOriginalName();
            $date = date('His');

            $name = Str::slug($filename, '-') . '_'.$date.'.' . $file->getClientOriginalExtension();
            $request->qqfile->storeAs('galeria', $name, 'public_uploads');

            // Make thumbs
            $filepath = public_path('uploads/galeria/' . $name);
            $thumbnailpath = public_path('uploads/galeria/thumbs/' . $name);
            Image::make($filepath)->resize(250, 150, function ($constraint) {$constraint->aspectRatio();})->save($thumbnailpath);

            // Name for SQL
            $galleryphotos->plik = $name;
            $galleryphotos->nazwa = $filename;
        }

        $galleryphotos->save();
        $data = [
            'success' => true
        ] ;

        return response()->json($data);
    }

    public function store(StoreGallery $request)
    {

        $gallery = new Galeria();
        $gallery->nazwa = $request->get('name');
        $gallery->save();

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

    public function update(StoreGallery $request, $id)
    {
        $gallery = Galeria::find($id);
        $gallery->nazwa = $request->get('name');
        $gallery->save();

        return redirect($this->redirectTo)->with('success', 'Galeria zaktualizowana');
    }

    public function sort(Request $request)
    {
        $updateRecordsArray = $request->get('recordsArray');
        $listingCounter = 1;
        foreach ($updateRecordsArray as $recordIDValue) {
            $galleryphotos = GaleriaZdjecia::find($recordIDValue);
            $galleryphotos->sort = $listingCounter;
            $galleryphotos->save();
            $listingCounter = $listingCounter + 1;
        }
    }

    public function destroy($id)
    {

        $gallery = Galeria::find($id);
        $gallery->delete();
        Galeria::deleteCatalog($id);

        return response()->json([
            'success' => 'Wpis usniety'
        ]);
    }

    public function destroyphoto($id, $gal)
    {
        $galleryphotos = GaleriaZdjecia::find($id);

        File::delete( public_path('uploads/galeria/' . $galleryphotos->plik));
        File::delete( public_path('uploads/galeria/thumbs/' . $galleryphotos->plik));

        $galleryphotos->delete();
        return response()->json([
            'success' => 'Wpis usniety'
        ]);
    }
}
