<?php

namespace App;
use App\GalleryPhotos;

use File;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galeria';
    protected $fillable = ['nazwa'];

    public static function deleteCatalog($id){
        $galleryphotos = GalleryPhotos::all()->where('id_gal', $id);
        foreach($galleryphotos as $element) {
            $zdjecie = GalleryPhotos::where('id', $element->id)->firstOrFail();
            File::delete([
                public_path('uploads/galeria/' . $element->plik),
                public_path('uploads/galeria/thumbs/' . $element->plik)
            ]);
            $zdjecie->delete();
        }
    }
}
