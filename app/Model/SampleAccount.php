<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SampleAccount extends Model
{
    protected $fillable = [
        'full_name', 
        'profile_pic_url',
        'user_id',
        'username'
    ];

    public function posts()
    {
        return $this->hasMany('App\Model\Post', 'user_id', 'user_id' );
    }
}
