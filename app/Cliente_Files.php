<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente_Files extends Model
{
    protected $table = 'cliente_files';

    public $timestamps = false;

    protected $fillable = [
        'cliente_id',
        'file_type',
        'source',
        'created_at'
    ];
}
