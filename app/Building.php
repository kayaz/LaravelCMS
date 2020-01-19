<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'investments_id',
        'name',
        'slug',
        'number',
        'file',
        'meta_description',
        'meta_title',
        'area_range',
        'rooms_range',
        'price_range',
        'html',
        'cords'
    ];
}
