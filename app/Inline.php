<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
