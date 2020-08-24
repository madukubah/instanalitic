<?php

namespace App\Model;


use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ArrayCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        // return "tesss";
        return json_decode(str_replace(['{', '}'], ['[', ']'], $value));
        // return json_decode( $value );
    }

    public function set($model, $key, $value, $attributes)
    {

        return str_replace(['[', ']'], ['{', '}'], json_encode($value));
    }
}
