<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antecedente_Criminal extends Model
{
    protected $table = 'antecedente_criminal';

    public $timestamps = false;

    protected $fillable = [
        'id_cliente',  
        'documento', 
        'Origin', 
        'Status', 
        'IdNumber',
        'CertificateText', 
        'CertificateNumber', 
        'EmissionDate', 
        'LastUpdateDate', 
        'Validity'
    ];
}
