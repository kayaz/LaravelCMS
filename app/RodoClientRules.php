<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RodoClientRules extends Model
{
    const UPDATED_AT = null;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rodo_client_rules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_rule',
        'id_client',
        'duration',
        'months',
        'ip',
        'status'
    ];
}
