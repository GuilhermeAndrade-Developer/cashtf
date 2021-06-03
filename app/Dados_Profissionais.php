<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dados_Profissionais extends Model
{
    protected $table = 'dados_profissionais';

    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'documento',
        'Sector',
        'Country',
        'CompanyIdNumber',
        'CompanyName',
        'Area',
        'Level',
        'Status',
        'IncomeRange',
        'Income',
        'StartDate',
        'EndDate',
        'CreationDate',
        'LastUpdateDate'
    ];
}
