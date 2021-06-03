<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente_Conta extends Model
{
    protected $table = 'cliente_conta';

    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'agencia',
        'conta',
        'digito',
        'data_vencimento',
        'banco',
        'ativo',
        'principal'
    ];
}
