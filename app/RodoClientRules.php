<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RodoClientRules extends Model
{
    const UPDATED_AT = null;
    protected $table = 'rodo_regulki_klient';
    protected $fillable = [
        'id_rule',
        'id_client',
        'duration',
        'months',
        'ip',
        'status'
    ];
}
