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

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inline';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_place',
        'modaltytul',
        'modaleditor',
        'modaleditortext',
        'modallink',
        'modallinkbutton',
        'file',
        'file_alt',
        'file_width',
        'file_height',
        'sort '
    ];

    public static function getElements($id){
        return static::where('id_place', $id)->get();
    }

    public function makeImg($name, $file, $width, $height){

        if(File::exists(public_path('uploads/inline/' . $this->obrazek))){
            File::delete([
                public_path('uploads/inline/' . $this->obrazek),
            ]);
        }

        $filename = Str::slug($name) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('inline', $filename, 'public_uploads');

        $filepath = public_path('uploads/inline/' . $filename);
        Image::make($filepath)->fit($width, $height)->save($filepath);

        $this->update(['file' => $filename ]);

        return $filename;
    }
}
