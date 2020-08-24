<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BaseClass extends Model
{
    protected $fillable = [
        'code', 
        'class', 
        'values'
    ];
}