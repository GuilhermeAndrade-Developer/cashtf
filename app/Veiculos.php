<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Veiculos extends Model
{
    protected $table = 'veiculos';

    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'documento',
        'Category',
        'Brand',
        'Model',
        'FipeCode',
        'ModelYear',
        'FuelType',
        'AvgPrice',
        'ReferenceMonth',
        'ReferenceYear',
        'CreationDate',
        'LastUpdateDate'
    ];
}
