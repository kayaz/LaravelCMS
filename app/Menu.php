<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = [
        'menu',
        'slug',
        'id_parent',
        'nazwa',
        'meta_tytul',
        'meta_opis',
        'tekst'
    ];
}
