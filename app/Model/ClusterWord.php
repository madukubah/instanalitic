<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\ArrayCast;
use App\Model\StringArrayCast;

class ClusterWord extends Model
{
    protected $casts = [
        'words' => StringArrayCast::class,
        'counts' => ArrayCast::class
    ];
    protected $fillable = [
        'cluster', 
        'words',
        'counts',
    ];

}
