<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    protected $table = 'boleto';

    public $timestamps = false;
    
    protected $fillable = [
        'id_solicitacao','id_integracao','status','id_parcela'
    ];
}
