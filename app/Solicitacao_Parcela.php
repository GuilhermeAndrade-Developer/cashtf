<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitacao_Parcela extends Model
{
    protected $table = 'solicitacao_parcela';
    public $timestamps = false;
    protected $fillable = [
        'id_solicitacao',
        'id_status_parcela',
        'numero',
        'vencimento',
        'valor_parcela',
        'valor_juros',
        'juros'
    ];
}
