<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente_Spc extends Model
{
    protected $table = 'cliente_spc';

    public $timestamps = false;

    protected $fillable = [
        'documento',
        'name',
        'class',
        'horizon',
        'probability',
        'score',
        'score_type',
        'reason',
        'ultima_consulta',
    ];
}
