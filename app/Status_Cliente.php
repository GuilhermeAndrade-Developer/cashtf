<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_Cliente extends Model
{
    protected $table = 'status_cliente';

    public $timestamps = false;

    protected $fillable = ['nome','label'];
}
