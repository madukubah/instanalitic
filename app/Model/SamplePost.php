<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SamplePost extends Model
{
    protected $fillable = [
        'id', 
        'full_name',
        'profile_pic_url',
        'source_image',
        'user_id',
        'username',
        'desc_image',
        'cluster',
    ];
}