<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxa extends Model
{
    protected $table = 'taxa';

    public $timestamps = false;

    protected $fillable = ['nome', 'valor', 'status'];
}
