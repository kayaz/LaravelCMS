<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Image;
use File;

class News extends Model
{
    const THUMB_WIDTH = 920;
    const THUMB_HEIGHT = 520;
    const SMALL_THUMB_WIDTH = 350;
    const SMALL_THUMB_HEIGHT = 200;
    const ADMIN_THUMB_WIDTH = 175;
    const ADMIN_THUMB_HEIGHT = 90;

    protected $table = 'news';
    protected $fillable = [
        'nazwa',
        'slug',
        'data',
        'tekst',
        'wprowadzenie',
        'plik',
        'meta_tytul',
        'meta_opis',
        'status'
    ];

    public function makeThumb($nazwa, $file){

        if(File::exists(public_path('uploads/news/' . $this->plik))){
            File::delete([
                public_path('uploads/news/' . $this->plik),
                public_path('uploads/news/thumbs/' . $this->plik),
                public_path('uploads/news/adminthumbs/' . $this->plik)
            ]);
        }

        $name = Str::slug($nazwa) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('news', $name, 'public_uploads');

        $filepath = public_path('uploads/news/' . $name);
        $thumbnailpath = public_path('uploads/news/thumbs/' . $name);
        $thumbnailadminpath = public_path('uploads/news/adminthumbs/' . $name);
        Image::make($filepath)->fit(self::THUMB_WIDTH, self::THUMB_HEIGHT)->save($filepath)
            ->fit(self::SMALL_THUMB_WIDTH, self::SMALL_THUMB_HEIGHT)->save($thumbnailpath)
            ->fit(self::ADMIN_THUMB_WIDTH, self::ADMIN_THUMB_HEIGHT)->save($thumbnailadminpath);

        $this->update(['plik' => $name ]);
    }

    public function deleteThumb(){
        File::delete([
            public_path('uploads/news/' . $this->plik),
            public_path('uploads/news/thumbs/' . $this->plik),
            public_path('uploads/news/adminthumbs/' . $this->plik)
        ]);
    }
}
