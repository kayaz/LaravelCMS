<?php

namespace App;

use File;
use Image;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Inline extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'inline';
    protected $fillable = [
        'id_place',
        'modaltytul',
        'modaleditor',
        'modaleditortext',
        'modallink',
        'modallinkbutton',
        'obrazek',
        'obrazek_alt',
        'obrazek_width',
        'obrazek_height',
        'sort '
    ];

    public static function getElements($id){
        return static::where('id_place', $id)->get();
    }

    public function makeImg($nazwa, $file, $width, $height){

        if(File::exists(public_path('uploads/inline/' . $this->obrazek))){
            File::delete([
                public_path('uploads/inline/' . $this->obrazek),
            ]);
        }

        $name = Str::slug($nazwa) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('inline', $name, 'public_uploads');

        $filepath = public_path('uploads/inline/' . $name);
        Image::make($filepath)->fit($width, $height)->save($filepath);

        $this->update(['obrazek' => $name ]);

        return $name;
    }
}
