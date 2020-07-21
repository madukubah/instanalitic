<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WordCount extends Model
{
    protected $fillable = [
        'value', 
        'count',
    ];
}
