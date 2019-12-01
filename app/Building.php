<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $table = 'inwestycje_budynki';
    protected $fillable = [
        'investments_id',
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
}
