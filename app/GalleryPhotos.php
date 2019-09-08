<?php

namespace App;

use File;
use Image;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GalleryPhotos extends Model
{
    const IMG_WIDTH = 250;
    const IMG_HEIGHT = 150;

    protected $table = 'galeria_zdjecia';
    protected $fillable = ['nazwa', 'plik', 'id_gal'];

    public $timestamps = false;

    public function uploadPhoto($file, $gal_id){

        $filename = explode('.', $file->getClientOriginalName())[0];
        $date = date('His');
        $name = Str::slug($filename) . '_'.$date.'.' . $file->getClientOriginalExtension();
        $file->storeAs('galeria', $name, 'public_uploads');

        $filepath = public_path('uploads/galeria/' . $name);
        $thumbnailpath = public_path('uploads/galeria/thumbs/' . $name);
        Image::make($filepath)->fit(self::IMG_WIDTH, self::IMG_HEIGHT)->save($thumbnailpath);

        self::create([
            'id_gal' => $gal_id,
            'plik' => $name,
            'nazwa' => $filename,
        ]);
    }

    public function deletePhoto(){
        File::delete([
            public_path('uploads/galeria/' . $this->plik),
            public_path('uploads/galeria/thumbs/' . $this->plik)
        ]);
    }

    public function sort($array)
    {
        $updateRecordsArray = $array->get('recordsArray');
        $listingCounter = 1;
        foreach ($updateRecordsArray as $recordIDValue) {
            $entry = self::find($recordIDValue);
            $entry->sort = $listingCounter;
            $entry->save();
            $listingCounter = $listingCounter + 1;
        }
    }

}
