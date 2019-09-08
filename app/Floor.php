<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Image;
use File;

class Floor extends Model
{
    const PLAN_WIDTH = 1200;
    const PLAN_HEIGHT = 560;

    protected $table = 'pietro';
    protected $fillable = [
        'investments_id',
        'budynek',
        'typ',
        'nazwa',
        'slug',
        'numer',
        'plik',
        'meta_opis',
        'meta_tytul',
        'zakres_powierzchnia',
        'zakres_pokoje',
        'zakres_cena',
        'html',
        'cords'
    ];

    public function makePlan($nazwa, $file){

        if(File::exists(public_path('inwestycje/pietro/' . $this->plik))){
            File::delete(public_path('inwestycje/pietro/' . $this->plik));
        }

        $name = Str::slug($nazwa) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('pietro', $name, 'inwest_uploads');

        $filepath = public_path('inwestycje/pietro/' . $name);
        Image::make($filepath)->fit(self::PLAN_WIDTH, self::PLAN_HEIGHT)->save($filepath);

        $this->update(['plik' => $name ]);
    }

    public function rooms()
    {
        return $this->hasMany('App\Room');
    }

}
