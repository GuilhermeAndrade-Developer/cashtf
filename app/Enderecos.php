<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enderecos extends Model
{
    protected $table = 'enderecos';

    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'id_socio',
        'tipo',
        'Endereco_Lgr',
        'Endereco_Nro',
        'Endereco_Complemento',
        'Endereco_Bairro',
        'Endereco_Mun',
        'Endereco_UF',
        'Endereco_CEP',
        'Endereco_Pais'
    ];
}
