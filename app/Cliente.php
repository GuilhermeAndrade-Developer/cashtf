<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';

    public $timestamps = false;
    
    protected $fillable = [
        'id_status_cliente',    'etapa',
        'email',                'senha',
        'cpf',                  'cnpj',
        'telefone',             'contrato_social',
        'faturamento',          'data_gerado',
        'OfficialName',         'TradeName',
        'ClosedDate',           'FoundedDate',
        'Age',                  'IsHeadquarter',
        'HeadquarterState',     'TaxIdStatus',
        'TaxIdOrigin',          'TaxRegime',
        'Activities',           'Activities.isMain',
        'Activities.Code',      'LegalNature.Code',
        'LegalNature.Activity', 'CreationDate',
        'LastUpdateDate',       'Name',
        'imagem',               'Gender',
        'BirthDate',            'BirthCountry',
        'BirthState',           'MotherName',
        'FatherName',           'HasObitIndication',
        'token_forgot_password','limite_credito',
        'taxa_desagio',         'rg',
        'orgaoEmissor',         'tipo',
        'nationality',          'passport',
        'documento',            'mainActivity',
        'secondActivity',       'EstadoCivil',
        'tarifa_bordero'
    ];
}
