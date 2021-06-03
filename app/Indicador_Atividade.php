<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicador_Atividade extends Model
{
    protected $table = 'indicadores_atividade';

    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'documento',
        'EmployeesRange',
        'IncomeRange',
        'HasActivity',
        'ActivityLevel',
        'FirstLevelEconomicGroupAverageActivityLevel',
        'FirstLevelEconomicGroupMaxActivityLevel',
        'FirstLevelEconomicGroupMinActivityLevel',
        'HasRecentAddress',
        'HasRecentPhone',
        'HasRecentEmail',
        'HasRecentPassages',
        'HasActiveDomain',
        'HasActiveSSL',
        'HasCorporateEmail',
        'NumberOfBranches',
        'LastUpdateDate'
    ];
}
