<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente_Socio extends Model
{
    protected $table = 'cliente_socio';

    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'cpf',
        'rg',
        'orgaoEmissor',
        'nome',
        'nationality',
        'passport',
        'bithDate',
        'gender',
        'email',
        'estadoCivil',
        'ativo',
        'documento',
        'conjuge_cpf',
        'conjuge_rg',
        'conjuge_nome',
        'conjuge_nationality',
        'conjuge_profissao',
        'conjuge_email'
    ];
}
