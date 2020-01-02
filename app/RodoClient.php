<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RodoClient extends Model
{
    protected $table = 'rodo_klient';
    protected $fillable = [
        'name',
        'mail',
        'ip',
        'host',
        'browser'
    ];

}
