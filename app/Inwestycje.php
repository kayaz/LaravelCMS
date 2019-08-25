<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Image;
use File;

class Inwestycje extends Model
{
    const LOGO_WIDTH = 150;
    const LOGO_HEIGHT = 60;
    const THUMB_WIDTH = 900;
    const THUMB_HEIGHT = 620;

    protected $table = 'inwestycje';
    protected $fillable = [
        'typ',
        'status',
        'nazwa',
        'slug',
        'meta_tytul',
        'meta_opis',
        'email',
        'telefon',
        'adres',
        'biuro',
        'tekst',
        'lista',
        'miniaturka',
        'logo'
    ];

    public static function addLogo($slug, $file, $id){
        $name = $slug . '.' . $file->getClientOriginalExtension();
        $file->storeAs('logo', $name, 'inwest_uploads');

        $filepath = public_path('inwestycje/logo/' . $name);
        Image::make($filepath)->fit(self::LOGO_WIDTH, self::LOGO_HEIGHT)->save($filepath);

        self::find($id)->update(['logo' => $name ]);
    }

    public static function deleteLogo($file){
        File::delete(public_path('inwestycje/logo/' . $file));
    }

    public static function addThumb($slug, $file, $id){
        $name = $slug . '.' . $file->getClientOriginalExtension();
        $file->storeAs('thumbs', $name, 'inwest_uploads');

        $filepath = public_path('inwestycje/thumbs/' . $name);
        Image::make($filepath)->fit(self::THUMB_WIDTH, self::THUMB_HEIGHT)->save($filepath);

        self::find($id)->update(['miniaturka' => $name ]);
    }

    public static function deleteThumb($file){
        File::delete(public_path('inwestycje/thumbs/' . $file));
    }

}
