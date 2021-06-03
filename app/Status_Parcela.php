<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_Parcela extends Model
{
    protected $table = 'status_parcela';

    public $timestamps = false;

    protected $fillable = ['nome'];
}
