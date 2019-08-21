<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boksy extends Model
{
    protected $table = 'boksy';
    protected $fillable = ['nazwa', 'plik', 'tekst'];
}
