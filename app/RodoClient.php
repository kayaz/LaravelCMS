<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RodoClient extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rodo_client';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'mail',
        'ip',
        'host',
        'browser'
    ];
}
