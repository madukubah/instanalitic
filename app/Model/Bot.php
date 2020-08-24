<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    protected $fillable = [
        'client_account', 
        'class_code', 
        'message'
    ];
    public function class()
    {
        return $this->hasOne('App\Model\BaseClass','code', 'class_code' );
    }
}
