<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rodo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rodo_rules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'title',
        'text',
        'required',
        'time',
        'status'
    ];
}
