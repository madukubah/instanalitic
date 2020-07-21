<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Wsse extends Model
{
    protected $table = "wsse";
    protected $fillable = [
        'cluster', 
        'value',
    ];
}
