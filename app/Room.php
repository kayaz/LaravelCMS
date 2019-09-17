<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Image;
use File;


class Room extends Model
{
    const PLAN_WIDTH = 1024;
    const PLAN_HEIGHT = 1024;
    const THUMB_WIDTH = 500;
    const THUMB_HEIGHT = 500;
    const LIST_WIDTH = 100;
    const LIST_HEIGHT = 100;

    protected $table = 'inwestycje_powierzchnia';
    protected $fillable = [
        'floor_id',
        'nazwa',
        'slug',
        'meta_opis',
        'meta_tytul',
        'html',
        'cords',
        'status',
        'pokoje',
        'plik',
        'pdf',
        'metry',
        'szukaj_metry',
        'cena',
        'szukaj_cena',
        'cena_m'
    ];

    public function makePlan($nazwa, $file){

        if(File::exists(public_path('inwestycje/mieszkanie/' . $this->plik))){
            File::delete([
                public_path('inwestycje/mieszkanie/' . $this->plik),
                public_path('inwestycje/mieszkanie/thumbs/' . $this->plik),
                public_path('inwestycje/mieszkanie/lista/' . $this->plik)
            ]);
        }

        $name = Str::slug($nazwa) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('mieszkanie', $name, 'inwest_uploads');

        $filepath = public_path('inwestycje/mieszkanie/' . $name);
        $thumbnailpath = public_path('inwestycje/mieszkanie/thumbs/' . $name);
        $listpath = public_path('inwestycje/mieszkanie/lista/' . $name);
        Image::make($filepath)->resize(self::PLAN_WIDTH, null, function ($constraint) {$constraint->aspectRatio();})->save($filepath)
            ->resize(self::THUMB_WIDTH, null, function ($constraint) {$constraint->aspectRatio();})->save($thumbnailpath)
            ->fit(self::LIST_WIDTH, self::LIST_HEIGHT)->save($listpath);

        $this->update(['plik' => $name ]);
    }

    public function makePdf($nazwa, $file){

        if(File::exists(public_path('inwestycje/mieszkanie/pdf/' . $this->plik))){
            File::delete([
                public_path('inwestycje/mieszkanie/pdf/' . $this->plik)
            ]);
        }

        $pdfname = Str::slug($nazwa) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('mieszkanie/pdf', $pdfname, 'inwest_uploads');

        $this->update(['pdf' => $pdfname ]);
    }

}
