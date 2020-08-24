<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AccountAnalysis extends Model
{
    protected $table = "account_analysis";
    protected $fillable = [
        'username',
    ];

    public function tendencies()
    {
        return $this->hasMany('App\Model\AccountTendency', 'username', 'username' );
    }

    public function class()
    {
        return $this->hasOne('App\Model\BaseClass', 'code', 'code' );
    }
}
