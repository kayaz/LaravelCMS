<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inwestycje extends Model
{
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
        'miniaturka',
        'logo'
    ];
}
