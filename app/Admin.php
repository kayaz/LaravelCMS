<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'ustawienia';
    protected $fillable = [
        'meta_nazwa_strony',
        'meta_opis_strony',
        'adres_strony',
        'email',
        'autor',
        'indeksowanie_strony'
    ];
}
