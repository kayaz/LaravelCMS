<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rodo extends Model
{
    protected $table = 'rodo_regulki';
    protected $fillable = [
        'title',
        'text',
        'required',
        'time',
        'status'
    ];
}
