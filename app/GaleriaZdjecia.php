<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GaleriaZdjecia extends Model
{
    protected $table = 'galeria_zdjecia';
    protected $fillable = ['nazwa', 'plik', 'id_gal'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
