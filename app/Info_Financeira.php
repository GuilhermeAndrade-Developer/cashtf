<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info_Financeira extends Model
{
    protected $table = 'info_financeira';

    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'documento',
        'TotalAssets',
        'Year',
        'Bank',
        'Branch',
        'Batch',
        'IsVipBranch',
        'Status',
        'CompanyOwnership',
        'MTE',
        'IBGE',
        'BIGDATA',
        'CreationDate',
        'LastUpdateDate'
    ];
}
