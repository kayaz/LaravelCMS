<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['address', 'reason'];

}
