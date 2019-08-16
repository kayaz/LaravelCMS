<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
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
}
