<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Image;
use File;

class Investments extends Model
{
    const LOGO_WIDTH = 150;
    const LOGO_HEIGHT = 60;
    const THUMB_WIDTH = 900;
    const THUMB_HEIGHT = 620;
    const PLAN_WIDTH = 1200;
    const PLAN_HEIGHT = 560;

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
        'plan',
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

    public function uploadPlan($file){

        if(File::exists(public_path('inwestycje/plan/' . $this->plan))){
            File::delete(public_path('inwestycje/plan/' . $this->plan));
        }

        $filename = explode('.', $file->getClientOriginalName())[0];
        $date = date('His');
        $name = Str::slug($filename) . '_'.$date.'.' . $file->getClientOriginalExtension();
        $file->storeAs('plan', $name, 'inwest_uploads');

        $filepath = public_path('inwestycje/plan/' . $name);
        Image::make($filepath)->fit(self::PLAN_WIDTH, self::PLAN_HEIGHT)->save($filepath);

        $this->update(['plan' => $name ]);

    }

    public function floors()
    {
        return $this->hasMany('App\Floor');
    }

    public function investrooms()
    {
        return $this->hasManyThrough(
            'App\Room',
            'App\Floor',
            'investments_id',
            'floor_id',
            'id',
            'id'
        );
    }
}
