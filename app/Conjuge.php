<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conjuge extends Model
{
    protected $table = 'conjuge';

    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'nome',
        'cpf',
        'email',
        'rg',
        'nationality',
        'profissao'
    ];
}
