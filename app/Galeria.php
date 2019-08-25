<?php

namespace App;
use App\GaleriaZdjecia;

use File;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $table = 'galeria';
    protected $fillable = ['nazwa'];

    public static function deleteCatalog($id){
        $galleryphotos = GaleriaZdjecia::all()->where('id_gal', $id);
        foreach($galleryphotos as $element) {
            $zdjecie = GaleriaZdjecia::where('id', $element->id)->firstOrFail();
            File::delete([
                public_path('uploads/galeria/' . $element->plik),
                public_path('uploads/galeria/thumbs/' . $element->plik)
            ]);
            $zdjecie->delete();
        }
    }
}
