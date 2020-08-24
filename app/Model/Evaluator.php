<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Evaluator extends Model
{
    protected $table = "evaluator";
    protected $fillable = [
        'cluster', 
        'value',
    ];
}
