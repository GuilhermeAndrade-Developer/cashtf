<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Solicitacao extends Model
{
    use Notifiable;

    protected $fillable = [
        'id_solicitante',
        'id_sacado',
        'id_status',
        'id_cliente_conta',
        'data_gerado',
        'juros',
        'ativo',
        'valor_total',
        'valor_total_juros',
        'juros_total',
        'arquivo_xml',
        'id_nota',
        'nro_bordero',
        'contrato',
        'tac'
    ];

    public $timestamps = false;

    protected $table = 'solicitacao';
}
