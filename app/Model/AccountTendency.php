<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AccountTendency extends Model
{
    protected $table = "account_tendency";

    protected $fillable = [
        'username',
        'source_image',
        'text',
        'prediction',
        'value',
    ];
    
}
