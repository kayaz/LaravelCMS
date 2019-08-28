<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Image;
use File;

class Inwestycja extends Model
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

    public function makeLogo($nazwa, $file){

        if(File::exists(public_path('inwestycje/logo/' . $this->logo))){
            File::delete(public_path('inwestycje/logo/' . $this->logo));
        }

        $name = Str::slug($nazwa) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('logo', $name, 'inwest_uploads');

        $filepath = public_path('inwestycje/logo/' . $name);
        Image::make($filepath)->fit(self::LOGO_WIDTH, self::LOGO_HEIGHT)->save($filepath);

        $this->update(['logo' => $name ]);
    }

    public function makeThumb($nazwa, $file){

        if(File::exists(public_path('inwestycje/thumbs/' . $this->miniaturka))){
            File::delete(public_path('inwestycje/thumbs/' . $this->miniaturka));
        }

        $name = Str::slug($nazwa) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('thumbs', $name, 'inwest_uploads');

        $filepath = public_path('inwestycje/thumbs/' . $name);
        Image::make($filepath)->fit(self::THUMB_WIDTH, self::THUMB_HEIGHT)->save($filepath);

        $this->update(['miniaturka' => $name ]);
    }
}
