<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'inwestycje_powierzchnia';
    protected $fillable = [
        'floor_id',
        'nazwa',
        'slug',
        'meta_opis',
        'meta_tytul',
        'html',
        'cords'
    ];

}
