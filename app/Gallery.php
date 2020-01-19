<?php

namespace App;

use Photo;
use File;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public static function deleteCatalog($id)
    {
        $gallery = Photo::all()->where('gal_id', $id);
        foreach ($gallery as $element) {
            $photo = Photo::where('id', $element->id)->firstOrFail();
            File::delete([
                public_path('uploads/galeria/' . $element->file),
                public_path('uploads/galeria/thumbs/' . $element->file)
            ]);
            $photo->delete();
        }
    }
}
